<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_periode extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
		$this->load->model('periode_model');
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
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Periode telah tersimpan </div>');
            	redirect('setting_periode');
			} 
	}
	public function edit_periode(){
			$id_periode = $this->input->post('id_periode');
					if ($this->periode_model->edit_periode($id_periode) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success"> Edit '.$id_periode.' berhasil . </div>');
            			redirect('setting_periode');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit '.$id_periode.' gagal . </div>');
            			redirect('setting_periode');
					}
		}
}