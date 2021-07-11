<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->model('Login_model');
        $this->load->model('Dashboard/Dashboard_model','Dashboard', TRUE);
    }

    public function index()
    {
        $data 	= [
            'titles'	=> 'Login',
            'login'		=> 'Aplikasi Perizinan',
            'view'		=> "v_login"
        ];
        $this->load->view("index", $data);
    }

    public function aksi()
    {
        // Validasi Error
        $this->form_validation->set_rules("username", "Username", "trim|min_length[3]|required");
        $this->form_validation->set_rules("password", "password", "trim|required");

        if ($this->form_validation->run() == false) {
            $data 	= [
                'titles'	=> 'Login',
                'login'		=> 'Login',
                'view'		=> "v_login"
            ];
            $this->load->view("index", $data);
        } else {
            // ambil post dari form login
            $username   = htmlspecialchars($this->input->post('username'));
            $password   = htmlspecialchars(md5($this->input->post('password')));

            // model database
            $cek_admin = $this->Login_model->auth_user($username, $password);

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
                    redirect('Home','refresh');
                }else if ($this->session->userdata('role_id') == 3) {
                    redirect('DashboardKabag','refresh');
                } else {
                    redirect('DashboardAdmin','refresh');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Tidak ditemukan. Silahkan Klik Tombol Berkut Untuk Mendaftar <a href="Login/Perizinan" class="btn btn-info btn-sm">Daftar</a></div>');
                redirect('Login', 'refresh');
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

    // Action Perizinan
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

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda berhasil Logout !!!</div>');
    }
}