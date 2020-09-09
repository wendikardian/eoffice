<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_folder();
    }

    public function profile()
    {
        $data['title'] = 'My Profile';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templete/footer', $data);
    }

    public function editprofile()
    {
        $data['title'] = 'Edit Profile';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telphone', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('user/editprofile', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $telp = $this->input->post('telp');

            //check jika ada gambar yang diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {

                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->set('telp', $telp);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your Profile Has Been Updated
            </div>');
            redirect('profile/profile');
        }
    }
    public function changepassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong Current Password
            </div>');
                redirect('profile/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                         New password cannot be the same as Current Password !
                        </div>');
                    redirect('profile/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Password Has Been Updated
                        </div>');
                    redirect('profile/profile');
                }
            }
        }
    }

    public function viewprofile($id)
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        if ($id == $data['user']['id']) {
            redirect('profile/profile');
        } else {
            $data['profile'] = $this->db->get_where('user', ['id' => $id])->row_array();
            $data['title'] = $data['profile']['name'] . ' Profile';
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('user/viewprofile', $data);
            $this->load->view('templete/footer', $data);
        }
    }

    public function point($id)
    {
        $data['title'] = 'Point History';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $query = "SELECT * from point_plus where recepient_id = $id order by id DESC";
        $data['plus'] = $this->db->query($query)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('user/point', $data);
        $this->load->view('templete/footer', $data);
    }

    public function notification($id)
    {
        $data['title'] = 'Notification';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $query = "SELECT user.image as image, user.name as name,user.id as user_id, notification.desc, notification.date,url, is_read from notification JOIN user on user.id = notification.sender_id WHERE recepient_id = $id ORDER BY notification.id desc LIMIT 5";
        $data['notif'] = $this->db->query($query)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('user/notification', $data);
        $this->load->view('templete/footer', $data);
    }
}
