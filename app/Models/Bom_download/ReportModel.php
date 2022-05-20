<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
	protected $DBGroup              = 'otherDb'; // default database group
    protected $table = 'report';
    protected $allowedFields = ['id', 'date', 'npk', 'model', 'file'];
  
    // Change it for other database group
    // protected $DBGroup  = 'otherDb';
  
	//...
}