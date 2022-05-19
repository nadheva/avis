<?php

namespace App\Controllers;

use Config\Services;
use App\Models\UserDatatable;
use App\Models\AdminModel;
use App\Models\RioModel;
use App\Models\TaskModel;
use App\Models\ApproverioModel;
use App\Models\ChildrioModel;
use App\Models\EngchangeRequestModel;


class User extends BaseController
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
        $this->adminModel = new AdminModel();
        $this->rioModel = new RioModel();
        $this->approveRioModel = new ApproverioModel();
        $this->childRioModel = new ChildrioModel();
        $this->taskModel = new TaskModel();
        $this->engchangerequestModel = new EngchangeRequestModel();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        $getUser = $this->adminModel->getAllUsers(user()->id)->getRow();
        $data = [
            'tittle' => 'My Profile',
            'active_menu' => 'profile',
            'user' => $getUser,
            'notif' => $this->adminModel->getNotif()
        ];
        return view('user/index', $data);
    }

    public function datatable()
    {
        $data = [
            'title' => 'User List'
        ];

        return view('index', $data);
    }

    public function ajaxList()
    {
        $request = Services::request();
        $datatable = new UserDatatable($request);
        // $method = $_SERVER['REQUEST_METHOD'];
        // dd($this->request->isAJAX());
        // if ($request->getMethod(TRUE) == "POST") {
            $lists = $datatable->getDatatables();
            $data = [];
            $no = $request->getPost('start');

            foreach ($lists as $list) {
                $no++;
                $row = [];
                $row[] = $no;
                $row[] = $list->fullname;
                $row[] = $list->email;
                $data[] = $row;
            }

            $output = [
                'draw' => 1,
                'recordsTotal' => $datatable->countAll(),
                'recordsFiltered' => $datatable->countFiltered(),
                'data' => $data
            ];

            return json_encode($output);
        // }
    }

    public function dashboard()
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Failed! Please login!');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        // dd($this->childRioModel->getChildRio());
        $getCountRioInProgress = $this->rioModel->getCountRioInProgress();
        $getCountRioOverDue = $this->rioModel->getCountRioOverDue();
        $getCountRioWaiting = $this->rioModel->getCountRioWaiting();
        $countRequestAppRio = $this->approveRioModel->getCountRequestApproval();
        $countRequestAppRio = $this->approveRioModel->getCountRequestApproval();
        // dd($this->adminModel->getNotif());
        $this->builder = $this->db->table('project');
        $this->builder->select('project.id as p_id, fullname, project_name, task.id as task_id, event, concern, due_date, pic, task.status');
        $this->builder->join('task', 'task.project_id = project.id');
        $this->builder->join('users', 'users.id = task.pic');
        $this->builder->where('task.status !=', 'Done');
        $this->builder->orderBy('due_date', 'ASC');
        $queryp = $this->builder->get();
        $this->builder = $this->db->table('project');
        $project = $this->builder->get();
        $this->builder = $this->db->table('task');
        $task = $this->builder->get();
        $this->builder = $this->db->table('approval');
        $this->builder->select('approve_user, approval.approve as ap, task.approve as tap, status, updated');
        $this->builder->join('task', 'task.id = approval.task_id');
        $approval = $this->builder->get();
        $this->builder = $this->db->table('child_task_approval');
        $this->builder->select('approve_user, child_task_approval.approve as ap, child_task.approve as tap, status, updated');
        $this->builder->join('child_task', 'child_task.id = child_task_approval.child_task_id');
        $ctapproval = $this->builder->get();
        $this->builder = $this->db->table('child_task');
        $child_task = $this->builder->get();
        $this->builder = $this->db->table('child_task');
        $this->builder->select('child_task.id as cid, approve_user, updated, child_task.file as c_file, child_task.task_id as ctask_id, child_task.concern,  child_task.updated_at, child_task.status as cstat, task.pic as tpic, child_task.pic, child_task.due_date, fullname, child_task.approve capp, project_name, child_task_approval.approve as ctapp, task.event, task.concern as parent, event_name, child_task_approval.id as cta_id, update_date, notes, child_task_approval.file as ct_file, child_task_id, child_task.description as desc');
        $this->builder->join('users', 'users.id = child_task.pic');
        $this->builder->join('task', 'task.id = child_task.task_id');
        $this->builder->join('child_task_approval', 'child_task_approval.child_task_id = child_task.id');
        $this->builder->join('project', 'task.project_id = project.id');
        $this->builder->join('event_internal', 'event_internal.id = task.event');
        $this->builder->where('child_task.status !=', 'Done');
        $child_task_data = $this->builder->get();
        $approvect = $this->taskModel->getApproveChildTask();;
        $this->builder = $this->db->table('project');
        $this->builder->select('project.id as p_id, fullname, project_name, type, rio, rio.id as rio_id, due_date, pic, rio.status');
        $this->builder->join('rio', 'rio.project_id = project.id');
        $this->builder->join('users', 'users.id = rio.pic');
        $this->builder->where('rio.status !=', 'Done');
        $this->builder->orderBy('due_date', 'ASC');
        $project_rio = $this->builder->get();
        $this->builder = $this->db->table('project');
        $this->builder->select('approval_rio.id as a_id, project.id as p_id, rio.file as r_file, rio.description, update_date, fullname, project_name, rio.id as rio_id,rio, type, due_date, pic, rio.status, approval_rio.file as a_file, update_date, updated, approve_user, approval_rio.id as r_id, approval_rio.rio_id as at_id, rio.file, approval_rio.notes, closing_statement, notes_file');
        $this->builder->join('rio', 'rio.project_id = project.id');
        $this->builder->join('users', 'users.id = rio.pic');
        $this->builder->join('approval_rio', 'approval_rio.rio_id = rio.id');
        $this->builder->where('rio.status !=', 'Done');
        $approverio = $this->builder->get();
        $this->builder = $this->db->table('project');
        $this->builder->select('project.id as p_id, task.file as t_file, task.approve as t_app, task.description as desc, update_date, fullname, project_name, task.id as task_id, event, concern, due_date, pic, task.status, namafile, request_at, task.created_at, update_date, routes, updated, event_name, approve_user, approval.approve as ap, approval.id as a_id, task.namafile, request_at, approval.task_id as at_id');
        $this->builder->join('task', 'task.project_id = project.id');
        $this->builder->join('users', 'users.id = task.pic');
        $this->builder->join('approval', 'approval.task_id = task.id');
        $this->builder->join('event_internal', 'event_internal.id = task.event');
        $this->builder->where('task.status !=', 'Done');
        $this->builder->orderBy('a_id', 'DESC');
        $querya = $this->builder->get();
        $this->builder = $this->db->table('approval');
        $this->builder->select('approval.id as a_id, pic, approval.approve as ap, task.approve as t_app, users.id, fullname, approve_user, routes, notes, task.id as t_task_id, approval.task_id as a_task_id');
        $this->builder->join('task', 'task.id = approval.task_id');
        $this->builder->join('users', 'users.id = approval.approve_user');
        $this->builder->orderBy('approval.id', 'ASC');
        $queryau = $this->builder->get();
        $this->builder = $this->db->table('users');
        $this->builder->where('id !=', 1);
        $queryu = $this->builder->get();
        // dd($this->engchangerequestModel->getUserApprovalEngchange(user()->id));
        $data = [
            'project' => $project->getResult(),
            'project_rio' => $project_rio->getResult(),
            'approve_rio' => $approverio->getResult(),
            'approve' => $querya->getResult(),
            'task' => $task->getResult(),
            'apu' => $queryau->getResult(),
            'user' => $queryu->getResult(),
            'userapproverio' => $this->approveRioModel->getUserApprovalRio(),
            'listapprovalrio' => $this->approveRioModel->getListApprovalRio(),
            'listapprovalchildrio' => $this->approveRioModel->getListApprovalChildRio(),
            'userapprovechildrio' => $this->approveRioModel->getUserApprovalChildRio(),
            'project_data' => $queryp->getResult(),
            'myRequest4m' => $this->engchangerequestModel->getRequest(user()->id),
            'approval' => $approval->getResult(),
            'approvect' => $approvect->getResult(),
            'childapprio' => $this->childRioModel->getChildUserAppRio(),
            'countRequestAppRio' => $countRequestAppRio,
            'getCountRioInProgress' => $getCountRioInProgress,
            'getCountChildRioInProgress' => $this->childRioModel->getCountChildRioInProgress(),
            'getCountChildRioOverDue' => $this->childRioModel->getCountChildRioOverDue(),
            'getCountChildRioWaiting' => $this->childRioModel->getCountChildRioWaiting(),
            'countRequestAppChildRio' => $this->childRioModel->getCounChildRiotRequestApproval(),
            'getCountRioOverDue' => $getCountRioOverDue,
            'getCountRioWaiting' => $getCountRioWaiting,
            'UserApprovalEngchange' => $this->engchangerequestModel->getUserApprovalEngchange(),
            'myapprovalengchange' => $this->engchangerequestModel->getUserApprovalEngchange(user()->id),
            'child_rio' => $this->childRioModel->getChildRio(),
            'approval_child_rio' => $this->childRioModel->getApprovalChildRio(),
            'ctapproval' => $ctapproval->getResult(),
            'child_task' => $child_task->getResult(),
            'child_task_data' => $child_task_data->getResult(),
            'tittle' => 'Dashboard',
            'active_menu' => 'dashboard',
            'notif' => $this->adminModel->getNotif()
        ];
        return view('user/dashboard', $data);
    }

    public function change_pass()
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Failed! Please login!');
            return redirect()->to('/login');
        }
        $data = [
            'tittle' => 'Change Password',
            'active_menu' => 'change_pass',
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];

        return view('user/change_pass', $data);
    }

    public function resetpass()
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Failed! Please login!');
            return redirect()->to('/login');
        }
        $builder = $this->db->table('users');
        $new_pass = $this->request->getVar('new_pass');
        $yes = $this->request->getVar('pass_confirm');
        $session_id = user()->id;
        $query = $builder->getWhere(['id' => $session_id]);
        $pass = $query->getRow();
        $pass = $pass->password_hash;

        if (
            (defined('PASSWORD_ARGON2I') && PASSWORD_DEFAULT == PASSWORD_ARGON2I)
            ||
            (defined('PASSWORD_ARGON2ID') && PASSWORD_DEFAULT == PASSWORD_ARGON2ID)
        ) {
            $hashOptions = [
                'memory_cost' => 2048,
                'time_cost'   => 4,
                'threads'     => 4
            ];
        } else {
            $hashOptions = [
                'cost' => 10
            ];
        }

        $pass_baru = password_hash(
            base64_encode(
                hash('sha384', $this->request->getVar('new_pass'), true)
            ),
            PASSWORD_DEFAULT,
            $hashOptions
        );
        $new_pass =  password_hash($this->request->getVar('new_pass'), PASSWORD_DEFAULT);
        if (password_verify($yes, $new_pass)) {
            $this->adminModel->change_pass($session_id, $pass_baru);
            session()->setFlashData('message', 'Success! Your password has been change');
            return redirect()->to('/user/change_pass');
        } else {
            session()->setFlashData('error', 'Failed! Password not match');
            return redirect()->to('/user/change_pass');
        }
    }

    public function edit()
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Failed! Please login!');
            return redirect()->to('/login');
        }
        $data = [
            'tittle' => 'Edit Profile',
            'active_menu' => 'edit_profile',
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];

        return view('user/edit', $data);
    }

    public function update($id = 0)
    {
        if (!$this->validate([
            'user_image' => [
                'rules' => 'max_size[user_image,1024]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Upload file gambar',
                    'mime_in' => 'Format salah',
                ]
            ]
        ])) {
            return redirect()->to('/user/edit/')->withInput();
        };

        $fileUserImage = $this->request->getFile('user_image');
        //cek gambar lama/tidak
        if ($fileUserImage->getError() == 4) {
            $namaUserImage = $this->request->getVar('user_image_lama');
        } else {
            $namaUserImage = $fileUserImage->getRandomName();
            $fileUserImage->move('public/theme/assets/images/avatars/', $namaUserImage);
        }

        $this->adminModel->save([
            'id' => $id,
            'email' => $this->request->getVar('email'),
            'fullname' => $this->request->getVar('fullname'),
            'user_image' => $namaUserImage,
        ]);
        session()->setFlashData('pesan', 'Success! Profil has been change');
        return redirect()->to('/user');
    }

    public function fetch_model(){
        $dept_id = $this->request->getVar('dept_id');
        $res = $this->adminModel->getSectionn($dept_id);
        $data = [
            'res' => $res,
        ];
        return view('user/fetch', $data);
    }
}
