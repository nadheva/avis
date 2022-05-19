<?php

namespace App\Controllers;
use App\Models\DesignStandardModel;
use App\Models\AdminModel;

class Designstandard extends BaseController
{
	/**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $db, $builder, $adminmodel;
    public function __construct()
    {
        $this->DesignStandardModel = new DesignStandardModel();
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
            'tittle' => 'Design standard',
            'active_menu' => 'ds',
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];

        return view('designstandard/index', $data);
    }

	public function area($area_id = NULL)
	{
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');
        }
        if(user()->level_id == 7 || user()->level_id == 8){ return redirect()->to('/user'); }
        $getDes = $this->DesignStandardModel->getDesign($area_id);
        // $getDesign = (object) $getDes;
        $data = [
            'tittle' => 'Design standard',
			'active_menu' => 'df',
			'design' => $getDes,
			'area_id' => $area_id,
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif()
        ];
        // dd($getDesign);
 		return view('designstandard/area', $data);
	}

    
    public function adddesign()
    {
        // dd($this->request->getVar('area'));
        if (!$this->validate([
            'item' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} nama harus diisi',
                ]
            ],
            'photo' => [
                'rules' => 'max_size[photo,5024]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
            ],
            'best_practice' => [
                'uploaded[best_practice]',
                'mime_in[best_practice,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                'max_size[best_practice,10000]',
            ],
        ])) {
            session()->setFlashData('error', 'Failed! please check extension or size file');
            return redirect()->to('/designstandard/area/'.$this->request->getVar('area_id'))->withInput();
        }
        $photo = $this->request->getFile('photo');
        $best_practice = $this->request->getFile('best_practice');
        if (!is_dir('public/theme/assets/design standard/'.$this->request->getVar('area').'/'.$this->request->getVar('item'))){
            mkdir('public/theme/assets/design standard/'.$this->request->getVar('area').'/'.$this->request->getVar('item'));
        }
        if ($photo->getError() == 4) {
            $photoname = NULL;
        } else {
            $photoname = $photo->getName();
            $photo->move('public/theme/assets/design standard/'.$this->request->getVar('area').'/'.$this->request->getVar('item'));
        }
        if ($best_practice->getError() == 4) {
            $best_practice_name = NULL;
        } else {
            $best_practice_name = $best_practice->getName();
            $best_practice->move('public/theme/assets/design standard/'.$this->request->getVar('area').'/'.$this->request->getVar('item'));
        }
        $data = [
            'area_id' => $this->request->getVar('area_id'),
            'item' => $this->request->getVar('item'),
            'photo' => $photoname,
            'best_practice' => $best_practice_name,
        ];
        $this->db->table('design_standard')->insert($data);
        session()->setFlashData('pesan', 'Success! new design has been created');
        return redirect()->to('/designstandard/area/'.$this->request->getVar('area_id'));
    }
    
    public function updatedesign($id = NULL)
    {
        $newphoto = $this->request->getFile('newphoto');
        $newbestpractice = $this->request->getFile('newbestpractice');
        if ($newphoto->getError() != 4) {
            if (!$this->validate([
                'newphoto' => [
                    'rules' => 'max_size[newphoto,5024]|is_image[newphoto]|mime_in[newphoto,image/jpg,image/jpeg,image/png]',
                ],
            ])) {
                session()->setFlashData('error', 'Failed! please check extension or size file');
                return redirect()->to('/designstandard/area/'.$this->request->getVar('area_id'))->withInput();
            }
        }
        if ($newbestpractice->getError() != 4) {
            if (!$this->validate([
                'newbestpractice' => [
                    'uploaded[newbestpractice]',
                    'mime_in[newbestpractice,application/pdf,application/zip,application/msword,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]',
                    'max_size[newbestpractice,10000]',
                ],
            ])) {
                session()->setFlashData('error', 'Failed! please check extension or size file');
                return redirect()->to('/designstandard/area/'.$this->request->getVar('area_id'))->withInput();
            }
        }
        // dd($this->request->getVar('item'));
        $oldphoto = $this->request->getVar('oldphoto');
        $oldbestpractice = $this->request->getVar('oldbestpractice');
        $area = $this->request->getVar('area');
        $process = $this->request->getVar('item');
        $oldprocess = $this->request->getVar('olditem');
        if ($oldprocess != $process) {
            $oldpath = "./public/theme/assets/design standard/".$area."/".$oldprocess;
            $newpath = "./public/theme/assets/design standard/".$area."/".$process;
            $outitem = $process;
            rename($oldpath, $newpath);
        } else {
            $outitem = $oldprocess;
        }
        if ($newphoto->getError() == 4) {
            $photoname = $oldphoto;
        } else {
            $photoname = $newphoto->getName();
            $path = "./public/theme/assets/design standard/".$area."/".$outitem."/".$oldphoto;
            unlink($path);
            $newphoto->move('public/theme/assets/design standard/'.$area.'/'.$outitem, $photoname);
        }
        if ($newbestpractice->getError() == 4) {
            $bestpracticename = $oldbestpractice;
        } else {
            $bestpracticename = $newbestpractice->getName();
            $path = "./public/theme/assets/design standard/".$area."/".$outitem."/".$oldbestpractice;
            unlink($path);
            $newbestpractice->move('public/theme/assets/design standard/'.$area.'/'.$outitem, $bestpracticename);
        }
        // dd($newphoto);
        $data = [
            'item' => $outitem,
            'photo' => $photoname,
            'best_practice' => $bestpracticename,
        ];
        $this->builder = $this->db->table('design_standard');
        $this->builder->where('id', $id);
        $this->builder->update($data);
        session()->setFlashData('pesan', 'Success! design has been updated');
        return redirect()->to('/designstandard/area/'.$this->request->getVar('area_id'));
    }

    public function deldesign($id = null, $area_id = null)
    {
        $this->builder = $this->db->table('design_standard');
        $this->builder->delete(['id' => $id]);
        session()->setFlashData('pesan', 'Design has been deleted ✓');
        return redirect()->to(base_url('designstandard/area/'.$area_id));
    }
}