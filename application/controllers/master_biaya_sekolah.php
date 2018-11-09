<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_biaya_sekolah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('biaya_sekolah_model');
		ini_set('display_errors', 0);
	}

	public function index(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['data_biaya'] = $this->biaya_sekolah_model->data_biaya();
				$data['main_view'] = 'Biaya_sekolah/master_biaya_sekolah_view';
				$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function page_tambah_biaya_sekolah(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['getWaktu'] = $this->biaya_sekolah_model->getWaktu();
				$data['kodeunik'] = $this->biaya_sekolah_model->buat_kode();
				$data['main_view'] = 'Biaya_sekolah/tambah_biaya_sekolah_view';
				$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function save_biaya_sekolah()
	{
		//set rule di setiap form input
		$this->form_validation->set_rules('id_biaya', 'Id Biaya', 'trim|required');		

		$this->form_validation->set_rules('nama_biaya', 'Nama Biaya', 'trim|required');	
		
		if ($this->form_validation->run() == TRUE){
			if($this->biaya_sekolah_model->save_biaya_sekolah() == TRUE){
				$username = $this->input->post('nama_biaya');
				$this->session->set_flashdata('message', '<div class="alert alert-success">'.$username.' berhasil ditambahkan. </div>');
            	redirect('master_biaya_sekolah');
			} 
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('master_biaya_sekolah/page_tambah_biaya_sekolah');
		}
	}

	public function hapus_konsentrasi($id_konsentrasi){
		if ($this->konsentrasi_model->hapus_konsentrasi($id_konsentrasi) == TRUE) {
			$this->session->set_flashdata('message', 'Hapus Konsentrasi Berhasil');
			redirect('master_konsentrasi');
		} else {
			$this->session->set_flashdata('message', 'Hapus Konsentrasi Berhasil');
			redirect('master_konsentrasi');
		}
	}

	public function edit_biaya_sekolah(){
				$data['getWaktu'] = $this->biaya_sekolah_model->getWaktu();
				$data['data_biaya'] = $this->biaya_sekolah_model->data_biaya();
				$data['main_view'] = 'Biaya_sekolah/edit_biaya_sekolah_view';
				$id_biaya = $this->uri->segment(3);
				$data['edit'] = $this->biaya_sekolah_model->get_biaya_by_id($id_biaya);
				$this->load->view('template', $data);
	}


	public function save_edit_biaya_sekolah(){
			$id_biaya = $this->uri->segment(3);
					if ($this->biaya_sekolah_model->save_edit_biaya_sekolah($id_biaya) == TRUE) {
						$data['message'] = 'Edit biaya berhasil';
						redirect('master_biaya_sekolah');
					} else {
						$data['main_view'] = 'Biaya_sekolah/master_biaya_sekolah_view';
						$data['message'] = 'Edit Biaya gagal';
						redirect('master_biaya_sekolah/edit_biaya_sekolah');
					}
			}
		


}

/* End of file master_konsentrasi.php */
/* Location: ./application/controllers/master_konsentrasi.php */