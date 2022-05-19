<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

use App\Models\ChildTaskModel;
use App\Models\TaskModel;
use App\Models\AdminModel;
use App\Models\ApproveModel;
use App\Models\ApproveChildTaskModel;


class Task extends BaseController
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
        $this->approveModel = new ApproveModel();
        $this->taskModel = new TaskModel();
        $this->adminModel = new AdminModel();
        $this->childtaskModel = new ChildTaskModel();
        $this->childapproveModel = new ApproveChildTaskModel();
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
        $this->builder->select('project.id as p_id, fullname, project_name, task.id as task_id, event, concern, due_date, pic, task.status, namafile, request_at');
        $this->builder->join('task', 'task.project_id = project.id');
        $this->builder->join('users', 'users.id = task.pic');
        $this->builder->orderBy('task.status', 'DESC');
        $queryp = $this->builder->get();
        $this->builder = $this->db->table('task');
        $this->builder->select('task.id as t_id, concern, due_date, event, file, pic, fullname');
        $this->builder->join('users', 'users.id = task.pic');
        $this->builder->orderBy('task.status', 'DESC');
        $query = $this->builder->get();
        $querya = $this->taskModel->getAllTask();
        $myTask = $this->taskModel->getMyTask(user()->id);
        // dd($myTask);
        $approval_task = $this->taskModel->getApproveTask();
        $this->builder = $this->db->table('users');
        $this->builder->where('id !=', 1);
        $queryu = $this->builder->get();
        $child_task = $this->taskModel->getChildTask();
        $approvect = $this->taskModel->getApproveChildTask();
        // dd($this->taskModel->getAllTask()->getResult());
		$data = [
            'tittle' => 'Task User',
			'active_menu' => 'task',
            'project' => $queryp->getResult(),
            'approve' => $querya->getResult(),
            'task' => $query->getResult(),
            'apu' => $approval_task->getResult(),
            'user' => $queryu->getResult(),
            'child_task' => $child_task->getResult(),
            'approvect' => $approvect->getResult(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('user/task', $data);
	}

    public function ajax_detail_task($id) {
        $data = $this->taskModel->getTaskbyId($id);
        echo json_encode($data);
    }

    public function canceltask($id = NULL) 
    {
        $this->builder = $this->db->table('approval');
        $this->builder->selectCount('task_id');
        $this->builder->where('task_id', $id);
        $query = $this->builder->get();
        $query = $query->getResult();
        $count_approve = $query[0]->task_id;
        $ca = $this->request->getVar('cancel_approve');
        $cr = $this->request->getVar('cancel_request');
        $a_id = $this->request->getVar('approval_id');
        $status = $this->request->getVar('status_task');
        $approve_number = $this->request->getVar('approve_number');
        // dd($cr,$ca,$approve_number); 
        if ($status == 'Done') {
            $st = 'Approve ' . ($count_approve - 1);
        } elseif ($status == 'Waiting Approve' || $status == 'Revise' ) {
            $st = 'In Progress';
        } else {
            $stt = substr($status, -1) - 1;
            if ($stt == 0){
                $st = 'Waiting Approve';
            } else {
                $st = 'Approve ' . $stt;
            }
        }
        $this->builder = $this->db->table('approval');
        $this->builder->where('task_id', $id);
        $app = $this->builder->get();
        $app = $app->getResult();
        foreach ($app as $ap) {
            $route[] = $ap->approve;
        }
        if ($ca == 'ca') {
            if(in_array(($approve_number - 1), $route)) { 
                $this->taskModel->save([
                    'id' => $id,
                    'status' => $st,
                    'approve' => $approve_number - 1,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
                $this->approveModel->save([
                    'id' => $a_id,
                    'approve' => $approve_number - 1,
                    'notes' => NULL,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            } else {
                $this->taskModel->save([
                    'id' => $id,
                    'status' => $st,
                    'approve' => $approve_number - 1,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
                $this->approveModel->save([
                    'id' => $a_id,
                    'approve' => $approve_number - 1,
                    'notes' => NULL,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            }
            session()->setFlashData('pesan', 'Success cancel task ✓');
            return redirect()->to(base_url('task'));
        }
        if ($cr == 'cr') {
            $routes = $this->request->getVar('routes');
            $idapp = $this->request->getVar('idapp');
            $countroutes = count($route);
            // dd($routes, $countroutes, $idapp);
            for($r=0;$r<$countroutes;$r++) {
                $this->approveModel->save([
                    'id' => $idapp[$r],
                    'approve' => $routes[$r],
                    'file' => NULL,
                    'notes' => NULL,
                    'updated' => 0,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            }
            $this->taskModel->save([
                'id' => $id,
                'status' => $st,
                'approve' => 1,
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
            session()->setFlashData('pesanwd', 'Success withdraw task ✓');
            return redirect()->to(base_url('task'));
        }
    }

    public function editTask($id)
    {
        $due_date = $this->request->getVar('due_date');
        $project_id = $this->request->getVar('project_id');
        $cust_id = $this->request->getVar('cust_id');
        $eventid = $this->request->getVar('eventid');
        // dd($this->request->getVar('event'));
        $this->taskModel->save([
            'id' => $id,
            'concern' => $this->request->getVar('concern'),
            'pic' => $this->request->getVar('pic'),
            'event' => $this->request->getVar('event'),
            'due_date' => date('Y-m-d', strtotime($due_date)),
        ]);
        if (isset($eventid)) {
            session()->setFlashData('pesan', 'Success! edit task ✓');
            return redirect()->to(base_url('project/event/'.$project_id.'/'.$cust_id.'/'.$eventid));
        }
        session()->setFlashData('pesan', 'Success! edit task ✓');
        return redirect()->to(base_url('project/detailproject/'.$project_id.'/'.$cust_id));

    }   

    public function editChildTask($id)
    {
        $due_date = $this->request->getVar('dudet');
        $project_id = $this->request->getVar('project_id');
        $cust_id = $this->request->getVar('cust_id');
        $eventid = $this->request->getVar('eventid');
        // dd($due_date,$project_id,$cust_id);
        $this->childtaskModel->save([
            'id' => $id,
            'concern' => $this->request->getVar('concern'),
            'pic' => $this->request->getVar('pic'),
            'due_date' => date('Y-m-d', strtotime($due_date)),
        ]);
        if (isset($eventid)) {
            session()->setFlashData('pesan', 'Success! edit child task ✓');
            return redirect()->to(base_url('project/event/'.$project_id.'/'.$cust_id.'/'.$eventid));
        }
        session()->setFlashData('pesan', 'Success! edit child task ✓');
        return redirect()->to(base_url('project/detailproject/'.$project_id.'/'.$cust_id));

    }   

    public function cancelchildtask($id = NULL) 
    {
        $this->builder = $this->db->table('child_task_approval');
        $this->builder->selectCount('child_task_id');
        $this->builder->where('child_task_id', $id);
        $query = $this->builder->get();
        $query = $query->getResult();
        $count_approve = $query[0]->child_task_id;
        $ca = $this->request->getVar('cancel_approve');
        $cr = $this->request->getVar('cancel_request');
        $a_id = $this->request->getVar('approval_id');
        $status = $this->request->getVar('status');
        $approve_number = $this->request->getVar('approve_number');
        // dd($cr,$ca,$id,$status); 
        if ($status == 'Done') {
            $st = 'Approve ' . ($count_approve - 1);
        } elseif ($status == 'Waiting Approve' || $status == 'Revise' ) {
            $st = 'In Progress';
        } else {
            $stt = substr($status, -1) - 1;
            if ($stt == 0){
                $st = 'Waiting Approve';
            } else {
                $st = 'Approve ' . $stt;
            }
        }
        $this->builder = $this->db->table('approval');
        $this->builder->where('task_id', $id);
        $app = $this->builder->get();
        $app = $app->getResult();
        foreach ($app as $ap) {
            $route[] = $ap->approve;
        }
        // dd($st);
        if ($ca == 'ca') {
            if(in_array(($approve_number - 1), $route)) { 
                $this->taskModel->save([
                    'id' => $id,
                    'status' => $st,
                    'approve' => $approve_number - 1,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
                $this->approveModel->save([
                    'id' => $a_id,
                    'approve' => $approve_number - 1,
                    'notes' => NULL,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            } else {
                $this->taskModel->save([
                    'id' => $id,
                    'status' => $st,
                    'approve' => $approve_number - 1,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
                $this->approveModel->save([
                    'id' => $a_id,
                    'approve' => $approve_number - 1,
                    'notes' => NULL,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            }
            session()->setFlashData('pesan', 'Success cancel task ✓');
            return redirect()->to(base_url('task'));
        }
        if ($cr == 'cr') {
            $data = [
                'updated' => 0,
                'file' => NULL,
                'notes' => NULL,
                'approve' => $approve_number,
                'updated_at' => date('Y-m-d H:i:s', time()),
            ];
            $this->builder = $this->db->table('child_task_approval');
            $this->builder->where('child_task_id', $id);
            $this->builder->update($data);
            $this->childtaskModel->save([
                'id' => $id,
                'status' => $st,
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
            session()->setFlashData('pesanwd', 'Success withdraw request approve child task ✓');
            return redirect()->to(base_url('task'));
        }
    }

    
    public function addtask($id = 0)
    {
        $event = $this->request->getVar('event');
        $this->builder = $this->db->table('event_internal')->where('id', $event);
        $event_name = $this->builder->get()->getRow()->event_name;
        $eventid = $this->request->getVar('eventid');
        $idc = $this->request->getVar('idc');
        $pic = $this->request->getVar('pic');
        $project_id = $this->request->getVar('project_id');
        $this->builder = $this->db->table('project');
        $this->builder->where('id', $project_id);
        $project_name = $this->builder->get()->getRow()->project_name;
        $concern = $this->request->getVar('concern');
        $date = $this->request->getVar('due_date');
        $file = $this->request->getVar('required_file');
        $this->builder = $this->db->table('users');
        $this->builder->where('id', $pic);
        $queryp = $this->builder->get();
        $user_email = $queryp->getRow();
        $lau = $this->request->getVar('lau');
        $route_num = $this->request->getVar('route_num');
        // dd($user_email->email, $project_name, $event_name);
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
        $values = $this->request->getVar('app');
        // dd($project_id);
        if (!isset($au) && !isset($rn)){
            session()->setFlashData('error', 'Failed! Please input user approval');
            return redirect()->to('/project/detailproject/'.$id.'/'.$idc)->withInput();
        }
        $this->taskModel->save([
            'project_id' => $project_id,
            'event' => $event,
            'concern' => $concern,
            'due_date' => date("Y-m-d", strtotime($date)),
            'pic' => $pic,
            // 'created_at' => date('Y-m-d h:i:s', time()),
            'description' => NULL,
            'status' => 'In Progress',
            'approve' => 1,
            'file' => $file,
        ]);
        if (isset($au) && isset($rn)) {
            $t_id = $this->taskModel->getInsertID();
            $jumlah_dipilih = count($au);
            for($x=0;$x<$jumlah_dipilih;$x++){
                $this->approveModel->save([
                    'task_id' => $t_id,
                    'approve_user' => $au[$x],
                    // 'update_date' => date("Y-m-d", time()),
                    'notes' => NULL,
                    'approve' => $rn[$x],
                    'routes' => $rn[$x],
                    'updated' => 0,
                ]);
            }
        }
		$mail = new PHPMailer(true);
        // dd($mail);
		try {
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();
            $mail->SMTPDebug = 3;
            $mail->Host       = 'smtp.googlemail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'cryptexyz@gmail.com';
            $mail->Password   = 'Pengertian!((*';
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAutoTLS = false;
            $mail->Port       = 587;
            $mail->From = "no-reply@astra-visteon.com";
			$mail->FromName = "No-Reply Avis";

			$mail->addAddress($user_email->email, $user_email->email);

			$mail->isHTML(true);

			// Content
			$mail->isHTML(true);
			$mail->Subject = 'New Task from AVIS';
            $body = "";
            $body .= "Dear ".$user_email->fullname.",<br><br>";
			$body .= "You have new task, waiting for your action to close the task.<br>";
            $body .= "Here is a brief information regarding the new task.<br><br>";
            $body .= "Project : ".$project_name."<br>";
            $body .= "Event : ".$event_name."<br>";
            $body .= "Concern : ".$concern."<br>";
            $body .= "Due date : ".date("d M Y", strtotime($date))."<br><br>";
			$body .= "Please go to AVIS application and close your task<br>";
			$body .= "or <a href=".base_url('/user/dashboard').">click this link</a><br><br><br>";
            $body .= "Regards,<br><br>";
            $body .= "AVIS Mail Bot";
			$mail->Body = $body;

			$mail->send();
            if (isset($eventid)) {
                session()->setFlashData('pesan', 'Success! new task has been created ✓');
                return redirect()->to(base_url('project/event/'.$id.'/'.$idc.'/'.$eventid));
            }
            session()->setFlashData('pesan', 'Success! new task has been created ✓');
            return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
		} catch (Exception $e) {
            if (isset($eventid)) {
                session()->setFlashData('error', 'Failed! send email failed ✓');
                return redirect()->to(base_url('project/event/'.$id.'/'.$idc.'/'.$eventid));
            }
            session()->setFlashData('error', 'Failed! send email failed ✓');
            return redirect()->to(base_url('project/detailproject/'.$id.'/'.$idc));
		}
    }

    public function updatetask($id = NULL)
    {
        $file = $this->request->getFile('fileapp');
        $project_name = $this->request->getVar('project_name');
        $rf = $this->request->getVar('required_file');
        if ($rf != 'No') {
            if(!$this->validate([
                'fileapp' => [
                    'uploaded[fileapp]',
                    'mime_in[fileapp,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[fileapp,50000]',
                ]
            ])) {
                session()->setFlashData('errordoc', 'Failed! Please upload document');
                return redirect()->to('task')->withInput();
            }
        }
        if(!$this->validate([
            'description' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errornotes', 'Failed! Please add decription');
            return redirect()->to('task')->withInput();
        }
        $desc = $this->request->getVar('description');
        // dd($desc);
        if ($file->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $file->getName();
            $file->move('public/theme/assets/document/'.$project_name, $nama);
        }
        $data = [
            // 'file' => $nama,
            'updated' => 1
        ];
        $this->builder = $this->db->table('approval');
        $this->builder->where('task_id', $id);
        $this->builder->update($data);
        $this->taskModel->save([
            'id' => $id,
            'status' => 'Waiting Approve',
            'namafile' => $nama,
            'request_at' => date("Y-m-d", time()),
            'description' => $desc,
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        session()->setFlashData('pesanapprove', 'Success request to approve task ✓');
        return redirect()->to(base_url('task'));
    }

    public function approvetask($id = NULL)
    {
        $reject = $this->request->getVar('reject');
        $a_id = $this->request->getVar('approval_id');
        $status = $this->request->getVar('status_task');
        $notes = $this->request->getVar('notes');
        $approve_number = $this->request->getVar('approve_number');
        $this->builder = $this->db->table('approval');
        $this->builder->selectCount('task_id');
        $this->builder->where('task_id', $id);
        $query = $this->builder->get();
        $query = $query->getResult();
        $count_approve = $query[0]->task_id;
        $this->builder = $this->db->table('approval');
        $this->builder->select('approve');
        $this->builder->where('task_id', $id);
        $arrApp = $this->builder->get();
        $arrApp = $arrApp->getResult();
        foreach($arrApp as $row) {
            $newArrApp[] = $row->approve;
        }
        // dd($newArrApp);
        if(!$this->validate([
            'notes' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errornotes', 'Failed! Please add notes');
            return redirect()->to('task')->withInput();
        }
        if (isset($reject)) {
            $this->approveModel->save([
                'id' => $a_id,
                'notes' => $notes,
                'update_date' => date("Y-m-d", time()),
                'approve' => 404,
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
            $this->taskModel->save([
                'id' => $id,
                'status' => 'Revise',
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
            session()->setFlashData('pesan', 'Success revise task ✓');
            return redirect()->to(base_url('task'));
        }
        $approve = $this->request->getVar('approve');
        if (isset($approve)) {
            if($status == 'In Progress' || $status == 'Waiting Approve') {
                if(in_array("202",$newArrApp)) {
                    $statusnum = 202;
                } else {
                    $statusnum = 1;
                }
            } else {
                $statusnum = substr($status,-1) + 1;
            }
            if (($count_approve - 1) >= $statusnum) {
                $approve = 'Approve ' . $statusnum;
            } else {
                $approve = 'Done';
            }
            $this->approveModel->save([
                'id' => $a_id,
                'notes' => $notes,
                'update_date' => date("Y-m-d", time()),
                'approve' => 202,
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
            $this->builder = $this->db->table('approval');
            $this->builder->where('task_id', $id);
            $app = $this->builder->get();
            $app = $app->getResult();
            foreach ($app as $ap) {
                $route[] = $ap->approve;
            }
            // dd($route);
            if(in_array($approve_number, $route)) { 
                $this->taskModel->save([
                    'id' => $id,
                    'status' => $approve,
                    'approve' => $approve_number,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            } else {
                $approve_number = $this->request->getVar('approve_number') + 1;
                $this->taskModel->save([
                    'id' => $id,
                    'status' => $approve,
                    'approve' => $approve_number,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            }
        session()->setFlashData('pesan', 'Success approve task ✓');
        return redirect()->to(base_url('task'));
        }
    }

    public function deletetask($id = null , $idp = null, $idc = null)
    {
        // dd($idc);
        $this->builder = $this->db->table('approval');
        $this->builder->delete(['task_id' => $id]);
        $model = new TaskModel();
        $data['task'] = $model->where('id', $id)->delete();
        session()->setFlashData('pesan', 'Task has been deleted ✓');
        return redirect()->to(base_url('project/detailproject/'.$idp.'/'.$idc));
    }

    public function deletechildtask($id = null , $idp = null, $idc = null)
    {
        // dd($idc);
        $this->builder = $this->db->table('child_task_approval');
        $this->builder->delete(['child_task_id' => $id]);
        $model = new TaskModel();
        $data['child_task'] = $model->where('id', $id)->delete();
        session()->setFlashData('pesan', 'Child task has been deleted ✓');
        return redirect()->to(base_url('project/detailproject/'.$idp.'/'.$idc));
    }

    public function addChildtask($id = 0)
    {
        $fproj = $this->request->getVar('fproj');
        $ftask = $this->request->getVar('ftask');
        $fdash = $this->request->getVar('fdash');
        $project_id = $this->request->getVar('project_id');
        $idc = $this->request->getVar('idc');
        // dd($fproj,$ftask,$fdash);
        $pic = $this->request->getVar('pic');
        $user_app = $this->request->getVar('user_app');
        $concern = $this->request->getVar('concern');
        $date = $this->request->getVar('due_date');
        $file = $this->request->getVar('required_file');
        $this->builder = $this->db->table('users');
        $this->builder->where('id', $pic);
        $queryp = $this->builder->get();
        $user_email = $queryp->getRow();
        // dd($pic, $id, $user_app);
        if ($file == ''){
            session()->setFlashData('error', 'Failed! Please choose required file');
            return redirect()->to('task')->withInput();
        }
        $this->childtaskModel->save([
            'task_id' => $id,
            'concern' => $concern,
            'due_date' => date("Y-m-d", strtotime($date)),
            'pic' => $pic,
            'status' => 'In Progress',
            'approve' => 1,
            'description' => NULL,
            'file' => $file,
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        $ct_id = $this->childtaskModel->getInsertID();
        $this->childapproveModel->save([
            'child_task_id' => $ct_id,
            'file' => NULL,
            'approve_user' => $user_app,
            'update_date' => date("Y-m-d", time()),
            'notes' => NULL,
            'approve' => 1,
            'routes' => 1,
            'updated' => 0,
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        if(isset($ftask)){ 
            session()->setFlashData('pesannewchildtask', 'Success! new child task has been created ✓');
            return redirect()->to(base_url('task')); }
        if(isset($fdash)){ 
            session()->setFlashData('pesannewchildtask', 'Success! new child task has been created ✓');
            return redirect()->to(base_url('task')); }
        if(isset($fproj)){
            session()->setFlashData('pesan', 'Success! new child task has been created ✓');
            return redirect()->to(base_url('project/detailproject/' . $project_id . '/' . $idc)); }
    }

    public function updatechildtask($id = NULL)
    {
        $file = $this->request->getFile('fileapp');
        $project_name = $this->request->getVar('project_name');
        $rf = $this->request->getVar('required_file');
        if ($rf != 'No') {
            if(!$this->validate([
                'fileapp' => [
                    'uploaded[fileapp]',
                    'mime_in[fileapp,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[fileapp,50000]',
                ]
            ])) {
                session()->setFlashData('errordoc', 'Failed! Please upload document');
                return redirect()->to('task')->withInput();
            }
        }
        if(!$this->validate([
            'desc' => [ 'required'
            ]
        ])) {
            session()->setFlashData('errornotes', 'Failed! Please add notes');
            return redirect()->to('task')->withInput();
        }
        // dd($project_name, $rf, $file);
        $desc = $this->request->getVar('desc');
        if ($file->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $file->getName();
            $file->move('public/theme/assets/document/'.$project_name, $nama);
        }
        $data = [
            'file' => $nama,
            'notes' => NULL,
            'updated' => 1,
            'updated_at' => date('Y-m-d H:i:s', time()),
        ];
        $this->builder = $this->db->table('child_task_approval');
        $this->builder->where('child_task_id', $id);
        $this->builder->update($data);
        $this->childtaskModel->save([
            'id' => $id,
            'namafile' => $nama,
            'status' => 'Waiting Approve',
            'description' => $desc,
            'updated_at' => date('Y-m-d H:i:s', time()),
        ]);
        session()->setFlashData('pesanapprove', 'Success request approve child task ✓');
        return redirect()->to(base_url('task'));
    }

    
    public function approvechildtask($id = NULL)
    {
        $reject = $this->request->getVar('reject');
        $a_id = $this->request->getVar('approval_id');
        $status = $this->request->getVar('status_task');
        $notes = $this->request->getVar('notes');
        $approve_number = $this->request->getVar('approve_number');
        $this->builder = $this->db->table('approval');
        $this->builder->selectCount('task_id');
        $this->builder->where('task_id', $id);
        $query = $this->builder->get();
        $query = $query->getResult();
        $count_approve = $query[0]->task_id;
        // dd($id, $a_id, $notes);
        if (isset($reject)) {
            $this->childtaskModel->save([
                'id' => $id,
                'status' => 'Revise',
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
            $this->childapproveModel->save([
                'id' => $a_id,
                'notes' => $notes,
                'approve' => 404,
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
            session()->setFlashData('pesan', 'Success revise child task ✓');
            return redirect()->to(base_url('task'));
        }
        $approve = $this->request->getVar('approve');
        // dd($count_approve);
        if (isset($approve)) {
            if($status == 'In Progress' || $status == 'Waiting Approve') {
                $statusnum = 1;
            } else {
                $statusnum = substr($status,-1) + 1;
            }
            // if (($count_approve - 1) >= $statusnum) {
            //     $approve = 'Done';
            // } else {
            //     $approve = 'Approve ' . $statusnum;
            // }
            $this->childapproveModel->save([
                'id' => $a_id,
                'notes' => $notes,
                'approve' => 202,
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);
            $this->builder = $this->db->table('child_task_approval');
            $this->builder->where('child_task_id', $id);
            $app = $this->builder->get();
            $app = $app->getResult();
            foreach ($app as $ap) {
                $route[] = $ap->approve;
            }
            // dd($route);
            if(in_array($approve_number, $route)) { 
                $this->childtaskModel->save([
                    'id' => $id,
                    'status' => 'Done',
                    'approve' => $approve_number,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            } else {
                $approve_number = $this->request->getVar('approve_number') + 1;
                $this->childtaskModel->save([
                    'id' => $id,
                    'status' => 'Done',
                    'approve' => $approve_number,
                    'updated_at' => date('Y-m-d H:i:s', time()),
                ]);
            }
        session()->setFlashData('pesan', 'Success approve child task ✓');
        return redirect()->to(base_url('task'));
        }
    }

}