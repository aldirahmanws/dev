<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mahasiswa_model');
		$this->load->model('daftar_ulang_model');
		$this->load->model('konsentrasi_model');
		$this->load->model('kurikulum_model');
		$this->load->model('user_model');
		$this->load->model('kelas_perkuliahan_model');
	}
	public function index()
	{		
		if ($this->session->userdata('logged_in') == TRUE) {
		
			if($this->session->userdata('level') == 5){
				$id_mahasiswa = $this->session->userdata('id_mahasiswa');
				$data['id_mahasiswa'] = $this->session->userdata('id_mahasiswa');
				$data['id_mahasiswa'] = $this->session->userdata('id_mahasiswa');
				$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
				$data['main_view'] = 'Mahasiswa/lihat_mahasiswa_dikti_view';
				$this->load->view('template', $data);	
			} else {
				redirect(base_url('login'));
			}
		} else {
			redirect('login');
		}
			
	}
	public function mahasiswa_data()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			
			$data['mahasiswa'] = $this->mahasiswa_model->data_mahasiswa();
			$data['main_view'] = 'Mahasiswa/data_mahasiswa_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}
	

	public function detail_mahasiswa()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_du = $this->uri->segment(3);
			$data['du'] = $this->daftar_ulang_model->detail_du($id_du);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$data['main_view'] = 'Mahasiswa/detail_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}


	public function data_mahasiswa()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['mahasiswa'] = $this->mahasiswa_model->data_mahasiswa_dikti();
			$data['drop_down_prodi'] = $this->konsentrasi_model->get_prodi();
			$data['main_view'] = 'Mahasiswa/mahasiswa_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}
	

	public function filter_mahasiswa()
	{
			$data['drop_down_prodi'] = $this->konsentrasi_model->get_prodi();
			$id_prodi=$this->input->get('id_prodi');
			$id_agama=$this->input->get('id_agama');
			$id_kelamin=$this->input->get('id_kelamin');
			$angkatan=$this->input->get('angkatan');
			$data['mahasiswa'] = $this->mahasiswa_model->filter_mahasiswa($id_prodi,$id_agama,$id_kelamin,$angkatan);
			$data['main_view'] = 'Mahasiswa/mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function filter_nilai(){
			$id_mahasiswa = $this->uri->segment(3);
			$id_periode=$this->input->get('id_periode');
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['nilai'] = $this->mahasiswa_model->filter_nilai($id_mahasiswa,$id_periode);
			$data['nilai2'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/history_ips_view';
			$this->load->view('template', $data);
	}
	public function filter_nilai_ak(){
			$id_mahasiswa = $this->input->get('id_mahasiswa');
			$id_periode=$this->input->get('id_periode');
    		$this->mahasiswa_model->filter_nilai_ak($id_mahasiswa, $id_periode);
  	
	}
	public function get_prodi_periode($param = NULL) {
		$prodi = $param;
		$result = $this->kurikulum_model->get_prodi_periode2($prodi);
		$option = "";
		$option .= '<option value="uygydg">Pilih Periode</option>';
		foreach ($result as $data) {
			$option = 
			$option .= "<option value='".$data->semester."'>".$data->semester."</option>";
			
		}
		echo $option;
	}

	public function detail_mahasiswa_dikti()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_mahasiswa = $this->uri->segment(3);
			$data['getStatus'] = $this->mahasiswa_model->getStatus();
			$data['getGrade'] = $this->mahasiswa_model->getGrade();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getConcentrate'] = $this->daftar_ulang_model->getProdi();
			$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/detail_mahasiswa_dikti_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}
	public function krs_mahasiswa()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_prodi = $session->id_prodi;
				$semester_aktif = $session->semester_aktif;
				$id_mahasiswa = $session->id_mahasiswa;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$id_prodi = $this->uri->segment(4);
				$semester_aktif = $this->uri->segment(5);
			}
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['krs'] = $this->mahasiswa_model->data_krs_mhs($id_mahasiswa, $semester_aktif, $id_prodi);
			//$data['periode2'] = $this->mahasiswa_model->getPer($id_prodi);
			$data['periode'] = $this->mahasiswa_model->Periode_krs($id_prodi);
			$data['main_view'] = 'Mahasiswa/krs_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function jadwal_mhs()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_prodi = $session->id_prodi;
				$semester_aktif = $session->semester_aktif;
				$id_mahasiswa = $session->id_mahasiswa;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$id_prodi = $this->uri->segment(4);
				$semester_aktif = $this->uri->segment(5);
			}
			$data['periode'] = $this->mahasiswa_model->Periode_krs($id_prodi);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa, $semester_aktif);
			$data['senin'] = $this->mahasiswa_model->jadwal_mhs_senin($id_mahasiswa, $semester_aktif);
			$data['selasa'] = $this->mahasiswa_model->jadwal_mhs_selasa($id_mahasiswa, $semester_aktif);
			$data['rabu'] = $this->mahasiswa_model->jadwal_mhs_rabu($id_mahasiswa, $semester_aktif);
			$data['kamis'] = $this->mahasiswa_model->jadwal_mhs_kamis($id_mahasiswa, $semester_aktif);
			$data['jumat'] = $this->mahasiswa_model->jadwal_mhs_jumat($id_mahasiswa, $semester_aktif);
			$data['main_view'] = 'Mahasiswa/jadwal_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function kelas_mhs()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_mahasiswa = $session->id_mahasiswa;
				$id_prodi = $session->id_prodi;
				$semester_aktif = $session->semester_aktif;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$semester_aktif = $this->uri->segment(5);
				$id_prodi = $this->uri->segment(4);
			}
			$data['periode'] = $this->mahasiswa_model->Periode_krs($id_prodi);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa, $semester_aktif);
			$data['kelas'] = $this->mahasiswa_model->kelas_mhs($id_mahasiswa, $semester_aktif);
			$data['main_view'] = 'Mahasiswa/kelas_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function history_nilai()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_mahasiswa = $session->id_mahasiswa;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
			}
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['nilai'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['nilai2'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/history_nilai_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function aktivitas_perkuliahan()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_mahasiswa = $session->id_mahasiswa;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
			}
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['aktivitas'] = $this->mahasiswa_model->data_ap($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/aktivitas_perkuliahan_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function transkip_nilai()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_mahasiswa = $this->uri->segment(3);
			$ipk = $this->uri->segment(4);
			$id_grade = $this->uri->segment(5);
			if($this->mahasiswa_model->update_ipk($id_mahasiswa, $ipk) == TRUE && $this->mahasiswa_model->update_grade($id_mahasiswa, $id_grade) ){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Update IPK Berhasil </div>');
            	redirect('mahasiswa/transkip_nilai2/'.$id_mahasiswa);
			} 	
		} else {
			redirect('login');
		}
	}

	public function transkip_nilai2()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_mahasiswa = $this->uri->segment(3);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['nilai2'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/transkip_nilai_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}
	

	public function lihat_mahasiswa_dikti()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_mahasiswa = $this->uri->segment(3);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/lihat_mahasiswa_dikti_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function page_tambah_mahasiswa()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['kodeunik_mhs'] = $this->mahasiswa_model->buat_kode_mhs();
			$data['getStatus'] = $this->mahasiswa_model->getStatus();
			$data['getGrade'] = $this->mahasiswa_model->getGrade();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Mahasiswa/tambah_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function history_pendidikan()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_mahasiswa = $session->id_mahasiswa;
				$history = $id_mahasiswa;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$nik = $this->uri->segment(4);
			}
			$data['kodeunik_mhs'] = $this->mahasiswa_model->buat_kode_mhs();
			$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
			$data['history'] = $this->mahasiswa_model->history_pendidikan($nik);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Mahasiswa/history_pendidikan_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function transfer_nilai()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_mahasiswa = $session->id_mahasiswa;
				$history = $id_mahasiswa;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
			}
			$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
			$data['transfer'] = $this->mahasiswa_model->data_transfer_nilai($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/transfer_nilai_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function simpan_pendidikan()
	{
		$id_mahasiswa = $this->uri->segment(3);
		$nim_lama = $this->input->post('nim_lama');
		if ($this->input->post('id_jenis_pendaftaran') == 2) {
			if($this->mahasiswa_model->save_mahasiswa_pindahan() == TRUE && $this->mahasiswa_model->save_ayah() == TRUE  && $this->mahasiswa_model->save_ibu() == TRUE && $this->mahasiswa_model->save_alamat() == TRUE && $this->mahasiswa_model->save_wali() == TRUE && $this->mahasiswa_model->save_kependudukan() == TRUE && $this->mahasiswa_model->save_bio() == TRUE && $this->mahasiswa_model->save_kontak() == TRUE && $this->mahasiswa_model->simpan_pendidikan_pindahan() == TRUE && $this->mahasiswa_model->ubah_status_mhs_pindahan($id_mahasiswa) == TRUE && $this->mahasiswa_model->hapus_user_mhs_pindahan($nim_lama) == TRUE){
				$nim = $this->input->post('nim');
				$pass = $this->random_password();
				$this->user_model->signup_mahasiswa($nim, $pass);
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
							<h2> Akun Login Mahasiswa!</h2>
							<br> Username : '.$nim.'
							<br> Password : '.$pass.' <br><br>
							Terimakasih');
						
						if($this->email->send()){
								$nama_du = $this->input->post('nama_mahasiswa');
								$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_du.' berhasil didaftarkan. </div>');
				            	redirect('mahasiswa/data_mahasiswa');
						}

				
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Data  '.$nama_du.' Sudah Ada </div>');
            	redirect('mahasiswa/data_mahasiswa');
			} 
		} else {
			if ($this->mahasiswa_model->simpan_pendidikan($id_mahasiswa) == TRUE) {
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah History Pendidikan Berhasil </div>');
            	redirect('mahasiswa/history_pendidikan/'.$id_mahasiswa);
			}
		}
			
	}

	public function simpan_krs_mhs()
	{
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$id_prodi = $this->uri->segment(3);
		$semester_aktif = $this->uri->segment(4);
		$id_periode = $this->uri->segment(5);
			if($this->mahasiswa_model->simpan_krs_mhs() == TRUE && $this->mahasiswa_model->update_status($id_mahasiswa) == TRUE && $this->kelas_perkuliahan_model->update_status_aktivitas($id_mahasiswa, $id_periode) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Anda berhasil menambahkan KRS untuk semester ini </div>');
            	redirect('mahasiswa/kelas_mhs/'.$id_mahasiswa.'/'.$id_prodi.'/'.$semester_aktif);
			} 
	}

	public function simpan_krs_mengulang()
	{
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$id_prodi = $this->uri->segment(3);
		$semester_aktif = $this->uri->segment(4);
			if($this->mahasiswa_model->simpan_krs_mengulang() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Mata kuliah mengulang berhasil ditambahkan </div>');
            	redirect('mahasiswa/kelas_mhs/'.$id_mahasiswa.'/'.$id_prodi.'/'.$semester_aktif);
			} 
	}

	public function prestasi()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_mahasiswa = $session->id_mahasiswa;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
			}
			$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
			$data['prestasi'] = $this->mahasiswa_model->prestasi($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/prestasi_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function detail_prestasi()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_prestasi = $this->uri->segment(3);
			$data['prestasi'] = $this->mahasiswa_model->detail_prestasi($id_prestasi);
			$data['main_view'] = 'Mahasiswa/edit_prestasi_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function simpan_prestasi()
	{
		$id_mahasiswa = $this->uri->segment(3);
			if($this->mahasiswa_model->simpan_prestasi($id_mahasiswa) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah Prestasi Berhasil </div>');
            	redirect('mahasiswa/prestasi/'.$id_mahasiswa);
			} 
	}

	public function edit_prestasi()
	{
		$id_prestasi = $this->uri->segment(3);
		$id_mahasiswa = $this->input->post('id_mahasiswa');
			if($this->mahasiswa_model->edit_prestasi($id_prestasi) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Edit Prestasi Berhasil </div>');
            	redirect('mahasiswa/prestasi/'.$id_mahasiswa);
			} 
	}

	public function save_edit_mahasiswa()
	{
		 $id_mahasiswa = $this->uri->segment(3);
			if($this->mahasiswa_model->save_edit_mahasiswa($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_ayah($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_ibu($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_alamat($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_wali($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_kependudukan($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_bio($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_kontak($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_mhs_add($id_mahasiswa) == TRUE){
				$nama_du = $this->input->post('nama_mahasiswa');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_du.' berhasil diedit </div>');
            	redirect('mahasiswa/data_mahasiswa');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Gagal </div>');
            	redirect('mahasiswa/data_mahasiswa');
			} 
	} 

	public function save_mahasiswa()
	{
			if($this->mahasiswa_model->save_mahasiswa() == TRUE && $this->mahasiswa_model->save_ayah() == TRUE  && $this->mahasiswa_model->save_ibu() == TRUE && $this->mahasiswa_model->save_alamat() == TRUE && $this->mahasiswa_model->save_wali() == TRUE && $this->mahasiswa_model->save_kependudukan() == TRUE && $this->mahasiswa_model->save_bio() == TRUE && $this->mahasiswa_model->save_kontak() == TRUE && $this->mahasiswa_model->save_pendidikan() == TRUE){
				$pass = $this->random_password();
				$nim = $this->input->post('nim');
				$this->user_model->signup_mahasiswa($nim, $pass);
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
							<h2> Akun Login Mahasiswa!</h2>
							<br> Username : '.$nim.'
							<br> Password : '.$pass.' <br><br>
							Terimakasih');
						
						if($this->email->send()){
								$nama_du = $this->input->post('nama_mahasiswa');
								$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_du.' berhasil didaftarkan. </div>');
				            	redirect('mahasiswa/data_mahasiswa');
						}

				
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Data  '.$nama_pendaftar.' Sudah Ada </div>');
            	redirect('mahasiswa/data_mahasiswa');
			} 
	} 

	public function save_edit_foto_mahasiswa(){
	    $config['upload_path'] = './uploads/';
	    $config['allowed_types'] = 'jpg|png|jpeg';
	    $this->load->library('upload', $config);
	    if($this->upload->do_upload('foto_mahasiswa')){
	      if($this->mahasiswa_model->save_edit_foto_mahasiswa($this->upload->data(), $this->uri->segment(3)) == TRUE){
	        $this->session->set_flashdata('message', 'Upload Foto Berhasil');
	            redirect('mahasiswa/detail_mahasiswa_dikti/'.$this->uri->segment(3));
	      } else {
	        $this->session->set_flashdata('message', 'Update foto gagal');
	            redirect('mahasiswa/detail_mahasiswa_dikti/'.$this->uri->segment(3));
	      }
	    } else {
	      $this->session->set_flashdata('message', $this->upload->display_errors());
	        redirect('mahasiswa/detail_mahasiswa_dikti/'.$this->uri->segment(3));
	    }
        
	}

	public function data_ld(){
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['ld'] = $this->mahasiswa_model->data_ld();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'LD/lulus_do_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function get_autocomplete_ipk(){
		if(isset($_GET['term'])){
			$result = $this->mahasiswa_model->autocomplete_ipk($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->nim.' - '.$row->nama_mahasiswa,
						'id' => $row->id_mahasiswa,
						'nama' => $row->nama_mahasiswa,
						'ipk' => $row->ipk,
						'prodi' => $row->id_prodi);
				echo json_encode($result_array);
			
			}
		}
	}

	public function simpan_ld()
	{
		$id_mahasiswa = $this->input->post('id_mahasiswa');
			if($this->mahasiswa_model->simpan_ld() == TRUE  && $this->mahasiswa_model->update_status_ld($id_mahasiswa) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah Mahasiswa Berhasil </div>');
            	redirect('mahasiswa/data_ld');
			} 
	}

	public function edit_ld()
	{
		$id_mahasiswa = $this->input->post('id_mahasiswa');
			if($this->mahasiswa_model->edit_ld($id_mahasiswa) == TRUE  && $this->mahasiswa_model->edit_status_ld($id_mahasiswa) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah Mahasiswa Berhasil </div>');
            	redirect('mahasiswa/data_ld');
			} 
	}

	public function filter_ld()
	{
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$id_prodi=$this->input->get('id_prodi');
			$id_status=$this->input->get('id_status');
			$angkatan=$this->input->get('angkatan');
			$data['ld'] = $this->mahasiswa_model->filter_ld($id_prodi,$id_status,$angkatan);
			$data['main_view'] = 'Ld/lulus_do_view';
			$this->load->view('template', $data);
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

    public function riwayat_pembayaran()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_prodi = $session->id_prodi;
				$semester_aktif = $session->semester_aktif;
				$id_mahasiswa = $session->id_mahasiswa;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$id_prodi = $this->uri->segment(4);
			}
			$data['periode'] = $this->mahasiswa_model->Periode_krs($id_prodi);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['riwayat'] = $this->mahasiswa_model->data_riwayat_pembayaran($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/riwayat_pembayaran_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function checklist_pembayaran()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_prodi = $session->id_prodi;
				$id_mahasiswa = $session->id_mahasiswa;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$id_prodi = $this->uri->segment(4);
			}
			$data['periode'] = $this->mahasiswa_model->Periode_krs($id_prodi);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['a11'] = $this->mahasiswa_model->checklist_11($id_mahasiswa);
			$data['a12'] = $this->mahasiswa_model->checklist_12($id_mahasiswa);
			$data['a13'] = $this->mahasiswa_model->checklist_13($id_mahasiswa);
			$data['a14'] = $this->mahasiswa_model->checklist_14($id_mahasiswa);
			$data['a15'] = $this->mahasiswa_model->checklist_15($id_mahasiswa);
			$data['a16'] = $this->mahasiswa_model->checklist_16($id_mahasiswa);
			$data['a17'] = $this->mahasiswa_model->checklist_17($id_mahasiswa);
			$data['a18'] = $this->mahasiswa_model->checklist_18($id_mahasiswa);
			$data['a19'] = $this->mahasiswa_model->checklist_19($id_mahasiswa);
			$data['a21'] = $this->mahasiswa_model->checklist_21($id_mahasiswa);
			$data['a22'] = $this->mahasiswa_model->checklist_22($id_mahasiswa);
			$data['a23'] = $this->mahasiswa_model->checklist_23($id_mahasiswa);
			$data['a24'] = $this->mahasiswa_model->checklist_24($id_mahasiswa);
			$data['a25'] = $this->mahasiswa_model->checklist_25($id_mahasiswa);
			$data['a26'] = $this->mahasiswa_model->checklist_26($id_mahasiswa);
			$data['a27'] = $this->mahasiswa_model->checklist_27($id_mahasiswa);
			$data['a28'] = $this->mahasiswa_model->checklist_28($id_mahasiswa);
			$data['a29'] = $this->mahasiswa_model->checklist_29($id_mahasiswa);
			$data['a31'] = $this->mahasiswa_model->checklist_31($id_mahasiswa);
			$data['a32'] = $this->mahasiswa_model->checklist_32($id_mahasiswa);
			$data['a33'] = $this->mahasiswa_model->checklist_33($id_mahasiswa);
			$data['a34'] = $this->mahasiswa_model->checklist_34($id_mahasiswa);
			$data['a35'] = $this->mahasiswa_model->checklist_35($id_mahasiswa);
			$data['a36'] = $this->mahasiswa_model->checklist_36($id_mahasiswa);
			$data['a37'] = $this->mahasiswa_model->checklist_37($id_mahasiswa);
			$data['a38'] = $this->mahasiswa_model->checklist_38($id_mahasiswa);
			$data['a39'] = $this->mahasiswa_model->checklist_39($id_mahasiswa);
			$data['a41'] = $this->mahasiswa_model->checklist_41($id_mahasiswa);
			$data['a42'] = $this->mahasiswa_model->checklist_42($id_mahasiswa);
			$data['a43'] = $this->mahasiswa_model->checklist_43($id_mahasiswa);
			$data['a44'] = $this->mahasiswa_model->checklist_44($id_mahasiswa);
			$data['a45'] = $this->mahasiswa_model->checklist_45($id_mahasiswa);
			$data['a46'] = $this->mahasiswa_model->checklist_46($id_mahasiswa);
			$data['a47'] = $this->mahasiswa_model->checklist_47($id_mahasiswa);
			$data['a48'] = $this->mahasiswa_model->checklist_48($id_mahasiswa);
			$data['a49'] = $this->mahasiswa_model->checklist_49($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/checklist_pembayaran_mahasiswa_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}
	
	
	
}