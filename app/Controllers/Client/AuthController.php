<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\PrefixeModel;

class AuthController extends BaseController
{
    // Affiche le formulaire de connexion (redirige vers le dashboard si déjà connecté)
    public function login()
    {
        if (session('isLoggedIn')) {
            return redirect()->to('/client/dashboard');
        }

        return view('client/login');
    }

    // Traite le formulaire de connexion :
    // - valide le format du numéro
    // - vérifie que le préfixe existe
    // - crée automatiquement le client s'il n'existe pas encore (pas d'inscription préalable)
    // - ouvre la session
    public function process()
    {
        $numero = trim((string) $this->request->getPost('numero'));

        if (empty($numero) || ! preg_match('/^[0-9]{10}$/', $numero)) {
            return redirect()->back()->withInput()->with('error', 'Numéro invalide (10 chiffres attendus, ex: 0331234567).');
        }

        $prefixeModel = new PrefixeModel();
        if (! $prefixeModel->estValide($numero)) {
            return redirect()->back()->withInput()->with('error', "Ce préfixe téléphonique n'est pas reconnu.");
        }

        $clientModel = new ClientModel();
        $client      = $clientModel->findByNumero($numero);

        if (! $client) {
            $id     = $clientModel->insert([
                'numero' => $numero,
                'nom'    => null,
                'solde'  => 0,
            ]);
            $client = $clientModel->find($id);
        }

        session()->set([
            'client_id'     => $client['id'],
            'client_numero' => $client['numero'],
            'isLoggedIn'    => true,
        ]);

        return redirect()->to('/client/dashboard');
    }

    // Déconnecte le client en détruisant sa session
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/client/login');
    }
}