<?php

namespace App\Models;

use CodeIgniter\Model;

class ApproveModel extends Model
{

    protected $table = 'approval';
    protected $allowedFields = ['id', 'approve', 'routes', 'updated', 'task_id', 'notes', 'file', 'approve_user', 'update_date', 'updated_at'];
    public function getApprove($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
