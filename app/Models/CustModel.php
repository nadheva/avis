<?php

namespace App\Models;

use CodeIgniter\Model;

class CustModel extends Model
{

    protected $table = 'customer';
    protected $allowedFields = ['id', 'customer_name', 'type'];
    public function getCust($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
