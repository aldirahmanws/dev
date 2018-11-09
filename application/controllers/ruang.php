<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ruang_model');
		ini_set('display_errors', 0);
	}

	public function index(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['ruang'] = $this->ruang_model->data_ruang();
				$data['main_view'] = 'Ruang/ruang_view';
				$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function simpan_ruang()
	{
			if($this->ruang_model->simpan_ruang() == TRUE){
				$username = $this->input->post('nama_ruang');
				$this->session->set_flashdata('message', '<div class="alert alert-success">Ruangan '.$username.' berhasil ditambahkan </div>');
            	redirect('ruang'); 
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('ruang');
		}
	}

	public function hapus_ruang($id_ruang){
		if ($this->ruang_model->hapus_ruang($id_ruang) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Ruang Berhasil </div>');
			redirect('ruang');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Hapus Ruang Gagal </div>');
			redirect('ruang');
		}
	}


	public function edit_ruang(){
			$id_ruang = $this->input->post('id_ruang');
					if ($this->ruang_model->edit_ruang($id_ruang) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success"> Edit Ruang Berhasil </div>');
						redirect('ruang');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit Ruang Gagal </div>');
							redirect('ruang');
					}
			}
		


}

/* End of file ruang.php */
/* Location: ./application/controllers/ruang.php */