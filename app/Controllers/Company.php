<?php

namespace App\Controllers;

use App\Models\BuilderModel;
use App\Models\CompanyModel;


class Company extends BaseController
{
    protected $companyModel;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
    }

    public function index()
    {
        $company = $this->companyModel->findAll();

        $data = [
            'title' => 'Company',
            'company' => $company
        ];

        return view('company/index', $data);
    }

    public function add_data()
    {
        //Cek Validasi
        if (!$this->validate([
            'companyid' => 'required',
            'companyname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required'
        ])) {
            //Jika Tidak Tervalidasi
            session()->setFlashData('failed', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        //Kalau Lolos Validasi
        //1. Masukkan Ke Database
        $this->companyModel->insert([
            'COMPANYID' => $this->request->getVar('companyid'),
            'COMPANYNAME' => $this->request->getVar('companyname'),
            'ADDRESS' => $this->request->getVar('address'),
            'CITY' => $this->request->getVar('city'),
            'PROVINCE' => $this->request->getVar('province')
        ]);
        session()->setFlashData('success', 'data has been updated from database');
        return redirect()->to('/company');
    }

    public function update_data($id)
    {
        //Cek Validasi
        if (!$this->validate([
            'companyid' => 'required',
            'companyname' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required'
        ])) {
            //Jika Tidak Tervalidasi
            session()->setFlashData('failed', \Config\Services::validation()->getErrors());
            return redirect()->back()->withInput();
        }

        //Jika Tervalidasi
        //Update Data Company
        if ($this->companyModel->update($id, [
            'COMPANYID' => $this->request->getVar('companyid'),
            'COMPANYNAME' => $this->request->getVar('companyname'),
            'ADDRESS' => $this->request->getVar('address'),
            'CITY' => $this->request->getVar('city'),
            'PROVINCE' => $this->request->getVar('province')
        ])) {
            session()->setFlashData('success', 'data has been updated from database');
            return redirect()->to('/company');
        }
    }

    public function delete_data($id)
    {
        if ($this->companyModel->delete($id)) {
            session()->setFlashData('success', 'data has been updated from database');
            return redirect()->to('/company');
        }
    }
}
