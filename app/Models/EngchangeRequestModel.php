<?php

namespace App\Models;

use CodeIgniter\Model;

class EngchangeRequestModel extends Model
{

    protected $table = 'engchange_request';
    protected $allowedFields = ['id', 'fourm_id', 'project_id', 'issuer', 'line', 'description', 'reason', 'testresult_eng', 'acknowledge_ehs', 'to_customer', 'notesmgr', 'confirm_quality', 'notes_dhqa', 'notes_mkt', 'status', 'created_at', 'file', 'approve'];

    public function getRequest($id=false)
    {
        if($id==false){
            $fourm = $this->db->table($this->table)
            ->get()->getResult();
            return $fourm;
        } else {
            return $this->db->table("engchange_request")
            ->select('engchange_request.*, fullname, fourm, engchange_request.created_at, file, project_name')
            ->join('engchange_4m', 'engchange_4m.id = engchange_request.fourm_id')
            ->join('users', 'users.id = engchange_request.issuer')
            ->join('project', 'project.id = engchange_request.project_id')
            ->where('issuer', $id)
            ->get()->getResult();
        }
    }

    public function getUserApprovalEngchange($uaid=false)
    {
        if($uaid==false) {
            return $this->db->table('engchange_approval')
           ->select('engchange_approval.*, fullname, approve_user, routes')
           ->join('engchange_request', 'engchange_request.id = engchange_approval.req_id')
           ->join('project', 'project.id = engchange_request.project_id')
           ->join('users', 'users.id = engchange_approval.approve_user')
           ->get()->getResult();
        } else {
            return $this->db->table('engchange_approval')
           ->select('engchange_approval.*, engchange_approval.id as app_id, fullname, approve_user, routes, line, description, engchange_request.status, engchange_request.id as req_id, engchange_request.approve as ecrapp, engchange_approval.approve as eapp, project_name, fourm, reason, file, engchange_request.created_at, engchange_request.*')
           ->join('engchange_request', 'engchange_request.id = engchange_approval.req_id')
           ->join('engchange_4m', 'engchange_request.fourm_id = engchange_4m.id')
           ->join('project', 'project.id = engchange_request.project_id')
           ->join('users', 'users.id = engchange_request.issuer')
           ->where('approve_user', $uaid)
           ->get()->getResult();
        }
    }
}
