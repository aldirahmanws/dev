<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mata_kuliah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
		$this->load->model('mata_kuliah_model');
		ini_set('display_errors', 0);
		if ($this->session->userdata('level') == 4 OR $this->session->userdata('level') == 5 OR $this->session->userdata('level') == 2 OR $this->session->userdata('level') == 3) {
			redirect('login');
		}
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getJenisMatkul'] = $this->daftar_ulang_model->getJenisMatkul();
			$data['matkul'] = $this->mata_kuliah_model->data_matkul();
			$data['main_view'] = 'Mata_kuliah/mata_kuliah_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
		
	}
	public function tambah_matkul()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Mata_kuliah/tambah_matkul_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function detail_matkul()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$kode_matkul = $this->uri->segment(3);
			$data['matkul'] = $this->mata_kuliah_model->detail_matkul($kode_matkul);
			$data['getJenisMatkul'] = $this->daftar_ulang_model->getJenisMatkul();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Mata_kuliah/detail_matkul_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function simpan_matkul()
	{
			if($this->mata_kuliah_model->simpan_matkul() == TRUE){
				$prodi = $this->input->post('nama_matkul');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data mata kuliah berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('mata_kuliah');
			
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('mata_kuliah');
		}
	}
	public function edit_matkul(){
			$kode_matkul = $this->input->post('kode_matkul');
					if ($this->mata_kuliah_model->edit_matkul($kode_matkul) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data mata kuliah berhasil diubah </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            			redirect('mata_kuliah');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit '.$id_periode.' gagal . </div>');
            			redirect('mata_kuliah');
					}
		}

	public function hapus_matkul($kode_matkul){
		if ($this->mata_kuliah_model->hapus_matkul($kode_matkul) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data mata kuliah berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('mata_kuliah');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Mata Kuliah Gagal </div>');
			redirect('mata_kuliah');
		}
	}

	function remove(){
			foreach ($_POST['id'] as $id) {
				$this->mata_kuliah_model->delete($id);
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data mata kuliah terpilih berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('mata_kuliah');
		}
}