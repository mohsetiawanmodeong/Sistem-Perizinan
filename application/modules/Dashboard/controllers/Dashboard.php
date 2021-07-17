<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->model('Dashboard_model','Dashboard', TRUE);
        set_zone();
        
        if ($this->session->userdata('role_id')!=1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap login untuk melanjutkan</div>');
            redirect('login');
        }
    }
    
    public function index()
    {
        $data	= [
            'titles'	=> "Dashboard User",
            'setting'   => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
            'user'	    => $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
            'perusahaan'=> $this->Dashboard->viewAll('*','tbl_perusahaan')->num_rows(),
            'perizinan' => $this->Dashboard->viewAll('*','tbl_perizinan')->num_rows(),
            'dashboard'	=> true,
            'breadcumb'	=> "Dashboard",
            'view'		=> "v_Dashboard"
        ];
        $this->load->view("index", $data);
    }

    // View Profile User
    public function profuser($id = 0)
    {
        if ($id != 0) {
            $data = [
                'titles'		=> "Dashboard Administrator",
                'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
                'user'	        => $this->Dashboard->viewWhere('tbl_users','id',$id)->result_array(),
                'profile'		=> true,
                'breadcumb'		=> "Profile",
                'view'			=> "v_profuser"
            ];
            $this->load->view("index", $data);
        }
    }

    // Edit Profile User
    public function profedit()
    {
        $id	= $this->session->userdata('id');
        
        $this->form_validation->set_rules("nama_admin", "Nama_admin", "trim|min_length[5]|required");
        $this->form_validation->set_rules("password", "Password", "trim|required");
        $this->form_validation->set_rules("repassword", "Repassword", "trim|required|matches[password]");
        if ($this->form_validation->run() == false) {
            $data = [
                'titles'		=> "Dashboard Administrator",
                'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
                'user'	        => $this->Dashboard->viewWhere('tbl_users','id',$id)->result_array(),
                'profile'		=> true,
                'breadcumb'		=> "Profile",
                'view'			=> "v_profuser"
            ];
            $this->load->view("index", $data);
        } else {
            $input = [
                'name'	        => htmlspecialchars($this->input->post('nama_admin')),
                'password'		=> md5(htmlspecialchars($this->input->post('password')))
            ];
            if ($this->Dashboard->update_prof($id, $input)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data User Berhasil di Update <br>Username : ' . $input['name'] . '</div>');
            }
            redirect('dashboard/profedit');
        }
    }

    // View Data Jenis Perizinan
    public function Perizinan()
    {
        $data = [
            'titles'		=> "Dashboard Administrator",
            'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
            'user'	        => $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
            'profile'		=> true,
            'breadcumb'		=> "Jenis Perizinan",
            'view'			=> "v_JenisPerizinan"
        ];
        $this->load->view("index", $data);
    }

    // Json View Datatable Perizinan
    public function jsonPerizinan()
    {
        header('Content-Type: application/json');

        echo $this->Dashboard->json(
            '*',
            'tbl_perizinan'
        );
    }

    // Action Add Jenis Perizinan
    public function ActionAddPerizinan()
    {
        $data   = [
            'nama_perizinan'        => htmlentities($this->input->post('name'))
        ];

        if($this->Dashboard->insert('tbl_perizinan',$data)){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Add Jenis Perizinan. Perizinan Name = ['.$data['nama_perizinan'].'] Success !!</div>');
            redirect('Dashboard/Perizinan','refresh');
        }
    }

    // View Edit Data Jenis Perizinan
    public function editPerizinan($id=0)
    {
        if($id!=0){
            $data = [
                'titles'		=> "Dashboard Administrator",
                'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
                'user'	        => $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
                'jenisPerizinan'=> $this->Dashboard->viewWhere('tbl_perizinan','id_perizinan',$id)->result_array(),
                'profile'		=> true,
                'breadcumb'		=> "Edit Jenis Perizinan",
                'view'			=> "v_EditPerizinan"
            ];
            $this->load->view("index", $data);
        }
    }
    
    // Action Edit Jenis Perizinan
    public function ActionEditPerizinan($id=0)
    {
        if($id!=0){
            $update     = [
                'nama_perizinan'        => htmlentities($this->input->post('name'))
            ];

            if ($this->Dashboard->update('tbl_perizinan','id_perizinan', $id, $update)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Update Jenis Perizinan. Perizinan Name = ['.$update['nama_perizinan'].'] Success !!</div>');
                redirect('Dashboard/Perizinan','refresh');
            }
        }
    }

    // Action Delete Jenis Perizinan
    public function deletePerizinan($id=0)
    {
        if($id!=0){
            if($this->Dashboard->delete('id_perizinan','tbl_perizinan', $id)){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Success Delete Jenis Perizinan. Perizinan ID = ['.$id.'] Success !!</div>');
                redirect('Dashboard/Perizinan','refresh');
            }
        }
    }

    // View Data Perusahaan
    public function Perusahaan()
    {
        $data = [
            'titles'		=> "Dashboard Administrator",
            'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
            'user'	        => $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
            'profile'		=> true,
            'breadcumb'		=> "View Perusahaan",
            'view'			=> "v_Perusahaan"
        ];
        $this->load->view("index", $data);
    }

    // Json View Datatable Perusahaan
    public function jsonPerusahaan()
    {
        header('Content-Type: application/json');

        echo $this->Dashboard->json(
            '*',
            'tbl_perusahaan'
        );
    }

    // Action Add Perusahaan
    public function addPerusahaan()
    {
        $this->form_validation->set_rules("nama", "Nama", "trim|min_length[3]|required");
        $this->form_validation->set_rules("alamat", "Alamat", "trim|min_length[30]|required");
        $this->form_validation->set_rules("email", "Email", "trim|valid_email|is_unique[tbl_perusahaan.email_perusahaan]|required");
        $this->form_validation->set_rules("no_telp", "No_telp", "trim|required");
        $this->form_validation->set_rules("pic", "Pic", "trim|required");
        if ($this->form_validation->run() == false) {
            $this->Perusahaan();
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
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Perusahaan Berhasil di Tambahkan. Email Telah Dikirim.</div>');
                    redirect('Dashboard/Perusahaan','refresh');
                }
            }
        }
    }

    // Action Delete Perusahaan
    public function deletePerusahaan($id=0)
    {
        if($id!=0){
            // Hapus tbl_users
            if($this->Dashboard->delete('tbl_users', 'id_perusahaan', $id)){
                // Hapus Pengajuan
                if($this->Dashboard->delete('tbl_pengajuan', 'id_perusahaan', $id)){
                    if($this->Dashboard->delete('tbl_perusahaan', 'id_perusahaan', $id)){
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Perusahaan Berhasil di Hapus.</div>');
                        redirect('Dashboard/Perusahaan','refresh');
                    }
                }
            }
        }
    }

    // View Data Pengajuan
    public function Pengajuan()
    {
        $data	= [
            'titles'	=> "Dashboard Administrator",
            'setting'   => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
            'user'	    => $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
            'Pengajuan'	=> true,
            'breadcumb'	=> "Pengajuan",
            'view'		=> "v_Pengajuan"
        ];
        $this->load->view("index", $data);
    }

    // Json View Datatable Pengajuan
    public function jsonPengajuan()
    {
        header('Content-Type: application/json');

        $join   = array(
                            ['tbl_perizinan', 'tbl_pengajuan.id_perizinan=tbl_perizinan.id_perizinan', 'LEFT'],
                            ['tbl_perusahaan', 'tbl_pengajuan.id_perusahaan=tbl_perusahaan.id_perusahaan', 'LEFT'],
                            ['tbl_status', 'tbl_pengajuan.id_status=tbl_status.id_status', 'LEFT']
                        );
        echo $this->Dashboard->jsonGlobalJoin(
            '
                tbl_pengajuan.*,
                tbl_perizinan.nama_perizinan AS nama_perizinan,
                tbl_perusahaan.nama_perusahaan AS nama_perusahaan,
                tbl_status.keterangan AS keterangan
            ',
            'tbl_pengajuan',
            $join
        );
    }

    // View Edit Pengajuan
    public function editPengajuan($id=0)
    {
        if($id!=0){
            $data = [
                'titles'		=> "Dashboard Administrator",
                'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
                'user'	        => $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
                'jenisPerizinan'=> $this->Dashboard->viewAll('*','tbl_perizinan')->result_array(),
                'status'        => $this->Dashboard->viewAll('*','tbl_status')->result_array(),
                'editPengajuan' => $this->Dashboard->viewWhere('tbl_pengajuan','id_pengajuan',$id)->result_array(),
                'profile'		=> true,
                'breadcumb'		=> "Edit Pengajuan",
                'view'			=> "v_EditPengajuan"
            ];
            $this->load->view("index", $data);
        }
    }

    // Action Edit Pengajuan
    public function ActionEditPengajuan($id=0)
    {
        if($id!=0){
            $update = [
                'id_perizinan'      => htmlentities($this->input->post('perizinan')),
                'id_status'         => htmlentities($this->input->post('status')),
                'catatan'           => htmlentities($this->input->post('keterangan'))
            ];

            // Update Into Database
            if($this->Dashboard->update('tbl_pengajuan', 'id_pengajuan', $id, $update)){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Data Pengajuan Berhasil di Ubah.</div>');
                redirect('Dashboard/Pengajuan','refresh');
            }
        }
    }

    // Action Delete Pengajuan
    public function deletePengajuan($id=0)
    {
        if($id!=0){
            if ($this->Dashboard->delete('id_pengajuan', 'tbl_pengajuan', $id)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengajuan Berhasil di Hapus.</div>');
                redirect('Dashboard/Pengajuan','refresh');
            }
        }
    }

    // View Web Setting
    public function WebSettings($id=0)
    {
        $id     = 1;
        if($id!=0){
            $data = [
                'titles'		=> "Dashboard Administrator",
                'setting'       => $this->Dashboard->viewAll('*','tbl_setting')->result_array(),
                'user'	        => $this->Dashboard->viewWhere('tbl_users','id',$id)->result_array(),
                'WebSetting'    => $this->Dashboard->viewWhere('tbl_setting','id',$id)->result_array(),
                'profile'		=> true,
                'breadcumb'		=> "Web Settings",
                'view'			=> "v_WebSetting"
            ];
            $this->load->view("index", $data);
        }
    }

    // Action Update Web Setting
    public function ActionEditWebSetting($id=0)
    {
        if($id!=0){
            $this->form_validation->set_rules("name", "Name", "trim|min_length[5]|required");
            $this->form_validation->set_rules("alamat", "Alamat", "trim|min_length[15]|required");
            $this->form_validation->set_rules("host", "Host", "trim|required");
            $this->form_validation->set_rules("username", "Username", "trim|valid_email|required");
            $this->form_validation->set_rules("password", "Password", "trim|required");
            if ($this->form_validation->run() == false) {
                $this->WebSettings(1);
            } else {
                $update     = [
                    'nama_aplikasi'         => htmlentities($this->input->post('name')),
                    'address'               => htmlentities($this->input->post('alamat')),
                    'host'                  => htmlentities($this->input->post('host')),
                    'username'              => htmlentities($this->input->post('username')),
                    'password'              => htmlentities($this->input->post('password'))
                ];

                // Update Into Database
                if ($this->Dashboard->update('tbl_setting', 'id', 1, $update)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success Update Setting Website Success !!</div>');
                    redirect('Dashboard/WebSettings/1','refresh');
                }
            }
        }
    }
}