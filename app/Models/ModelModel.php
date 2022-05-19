<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelModel extends Model
{

    protected $table = 'model';
    protected $allowedFields = ['id', 'model'];
    public function getModel($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
