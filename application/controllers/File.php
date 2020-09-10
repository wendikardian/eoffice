<?php
defined('BASEPATH') or exit('No direct script access allowed');

class File extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function publicfile()
    {
        is_folder();
        $data['title'] = 'Public File';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['folder'] = $this->db->get('folder_public')->result_array();
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword_publicfile', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword_publicfile');
        }
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'file/publicfile';
        $this->db->like('title', $data['keyword']);
        $this->db->from('folder_public');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 3;
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
            $data['folder'] = $this->db->get('folder_public', $config['per_page'], $from)->result_array();
        } else {
            $data['folder'] = $this->db->get('folder_public', $config['per_page'], $from)->result_array();
        }

        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('file/filepublic', $data);
        $this->load->view('templete/footer', $data);
    }

    public function add_folderpublic()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $title = $this->input->post('title');
        $cek = $this->db->get_where('folder_public', [
            'title' => $title
        ])->num_rows();
        if ($cek > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Folder Name already exist
                    </div>');
            redirect('file/publicfile');
        } else {
            $data = [
                'title' => $title,
                'owner_id' => $data['user']['id'],
                'date' => time()
            ];
            $this->db->insert('folder_public', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Folder has been added !
                    </div>');
            redirect('file/publicfile');
        }
    }

    public function delete_folderpublic($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('folder_public');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Folder has been deleted !
                    </div>');
        redirect('file/publicfile');
    }

    public function edit_folderpublic($id)
    {
        is_folder();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;
        $data['folder'] = $this->db->get_where('folder_public', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('file/edit_folderpublic', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $name = $this->input->post('name');
            $this->db->set('title', $name);
            $this->db->where('id', $id);
            $this->db->update('folder_public');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Folder has been updated !
                    </div>');
            redirect('file/publicfile');
        }
    }

    public function fileaccess($folder_id)
    {
        is_folder();
        $data['title'] = 'Public File';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['folder'] = $this->db->get('folder_public')->result_array();
        $data['folder_id'] = $folder_id;
        $data['file'] = $this->db->get_where('file_public', ['folder_id' => $folder_id])->result_array();
        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('file/fileaccess', $data);
        $this->load->view('templete/footer', $data);
    }

    public function delete_filepublic($id)
    {
        $file = $this->db->get_where('file_public', [
            'id' => $id
        ])->row_array();
        $folder_id = $file['folder_id'];
        $this->db->where('id', $id);
        $this->db->delete('file_public');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Folder has been deleted !
                    </div>');
        redirect('file/fileaccess/' . $folder_id);
    }

    public function upload_file($folder_id)
    {
        $data['title'] = 'Public File';
        is_folder();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['folder_id'] = $folder_id;
        $data['file'] = $this->db->get_where('file_public', ['folder_id' => $folder_id]);
        $upload_file = $_FILES['file']['name'];
        if ($upload_file) {
            $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xlsx|xlt|ppt|pptx|rar';
            $config['max_size']     = '100048';
            $config['upload_path'] = './assets/file/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $data = [
            'folder_id' => $folder_id,
            'file' => $file,
            'owner_id' => $data['user']['id'],
            'date' => time()
        ];
        $this->db->insert('file_public', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            file hasbeen uploaded
            </div>');
        redirect('file/fileaccess/' . $folder_id);
    }

    public function privatefile()
    {
        $data['title'] = 'Private File';
        is_folder();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['folder'] = $this->db->get('folder_private')->result_array();
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword_privatefile', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword_privatefile');
        }
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'file/privatefile';
        $this->db->like('title', $data['keyword']);
        $this->db->from('folder_private');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 3;
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
            $data['folder'] = $this->db->get('folder_private', $config['per_page'], $from)->result_array();
        } else {
            $data['folder'] = $this->db->get('folder_private', $config['per_page'], $from)->result_array();
        }

        $this->load->view('templete/header', $data);
        $this->load->view('templete/sidebar', $data);
        $this->load->view('templete/navbar', $data);
        $this->load->view('file/fileprivate', $data);
        $this->load->view('templete/footer', $data);
    }

    public function validation($id)
    {
        $data['title'] = 'Private File';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['folder'] = $this->db->get('folder_private')->result_array();
        $data['folder_id'] = $id;
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('file/filevalidation', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $password = $this->input->post('password');
            $folder = $this->db->get_where('folder_private', ['id' => $id])->row_array();
            if ($folder) {
                if (password_verify($password, $folder['password'])) {
                    $folder = [
                        'folder_id' => $id
                    ];
                    $this->session->set_userdata($folder);
                    redirect('file/fileaccessprivate/' . $id);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                       Wrong Password!
                       </div>');
                    redirect('file/privatefile');
                }
            }
        }
    }

    public function addfolderpublic()
    {
        $data['title'] = 'Private File';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['folder'] = $this->db->get('folder_private')->result_array();
        $title = $this->input->post('title');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        if ($password1 != $password2) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                       Password and Repeat Password different !
                       </div>');
            redirect('file/privatefile');
        } else {
            $data = [
                'title' => $title,
                'owner_id' => $data['user']['id'],
                'date' => time(),
                'password' => password_hash($password1, PASSWORD_DEFAULT),
                'is_active' => 1
            ];
            $this->db->insert('folder_private', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                       Folder has been uploaded
                       </div>');
            redirect('file/privatefile');
        }
    }

    public function fileaccessprivate($id)
    {
        if ($id == $this->session->userdata('folder_id')) {
            $data['title'] = 'Private File';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            $data['folder'] = $this->db->get('folder_private')->result_array();
            $data['folder_id'] = $id;
            $data['file'] = $this->db->get_where('file_private', ['folder_id' => $id])->result_array();
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('file/fileaccessprivate', $data);
            $this->load->view('templete/footer', $data);
        } else {
            redirect('file/privatefile');
        }
    }

    public function delete_fileprivate($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('file_private');
    }

    public function upload_file_private($id)
    {
        $data['title'] = 'Public File';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['folder_id'] = $id;
        $data['file'] = $this->db->get_where('file_private', ['folder_id' => $id]);
        $upload_file = $_FILES['file']['name'];
        if ($upload_file) {
            $config['allowed_types'] = 'gif|jpg|png|docx|doc|pdf|xlsx|xlt|ppt|pptx|rar';
            $config['max_size']     = '100048';
            $config['upload_path'] = './assets/file/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $file = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $data = [
            'folder_id' => $id,
            'title' => $file,
            'owner_id' => $data['user']['id'],
            'date' => time()
        ];
        $this->db->insert('file_private', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            file hasbeen uploaded
            </div>');
        redirect('file/fileaccessprivate/' . $id);
    }
    public function quit()
    {
        $this->session->unset_userdata('folder_id');
        redirect('file/privatefile');
    }

    public function delete_folderprivate($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('folder_private');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Folder has been deleted !
                    </div>');
        redirect('file/privatefile');
    }

    public function edit_folderprivate($id)
    {
        is_folder();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;
        $data['folder'] = $this->db->get_where('folder_private', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('file/edit_folderprivate', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $name = $this->input->post('name');
            $this->db->set('title', $name);
            $this->db->where('id', $id);
            $this->db->update('folder_private');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Folder has been updated !
                    </div>');
            redirect('file/privatefile');
        }
    }

    public function change_password($id)
    {
        is_folder();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;
        $data['folder'] = $this->db->get_where('folder_private', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('file/change_password', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['folder']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong Current Password
            </div>');
                redirect('file/change_password/' . $id);
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                         New password cannot be the same as Current Password !
                        </div>');
                    redirect('file/change_password/' . $id);
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('id', $id);
                    $this->db->update('folder_private');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                         Password Has Been Updated
                        </div>');
                    redirect('file/privatefile');
                }
            }
        }
    }
}
