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
            ->select('types_operation.libelle as type_libelle, SUM(transactions.frais - transactions.commission_interoperateur) as total_frais_operateur, SUM(transactions.commission_interoperateur) as total_commissions, COUNT(*) as nb_operations')
            ->join('types_operation', 'types_operation.id = transactions.type_operation_id')
            ->whereIn('types_operation.code', ['retrait', 'transfert']);

        if ($dateDebut) {
            $builder->where('transactions.date_operation >=', $dateDebut . ' 00:00:00');
        }
        if ($dateFin) {
            $builder->where('transactions.date_operation <=', $dateFin . ' 23:59:59');
        }

        $data['gains']      = $builder->groupBy('types_operation.libelle')->findAll();

        $commissionBuilder = $this->model
            ->select('operateurs.nom as operateur_nom, SUM(transactions.commission_interoperateur) as total_commission, COUNT(*) as nb_transferts')
            ->join('operateurs', 'operateurs.id = transactions.operateur_destination_id')
            ->where('transactions.commission_interoperateur >', 0);

        if ($dateDebut) {
            $commissionBuilder->where('transactions.date_operation >=', $dateDebut . ' 00:00:00');
        }
        if ($dateFin) {
            $commissionBuilder->where('transactions.date_operation <=', $dateFin . ' 23:59:59');
        }

        $data['commissions'] = $commissionBuilder->groupBy('operateurs.id, operateurs.nom')->findAll();
        $data['date_debut'] = $dateDebut;
        $data['date_fin']   = $dateFin;

        return view('gain/GainIndex', $data);
    }
}
