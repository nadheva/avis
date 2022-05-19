<?php

namespace App\Controllers;
use App\Models\EngchangeModel;
use App\Models\EngchangeRequestModel;
use App\Models\AdminModel;

class Engchange extends BaseController
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
        $this->engchangeModel = new EngchangeModel();
        $this->adminModel = new AdminModel();
        $this->engchangerequestModel = new EngchangeRequestModel();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $this->builder = $this->db->table('project');
        $this->builder->select('customer_name, project_name, project.id');
        $this->builder->join('customer', 'customer.id = project.cust_id');
        $query = $this->builder->get();
        $getDeptHeadQuality = $this->engchangeModel->getDeptHeadQuality();
        $getSectHeadEng = $this->engchangeModel->getSectHeadEng();
        $getSectHeadEhs = $this->engchangeModel->getSectHeadEhs();
        $getUserDeptQuality = $this->engchangeModel->getUserDeptQuality();
        $getUserApprovalEngchange = $this->engchangerequestModel->getUserApprovalEngchange();
        // dd($getSectHeadEhs);
        $data = [
            'tittle' => 'Engineering Change',
            'active_menu' => 'eng',
			'atasan' => $this->engchangeModel->getAtasan(),
			'request' => $this->engchangeModel->getRequest(),
            'project' => $query->getResult(),
			'deptheadquality' => $getDeptHeadQuality,
			'userdeptquality' => $getUserDeptQuality,
			'UserApprovalEngchange' => $getUserApprovalEngchange,
			'usersectheadeng' => $getSectHeadEng,
			'usersectheadehs' => $getSectHeadEhs,
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];

        return view('engchange/index', $data);
    }
    
    public function ajax_request_id($id) {
        $data = $this->engchangeModel->getRequestbyId($id);
        echo json_encode($data);
    }


    public function fourm($idp=NULL)
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $this->builder = $this->db->table('project');
        $this->builder->where('id', $idp);
        $projectrow = $this->builder->get()->getRow();
        $getFourm = $this->engchangeModel->getFourm();
        $data = [
            'tittle' => '4M Change Request',
			'active_menu' => 'eng',
			'fourm' => $getFourm,
			'projectrow' => $projectrow,
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('engchange/fourm', $data);
    }
    
    public function list($idp=NULL, $id = NULL) 
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $this->builder = $this->db->table('project');
        $projectrow = $this->builder->get()->getRow();
        $getFourm = $this->engchangeModel->getFourm($id);
        $getRequest = $this->engchangeModel->getRequest($idp,$id);
        $getAtasan = $this->engchangeModel->getAtasan();
        $getDeptHeadQuality = $this->engchangeModel->getDeptHeadQuality();
        $getSectHeadEng = $this->engchangeModel->getSectHeadEng();
        $getUserDeptQuality = $this->engchangeModel->getUserDeptQuality();
        $getUserApprovalEngchange = $this->engchangerequestModel->getUserApprovalEngchange();
        $data = [
            'tittle' => '4M Change Request List',
            'active_menu' => 'eng',
			'projectrow' => $projectrow,
			'fourmrow' => $getFourm,
			'request' => $getRequest,
			'atasan' => $getAtasan,
			'deptheadquality' => $getDeptHeadQuality,
			'userdeptquality' => $getUserDeptQuality,
			'UserApprovalEngchange' => $getUserApprovalEngchange,
			'usersectheadeng' => $getSectHeadEng,
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        // dd($getUserApprovalEngchange);
        return view('engchange/list', $data);
    }

    public function deleterequest($req_id=null)
    {
        $routes = $this->request->getVar('routes');
        $idapp = $this->request->getVar('idapp');
        // dd($routes,$idapp,$req_id);
        for($x=0;$x<count($routes);$x++){
            $this->builder = $this->db->table('engchange_approval');
            $this->builder->delete(['id' => $idapp[$x]]);
        }
        $this->builder = $this->db->table('engchange_request');
        $this->builder->delete(['id'=> $req_id]);
        session()->setFlashData('pesan', 'Success! delete 4m change request ✓');
        return redirect()->to(base_url('/user/dashboard'));
    }

    public function addrequest()
    {
        $fourm_id = $this->request->getVar('fourm_id');
        $fourm = $this->request->getVar('fourm');
        $reason = $this->request->getVar('reason');
        $line = $this->request->getVar('line');
        $project_id = $this->request->getVar('project_id');
        $project_name = $this->request->getVar('project');
        $description = $this->request->getVar('description');
        $lau = $this->request->getVar('lau');
        $route_num = $this->request->getVar('route_num');
        $file = $this->request->getFile('file');
        // dd($project_name);
        if ($file->getError() == 4) {
            $filename = NULL;
        } else {
            $filename = $file->getName();
            // if (!is_dir('public/theme/assets/4m change request/'.$project_name.'/'.$fourm)){
            //     if(!is_dir('public/theme/assets/4m change request/'.$project_name)){
            //         mkdir('public/theme/assets/4m change request/'.$project_name);
            //     }
            //     mkdir('public/theme/assets/4m change request/'.$project_name.'/'.$fourm);
            // }
            $file->move('public/theme/assets/4m change request/');
        }
        foreach ($lau as $l){
            if($l != '--Choose--') {
                $au[] = $l;
            }
        }
        foreach ($route_num as $l){
            if($l != '-') {
                $rn[] = $l;
            }
        }
        if (count($au) != count($rn)){
            session()->setFlashData('error', 'Failed! Please input user approval');
            return redirect()->to('engchange')->withInput();
        }
        $this->engchangerequestModel->save([
            'project_id' => $project_id,
            'fourm_id' => $fourm_id,
            'reason' => $reason,
            'line' => $line,
            'file' => $filename,
            'description' => $description,
            'created_at' => date("Y-m-d", time()),
            'issuer' => user()->id,
            'status' => 'Waiting Approve',
            'approve' => 1,
        ]);
        if (isset($au) && isset($rn)) {
            $req_id = $this->engchangerequestModel->getInsertID();
            $jumlah_dipilih = count($au);
            for($x=0;$x<$jumlah_dipilih;$x++){
                $data = [
                    'req_id' => $req_id,
                    'approve_user' => $au[$x],
                    'update_date' => NULL,
                    'approve' => $rn[$x],
                    'routes' => $rn[$x],
                ];
                $this->db->table('engchange_approval')->insert($data);
            }
        }
        session()->setFlashData('pesan', 'Success! new request has been created ✓');
        return redirect()->to(base_url('engchange'));
    }

    public function accrequest($req_id=null)
    {
        $reject = $this->request->getVar('reject');
        $a_id = $this->request->getVar('approve_id');
        $status = $this->request->getVar('status');
        $notesmgr = $this->request->getVar('notesmgr');
        $testresult_eng = $this->request->getVar('testresult_eng');
        $acknowledge_ehs = $this->request->getVar('acknowledge_ehs');
        $confirm_quality = $this->request->getVar('confirm_quality');
        $notes_dhqa = $this->request->getVar('notes_dhqa');
        $notes_mkt = $this->request->getVar('notes_mkt');
        $approve_number = $this->request->getVar('approve_number');
        $atc = $this->request->getVar('atc');
        // dd($a_id, $req_id, $status,$acknowledge_ehs, $atc);
        if(!$this->validate([
            'notesmgr' => [ 'required'
        ],
        ])) {
            session()->setFlashData('error', 'Failed! Please add notes');
            return redirect()->to('user/dashboard')->withInput();
        }
        if (isset($reject)) {
            $dataApp = [
                'approve' => 0,
                'update_date' => date('Y-m-d', time())
            ];
            $this->builder = $this->db->table('engchange_approval');
            $this->builder->where('id', $a_id);
            $this->builder->update($dataApp);
            $this->engchangerequestModel->save([
                'id' => $req_id,
                'status' => 'Revise',
                'notesmgr' => $notesmgr,
                'testresult_eng' => $testresult_eng,
                'acknowledge_ehs' => $acknowledge_ehs,
                'confirm_quality' => $confirm_quality,
                'notes_dhqa' => $notes_dhqa,
                'notes_mkt' => $notes_mkt,
            ]);
            session()->setFlashData('pesan', 'Success revise 4m request ✓');
            return redirect()->to(base_url('user/dashboard'));
        }
        $approve = $this->request->getVar('approve');
        if (isset($approve)) {
            if($atc == 'Yes') {
                $data = [
                    'req_id' => $req_id,
                    'approve_user' => 37,
                    'approve' => 6,
                    'routes' => 6,
                ];
                $this->db->table('engchange_approval')->insert($data);
                $dataApp = [
                    'approve' => 202,
                    'update_date' => date('Y-m-d', time()),
                ];
                $this->builder = $this->db->table('engchange_approval');
                $this->builder->where('id', $a_id);
                $this->builder->update($dataApp);
                $this->engchangerequestModel->save([
                    'id' => $req_id,
                    'status' => 'Approve 5',
                    'approve' => 6,
                    'to_customer' => $atc,
                    'notes_dhqa' => $notes_dhqa
                ]);
                session()->setFlashData('pesan', 'Success approve 4M change request ✓');
                return redirect()->to(base_url('user/dashboard'));
            } else if ($atc == 'No') {
                if($status == 'Waiting Approve'){
                    $newstat = 'Approve 1';
                    $statusnum = 2;
                } else if ( $status == 'Approve 4') {
                    $newstat = 'Done';
                    $statusnum = 6;
                } else {
                    $statusnum = $approve_number + 1;
                    $num = substr($status,-1) + 1;
                    $newstat = 'Approve ' . $num;
                }
                $this->engchangerequestModel->save([
                    'id' => $req_id,
                    'notesmgr' => $notesmgr,
                    'status' => $newstat,
                    'approve' => $statusnum,
                    'testresult_eng' => $testresult_eng,
                    'acknowledge_ehs' => $acknowledge_ehs,
                    'confirm_quality' => $confirm_quality,
                    'notes_dhqa' => $notes_dhqa,
                    'to_customer' => $atc,
                    'notes_mkt' => $notes_mkt
                ]);
                $dataApp = [
                    'approve' => 202,
                    'update_date' => date('Y-m-d', time()),
                ];
                $this->builder = $this->db->table('engchange_approval');
                $this->builder->where('id', $a_id);
                $this->builder->update($dataApp);
                session()->setFlashData('pesan', 'Success approve 4M change request ✓');
                return redirect()->to(base_url('user/dashboard'));
            }
            if(!isset($atc)) {
                if($status == 'Waiting Approve'){
                    $newstat = 'Approve 1';
                    $statusnum = 2;
                } else if ( $status == 'Approve 4') {
                    $newstat = 'Done';
                    $statusnum = 6;
                } else if ($status == 'Approve 5') {
                    $newstat = 'Done';
                    $statusnum = 7;
                } else {
                    $statusnum = $approve_number + 1;
                    $num = substr($status,-1) + 1;
                    $newstat = 'Approve ' . $num;
                }
                // dd($newstat);
                $this->engchangerequestModel->save([
                    'id' => $req_id,
                    'notesmgr' => $notesmgr,
                    'status' => $newstat,
                    'approve' => $statusnum,
                    'testresult_eng' => $testresult_eng,
                    'acknowledge_ehs' => $acknowledge_ehs,
                    'confirm_quality' => $confirm_quality,
                    'notes_dhqa' => $notes_dhqa,
                    'notes_mkt' => $notes_mkt
                ]);
                $dataApp = [
                    'approve' => 202,
                    'update_date' => date('Y-m-d', time()),
                ];
                $this->builder = $this->db->table('engchange_approval');
                $this->builder->where('id', $a_id);
                $this->builder->update($dataApp);
                session()->setFlashData('pesan', 'Success approve 4M change request ✓');
                return redirect()->to(base_url('user/dashboard'));
            }
        }
    }
}