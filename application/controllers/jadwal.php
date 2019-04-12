<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jadwal_model');
		$this->load->model('daftar_ulang_model');
		$this->load->model('ruang_model');
		ini_set('display_errors', 0);
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
			$data['jadwal'] = $this->jadwal_model->data_jadwal();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['getPeriode2'] = $this->jadwal_model->getPeriode();
			$data['getRuang'] = $this->ruang_model->getRuang();
			$data['main_view'] = 'Jadwal/jadwal_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function filter_jadwal()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
			$id_prodi = $this->input->get('id_prodi');
			$semester = $this->input->get('semester');
			$data['jadwal'] = $this->jadwal_model->filter_jadwal($id_prodi,$semester);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['getPeriode2'] = $this->jadwal_model->getPeriode();
			$data['getRuang'] = $this->ruang_model->getRuang();
			$data['main_view'] = 'Jadwal/jadwal_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function detail_jadwal()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
			$id_jadwal = $this->uri->segment(3);
			$data['getRuang'] = $this->ruang_model->getRuang();
			$data['jadwal'] = $this->jadwal_model->detail_jadwal($id_jadwal);
			$data['main_view'] = 'Jadwal/edit_jadwal_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function cek_duplikat(){
		$id_kp = $this->input->post('id_kp');
		$jam_awal = $this->input->post('jam_awal');
		$jam_akhir = $this->input->post('jam_akhir');
		$id_hari = $this->input->post('id_hari');
		$this->jadwal_model->cek_duplikat($id_kp, $jam_awal,$jam_akhir, $id_hari);
	}
	

	public function filter_ap()
	{
			$id_mahasiswa = $this->input->get('id_mahasiswa');
			$id_periode = $this->input->get('id_periode');
			$data['nilai'] = $this->aktivitas_perkuliahan_model->filter_ap($id_mahasiswa,$id_periode);
			$data['nilai2'] = $this->aktivitas_perkuliahan_model->data_nilai_mhs($id_mahasiswa);
			$data['main_view'] = 'Aktivitas_perkuliahan/aktivitas_perkuliahan_view2';
			$this->load->view('template', $data);
	}


	public function simpan_jadwal()
	{
			if($this->jadwal_model->simpan_jadwal() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data jadwal berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('jadwal');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Jadwal gagal ditambahkan </div>');
            	redirect('jadwal');
			} 
	}

	public function edit_jadwal()
	{
		$id_jadwal = $this->uri->segment(3);
			if($this->jadwal_model->edit_jadwal($id_jadwal) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data jadwal berhasil diubah </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('jadwal');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Jadwal gagal diubah </div>');
            	redirect('jadwal');
			} 
	}

	public function hapus_jadwal($id_prodi){
		if ($this->session->userdata('logged_in') == TRUE) {
		$id_jadwal = $this->uri->segment(3);
		if ($this->jadwal_model->hapus_jadwal($id_jadwal) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data jadwal berhasil dihapus</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('jadwal');
		} else {
			$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Jadwal gagal ditambahkan </div>');
			redirect('jadwal');
		}
		} else {
			redirect('login');
		}
	}

	public function jadwal_mhs()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
			$id_mahasiswa = $this->uri->segment(3);
			$data['jadwal'] = $this->jadwal_model->jadwal_mhs($id_mahasiswa);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['main_view'] = 'Jadwal/edit_jadwal_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}
		
}