<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once APPPATH. 'libraries\tcpdf\tcpdf.php';

class DashboardKabag extends CI_Controller
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
            'titles'	=> "Dashboard Kepala Bagian",
            'user'	    => $this->Dashboard->viewWhere('tbl_users','id',$this->session->userdata('id'))->result_array(),
            'setting'   => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
            'headtab'   => 'Catatan Pengajuan Perizinan',
            'home'	    => true,
            'breadcumb'	=> "Dashboard Kepala Bagian",
            'view'		=> "v_DashboardKabag"
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

        echo $this->Dashboard->jsonGlobalJoin(
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
            $join
        );
    }

    // View Profile User
    public function Profuser($id = 0)
    {
        if ($id != 0) {
            $data = [
                'titles'		=> "Dashboard Kepala Bagians",
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
            'titles'		=> "Dashboard Kepala Bagians",
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
        $data   = [
            'id_perizinan'          => htmlentities($this->input->post('perizinan')),
            'tgl_pengajuan'         => date('Y-m-d'),
            'id_perusahaan'         => $this->session->userdata('id_perusahaan'),
            'id_user'               => $this->session->userdata('id'),
            'id_status'             => 1
        ];

        if($this->Dashboard->insert('tbl_pengajuan', $data)){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengajuan Sukses. Silahkan Pantau Di Halaman Ini Secara Berkala Untuk Mengetahui Status Terbaru Anda</div>');
            redirect('Home','refresh');
        }
    }

    // Action Approve Perizinan
    public function approvePerizinan($id=0)
    {
        if($id!=0){
            $update = [
                'id_status'     => 3,
                'id_kabag'      => $this->session->userdata('id'),
                'tgl_disetujui' => date('Y-m-d')
            ];

            if($this->Dashboard->update('tbl_pengajuan','id_pengajuan', $id, $update)){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengajuan Berhasil di Proses. </div>');
                redirect('DashboardKabag','refresh');
            }
        }
    }

    // Action Decline Perizinan
    public function declinePerizinan($id=0)
    {
        if($id!=0){
            $update = [
                'id_status'     => 4,
                'id_kabag'      => $this->session->userdata('id'),
                'tgl_disetujui' => date('Y-m-d')
            ];

            if($this->Dashboard->update('tbl_pengajuan','id_pengajuan', $id, $update)){
                $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Data Pengajuan di Tolak. </div>');
                redirect('DashboardKabag','refresh');
            }
        }
    }

    // View Approve Dokumen
    public function viewCreatePersetujuan($id=0)
    {
        if($id!=0){
            $data = [
                'titles'		=> "Dashboard Administration",
                'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
                'user'  		=> $this->Dashboard->viewWhere('tbl_users','id',$id)->result_array(),
                'Approve'       => $this->Dashboard->viewWhere('tbl_pengajuan','id_pengajuan',$id)->result_array(),
                'approve'		=> true,
                'breadcumb'		=> "Approve Dokumen",
                'view'			=> "v_ApproveDokumen"
            ];
            $this->load->view("index", $data);
        }
    }

    // Action Create Persetujuan
    public function ActionCreatePersetujuan($id=0)
    {
        $keterangan     = htmlentities($this->input->post('keterangan'));
        if($id!=0){
            $join       = array(
                                ['tbl_perizinan', 'tbl_pengajuan.id_perizinan=tbl_perizinan.id_perizinan', 'LEFT'],
                                ['tbl_perusahaan', 'tbl_pengajuan.id_perusahaan=tbl_perusahaan.id_perusahaan', 'LEFT'],
                                ['tbl_users', 'tbl_pengajuan.id_kabag=tbl_users.id', 'LEFT']
                            );
            // Create PDF Disini
            $data       = [
                'settings'      => $this->Dashboard->viewWhere('tbl_setting','id',1)->result_array(),
                'pengajuan'     => $this->Dashboard->viewGlobalJoinWhere(
                    '
                        tbl_pengajuan.*,
                        tbl_pengajuan.id_pengajuan AS idPeng,
                        tbl_perusahaan.nama_perusahaan,
                        tbl_perusahaan.alamat_perusahaan,
                        tbl_perusahaan.npwp,
                        tbl_perusahaan.pic_perusahaan,
                        tbl_perizinan.nama_perizinan,
                        tbl_users.name AS nama_kabag1,
                    ',
                    'tbl_pengajuan',
                    ['tbl_pengajuan.id_pengajuan'   => $id],
                    $join)->result_array(),
                'keterangan'    => $keterangan
            ];

            $this->load->view('Approve.php',$data);
            $insert = [
                'id_pengajuan'      => $data['pengajuan'][0]['id_pengajuan'],
                'id_perusahaan'     => $data['pengajuan'][0]['id_perusahaan'],
                'id_kabag'          => $this->session->userdata('id'),
                'tanggal_upload'    => date('Y-m-d'),
                'nama_file'         => 'Approve Document - Nama Perusahaan '.$data['pengajuan'][0]['nama_perusahaan'].'Tanggal  '.date('Y-m-d').' id '.$data['pengajuan'][0]['idPeng'].'.pdf',
                'keterangan'        => $keterangan
            ];

            if($this->Dashboard->insert('tbl_berkas', $insert)){
                redirect('DashboardKabag','refresh');
            }
        }
    }
}