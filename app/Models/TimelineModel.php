<?php

namespace App\Models;

use CodeIgniter\Model;

class TimelineModel extends Model
{

    protected $table = 'timeline';
    protected $allowedFields = ['id', 'timeline_name', 'project_id', 'start', 'finish'];
    public function getTimeline($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }
}
