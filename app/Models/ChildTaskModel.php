<?php

namespace App\Models;

use CodeIgniter\Model;

class ChildTaskModel extends Model
{

    protected $table = 'child_task';
    protected $allowedFields = ['id', 'task_id', 'namafile', 'description', 'file', 'approve', 'concern' ,'due_date', 'updated_at', 'pic', 'status'];
    public function getChildTask($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
