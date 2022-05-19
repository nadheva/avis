<?php

namespace App\Models;

use CodeIgniter\Model;

class ApproveChildTaskModel extends Model
{

    protected $table = 'child_task_approval';
    protected $allowedFields = ['id', 'approve', 'routes', 'updated', 'child_task_id', 'notes', 'file', 'approve_user', 'update_date', 'updated_at'];
    public function getApproveChildTask($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
