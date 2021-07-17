<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->model('Login/Login_model', 'Login', TRUE);
        $this->load->model('Dashboard/Dashboard_model', 'Dashboard', TRUE);
    }

    public function index()
    {
        $data 	= [
            'titles'	=> 'Fronte Page User',
            'view'		=> "v_Front"
        ];
        // $this->load->view("v_Front.php", $data);
        $this->load->view("index", $data);
    }

    // View Login
    public function Login()
    {
        $data 	= [
            'titles'	=> 'Login',
            'login'		=> 'Aplikasi Perizinan',
            'view'		=> "v_Login"
        ];
        $this->load->view("v_Login.php", $data);
    }

    // Action Login
    public function Action()
    {
        // Validasi Error
        $this->form_validation->set_rules("username", "Username", "trim|min_length[3]|required");
        $this->form_validation->set_rules("password", "password", "trim|required");

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            // ambil post dari form login
            $username   = htmlspecialchars($this->input->post('username'));
            $password   = htmlspecialchars(md5($this->input->post('password')));

            // model database
            $cek_admin = $this->Login->auth_user($username, $password);

            if ($cek_admin->num_rows() > 0) {
                $data = $cek_admin->row_array();

                $data_session = array(
                    'id'                => $data['id'],
                    'name'              => $data['name'],
                    'username'          => $username,
                    'aktif'             => true,
                    'role_id'           => $data['role_id'],
                    'id_perusahaan'     => $data['id_perusahaan']
                );

                // Set session user data
                $this->session->set_userdata($data_session);
                if ($this->session->userdata('role_id') == 1) {
                    redirect('Dashboard','refresh');
                }else if ($this->session->userdata('role_id') == 2) {
                    redirect('Front/Home','refresh');
                }else if ($this->session->userdata('role_id') == 3) {
                    redirect('DashboardKabag','refresh');
                } else {
                    redirect('DashboardAdmin','refresh');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Tidak ditemukan. Silahkan Klik Tombol Berkut Untuk Mendaftar <a href="Front/Perizinan" class="btn btn-info btn-sm">Daftar</a></div>');
                redirect('Front/Login', 'refresh');
            }
        }
    }

    // View Form Perizinan
    public function Perizinan()
    {
        $data 	= [
            'titles'	=> 'Halaman Data Perizinan Perusahaan',
            'register'  => true,
            'view'		=> "v_Perizinan"
        ];
        $this->load->view("index", $data);
    }

    // Action Add Perizinan
    public function ActionPerizinan()
    {
        $this->form_validation->set_rules("nama", "Nama", "trim|min_length[3]|required");
        $this->form_validation->set_rules("alamat", "Alamat", "trim|min_length[30]|required");
        $this->form_validation->set_rules("email", "Email", "trim|valid_email|is_unique[tbl_perusahaan.email_perusahaan]|required");
        $this->form_validation->set_rules("no_telp", "No_telp", "trim|required");
        $this->form_validation->set_rules("pic", "Pic", "trim|required");
        if ($this->form_validation->run() == false) {
            $this->Perizinan();
        } else {
            $data   = [
                'nama_perusahaan'       => htmlspecialchars($this->input->post('nama')),
                'alamat_perusahaan'     => htmlspecialchars($this->input->post('alamat')),
                'npwp'                  => htmlspecialchars($this->input->post('npwp')),
                'email_perusahaan'      => htmlspecialchars($this->input->post('email')),
                'no_telp_perusahaan'    => htmlspecialchars($this->input->post('no_telp')),
                'pic_perusahaan'        => htmlspecialchars($this->input->post('pic'))
            ];
            
            if($this->Dashboard->insert('tbl_perusahaan',$data)){
                // Check Last Data From tbl_perusahaan
                $checkId        = $this->Dashboard->lastData('id_perusahaan', 'tbl_perusahaan', 'id_perusahaan')->result_array();

                // Create Username Password
                $createUser     = [
                    'name'          => $data['nama_perusahaan'],
                    'notelp'        => $data['no_telp_perusahaan'],
                    'email'         => $data['email_perusahaan'],
                    'username'      => $data['email_perusahaan'],
                    'password'      => md5('123456'),
                    'role_id'       => 2,
                    'id_perusahaan' => $checkId[0]['id_perusahaan']
                ];

                if($this->Dashboard->insert('tbl_users', $createUser)){
                    // Kirim Email Berisi Username Password
                    $checkSetting   = $this->Dashboard->viewWhere('tbl_setting','id', 1)->result_array();
                    $dataKirim      = [
                        'title'         => 'Data Login',
                        'username'      => $createUser['username'],
                        'password'      => '123456',
                        'email'         => $createUser['email'],
                        'hostEmail'     => $checkSetting[0]['host'],
                        'userEmail'     => $checkSetting[0]['username'],
                        'passEmail'     => $checkSetting[0]['password']
                    ];
                    kirimEmail($dataKirim);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan Akan Di Proses Silahkan Check Email Anda Secara Berkala</div>');
                    redirect('Login','refresh');
                }
            }
        }
    }

    // View Home User After Login
    public function Home()
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

    // Json Datatables History Pengajuan
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

    // Json Datatables History Berkas
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

    // View Data Pengajuan
    public function Pengajuan($id=0)
    {
        if($id!=0){
            if ($this->session->userdata('aktif') === TRUE) {
                $data	= [
                    'titles'	=> "Home User Pengajuan Perizinan",
                    'user'	    => $this->Dashboard->viewWhere('tbl_users','id',$this->session->userdata('id'))->result_array(),
                    'setting'   => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
                    'Perizinan' => $this->Dashboard->viewWhere('tbl_perizinan','id_perizinan',$id)->result_array(),
                    'id'        => $id,
                    'pengajuan' => true,
                    'breadcumb' => "Pengajuan",
                    'view'      => "v_Pengajuan"
                ];
                $this->load->view("index", $data);
            }else{
                redirect('Front/Login','refresh');
            }
        }
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
                redirect('Front','refresh');
            }
        }
    }

    // Action Logout
    public function Logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda berhasil Logout !!!</div>');
    }
}