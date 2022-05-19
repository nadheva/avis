<?php

namespace App\Models;

use CodeIgniter\Model;

class BomModel extends Model
{

    protected $table = 'bom_file';
    protected $allowedFields = ['id', 'id_model', 'upload_date', 'notes', 'approve', 'approve_status', 'nama_file', 'status', 'uploader'];
    public function getBom($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    public function getBomFilebyModel($idm)
    {
        $this->builder = $this->db->table('bom_file');
        $this->builder->select('model, nama_file, uploader, bom_file.id, fullname, bom_file.status, id_model, notes, upload_date');
        $this->builder->join('model', 'model.id = bom_file.id_model');
        $this->builder->join('users', 'users.id = bom_file.uploader');
        $this->builder->orderBy('status', 'ASC');
        $this->builder->where('id_model', $idm);
        $bom = $this->builder->get()->getResult();
        return $bom;
    }

    public function getListUserApp() 
    {
        $this->builder = $this->db->table('users');
        $this->builder->where('role', 'user');
        return $this->builder->get()->getResult();  
    }

    public function getType() 
    {
        $this->builder = $this->db->table('baan_type');
        return $this->builder->get()->getResult();  
    }

    public function getApproveBom($id = NULL)
    {
        if($id == NULL){     
            $this->builder = $this->db->table('bom_approval');
            $this->builder->select('bom_approval.*, model, bom_file.status, nama_file, upload_date, fullname, routes, bom_approval.approve as ap, bom_file.approve as bom_app, bom_file.notes as banotes, bom_file.id_model');
            $this->builder->join('bom_file', 'id_bom = bom_file.id');
            $this->builder->join('model', 'model.id = bom_file.id_model');
            $this->builder->join('users', 'users.id = bom_approval.user_approval');
            // $this->builder->where('user_approval', user()->id);
            return $this->builder->get()->getResult();
        } else {
            $this->builder = $this->db->table('bom_approval');
            $this->builder->select('bom_approval.*, model, bom_file.status, nama_file, upload_date, fullname, routes, bom_approval.approve as ap, bom_file.approve as bom_app, uploader, bom_file.notes as banotes, bom_file.id_model');
            $this->builder->join('bom_file', 'id_bom = bom_file.id');
            $this->builder->join('model', 'model.id = bom_file.id_model');
            $this->builder->join('users', 'users.id = bom_file.uploader');
            $this->builder->where('user_approval', $id);
            return $this->builder->get()->getResult();
        }
    }

    public function getChangeStatusBom($id = NULL)
    {
        if($id == NULL){     
            $this->builder = $this->db->table('bom_approval_status');
            $this->builder->select('bom_approval_status.*, model, bom_file.status, nama_file, bom_approval_status.approve as ap, bom_file.approve_status as bom_app, bom_file.notes as banotes');
            $this->builder->join('bom_file', 'id_bom = bom_file.id');
            $this->builder->join('model', 'model.id = bom_file.id_model');
            $this->builder->join('users', 'users.id = bom_approval_status.user_approval');
            // $this->builder->where('user_approval', user()->id);
            return $this->builder->get()->getResult();
        } else {
            $this->builder = $this->db->table('bom_approval_status');
            $this->builder->select('bom_approval_status.*, model, bom_file.status, nama_file, bom_approval_status.approve as ap, bom_file.approve_status as bom_app, bom_file.notes as banotes');
            $this->builder->join('bom_file', 'id_bom = bom_file.id');
            $this->builder->join('model', 'model.id = bom_file.id_model');
            $this->builder->join('users', 'users.id = bom_approval_status.user_approval');
            $this->builder->where('user_approval', $id);
            return $this->builder->get()->getResult();
        }
    }
}
