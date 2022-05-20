<?php

namespace App\Models;

use CodeIgniter\Model;

class KaryawanModel extends Model
{
	protected $DBGroup              = 'otherDb'; // default database group
    protected $table = 'karyawan';
    protected $allowedFields = ['npk', 'nama', 'departemen', 'password'];
  
    // Change it for other database group
    // protected $DBGroup  = 'otherDb';
  
	//...
}