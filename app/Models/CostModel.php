<?php

namespace App\Models;

use CodeIgniter\Model;

class CostModel extends Model
{

    protected $table = 'budget';
    protected $allowedFields = ['id', 'smt', 'fa', 'tooling', 'total', 'used_smt', 'used_fa', 'used_tooling', 'project_id'];
    public function getBudget($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
