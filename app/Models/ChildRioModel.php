<?php

namespace App\Models;

use CodeIgniter\Model;

class ChildRioModel extends Model
{

    protected $table = 'child_rio';
    protected $allowedFields = ['id', 'rio_id', 'file', 'rio', 'description', 'closing_statement', 'due_date', 'pic', 'status'];

    public function getChildRio(){
        return $this->db->table($this->table)
         ->select('child_rio.id as cr_id, child_rio.rio_id as crioid, project_name, rio.rio as parent, child_rio.rio, fullname, rio.pic as picparent, child_rio.due_date, child_rio.status, child_rio.pic, child_rio.file, child_rio_approval.approve, child_rio.description, child_rio_approval.notes as crnotes, child_rio_approval.update_date')
         ->join('users', 'child_rio.pic = users.id')
         ->join('child_rio_approval', 'child_rio_approval.child_rio_id = child_rio.id')
         ->join('rio', 'rio.id = child_rio.rio_id')
         ->join('project', 'rio.project_id = project.id')
         ->where('child_rio.status !=', 'Done')
         ->get()->getResult();
    }

    public function getApprovalChildRio(){
        return $this->db->table($this->table)
         ->select('child_rio.id as cr_id, child_rio.rio_id as crioid, project_name, rio.rio as parent, child_rio.rio, fullname, rio.pic as picparent, child_rio.due_date, child_rio.status, child_rio.pic, child_rio.file, child_rio_approval.approve, child_rio.description, child_rio_approval.notes as crnotes, child_rio_approval.update_date, child_rio_approval.approve_user, updated, type')
         ->join('users', 'child_rio.pic = users.id')
         ->join('child_rio_approval', 'child_rio_approval.child_rio_id = child_rio.id')
         ->join('rio', 'rio.id = child_rio.rio_id')
         ->join('project', 'rio.project_id = project.id')
         ->where('child_rio.status !=', 'Done')
         ->get()->getResult();
    }

    
    public function getCountChildRioInProgress()
    {
        return $this->db->table($this->table)
         ->where('pic', user()->id)
         ->where('status', 'In Progress')
         ->where('due_date >=', date("Y-m-d", time()))
         ->countAllResults();
    }
    
    public function getCountChildRioOverDue()
    {
        return $this->db->table($this->table)
         ->where('pic', user()->id)
         ->where('status', 'In Progress')
         ->where('due_date <', date("Y-m-d", time()))
         ->countAllResults();
    }
    
    public function getCountChildRioWaiting()
    {
        return $this->db->table($this->table)
         ->where('pic', user()->id)
         ->where('status', 'Waiting Approve')
         ->countAllResults();
    }

    public function getCounChildRiotRequestApproval()
    {
        return $this->db->table($this->table)
         ->join('child_rio_approval', 'child_rio_approval.child_rio_id = child_rio.id')
         ->where('updated', 1)
         ->where('approve_user', user()->id)
         ->where('status !=', 'Done')
         ->countAllResults();
    }

    public function getChildUserAppRio(){
        return $this->db->table('child_rio_approval')
        ->join('users', 'users.id = child_rio_approval.approve_user')
        ->get()->getRow();
    }

    public function getChildRioAppoval(){
        return $this->db->table('child_rio_approval')
        ->join('child_rio', 'child_rio.id = child_rio_approval.child_rio_id')
        ->get()->getRow();
    }


}
