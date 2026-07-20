<?php

namespace App\Controllers;

use App\Models\ClientModel;

class CompteClientController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ClientModel();
    }

    public function index()
    {
        $data['clients'] = $this->model->orderBy('numero')->findAll();
        return view('compte/CompteClientIndex', $data);
    }
}
