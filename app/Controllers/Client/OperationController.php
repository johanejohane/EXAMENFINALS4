<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\TransactionModel;
use App\Models\TypeOperationModel;
use App\Models\BaremeFraisModel;
use Config\Database;

class OperationController extends BaseController
{
    protected $clientModel;
    protected $transactionModel;
    protected $typeOperationModel;
    protected $baremeFraisModel;
    
    public function __construct()
    {
        $this->clientModel        = new ClientModel();
        $this->transactionModel   = new TransactionModel();
        $this->typeOperationModel = new TypeOperationModel();
        $this->baremeFraisModel   = new BaremeFraisModel();
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
        $clientId = session('client_id');
        $client   = $this->clientModel->find($clientId);
        $typeDepot = $this->typeOperationModel->getByCode('depot');
        $this->clientModel->crediter($client['id'], $montant);
        $this->transactionModel->insert([
            'type_operation_id'     => $typeDepot['id'],
            'client_source_id'      => null,        // pas de source, l'argent vient de l'extérieur
            'client_destination_id' => $client['id'], // le client reçoit l'argent
            'montant'                => $montant,
            'frais'                  => 0,           // pas de frais pour un dépôt
        ]);

        return redirect()->to('/client/dashboard')
            ->with('success', "Dépôt de {$montant} Ar effectué avec succès.");
    }

    // RETRAIT
  
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
        $clientId = session('client_id');
        $client   = $this->clientModel->find($clientId);
        $typeRetrait = $this->typeOperationModel->getByCode('retrait');
        $frais = $this->baremeFraisModel->calculerFrais($typeRetrait['id'], $montant);
        $totalADebiter = $montant + $frais;
        if ((float) $client['solde'] < $totalADebiter) {
            return redirect()->back()->withInput()->with('error', 'Solde insuffisant.');
        }
        $this->clientModel->debiter($client['id'], $totalADebiter);
        $this->transactionModel->insert([
            'type_operation_id'     => $typeRetrait['id'],
            'client_source_id'      => $client['id'], // l'argent sort du compte du client
            'client_destination_id' => null,
            'montant'                => $montant,
            'frais'                  => $frais,
        ]);
        return redirect()->to('/client/dashboard')
            ->with('success', "Retrait de {$montant} Ar effectué. Frais: {$frais} Ar.");
    }

    // TRANSFERT
    public function transfert()
    {
        return view('client/transfert');
    }

    public function transfertProcess()
    {
        $numeroDestinataire = trim((string) $this->request->getPost('numero_destination'));
        $montant             = (float) $this->request->getPost('montant');
        $clientId = session('client_id');
        $client   = $this->clientModel->find($clientId);
        if ($montant <= 0) {
            return redirect()->back()->withInput()->with('error', 'Montant invalide.');
        }
        if ($numeroDestinataire === $client['numero']) {
            return redirect()->back()->withInput()->with('error', 'Impossible de transférer vers votre propre numéro.');
        }
        $destinataire = $this->clientModel->findByNumero($numeroDestinataire);
        if (! $destinataire) {
            return redirect()->back()->withInput()->with('error', 'Numéro destinataire introuvable.');
        }
        $typeTransfert = $this->typeOperationModel->getByCode('transfert');
        $frais = $this->baremeFraisModel->calculerFrais($typeTransfert['id'], $montant);
        $totalADebiter = $montant + $frais;
        if ((float) $client['solde'] < $totalADebiter) {
            return redirect()->back()->withInput()->with('error', 'Solde insuffisant.');
        }
        //     (évite qu'un compte soit débité sans que l'autre soit crédité)
        $db = Database::connect();
        $db->transStart();
        // On débite l'expéditeur
        $this->clientModel->debiter($client['id'], $totalADebiter);
        $this->clientModel->crediter($destinataire['id'], $montant);
        $this->transactionModel->insert([
            'type_operation_id'     => $typeTransfert['id'],
            'client_source_id'      => $client['id'],
            'client_destination_id' => $destinataire['id'],
            'montant'                => $montant,
            'frais'                  => $frais,
        ]);
        $db->transComplete();
        if ($db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Erreur lors du transfert, veuillez réessayer.');
        }
        return redirect()->to('/client/dashboard')
            ->with('success', "Transfert de {$montant} Ar vers {$numeroDestinataire} effectué. Frais: {$frais} Ar.");
    }
}