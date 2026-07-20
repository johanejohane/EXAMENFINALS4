<?php
namespace App\Controllers\Client;
use App\Controllers\BaseController;
use App\Models\TransactionModel;
class HistoriqueController extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionModel();
        $historique =$transactionModel->historiqueClient(session('client_id'), 200);

        return view('client/historique', ['historique' => $historique]);
    }
}