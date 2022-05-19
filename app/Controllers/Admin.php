<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;

class Admin extends BaseController
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
		$this->adminModel = new AdminModel();
        $this->db      = \Config\Database::connect();
    }

	public function index()
	{
        $getAllUsers = $this->adminModel->getAllUsers()->getResult();
		$data = [
            'tittle' => 'Manage Users',
			'active_menu' => 'manage_users',
            'validation' => \Config\Services::validation(),
            'getAllUsers' => $getAllUsers,
            'level' => $this->adminModel->getLevel(),
            'depart' => $this->adminModel->getDepart(),
            'section' => $this->adminModel->getSection(),
            'notif' => $this->adminModel->getNotif()
        ];
        // dd($getAllUsers);
 		return view('admin/index', $data);
	}

	public function detail($id = 0)
    {
        $getUser = $this->adminModel->getAllUsers($id)->getRow();
        $data = [
            'tittle' => 'Detail User Profile',
			'active_menu' => 'manage_users',
            'user' => $getUser,
            'notif' => $this->adminModel->getNotif()
        ];
        if (empty($getUser)){
            return redirect()->to('/admin');
        }
        return view('admin/detail', $data);
    }

	public function edit($id = 0)
    {
        $data = [
            'tittle' => 'Edit User',
            'active_menu' => 'manage_users',
            'level' => $this->adminModel->getLevel(),
            'depart' => $this->adminModel->getDepart(),
            'section' => $this->adminModel->getSection(),
            'validation' => \Config\Services::validation(),
            'user' => $this->adminModel->getAdmin($id),
            'notif' => $this->adminModel->getNotif()
        ];

        return view('admin/edit', $data);
    }

    public function update($id = 0)
    {
        // dd($this->request->getVar('level_id'), $this->request->getVar('depart_id'), $this->request->getVar('section_id'));
        if (!$this->validate([
            'user_image' => [
                'rules' => 'max_size[user_image,1024]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Upload file gambar',
                    'mime_in' => 'Format salah',
                ]
            ]
        ])) {
            return redirect()->to('/user/edit/'. $id)->withInput();
        };

        $fileUserImage = $this->request->getFile('user_image');
        //cek gambar lama/tidak
        if ($fileUserImage->getError() == 4) {
            $namaUserImage = $this->request->getVar('user_image_lama');
        } else {
            $namaUserImage = $fileUserImage->getRandomName();
            $fileUserImage->move('public/theme/assets/images/avatars/', $namaUserImage);
        }

        $this->adminModel->save([
            'id' => $id,
            'email' => $this->request->getVar('email'),
            'level_id' => $this->request->getVar('level_id'),
            'department_id' => $this->request->getVar('depart_id'),
            'section_id' => $this->request->getVar('section_id'),
            'fullname' => $this->request->getVar('fullname'),
            'section' => $this->request->getVar('section'),
            'user_image' => $namaUserImage,
        ]);
        session()->setFlashData('pesan', 'User profile success change');
        return redirect()->to('/admin');
    }

	public function delete($id = null)
    {
        $model = new AdminModel();
        $data['user'] = $model->where('id', $id)->delete();
        session()->setFlashData('pesan', 'User has been deleted ✓');
        return redirect()->to(base_url('admin'));
    }
}
