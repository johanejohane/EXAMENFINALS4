<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\BaremeFraisModel;
use App\Models\ClientModel;
use App\Models\CompteOperateurModel;
use App\Models\PrefixeModel;
use App\Models\TransactionModel;
use App\Models\TypeOperationModel;
use Config\Database;

class OperationController extends BaseController
{
    protected $clientModel;
    protected $transactionModel;
    protected $typeOperationModel;
    protected $baremeFraisModel;
    protected $prefixeModel;
    protected $compteOperateurModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
        $this->transactionModel = new TransactionModel();
        $this->typeOperationModel = new TypeOperationModel();
        $this->baremeFraisModel = new BaremeFraisModel();
        $this->prefixeModel = new PrefixeModel();
        $this->compteOperateurModel = new CompteOperateurModel();
    }

    public function depot()
    {
        return view('client/depot');
    }

    public function depotProcess()
    {
        $montant = (float) $this->request->getPost('montant');

        if ($montant <= 0) {
            return redirect()->back()->withInput()->with('error', 'Montant invalide.');
        }

        $client = $this->clientModel->find(session('client_id'));
        $typeDepot = $this->typeOperationModel->getByCode('depot');

        $this->clientModel->crediter($client['id'], $montant);
        $this->transactionModel->insert([
            'type_operation_id' => $typeDepot['id'],
            'client_source_id' => null,
            'client_destination_id' => $client['id'],
            'montant' => $montant,
            'frais' => 0,
        ]);

        return redirect()->to('/client/dashboard')->with('success', "Depot de {$montant} Ar effectue avec succes.");
    }

    public function retrait()
    {
        return view('client/retrait');
    }

    public function retraitProcess()
    {
        $montant = (float) $this->request->getPost('montant');

        if ($montant <= 0) {
            return redirect()->back()->withInput()->with('error', 'Montant invalide.');
        }

        $client = $this->clientModel->find(session('client_id'));
        $typeRetrait = $this->typeOperationModel->getByCode('retrait');
        $frais = $this->baremeFraisModel->calculerFrais($typeRetrait['id'], $montant);
        $totalADebiter = $montant + $frais;

        if ((float) $client['solde'] < $totalADebiter) {
            return redirect()->back()->withInput()->with('error', 'Solde insuffisant.');
        }

        $this->clientModel->debiter($client['id'], $totalADebiter);
        $this->transactionModel->insert([
            'type_operation_id' => $typeRetrait['id'],
            'client_source_id' => $client['id'],
            'client_destination_id' => null,
            'montant' => $montant,
            'frais' => $frais,
        ]);

        return redirect()->to('/client/dashboard')->with('success', "Retrait de {$montant} Ar effectue. Frais: {$frais} Ar.");
    }

    public function transfert()
    {
        return view('client/transfert');
    }

    public function transfertProcess()
    {
        $montantTotal = (float) $this->request->getPost('montant');
        $numeroUnique = trim((string) $this->request->getPost('numero_destination'));
        $numerosMultiples = trim((string) $this->request->getPost('numeros_destinataires'));
        $inclureFraisRetrait = $this->request->getPost('inclure_frais_retrait') === '1';
        $client = $this->clientModel->find(session('client_id'));



        if ($montantTotal <= 0) {
            return redirect()->back()->withInput()->with('error', 'Montant invalide.');
        }

        $numeros = $numerosMultiples === ''
            ? [$numeroUnique]
            : preg_split('/[\s,;]+/', $numerosMultiples, -1, PREG_SPLIT_NO_EMPTY);
        $numeros = array_values(array_filter(array_map('trim', $numeros)));

        if (empty($numeros)) {
            return redirect()->back()->withInput()->with('error', 'Saisissez au moins un numero destinataire.');
        }
        if (count($numeros) !== count(array_unique($numeros))) {
            return redirect()->back()->withInput()->with('error', 'Un numero destinataire est present plusieurs fois.');
        }
        if (in_array($client['numero'], $numeros, true)) {
            return redirect()->back()->withInput()->with('error', 'Impossible de transferer vers votre propre numero.');
        }

        $typeTransfert = $this->typeOperationModel->getByCode('transfert');
        $typeRetrait = $this->typeOperationModel->getByCode('retrait');
        $operateurSource = $this->prefixeModel->getOperateurByNumero($client['numero']);

        if (! $operateurSource) {
            return redirect()->back()->withInput()->with('error', 'Operateur source introuvable.');
        }

        $nombreDestinataires = count($numeros);
        $partStandard = round($montantTotal / $nombreDestinataires, 2);
        $montantRestant = $montantTotal;
        $operations = [];
        $totalADebiter = 0.0;
        $totalFrais = 0.0;

        foreach ($numeros as $index => $numeroDestinataire) {
            $montant = $index === $nombreDestinataires - 1
                ? round($montantRestant, 2)
                : $partStandard;
            $montantRestant = round($montantRestant - $montant, 2);

            if ($montant <= 0) {
                return redirect()->back()->withInput()->with('error', 'Le montant est trop faible pour etre reparti entre ces destinataires.');
            }

            $destinataire = $this->clientModel->findByNumero($numeroDestinataire);
            if (! $destinataire) {
                return redirect()->back()->withInput()->with('error', "Numero destinataire introuvable: {$numeroDestinataire}.");
            }

            $operateurDestination = $this->prefixeModel->getOperateurByNumero($destinataire['numero']);
            if (! $operateurDestination) {
                return redirect()->back()->withInput()->with('error', "Operateur introuvable pour le numero {$numeroDestinataire}.");
            }

            $memeOperateur = $operateurSource['id'] === $operateurDestination['id'];

            if ($inclureFraisRetrait && ! $memeOperateur) {
                return redirect()->back()->withInput()->with('error', "Le frais de retrait ne peut pas etre inclus pour le numero {$numeroDestinataire} : operateur different.");
            }

            $fraisBareme = $this->baremeFraisModel->calculerFrais($typeTransfert['id'], $montant);
            $fraisRetraitInclus = $inclureFraisRetrait
                ? $this->baremeFraisModel->calculerFrais($typeRetrait['id'], $montant)
                : 0.0;
            $commission = 0.0;

            if (! $memeOperateur) {
                $commission = round($montant * ((float) $operateurDestination['commission_transfert'] / 100), 2);
            }

            $frais = $fraisBareme + $commission;
            $totalADebiter += $montant + $frais + $fraisRetraitInclus;
            $totalFrais += $frais;
            $operations[] = [
                'destinataire' => $destinataire,
                'operateur_destination' => $operateurDestination,
                'montant' => $montant,
                'frais' => $frais,
                'commission' => $commission,
                'frais_retrait_inclus' => $fraisRetraitInclus,
            ];
        }

        if ((float) $client['solde'] < $totalADebiter) {
            return redirect()->back()->withInput()->with('error', 'Solde insuffisant.');
        }

        $db = Database::connect();
        $db->transStart();
        $this->clientModel->debiter($client['id'], $totalADebiter);

        foreach ($operations as $operation) {
            $destinataire = $operation['destinataire'];
            $operateurDestination = $operation['operateur_destination'];
            $montant = $operation['montant'];
            $fraisRetraitInclus = $operation['frais_retrait_inclus'];
            $commission = $operation['commission'];

            $this->clientModel->crediter($destinataire['id'], $montant + $fraisRetraitInclus);

            if ($operateurSource['id'] != $operateurDestination['id']) {
                $montantReglement = $montant + $fraisRetraitInclus + $commission;
                $this->compteOperateurModel->debiter($operateurSource['id'], $montantReglement);
                $this->compteOperateurModel->crediter($operateurDestination['id'], $montantReglement);
            }

            $this->transactionModel->insert([
                'type_operation_id' => $typeTransfert['id'],
                'client_source_id' => $client['id'],
                'client_destination_id' => $destinataire['id'],
                'operateur_source_id' => $operateurSource['id'],
                'operateur_destination_id' => $operateurDestination['id'],
                'montant' => $montant,
                'frais' => $operation['frais'],
                'commission_interoperateur' => $commission,
                'frais_retrait_inclus' => $fraisRetraitInclus,
            ]);
        }

        $db->transComplete();
        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors du transfert. Veuillez reessayer.');
        }

        $message = "Transfert de {$montantTotal} Ar reparti entre {$nombreDestinataires} destinataire(s). Frais: {$totalFrais} Ar. Total debite: {$totalADebiter} Ar.";
        return redirect()->to('/client/dashboard')->with('success', $message);
    }
}
