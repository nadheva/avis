<?php

namespace App\Models;

use CodeIgniter\Model;

class MguidelineModel extends Model
{

    protected $table = 'mg_area';
    protected $allowedFields = ['id', 'area'];

    public function getArea($id=false)
    {
        if($id==false){
            $area = $this->db->table($this->table)
            ->get()->getResult();
            $process = $this->db->table('mg_process')
            ->get()->getResult();
            return $area;
        } else {
            return $this->db->table($this->table)
            ->where('id', $id)
            ->get()->getRow();
        }
    }

    public function getProcess($area_id=NULL, $process_id=NULL)
    {
        if($process_id == NULL) {
            if($area_id == NULL) {
                return $this->db->table("mg_process")
                ->select('process_name, mg_area.id as area_id, mg_process.id, photo, mfg_spec, equip_spec')
                ->join('mg_area', 'mg_area.id = mg_process.area_id')
                ->get()->getResult();
            }
            return $this->db->table("mg_process")
            ->select('process_name, mg_process.id, photo, mfg_spec, equip_spec')
            ->join('mg_area', 'mg_area.id = mg_process.area_id')
            ->where('area_id', $area_id)
            ->get()->getResult();
        } else {
            return $this->db->table("mg_process")
            ->select('process_name, mg_process.id')
            ->join('mg_area', 'mg_area.id = mg_process.area_id')
            ->where('area_id', $area_id)
            ->where('mg_process.id', $process_id)
            ->get()->getRow();
        }
    }

    public function getFile($area_id = NULL, $process_id = NULL, $id = NULL)
    {
        if($id == NULL) {
            return $this->db->table("mg_file")
            ->select('mg_file.id, filename')
            ->join('mg_area', 'mg_area.id = mg_file.area_id')
            ->join('mg_process', 'mg_process.id = mg_file.process_id')
            ->where('mg_file.area_id', $area_id)
            ->where('mg_file.process_id', $process_id)
            ->get()->getResult();
        } else {
            return $this->db->table("mg_file")
            ->select('mg_file.id, filename')
            ->join('mg_area', 'mg_area.id = mg_file.area_id')
            ->join('mg_process', 'mg_process.id = mg_file.process_id')
            ->where('mg_file.area_id', $area_id)
            ->where('mg_file.process_id', $process_id)
            ->where('mg_file.id', $id)
            ->get()->getRow();
        }
    }
}
