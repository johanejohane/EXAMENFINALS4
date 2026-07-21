<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\TransactionModel;

class DashboardController extends BaseController
{
    // Affiche le tableau de bord du client connecté : son solde + ses 10 dernières opérations
    public function index()
    {
        $clientModel = new ClientModel();
        $client  = $clientModel->find(session('client_id'));

        $transactionModel = new TransactionModel();
        $historique = $transactionModel->historiqueClient($client['id'], 10);

        return view('client/dashboard', [
            'client'     => $client,
            'historique' => $historique,
        ]);
    }
}