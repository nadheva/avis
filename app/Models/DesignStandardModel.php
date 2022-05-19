<?php

namespace App\Models;

use CodeIgniter\Model;

class DesignStandardModel extends Model
{

    protected $table = 'design_standard';
    protected $allowedFields = ['id', 'area_id', 'best_practice', 'item', 'photo'];
    public function getDesign($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['area_id' => $id])->findAll();
        }
    }
}
