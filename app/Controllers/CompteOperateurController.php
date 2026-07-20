<?php

namespace App\Controllers;

use App\Models\CompteOperateurModel;

class CompteOperateurController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CompteOperateurModel();
    }

    public function index()
    {
        $data['comptes'] = $this->model
            ->select('comptes_operateurs.*, operateurs.nom as operateur_nom')
            ->join('operateurs', 'operateurs.id = comptes_operateurs.operateur_id')
            ->findAll();
        return view('compte_operateur/index', $data);
    }
}
