<?php

namespace App\Controllers;
use App\Models\LessonLearnModel;
use App\Models\AdminModel;

class Lessonlearn extends BaseController
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
        $this->lessonLearnModel = new LessonLearnModel();
        $this->adminModel = new AdminModel();
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
        $project = $this->builder->get();
        // dd($this->lessonLearnModel->getAllLesson());
        $data = [
            'tittle' => 'Lesson learned',
            'active_menu' => 'll',
            'project' => $project->getResult(),
            'allLesson' => $this->lessonLearnModel->getAllLesson(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];

        return view('lessonlearn/index', $data);
    }

    public function list($id = NULL) 
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $this->builder = $this->db->table('project');
        $this->builder->where('id', $id);
        $project = $this->builder->get();
        $data = [
            'tittle' => 'Lesson learn list',
            'active_menu' => 'll',
            'lessonlearn' => $this->lessonLearnModel->getLessonbyProject($id),
            'project' => $project->getRow(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        // dd($this->lessonLearnModel->getLessonbyProject($id));
        return view('lessonlearn/list', $data);
    }

    public function ajax_detail_view($id) {
        $data = $this->lessonLearnModel->getAllLesson($id);
        echo json_encode($data);
    }

    public function addlesson()
    {
        $file = $this->request->getFile('file');
        $project_id = $this->request->getVar('project_id');
        if (!$this->validate([
            'source' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ])) {
            session()->setFlashData('error', 'Failed! source is required field');
            return redirect()->to('lessonlearn')->withInput();
        }
        if ($file->getError() != 4) {
            if(!$this->validate([
                'file' => [
                    'uploaded[file]',
                    'mime_in[file,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[file,10000]',
                ]
            ])) {
                session()->setFlashData('error', 'Failed! file type not supported');
                return redirect()->to('lessonlearn')->withInput();
            }
        }
        if ($file->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $file->getName();
            $file->move('public/theme/assets/lesson learn/', $nama);
        }
        $this->lessonLearnModel->save([
            'project_id' => $this->request->getVar('project_id'),
            'source' => $this->request->getVar('source'),
            'problem' => $this->request->getVar('addproblem'),
            'countermeasure' => $this->request->getVar('countermeasure'),
            'rootcause' => $this->request->getVar('rootcause'),
            'prevention' => $this->request->getVar('prevention'),
            'remaks' => $this->request->getVar('remaks'),
            'file' => $nama,
            'status' => 'Open',
            'created_at' => date('Y-m-d', time()),
        ]);
        session()->setFlashData('pesan', 'Success! lesson has been created');
        return redirect()->to('lessonlearn');
    }
    
    public function updatelesson($id = NULL)
    {
        $this->lessonLearnModel->save([
            'id' => $id,
            'project_id' => $this->request->getVar('project_id'),
            'source' => $this->request->getVar('source'),
            'problem' => $this->request->getVar('problem'),
            'countermeasure' => $this->request->getVar('countermeasure'),
            'rootcause' => $this->request->getVar('rootcause'),
            'status' => $this->request->getVar('status'),
            'prevention' => $this->request->getVar('prevention'),
            'remaks' => $this->request->getVar('remaks'),
        ]);
        session()->setFlashData('pesan', 'Success! Lesson has been change');
        return redirect()->to('lessonlearn');
    }

    public function deletelesson($id = null)
    {
        $this->lessonLearnModel->where('id', $id)->delete();
        session()->setFlashData('pesan', 'Lesson has been deleted ✓');
        return redirect()->to(base_url('lessonlearn'));
    }


}