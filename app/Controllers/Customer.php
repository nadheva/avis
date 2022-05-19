<?php

namespace App\Controllers;
use App\Models\ProjectModel;
use App\Models\AdminModel;
use App\Models\CustModel;

class Customer extends BaseController
{
	/**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $db, $builder, $adminmodel;
    public function __construct()
    {
        $this->projectModel = new ProjectModel();
        $this->custModel = new CustModel();
        $this->adminModel = new AdminModel();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $this->builder = $this->db->table('customer');
        $query = $this->builder->get();
        $data = [
            'tittle' => 'Customer list',
            'active_menu' => 'project',
            'customer' => $query->getResult(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];

        // return view('user/customer', $data);
        return view('project/project', $data);
    }
    
    public function editcust($id)
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Failed! Please login!');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $data = [
            'tittle' => 'Edit Customer',
            'active_menu' => 'project',
            'validation' => \Config\Services::validation(),
            'customer' => $this->custModel->getCust($id),
            'notif' => $this->adminModel->getNotif()
        ];

        return view('user/editcust', $data);
    }
    
    public function updatecust($id = 0)
    {
        // dd($this->request->getVar('type'));
        $this->custModel->save([
            'id' => $id,
            'customer_name' => $this->request->getVar('customer_name'),
            'type' => $this->request->getVar('type'),
        ]);
        session()->setFlashData('pesan', 'Success! Customer has been change');
        return redirect()->to('/project');
    }

    public function addcust()
    {
        if (!$this->validate([
            'customer_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Customer required field');
            return redirect()->to('/customer')->withInput();
        };
        $this->custModel->save([
            'customer_name' => $this->request->getVar('customer_name'),
        ]);
        session()->setFlashData('pesan', 'Success! new customer has been created');
        return redirect()->to('/customer');
    }


    public function delcus($id = null)
    {
        $model = new CustModel();
        $data['project'] = $model->where('id', $id)->delete();
        session()->setFlashData('pesan', 'Customer has been deleted ✓');
        return redirect()->to(base_url('customer'));
    }
}