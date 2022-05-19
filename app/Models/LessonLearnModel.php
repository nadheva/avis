<?php

namespace App\Models;

use CodeIgniter\Model;

class LessonLearnModel extends Model
{

    protected $table = 'lessonlearn';
    protected $primary_key = 'id';
    protected $allowedFields = ['id', 'file', 'project_id', 'source', 'status', 'problem', 'countermeasure', 'rootcause', 'prevention', 'remaks', 'created_at'];
    
    public function getLessonbyProject($id)
    {
        return $this->db->table($this->table)
        ->select('lessonlearn.*')
        ->join('project', 'lessonlearn.project_id = project.id')
        ->where('lessonlearn.project_id', $id)
        ->orderBy('lessonlearn.status' , 'DESC')
        ->get()->getResult();
    }

    public function getAllLesson($id=NULL)
    {
        if($id==NULL){
            return $this->db->table($this->table)
            ->select('lessonlearn.*, project_name')
            ->join('project', 'lessonlearn.project_id = project.id')
            ->orderBy('lessonlearn.status' , 'DESC')
            ->get()->getResult();
        } else {
            return $this->db->table($this->table)
            ->select('lessonlearn.*, project_name')
            ->join('project', 'lessonlearn.project_id = project.id')
            ->where('lessonlearn.id', $id)
            ->orderBy('lessonlearn.status' , 'DESC')
            ->get()->getRow();
        }
    }
}
