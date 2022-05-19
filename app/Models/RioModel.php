<?php

namespace App\Models;

use CodeIgniter\Model;

class RioModel extends Model
{

    protected $table = 'rio';
    protected $allowedFields = ['id', 'project_id', 'type', 'closing_statement', 'description', 'rio', 'due_date', 'status', 'pic', 'approve', 'file', 'notes_file'];
    public function getRio($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
    
    public function getCountRioInProgress()
    {
        return $this->db->table($this->table)
         ->where('pic', user()->id)
         ->where('status', 'In Progress')
         ->where('due_date >=', date("Y-m-d", time()))
         ->countAllResults();
    }
    
    public function getCountRioOverDue()
    {
        return $this->db->table($this->table)
         ->where('pic', user()->id)
         ->where('status', 'In Progress')
         ->where('due_date <', date("Y-m-d", time()))
         ->countAllResults();
    }
    
    public function getCountRioWaiting()
    {
        return $this->db->table($this->table)
         ->where('pic', user()->id)
         ->where('status', 'Waiting Approve')
         ->countAllResults();
    }

    public function getRiobyProject($id)
    {
        return $this->db->table($this->table)
        ->select('rio.id as rid, project_name, type, rio.description, approval_rio.notes as clostat, closing_statement, rio, due_date, fullname, rio.status, rio.file, rio.approve, approval_rio.file as filename')
        ->join('project', 'rio.project_id = project.id')
        ->join('approval_rio', 'rio.id = approval_rio.rio_id')
        ->join('users', 'users.id = rio.pic')
        ->where('rio.project_id', $id)
        ->orderBy('status', 'DESC')
        ->get()->getResult();
    }

    public function getRiobyId($id)
    {
        $arr = $this->db->table($this->table)
        ->select('rio.id as rid, project_name, type, rio.description, approval_rio.notes as clostat, closing_statement, rio, due_date, fullname, rio.status, rio.file, rio.approve, approval_rio.approve_user')
        ->join('project', 'rio.project_id = project.id')
        ->join('approval_rio', 'rio.id = approval_rio.rio_id')
        ->join('users', 'users.id = rio.pic')
        // ->join('users', 'users.id = approval_rio.approve_user')
        ->where('rio.id', $id)
        ->get()->getRow();
        $approveUser = $this->db->table('approval_rio')
        ->select('fullname as user_approval, approval_rio.approve as app')
        ->join('users', 'users.id = approval_rio.approve_user')
        ->where('approval_rio.rio_id', $id)
        ->get()->getRow();
        $arr = (array) $arr;
        $approveUser = (array) $approveUser;
        $newArr = array_merge($arr, $approveUser);
        $object = (object) $newArr;
        // dd($object);
        return $object;
    }
    
    public function getChildRiobyProject($id)
    {
        return $this->db->table('child_rio')
        ->select('child_rio.*, child_rio.id as rid, fullname, project_name, type, child_rio_approval.notes, child_rio_approval.file as filename')
        ->join('rio', 'rio.id = child_rio.rio_id')
        ->join('project', 'rio.project_id = project.id')
        ->join('child_rio_approval', 'child_rio.id = child_rio_approval.child_rio_id')
        ->join('users', 'users.id = child_rio.pic')
        ->where('rio.project_id', $id)
        ->orderBy('status', 'DESC')
        ->get()->getResult();
    }
    
    public function getChildRiobyId($id)
    {
        $arr = $this->db->table('child_rio')
        ->select('child_rio.*, child_rio.id as rid, fullname, project_name, type, child_rio_approval.notes')
        ->join('rio', 'rio.id = child_rio.rio_id')
        ->join('project', 'rio.project_id = project.id')
        ->join('child_rio_approval', 'child_rio.id = child_rio_approval.child_rio_id')
        ->join('users', 'users.id = child_rio.pic')
        ->where('child_rio.id', $id)
        ->get()->getRow();
        $approveUser = $this->db->table('child_rio_approval')
        ->select('fullname as user_approval, child_rio_approval.approve as app')
        ->join('users', 'users.id = child_rio_approval.approve_user')
        ->where('child_rio_approval.child_rio_id', $id)
        ->get()->getRow();
        $arr = (array) $arr;
        $approveUser = (array) $approveUser;
        $newArr = array_merge($arr, $approveUser);
        $object = (object) $newArr;
        return $object;
    }

}
