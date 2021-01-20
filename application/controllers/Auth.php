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

	public function forgotpassword()
	{
		if ($this->session->userdata('email')) {
			redirect('profile/profile');
		}
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/forgotpassword');
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();
			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Please check your email to reset your password
            </div>');
				redirect('auth/forgotpassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Your email is invalid (Not Registered in our system !) or Not activated
            </div>');
				redirect('auth/forgotpassword');
			}
		}
	}

	public function resetpassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset Password Failed ! wrong token
            </div>');
				redirect('auth/forgotpassword');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Reset Password Failed ! wrong email
            </div>');
			redirect('auth/forgotpassword');
		}
	}

	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('auth');
		}
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/change_password');
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');
			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('user');
			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Password Has Been Changed ! please login.
            </div>');
			redirect('auth/login');
		}
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
			if ($user['is_active'] == 1) {
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

			//siapkan token
			$token = base64_encode(random_bytes(32));
			// var_dump($token);
			// die;
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];


			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);
			// $this->_sendEmail($token, 'verify');
			$this->session->set_flashdata('message', '<center><div class="alert alert-success" role="alert">
            Registrastion has succesfull. please Activate Your Account 
            </div></center>');
			redirect('auth/login');
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'wendieoffice@gmail.com',
			'smtp_pass' => 'citivang21',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];
		$this->email->initialize($config);
		$this->load->library('email', $config);
		$this->email->from('wendieoffice@gmail.com', 'wendi eoffice');
		$this->email->to($this->input->post('email'));
		if ($type == 'verify') {
			$this->email->subject('Account Verification');
			$this->email->message('Click this link to verify your account : 
            <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Activate</a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : 
            <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Reset Password</a>');
		}
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 48)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           ' . $email . ' Has been activated ! please login .
            </div>');
					redirect('auth/login');
				} else {
					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Token Has Been Expired !
            </div>');
					redirect('auth/login');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Token Invalid
            </div>');
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account Activation Failed ! Wrong Email !
            </div>');
			redirect('auth/login');
		}
	}

	public function blocked()
	{
		$data['title'] = 'Error';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templete/header', $data);
		$this->load->view('templete/sidebar', $data);
		$this->load->view('templete/navbar', $data);
		$this->load->view('auth/error', $data);
		$this->load->view('templete/footer', $data);
	}
}
