<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		ini_set('display_errors', 0);
	}

	public function index()
	{

			if($this->session->userdata('level') == 1){ //mahasiswa
				redirect(base_url('admin'));
			} else if($this->session->userdata('level') == 2){ // Dosen
				redirect(base_url('dashboard'));
			} else if($this->session->userdata('level') == 3){ // Marketing
				redirect(base_url('dashboard'));
			} else if($this->session->userdata('level') == 4){ // Finance
				redirect(base_url('dashboard'));
			} else if($this->session->userdata('level') == 5){ // Mahasiswa
				redirect(base_url('dashboard'));
			} else if($this->session->userdata('level') == 6){ // Akademik
				redirect(base_url('dashboard'));
			} else {
				$data['site_key'] = '6LcMU20UAAAAACiZUAOaCfw0YDu2rHirY7Z0DjNT';
				$this->load->view('login_view', $data);
			}
			
	}

	public function login()
	{
		$site_key = '6LdJNXEUAAAAAFTF9Mli1NghDiiTI9doXUlREvh3'; // Diisi dengan site_key API Google reCapthca yang sobat miliki
	    $secret_key = '6LdJNXEUAAAAALJchW37uZx4LTzI4ap9ah7i2_kr'; // Diisi dengan secret_key API Google reCapthca yang sobat miliki
	 
	    $api_url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response='.$_POST['g-recaptcha-response'];
	    $response = @file_get_contents($api_url);
	    $data = json_decode($response, true);
	 
	        if($data['success'])
	            {
	                if($this->user_model->masuk() == TRUE){
						redirect(base_url('dashboard'));
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"><p> Password Salah</p></div>');
						redirect(base_url('login'));
					}
	        } else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><p> Captcha Gagal</p></div>');
			redirect('login');
		}
		// if($this->user_model->masuk() == TRUE){
		// 				redirect(base_url('dashboard'));
		// 			} else {
		// 				redirect(base_url('login'));
		// 			}
	}

	public function logout(){
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->session->sess_destroy();
			redirect('login');
		} else {
			redirect('login'); 
		}
	}
}