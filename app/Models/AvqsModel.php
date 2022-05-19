<?php

namespace App\Models;

use CodeIgniter\Model;

class AvqsModel extends Model
{

    protected $table = 'avqs';
    protected $allowedFields = ['id', 'avqs_name'];
    public function getAvqs($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    public function getDir1($idavqs=NULL,$id=NULL) {
        if($id==NULL) {
            return $this->db->table('avqs_dir1')
            ->select('avqs_dir1.id, dir')
            ->join('avqs', 'avqs_dir1.avqs_id = avqs.id')
            ->where('avqs_id', $idavqs)
            ->get()->getResult();
        } else {
            return $this->db->table('avqs_dir1')
            ->select('avqs_dir1.id, dir')
            ->join('avqs', 'avqs_dir1.avqs_id = avqs.id')
            ->where('avqs_id', $idavqs)
            ->where('avqs_dir1.id', $id)
            ->get()->getRow();
        }
    }

    public function getDir2($idavqs=NULL, $iddir1=NULL,$id=NULL) {
        if($id==NULL) {
            if($iddir1==NULL) {
                return $this->db->table('avqs_dir2')
                ->select('avqs_dir2.id, avqs_dir2.dir, avqs_dir2.dir1_id')
                ->join('avqs', 'avqs_dir2.avqs_id = avqs.id')
                ->where('avqs_dir2.avqs_id', $idavqs)
                ->get()->getResult();
            }
            return $this->db->table('avqs_dir2')
            ->select('avqs_dir2.id, avqs_dir2.dir')
            ->join('avqs', 'avqs_dir2.avqs_id = avqs.id')
            ->join('avqs_dir1', 'avqs_dir2.dir1_id = avqs_dir1.id')
            ->where('avqs_dir2.avqs_id', $idavqs)
            ->where('avqs_dir2.dir1_id', $iddir1)
            ->get()->getResult();
        } else {
            return $this->db->table('avqs_dir2')
            ->select('avqs_dir2.id, avqs_dir2.dir')
            ->join('avqs', 'avqs_dir2.avqs_id = avqs.id')
            ->join('avqs_dir1', 'avqs_dir2.dir1_id = avqs_dir1.id')
            ->where('avqs_dir2.avqs_id', $idavqs)
            ->where('avqs_dir2.dir1_id', $iddir1)
            ->where('avqs_dir2.id', $id)
            ->get()->getRow();
        }
    }

    public function getFile($idavqs, $iddir1, $iddir2=NULL, $id=NULL)
    {
        if($id==NULL) {
            if($iddir2==NULL) {
                return $this->db->table('avqs_file')
                ->select('avqs_file.id, file, upload_at, dir2_id')
                ->join('avqs', 'avqs_file.avqs_id = avqs.id')
                ->join('avqs_dir1', 'avqs_file.dir1_id = avqs_dir1.id')
                ->where('avqs_file.avqs_id', $idavqs)
                ->where('avqs_file.dir1_id', $iddir1)
                ->get()->getResult();
            }
            return $this->db->table('avqs_file')
            ->select('avqs_file.id, file, upload_at')
            ->join('avqs', 'avqs_file.avqs_id = avqs.id')
            ->join('avqs_dir1', 'avqs_file.dir1_id = avqs_dir1.id')
            ->join('avqs_dir2', 'avqs_file.dir2_id = avqs_dir2.id')
            ->where('avqs_file.avqs_id', $idavqs)
            ->where('avqs_file.dir1_id', $iddir1)
            ->where('avqs_file.dir2_id', $iddir2)
            ->get()->getResult();
        } else {
            return $this->db->table('avqs_file')
            ->select('avqs_file.id, file, upload_at')
            ->join('avqs', 'avqs_file.avqs_id = avqs.id')
            ->join('avqs_dir1', 'avqs_file.dir1_id = avqs_dir1.id')
            ->join('avqs_dir2', 'avqs_file.dir2_id = avqs_dir2.id')
            ->where('avqs_file.avqs_id', $idavqs)
            ->where('avqs_file.dir1_id', $iddir1)
            ->where('avqs_file.dir2_id', $iddir2)
            ->where('avqs_file.id', $id)
            ->get()->getRow();
        }
    }
}
