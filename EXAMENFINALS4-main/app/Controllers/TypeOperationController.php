<?php

namespace App\Controllers;

use App\Models\TypeOperationModel;

class TypeOperationController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TypeOperationModel();
    }

    public function index()
    {
        $data['types'] = $this->model->findAll();
        return view('type_operation/TypeOperationIndex', $data);
    }

    public function new()
    {
        return view('type_operation/TypeOperationCreate');
    }

    public function create()
    {
        $this->model->insert([
            'code'    => $this->request->getPost('code'),
            'libelle' => $this->request->getPost('libelle'),
        ]);
        return redirect()->to('/types-operation');
    }

    public function edit($id)
    {
        $data['type'] = $this->model->find($id);
        return view('type_operation/TypeOperationEdit', $data);
    }

    public function update($id)
    {
        $this->model->update($id, [
            'code'    => $this->request->getPost('code'),
            'libelle' => $this->request->getPost('libelle'),
        ]);
        return redirect()->to('/types-operation');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/types-operation');
    }

    public function promotion($id)
    {
        
    }
}