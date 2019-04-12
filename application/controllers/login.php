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

			if($this->session->userdata('level') == 1){ //admin
				redirect(base_url('dashboard'));
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
			} else if($this->session->userdata('level') == 7){ // Akademik
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
	            	$adServer = "10.10.0.10";
	
				    $ldap = ldap_connect($adServer);
				    $username = $_POST['username'];
				    $password = $_POST['password'];

				    $ldaprdn = $username.'@jic.ac.id';

				    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
				    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

				    $bind = @ldap_bind($ldap, $ldaprdn, $password);
				    if ($bind) {
				    	
				        $filter="(sAMAccountName=$username)";
				        $result = ldap_search($ldap,"dc=jic,dc=ac,dc=id",$filter);
				        $info = ldap_get_entries($ldap, $result);
				        foreach ($info as $sesd) {
			                $sess_data2['fullname'] = $sesd['cn'][0];
			                $sess_data2['username'] = $sesd['samaccountname'][0];
			                $userDn = $sesd['memberof'][0];
				            $ss = explode(",",$userDn);
 							$sess_data2['group'] = substr($ss[0],3);
			            }

			            if($sess_data2['group'] == 'IT' || $sess_data2['group'] == 'ITGroup' || $sess_data2['group'] == 'AdminStieGroup' || $sess_data2['group'] == 'AkademikStieGroup' || $sess_data2['username'] == 'zahroh.dhoffir' || $sess_data2['group'] == 'FinanceStieGroup' || $sess_data2['group'] == 'DosenStieGroup' || $sess_data2['group'] == 'MarketingStieGroup' || $sess_data2['group'] == 'MhsStieGroup'){

			            	if ($sess_data2['group'] == 'MhsStieGroup') {
			            		$cari_user = $this->db->from('tb_mahasiswa')->where('nim', $sess_data2['username'])->get()->row();

			            	} else if ($sess_data2['group'] == 'DosenStieGroup') {
			            		$cari_user = $this->db->from('tb_dosen')->like('email', $sess_data2['username'])->get()->row();
			            	} else {
			            		$cari_user = $sess_data2['username'];
			            	}

			            	if ($cari_user == NULL) {
			            		$this->session->set_flashdata('message', '<div class="alert alert-danger"><p>Anda Tidak Terdaftar Dalam Sistem </p></div>');
							redirect(base_url('login'));
			            	} else {


			            
			            $this->user_model->create_user($sess_data2['username'], $sess_data2['group'], $sess_data2['fullname']);

			        	}

			        } else {
			        		$this->session->set_flashdata('message', '<div class="alert alert-danger"><p>Anda Tidak Mendapatkan Akses </p></div>');
							redirect(base_url('login'));
			        	}

				        foreach ($info as $sess) {
				        	$kk = $sess['samaccountname'][0];
				        	$localusername = $this->db->from('tb_user')->where('username', $kk)->get()->row();
				        	$userDn = $sess['memberof'][0];
				            $ss = explode(",",$userDn);
				            
				            $sess_data['logged_in'] = TRUE;
				            $sess_data['fullname'] = $sess['cn'][0];
			                $sess_data['username'] = $sess['samaccountname'][0];
			                $sess_data['group'] = substr($ss[0],3);
			                $sess_data['email'] = $sess['mail'][0];
			                $sess_data['localusername'] = $localusername->username;
			                $sess_data['level'] = $localusername->id_level;
			            }

			            $this->session->set_userdata($sess_data);
				            @ldap_close($ldap);
				            redirect('dashboard');
			            
				    } else {
				        $this->session->set_flashdata('message', '<div class="alert alert-danger"><p>Username atau Password Salah</p></div>');
						redirect(base_url('login'));
				    }
	        } else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><p> Captcha Gagal</p></div>');
			redirect('login');
		}
		 if($this->user_model->masuk() == TRUE){
		 				redirect(base_url('dashboard'));
		 			} else {
		 				redirect(base_url('login'));
		 			}
	}

	public function logout(){
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->session->sess_destroy();
			redirect('login');
		} else {
			redirect('login'); 
		}
	}

	public function blank(){
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->session->sess_destroy();
			$this->load->view('blank_view');
		} else {
			redirect('login');
		}
	}
}