<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Universitas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('universitas_model');
		ini_set('display_errors', 0);
		if ($this->session->userdata('level') == 4 OR $this->session->userdata('level') == 5 OR $this->session->userdata('level') == 2) {
			redirect('login');
		}
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['universitas'] = $this->universitas_model->data_universitas();
			$data['main_view'] = 'Universitas/data_universitas_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function save_universitas()
	{
			if($this->universitas_model->save_universitas() == TRUE){
				$nama_du = $this->input->post('nama_pt');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data berhasil disimpan</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');

            	redirect('universitas');
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-ban"></i> Data gagal disimpan</p>
              </div>');
            	redirect('universitas');
			} 
	} 


	public function edit_universitas()
	{
		 $id_pt = $this->input->post('id_pt');
			if($this->universitas_model->edit_universitas($id_pt) == TRUE){
				$nama_pt = $this->input->post('nama_pt');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data berhasil diubah</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('universitas');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Gagal </div>');
            	redirect('universitas');
			} 
	} 

	public function hapus_universitas(){
		$id_pt = $this->uri->segment(3);
		if ($this->universitas_model->hapus_universitas($id_pt) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data berhasil dihapus</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('universitas');
		} else {
			$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Hapus Universitas Gagal </div>');
			redirect('universitas');
		}
	}
		
}