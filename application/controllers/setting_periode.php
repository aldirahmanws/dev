<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_periode extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
		$this->load->model('periode_model');
		ini_set('display_errors', 0);
		if ($this->session->userdata('level') == 4 OR $this->session->userdata('level') == 5 OR $this->session->userdata('level') == 2 OR $this->session->userdata('level') == 3) {
			redirect('login');
		}
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['data_periode'] = $this->periode_model->data_periode();
			$data['main_view'] = 'Akademi/setting_periode_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}
	public function tambah_periode()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Akademi/tambah_periode_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}
	public function simpan_periode()
	{	
			if($this->periode_model->simpan_periode() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data periode berhasil disimpan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('setting_periode');
			} 
	}
	public function edit_periode(){
			$id_periode = $this->input->post('id_periode');
					if ($this->periode_model->edit_periode($id_periode) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data periode berhasil diubah </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            			redirect('setting_periode');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit '.$id_periode.' gagal . </div>');
            			redirect('setting_periode');
					}
		}

	public function hapus_periode(){
		$id_periode = $this->uri->segment(3);
		if ($this->periode_model->hapus_periode($id_periode) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data periode berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('setting_periode');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Hapus Gagal </div>');
			redirect('setting_periode');
		}
	}
}