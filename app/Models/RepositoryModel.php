<?php

namespace App\Models;

use CodeIgniter\Model;

class RepositoryModel extends Model
{
    public function getFileRiobyProject($id)
    {
        return $this->db->table('rio')
        ->select('rio.id as rid, project_name, type, rio.description, approval_rio.notes as clostat, closing_statement, rio, due_date, fullname, rio.status, rio.file, rio.approve')
        ->join('project', 'rio.project_id = project.id')
        ->join('approval_rio', 'rio.id = approval_rio.rio_id')
        ->join('users', 'users.id = rio.pic')
        ->where('rio.project_id', $id)
        ->orderBy('status', 'DESC')
        ->get()->getResult();
    }
}
