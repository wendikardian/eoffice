<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_folder();
    }

    public function menu()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $this->form_validation->set_rules('menu', 'Menu', 'required');
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('admin/menu', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $menu = $this->input->post('menu');
            $icon = $this->input->post('icon');
            $data = [
                'menu' => $menu,
                'icon' => $icon
            ];
            $this->db->insert('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New menu has been added !
                    </div>');
            redirect('menu/menu');
        }
    }

    public function delete_menu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                     menu has been deleted !
                    </div>');
        redirect('menu/menu');
    }

    public function edit_menu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;
        $data['menu'] = $this->db->get_where('user_menu', [
            'id' => $id
        ])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('admin/edit_menu', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $name = $this->input->post('name');
            $icon = $this->input->post('icon');
            $this->db->set('menu', $name);
            $this->db->set('icon', $icon);
            $this->db->where('id', $id);
            $this->db->update('user_menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                     menu has been updated !
                    </div>');
            redirect('menu/menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Sub Menu Management';
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('admin/submenu', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'is_active' => $this->input->post('is_active'),
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    New Submenu has been added !
                    </div>');
            redirect('menu/submenu');
        }
    }
    public function delete_submenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Submenu has been deleted !
                    </div>');
        redirect('menu/submenu');
    }

    public function edit_submenu($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;
        $data['submenu'] = $this->db->get_where('user_sub_menu', [
            'id' => $id
        ])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templete/header', $data);
            $this->load->view('templete/sidebar', $data);
            $this->load->view('templete/navbar', $data);
            $this->load->view('admin/edit_submenu', $data);
            $this->load->view('templete/footer', $data);
        } else {
            $name = $this->input->post('name');
            $url = $this->input->post('url');
            $menu = $this->input->post('menu');
            $is_active = $this->input->post('is_active');
            $this->db->set('title', $name);
            $this->db->set('url', $url);
            $this->db->set('menu_id', $menu);
            $this->db->set('is_active', $is_active);
            $this->db->where('id', $id);
            $this->db->update('user_sub_menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Submenu has been updated !
                    </div>');
            redirect('menu/submenu');
        }
    }
}
