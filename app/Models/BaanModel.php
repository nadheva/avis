<?php

namespace App\Models;

use CodeIgniter\Model;

class BaanModel extends Model
{

    protected $table = 'baan_file';
    protected $allowedFields = ['id', 'id_model', 'type_id', 'upload_date', 'description', 'approve', 'approve_status', 'filename', 'status', 'uploader'];
    public function getBom($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    public function getBaanFilebyModel($idm)
    {
        $this->builder = $this->db->table('baan_file');
        $this->builder->select('model, filename, uploader, baan_file.id, fullname, baan_file.status, id_model, description, upload_date, type_id, type, approve');
        $this->builder->join('model', 'model.id = baan_file.id_model');
        $this->builder->join('users', 'users.id = baan_file.uploader');
        $this->builder->join('baan_type', 'baan_type.id = baan_file.type_id');
        $this->builder->orderBy('status', 'ASC');
        $this->builder->where('id_model', $idm);
        $baan = $this->builder->get()->getResult();
        return $baan;
    }

    public function getApproveBaan($id = NULL)
    {
        if($id == NULL){     
            $this->builder = $this->db->table('baan_approval');
            $this->builder->select('baan_approval.*, model, baan_file.status, filename, upload_date, fullname, routes, baan_approval.approve as ap, baan_approval.approve_status as appstat, baan_file.approve as bom_app, baan_file.description as banotes, notes');
            $this->builder->join('baan_file', 'id_baan = baan_file.id');
            $this->builder->join('model', 'model.id = baan_file.id_model');
            $this->builder->join('users', 'users.id = baan_approval.user_approval');
            // $this->builder->where('user_approval', user()->id);
            return $this->builder->get()->getResult();
        } else {
            $this->builder = $this->db->table('baan_approval');
            $this->builder->select('baan_approval.*, model, baan_file.status, filename, upload_date, fullname, routes, baan_approval.approve as ap, baan_file.approve as bom_app, uploader, baan_file.description as banotes, type');
            $this->builder->join('baan_file', 'id_baan = baan_file.id');
            $this->builder->join('model', 'model.id = baan_file.id_model');
            $this->builder->join('users', 'users.id = baan_file.uploader');
            $this->builder->join('baan_type', 'baan_type.id = baan_file.type_id');
            $this->builder->where('user_approval', $id);
            return $this->builder->get()->getResult();
        }
    }
    
    //section head finance
    public function getApprovalFinance()
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 6)
        ->where("department_id", 6)
        ->where("section_id", 15)
        ->get()->getRow();
    }
    
    //section head purchasing
    public function getApprovalPurchasing()
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 6)
        ->where("department_id", 4)
        ->where("section_id", 9)
        ->get()->getRow();
    }
    
    public function getApprovalRnD()
    {
        //dept head rnd
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 5)
        ->where("department_id", 2)
        ->where("section_id", 0)
        ->get()->getRow();
    }

    //requestor
    public function getApprovalReq()
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("id", user()->id)
        ->get()->getRow();
    }
    
    public function getApprovalSectHeadEngAt()
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 6)
        ->where("department_id", 1)
        ->where("section_id", 1)
        ->get()->getRow();
    }
    
    public function getApprovalSectHeadEngSmt()
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 6)
        ->where("department_id", 1)
        ->where("section_id", 3)
        ->get()->getRow();
    }
    
    public function getApprovalSectHeadEngFa()
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 6)
        ->where("department_id", 1)
        ->where("section_id", 2)
        ->get()->getRow();
    }
    
    public function getApprovalEng()
    {
        //dept head eng
        // return $this->db->table("users")
        // ->select("fullname, id")
        // ->where("level_id", 5)
        // ->where("department_id", 1)
        // ->where("section_id", 0)
        // ->get()->getRow();
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 6)
        ->where("department_id", 1)
        ->where("section_id", 1)
        ->get()->getRow();
    }
    
    //section head ppic
    public function getApprovalPpic()
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 6)
        ->where("department_id", 4)
        ->where("section_id", 7)
        ->get()->getRow();
    }
    
    //marketing
    public function getApprovalMarketing()
    {
        return $this->db->table("users")
        ->select("fullname, id")
        ->where("level_id", 4)
        ->where("department_id", 0)
        ->where("section_id", 0)
        ->get()->getRow();
    }
}
