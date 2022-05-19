<?php

namespace App\Models;

use CodeIgniter\Model;

class ApproveRioModel extends Model
{

    protected $table = 'approval_rio';
    protected $allowedFields = ['id', 'rio_id', 'file', 'approve_user', 'update_date', 'notes', 'approve', 'updated'];
    public function getApproveRio($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
    
    public function getCountRequestApproval()
    {
        return $this->db->table($this->table)
         ->join('rio', 'rio.id = approval_rio.rio_id')
         ->where('updated', 1)
         ->where('approve_user', user()->id)
         ->where('status !=', 'Done')
         ->countAllResults();
    }

    public function getUserApprovalRio()
    {
        return $this->db->table($this->table)
       ->select('approval_rio.id as a_id, pic,  rio.approve as t_app, users.id, fullname, approve_user, rio.id as r_rio_id, approval_rio.rio_id as r_rio_id, type, rio, due_date, rio.status, approval_rio.approve as rap, updated, project_name, update_date, description, closing_statement')
       ->join('rio', 'rio.id = approval_rio.rio_id')
       ->join('project', 'project.id = rio.project_id')
       ->join('users', 'users.id = approval_rio.approve_user')
       ->get()->getResult();
    }

    public function getListApprovalRio()
    {
        return $this->db->table($this->table)
       ->select('approval_rio.id as a_id, pic,  rio.approve as t_app, users.id, fullname, approve_user, rio.id as r_rio_id, approval_rio.rio_id as r_rio_id, type, rio, due_date, rio.status, approval_rio.approve as rap, updated, project_name, update_date, description, closing_statement')
       ->join('rio', 'rio.id = approval_rio.rio_id')
       ->join('project', 'project.id = rio.project_id')
       ->join('users', 'users.id = rio.pic')
       ->where('rio.status !=', 'Done')
       ->get()->getResult();
    }

    public function getUserApprovalChildRio()
    {
        return $this->db->table('child_rio_approval')
       ->select('child_rio_approval.id as a_id, child_rio.pic,  child_rio.approve as t_app, users.id, fullname, child_rio_approval.approve_user, child_rio.id as r_rio_id, child_rio_approval.child_rio_id as crid, type, child_rio.rio, child_rio.due_date, child_rio.status, child_rio_approval.approve as rap, updated, project_name, update_date, child_rio.description, child_rio.closing_statement')
       ->join('child_rio', 'child_rio.id = child_rio_approval.child_rio_id')
       ->join('rio', 'child_rio.rio_id = rio.id')
       ->join('project', 'project.id = rio.project_id')
       ->join('users', 'users.id = child_rio_approval.approve_user')
    //    ->where('rio.status !=', 'Done')
    //    ->where('updated', 1)
       ->get()->getResult();
    }

    public function getListApprovalChildRio()
    {
        return $this->db->table('child_rio_approval')
       ->select('child_rio_approval.id as a_id, child_rio.pic,  child_rio.approve as t_app, users.id, fullname, approve_user, child_rio.id as r_rio_id, child_rio_approval.child_rio_id as crid, type, child_rio.rio, child_rio.due_date, child_rio.status, child_rio_approval.approve as rap, updated, project_name, update_date, child_rio.description, child_rio.closing_statement, notes')
       ->join('child_rio', 'child_rio.id = child_rio_approval.child_rio_id')
       ->join('rio', 'child_rio.rio_id = rio.id')
       ->join('project', 'project.id = rio.project_id')
       ->join('users', 'users.id = child_rio.pic')
       ->where('updated', 1)
       ->where('approve_user', user()->id)
       ->get()->getResult();
    }
}
