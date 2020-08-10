<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_folder();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templete/footer', $data);
    }

    public function role()
    {
        $data['title'] = 'Role';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $role = $this->input->post('role');
            $this->db->insert('user_role', ['role' => $role]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Role Has Been Added !
                        </div>');
            redirect('dashboard/role');
        }
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $this->db->where('id !=', 3);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templete/footer', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Changes
            </div>');
    }

    public function group()
    {
        $data['title'] = 'Group Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['group'] = $this->db->get('group')->result_array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[group.title]', [
            'is_unique' => 'this group has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => ' password dont match !',
            'min_length' => ' password too short !'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('admin/group', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $user_id = $data['user']['id'];
            $name = $this->input->post('name');
            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');
            $password = password_hash($password1, PASSWORD_DEFAULT);
            $data = [
                'title' => $name,
                'created_by' => $user_id,
                'password' => $password,
                'image' => 'default_group.jpg'
            ];
            $this->db->insert('group', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Group Has Been Added
            </div>');
            redirect('dashboard/group');
        }
    }

    public function accessgroup($id)
    {
        $data['title'] = 'Access Group';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user_id = $data['user']['id'];
        $data['group'] = $this->db->get_where('group', [
            'id' => $id
        ])->row_array();
        $user_id = $data['user']['id'];
        // $this->db->select('*');
        // $this->db->from('user');
        // $this->db->join('group_member', 'group_member.member_id = user.id');
        // $this->db->where('group_member.group_id', $id);
        // $data['member'] = $this->db->get()->result_array();
        $queryMenu = "SELECT `user`.`id`, `name`, `image`
                      FROM `user` JOIN `group_member` 
                       ON `user`.`id` = `group_member`.`member_id`
                    WHERE `group_member`.`group_id` = $id";
        $data['member'] = $this->db->query($queryMenu)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('admin/accessgroup', $data);
        $this->load->view('templete/footer', $data);
    }

    public function kick($id_user, $id_group)
    {

        $this->db->where('group_id', $id_group);
        $this->db->where('member_id', $id_user);
        $this->db->delete('group_member');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Member has been kicked
            </div>');
        redirect('dashboard/accessgroup/' . $id_group);
    }

    public function absent()
    {
        $data['title'] = 'Employee Absent';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $query = "SELECT COUNT(id) as jumlah ,DATE(date)as date FROM absensi_masuk GROUP BY YEAR(date),MONTH(date), DAY(date) ORDER BY id DESC";
        $data['absent'] = $this->db->query($query)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('admin/absent', $data);
        $this->load->view('templete/footer', $data);
    }

    public function viewabsent($date)
    {
        $data['title'] = 'Employee Absent at ' . $date;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['member'] = $this->db->get_where('user', [
            'role_id' => 3
        ])->result_array();
        $data['date'] = $date;
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('admin/viewabsent', $data);
        $this->load->view('templete/footer', $data);
    }


    public function scanabsent()
    {
        $data['title'] = 'Access Group';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('scan/index');
        // $this->load->view('templete/footer', $data);
    }

    public function submitabsent()
    {
        $data['title'] = 'Access Group';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $email = $this->input->post('email');

        $data['absen'] = $this->db->get_where('user', [
            'email' => $email
        ])->row_array();
        $absen_id = $data['absen']['id'];
        $absen_name = $data['absen']['name'];
        $year = date('Y');
        $mounth = date('m');
        $day = date('d');
        $query = "SELECT MONTH(date),DAY(date),YEAR(date),user_id FROM absensi_masuk WHERE 
        MONTH(date) = $mounth AND DAY(date)= $day AND YEAR(date) = $year AND user_id = $absen_id";
        $cek = $this->db->query($query)->result_array();
        // var_dump($cek);
        // die();
        if ($cek == NULL) {
            $isi = [
                'user_id' => $absen_id
            ];
            $this->db->insert('absensi_masuk', $isi);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Terimakasi sudah login ' . $absen_name .
                '</div>');
            redirect('dashboard/scanabsent');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            You Already Absent !
            </div>');
            redirect('dashboard/scanabsent');
        }
    }
}
