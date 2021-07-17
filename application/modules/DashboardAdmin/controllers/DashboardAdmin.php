<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class DashboardAdmin extends CI_Controller
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
            'titles'	=> "Dashboard Administration",
            'user'	    => $this->Dashboard->viewWhere('tbl_users','id',$this->session->userdata('id'))->result_array(),
            'setting'   => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
            'headtab'   => 'Catatan Pengajuan Perizinan',
            'home'	    => true,
            'breadcumb'	=> "Home Administrasi",
            'view'		=> "v_DashboardAdmin"
        ];
        $this->load->view("index", $data);
    }

    // Json View Datatable Pengajuan
    public function jsonHistoryPengajuan()
    {
        header('Content-Type: application/json');

        $join = array(
            ['tbl_status','tbl_pengajuan.id_status=tbl_status.id_status','LEFT'],
            ['tbl_perusahaan','tbl_pengajuan.id_perusahaan=tbl_perusahaan.id_perusahaan','LEFT'],
            ['tbl_perizinan','tbl_pengajuan.id_perizinan=tbl_perizinan.id_perizinan','LEFT'],
        );

        echo $this->Dashboard->jsonGlobalJoinAssWhere(
            '
                tbl_pengajuan.id_pengajuan AS id_pengajuan,
                tbl_pengajuan.tgl_pengajuan AS tgl_pengajuan,
                tbl_pengajuan.tgl_disetujui AS tgl_disetujui,
                tbl_pengajuan.id_perusahaan AS id_perusahaan,
                tbl_pengajuan.id_status AS id_status,
                tbl_perusahaan.nama_perusahaan AS nama_perusahaan,
                tbl_status.keterangan AS keterangan,
                tbl_perizinan.nama_perizinan AS nama_perizinan
            ',
            'tbl_pengajuan',
            ['tbl_pengajuan.id_status'  => 1],
            $join
        );
    }

    // View Profile User
    public function Profuser($id = 0)
    {
        if ($id != 0) {
            $data = [
                'titles'		=> "Dashboard Administration",
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
                redirect('DashboardAdmin/Profedit');
            }
        }
    }
    

    // View Form Pengajuan
    public function Pengajuan()
    {
        $data = [
            'titles'		=> "Dashboard Administration",
            'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
            'user'  		=> $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
            'ijin'          => $this->Dashboard->viewAll('*','tbl_perizinan')->result_array(),
            'pengajuan'		=> true,
            'breadcumb'		=> "Pengajuan",
            'view'			=> "v_Pengajuan"
        ];
        $this->load->view("index", $data);
    }

    // Action Approve Pengajuan
    public function approvePengajuan($id=0)
    {
        if($id!=0){
            $update = [
                'id_status'     => 2,
                'id_admin'      => $this->session->userdata('id')
            ];

            if($this->Dashboard->update('tbl_pengajuan','id_pengajuan', $id, $update)){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengajuan Berhasil di Proses. </div>');
                redirect('DashboardAdmin','refresh');
            }
        }
    }

    // Action Decline Pengajuan
    public function declinePengajuan($id=0)
    {
        if ($id!=0) {
            $data = [
                'titles'		=> "Dashboard Administration",
                'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
                'id_pengajuan'  => $id,
                'pengajuan'		=> true,
                'breadcumb'		=> "Keterangan Decline",
                'view'			=> "v_KetDecline"
            ];
            $this->load->view("index", $data);
        }
    }

    // Action Decline Pengajuan
    public function ActionDeclinePengajuan($id=0)
    {
        if($id!=0){
            $update = [
                        'id_status'     => 4,
                        'id_admin'      => $this->session->userdata('id'),
                        'tgl_disetujui' => date('Y-m-d'),
                        'catatan'       => htmlentities($this->input->post('keterangan'))
                    ];
        
                    if($this->Dashboard->update('tbl_pengajuan','id_pengajuan', $id, $update)){
                        $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data Pengajuan di Tolak. </div>');
                        redirect('DashboardAdmin','refresh');
                    }
        }
    }

    // View Document Laporan
    public function LihatDocumentPengajuan($id=0)
    {
        if($id!=0){
            // Check Pengajuan Berdasar ID
            $check  = $this->Dashboard->viewWhere('tbl_pengajuan','id_pengajuan',$id)->result_array();
            if($check[0]['nama_file']!==''){
                redirect('document/'.$check[0]['nama_file'],'refresh');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Tidak Ada Berkas Yang Di Unggah !!!. </div>');
                redirect('DashboardAdmin','refresh');
            }
        }
    }
}