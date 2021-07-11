<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->model('Dashboard/Dashboard_model', 'Dashboard', TRUE);

        // Panggil Library PHPMailer
        require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';
        set_zone();
        
    }
    
    public function index()
    {
        $data	= [
            'titles'	=> "Home User",
            'user'	    => $this->Dashboard->viewWhere('tbl_users','id',$this->session->userdata('id'))->result_array(),
            'setting'   => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
            'headtab'   => 'Catatan Pengajuan Perizinan',
            'home'	    => true,
            'breadcumb'	=> "Home User",
            'view'		=> "v_Home"
        ];
        $this->load->view("index", $data);
    }

    // Json View Datatable Pengajuan
    public function jsonHistoryPengajuan()
    {
        header('Content-Type: application/json');

        $join = array(
            ['tbl_status','tbl_pengajuan.id_status=tbl_status.id_status','LEFT'],
            ['tbl_perizinan','tbl_pengajuan.id_perizinan=tbl_perizinan.id_perizinan','LEFT']
        );

        echo $this->Dashboard->jsonGlobalJoinAssWhere(
            '
                tbl_pengajuan.id_pengajuan AS id_pengajuan,
                tbl_pengajuan.tgl_pengajuan AS tgl_pengajuan,
                tbl_pengajuan.tgl_disetujui AS tgl_disetujui,
                tbl_pengajuan.id_perusahaan AS id_perusahaan,
                tbl_pengajuan.id_status AS id_status,
                tbl_pengajuan.catatan AS catatan,
                tbl_status.keterangan AS keterangan,
                tbl_perizinan.nama_perizinan AS nama_perizinan
            ',
            'tbl_pengajuan',
            ['tbl_pengajuan.id_perusahaan'  => $this->session->userdata('id_perusahaan')],
            $join
        );
    }

    // Json View Datatable Berkas Pengajuan
    public function jsonHistoryBerkas()
    {
        header('Content-Type: application/json');

        $join = array(
            ['tbl_perusahaan','tbl_berkas.id_perusahaan=tbl_perusahaan.id_perusahaan','LEFT'],
            ['tbl_users','tbl_berkas.id_kabag=tbl_users.id','LEFT']
        );

        echo $this->Dashboard->jsonGlobalJoinAssWhere(
            '
                tbl_berkas.*,
                tbl_perusahaan.nama_perusahaan,
                tbl_users.name AS nama_kabag,
            ',
            'tbl_berkas',
            ['tbl_berkas.id_perusahaan'  => $this->session->userdata('id_perusahaan')],
            $join
        );
    }

    // View Profile User
    public function Profuser($id = 0)
    {
        if ($id != 0) {
            $data = [
                'titles'		=> "Home Users",
                'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
                'user'  		=> $this->Dashboard->viewWhere('tbl_users','id',$id)->result_array(),
                'profile'		=> true,
                'breadcumb'		=> "Profile",
                'view'			=> "v_Profuser"
            ];
            $this->load->view("index", $data);
        }
    }

    // Edit Profile User
    public function Profedit()
    {
        $id	= $this->session->userdata('id');
        
        $this->form_validation->set_rules("password", "Password", "trim|required");
        $this->form_validation->set_rules("repassword", "Repassword", "trim|required|matches[password]");
        if ($this->form_validation->run() == false) {
            $this->Profuser($id);
        } else {
            $input = [
                'password'		=> md5(htmlspecialchars($this->input->post('password')))
            ];
            
            if ($this->Dashboard->update('tbl_users', 'id', $id, $input)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data User Berhasil di Update <br>Username : ' . $this->session->userdata('name') . '</div>');
                redirect('Home/Profedit');
            }
        }
    }

    // View Form Pengajuan
    public function Pengajuan()
    {
        $data = [
            'titles'		=> "Home Users",
            'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
            'user'  		=> $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
            'ijin'          => $this->Dashboard->viewAll('*','tbl_perizinan')->result_array(),
            'pengajuan'		=> true,
            'breadcumb'		=> "Pengajuan",
            'view'			=> "v_Pengajuan"
        ];
        $this->load->view("index", $data);
    }

    // Action Add Pengajuan
    public function AddPengajuan()
    {
        $config['upload_path'] 		= './document/';
        $config['allowed_types'] 	= 'pdf';
        $config['max_size'] 		= 2048;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('document')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Upload Foto Gagal, Pastikan file dibawah 2Mb dan Berformat pdf. </div>');
            redirect('Home','refresh');
        } else {
            $data   = [
                'id_perizinan'          => htmlentities($this->input->post('perizinan')),
                'tgl_pengajuan'         => date('Y-m-d'),
                'id_perusahaan'         => $this->session->userdata('id_perusahaan'),
                'id_user'               => $this->session->userdata('id'),
                'id_status'             => 1,
                'nama_file'             => $this->upload->data('file_name')
            ];

            if($this->Dashboard->insert('tbl_pengajuan', $data)){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengajuan Sukses. Silahkan Pantau Di Halaman Ini Secara Berkala Untuk Mengetahui Status Terbaru Anda</div>');
                redirect('Home','refresh');
            }
        }
    }

    // Download Berkas
    public function DownloadBerkas($id=0)
    {
        if($id!=0){
            $check  = $this->Dashboard->viewWhere('tbl_berkas','id_berkas',$id)->result_array();
            $this->load->helper('download');
            force_download('document/'.$check[0]['nama_file'], NULL);
        }
    }
}