<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{

    protected $table = 'bom_log';
    protected $allowedFields = ['id', 'model', 'user', 'date', 'file'];
    public function getLog($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
