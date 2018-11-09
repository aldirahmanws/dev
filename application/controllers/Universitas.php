<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Universitas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('universitas_model');
		ini_set('display_errors', 0);
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
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data universitas '.$nama_du.' berhasil ditambahkan </div>');
            	redirect('universitas');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Data universitas '.$nama_du.' gagal ditambahkan </div>');
            	redirect('universitas');
			} 
	} 


	public function edit_universitas()
	{
		 $id_pt = $this->input->post('id_pt');
			if($this->universitas_model->edit_universitas($id_pt) == TRUE){
				$nama_pt = $this->input->post('nama_pt');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data universitas '.$nama_pt.' berhasil diubah </div>');
            	redirect('universitas');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Gagal </div>');
            	redirect('universitas');
			} 
	} 

	public function hapus_universitas(){
		$id_pt = $this->uri->segment(3);
		if ($this->universitas_model->hapus_universitas($id_pt) == TRUE) {
			$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Hapus Universitas Berhasil </div>');
			redirect('universitas');
		} else {
			$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Hapus Universitas Gagal </div>');
			redirect('universitas');
		}
	}
		
}