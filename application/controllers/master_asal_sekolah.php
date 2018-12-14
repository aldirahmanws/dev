<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_asal_sekolah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('asal_sekolah_model');
		ini_set('display_errors', 0);
	}

	public function index()
	{		
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
			$data['asal_sekolah'] = $this->asal_sekolah_model->get_asal_sekolah();
			$data['main_view'] = 'Asal_sekolah/master_asal_sekolah_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}
	public function page_tambah_asal_sekolah(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
				$data['kodeunik'] = $this->asal_sekolah_model->buat_kode();
				$data['main_view'] = 'Asal_sekolah/tambah_asal_sekolah_view';
				$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}
	public function edit_asal_sekolah(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
				$data['main_view'] = 'Asal_sekolah/edit_asal_sekolah_view';
				$id_sekolah = $this->uri->segment(3);
				$data['edit'] = $this->asal_sekolah_model->get_asal_sekolah_by_id($id_sekolah);
				$this->load->view('template', $data);
				} else {
			redirect('login');
		}
	}

	public function save_asal_sekolah()
	{	
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->asal_sekolah_model->save_asal_sekolah() == TRUE){
				$username = $this->input->post('nama_sekolah');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data sekolah berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('master_asal_sekolah');
			} 
		} else {
			redirect('login');
		}
	}
	public function save_edit_asal_sekolah(){
			$id_sekolah = $this->uri->segment(3);
					if ($this->asal_sekolah_model->save_edit_asal_sekolah($id_sekolah) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data sekolah berhasil diubah </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
						redirect('master_asal_sekolah');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data sekolah gagal ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
						$data['message'] = 'Edit Konsentrasi gagal';
						redirect('master_konsentrasi/edit_konsentrasi');
					}
			}

			public function hapus_asal_sekolah($id_sekolah){
		if ($this->asal_sekolah_model->hapus_asal_sekolah($id_sekolah) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data sekolah berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('master_asal_sekolah');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Sekolah gagal ditambah </div>');
			redirect('master_asal_sekolah');
		}
	}
}