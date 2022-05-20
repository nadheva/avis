<?php

namespace App\Controllers;
use App\Models\Bom_download\Model2Model;
use App\Models\Bom_download\KaryawanModel;
use App\Models\Bom_download\ReportModel;
use App\Models\Bom_download\FileModel;
use App\Models\AdminModel;


class Bom_download extends BaseController
{
    private $db2;

    public function __construct()
    {
        $this->db2 = db_connect("otherDb"); // other database group
        // $this->ReportModel = new ReportModel();
        // $this->KaryawanModel = new KaryawanModel();
        $this->Model2Model = new Model2Model();
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        if (!logged_in()) {
            session()->setFlashData('error', 'Please enter valid credentials');
            return redirect()->to('/login');

        }

        $data = [
            'tittle' => 'Bill Of Materials',
            'active_menu' => 'bom',
            'validation' => \Config\Services::validation(),
            'notif' => $this->adminModel->getNotif(),
            // 'model' => $this->db2->table('model')->get(),
        ];
        $this->builder = $this->db2->table('model');
        $model = $this->builder->get();
        // $model = $this->db2->table('model')->get();
        // dd($model);
        return view('bom_download/index', $data, $model);
    }

    public function create()
    {
        $npk  = $_POST['npk']; 
        $nama = $_POST['nama'];
        $dept = $_POST['departemen'];
        $pass = $_POST['password'];
        $model = $_POST['model'];
        $departemen = $_POST['departemen'];
        $nfile = $_POST['file'];
        
        $log = $this->ReportModel;
        if (mysqli_num_rows($log) != 0){
            while($data = mysqli_fetch_array($log)){
                $lnpk[] = $data['npk'];
                $lmdl[] = $data['model'];
                $lfile[] = $data['file'];
            }
        }
        
        
        
        if ($npk !='' && $nama !='' && $dept !='' && $pass !='' && $nfile !=''){
            $this->builder = $this->db2->table('report');
            $query = $this->builder->where('npk', $npk && 'password' ,$pass);
            if (mysqli_num_rows($query) != 0){
                if (isset($_POST['file'])) {
                $filename    = $_POST['file'];
                $back_dir    ="files/";
                $file = $back_dir.$filename;
                    if (file_exists($file) && in_array($npk,$lnpk) && in_array($model,$lmdl) && in_array($nfile,$lfile)) {
                        // mysqli_query($connect,"INSERT INTO report VALUES ('', current_timestamp(),'$npk', '$model', '$nfile')");
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename='.basename($file));
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: private');
                        header('Pragma: private');
                        header('Content-Length: ' . filesize($file));
                        ob_clean();
                        flush();
                        readfile($file);
                        exit();
                    } 
                    else if (file_exists($file))
                    {
                        mysqli_query($connect,"INSERT INTO report VALUES ('', current_timestamp(),'$npk', '$model', '$nfile')");
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename='.basename($file));
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: private');
                        header('Pragma: private');
                        header('Content-Length: ' . filesize($file));
                        ob_clean();
                        flush();
                        readfile($file);
                        exit();
                    } else if (!file_exists($file)){ ?>
                        <script>alert("File Not Exists")</script>
                        <script>document.location.href='<?php base_url('')?>';</script><?php
                    }
                }
        
            } else if (mysqli_num_rows($query) == 0){?>
                <script language="javascript">alert("Incorrect username and password !");</script>
                <script>document.location.href='index.php';</script>
                <?php
            }
    }





    
}
        public function check()
        {
            $model = $_POST['model'];
            $namafile = "<option value='' disabled selected>- Select File -</option>";
            if ($model){
                $query =  $this->db2->table('file')->where('model', $model);
                if (mysqli_num_rows($query)!=0){
                    while ($data = mysqli_fetch_array($query)){
                    $file = $data['namafile'];
                    $namafile .= "<option value='$file'> $file </option>";
                    };
                }
            }
            $this->db2->table('file')->where('model', $model);
            return $namafile;
        }

        public function karyawan()
        {
            $npk = $_POST['npk'];
            if ($npk != ''){
                $query = $this->db2->table('karyawan')->where('npk', $npk);
                if (mysqli_num_rows($query)!=0){
                    $karyawan = mysqli_fetch_array($query);
                    $data = array(
                    'nama' => $karyawan['nama'],
                    'dept' => $karyawan['departemen'],);
                } else {
                    $data = array(
                    'nama' => 'NPK is not registered',
                    'dept' => 'NPK is not registered',);
                }
            } else {$data='';}
            return json_encode($data);
        }
}