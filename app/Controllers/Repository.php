<?php

namespace App\Controllers;
use App\Models\AdminModel;
use App\Models\ProjectModel;
use App\Models\RioModel;
use App\Models\TaskModel;

class Repository extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $db, $builder;
    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->projectModel = new ProjectModel();
        $this->rioModel = new RioModel();
        $this->taskModel = new TaskModel();
        $this->db      = \Config\Database::connect();
    }

	public function index()
	{
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $data = [
            'tittle' => 'Repository Project',
            'active_menu' => 'repository',
            'project' => $this->projectModel->getProject(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
		return view('repository/index', $data);
	}

    public function list($id = NULL) {
        if (!logged_in()) { session()->setFlashData('error', 'Please enter valid credentials'); return redirect()->to('/login'); } if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        // dd($this->taskModel->getChildTask($id));
        $data = [
            'tittle' => 'List Repository Project',
            'active_menu' => 'repository',
            'projectrow' => $this->projectModel->getProject($id),
            'rio' => $this->rioModel->getRiobyProject($id),
            'child_rio' => $this->rioModel->getChildRiobyProject($id),
            'task' => $this->taskModel->getTask($id),
            'child_task' => $this->taskModel->getChildTask($id),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        return view('repository/list', $data);
    }

    public function downloadrio($project_name, $filename)
    { return $this->response->download('public/theme/assets/rio/'.$project_name.'/'.$filename, null);}
    
    public function downloadtask($project_name, $filename)
    { return $this->response->download('public/theme/assets/document/'.$project_name.'/'.$filename, null);}
}
