<?php

namespace App\Controllers;
use App\Models\AvqsModel;
use App\Models\AdminModel;

class Avqs extends BaseController
{
	/**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $db, $builder;
    public function __construct()
    {
        $this->avqsModel = new AvqsModel();
        $this->adminModel = new AdminModel();
        $this->db      = \Config\Database::connect();
    }

    public function index()
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $data = [
            'tittle' => 'AV Quality System',
            'active_menu' => 'avqs',
            'avqs' => $this->avqsModel->getAvqs(),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];

        return view('avqs/index', $data);
    }

    public function dir1($id = NULL) {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $getDir1 = $this->avqsModel->getDir1($id);
        $getDir2 = $this->avqsModel->getDir2($id);
        foreach($getDir1 as $dir1) {
            foreach($getDir2 as $dir2) {
                if($dir1->id == $dir2->dir1_id){
                    $arr[] = [
                        "dir1" => $dir1->id,
                    ];
                }
            }
        }
        // dd($arr);
        $out = array();
        if(isset($arr)){
        foreach ($arr as $key => $value){
            foreach ($value as $key2 => $value2){
                $index = $value2;
                if (array_key_exists($index, $out)){
                    $out[$index]++;
                } else {
                    $out[$index] = 1;
                }
            }
        }
        if(count($getDir1) != count($out)){
            $dif = count($getDir1)-count($out);
            for($x=0;$x<$dif;$x++){
              $y= 0;
              array_push($out, $y);
            }
        }
        foreach($out as $row){
            $newOut[] = $row; 
        }
        $x=0;
        foreach($getDir1 as $row) {
            $result[] = [
                'id' => $row->id,
                'dir' => $row->dir,
                'countdir' => $newOut[$x++],
            ];
        }
        $columns = array_column($result, 'dir');
        array_multisort($columns, SORT_ASC, $result);
        } else {
            if(count($getDir1)!=0){
                foreach($getDir1 as $row) {
                $result[] = [
                    'id' => $row->id,
                    'dir' => $row->dir,
                    'countdir' => 0,
                ];
                }
            } else {
                $result = array();
            }
        }
        // dd($result);
        $data = [
            'tittle' => 'AV Quality System',
            'active_menu' => 'avqs',
            'avqsrow' => $this->avqsModel->getAvqs($id),
            'dir1' => $result,
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        // dd($getDir1, $getDir2, $result);
        return view('avqs/dir1', $data);
    }

    public function dir2($idavqs = NULL,$iddir1 = NULL) {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $getDir2 = $this->avqsModel->getDir2($idavqs, $iddir1);
        $getFile = $this->avqsModel->getFile($idavqs, $iddir1);
        foreach($getDir2 as $dir2) {
            foreach($getFile as $file) {
                if($dir2->id == $file->dir2_id){
                    $arr[] = [
                        "dir2" => $dir2->id,
                    ];
                }
            }
        }
        $out = array();
        if(isset($arr)){
        foreach ($arr as $key => $value){
            foreach ($value as $key2 => $value2){
                $index = $value2;
                if (array_key_exists($index, $out)){
                    $out[$index]++;
                } else {
                    $out[$index] = 1;
                }
            }
        }
        if(count($getDir2) != count($out)){
            $dif = count($getDir2)-count($out);
            for($x=0;$x<$dif;$x++){
              $y= 0;
              array_push($out, $y);
            }
        }
        foreach($out as $row){
            $newOut[] = $row; 
        }
        $x=0;
        foreach($getDir2 as $row) {
            $result[] = [
                'id' => $row->id,
                'dir' => $row->dir,
                'countdir' => $newOut[$x++],
            ];
        }
        $columns = array_column($result, 'dir');
        array_multisort($columns, SORT_ASC, $result);
        } else {
            if(count($getDir2)!=0){
                foreach($getDir2 as $row) {
                $result[] = [
                    'id' => $row->id,
                    'dir' => $row->dir,
                    'countdir' => 0,
                ];
                }
            } else {
                $result = array();
            }
        }
        $data = [
            'tittle' => 'AV Quality System',
            'active_menu' => 'avqs',
            'avqsrow' => $this->avqsModel->getAvqs($idavqs),
            'dir1row' => $this->avqsModel->getDir1($idavqs, $iddir1),
            'dir2' => $result,
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        return view('avqs/dir2', $data);
    }

    public function file($idavqs = NULL,$iddir1 = NULL,$iddir2 =NULL) {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $data = [
            'tittle' => 'AV Quality System',
            'active_menu' => 'avqs',
            'avqsrow' => $this->avqsModel->getAvqs($idavqs),
            'dir1row' => $this->avqsModel->getDir1($idavqs, $iddir1),
            'dir2row' => $this->avqsModel->getDir2($idavqs, $iddir1, $iddir2),
            'file' => $this->avqsModel->getFile($idavqs, $iddir1, $iddir2),
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        return view('avqs/file', $data);
    }

    public function adddir1() 
    {
        $avqsid = $this->request->getVar('avqs_id');
        $avqsname = $this->request->getVar('avqsname');
        $dirname = $this->request->getVar('dir');
        if (!$this->validate([
            'dir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Folder name is required field');
            return redirect()->to('/avqs/dir1/'.$avqsid)->withInput();
        };
        $data = [
            'avqs_id' => $avqsid,
            'dir' => $dirname,
        ];
        $this->db->table('avqs_dir1')->insert($data);
        if (!is_dir('public/theme/assets/av quality system/'.$avqsname.'/'.$dirname)){
            mkdir('public/theme/assets/av quality system/'.$avqsname.'/'.$dirname);
        }
        session()->setFlashData('pesan', 'Success! new folder has been created');
        return redirect()->to('/avqs/dir1/'.$avqsid);
    }

    public function adddir2() 
    {
        $avqsid = $this->request->getVar('avqs_id');
        $avqsname = $this->request->getVar('avqsname');
        $dir1id = $this->request->getVar('dir1id');
        $dir1name = $this->request->getVar('dir1name');
        $dirname = $this->request->getVar('dir');
        if (!$this->validate([
            'dir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Folder name is required field');
            return redirect()->to('/avqs/dir1/'.$avqsid)->withInput();
        };
        $data = [
            'avqs_id' => $avqsid,
            'dir1_id' => $dir1id,
            'dir' => $dirname,
        ];
        $this->db->table('avqs_dir2')->insert($data);
        if (!is_dir('public/theme/assets/av quality system/'.$avqsname.'/'.$dir1name.'/'.$dirname)){
            mkdir('public/theme/assets/av quality system/'.$avqsname.'/'.$dir1name.'/'.$dirname);
        }
        session()->setFlashData('pesan', 'Success! new folder has been created');
        return redirect()->to('/avqs/dir2/'.$avqsid.'/'.$dir1id);
    }

    public function addfile() 
    {
        $avqsid = $this->request->getVar('avqs_id');
        $avqsname = $this->request->getVar('avqsname');
        $dir1id = $this->request->getVar('dir1id');
        $dir1name = $this->request->getVar('dir1name');
        $dir2id = $this->request->getVar('dir2id');
        $dir2name = $this->request->getVar('dir2name');
        $file = $this->request->getFile('file');
        // dd($file);
        if (!$this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]',
                'max_size[file,100000]',
            ]
        ])) {
            session()->setFlashData('error', 'Failed! file type or file size not supported');
            return redirect()->to('/avqs/dir1/'.$avqsid)->withInput();
        };
        if ($file->getError() == 4) {
            $namafile = NULL;
        } else {
            $namafile = $file->getName();
            $file->move('public/theme/assets/av quality system/'.$avqsname.'/'.$dir1name.'/'.$dir2name.'/', $namafile);
        }
        $data = [
            'avqs_id' => $avqsid,
            'dir1_id' => $dir1id,
            'dir2_id' => $dir2id,
            'file' => $namafile,
            'upload_at' => date('Y-m-d', time()),
        ];
        $this->db->table('avqs_file')->insert($data);
        session()->setFlashData('pesan', 'Success! new file has been uploaded');
        return redirect()->to('/avqs/file/'.$avqsid.'/'.$dir1id.'/'.$dir2id);
    }

    public function updatedir1($id = NULL)
    {
        $avqsid = $this->request->getVar('avqs_id');
        $avqsname = $this->request->getVar('avqsname');
        $newdir = $this->request->getVar('newdir');
        $olddir = $this->request->getVar('olddir');
        if (!$this->validate([
            'newdir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Folder name is required field');
            return redirect()->to('/avqs/dir1/'.$avqsid)->withInput();
        };
        if($olddir == $newdir) {
            $outdir = $olddir;
        } else {
            $oldpath = "./public/theme/assets/av quality system/".$avqsname."/".$olddir;
            $newpath = "./public/theme/assets/av quality system/".$avqsname."/".$newdir;
            $outdir = $newdir;
            rename($oldpath, $newpath);
        }
        $data = [
            'dir' => $outdir,
        ];
        $this->builder = $this->db->table('avqs_dir1');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashData('pesan', 'Success! folder has been updated');
        return redirect()->to('/avqs/dir1/'.$avqsid);
    }

    public function updatedir2($id = NULL)
    {
        $avqsid = $this->request->getVar('avqs_id');
        $avqsname = $this->request->getVar('avqsname');
        $dir1id = $this->request->getVar('dir1id');
        $dir1name = $this->request->getVar('dir1name');
        $newdir = $this->request->getVar('newdir');
        $olddir = $this->request->getVar('olddir');
        if (!$this->validate([
            'newdir' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ]
        ])) {
            session()->setFlashData('error', 'Failed! Folder name is required field');
            return redirect()->to('/avqs/dir2/'.$avqsid.'/'.$dir1id)->withInput();
        };
        if($olddir == $newdir) {
            $outdir = $olddir;
        } else {
            $oldpath = "./public/theme/assets/av quality system/".$avqsname."/".$dir1name.'/'.$olddir;
            $newpath = "./public/theme/assets/av quality system/".$avqsname."/".$dir1name.'/'.$newdir;
            $outdir = $newdir;
            rename($oldpath, $newpath);
        }
        $data = [
            'dir' => $outdir,
        ];
        $this->builder = $this->db->table('avqs_dir2');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashData('pesan', 'Success! folder has been updated');
        return redirect()->to('/avqs/dir2/'.$avqsid.'/'.$dir1id);
    }

    public function deldir1($id = null, $avqsid = null)
    {
        $avqsrow = $this->avqsModel->getAvqs($avqsid);
        $dir1row = $this->avqsModel->getDir1($avqsid, $id);
        $path = "./public/theme/assets/av quality system/".$avqsrow['avqs_name']."/".$dir1row->dir;
        // dd($path);
        rmdir($path);
        $this->builder = $this->db->table('avqs_dir1');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Folder has been deleted ✓');
        return redirect()->to(base_url('avqs/dir1/'.$avqsid));
    }

    public function deldir2($id = null, $avqsid = null, $iddir1 = NULL)
    {
        $this->builder = $this->db->table('avqs_dir2');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Folder has been deleted ✓');
        return redirect()->to(base_url('avqs/dir2/'.$avqsid.'/'.$iddir1));
    }

    public function delfile($id = null, $avqsid = null, $iddir1 = NULL, $iddir2 = NULL)
    {
        $avqsrow = $this->avqsModel->getAvqs($avqsid);
        $dir1row = $this->avqsModel->getDir1($avqsid, $iddir1);
        $dir2row = $this->avqsModel->getDir2($avqsid, $iddir1, $iddir2);
        $filerow = $this->avqsModel->getFile($avqsid, $iddir1, $iddir2, $id);
        $path = "./public/theme/assets/av quality system/".$avqsrow['avqs_name']."/".$dir1row->dir."/".$dir2row->dir."/".$filerow->file;
        unlink($path);
        $this->builder = $this->db->table('avqs_file');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'File has been deleted ✓');
        return redirect()->to(base_url('avqs/file/'.$avqsid.'/'.$iddir1.'/'.$iddir2));
    }
    
    public function download($avqs = null, $dir1 = null, $dir2 = null, $file = null)
    {
        return $this->response->download('public/theme/assets/av quality system/'.$avqs.'/'.$dir1.'/'.$dir2.'/'.$file, null);
    }

}