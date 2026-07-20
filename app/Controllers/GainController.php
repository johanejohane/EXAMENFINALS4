<?php

namespace App\Controllers;

use App\Models\TransactionModel;

class GainController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new TransactionModel();
    }

    public function index()
    {
        $dateDebut = $this->request->getGet('date_debut');
        $dateFin   = $this->request->getGet('date_fin');

        $builder = $this->model
            ->select('types_operation.libelle as type_libelle, SUM(transactions.frais) as total_frais, COUNT(*) as nb_operations')
            ->join('types_operation', 'types_operation.id = transactions.type_operation_id')
            ->whereIn('types_operation.code', ['retrait', 'transfert']);

        if ($dateDebut) {
            $builder->where('transactions.date_operation >=', $dateDebut . ' 00:00:00');
        }
        if ($dateFin) {
            $builder->where('transactions.date_operation <=', $dateFin . ' 23:59:59');
        }

        $data['gains']      = $builder->groupBy('types_operation.libelle')->findAll();
        $data['date_debut'] = $dateDebut;
        $data['date_fin']   = $dateFin;

        return view('gain/GainIndex', $data);
    }
}