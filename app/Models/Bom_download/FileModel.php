<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
	protected $DBGroup              = 'otherDb'; // default database group
    protected $table = 'file';
    protected $allowedFields = ['id', 'namafile', 'model', 'uploader'];
    public function getModel()
    {             
        $query =  $this->db->table('file')
         ->join('model', 'file.model = model.id_model')
         ->get();  
        return $query;
    }
    // Change it for other database group
    // protected $DBGroup  = 'otherDb';
  
	//...
}