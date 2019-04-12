<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas_perkuliahan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('aktivitas_perkuliahan_model');
		$this->load->model('daftar_ulang_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('jadwal_model');
		ini_set('display_errors', 0);
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE AND $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6) {
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['getPeriode2'] = $this->jadwal_model->getPeriode();
			$data['aktivitas'] = $this->aktivitas_perkuliahan_model->data_aktivitas_perkuliahan();
			$data['main_view'] = 'Aktivitas_perkuliahan/aktivitas_perkuliahan_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function cek_duplikat(){
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$id_periode = $this->input->post('id_periode');
		$this->aktivitas_perkuliahan_model->cek_duplikat($id_mahasiswa, $id_periode);
	}
	

	public function filter_ap()
	{
			$id_mahasiswa = $this->input->get('id_mahasiswa');
			$id_periode = $this->input->get('id_periode');
			$smt_pindah = $this->input->get('smt_pindah');
			$data['nilai'] = $this->aktivitas_perkuliahan_model->filter_ap($id_mahasiswa,$id_periode);
			$data['nilai2'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['main_view'] = 'Aktivitas_perkuliahan/aktivitas_perkuliahan_view2';
			$this->load->view('template', $data);
	}

	public function filter_data_ap()
	{
			$id_prodi = $this->input->get('id_prodi');
			$id_periode = $this->input->get('id_periode');
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['getPeriode2'] = $this->jadwal_model->getPeriode();
			$data['aktivitas'] = $this->aktivitas_perkuliahan_model->filter_data_ap($id_prodi,$id_periode);
			$data['main_view'] = 'Aktivitas_perkuliahan/aktivitas_perkuliahan_view';
			$this->load->view('template', $data);
	}

	public function edit_ap()
	{
			$id_aktivitas = $this->uri->segment(3);
			$id_mahasiswa = $this->uri->segment(4);
			$id_periode = $this->uri->segment(5);
			$data['ap'] = $this->aktivitas_perkuliahan_model->detail_ap($id_aktivitas);
			$data['nilai'] = $this->aktivitas_perkuliahan_model->filter_ap($id_mahasiswa,$id_periode);
			$data['nilai2'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['main_view'] = 'Aktivitas_perkuliahan/edit_aktivitas_perkuliahan_view';
			$this->load->view('template', $data);
	}

	public function detail_ap()
	{
		if ($this->session->userdata('logged_in') == TRUE AND $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6) {
			$id_aktivitas = $this->uri->segment(3);
			$id_mahasiswa = $this->uri->segment(4);
			$id_periode = $this->uri->segment(5);
			$semester_ak = $this->uri->segment(6);
			$data['ap'] = $this->aktivitas_perkuliahan_model->detail_ap($id_aktivitas);
			$data['nilai'] = $this->aktivitas_perkuliahan_model->data_ips($id_mahasiswa,$semester_ak);
			$data['nilai2'] = $this->aktivitas_perkuliahan_model->data_ipk($id_mahasiswa, $semester_ak);
			$data['main_view'] = 'Aktivitas_perkuliahan/detail_aktivitas_perkuliahan_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
			
	}


	public function save_ap()
	{
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$id_grade = $this->input->post('id_grade');
		$semester_aktif = $this->input->post('semester_aktif');
		$ipk_ak = $this->input->post('ipk_ak');
			if($this->aktivitas_perkuliahan_model->save_ap() == TRUE && $this->aktivitas_perkuliahan_model->update_status($id_mahasiswa, $semester_aktif) == TRUE && $this->mahasiswa_model->update_grade($id_mahasiswa, $id_grade) == TRUE  && $this->aktivitas_perkuliahan_model->update_ipk($id_mahasiswa, $ipk_ak) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data aktivitas perkuliahan berhasil ditambahkan</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('aktivitas_perkuliahan');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Data aktivitas perkuliahan gagal ditambahkan </div>');
            	redirect('aktivitas_perkuliahan');
			} 
	}

	public function save_edit_ap()
	{
		$id_aktivitas = $this->input->post('id_aktivitas');
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$id_grade = $this->input->post('id_grade');
		$semester_aktif = $this->input->post('semester_aktif');
		$ipk_ak = $this->input->post('ipk_ak');
			if($this->aktivitas_perkuliahan_model->save_edit_ap($id_aktivitas) == TRUE && $this->aktivitas_perkuliahan_model->update_status($id_mahasiswa, $semester_aktif) == TRUE && $this->mahasiswa_model->update_grade($id_mahasiswa, $id_grade) == TRUE  && $this->aktivitas_perkuliahan_model->update_ipk($id_mahasiswa, $ipk_ak) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data aktivitas perkuliahan berhasil diubah</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('aktivitas_perkuliahan');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Edit perkuliahan gagal </div>');
            	redirect('aktivitas_perkuliahan');
			} 
	}
		
}