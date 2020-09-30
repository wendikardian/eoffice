<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_folder();
    }

    public function event()
    {
        $data['title'] = 'Event';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $this->db->order_by('id', 'DESC');
        $data['event'] = $this->db->get('event')->result_array();
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('info', 'Info', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('event/event', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $subject = $this->input->post('subject');
            $info = $this->input->post('info');
            $date = strtotime($this->input->post('date'));
            $type = $this->input->post('type');
            $data = [
                'created_by' => $data['user']['id'],
                'date' => $date,
                'subject' => $subject,
                'info' => $info,
                'type' => $type
            ];
            $this->db->insert('event', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Event Has Been Added !
                        </div>');
            redirect('event/event');
        }
    }

    public function detailevent($id)
    {
        $data['title'] = 'Event Detail';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $query = "SELECT *
                      FROM `event` JOIN `user` 
                       ON `event`.`created_by` = `user`.`id`
                    WHERE `event`.`id` = $id";
        $data['event'] = $this->db->query($query)->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('event/detailevent', $data);
        $this->load->view('templete/footer', $data);
    }

    public function delete($id)
    {
        $query = "DELETE from `event` where `id` = $id";
        $this->db->query($query);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success for deleted event
            </div>');
        redirect('event/event');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Event';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['event'] = $this->db->get_where('event', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('info', 'Info', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('event/editevent', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $subject = $this->input->post('subject');
            $info = $this->input->post('info');
            $date = strtotime($this->input->post('date'));
            $type = $this->input->post('type');
            $this->db->set('subject', $subject);
            $this->db->set('info', $info);
            $this->db->set('date', $date);
            $this->db->set('type', $type);
            $this->db->where('id', $id);
            $this->db->update('event');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success for updating event
            </div>');
            redirect('event/detailevent/' . $id);
        }
    }

    public function announcement()
    {
        $data['title'] = 'Announcement';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $query = "SELECT * FROM `announcement` ORDER BY `id` DESC";
        $data['announcement'] = $this->db->query($query)->result_array();
        $this->form_validation->set_rules('caption', 'Caption', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('event/announcement', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $caption = $this->input->post('caption');
            $image = $_FILES['image']['name'];
            if ($image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '100048';
                $config['upload_path'] = './assets/img/announcement/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $image = NULL;
            }
            $data = [
                'created_by' => $data['user']['id'],
                'date' => time(),
                'caption' => $caption,
                'image' => $image
            ];
            $this->db->insert('announcement', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success for uploading announcement
            </div>');
            redirect('event/announcement');
        }
    }

    public function comment($id)
    {
        $data['title'] = 'Announcement';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['announcement'] = $this->db->get_where('announcement', [
            'id' => $id
        ])->row_array();
        $comment = "SELECT * from `comment` where `aid` = $id order by `id` DESC";
        $data['comment'] = $this->db->query($comment)->result_array();
        $this->form_validation->set_rules('comment', 'Comment', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('event/comment', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $comment = $this->input->post('comment');
            $data = [
                'uid' => $data['user']['id'],
                'aid' => $id,
                'comment' => $comment,
                'date' => time()
            ];
            $this->db->insert('comment', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            comment has been sent
            </div>');
            redirect('event/comment/' . $id);
        }
    }

    public function a_delete($id)
    {
        $query1 = "DELETE from `announcement` where `id` =  $id";
        $this->db->query($query1);
        $query2 = "DELETE from `comment` where `aid` = $id";
        $this->db->query($query2);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Annaouncement has been deleted
            </div>');
        redirect('event/announcement');
    }

    public function a_edit($id)
    {
        $data['title'] = 'Announcement';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['announcement'] = $this->db->get_where('announcement', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('caption', 'Caption', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('event/a_edit', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $caption = $this->input->post('caption');
            $this->db->set('caption', $caption);
            $this->db->where('id', $id);
            $this->db->update('announcement');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Annaouncement has been updated
            </div>');
            redirect('event/announcement');
        }
    }
}
