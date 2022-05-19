<?php

namespace App\Controllers;
use App\Models\MguidelineModel;
use App\Models\AdminModel;

class Mguideline extends BaseController
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
        $this->mguideModel = new MguidelineModel();
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
        $getArea = $this->mguideModel->getArea();
        $getProcess = $this->mguideModel->getProcess();
        foreach($getArea as $area) {
            foreach($getProcess as $process) {
                if($area->id == $process->area_id){
                    $arr[] = [
                        "area" => $area->area,
                    ];
                }
            }
        }
        $out = array();
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
        if(count($getArea) != count($out)){
            $dif = count($getArea)-count($out);
            for($x=0;$x<$dif;$x++){
              $y= 0;
              array_push($out, $y);
            }
        }
        foreach($out as $row){
            $newOut[] = $row; 
        }
        $x=0;
        foreach($getArea as $row) {
            $result[] = [
                'id' => $row->id,
                'area' => $row->area,
                'countdir' => $newOut[$x++],
            ];
        }
        $data = [
            'tittle' => 'Manufacturing Guideline',
			'active_menu' => 'mg',
			'area' => $result,
			'process' => $getProcess,
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
 		return view('mguideline/index', $data);
	}

	public function area($area_id = NULL)
	{
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $getAreaRow = $this->mguideModel->getArea($area_id);
        $getProcess = $this->mguideModel->getProcess($area_id);
        $data = [
            'tittle' => 'Manufacturing Guideline',
			'active_menu' => 'mg',
			'process' => $getProcess,
			'areaRow' => $getAreaRow,
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        // dD($getMachine);
 		return view('mguideline/area', $data);
	}

	public function machine($area_id = NULL, $machine_id = NULL)
	{
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $getAreaRow = $this->mguideModel->getArea($area_id);
        $getMachineRow = $this->mguideModel->getProcess($area_id, $machine_id);
        $getFile = $this->mguideModel->getFile($area_id, $machine_id);
        $data = [
            'tittle' => 'Manufacturing Guideline',
			'active_menu' => 'mg',
			'areaRow' => $getAreaRow,
			'machineRow' => $getMachineRow,
			'fileData' => $getFile,
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        // dd($getMachineRow);
 		return view('mguideline/machine', $data);
	}
    
    public function download($area = null, $process = null, $file = null)
    {
        return $this->response->download('public/theme/assets/manufacturing_guidline/'.$area.'/'.$process.'/'.$file, null);
    }

    public function addarea()
    {
        if (!$this->validate([
            'area' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ]
        ])) {
            session()->setFlashData('error', 'Failed! area name is required field');
            return redirect()->to('/mguideline')->withInput();
        }
        $this->mguideModel->save([
            'area' => $this->request->getVar('area'),
        ]);
        if (!is_dir('public/theme/assets/manufacturing_guidline/'.$this->request->getVar('area'))){
            mkdir('public/theme/assets/manufacturing_guidline/'.$this->request->getVar('area'));
        }
        session()->setFlashData('pesan', 'Success! new area has been created');
        return redirect()->to('/mguideline');
    }

    public function addprocess()
    {
        if (!$this->validate([
            'machine' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ],
            'photo' => [
                'rules' => 'max_size[photo,5024]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
            ],
            'mfgspec' => [
                'uploaded[mfgspec]',
                'mime_in[mfgspec,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                'max_size[mfgspec,10000]',
            ],
            'equipspec' => [
                'uploaded[equipspec]',
                'mime_in[equipspec,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                'max_size[equipspec,10000]',
            ],
        ])) {
            session()->setFlashData('error', 'Failed! please check extension or size file');
            return redirect()->to('/mguideline/area/'.$this->request->getVar('area_id'))->withInput();
        }
        $photo = $this->request->getFile('photo');
        $mfgspec = $this->request->getFile('mfgspec');
        $equipspec = $this->request->getFile('equipspec');
        if (!is_dir('public/theme/assets/manufacturing_guidline/'.$this->request->getVar('area').'/'.$this->request->getVar('machine'))){
            mkdir('public/theme/assets/manufacturing_guidline/'.$this->request->getVar('area').'/'.$this->request->getVar('machine'));
        }
        if ($photo->getError() == 4) {
            $photoname = NULL;
        } else {
            $photoname = $photo->getName();
            $photo->move('public/theme/assets/manufacturing_guidline/'.$this->request->getVar('area').'/'.$this->request->getVar('machine'));
        }
        if ($mfgspec->getError() == 4) {
            $mfgspecname = NULL;
        } else {
            $mfgspecname = $mfgspec->getName();
            $mfgspec->move('public/theme/assets/manufacturing_guidline/'.$this->request->getVar('area').'/'.$this->request->getVar('machine'));
        }
        if ($equipspec->getError() == 4) {
            $equipspecname = NULL;
        } else {
            $equipspecname = $equipspec->getName();
            $equipspec->move('public/theme/assets/manufacturing_guidline/'.$this->request->getVar('area').'/'.$this->request->getVar('machine'));
        }
        $data = [
            'area_id' => $this->request->getVar('area_id'),
            'process_name' => $this->request->getVar('machine'),
            'photo' => $photoname,
            'mfg_spec' => $mfgspecname,
            'equip_spec' => $equipspecname,
        ];
        $this->db->table('mg_process')->insert($data);
        session()->setFlashData('pesan', 'Success! new process has been created');
        return redirect()->to('/mguideline/area/'.$this->request->getVar('area_id'));
    }
    
    public function addfile($area_id = NULL, $machine_id = NULL)
    {
        $file = $this->request->getFile('file');
        $area = $this->request->getVar('area');
        $machine = $this->request->getVar('machine');
        // dd($area);
        if(!$this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel]',
                'max_size[file,10000]',
            ]
        ])) {
            session()->setFlashData('error', 'Failed! file type not supported');
            return redirect()->to('mguideline/machine/'.$area_id.'/'.$machine_id)->withInput();
        }
        if ($file->getError() == 4) {
            $nama = NULL;
        } else {
            $nama = $file->getName();
            $file->move('public/theme/assets/manufacturing_guidline/'.$area.'/'.$machine, $nama);
        }
        $data = [
            'area_id' => $area_id,
            'machine_id' => $machine_id,
            'filename' => $nama,
            'upload_at' => date('Y-m-d', time()),
        ];
        $this->db->table('mg_file')->insert($data);
        session()->setFlashData('pesan', 'Success! new file has been uploaded');
        return redirect()->to('mguideline/machine/'.$area_id.'/'.$machine_id);
    }

    public function updatearea($id = NULL)
    {
        $data = [
            'area' => $this->request->getVar('area'),
        ];
        $this->builder = $this->db->table('mg_area');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        rename ("/pdavi/public/theme/assets/manufacturing_guidline/", "/folder/newfile.ext");
        session()->setFlashData('pesan', 'Success! area has been updated');
        return redirect()->to('/mguideline');
    }
    
    public function updateprocess($id = NULL)
    {
        $newprocess = $this->request->getVar('newmachine');
        $newphoto = $this->request->getFile('newphoto');
        $newmfgspec = $this->request->getFile('newmfgspec');
        $newequipspec = $this->request->getFile('newequipspec');
        if ($newphoto->getError() != 4) {
            if (!$this->validate([
                'newphoto' => [
                    'rules' => 'max_size[newphoto,5024]|is_image[newphoto]|mime_in[newphoto,image/jpg,image/jpeg,image/png]',
                ],
            ])) {
                session()->setFlashData('error', 'Failed! please check extension or size file');
                return redirect()->to('/mguideline/area/'.$this->request->getVar('area_id'))->withInput();
            }
        }
        if ($newmfgspec->getError() != 4) {
            if (!$this->validate([
                'newmfgspec' => [
                    'uploaded[newmfgspec]',
                    'mime_in[newmfgspec,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[newmfgspec,10000]',
                ],
            ])) {
                session()->setFlashData('error', 'Failed! please check extension or size file');
                return redirect()->to('/mguideline/area/'.$this->request->getVar('area_id'))->withInput();
            }
        }
        if ($newequipspec->getError() != 4) {
            if (!$this->validate([
                'newequipspec' => [
                    'uploaded[newequipspec]',
                    'mime_in[newequipspec,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[newequipspec,10000]',
                ],
            ])) {
                session()->setFlashData('error', 'Failed! please check extension or size file');
                return redirect()->to('/mguideline/area/'.$this->request->getVar('area_id'))->withInput();
            }
        }
        $oldphoto = $this->request->getVar('oldphoto');
        $oldmfgspec = $this->request->getVar('oldmfgspec');
        $oldequipspec = $this->request->getVar('oldequipspec');
        $area = $this->request->getVar('area');
        $oldprocess = $this->request->getVar('oldmachine');
        // dd($oldprocess, $newprocess);
        if ($oldprocess != $newprocess) {
            $oldpath = "./public/theme/assets/manufacturing_guidline/".$area."/".$oldprocess;
            $newpath = "./public/theme/assets/manufacturing_guidline/".$area."/".$newprocess;
            $outprocess = $newprocess;
            rename($oldpath, $newpath);
        } else {
            $outprocess = $oldprocess;
        }
        if ($newphoto->getError() == 4) {
            $photoname = $oldphoto;
        } else {
            $photoname = $newphoto->getName();
            $path = "./public/theme/assets/manufacturing_guidline/".$area."/".$outprocess."/".$oldphoto;
            unlink($path);
            $newphoto->move('public/theme/assets/manufacturing_guidline/'.$area.'/'.$outprocess, $photoname);
        }
        if ($newmfgspec->getError() == 4) {
            $mfgspecname = $oldmfgspec;
        } else {
            $mfgspecname = $newmfgspec->getName();
            $path = "./public/theme/assets/manufacturing_guidline/".$area."/".$outprocess."/".$oldmfgspec;
            unlink($path);
            $newmfgspec->move('public/theme/assets/manufacturing_guidline/'.$area.'/'.$outprocess, $mfgspecname);
        }
        if ($newequipspec->getError() == 4) {
            $equipspecname = $oldequipspec;
        } else {
            $equipspecname = $newequipspec->getName();
            $path = "./public/theme/assets/manufacturing_guidline/".$area."/".$outprocess."/".$oldequipspec;
            unlink($path);
            $newequipspec->move('public/theme/assets/manufacturing_guidline/'.$area.'/'.$outprocess, $equipspecname);
        }
        // dd($newphoto);
        $data = [
            'process_name' => $outprocess,
            'photo' => $photoname,
            'mfg_spec' => $mfgspecname,
            'equip_spec' => $equipspecname,
        ];
        $this->builder = $this->db->table('mg_process');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashData('pesan', 'Success! process has been updated');
        return redirect()->to('/mguideline/area/'.$this->request->getVar('area_id'));
    }

    public function delarea($id = null)
    {
        $this->mguideModel->where('id', $id)->delete();
        session()->setFlashData('pesan', 'Area has been deleted ✓');
        return redirect()->to(base_url('mguideline'));
    }

    public function delmachine($id = null, $area_id = null)
    {
        $this->builder = $this->db->table('mg_process');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Process has been deleted ✓');
        return redirect()->to(base_url('mguideline/area/'.$area_id));
    }

    public function delfile($id = null, $areaid = null, $machineid = null)
    {
        $getAreaRow = $this->mguideModel->getArea($areaid);
        $getMachineRow = $this->mguideModel->getMachine($areaid, $machineid);
        $getFilez = $this->mguideModel->getFile($areaid, $machineid, $id);
        $path = "./public/theme/assets/manufacturing_guidline/".$getAreaRow->area."/".$getMachineRow->process_name."/".$getFilez->filename;
        unlink($path);
        $this->builder = $this->db->table('mg_file');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'File has been deleted ✓');
        return redirect()->to(base_url('mguideline/area/'.$areaid.'/'.$machineid));
    }
    
}
