<?php

namespace App\Controllers;

use App\Models\BaremeFraisModel;
use App\Models\TypeOperationModel;

class BaremeFraisController extends BaseController
{
    protected $model;
    protected $typeModel;

    public function __construct()
    {
        $this->model     = new BaremeFraisModel();
        $this->typeModel = new TypeOperationModel();
    }

    public function index()
    {
        $data['baremes'] = $this->model
            ->select('baremes_frais.*, types_operation.libelle as type_libelle')
            ->join('types_operation', 'types_operation.id = baremes_frais.type_operation_id')
            ->orderBy('type_operation_id')
            ->orderBy('montant_min')
            ->findAll();
        return view('bareme_frais/BaremeFraisIndex', $data);
    }

    public function new()
    {
        $data['types'] = $this->typeModel->findAll();
        return view('bareme_frais/BaremeFraisCreate', $data);
    }

    public function create()
    {
        $typeOperationId = (int) $this->request->getPost('type_operation_id');
        $montantMin      = (float) $this->request->getPost('montant_min');
        $montantMaxPost  = $this->request->getPost('montant_max');
        $montantMax      = ($montantMaxPost === '' || $montantMaxPost === null) ? null : (float) $montantMaxPost;

        if ($this->model->chevauche($typeOperationId, $montantMin, $montantMax)) {
            return redirect()->back()->withInput()
                ->with('error', "Cette tranche chevauche une tranche existante pour ce type d'opération.");
        }

        $this->model->insert([
            'type_operation_id' => $typeOperationId,
            'montant_min'       => $montantMin,
            'montant_max'       => $montantMax,
            'frais'             => $this->request->getPost('frais'),
            'frais_type'        => $this->request->getPost('frais_type'),
        ]);
        return redirect()->to('/baremes');
    }

    public function edit($id)
    {
        $data['bareme'] = $this->model->find($id);
        $data['types']  = $this->typeModel->findAll();
        return view('bareme_frais/BaremeFraisEdit', $data);
    }

    public function update($id)
    {
        $typeOperationId = (int) $this->request->getPost('type_operation_id');
        $montantMin      = (float) $this->request->getPost('montant_min');
        $montantMaxPost  = $this->request->getPost('montant_max');
        $montantMax      = ($montantMaxPost === '' || $montantMaxPost === null) ? null : (float) $montantMaxPost;

        if ($this->model->chevauche($typeOperationId, $montantMin, $montantMax, $id)) {
            return redirect()->back()->withInput()
                ->with('error', "Cette tranche chevauche une tranche existante pour ce type d'opération.");
        }

        $this->model->update($id, [
            'type_operation_id' => $typeOperationId,
            'montant_min'       => $montantMin,
            'montant_max'       => $montantMax,
            'frais'             => $this->request->getPost('frais'),
            'frais_type'        => $this->request->getPost('frais_type'),
        ]);
        return redirect()->to('/baremes');
    }

    public function delete($id)
    {
        $this->model->delete($id);
        return redirect()->to('/baremes');
    }
}