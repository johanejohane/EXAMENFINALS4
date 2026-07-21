<?php

namespace App\Controllers;

use App\Models\PrefixeModel;
use App\Models\OperateurModel;

class PrefixeController extends BaseController
{
    protected $model;
    protected $operateurModel;

    public function __construct()
    {
        $this->model = new PrefixeModel();
        $this->operateurModel = new OperateurModel();
    }

    public function index()
    {
        $data['prefixes'] = $this->model
            ->select('prefixes.*, operateurs.nom as operateur_nom')
            ->join('operateurs', 'operateurs.id = prefixes.operateur_id')
            ->findAll();
        return view('prefixe/index', $data);
    }

    public function new()
    {
        $data['operateurs'] = $this->operateurModel->findAll();
        return view('prefixe/create', $data);
    }

    public function create()
    {
        $this->model->insert([
            'prefixe' => $this->request->getPost('prefixe'),
            'libelle' => $this->request->getPost('libelle'),
            'operateur_id' => $this->request->getPost('operateur_id'),
        ]);
        return redirect()->to('/prefixes');
    }

    public function edit($id)
    {
        $data['prefixe'] = $this->model->find($id);
        $data['operateurs'] = $this->operateurModel->findAll();
        return view('prefixe/edit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, [
            'prefixe' => $this->request->getPost('prefixe'),
            'libelle' => $this->request->getPost('libelle'),
            'operateur_id' => $this->request->getPost('operateur_id'),
        ]);
        return redirect()->to('/prefixes');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/prefixes');
    }
}
