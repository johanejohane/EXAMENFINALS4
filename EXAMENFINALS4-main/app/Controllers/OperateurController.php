<?php

namespace App\Controllers;

use App\Models\OperateurModel;
use App\Models\CompteOperateurModel;
use Config\Database;

class OperateurController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new OperateurModel();
    }

    public function index()
    {
        $data['operateurs'] = $this->model->findAll();
        return view('operateur/index', $data);
    }

    public function new()
    {
        return view('operateur/create');
    }

    public function create()
    {
        $db = Database::connect();
        $db->transStart();

        $operateurId = $this->model->insert([
            'nom' => $this->request->getPost('nom'),
            'commission_transfert' => $this->request->getPost('commission_transfert'),
        ]);

        if ($operateurId !== false) {
            (new CompteOperateurModel())->insert([
                'operateur_id' => $operateurId,
                'solde' => 0,
            ]);
        }

        $db->transComplete();

        if ($operateurId === false || $db->transStatus() === false) {
            return redirect()->back()->withInput()->with('error', 'Impossible de creer l operateur.');
        }

        return redirect()->to('/operateurs');
    }

    public function edit($id)
    {
        $data['operateur'] = $this->model->find($id);
        return view('operateur/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, [
            'nom' => $this->request->getPost('nom'),
            'commission_transfert' => $this->request->getPost('commission_transfert'),
        ]);
        return redirect()->to('/operateurs');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/operateurs');
    }
}
