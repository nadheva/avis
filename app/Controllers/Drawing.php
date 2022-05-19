<?php

namespace App\Controllers;
use App\Models\ModelModel;
use App\Models\AdminModel;
class Drawing extends BaseController
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
        $this->db      = \Config\Database::connect();
    }

	public function index()
	{
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        $this->builder = $this->db->table('dwg_log');
        $this->builder->select('dwg_log.id, fullname, section, dwg_model.model, file, date');
        $this->builder->join('users', 'dwg_log.user = users.id');
        $this->builder->join('dwg_model', 'dwg_log.model = dwg_model.id');
        $this->builder->orderBy('date', 'DESC');
        $log = $this->builder->get();
        $this->builder = $this->db->table('dwg_model');
        $dwg_model = $this->builder->get();
        $data = [
            'tittle' => 'Drawing',
			'active_menu' => 'drawing',
            'dwg_model' => $dwg_model->getResult(),
            'log' => $log->getResult(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('dwg/index', $data);
	}

    public function model($id = NULL) 
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        $this->builder = $this->db->table('dwg_file');
        $this->builder->select('model, nama_file, uploader, type, dwg_file.id, status, department.depart_name, upload_for_dept, id_model');
        $this->builder->join('dwg_model', 'dwg_model.id = dwg_file.id_model');
        $this->builder->join('department', 'department.id = dwg_file.upload_for_dept');
        $this->builder->orderBy('status', 'ASC');
        $this->builder->where('id_model', $id);
        $dwg = $this->builder->get();
        $this->builder = $this->db->table('dwg_model');
        $this->builder->where('id', $id);
        $model = $this->builder->get();
        $data = [
            'tittle' => 'File list Drawing',
			'active_menu' => 'drawing',
            'dwg' => $dwg->getResult(),
            'model' => $model->getRow(),
            'getDepart' => $this->adminModel->getDepart(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('dwg/model', $data);
    }

    public function editmodel($id = NULL) 
    {
        $this->builder = $this->db->table('dwg_model');
        $this->builder->where('id', $id);
        $model = $this->builder->get();
        $data = [
            'tittle' => 'Edit Model Drawing',
			'active_menu' => 'drawing',
            'model' => $model->getRow(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('dwg/editmodel', $data);
    }

    public function editfile($id = NULL) 
    {
        $this->builder = $this->db->table('dwg_file');
        $this->builder->select('dwg_file.id, nama_file, status, id_model, model');
        $this->builder->join('dwg_model', 'dwg_model.id = dwg_file.id_model');
        $this->builder->where('dwg_file.id', $id);
        $file = $this->builder->get();
        // dd($file->getResult());
        $data = [
            'tittle' => 'Edit File Drawing',
			'active_menu' => 'drawing',
            'file' => $file->getRow(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('dwg/editfile', $data);
    }

    public function updatemodel($id = NULL)
    {
        $data = [
            'model' => $this->request->getVar('model'),
        ];
        $this->builder = $this->db->table('dwg_model');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashData('pesanmodel', 'Success! model has been updated');
        return redirect()->to('/drawing');
    }

    public function updatefile($id = NULL)
    {
        $idm = $this->request->getVar('id_model');
        $data = [
            'status' => $this->request->getVar('exampleRadios'),
        ];
        $this->builder = $this->db->table('dwg_file');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashData('pesan', 'Success! status file has been updated');
        return redirect()->to('drawing/model/'.$idm);
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
            return redirect()->to('/drawing')->withInput();
        };
        $data = [
            'model' => $this->request->getVar('model'),
        ];
        $this->db->table('dwg_model')->insert($data);
        if (!is_dir('public/theme/assets/drawing/'.$this->request->getVar('model'))){
            mkdir('public/theme/assets/drawing/'.$this->request->getVar('model'));
        }
        session()->setFlashData('pesanmodel', 'Success! new model has been created');
        return redirect()->to('/drawing');
    }

    public function addfile()
    {
        $file = $this->request->getFile('fileapp');
        $model = $this->request->getVar('model');
        $id_model = $this->request->getVar('id_model');
        $type = $this->request->getVar('type');
        $upload_for = $this->request->getVar('upload_for');
        // dd($upload_for);
        if(!$this->validate([
            'fileapp' => [
                'uploaded[fileapp]',
                'mime_in[fileapp,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                'max_size[fileapp,10000]',
            ]
        ])) {
            session()->setFlashData('error', 'Failed! file type not supported');
            return redirect()->to('drawing/model/'.$id_model)->withInput();
        }
        // dd($this->request->getVar('id_model'));
        if ($file->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $file->getName();
            $file->move('public/theme/assets/drawing/'.$model, $nama);
        }
        for($uf=0;$uf<count($upload_for);$uf++){
            $data = [
                'id_model' => $id_model,
                'nama_file' => $nama,
                'upload_for_dept' => $upload_for[$uf],
                'uploader' => user()->id,
                'type' => $type,
                'status' => 'active'
            ];
            $this->db->table('dwg_file')->insert($data);
        }
        if (!is_dir('public/theme/assets/drawing/'.$this->request->getVar('model'))){
            mkdir('public/theme/assets/drawing/'.$this->request->getVar('model'));
        }
        if($type == 'customer'){
            session()->setFlashData('pesan', 'Success! new file customer drawing has been created');
        } else {
            session()->setFlashData('pesan', 'Success! new file internal drawing has been created');
        }
        return redirect()->to('/drawing/model/'.$id_model);
    }
    
    public function delfile($id = null, $idm = null)
    {
        $dwg_file = $this->db->table('dwg_file')->where('id_model', $idm)->get()->getResult();
        $this->builder = $this->db->table('dwg_file');
        $fileRow = $this->builder->where('id', $id)->get()->getRow();
        $this->builder = $this->db->table('dwg_model');
        $modelRow = $this->builder->where('id', $idm)->get()->getRow();
        // dd($dwg_file);
        $path = "./public/theme/assets/drawing/".$modelRow->model."/".$fileRow->nama_file;
        // unlink($path);
        $this->builder = $this->db->table('dwg_file');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Drawing file has been deleted ✓');
        return redirect()->to(base_url('drawing/model/'.$idm));
    }
    
    public function delmodel($id = null)
    {
        $this->builder = $this->db->table('dwg_log');
        $this->builder->delete(['model' => $id]);
        $this->builder = $this->db->table('dwg_model');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesanmodel', 'Drawing model has been deleted ✓');
        return redirect()->to(base_url('drawing'));
    }
    
    public function delog($id = null)
    {
        $this->builder = $this->db->table('dwg_log');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesanlog', 'Drawing log has been deleted ✓');
        return redirect()->to(base_url('drawing'));
    }

    public function download($id = null, $idm = null)
    {
        $this->builder = $this->db->table('dwg_file');
        $this->builder->where('id', $id);
        $dwg = $this->builder->get();
        $this->builder = $this->db->table('dwg_model');
        $this->builder->where('id', $idm);
        $model = $this->builder->get();
        $model = $model->getRow()->model;
        $file = $dwg->getRow()->nama_file;
        $this->builder = $this->db->table('dwg_log');
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
                return $this->response->download('public/theme/assets/drawing/'.$model.'/'.$file, null);
            }
        }
        $data = [
            'model' => $idm,
            'user' => user()->id,
            'date' => date('Y-m-d H:i:s'),
            'file' => $file,
        ];
        $this->db->table('dwg_log')->insert($data);
        return $this->response->download('public/theme/assets/drawing/'.$model.'/'.$file, null);
    }
}
