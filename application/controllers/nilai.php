<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('nilai_model');
		$this->load->model('daftar_ulang_model');
		ini_set('display_errors', 0);
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['nilai'] = $this->nilai_model->data_skala_nilai();
			$data['drop_down_prodi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Nilai/data_skala_nilai_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}
	

	public function detail_skala_nilai()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_skala_nilai = $this->uri->segment(3);
			$data['nilai'] = $this->nilai_model->detail_skala_nilai($id_skala_nilai);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Nilai/detail_skala_nilai_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function lihat_skala_nilai()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_skala_nilai = $this->uri->segment(3);
			$data['nilai'] = $this->nilai_model->detail_skala_nilai($id_skala_nilai);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Nilai/lihat_skala_nilai_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function tambah_skala_nilai()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['drop_down_prodi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Nilai/tambah_skala_nilai_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function save_skala_nilai()
	{
			if($this->nilai_model->save_skala_nilai() == TRUE){
				$nama_du = $this->input->post('nama_prodi');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data skala nilai '.$nama_du.' berhasil ditambahkan. </div>');
            	redirect('nilai');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Data  '.$nama_pendaftar.' Sudah Ada </div>');
            	redirect('nilai/tambah_skala_nilai');
			} 
	} 


	public function filter_nilai()
	{
			$data['drop_down_prodi'] = $this->daftar_ulang_model->getProdi();
			$id_prodi=$this->input->get('id_prodi');
			$data['nilai'] = $this->nilai_model->filter_nilai($id_prodi);
			$data['main_view'] = 'Nilai/data_skala_nilai_view';
			$this->load->view('template', $data);
	}


	public function save_edit_skala_nilai()
	{
		 $id_skala_nilai = $this->uri->segment(3);
			if($this->nilai_model->save_edit_skala_nilai($id_skala_nilai) == TRUE){
				$nama_du = $this->input->post('nama_prodi');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data skala nilai'.$nama_du.' berhasil diubah. </div>');
            	redirect('nilai');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Gagal </div>');
            	redirect('nilai');
			} 
	} 

	public function hapus_skala_nilai($id_skala_nilai){
		if ($this->nilai_model->hapus_skala_nilai($id_skala_nilai) == TRUE) {
			$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Hapus Skala Nilai Berhasil </div>');
			redirect('nilai');
		} else {
			$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Hapus Skala Nilai Gagal </div>');
			redirect('nilai');
		}
	}
		
}