<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepuasan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Kepuasan_model');
		 ini_set('display_errors', 0);
		  if ($this->session->userdata('logged_in') != TRUE) {
		  	redirect(base_url('login'));
		  }
	}
	//===================================================================================\\
	//===================================================================================\\
	public function index()
	{
		$data['get_prodi'] = $this->Kepuasan_model->get_prodi();
		$data['get_periode'] = $this->Kepuasan_model->get_periode();
		$data['get_dosen'] = $this->Kepuasan_model->get_dosen();
		$data['get_matkul'] = $this->Kepuasan_model->get_matkul();
		$data['kepuasan'] = $this->Kepuasan_model->get_kepuasan();
		$data['main_view'] = 'Kepuasan/kepuasan_view';
		$this->load->view('template', $data);	
	}
	public function add_kepuasan(){
		if($this->Kepuasan_model->add_kepuasan() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Success </div>');
            	redirect('Kepuasan');
			}  else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('Kepuasan');
		}
	}
	public function delete_kepuasan($id){
		if ($this->db->where('id_kepuasan', $id)->delete('tb_kepuasan') == TRUE) {
			$this->session->set_flashdata('message', ' <div class="alert alert-success"> Deleted </div>');
			redirect('Kepuasan');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
			redirect('Kepuasan');
		}
	}
	public function edit_kepuasan(){
		if($this->Kepuasan_model->edit_kepuasan() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Success </div>');
            	redirect('Kepuasan');
			}  else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('Kepuasan');
		}
	}
	

}