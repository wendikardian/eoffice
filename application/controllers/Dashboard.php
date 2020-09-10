<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_folder();
        $this->load->library('Pdf');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $query = "SELECT COUNT(id) as jumlah ,DATE(date) as date FROM absensi_masuk GROUP BY YEAR(date),MONTH(date), DAY(date) ORDER BY id DESC LIMIT 5";
        $absen = $this->db->query($query)->result_array();
        $data['absen'] = json_encode($absen);
        $jumlah_data = $this->db->get_where('user', [
            'role_id' => 3
        ])->num_rows();

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'dashboard/index';
        $this->db->where('role_id', 3);
        $this->db->like('name', $data['keyword']);
        // $this->db->or_like('email', $data['keyword']);
        $this->db->from('user');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;
        // styling
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item ">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $from = $this->uri->segment(3);
        $data['from'] = $from;
        $this->pagination->initialize($config);
        if ($data['keyword']) {
            $this->db->like('name', $data['keyword']);
            // $this->db->or_like('email', $data['keyword']);
            $data['member'] = $this->db->get_where('user', [
                'role_id' => 3
            ], $config['per_page'], $from)->result_array();
        } else {
            $data['member'] = $this->db->get_where('user', [
                'role_id' => 3
            ], $config['per_page'], $from)->result_array();
        }
        $data['admin'] = $this->db->get_where('user', [
            'role_id' => 1
        ])->result_array();
        $data['bos'] = $this->db->get_where('user', [
            'role_id' => 2
        ])->result_array();
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

    public function delete_role($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Role has been deleted
            </div>');
        redirect('dashboard/role');
    }

    public function edit_role($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;
        $data['role'] = $this->db->get_where('user_role', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('admin/edit_role', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $name = $this->input->post('name');
            $this->db->set('role', $name);
            $this->db->where('id', $id);
            $this->db->update('user_role');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Role has been updated
            </div>');
            redirect('dashboard/role');
        }
    }

    public function group()
    {
        $data['title'] = 'Group Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['group'] = $this->db->get('group')->result_array();
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('dashboard_group', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('dashboard_group');
        }
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'dashboard/group';
        $this->db->like('title', $data['keyword']);
        $this->db->from('group');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 2;
        // styling
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item ">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        $from = $this->uri->segment(3);
        $data['from'] = $from;
        $this->pagination->initialize($config);
        if ($data['keyword']) {
            $this->db->like('title', $data['keyword']);
            $data['group'] = $this->db->get('group', $config['per_page'], $from)->result_array();
        } else {
            $data['group'] = $this->db->get('group', $config['per_page'], $from)->result_array();
        }
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('admin/group', $data);
        $this->load->view('templete/footer', $data);
    }

    public function add_group()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user_id = $data['user']['id'];
        $name = $this->input->post('name');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        if ($password1 != $password2) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                       Password and Repeat Password different !
                       </div>');
            redirect('dashboard/group');
        } else {
            $cek = $this->db->get_where('group', [
                'title' => $name
            ])->num_rows();
            if ($cek > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                       Name Group has already created ! think another name !
                       </div>');
                redirect('dashboard/group');
            }
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
        $data['id'] = $id;
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
        $queryMenu = "SELECT `user`.`id` , `name`, `image`
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

    public function group_edit($id)
    {
        $data['title'] = 'Access Group';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;
        $data['group'] = $this->db->get_where('group', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('title', 'Title', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('admin/group_edit', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $title = $this->input->post('title');
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/group/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['group']['image'];
                    if ($old_image != 'default_group.jpg') {
                        unlink(FCPATH . 'assets/img/group/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->db->set('title', $title);
            $this->db->where('id', $id);
            $this->db->update('group');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Group Has Been Updated
            </div>');
            redirect('dashboard/accessgroup/' . $id);
        }
    }

    public function delete_group($id)
    {
        $query = "DELETE FROM `group` where `id` = $id";
        $this->db->query($query);
        $query1 = "DELETE FROM `group_member` where `group_id` = $id";
        $this->db->query($query1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Group successfuly deleted
            </div>');
        redirect('dashboard/group');
    }

    public function password_group($id)
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;
        $data['group'] = $this->db->get_where('group', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('admin/password_group', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['group']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong Current Password
            </div>');
                redirect('dashboard/password_group/' . $id);
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                         New password cannot be the same as Current Password !
                        </div>');
                    redirect('dashboard/password_group/' . $id);
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('id', $id);
                    $this->db->update('group');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Password Has Been Updated
                        </div>');
                    redirect('dashboard/password_group/' . $id);
                }
            }
        }
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

    public function print($id)
    {
        $data['user'] = $this->db->get_where('user', [
            'id' => $id
        ])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('admin/print', $data);
    }

    public function editkaryawan($id)
    {
        $data['id'] = $id;
        $data['title'] = 'Access Group';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['karyawan'] = $this->db->get_where('user', [
            'id' => $id
        ])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('admin/editkaryawan', $data);
        $this->load->view('templete/footer', $data);
    }

    public function p_editkaryawan($id)
    {
        $role = $this->input->post('role');
        $is_active = $this->input->post('is_active');
        $this->db->set('role_id', $role);
        $this->db->set('is_active', $is_active);
        $this->db->where('id', $id);
        $this->db->update('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Success for edit employee
            </div>');
        redirect('dashboard/index');
    }
}
