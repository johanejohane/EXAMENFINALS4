<?php

namespace App\Controllers;

use App\Models\OperateurModel;

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
        $this->model->insert([
            'nom' => $this->request->getPost('nom'),
        ]);
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
        ]);
        return redirect()->to('/operateurs');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/operateurs');
    }
}
