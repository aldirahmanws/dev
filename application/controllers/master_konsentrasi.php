<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_konsentrasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
		$this->load->model('konsentrasi_model');
		ini_set('display_errors', 0);
	}

	public function index(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['prodi'] = $this->prodi_model->data_prodi();
				$data['konsentrasi'] = $this->konsentrasi_model->data_konsentrasi();
				$data['main_view'] = 'Konsentrasi/master_konsentrasi_view';
				$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function page_tambah_konsentrasi(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['drop_down_prodi'] = $this->konsentrasi_model->get_prodi();
				$data['konsentrasi'] = $this->konsentrasi_model->data_konsentrasi();
				$data['main_view'] = 'Konsentrasi/tambah_konsentrasi_view';
				$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function save_konsentrasi()
	{
		//set rule di setiap form input
		$this->form_validation->set_rules('id_konsentrasi', 'Id Konsnetrasi', 'trim|required');		
		$this->form_validation->set_rules('nama_konsentrasi', 'Nama Konsentrasi', 'trim|required');	
		$this->form_validation->set_rules('id_prodi', 'Nama Prodi', 'trim|required');	
		
		if ($this->form_validation->run() == TRUE){
			if($this->konsentrasi_model->save_konsentrasi() == TRUE && $this->konsentrasi_model->save_konsentrasi2() == TRUE){
				$username = $this->input->post('nama_konsentrasi');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Data '.$username.' berhasil ditambahkan </div>');
            	redirect('master_konsentrasi');
			} 
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('master_konsentrasi/page_tambah_konsentrasi');
		}
	}

	public function hapus_konsentrasi(){
		$id_konsentrasi = $this->uri->segment(3);
		if ($this->konsentrasi_model->hapus_konsentrasi($id_konsentrasi) == TRUE && $this->konsentrasi_model->hapus_konsentrasi2($id_konsentrasi)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Data konsentrasi berhasil dihapus </div>');
			redirect('master_konsentrasi');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data konsentrasi gagal dihapus </div>');
			redirect('master_konsentrasi');
		}
	}

	public function edit_konsentrasi(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['konsentrasi'] = $this->konsentrasi_model->data_konsentrasi();
			    $data['drop_down_prodi'] = $this->konsentrasi_model->get_prodi();
				$data['main_view'] = 'Konsentrasi/edit_konsentrasi_view';
				$id_konsentrasi = $this->uri->segment(3);
				$data['edit'] = $this->konsentrasi_model->get_konsentrasi_by_id($id_konsentrasi);
				$this->load->view('template', $data);
				} else {
			redirect('login');
		}
	}


	public function save_edit_konsentrasi(){
			$id_konsentrasi = $this->uri->segment(3);
					if ($this->konsentrasi_model->save_edit_konsentrasi($id_konsentrasi) == TRUE && $this->konsentrasi_model->save_edit_konsentrasi2($id_konsentrasi) == TRUE) {
						$username = $this->input->post('nama_konsentrasi');
						$this->session->set_flashdata('message', '<div class="alert alert-success"> Data '.$username.' berhasil diedit </div>');
						redirect('master_konsentrasi');
					} else {
						$data['main_view'] = 'Prodi/master_konsentrasi_view';
						$username = $this->input->post('nama_konsentrasi');
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data '.$username.' gagal diedit </div>');
						redirect('master_konsentrasi/edit_konsentrasi');
					}
			}
		


}

/* End of file master_konsentrasi.php */
/* Location: ./application/controllers/master_konsentrasi.php */