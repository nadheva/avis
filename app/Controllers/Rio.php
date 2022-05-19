<?php

namespace App\Controllers;

use App\Models\RioModel;
use App\Models\ApproveRioModel;
use App\Models\AdminModel;
use App\Models\ChildRioModel;

class Rio extends BaseController
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
        $this->rioModel = new RioModel();
        $this->approveRioModel = new ApproveRioModel;
        $this->adminModel = new AdminModel;
        $this->childrioModel = new ChildRioModel;
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $this->builder = $this->db->table('project');
        $this->builder->select('customer_name, project_name, project.id');
        $this->builder->join('customer', 'customer.id = project.cust_id');
        $project = $this->builder->get();
        $this->builder = $this->db->table('project');
        $this->builder->select('project.id as p_id, fullname, project_name, rio.id as rio_id, due_date, pic, rio.status');
        $this->builder->join('rio', 'rio.project_id = project.id');
        $this->builder->join('users', 'users.id = rio.pic');
        $this->builder->orderBy('due_date', 'ASC');
        $project_d = $this->builder->get();
        $this->builder = $this->db->table('rio');
        $this->builder->select('rio.id as rid, project_name, type, rio, due_date, fullname, rio.status, file, approve');
        $this->builder->join('project', 'rio.project_id = project.id');
        $this->builder->join('users', 'users.id = rio.pic');
        $rio = $this->builder->get();
        $this->builder = $this->db->table('users');
        $this->builder->where('id !=', 1);
        $this->builder->where('id !=', user()->id);
        $this->builder->orderBy('fullname', 'ASC');
        $users = $this->builder->get();
        $data = [
            'tittle' => 'RIO',
            'active_menu' => 'rio',
            'project' => $project->getResult(),
            'project_d' => $project_d->getResult(),
            'rio' => $rio->getResult(),
            'users' => $users->getResult(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        return view('rio/index', $data);
    }

    public function list($id = NULL) {
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $this->builder = $this->db->table('users');
        $this->builder->where('id !=', 1);
        $this->builder->where('id !=', user()->id);
        $this->builder->orderBy('fullname', 'ASC');
        $users = $this->builder->get();
        $this->builder = $this->db->table('project');
        $this->builder->where('id', $id);
        $project = $this->builder->get();
        $data = [
            'tittle' => 'RIO list',
            'active_menu' => 'rio',
            'rio' => $this->rioModel->getRiobyProject($id),
            'child_rio' => $this->rioModel->getChildRiobyProject($id),
            'users' => $users->getResult(),
            'userapproverio' => $this->approveRioModel->getUserApprovalRio(),
            'userapprovechildrio' => $this->approveRioModel->getUserApprovalChildRio(),
            'project' => $project->getRow(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        // dd($this->approveRioModel->getUserApprovalChildRio());
        return view('rio/list', $data);
    }

    public function ajax_detail_rio($id) {
        $data = $this->rioModel->getRiobyId($id);
        echo json_encode($data);
    }

    public function ajax_detail_childrio($id) {
        $data = $this->rioModel->getChildRiobyId($id);
        echo json_encode($data);
    }

    public function addrio()
    {
        $pid = $this->request->getVar('pid');
        if (!$this->validate([
            'rio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Title is required field');
            return redirect()->to('/rio/list/'.$pid)->withInput();
        };
        $this->rioModel->save([
            'project_id' => $pid,
            'type' => $this->request->getVar('type'),
            'rio' => $this->request->getVar('rio'),
            'due_date' => $this->request->getVar('due_date'),
            'pic' => $this->request->getVar('pic'),
            'approve' => 1,
            'status' => 'In Progress',
            'description' => $this->request->getVar('notes'),
            'notes_file' => $this->request->getVar('notes_file'),
            'file' => $this->request->getVar('required_file'),
        ]);
        $r_id = $this->rioModel->getInsertID();
        $this->approveRioModel->save([
            'rio_id' => $r_id,
            'file' => NULL,
            'approve_user' => user()->id,
            'update_date' => NULL,
            'notes' => NULL,
            'approve' => 0,
            'updated' => 0,
        ]);
        session()->setFlashData('pesan', 'Success! new rio has been created');
        return redirect()->to('/rio/list/'.$pid);
    }

    public function editrio($id = 0)
    {
        $this->builder = $this->db->table('project');
        $project = $this->builder->get();

        $this->builder = $this->db->table('rio');
        $this->builder->select('rio.id as rid, rio.pic, project_name, type, rio, due_date, fullname, rio.status, file, rio.project');
        $this->builder->join('project', 'rio.project_id = project.id');
        $this->builder->join('users', 'users.id = rio.pic');
        $this->builder->where('rio.id', $id);
        $rio = $this->builder->get();

        $this->builder = $this->db->table('users');
        $this->builder->where('id !=', 1);
        $this->builder->where('id !=', user()->id);
        $this->builder->orderBy('fullname', 'ASC');
        $users = $this->builder->get();
        // dd($rio->getRow());
        $data = [
            'tittle' => 'Edit Rio',
            'rio' => $rio->getRow(),
            'users' => $users->getResult(),
            'project' => $project->getResult(),
            'active_menu' => 'edit_profile',
            'validation' => \Config\Services::validation(),
        ];

        return view('rio/edit', $data);
    }

    public function updaterio($id = 0)
    {
        $this->rioModel->save([
            'id' => $id,
            'project_id' => $this->request->getVar('project'),
            'type' => $this->request->getVar('type'),
            'rio' => $this->request->getVar('rio'),
            'due_date' => $this->request->getVar('due_date'),
            'pic' => $this->request->getVar('pic'),
            'status' => 'In Progress',
            //'notes' => $this->request->getVar('notes'),
            'file' => $this->request->getVar('required_file'),
        ]);

        session()->setFlashData('pesan', 'Success! RIO has been change');
        return redirect()->to('/rio');
    }

    public function requestapprio($id = NULL)
    {
        $file = $this->request->getFile('fileapp');
        $project_name = $this->request->getVar('project_name');
        $dir = "public/theme/assets/rio/".$project_name;
        // dd();
        $rf = $this->request->getVar('required_file');
        if ($rf != 'No') {
            if(!$this->validate([
                'fileapp' => [
                    'uploaded[fileapp]',
                    'mime_in[fileapp,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[fileapp,10000]',
                ]
            ])) {
                session()->setFlashData('error', 'Failed! Please upload file');
                return redirect()->to('user/dashboard')->withInput();
            }
        }
        // dd($id);
        if(!$this->validate([
            'clostat' => [ 'required'
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Please add notes');
            return redirect()->to('user/dashboard')->withInput();
        }
        // $notes = $this->request->getVar('notes');
        if ($file->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $file->getName();
            if(!file_exists($dir)){
                mkdir($dir);
                $file->move($dir, $nama);
            } else {
                $file->move($dir, $nama);
            }
        }
        $data = [
            'file' => $nama,
            // 'notes' => $notes,
            'update_date' => date('Y-m-d', time()),
            'updated' => 1
        ];
        $this->builder = $this->db->table('approval_rio');
        $this->builder->where('rio_id', $id);
        $this->builder->update($data);
        $this->rioModel->save([
            'id' => $id,
            'status' => 'Waiting Approve',
            'closing_statement' => $this->request->getVar('clostat'),
        ]);
        session()->setFlashData('pesan', 'Success request approve rio ✓');
        return redirect()->to(base_url('user/dashboard'));
    }

    public function requestappchildrio($id = NULL)
    {
        $file = $this->request->getFile('fileapp');
        $project_name = $this->request->getVar('project_name');
        $closing_statement = $this->request->getVar('notes');
        // dd($closing_statement);
        $dir = "public/theme/assets/rio/".$project_name;
        // dd($project_name);
        $rf = $this->request->getVar('required_file');
        if ($rf != 'No') {
            if(!$this->validate([
                'fileapp' => [
                    'uploaded[fileapp]',
                    'mime_in[fileapp,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[fileapp,10000]',
                ]
            ])) {
                session()->setFlashData('error', 'Failed! Please upload file');
                return redirect()->to('user/dashboard')->withInput();
            }
        }
        // dd($id);
        if(!$this->validate([
            'notes' => [ 'required'
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Please add closing statement');
            return redirect()->to('user/dashboard')->withInput();
        }
        if ($file->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $file->getName();
            if(!file_exists($dir)){
                mkdir($dir);
                $file->move($dir, $nama);
            } else {
                $file->move($dir, $nama);
            }
        }
        $data = [
            'file' => $nama,
            'update_date' => date('Y-m-d', time()),
            'updated' => 1
        ];
        $this->builder = $this->db->table('child_rio_approval');
        $this->builder->where('child_rio_id', $id);
        $this->builder->update($data);
        $this->childrioModel->save([
            'id' => $id,
            'closing_statement' => $closing_statement,
            'status' => 'Waiting Approve',
        ]);
        session()->setFlashData('pesan', 'Success request approve child rio ✓');
        return redirect()->to(base_url('user/dashboard'));
    }

    public function deleterio($id = null)
    {
        $model = new RioModel();
        $data['rio'] = $model->where('id', $id)->delete();
        session()->setFlashData('pesan', 'RIO has been deleted ✓');
        return redirect()->to(base_url('/rio'));
    }

    public function detailrio($id = null)
    {
        // $this->builder = $this->db->table('rio');
        // $this->builder->where('id', $id);
        // $queryc = $this->builder->get();

        $this->builder = $this->db->table('project');
        $this->builder->where('project.id', $id);
        $project = $this->builder->get();

        $this->builder = $this->db->table('rio');
        $this->builder->select('rio.id as rid, rio.pic, project_name, type, rio, due_date, fullname, rio.status, file, rio.project');
        $this->builder->join('project', 'rio.project = project.id');
        $this->builder->join('users', 'users.id = rio.pic');
        $this->builder->where('project.id', $id);
        $rio = $this->builder->get();

        $this->builder = $this->db->table('users');
        $this->builder->where('id !=', 1);
        $this->builder->where('id !=', user()->id);
        $this->builder->where('project.id', $id);
        $this->builder->orderBy('fullname', 'ASC');
        $users = $this->builder->get();
        // dd($rio->getRow());
        $data = [
            'id' => $id,
            'tittle' => 'Detail Rio',
            'rio' => $rio->getRow(),
            'users' => $users->getResult(),
            'project' => $project->getResult(),
            'active_menu' => 'edit_profile',
            'validation' => \Config\Services::validation(),
        ];

        return view('rio/detail', $data);
    }

    public function approverio($id = NULL) {
        $data = [
            'update_date' => date('Y-m-d', time()),
            'approve' => 202,
            'notes' => $this->request->getVar('notes')
        ];
        $this->builder = $this->db->table('approval_rio');
        $this->builder->where('rio_id', $id);
        $this->builder->update($data);
        $this->rioModel->save([
            'id' => $id,
            'status' => 'Done',
        ]);
        session()->setFlashData('pesan', 'Success approve rio ✓');
        return redirect()->to(base_url('user/dashboard'));
    }

    public function approvechildrio($id = NULL) {
        $data = [
            'update_date' => date('Y-m-d', time()),
            'approve' => 202,
            'notes' => $this->request->getVar('notes')
        ];
        $this->builder = $this->db->table('child_rio_approval');
        $this->builder->where('child_rio_id', $id);
        $this->builder->update($data);
        $this->childrioModel->save([
            'id' => $id,
            'status' => 'Done',
        ]);
        session()->setFlashData('pesan', 'Success approve child rio ✓');
        return redirect()->to(base_url('user/dashboard'));
    }

    public function cancelrio($id = NULL) 
    {
        $data = [
            'updated' => 0,
            'file' => NULL
        ];
        $this->builder = $this->db->table('approval_rio');
        $this->builder->where('rio_id', $id);
        $this->builder->update($data);
        $this->rioModel->save([
            'id' => $id,
            'closing_statement' => NULL,
            'status' => 'In Progress',
        ]);
        session()->setFlashData('pesan', 'Success withdraw request approval rio ✓');
        return redirect()->to(base_url('user/dashboard'));
    }

    public function addChildRio($id = 0)
    {
        $pic = $this->request->getVar('pic');
        $rio = $this->request->getVar('rio');
        $date = $this->request->getVar('due_date');
        $file = $this->request->getVar('required_file');
        // dd($this->request->getVar('notes'));
        if ($file == ''){
            session()->setFlashData('error', 'Failed! Please choose required file');
            return redirect()->to('user/dashboard')->withInput();
        }
        $this->childrioModel->save([
            'rio_id' => $id,
            'rio' => $rio,
            'due_date' => date("Y-m-d", strtotime($date)),
            'pic' => $pic,
            'status' => 'In Progress',
            'description' => $this->request->getVar('desc'),
            'file' => $file,
        ]);
        $cr_id = $this->childrioModel->getInsertID();
        $data = [
            'child_rio_id' => $cr_id,
            'file' => NULL,
            'approve_user' => user()->id,
            'update_date' => date("Y-m-d", time()),
            'notes' => NULL,
            'approve' => 0,
            'updated' => 0,
        ];
        $this->builder = $this->db->table('child_rio_approval');
        $this->builder->insert($data);
        session()->setFlashData('pesan', 'Success! new child rio has been created ✓');
        return redirect()->to(base_url('user/dashboard'));
    }
}
