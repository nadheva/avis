<?php

namespace App\Models\Bom_download;

use CodeIgniter\Model;

class Model2Model extends Model
{
	protected $DBGroup              = 'otherDb'; // default database group
    protected $table = 'model';
    protected $allowedFields = ['model'];
  
    // Change it for other database group
    // protected $DBGroup  = 'otherDb';
  
	//...
}