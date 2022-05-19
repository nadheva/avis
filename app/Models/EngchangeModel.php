<?php

namespace App\Models;

use CodeIgniter\Model;

class EngchangeModel extends Model
{

    protected $table = 'engchange_4m';
    protected $allowedFields = ['id', 'fourm'];

    public function getFourm($id=false)
    {
        if($id==false){
            $fourm = $this->db->table($this->table)
            ->get()->getResult();
            return $fourm;
        } else {
            return $this->db->table($this->table)
            ->where('id', $id)
            ->get()->getRow();
        }
    }

    public function getRequest($project_id=NULL, $fourm_id=NULL)
    {
        if($project_id == NULL && $fourm_id == NULL) {
            return $this->db->table("engchange_request")
            ->select('engchange_request.*, fullname, fourm, engchange_request.created_at, file, project_name')
            ->join('engchange_4m', 'engchange_4m.id = engchange_request.fourm_id')
            ->join('users', 'users.id = engchange_request.issuer')
            ->join('project', 'project.id = engchange_request.project_id')
            ->orderby('status', 'DESC')
            ->get()->getResult();
        }
        return $this->db->table("engchange_request")
        ->select('engchange_request.*, fullname, fourm, engchange_request.created_at, file')
        ->join('engchange_4m', 'engchange_4m.id = engchange_request.fourm_id')
        ->join('users', 'users.id = engchange_request.issuer')
        ->where('project_id', $project_id)
        ->where('fourm_id', $fourm_id)
        ->get()->getResult();
    }

    public function getRequestbyId($id)
    {
        $arr = $this->db->table("engchange_request")
        ->select('engchange_request.*, fullname, fourm, engchange_request.created_at, file, project_name')
        ->join('engchange_4m', 'engchange_4m.id = engchange_request.fourm_id')
        ->join('users', 'users.id = engchange_request.issuer')
        ->join('project', 'project.id = engchange_request.project_id')
        ->where('engchange_request.id', $id)
        ->get()->getRow();
        $approveUser = $this->db->table('engchange_approval')
        ->select('engchange_approval.*, engchange_approval.approve as app, fullname, routes')
        ->join('users', 'users.id = engchange_approval.approve_user')
        ->where('engchange_approval.req_id', $id)
        ->orderBy('routes', 'ASC')
        ->get()->getResultArray();
        $arr = (array) $arr;
        $approveUser = (array) $approveUser;
        $newApp['userapp'] = $approveUser;
        $newArr = array_merge($arr, $newApp);
        $out = (object) $newArr;
        return $out;
    }

    public function getAtasan() 
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("department_id", user()->department_id)
        ->where("level_id", 5)
        ->get()->getRow();
    }

    public function getDeptHeadQuality() 
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("department_id", 3)
        ->where("level_id", 5)
        ->get()->getRow();
    }

    public function getSectHeadEng() 
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("department_id", 1)
        ->where("level_id", 6)
        ->get()->getResult();
    }

    public function getSectHeadEhs() 
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 6)
        ->where("department_id", 7)
        ->where("section_id", 11)
        ->get()->getRow();
    }

    public function getUserDeptQuality() 
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("department_id", 3)
        ->where("level_id", 6)
        ->get()->getResult();
    }
}
