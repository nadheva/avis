<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id', 'username', 'fullname', 'email', 'section_id', 'level_id', 'department_id', 'section', 'user_image'];

    public function getAdmin($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
    public function saveAdmin($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    function change_pass($session_id, $new_pass)
    {
        $update_pass = $this->db->query("UPDATE users set password_hash='$new_pass' where id='$session_id'");
    }

    public function getAllUsers($id = NULL)
    {
        $query = $this->db->table($this->table)
        ->select('users.id as userid, level_name, depart_name, section_name, fullname, level_id, user_image, email, created_at')
        ->join('department', 'department.id = users.department_id')
        ->join('section', 'section.id = users.section_id')
        ->join('level', 'level.id = users.level_id')
        ->orderBy('level_id', 'ASC');
        // dd($query->get()->getResult());
        if($id === NULL){
            return $query->get();
        }else{
            return $query->where('users.id', $id)->get();
        }
    }
    
    public function getLevel(){
        return $this->db->table('level')->where('level_name !=', '-')->get()->getResult();
    }
    
    public function getDepart(){
        return $this->db->table('department')->where('depart_name !=', '-')->get()->getResult();
    }
    
    public function getSectionn($id){
        return $this->db->table('section')->where('department_id', $id)->get()->getResult();
    }
    
    public function getSection(){
        return $this->db->table('section')->where('section_name !=', '-')->get()->getResult();
    }

    public function getNotif(){
        $this->builder = $this->db->table('task');
        $this->builder->where('pic', user()->id);
        $this->builder->where('task.status', 'In Progress');
        $task = $this->builder->get()->getResult();
        if (count($task) != 0) {
            foreach ($task as $row) {
                if(strtotime($row->due_date) < time() && $row->status == 'In Progress') {
                    $overdue[] = $row->id;
                } else {
                    $overdue = [];
                }
            }
            foreach($task as $row) {
                if (strtotime($row->due_date) >= time() && $row->status == 'In Progress'){
                    $open[] = $row->concern;
                } else {
                    $open = [];
                }
            }
        } else {
            $overdue = [];
            $open = [];
        }
        // dd($open);
        $this->builder = $this->db->table('approval');
        $this->builder->where('approve_user', user()->id);
        $this->builder->where('updated', 1);
        $approval = $this->builder->get()->getResult();
        if (count($approval) != 0) {
            foreach ($approval as $row) {
                if($row->approve != 202 && $row->approve != 404) {
                    $reqapprove_task[] = $row->id;
                }
            } if(!isset($reqapprove_task)) {
                $reqapprove_task = [];
            }
        } else {
            $reqapprove_task = [];
        }
        $this->builder = $this->db->table('child_task');
        $this->builder->where('pic', user()->id);
        $this->builder->where('child_task.status', 'In Progress');
        $child_task = $this->builder->get()->getResult();
        if (count($child_task) != 0) {
            foreach ($child_task as $row) {
                if(strtotime($row->due_date) < time() && $row->status == 'In Progress') {
                    $ctoverdue[] = $row->id;
                } else {
                    $ctoverdue = [];
                }
                if (strtotime($row->due_date) >= time() && $row->status == 'In Progress'){
                    $ctopen[] = $row->id;
                } else {
                    $ctopen = [];
                }
            }
        } else {
            $ctopen = [];
            $ctoverdue = [];
        }
        $this->builder = $this->db->table('child_task_approval');
        $this->builder->where('approve_user', user()->id);
        $this->builder->where('updated', 1);
        $child_task_approval = $this->builder->get()->getResult();
        if (count($child_task_approval) != 0) {
            foreach ($child_task_approval as $row) {
                if($row->approve != 202 && $row->approve != 404) {
                    $reqapprove_childtask[] = $row->id;
                }
            } if(!isset($reqapprove_childtask)) {
                $reqapprove_childtask = [];
            }
        } else {
            $reqapprove_childtask = [];
        }
        $this->builder = $this->db->table('rio');
        $this->builder->where('pic', user()->id);
        $this->builder->where('rio.status', 'In Progress');
        $rio = $this->builder->get()->getResult();
        if (count($rio) != 0) {
            foreach ($rio as $row) {
                if(strtotime($row->due_date) < time() && $row->status == 'In Progress') {
                    $riooverdue[] = $row->id;
                } else {
                    $riooverdue = [];
                }
                if (strtotime($row->due_date) >= time() && $row->status == 'In Progress'){
                    $rioopen[] = $row->id;
                } else {
                    $rioopen = [];
                }
            }
        } else {
            $riooverdue = [];
            $rioopen = [];
        }
        $this->builder = $this->db->table('child_rio');
        $this->builder->where('pic', user()->id);
        $this->builder->where('child_rio.status', 'In Progress');
        $child_rio = $this->builder->get()->getResult();
        if (count($child_rio) != 0) {
            foreach ($child_rio as $row) {
                if(strtotime($row->due_date) < time() && $row->status == 'In Progress') {
                    $childrio_overdue[] = $row->id;
                } else {
                    $childrio_overdue = [];
                }
                if (strtotime($row->due_date) >= time() && $row->status == 'In Progress'){
                    $childrio_open[] = $row->id;
                } else {
                    $childrio_open = [];
                }
            }
        } else {
            $childrio_open = [];
            $childrio_overdue = [];
        }
        $this->builder = $this->db->table('approval_rio');
        $this->builder->where('approve_user', user()->id);
        $this->builder->where('updated', 1);
        $approval_rio = $this->builder->get()->getResult();
        if (count($approval_rio) != 0) {
            foreach ($approval_rio as $row) {
                if($row->approve != 202 && $row->approve != 404) {
                    $reqapprove_rio[] = $row->id;
                }
            } if (!isset($reqapprove_rio)) {
                $reqapprove_rio = [];
            }
        } else {
            $reqapprove_rio = [];
        }
        $this->builder = $this->db->table('child_rio_approval');
        $this->builder->where('approve_user', user()->id);
        $this->builder->where('updated', 1);
        $child_rio_approval = $this->builder->get()->getResult();
        if (count($child_rio_approval) != 0) {
            foreach ($child_rio_approval as $row) {
                if($row->approve != 202 && $row->approve != 404) {
                    $reqapprove_child_rio[] = $row->id;
                } 
            } if (!isset($reqapprove_child_rio)) {
                $reqapprove_child_rio = [];
            }
        } else {
            $reqapprove_child_rio = [];
        }
        $this->builder = $this->db->table('engchange_approval');
        $this->builder->where('approve_user', user()->id);
        $engchange_approval = $this->builder->get()->getResult();
        if (count($engchange_approval) != 0) {
            foreach ($engchange_approval as $row) {
                if($row->approve != 202 && $row->approve != 0) {
                    $reqapprove_fourm[] = $row->id;
                }
            } 
            if (!isset($reqapprove_fourm)) {
                $reqapprove_fourm = [];
            }
        } else {
            $reqapprove_fourm = [];
        }
        $this->builder = $this->db->table('bom_approval');
        $this->builder->where('user_approval', user()->id);
        $this->builder->join('bom_file', 'bom_file.id = bom_approval.id_bom');
        $this->builder->where('bom_approval.approve !=', 404);
        $this->builder->where('bom_approval.approve !=', 202);
        $this->builder->where('bom_file.status !=', 'Rejected');
        $reqapprove_bom = $this->builder->get()->getResult();
        
        $this->builder = $this->db->table('baan_approval');
        $this->builder->where('user_approval', user()->id);
        $this->builder->join('baan_file', 'baan_file.id = baan_approval.id_baan');
        $this->builder->where('baan_approval.approve_status !=', 404);
        $this->builder->where('baan_approval.approve_status !=', 202);
        $this->builder->where('baan_file.status !=', 'Revise');
        $reqapprove_baan = $this->builder->get()->getResult();

        $this->builder = $this->db->table('bom_file');
        $this->builder->where('uploader', user()->id);
        $this->builder->where('bom_file.status', 'Rejected');
        $reject_bom = $this->builder->get()->getResult();

        $this->builder = $this->db->table('bom_approval_status');
        $this->builder->where('user_approval', user()->id);
        $bom_approval_status = $this->builder->get()->getResult();
        if (count($bom_approval_status) != 0) {
            foreach ($bom_approval_status as $row) {
                if($row->approve != 202 && $row->approve != 404) {
                    $reqapprove_bom_status[] = $row->id;
                }
            }
            if(!isset($reqapprove_bom_status)){
                $reqapprove_bom_status = [];
            }
        } else {
            $reqapprove_bom_status = [];
        }
        // dd($reject_bom);
        $notif = new AdminModel();
        $notif->task_open = count($open);
        $notif->task_overdue = count($overdue);
        $notif->task_requestapprove = count($reqapprove_task);
        $notif->ctask_open = count($ctopen);
        $notif->ctask_overdue = count($ctoverdue);
        $notif->ctask_requestapprove = count($reqapprove_childtask);
        $notif->rio_open = count($rioopen);
        $notif->rio_overdue = count($riooverdue);
        $notif->rio_requestapprove = count($reqapprove_rio);
        $notif->childrio_open = count($childrio_open);
        $notif->childrio_overdue = count($childrio_overdue);
        $notif->childrio_requestapprove = count($reqapprove_child_rio);
        $notif->reqapprove_fourm = count($reqapprove_fourm);
        $notif->reqapprove_bom = count($reqapprove_bom);
        $notif->reqapprove_bom_status = count($reqapprove_bom_status);
        $notif->reject_bom = count($reject_bom);
        $notif->reqapprove_baan = count($reqapprove_baan);
        $notifArr = [count($open),count($overdue),count($reqapprove_task),count($ctopen),count($ctoverdue),count($reqapprove_childtask),count($rioopen),count($riooverdue),count($reqapprove_rio),count($childrio_open),count($childrio_overdue),count($reqapprove_child_rio),count($reqapprove_fourm),count($reqapprove_bom),count($reqapprove_bom_status),count($reject_bom),count($reqapprove_baan)];
        foreach ($notifArr as $val) {
            if($val != 0) {
                $count_notif1 [] = $val;
            } else {
                $count_notif2 = [];
            }
        }
        if(isset($count_notif1)) {
            $notif->count_notif = count($count_notif1);
        } else {
            $notif->count_notif = count($count_notif2);
        }
        // dd($notif);
        return $notif;
    }
}
