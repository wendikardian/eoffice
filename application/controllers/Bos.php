<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_folder();
    }

    public function assignment()
    {
        $data['title'] = 'Single Assignment';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $id = $data['user']['id'];
        $query = " SELECT * from `assignment` where `sender_id` = $id AND `is_deleted` = 0 AND `status` = 1 order by `id` DESC";
        $query1 = " SELECT * from `assignment` where `sender_id` = $id AND `is_deleted` = 0 AND `status` = 2 order by `id` DESC";
        $data['assignment_process'] = $this->db->query($query)->result_array();
        $data['assignment_done'] = $this->db->query($query1)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('bos/assignment', $data);
        $this->load->view('templete/footer', $data);
    }

    public function choose()
    {
        $data['title'] = '';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('bos/choose', $data);
        $this->load->view('templete/footer', $data);
    }

    public function addsinglework()
    {
        $data['title'] = 'Add Single Work';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $user_id = $data['user']['id'];
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('desc', 'Desc', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('bos/addsinglework', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $email = $this->input->post('email');
            $title = $this->input->post('title');
            $date1 = $this->input->post('date');
            $date = strtotime($date1);
            $time1 = $this->input->post('time');
            $datenow = strtotime(date("Y/m/d"));
            $time = strtotime($time1);
            $desc = $this->input->post('desc');
            $hour = $time - $datenow;
            $deadline = $date + $hour;
            var_dump(date("Y/m/d h:i", $deadline));
            $recepient = $this->db->get_where('user', [
                'email' => $email
            ])->row_array();
            if ($recepient < 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                         Email Not Found !
                        </div>');
                redirect('bos/addsinglework');
            } else {
                $recepient_id = $recepient['id'];
                $data = [
                    'sender_id' => $data['user']['id'],
                    'recepient_id' => $recepient_id,
                    'title' => $title,
                    'info' => $desc,
                    'created_at' => time(),
                    'deadline_at' => $deadline,
                    'submited_at' => NULL,
                    'status' => 1,
                    'file' => NULL,
                    'is_deleted' => 0
                ];
                $this->db->insert('assignment', $data);
                $desc_notif = 'New Assignment has been added';
                $data2 = [
                    'sender_id' => $user_id,
                    'recepient_id' => $recepient_id,
                    'desc' => $desc_notif,
                    'url' => 'assignment/assignment',
                    'date' => time(),
                    'is_read' => 0
                ];
                $this->db->insert('notification', $data2);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Assignment has been added !
                        </div>');
                redirect('bos/assignment');
            }
        }
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
        $this->load->view('bos/accesssinglework', $data);
        $this->load->view('templete/footer', $data);
    }

    public function deleteassignment($id)
    {
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $id);
        $this->db->update('assignment');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Assignment has been deleted !
                        </div>');
        redirect('bos/assignment');
    }

    public function editassignment($id)
    {
        $data['title'] = 'Add Single Work';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['assignment'] = $this->db->get_where('assignment', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('desc', 'Desc', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('bos/editassignment', $data);
            $this->load->view('templete/footer', $data);
        } else {

            $title = $this->input->post('title');
            $date1 = $this->input->post('date');
            $date = strtotime($date1);
            $time1 = $this->input->post('time');
            $datenow = strtotime(date("Y/m/d"));
            $time = strtotime($time1);
            $desc = $this->input->post('desc');
            $hour = $time - $datenow;
            $deadline = $date + $hour;
            $this->db->set('title', $title);
            $this->db->set('info', $desc);
            $this->db->set('deadline_at', $deadline);
            $this->db->where('id', $id);
            $this->db->update('assignment');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Assignment has been updated !
                        </div>');
            redirect('bos/accesssinglework/' . $id);
        }
    }

    public function addgroupwork()
    {
        $data['title'] = 'Add Single Work';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $user_id = $data['user']['id'];
        $data['group'] = $this->db->get('group')->result_array();
        $this->form_validation->set_rules('group_id', 'Group_id', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('desc', 'Desc', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('bos/addgroupwork', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $group_id = $this->input->post('group_id');
            $title = $this->input->post('title');
            $date1 = $this->input->post('date');
            $date = strtotime($date1);
            $time1 = $this->input->post('time');
            $datenow = strtotime(date("Y/m/d"));
            $time = strtotime($time1);
            $desc = $this->input->post('desc');
            $hour = $time - $datenow;
            $deadline = $date + $hour;
            var_dump(date("Y/m/d h:i", $deadline));
            $recepient = $this->db->get_where('user', [
                'email' => $email
            ])->row_array();
            $recepient_id = $recepient['id'];

            $query = "SELECT member_id from group_member where group_id = $group_id";
            $group_member = $this->db->query($query)->result_array();
            $arr = array_column($group_member, "member_id");
            foreach ($arr as $g) {
                $data2 = [
                    'sender_id' => $user_id,
                    'recepient_id' => $g,
                    'desc' => "New Assignment has been added",
                    'url' => "assignment/groupassignment",
                    'date' => time(),
                    'is_read' => 0
                ];
                $this->db->insert('notification', $data2);
            }
            $data = [
                'sender_id' => $data['user']['id'],
                'group_id' => $group_id,
                'title' => $title,
                'info' => $desc,
                'created_at' => time(),
                'deadline_at' => $deadline,
                'is_deleted' => 0
            ];
            $this->db->insert('assignment_group', $data);


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Assignment has been added !
                        </div>');
            redirect('bos/groupassignment');
        }
    }

    public function groupassignment()
    {
        $data['title'] = 'Group Assignment';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $id = $data['user']['id'];
        $query = " SELECT * from `assignment_group` where `sender_id` = $id AND `is_deleted` = 0 order by `id` DESC";
        $data['assignment_process'] = $this->db->query($query)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('bos/groupassignment', $data);
        $this->load->view('templete/footer', $data);
    }

    public function accessgroupwork($id)
    {
        $data['id'] = $id;
        $data['title'] = 'View Group Assignment';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['assignment'] = $this->db->get_where('assignment_group', [
            'id' => $id
        ])->row_array();
        $group_id = $data['assignment']['group_id'];
        $query = "SELECT user.image as image, user.name as name, user.id as id FROM `group_member` JOIN user on user.id = group_member.member_id where group_id = $group_id";
        $data['member'] = $this->db->query($query)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('bos/accessgroupwork', $data);
        $this->load->view('templete/footer', $data);
    }

    public function deletegroupassignment($id)
    {
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $id);
        $this->db->update('assignment_group');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Assignment has been deleted !
                        </div>');
        redirect('bos/groupassignment');
    }

    public function editgroupassignment($id)
    {
        $data['title'] = 'Add Single Work';
        $data['id'] = $id;
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['assignment'] = $this->db->get_where('assignment_group', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time', 'Time', 'required');
        $this->form_validation->set_rules('desc', 'Desc', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('bos/editgroupassignment', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $title = $this->input->post('title');
            $date1 = $this->input->post('date');
            $date = strtotime($date1);
            $time1 = $this->input->post('time');
            $datenow = strtotime(date("Y/m/d"));
            $time = strtotime($time1);
            $desc = $this->input->post('desc');
            $hour = $time - $datenow;
            $deadline = $date + $hour;
            $this->db->set('title', $title);
            $this->db->set('info', $desc);
            $this->db->set('deadline_at', $deadline);
            $this->db->where('id', $id);
            $this->db->update('assignment_group');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Assignment has been updated !
                        </div>');
            redirect('bos/accessgroupwork/' . $id);
        }
    }

    public function point()
    {
        $data['title'] = 'Point';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $id = $data['user']['id'];
        $user_id = $data['user']['id'];
        $query1 = "SELECT * from `point_plus` WHERE `sender_id` = $user_id order by `id` DESC";
        $data['plus'] = $this->db->query($query1)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('bos/point', $data);
        $this->load->view('templete/footer', $data);
    }

    public function addpoint()
    {
        $data['title'] = 'Add/Subtrack Point';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $user_id = $data['user']['id'];
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('point', 'Point', 'required');
        $this->form_validation->set_rules('desc', 'Desc', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('bos/addpoint', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $email = $this->input->post('email');
            $point = $this->input->post('point');
            $desc = $this->input->post('desc');
            $recepient = $this->db->get_where('user', [
                'email' => $email
            ])->row_array();
            if ($recepient < 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                         Email Not Found !
                        </div>');
                redirect('bos/addpoint');
            } else {
                $recepient_id = $recepient['id'];
                $data = [
                    'sender_id' => $data['user']['id'],
                    'recepient_id' => $recepient_id,
                    'point' => $point,
                    'desc' => $desc
                ];
                $this->db->insert('point_plus', $data);
                $data2 = [
                    'sender_id' => $user_id,
                    'recepient_id' => $recepient_id,
                    'desc' => 'You got some new point = ' . $point,
                    'url' => 'profile/point/' . $recepient_id,
                    'date' => time(),
                    'is_read' => 0
                ];
                $this->db->insert('notification', $data2);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Point Has Been Added 
                        </div>');
                redirect('bos/point');
            }
        }
    }

    public function addpoint_profile($id)
    {
        $data['id'] = $id;
        $data['title'] = 'Add/Subtrack Point';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $user_id = $data['user']['id'];
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('point', 'Point', 'required');
        $this->form_validation->set_rules('desc', 'Desc', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('bos/addpoint_profile', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $email = $this->input->post('email');
            $point = $this->input->post('point');
            $desc = $this->input->post('desc');
            $recepient = $this->db->get_where('user', [
                'email' => $email
            ])->row_array();
            if ($recepient < 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                         Email Not Found !
                        </div>');
                redirect('bos/addpoint_profile');
            } else {
                $recepient_id = $recepient['id'];
                $data = [
                    'sender_id' => $data['user']['id'],
                    'recepient_id' => $recepient_id,
                    'point' => $point,
                    'desc' => $desc
                ];
                $this->db->insert('point_plus', $data);
                $data2 = [
                    'sender_id' => $user_id,
                    'recepient_id' => $recepient_id,
                    'desc' => 'You got some new point = ' . $point,
                    'url' => 'profile/point/' . $recepient_id,
                    'date' => time(),
                    'is_read' => 0
                ];
                $this->db->insert('notification', $data2);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Point Has Been Added 
                        </div>');
                redirect('profile/viewprofile/' . $id);
            }
        }
    }

    public function rankpoint()
    {
        $data['title'] = 'Rank';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $id = $data['user']['id'];
        $user_id = $data['user']['id'];
        $query1 = "SELECT sum(point) as point, recepient_id FROM `point_plus` group by recepient_id order by point desc ";
        $data['plus'] = $this->db->query($query1)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('bos/rankpoint', $data);
        $this->load->view('templete/footer', $data);
    }

    public function rankpoint_month()
    {
        $data['title'] = 'Rank This Month';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $id = $data['user']['id'];
        $user_id = $data['user']['id'];
        $date = date("Y-m", time());
        $data['date'] = $date;
        $query1 = "SELECT sum(point) as point, recepient_id FROM `point_plus` where  date like '{$date}%' group by recepient_id order by point desc";
        $data['plus'] = $this->db->query($query1)->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('bos/rankpoint_month', $data);
        $this->load->view('templete/footer', $data);
    }
}
