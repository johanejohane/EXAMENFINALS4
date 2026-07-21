<?php 
namespace App\Controllers\Client;
use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\PourcentageEpargneModel;
use Config\Database;

class PourcentageEpargneController extends BaseController
{

    protected $clientModel;
    protected $pourcentage;

    public function __construct()
    {
        $this->clientModel = new ClientModel(); 
        $this->pourcentage = new PourcentageEpargneModel();
    }
    public function index()
    {
        return view('client/epargneconfig');
    }

    public function create()
    {
        $client = $this->clientModel->find(session('client_id'));
        $p = $this->pourcentage->getpost('pourcentage');
        
        $this->pourcentage->insert([
            'id_client' => $client,
            'pourcentage' => $p,
        ]);
        
        return view('client/epargneconfig');
    }
        

    
}