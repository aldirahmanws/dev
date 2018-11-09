<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dosen_model');
		$this->load->model('nilai_perkuliahan_model');
		$this->load->model('user_model');
		ini_set('display_errors', 0);
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
		$data['main_view'] = 'Dosen/master_dosen_view';
		$data['dosen'] = $this->dosen_model->data_dosen();
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function page_tambah_dosen(){
		if ($this->session->userdata('logged_in') == TRUE) {
		$data['kodedosen'] = $this->dosen_model->buat_kode_dosen();
		$data['main_view'] = 'Dosen/tambah_dosen_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function page_edit_dosen(){
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['main_view'] = 'Dosen/edit_dosen_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function detail_dosen(){
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['main_view'] = 'Dosen/detail_dosen_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function save_dosen()
	{
			if($this->dosen_model->save_dosen() == TRUE){
				$pass = $this->random_password();
				$nim = $this->input->post('id_dosen');
				$this->user_model->signup_dosen($nim, $pass);
				$this->load->library('email');
						$config = array(
							'protocol' => 'smtp',
							'smtp_host' 	=> 'ssl://smtp.googlemail.com',
							'smtp_port' 	=> 465,
							'smtp_user' 	=> 'bayukrisnaovo@gmail.com',
							'smtp_pass' 	=> 'pacnut12',
							'mailtype'		=> 'html',
							'wordwrap'	=> TRUE
						);
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from('bayukrisnaovo@gmail.com','Panitia PSB');
						$this->email->to($this->input->post('email'));
						$this->email->subject('STIE Jakarta International College');
						$this->email->message('
							<h2> Akun Login Dosen!</h2>
							<br> Username : '.$nim.'
							<br> Password : '.$pass.' <br><br>
							Terimakasih');
						
						if($this->email->send()){
								$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data dosen berhasil ditambah </div>');
				            	redirect('master_dosen');
						}
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Data '.$nama_dosen.' gagal ditambahkan. </div>');
            	redirect('master_dosen/page_tambah_dosen');
			} 
	} 

	function random_password() 
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array(); 
        $alpha_length = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) 
        {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }
        return implode($password); 
    }

	public function edit_dosen()
	{
		$id_dosen = $this->uri->segment(3);
			if($this->dosen_model->edit_dosen($id_dosen) == TRUE  && $this->dosen_model->edit_username($id_dosen) == TRUE){
				if ($this->session->userdata('level') == 2) {
					$dosen = $this->input->post('id_dosen');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Data  berhasil diubah </div>');
            	redirect('master_dosen/detail_dosen/'.$id_dosen);
				} else {
					$dosen = $this->input->post('id_dosen');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Data  berhasil diubah </div>');
            	redirect('master_dosen');
				}
				
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Data '.$nama_dosen.' gagal ditambahkan. </div>');
            	redirect('master_dosen/edit_tambah_dosen/'.$id_dosen);
			} 
	} 

	public function jadwal_dosen(){
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['senin'] = $this->dosen_model->jadwal_dosen_senin($id_dosen);
		$data['selasa'] = $this->dosen_model->jadwal_dosen_selasa($id_dosen);
		$data['rabu'] = $this->dosen_model->jadwal_dosen_rabu($id_dosen);
		$data['kamis'] = $this->dosen_model->jadwal_dosen_kamis($id_dosen);
		$data['jumat'] = $this->dosen_model->jadwal_dosen_jumat($id_dosen);
		$data['main_view'] = 'Dosen/jadwal_dosen_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}

	}

	public function hapus_dosen()
	{
		$id_dosen = $this->uri->segment(3);
			if($this->dosen_model->hapus_dosen($id_dosen) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Dosen Berhasil </div>');
            	redirect('master_dosen');
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Hapus Dosen Gagal </div>');
            	redirect('master_dosen');
			} 
	} 

	public function nilai_dosen()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['nilai'] = $this->dosen_model->data_kp($id_dosen);
		$data['main_view'] = 'Dosen/nilai_dosen_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	} 

	public function aktivitas_mengajar(){
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['am'] = $this->dosen_model->aktivitas_mengajar($id_dosen);
		$data['main_view'] = 'Dosen/aktivitas_mengajar_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function jabatan_fungsional(){
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['jabatan'] = $this->dosen_model->jabatan_fungsional($id_dosen);
		$data['main_view'] = 'Dosen/jabatan_fungsional_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function tambah_jabatan_fungsional()
	{
		$id_dosen = $this->uri->segment(3);
			if($this->dosen_model->tambah_jabatan_fungsional($id_dosen) == TRUE){
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Tambah jabatan fungsional berhasil </div>');
            	redirect('master_dosen/jabatan_fungsional/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Tambah jabatan fungsional gagal </div>');
            	rredirect('master_dosen/jabatan_fungsional/'.$id_dosen);
			} 
	} 

	public function hapus_jabatan_fungsional()
	{
		$id_dosen = $this->uri->segment(4);
		$id_jabatan_fungsional = $this->uri->segment(3);
			if($this->dosen_model->hapus_jabatan_fungsional($id_jabatan_fungsional) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Jabatan Berhasil </div>');
            	redirect('master_dosen/jabatan_fungsional/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Hapus Jabatan Gagal </div>');
            	redirect('master_dosen/jabatan_fungsional/'.$id_dosen);
			} 
	} 

	public function pendidikan(){
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['pendidikan'] = $this->dosen_model->pendidikan($id_dosen);
		$data['main_view'] = 'Dosen/pendidikan_dosen_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function tambah_pendidikan()
	{
		$id_dosen = $this->uri->segment(3);
			if($this->dosen_model->tambah_pendidikan($id_dosen) == TRUE){
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Tambah pendidikan berhasil </div>');
            	redirect('master_dosen/pendidikan/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Tambah pendidikan fungsional gagal </div>');
            	rredirect('master_dosen/pendidikan/'.$id_dosen);
			} 
	} 

	public function hapus_pendidikan()
	{
		$id_dosen = $this->uri->segment(4);
		$id_pd = $this->uri->segment(3);
			if($this->dosen_model->hapus_pendidikan($id_pd) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Pendidikan Berhasil </div>');
            	redirect('master_dosen/pendidikan/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Hapus Pendidikan Gagal </div>');
            	redirect('master_dosen/pendidikan/'.$id_dosen);
			} 
	} 

	public function pelatihan(){
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['pelatihan'] = $this->dosen_model->pelatihan($id_dosen);
		$data['main_view'] = 'Dosen/pelatihan_dosen_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function tambah_pelatihan()
	{
		$id_dosen = $this->uri->segment(3);
			if($this->dosen_model->tambah_pelatihan($id_dosen) == TRUE){
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Tambah pelatihan berhasil </div>');
            	redirect('master_dosen/pelatihan/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Tambah pelatihan fungsional gagal </div>');
            	rredirect('master_dosen/pelatihan/'.$id_dosen);
			} 
	} 

	public function hapus_pelatihan()
	{
		$id_dosen = $this->uri->segment(4);
		$id_pelatihan = $this->uri->segment(3);
			if($this->dosen_model->hapus_pelatihan($id_pelatihan) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Pelatihan Berhasil </div>');
            	redirect('master_dosen/pelatihan/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Hapus Pelatihan Gagal </div>');
            	redirect('master_dosen/pelatihan/'.$id_dosen);
			} 
	}

	public function sertifikasi(){
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['sertifikasi'] = $this->dosen_model->sertifikasi($id_dosen);
		$data['main_view'] = 'Dosen/sertifikasi_dosen_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function tambah_sertifikasi()
	{
		$id_dosen = $this->uri->segment(3);
			if($this->dosen_model->tambah_sertifikasi($id_dosen) == TRUE){
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Tambah sertifikasi berhasil </div>');
            	redirect('master_dosen/sertifikasi/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Tambah sertifikasi gagal </div>');
            	rredirect('master_dosen/sertifikasi/'.$id_dosen);
			} 
	} 

	public function hapus_sertifikasi()
	{
		$id_dosen = $this->uri->segment(4);
		$id_sertifikasi = $this->uri->segment(3);
			if($this->dosen_model->hapus_sertifikasi($id_sertifikasi) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Sertifikasi Berhasil </div>');
            	redirect('master_dosen/sertifikasi/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Hapus Sertifikasi Gagal </div>');
            	redirect('master_dosen/sertifikasi/'.$id_dosen);
			} 
	}

	public function penelitian(){
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['penelitian'] = $this->dosen_model->penelitian($id_dosen);
		$data['main_view'] = 'Dosen/penelitian_dosen_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function tambah_penelitian()
	{
		$id_dosen = $this->uri->segment(3);
			if($this->dosen_model->tambah_penelitian($id_dosen) == TRUE){
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Tambah penelitian berhasil </div>');
            	redirect('master_dosen/penelitian/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Tambah penelitian gagal </div>');
            	rredirect('master_dosen/penelitian/'.$id_dosen);
			} 
	} 

	public function hapus_penelitian()
	{
		$id_dosen = $this->uri->segment(4);
		$id_penelitian = $this->uri->segment(3);
			if($this->dosen_model->hapus_penelitian($id_penelitian) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Penelitian Berhasil </div>');
            	redirect('master_dosen/penelitian/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Hapus Penelitian Gagal </div>');
            	redirect('master_dosen/penelitian/'.$id_dosen);
			} 
	}


}

/* End of file master_dosen.php */
/* Location: ./application/controllers/master_dosen.php */