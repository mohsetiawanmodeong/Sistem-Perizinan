<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->model('dashboard/Dashboard_model', 'Dashboard', TRUE);
        set_zone();

        // if ($this->session->userdata('role_id')!=1) {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap login untuk melanjutkan</div>');
        //     redirect('login');
        // }
    }

    public function index()
    {
        $join   = array(
                        ['tbl_role','tbl_users.role_id=tbl_role.id','LEFT']
                    );
        $data	= [
            'titles'	=> "Dashboard Administrator",
            'user'	    => $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
            'Userls'    => $this->Dashboard->viewGlobalJoinOrder('tbl_users.*,tbl_role.name AS role_name','tbl_users', 'tbl_users.id', $join)->result_array(),
            'role'      => $this->Dashboard->viewAll('*','tbl_role')->result_array(),
            'User'	    => true,
            'breadcumb'	=> "Users",
            'view'		=> "v_Users"
        ];
        $this->load->view("index", $data);
    }

    // **************
    // USERS
    // **************

    public function addUsers()
    {
        $input = [
            'name'          => htmlentities($this->input->post('name')),
            'username'      => htmlentities($this->input->post('username')),
            'password'		=> md5(htmlspecialchars($this->input->post('password'))),
            'role_id'       => htmlentities($this->input->post('role'))
        ];

        if ($this->Dashboard->insert('tbl_users',$input)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success to Insert Users Data Name = ['.$input['name'].'] Success !!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }

        redirect('users', 'refresh');
    }

    // Edit Users
    public function editUsers()
    {
        $id     = htmlentities($this->input->post('id'));
        $input  = [
            'name'          => htmlentities($this->input->post('name')),
            'password'		=> md5(htmlspecialchars($this->input->post('password'))),
            'role_id'       => htmlentities($this->input->post('role'))
        ];

        if ($this->Dashboard->update('tbl_users', 'id', $id, $input)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success to Update Users Data Name = ['.$input['name'].'] Success !!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }
        redirect('Users', 'refresh');
    }

    // Delete Users
    public function delUsers($id)
    {
        if ($this->Dashboard->delete('id','tbl_users',$id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congrulation your user data ID = [' .$id.'] has been deleted</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }
        redirect('Users', 'refresh');
    }

    // Users Role
    public function role()
    {
        $data	= [
            'titles'	=> "Dashboard Administrator",
            'user'	    => $this->Dashboard->viewWhere('tbl_users','id', $this->session->userdata('id'))->result_array(),
            'role'      => $this->Dashboard->viewAll('*','tbl_role')->result_array(),
            'User'	    => true,
            'breadcumb'	=> "Role",
            'view'		=> "v_Role"
        ];
        $this->load->view("index", $data);
    }

    // Add Role Users
    public function addRole()
    {
        $input = [
            'name'      => htmlentities($this->input->post('name'))
        ];

        if ($this->Dashboard->insertRole($input)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success to Insert Role Data Name = ['.$input['name'].'] Success !!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }

        redirect('users/role', 'refresh');
    }

    // Edit Role
    public function editRole()
    {
        $input = [
            'id'        => htmlentities($this->input->post('id')),
            'name'      => htmlentities($this->input->post('name'))
        ];

        if ($this->Dashboard->update_role($input)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success to Update Role Data Name = ['.$input['name'].'] Success !!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }
        redirect('users/role', 'refresh');
    }

    // Delete Role
    public function delRole($id)
    {
        if ($this->Dashboard->delete_Role($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congrulation your Role data ID = [' .$id.'] has been deleted</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }
        redirect('users/role', 'refresh');
    }

    // Member Role
    public function memberRole()
    {
        $data	= [
            'titles'	=> "Dashboard Administrator",
            'user'	    => $this->Dashboard_model->view()->result_array(),
            'Userls'    => $this->Dashboard->view()->result_array(),
            'role'      => $this->Dashboard->viewrole()->result_array(),
            'User'	    => true,
            'breadcumb'	=> "Member Role",
            'view'		=> "v_Member_Role"
        ];
        $this->load->view("index", $data);
    }

    // Insert Member Role
    public function addMemberRole()
    {
        $input = [
            'name'      => htmlentities($this->input->post('name'))
        ];

        if ($this->Dashboard->insertMemberRole($input)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success to Insert Member Role Name = ['.$input['name'].'] Success !!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }

        redirect('users/memberRole', 'refresh');
    }

    // Edit Member Role
    public function editMemberRole()
    {
        $input = [
            'id'        => htmlentities($this->input->post('id')),
            'name'      => htmlentities($this->input->post('name'))
        ];

        if ($this->Dashboard->update_MemberRole($input)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success to Update Member Role Name = ['.$input['name'].'] Success !!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }
        redirect('users/memberRole', 'refresh');
    }

    // Delete Member Role
    public function delMemberRole($id)
    {
        if ($this->Dashboard->delete_MemberRole($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congrulation your Member Role data ID = [' .$id.'] has been deleted</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }
        redirect('users/memberRole', 'refresh');
    }

    // Waiting to become Member
    public function becomeMember()
    {
        $data	= [
            'titles'	=> "Dashboard Administrator",
            'user'	    => $this->Dashboard_model->view()->result_array(),
            'Userls'    => $this->Dashboard->view()->result_array(),
            'member'    => $this->Dashboard->viewbukti()->result_array(),
            'Bemember'  => true,
            'breadcumb'	=> "Become Member",
            'view'		=> "v_Member"
        ];
        $this->load->view("index", $data);
    }

    public function madeMember($id)
    {
        // Ambil data username dari member list
        $data['memberlist'] = $this->Dashboard->viewbuktiid($id)->result_array();
        $id                 = $data['memberlist'][0]['user'];

        // Update Data tbl_users
        $input  = [
            'member'    => 2
        ];

        if ($this->Dashboard->update_MemberRank($id, $input)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success to made Member Role to ID = ['.$id.'] Success !!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }
        redirect('users/becomeMember', 'refresh');
    }

    public function madeGuest($id)
    {
        // Ambil data username dari member list
        $data['memberlist'] = $this->Dashboard->viewbuktiid($id)->result_array();
        $id                 = $data['memberlist'][0]['user'];

        // Update Data tbl_users
        $input  = [
            'member'    => 1
        ];

        if ($this->Dashboard->update_MemberRank($id, $input)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success to made Guest Role to ID = ['.$id.'] Success !!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error</div>');
        }
        redirect('users/becomeMember', 'refresh');
    }
}