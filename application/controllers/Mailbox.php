<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mailbox extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
        is_folder();
    }

    public function inbox()
    {
        $data['title'] = 'Inbox';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mail'] = $this->db->order_by('id', 'DESC')->get_where('mail', [
            'recepient_id' => $data['user']['id'],
            'status' => 1,
            'is_deleted_recepient' => 0
        ])->result_array();

        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('mailbox/inbox', $data);
        $this->load->view('templete/footer', $data);
    }

    public function writter()
    {
        $data['title'] = 'Writte Message';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('recepient', 'Recepient', 'required|trim|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('mailbox/writte', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $recepient = $this->input->post('recepient');
            $recepient_query = $this->db->get_where('user', ['email' => $recepient])->row_array();
            $recepient_id = $recepient_query['id'];
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $status = $this->input->post('status');
            $upload_file = $_FILES['file']['name'];
            if ($upload_file) {
                $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xlsx|xlt|ppt|pptx|rar';
                $config['max_size']     = '100048';
                $config['upload_path'] = './assets/file_mail/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $file = NULL;
            }
            if ($recepient_query < 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            email not founded
            </div>');
                redirect('mailbox/writter');
            } else {
                $data = [
                    'sender_id' => $data['user']['id'],
                    'recepient_id' => $recepient_id,
                    'subject' => $subject,
                    'message' => $message,
                    'created_at' => time(),
                    'status' => $status,
                    'file' => $file,
                    'is_deleted_sender' => 0,
                    'is_deleted_recepient' => 0,
                    'is_read' => 0
                ];
                $this->db->insert('mail', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success
            </div>');
                if ($status == 1) {
                    redirect('mailbox/sent');
                } else {
                    redirect('mailbox/draft');
                }
            }
        }
    }

    public function reply($id)
    {
        $data['title'] = 'Reply Message';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mail'] = $this->db->get_where('mail', [
            'id' => $id
        ])->row_array();
        $data['id'] = $id;
        $this->form_validation->set_rules('recepient', 'Recepient', 'required|trim|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('mailbox/reply', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $recepient = $this->input->post('recepient');
            $recepient_query = $this->db->get_where('user', ['email' => $recepient])->row_array();
            $recepient_id = $recepient_query['id'];
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $status = $this->input->post('status');
            $upload_file = $_FILES['file']['name'];
            if ($upload_file) {
                $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xlsx|xlt|ppt|pptx|rar';
                $config['max_size']     = '100048';
                $config['upload_path'] = './assets/file_mail/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file')) {
                    $file = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $file = NULL;
            }
            if ($recepient_query < 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            email not founded
            </div>');
                redirect('mailbox/reply/' . $id);
            } else {
                $data = [
                    'sender_id' => $data['user']['id'],
                    'recepient_id' => $recepient_id,
                    'subject' => $subject,
                    'message' => $message,
                    'created_at' => time(),
                    'status' => $status,
                    'file' => $file,
                    'is_deleted_sender' => 0,
                    'is_deleted_recepient' => 0,
                    'is_read' => 0
                ];
                $this->db->insert('mail', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success
            </div>');
                redirect('mailbox/inbox');
            }
        }
    }

    public function viewmail($id)
    {
        $data['title'] = 'MailBox > Preview';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mail'] = $this->db->get_where('mail', [
            'id' => $id
        ])->row_array();
        if ($data['mail']['recepient_id'] == $data['user']['id']) {
            $this->db->set('is_read', 1);
            $this->db->where('id', $id);
            $this->db->update('mail');
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('mailbox/viewmail', $data);
            $this->load->view('templete/footer', $data);
        } else {
            redirect('mailbox/inbox');
        }
    }

    public function sent()
    {
        $data['title'] = 'Send Mail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mail'] = $this->db->order_by('id', 'DESC')->get_where('mail', [
            'sender_id' => $data['user']['id'],
            'status' => 1,
            'is_deleted_sender' => 0
        ])->result_array();

        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('mailbox/sent', $data);
        $this->load->view('templete/footer', $data);
    }

    public function viewsent($id)
    {
        $data['title'] = 'Send Mail > Preview';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mail'] = $this->db->get_where('mail', [
            'id' => $id
        ])->row_array();
        if ($data['mail']['sender_id'] == $data['user']['id']) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('mailbox/viewsent', $data);
            $this->load->view('templete/footer', $data);
        } else {
            redirect('mailbox/sent');
        }
    }

    public function draft()
    {
        $data['title'] = 'Draft Mail';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mail'] = $this->db->order_by('id', 'DESC')->get_where('mail', [
            'sender_id' => $data['user']['id'],
            'status' => 2,
            'is_deleted_sender' => 0
        ])->result_array();

        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('mailbox/draft', $data);
        $this->load->view('templete/footer', $data);
    }

    public function viewdraft($id)
    {
        $data['title'] = 'Draft > Preview';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['mail'] = $this->db->get_where('mail', [
            'id' => $id
        ])->row_array();
        if ($data['mail']['sender_id'] == $data['user']['id']) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('mailbox/viewdraft', $data);
            $this->load->view('templete/footer', $data);
        } else {
            redirect('mailbox/draft');
        }
    }

    public function trash_sender($id)
    {
        $this->db->set('is_deleted_sender', 1);
        $this->db->where('id', $id);
        $this->db->update('mail');
        $mail = $this->db->get_where('mail', [
            'id' => $id
        ])->row_array();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success
            </div>');
        if ($mail['status'] == 2) {
            redirect('mailbox/draft');
        } else {
            redirect('mailbox/sent');
        }
    }

    public function send_draft($id)
    {
        $this->db->set('status', 1);
        $this->db->set('created_at', time());
        $this->db->where('id', $id);
        $this->db->update('mail');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success
            </div>');
        redirect('mailbox/sent');
    }

    public function trash_recepient($id)
    {
        $this->db->set('is_deleted_recepient', 1);
        $this->db->where('id', $id);
        $this->db->update('mail');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            success
            </div>');
        redirect('mailbox/inbox');
    }
}
