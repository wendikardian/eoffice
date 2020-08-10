<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('ciqrcode');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('profile/profile');
		}

		$this->load->view('home/dashboard');
	}

	public function login()
	{
		if ($this->session->userdata('email')) {
			redirect('profile/profile');
		}
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/login');
		} else {
			$this->_login();
		}
	}

	public function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			if ($user['is_active'] == 0) {
				if (password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if ($user['role_id'] == 1) {
						redirect('dashboard');
					} else if ($user['role_id'] == 2) {
						redirect('dashboard');
					} else if ($user['role_id'] == 3) {
						redirect('profile/profile');
					} else {
						redirect('profile/profile');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                       Wrong Password!
                       </div>');
					redirect('auth/login');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Email has not been activated !
                    </div>');
				redirect('auth/login');
			}
		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                   Login Failed !
                    </div>');
			redirect('auth/login');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->unset_userdata('folder_id');
		$this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            You Have Been Log out
            </div>');
		redirect('auth');
	}

	public function registration()
	{
		if ($this->session->userdata('email')) {
			redirect('profile/profile');
		}
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'this email has already registered'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
			'matches' => ' password dont match !',
			'min_length' => ' password too short !'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/registration');
		} else {
			$email = $this->input->post('email', true);
			$name = $this->input->post('name');
			$password1 = $this->input->post('password1');
			$password2 = $this->input->post('password2');
			$config['cacheable']    = true; //boolean, the default is true
			$config['cachedir']     = './assets/'; //string, the default is application/cache/
			$config['errorlog']     = './assets/'; //string, the default is application/logs/
			$config['imagedir']     = './assets/img/qrcode/'; //direktori penyimpanan qr code
			$config['quality']      = true; //boolean, the default is true
			$config['size']         = '1024'; //interger, the default is 1024
			$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
			$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name = $email . '.png'; //buat name dari qr code sesuai dengan nim
			$params['data'] = $email; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
			$data = [
				'name' => htmlspecialchars($name, true),
				'np' => '0',
				'email' => htmlspecialchars($email, true),
				'image' => 'default.jpg',
				'password' => password_hash($password1, PASSWORD_DEFAULT),
				'role_id' => 3,
				'is_active' => 0,
				'date_created' => time(),
				'telp' => '+62',
				'qrcode' => $image_name
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert">
            Registrastion has succesfull. please Activate Your Account 
            </div></center>');
			redirect('auth/login');
		}
	}
}
