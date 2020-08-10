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
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('group_member', 'group_member.member_id = user.id');
        $this->db->where('group_member.group_id', $id);
        $data['member'] = $this->db->get()->result_array();
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
