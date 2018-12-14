<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_prodi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
		ini_set('display_errors', 0);
		if ($this->session->userdata('level') == 4 OR $this->session->userdata('level') == 5 OR $this->session->userdata('level') == 2) {
			redirect('login');
		}
	}

		public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
		$data['main_view'] = 'Prodi/master_prodi_view';
		$data['prodi'] = $this->prodi_model->data_prodi();
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function page_tambah_prodi(){
		if ($this->session->userdata('logged_in') == TRUE) {
		$data['main_view'] = 'Prodi/tambah_prodi_view';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function save_prodi()
	{
			if($this->prodi_model->save_prodi() == TRUE){
				$prodi = $this->input->post('nama_prodi');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data '.$prodi.' berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('master_prodi');
			} 
			
	}

	public function hapus_prodi($id_prodi){
		if ($this->prodi_model->hapus_prodi($id_prodi) == TRUE) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data prodi berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('master_prodi');
		} else {
			$this->session->set_flashdata('notif', 'Hapus Program Studi Berhasil');
			redirect('master_prodi');
		}
	}

	public function edit_prodi(){
			if ($this->session->userdata('logged_in') == TRUE) {
				$data['main_view'] = 'Prodi/edit_prodi_view';
				$id_prodi = $this->uri->segment(3);
				$data['edit'] = $this->prodi_model->get_prodi_by_id($id_prodi);
				$this->load->view('template', $data);
			} else {
			redirect('login');
		}

	}


	public function save_edit_prodi(){
			$id_prodi = $this->uri->segment(3);
					if ($this->prodi_model->save_edit_prodi($id_prodi) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data prodi berhasil ubah </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
						redirect('master_prodi');
					} else {
						$data['main_view'] = 'Prodi/master_prodi_view';
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data Prodi gagal diubah </div>');
						redirect('master_prodi/edit_prodi');
					}
			}


	

}

/* End of file master_prodi.php */
/* Location: ./application/controllers/master_prodi.php */