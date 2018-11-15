<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_grade extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Master_grade_model');
	}

	public function index()
	{		
		$data['grade'] = $this->db->get('tb_grade')->result();
		$data['main_view'] = 'Master/master_grade_view';
		$this->load->view('template', $data);
	}
	public function add_grade(){
		if($this->Master_grade_model->add_grade() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Success </div>');
            	redirect('Master_grade');
			}  else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('Master_grade');
		}
	}
	public function delete_grade($id){
		if ($this->db->where('id_grade', $id)->delete('tb_grade') == TRUE) {
			$this->session->set_flashdata('message', ' <div class="alert alert-success"> Deleted </div>');
			redirect('Master_grade');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
			redirect('Master_grade');
		}
	}
	public function edit_grade(){
		if($this->Master_grade_model->edit_grade() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Success </div>');
            	redirect('Master_grade');
			}  else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('Master_grade');
		}
	}
}