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
		if ($this->session->userdata('level') == 3 OR $this->session->userdata('level') == 4 OR $this->session->userdata('level') == 5) {
			redirect('login');
		}
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
		$data['main_view'] = 'Dosen/master_dosen_view';
		$data['dosen'] = $this->dosen_model->data_dosen();
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function page_tambah_dosen(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
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
				 $session = $this->dosen_model->session_dosen($username);
            $id_dosen = $session->id_dosen;
            
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
				 $session = $this->dosen_model->session_dosen($username);
            		$id_dosen = $session->id_dosen;
            		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
		$nim = $this->dosen_model->buat_kode_dosen();
		$config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $this->load->library('upload', $config);
        $this->upload->do_upload('foto_dosen');
			if($this->dosen_model->save_dosen($this->upload->data()) == TRUE){
								$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data dosen berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
				            	redirect('master_dosen');
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
		$config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $this->load->library('upload', $config);
        $this->upload->do_upload('foto_dosen');
			if($this->dosen_model->edit_dosen($id_dosen, $this->upload->data()) == TRUE  && $this->dosen_model->edit_username($id_dosen) == TRUE){
				if ($this->session->userdata('level') == 2) {
					$dosen = $this->input->post('id_dosen');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data dosen berhasil ubah </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('master_dosen/detail_dosen/'.$id_dosen);
				} else {
					$dosen = $this->input->post('id_dosen');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data dosen berhasil ubah </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$session = $this->dosen_model->session_dosen($username);
            $id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data dosen berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$session = $this->dosen_model->session_dosen($username);
            $id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
				$session = $this->dosen_model->session_dosen($username);
            $id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
				$session = $this->dosen_model->session_dosen($username);
            $id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data jabatan berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data jabatan berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$session = $this->dosen_model->session_dosen($username);
				$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data pendidikan berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data pendidikan berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$session = $this->dosen_model->session_dosen($username);
            	$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data pelatihan berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data pelatihan berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$session = $this->dosen_model->session_dosen($username);
            	$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data sertifikasi berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data sertifikasi berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$session = $this->dosen_model->session_dosen($username);
            	$id_dosen = $session->id_dosen;
			} else {
		$id_dosen = $this->uri->segment(3);
		}
		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data penelitian berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data penelitian berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('master_dosen/penelitian/'.$id_dosen);
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger">Hapus Penelitian Gagal </div>');
            	redirect('master_dosen/penelitian/'.$id_dosen);
			} 
	}


}

/* End of file master_dosen.php */
/* Location: ./application/controllers/master_dosen.php */