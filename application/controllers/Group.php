<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_folder();
    }
    public function group()
    {
        $data['title'] = 'Group';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['group'] = $this->db->get('group')->result_array();
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('group_group', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('group_group');
        }
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'group/group';
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
        $this->load->view('group/group', $data);
        $this->load->view('templete/footer', $data);
    }

    public function join($id)
    {
        $data['title'] = 'Group';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['group_id'] = $id;
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('group/joingroup', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $password = $this->input->post('password');
            $user_id = $data['user']['id'];
            $cek_member = $this->db->get_where('group_member', [
                'group_id' => $id,
                'member_id' => $user_id
            ])->result_array();
            // var_dump($cek_member);
            // die();
            $group = $this->db->get_where('group', [
                'id' => $id
            ])->row_array();
            if ($group) {
                if ($cek_member == NULL) {
                    if (password_verify($password, $group['password'])) {
                        $data = [
                            'group_id' => $id,
                            'member_id' => $user_id
                        ];
                        $this->db->insert('group_member', $data);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                       Success Joining The Group
                       </div>');
                        redirect('group/mygroup');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                       Wrong Password!
                       </div>');
                        redirect('group/group');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                       You Already Join The Group!
                       </div>');
                    redirect('group/group');
                }
            }
        }
    }

    public function mygroup()
    {
        $data['title'] = 'My Group';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $user_id = $data['user']['id'];
        // $this->db->select('*');
        // $this->db->from('group');
        // $this->db->join('group_member', 'group_member.group_id = group.id');
        // $this->db->where('group_member.member_id', $user_id);
        // $data['group'] = $this->db->get()->result_array();
        $queryMenu = "SELECT `group`.`id`, `title`, `image`
                      FROM `group` JOIN `group_member` 
                       ON `group`.`id` = `group_member`.`group_id`
                    WHERE `group_member`.`member_id` = $user_id
                    ORDER BY `group`.`id` ASC";
        $data['group'] = $this->db->query($queryMenu)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('group/mygroup', $data);
        $this->load->view('templete/footer', $data);
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
        $query = "SELECT user.id as user_id, user.name as user_name, user.image as user_image, group.title as group_title, group.image as group_image from `group_member` join `user` on `group_member`.`member_id` = `user`.`id` join `group` on `group_member`.`group_id` = `group`.`id` where `group_member`.`group_id` = $id ";
        // $this->db->select('*');
        // $this->db->from('user');
        // $this->db->join('group_member', 'group_member.member_id = user.id');
        // $this->db->where('group_member.group_id', $id);
        $data['member'] = $this->db->query($query)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('group/accessgroup', $data);
        $this->load->view('templete/footer', $data);
    }
    public function leave($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user_id = $data['user']['id'];
        $this->db->where('group_id', $id);
        $this->db->where('member_id', $user_id);
        $this->db->delete('group_member');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Success !
            </div>');
        redirect('group/mygroup');
    }
}
