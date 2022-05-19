<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{

    protected $table = 'task';
    protected $builder;
    protected $allowedFields = ['id', 'file', 'approve', 'description', 'project_id', 'event', 'concern' ,'due_date', 'pic', 'status', 'namafile', 'updated_at', 'request_at'];
    public function getTask($id = false)
    {
        if ($id === false) {
            return $this->db->table($this->table);
        } else {
            // return $this->where(['id' => $id])->first();
            return $this->db->table($this->table)
            ->select('task.*, fullname')
            ->join('users', 'users.id = task.pic')
            ->where('project_id', $id)->get()->getResult();
        }
    }
    public function getTaskjoinUser($id = false)
    {
    }

    public function getApproveTask()
    {
        $this->builder = $this->db->table('approval');
        $this->builder->select('approval.id as a_id, pic, approval.approve as ap, task.approve as t_app, users.id, fullname, approve_user, routes, task.id as t_task_id, notes, approval.task_id as a_task_id');
        $this->builder->join('task', 'task.id = approval.task_id');
        $this->builder->join('users', 'users.id = approval.approve_user');
        $this->builder->orderBy('approval.id', 'ASC');
        return $this->builder->get();
    }

    public function getAllTask()
    {
        $this->builder = $this->db->table('project');
        $this->builder->select('project.id as p_id, task.file as t_file, task.approve as t_app, task.description as desc, update_date, fullname, project_name, task.id as task_id, event, concern, due_date, pic, task.status, task.namafile, request_at, update_date, routes, updated, approve_user, event_name, approval.approve as ap, approval.id as a_id, approval.task_id as at_id');
        $this->builder->join('task', 'task.project_id = project.id');
        $this->builder->join('users', 'users.id = task.pic');
        $this->builder->join('approval', 'approval.task_id = task.id');
        $this->builder->join('event_internal', 'event_internal.id = task.event');
        // $this->builder->where('task.pic', user()->id);
        $this->builder->orderBy('a_id', 'DESC');
        return $this->builder->get();
    }

    public function getMyTask($pic=null)
    {
        $out = $this->db->table($this->table)
        ->select('task.*, project_name')
        ->join('project', 'project.id = task.project_id')
        ->where('pic', $pic)
        ->get()->getResult();
        return $out;
    }

    public function getChildTask($id=false)
    {
        if($id===false){
            $this->builder = $this->db->table('child_task');
            $this->builder->select('child_task.id as cid, approve_user, updated, child_task.file as c_file, child_task.task_id as ctask_id, child_task.concern, child_task.status as cstat, task.pic as tpic, child_task.pic, child_task.due_date, fullname, child_task.approve capp, project_name, child_task_approval.approve as ctapp, task.event, task.concern as parent, child_task_approval.id as cta_id, update_date, notes, child_task_approval.file as ct_file, event_name, child_task_id, child_task.description as desc');
            $this->builder->join('users', 'users.id = child_task.pic');
            $this->builder->join('task', 'task.id = child_task.task_id');
            $this->builder->join('child_task_approval', 'child_task_approval.child_task_id = child_task.id');
            $this->builder->join('project', 'task.project_id = project.id');
            $this->builder->join('event_internal', 'event_internal.id = task.event');
            return $this->builder->get();
        } else {
            return $this->db->table('child_task')
            ->select('child_task.*, fullname')
            ->join('users', 'users.id = child_task.pic')
            ->join('task', 'task.id = child_task.task_id')
            ->where('task.project_id', $id)->get()->getResult();
        }
    }

    public function getApproveChildTask()
    {
        $this->builder = $this->db->table('child_task_approval');
        $this->builder->select('child_task.id as cid, fullname, child_task_id, child_task.file, approve_user, update_date, notes, child_task.approve capp, project_name, child_task_approval.approve as ctapp, routes, updated, child_task.concern, task.event, child_task.status, child_task_approval.id as cta_id');
        $this->builder->join('users', 'approve_user = users.id');
        $this->builder->join('child_task', 'child_task.id = child_task_approval.child_task_id');
        $this->builder->join('task', 'task.id = child_task.task_id');
        $this->builder->join('project', 'task.project_id = project.id');
        return $this->builder->get();
    }

    
    public function getTaskbyId($id)
    {
        $arr = $this->db->table($this->table)
        ->select('task.*, fullname, event_name, project_name, cust_id')
        ->join('project', 'task.project_id = project.id')
        ->join('users', 'users.id = task.pic')
        ->join('customer', 'project.cust_id = customer.id')
        ->join('event_internal', 'task.event = event_internal.id')
        ->where('task.id', $id)
        ->get()->getRow();
        $approveUser = $this->db->table('approval')
        ->select('fullname as user_approval, approval.approve as app, routes')
        ->join('users', 'users.id = approval.approve_user')
        ->where('approval.task_id', $id)
        ->orderBy('routes', 'ASC')
        ->get()->getResultArray();
        $arr = (array) $arr;
        $approveUser = (array) $approveUser;
        $newApp['userapp'] = $approveUser;
        $newArr = array_merge($arr, $newApp);
        $object = (object) $newArr;
        // dd($arr, $approveUser, $newArr, $newApp, $object);
        return $object;
    }
}
