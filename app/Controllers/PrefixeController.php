<?php

    namespace App\Controllers;

    use App\Models\PrefixeModel;

    class PrefixeController extends BaseController
    {
        protected $model;

        public function __construct()
        {
            $this->model = new PrefixeModel();
        }

        public function index()
        {
            $data['prefixes'] = $this->model->findAll();
            return view('prefixe/index', $data);
        }

        public function new()
        {
            return view('prefixe/create');
        }

        public function create()
        {
            $this->model->insert([
                'prefixe' => $this->request->getPost('prefixe'),
                'libelle' => $this->request->getPost('libelle'),
            ]);
            return redirect()->to('/prefixe');
        }

        public function edit($id)
        {
            $data['prefixe'] = $this->model->find($id);
            return view('prefixe/edit', $data);
        }

        public function update($id)
        {
            $this->model->update($id, [
                'prefixe' => $this->request->getPost('prefixe'),
                'libelle' => $this->request->getPost('libelle'),
            ]);
            return redirect()->to('/prefixe');
        }

        public function delete($id)
        {
            $this->model->delete($id);
            return redirect()->to('/prefixe');
        }


    }