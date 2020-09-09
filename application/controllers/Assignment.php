<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assignment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_folder();
    }

    public function assignment()
    {
        $data['title'] = 'Assignment';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $id = $data['user']['id'];
        $query = " SELECT * from `assignment` where `recepient_id` = $id AND `is_deleted` = 0 AND `status` = 1 order by `id` DESC";
        $query1 = " SELECT * from `assignment` where `recepient_id` = $id AND `is_deleted` = 0 AND `status` = 2 order by `submited_at` DESC";
        $data['assignment_process'] = $this->db->query($query)->result_array();
        $data['assignment_done'] = $this->db->query($query1)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('assignment/assignment', $data);
        $this->load->view('templete/footer', $data);
    }

    public function accesssinglework($id)
    {
        $data['title'] = 'View Assignment';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['assignment'] = $this->db->get_where('assignment', [
            'id' => $id
        ])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('assignment/accesssinglework', $data);
        $this->load->view('templete/footer', $data);
    }

    public function addsubmition($id)
    {
        $data['title'] = 'Add Submition';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['assignment'] = $this->db->get_where('assignment', [
            'id' => $id
        ])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('assignment/addsubmition', $data);
        $this->load->view('templete/footer', $data);
    }

    public function addsubmition_process($id)
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $user_name = $data['user']['name'];
        $user_id = $data['user']['id'];
        $assignment = $this->db->get_where('assignment', [
            'id' => $id
        ])->row_array();
        $upload_file = $_FILES['file']['name'];
        if ($upload_file) {
            $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xlsx|xlt|ppt|pptx|rar';
            $config['max_size']     = '100048';
            $config['upload_path'] = './assets/assignment/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $file = NULL;
        }
        $this->db->set('status', 2);
        $this->db->set('file', $file);
        $this->db->set('submited_at', time());
        $this->db->where('id', $id);
        $this->db->update('assignment');
        $data2 = [
            'sender_id' => $user_id,
            'recepient_id' => $assignment['sender_id'],
            'desc' => $user_name . ' has completed the assignment',
            'url' => 'bos/assignment',
            'date' => time(),
            'is_read' => 0
        ];
        $this->db->insert('notification', $data2);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success
            </div>');
        redirect('assignment/accesssinglework/' . $id);
    }

    public function editsubmition($id)
    {
        $data['title'] = 'Add Submition';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['assignment'] = $this->db->get_where('assignment', [
            'id' => $id
        ])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('assignment/editsubmition', $data);
        $this->load->view('templete/footer', $data);
    }

    public function editsubmition_process($id)
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $user_name = $data['user']['name'];
        $user_id = $data['user']['id'];
        $assignment = $this->db->get_where('assignment', [
            'id' => $id
        ])->row_array();
        $old_file = $assignment['file'];
        $upload_file = $_FILES['file']['name'];
        if ($upload_file) {
            $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xlsx|xlt|ppt|pptx|rar';
            $config['max_size']     = '100048';
            $config['upload_path'] = './assets/assignment/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                unlink(FCPATH . 'assets/assignment/' . $old_file);
                $file = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $file = NULL;
        }
        $this->db->set('file', $file);
        $this->db->set('submited_at', time());
        $this->db->where('id', $id);
        $this->db->update('assignment');
        $data2 = [
            'sender_id' => $user_id,
            'recepient_id' => $assignment['sender_id'],
            'desc' => $user_name . ' has edited the assignment',
            'url' => 'bos/assignment',
            'date' => time(),
            'is_read' => 0
        ];
        $this->db->insert('notification', $data2);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success
            </div>');
        redirect('assignment/accesssinglework/' . $id);
    }

    public function groupassignment()
    {
        $data['title'] = 'Group Assignment';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $id = $data['user']['id'];
        $query = "SELECT group_id from `group_member` where `member_id` = $id";
        $group_id = $this->db->query($query)->result_array();
        $arr = array_column($group_id, "group_id");
        $ids = join("','", $arr);
        $query = " SELECT * from `assignment_group` where `group_id` IN ('$ids') AND `is_deleted` = 0 order by `id` DESC";
        $data['assignment_process'] = $this->db->query($query)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('assignment/groupassignment', $data);
        $this->load->view('templete/footer', $data);
    }

    public function accessgroupwork($id)
    {
        $data['title'] = 'View Group Assignment';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['assignment'] = $this->db->get_where('assignment_group', [
            'id' => $id
        ])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('assignment/accessgroupwork', $data);
        $this->load->view('templete/footer', $data);
    }

    public function addgroupsubmition($id)
    {
        $data['title'] = 'Add Group Assignment Submition';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['assignment'] = $this->db->get_where('assignment_group', [
            'id' => $id
        ])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('assignment/addgroupsubmition', $data);
        $this->load->view('templete/footer', $data);
    }

    public function addgroupsubmition_process($id)
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $user_name = $data['user']['name'];
        $user_id = $data['user']['id'];
        $assignment = $this->db->get_where('assignment_group', [
            'id' => $id
        ])->row_array();
        $upload_file = $_FILES['file']['name'];
        if ($upload_file) {
            $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xlsx|xlt|ppt|pptx|rar';
            $config['max_size']     = '100048';
            $config['upload_path'] = './assets/assignment/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $file = NULL;
        }
        $data = [
            'assignment_id' => $id,
            'user_id' => $data['user']['id'],
            'file' => $file,
            'status' => 2,
            'submited_at' => time()
        ];
        $this->db->insert('assignment_group_member', $data);
        $data2 = [
            'sender_id' => $user_id,
            'recepient_id' => $assignment['sender_id'],
            'desc' => $user_name . ' has completed the group assignment',
            'url' => 'bos/groupassignment',
            'date' => time(),
            'is_read' => 0
        ];
        $this->db->insert('notification', $data2);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success for add submition
            </div>');
        redirect('assignment/accessgroupwork/' . $id);
    }

    public function editgroupsubmition($id)
    {
        $data['title'] = 'Add Group Assignment Submition';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['assignment'] = $this->db->get_where('assignment_group_member', [
            'assignment_id' => $id,
            'user_id' => $data['user']['id']
        ])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('assignment/editgroupsubmition', $data);
        $this->load->view('templete/footer', $data);
    }

    public function editgroupsubmition_process($id)
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $user_name = $data['user']['name'];
        $user_id = $data['user']['id'];
        $assignment = $this->db->get_where('assignment_group_member', [
            'assignment_id' => $id,
            'user_id' => $data['user']['id']
        ])->row_array();
        $work = $this->db->get_where('assignment_group', [
            'id' => $id
        ])->row_array();
        $old_file = $assignment['file'];
        $upload_file = $_FILES['file']['name'];
        if ($upload_file) {
            $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xlsx|xlt|ppt|pptx|rar';
            $config['max_size']     = '100048';
            $config['upload_path'] = './assets/assignment/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                unlink(FCPATH . 'assets/assignment/' . $old_file);
                $file = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $file = NULL;
        }
        $this->db->set('file', $file);
        $this->db->set('submited_at', time());
        $this->db->where('assignment_id', $id);
        $this->db->where('user_id', $data['user']['id']);
        $this->db->update('assignment_group_member');
        $data2 = [
            'sender_id' => $user_id,
            'recepient_id' => $work['sender_id'],
            'desc' => $user_name . ' has edited the group assignment',
            'url' => 'bos/groupassignment',
            'date' => time(),
            'is_read' => 0
        ];
        $this->db->insert('notification', $data2);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success for edit submition
            </div>');
        redirect('assignment/accessgroupwork/' . $id);
    }
}
