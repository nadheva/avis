<?php

namespace App\Controllers;
use App\Models\ModelModel;
use App\Models\BaanModel;
use App\Models\BomModel;
use App\Models\LogModel;
use App\Models\AdminModel;

class Bom extends BaseController
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
        $this->modelModel = new ModelModel();
        $this->adminModel = new AdminModel();
        $this->bomModel = new BomModel();
        $this->baanModel = new BaanModel();
        $this->logModel = new LogModel();
        $this->db      = \Config\Database::connect();
    }

	public function index()
	{
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        $this->builder = $this->db->table('bom_log');
        $this->builder->select('bom_log.id, fullname, section, model.model, file, date');
        $this->builder->join('users', 'bom_log.user = users.id');
        $this->builder->join('model', 'bom_log.model = model.id');
        $this->builder->orderBy('date', 'DESC');
        $log = $this->builder->get();
        $this->builder = $this->db->table('model');
        $model = $this->builder->get();
        $approve = $this->bomModel->getApproveBom();
        $approvebaan = $this->baanModel->getApproveBaan();
        $changestatus = $this->bomModel->getChangeStatusBom();
        $myapprove = $this->bomModel->getApproveBom(user()->id);
        $myapprovebaan = $this->baanModel->getApproveBaan(user()->id);
        $myapprovestat = $this->bomModel->getChangeStatusBom(user()->id);
        // dd($myapprovebaan,$approvebaan);
        $data = [
            'tittle' => 'Bill Of Materials',
			'active_menu' => 'bom',
            'model' => $model->getResult(),
            'changestatus' => $changestatus,
            'approve' => $approve,
            'myapprove' => $myapprove,
            'approvebaan' => $approvebaan,
            'myapprovebaan' => $myapprovebaan,
            'myapprovestat' => $myapprovestat,
            'log' => $log->getResult(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('bom/index', $data);
	}

    public function model($id = NULL) 
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        $this->builder = $this->db->table('model');
        $this->builder->where('id', $id);
        $model = $this->builder->get();
        $data = [
            'tittle' => 'File list BOM & BAAN',
			'active_menu' => 'bom',
            'bom' => $this->bomModel->getBomFilebyModel($id),
            'baan' => $this->baanModel->getBaanFilebyModel($id),
            'type' => $this->bomModel->getType(),
            'approve' => $this->bomModel->getApproveBom(),
            'approvebaan' => $this->baanModel->getApproveBaan(),
            'model' => $model->getRow(),
            'finance' => $this->baanModel->getApprovalFinance(),
            'purchasing' => $this->baanModel->getApprovalPurchasing(),
            'eng' => $this->baanModel->getApprovalEng(),
            'req' => $this->baanModel->getApprovalReq(),
            'rnd' => $this->baanModel->getApprovalRnD(),
            'sectHeadEngSmt' => $this->baanModel->getApprovalSectHeadEngSmt(),
            'sectHeadEngFa' => $this->baanModel->getApprovalSectHeadEngFa(),
            'sectHeadEngAt' => $this->baanModel->getApprovalSectHeadEngAt(),
            'marketing' => $this->baanModel->getApprovalMarketing(),
            'ppic' => $this->baanModel->getApprovalPpic(),
            'finance' => $this->baanModel->getApprovalFinance(),
            'finance' => $this->baanModel->getApprovalFinance(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        //dd($this->baanModel->getApprovalSectHeadEng());
 		return view('bom/model', $data);
    }

    public function editmodel($id = NULL) 
    {
        $this->builder = $this->db->table('model');
        $this->builder->where('id', $id);
        $model = $this->builder->get();
        $data = [
            'tittle' => 'Edit Model BOM',
			'active_menu' => 'bom',
            'model' => $model->getRow(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('bom/editmodel', $data);
    }

    public function editfile($id = NULL) 
    {
        if(!isset(user()->id)){ return redirect('login'); }
        $this->builder = $this->db->table('bom_file');
        $this->builder->select('bom_file.id, nama_file, status, id_model, model');
        $this->builder->join('model', 'model.id = bom_file.id_model');
        $this->builder->where('bom_file.id', $id);
        $file = $this->builder->get();
        // dd($file->getResult());
        $data = [
            'tittle' => 'Edit File BOM',
			'active_menu' => 'bom',
            'file' => $file->getRow(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('bom/editfile', $data);
    }

    public function updatemodel($id = NULL)
    {
        $data = [
            'model' => $this->request->getVar('model'),
        ];
        $this->builder = $this->db->table('model');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashData('pesanmodel', 'Success! model has been updated');
        return redirect()->to('/bom');
    }

    public function updatefile($id = NULL)
    {
        $idm = $this->request->getVar('id_model');
        $uap = $this->request->getVar('uap');
        $status = $this->request->getVar('status');
        $status_lama = $this->request->getVar('status_lama');
        $reason = $this->request->getVar('reason');
        // dd($status, $status_lama);
        if($status != $status_lama) {
            $data = [
                'status' => 'Waiting Approve',
            ];
            $this->builder = $this->db->table('bom_file');
            $this->builder->where('id', $id);
            $this->builder->update($data);
            $data = [
                'id_bom' => $id,
                'request_status' => $status,
                'user_approval' => $uap,
                'reason' => $reason,
                'approve' => 1,
            ];
            $this->db->table('bom_approval_status')->insert($data);
            session()->setFlashData('pesan', 'Success! status file is waiting approval!');
            return redirect()->to('bom/model/'.$idm);
        }
        session()->setFlashData('pesan', 'Status file is not changed!');
        return redirect()->to('bom/model/'.$idm);
    }

    public function addmodel()
    {
        if (!$this->validate([
            'model' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ]
        ])) {
            session()->setFlashData('error', 'Failed! model name is required field');
            return redirect()->to('/bom')->withInput();
        };
        // dd($this->request->getVar('model'));
        $this->modelModel->save([
            'model' => $this->request->getVar('model'),
        ]);
        if (!is_dir('public/theme/assets/bom/'.$this->request->getVar('model'))){
            mkdir('public/theme/assets/bom/'.$this->request->getVar('model'));
        }
        session()->setFlashData('pesanmodel', 'Success! new model has been created');
        return redirect()->to('/bom');
    }

    public function addbomfile()
    {
        $uap = $this->request->getVar('uap');
        $route = $this->request->getVar('route');
        $file = $this->request->getFile('fileapp');
        $model = $this->request->getVar('model');
        $id_model = $this->request->getVar('id_model');
        $notes_file = $this->request->getVar('notes');
        // dd($file);
        if(!$this->validate([
            'fileapp' => [
                'uploaded[fileapp]',
                'mime_in[fileapp,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]',
                'max_size[fileapp,10000]',
            ],
            'notes' => [
                'required',  
            ]
        ])) {
            session()->setFlashData('error', 'Failed! file type not supported');
            return redirect()->to('bom/model/'.$id_model)->withInput();
        }
        if ($file->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $file->getName();
            $file->move('public/theme/assets/bom/'.$model, $nama);
        }
        // dd($this->request->getVar('model'));
        $this->bomModel->save([
            'id_model' => $id_model,
            'nama_file' => $nama,
            'status' => 'Waiting Approve',
            'notes' => $notes_file,
            'upload_date' => date('Y-m-d', time()),
            'approve' => 1,
            'approve_status' => 1,
            'uploader' => user()->id,
        ]);
        $b_id = $this->bomModel->getInsertID();
        for($x=0;$x<2;$x++){
            $data = [
                'id_bom' => $b_id,
                'user_approval' => $uap[$x],
                'routes' => $route[$x],
                'notes' => NULL,
                'approve' => $route[$x],
            ];
            $this->db->table('bom_approval')->insert($data);
        }
        if (!is_dir('public/theme/assets/bom/'.$this->request->getVar('model'))){
            mkdir('public/theme/assets/bom/'.$this->request->getVar('model'));
        }
        session()->setFlashData('pesan', 'Success! new file has been created');
        return redirect()->to('/bom/model/'.$id_model);
    }
    
    public function addbaanfile()
    {
        $uap = $this->request->getVar('uap');
        $route = $this->request->getVar('route');
        $file = $this->request->getFile('fileapp');
        $model = $this->request->getVar('model');
        $id_model = $this->request->getVar('id_model');
        $notes_file = $this->request->getVar('notes');
        // dd($uap, $route, $file, $model, $id_model, $notes_file);
        if(!$this->validate([
            'fileapp' => [
                'uploaded[fileapp]',
                'mime_in[fileapp,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]',
                'max_size[fileapp,10000]',
            ],
            'notes' => [
                'required',  
            ]
        ])) {
            session()->setFlashData('error', 'Failed! file type not supported');
            return redirect()->to('bom/model/'.$id_model)->withInput();
        }
        if ($file->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $file->getName();
            $file->move('public/theme/assets/baan/'.$model, $nama);
        }
        // dd($this->request->getVar('model'));
        $this->baanModel->save([
            'id_model' => $id_model,
            'type_id' => $this->request->getVar('type'),
            'filename' => $nama,
            'status' => 'Waiting Approve',
            'description' => $notes_file,
            'upload_date' => date('Y-m-d', time()),
            'approve' => 1,
            'approve_status' => 1,
            'uploader' => user()->id,
        ]);
        $b_id = $this->baanModel->getInsertID();
        for($x=0;$x<count($route);$x++){
            $data = [
                'id_baan' => $b_id,
                'user_approval' => $uap[$x],
                'routes' => $route[$x],
                'notes' => NULL,
                'approve' => $route[$x],
            ];
            $this->db->table('baan_approval')->insert($data);
        }
        if (!is_dir('public/theme/assets/baan/'.$this->request->getVar('model'))){
            mkdir('public/theme/assets/baan/'.$this->request->getVar('model'));
        }
        session()->setFlashData('pesan', 'Success! new file baan has been created');
        return redirect()->to('/bom/model/'.$id_model);
    }
    
    public function delbomfile($id = null, $idm = null)
    {
        $this->bomModel->where('id', $id)->delete();
        session()->setFlashData('pesan', 'Bom file has been deleted ✓');
        return redirect()->to(base_url('bom/model/'.$idm));
    }
    
    public function delbaanfile($id = null, $idm = null)
    {
        $namafile = $this->db->table('baan_file')->where('id', $id)->get()->getRow()->filename;
        $model = $this->db->table('model')->where('id', $idm)->get()->getRow()->model;
        // dd($namafile,$model);
        $this->bomModel->where('id', $id)->delete();
        $path = "./public/theme/assets/baan/".$model."/".$namafile;
        unlink($path);
        session()->setFlashData('pesan', 'Baan file has been deleted ✓');
        return redirect()->to(base_url('bom/model/'.$idm));
    }
    
    public function delmodel($id = null)
    {
        $this->builder = $this->db->table('bom_log');
        $this->builder->delete(['model' => $id]);
        $this->modelModel->where('id', $id)->delete();
        session()->setFlashData('pesanmodel', 'Bom model has been deleted ✓');
        return redirect()->to(base_url('bom'));
    }
    
    public function delbomlog($id = null)
    {
        $this->builder = $this->db->table('bom_log');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesanlog', 'Bom log has been deleted ✓');
        return redirect()->to(base_url('bom'));
    }

    public function download($id = null, $idm = null)
    {
        $this->builder = $this->db->table('bom_file');
        $this->builder->where('id', $id);
        $bom = $this->builder->get();
        $this->builder = $this->db->table('model');
        $this->builder->where('id', $idm);
        $model = $this->builder->get();
        $model = $model->getRow()->model;
        $file = $bom->getRow()->nama_file;
        $this->builder = $this->db->table('bom_log');
        $this->builder->where('user', user()->id);
        $log = $this->builder->get();
        $log = $log->getResult();
        foreach ($log as $l){
            $mdl[] = $l->model;
            $fl[] = $l->file;
        }
        // dd($mdl,$fl,$idm,$file);
        if(isset($mdl)){
            if(in_array($idm,$mdl) && in_array($file,$fl)) {
                return $this->response->download('public/theme/assets/bom/'.$model.'/'.$file, null);
            }
        }
        $this->logModel->save([
            'model' => $idm,
            'user' => user()->id,
            'date' => date('Y-m-d H:i:s'),
            'file' => $file,
        ]);
        return $this->response->download('public/theme/assets/bom/'.$model.'/'.$file, null);
    }

    public function baandownload($project_name = null, $filename = null)
    {
        return $this->response->download('public/theme/assets/baan/'.$project_name.'/'.$filename, null);
    }

    public function accbom($id)
    {
        $id_bom = $this->request->getVar('idbom');
        $reject = $this->request->getVar('reject');
        $approve = $this->request->getVar('approve');
        $notes = $this->request->getVar('notes');
        $newfile = $this->request->getFile('new_file');
        $oldfile = $this->request->getVar('old_file');
        $model = $this->request->getVar('model');
        // dd($newfile,$oldfile);
        if(!$this->validate([
            'new_file' => [
                'uploaded[new_file]',
                'mime_in[new_file,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]',
                'max_size[new_file,15000]',
            ],
            'notes' => [
                'required',  
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Please upload file bom approve or add notes');
            return redirect()->to('bom')->withInput();
        }
        $path = "./public/theme/assets/bom/".$model."/".$oldfile;
        unlink($path);
        if ($newfile->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $newfile->getName();
            $newfile->move('public/theme/assets/bom/'.$model, $nama);
        }
        if(isset($reject)) {
            $stat = 'Rejected';
            $approve = 404;
            $data = [
            'approve' => $approve,
            'status' => $stat,
            'nama_file' => $nama,
            ];
            $this->builder = $this->db->table('bom_file');
            $this->builder->where('id', $id_bom);
            $this->builder->update($data);  
            session()->setFlashData('pesanapprove', 'Success rejected bom file ✓');
            return redirect()->to(base_url('bom'));
        }
        if(isset($approve)) {
            if($this->request->getVar('status') == 'Waiting Approve'){
                $stat = 'Approve 1';
                $approve = 2;
            } else {
                $stat = 'active';
                $approve = 3;
            }
            $data = [
                'approve' => $approve,
                'status' => $stat,
                'nama_file' => $nama,
            ];
            $this->builder = $this->db->table('bom_file');
            $this->builder->where('id', $id_bom);
            $this->builder->update($data);  
            $data = [
                'approve' => 202,
                'notes' => $notes,
            ];
            $this->builder = $this->db->table('bom_approval');
            $this->builder->where('id', $id);
            $this->builder->update($data);  
            session()->setFlashData('pesanapprove', 'Success approve bom file ✓');
            return redirect()->to(base_url('bom'));
        }
    }

    public function accbaan($id)
    {
        $id_baan = $this->request->getVar('idbaan');
        $reject = $this->request->getVar('reject');
        $approve = $this->request->getVar('approve');
        $notes = $this->request->getVar('notes');
        $newfile = $this->request->getFile('new_file');
        $oldfile = $this->request->getVar('old_file');
        $model = $this->request->getVar('model');
        $approve_number = $this->request->getVar('approve_number');
        $this->builder = $this->db->table('baan_approval')->select('approve')->where('id_baan', $id_baan);
        $arrApp = $this->builder->get();
        $arrApp = $arrApp->getResult();
        foreach($arrApp as $row) {
            $newArrApp[] = $row->approve;
        }
        // dd($approve, $reject, $id_baan, $id, $model,$approve_number,$newArrApp);
        if(!$this->validate([
            'new_file' => [
                'uploaded[new_file]',
                'mime_in[new_file,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]',
                'max_size[new_file,15000]',
            ],
            'notes' => [
                'required',  
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Please upload file baan approve or add notes');
            return redirect()->to('bom')->withInput();
        }
        $path = "./public/theme/assets/baan/".$model."/".$oldfile;
        unlink($path);
        if ($newfile->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $newfile->getName();
            $newfile->move('public/theme/assets/baan/'.$model, $nama);
        }
        if(isset($reject)) {
            if($approve_number == 1){
                // $stat = 'Waiting Approve';
                $approve = $approve_number;
                $idapproval = $id;
            } else {
                // $stat = 'Approve '.($approve_number-1);
                $approve = $approve_number-1;
                $idapproval = $id-1;
            }
            $data = [
                'approve' => $approve,
                'status' => 'Revise',
                'filename' => $nama,
            ];
            $this->builder = $this->db->table('baan_file');
            $this->builder->where('id', $id_baan);
            $this->builder->update($data);  
            $data = [
                'approve' => $approve,
            ];
            $this->builder = $this->db->table('baan_approval');
            $this->builder->where('id', $idapproval);
            $this->builder->update($data);
            $data = [
                'notes' => $notes,
                'approve' => 404,
                'approve_status' => 404,
            ];
            $this->builder = $this->db->table('baan_approval');
            $this->builder->where('id', $id);
            $this->builder->update($data);
            session()->setFlashData('pesanapprove', 'Success revise baan file ✓');
            return redirect()->to(base_url('bom'));
        }
        if(isset($approve)) {
            if(in_array(($approve_number+1),$newArrApp)){
                $stat = 'Approve '.$approve_number;
            } else {
                $stat = 'active';
            }
            $data = [
                'approve' => $approve_number+1,
                'status' => $stat,
                'filename' => $nama,
            ];
            $this->builder = $this->db->table('baan_file');
            $this->builder->where('id', $id_baan);
            $this->builder->update($data);  
            $data = [
                'approve_status' => 202,
                'notes' => $notes,
            ];
            $this->builder = $this->db->table('baan_approval');
            $this->builder->where('id', $id);
            $this->builder->update($data);  
            session()->setFlashData('pesanapprove', 'Success approve baan file ✓');
            return redirect()->to(base_url('bom'));
        }
    }

    public function revisebaan($id)
    {
        $description = $this->request->getVar('description');
        $newfile = $this->request->getFile('new_file');
        $oldfile = $this->request->getVar('old_file');
        $model = $this->request->getVar('model');
        $id_model = $this->request->getVar('id_model');
        // dd($id,$newfile,$description,$oldfile);
        $this->builder = $this->db->table('baan_approval')->where('id_baan', $id)->orderBy('id', 'ASC');
        $idapproval = $this->builder->get()->getRow()->id;
        // dd($idapproval,$id_model);
        if(!$this->validate([
            'new_file' => [
                'uploaded[new_file]',
                'mime_in[new_file,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]',
                'max_size[new_file,15000]',
            ],
            'description' => [
                'required',  
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Please upload file baan approve or add description');
            return redirect()->to('bom')->withInput();
        }
        $path = "./public/theme/assets/baan/".$model."/".$oldfile;
        unlink($path);
        if ($newfile->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $newfile->getName();
            $newfile->move('public/theme/assets/baan/'.$model, $nama);
        }
        $data = [
            'status' => 'Waiting Approve',
            'description' => $description,
            'filename' => $nama,
        ];
        $this->builder = $this->db->table('baan_file');
        $this->builder->where('id', $id);
        $this->builder->update($data); 
        $data = [
            'approve_status' => 1,
            'approve' => 1,
        ];
        $this->builder = $this->db->table('baan_approval');
        $this->builder->where('id', $idapproval);
        $this->builder->update($data);  
        session()->setFlashData('pesan', 'Success update baan file ✓');
        return redirect()->to('/bom/model/'.$id_model);
    }

    public function accreqstatus($id){
        $id_bom = $this->request->getVar('idbom');
        $reject = $this->request->getVar('reject');
        $approve = $this->request->getVar('approve');
        $req_status = $this->request->getVar('req_status');
        if(isset($reject)) {
            $stat = 'Rejected';
            $approve = 404;
            $data = [
            'approve' => $approve,
            'status' => $stat,
            ];
            $this->builder = $this->db->table('bom_file');
            $this->builder->where('id', $id_bom);
            $this->builder->update($data);  
            session()->setFlashData('pesanapprove', 'Success rejected bom file ✓');
            return redirect()->to(base_url('bom'));
        }
        if(isset($approve)) {
            $data = [
                'approve' => 3,
                'status' => $req_status,
            ];
            $this->builder = $this->db->table('bom_file');
            $this->builder->where('id', $id_bom);
            $this->builder->update($data);  
            $data = [
                'approve' => 202,
            ];
            $this->builder = $this->db->table('bom_approval_status');
            $this->builder->where('id', $id);
            $this->builder->update($data);  
            session()->setFlashData('pesanapprove', 'Success approve change status bom file ✓');
            return redirect()->to(base_url('bom'));
        }
    }
}
