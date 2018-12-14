<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan_model');
		ini_set('display_errors', 0);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function rasio_dosen_mhs(){
		$data['getProdi'] = $this->db->get('tb_prodi')->result();
		$data['getPeriode'] = $this->db->get('tb_periode')->result();
		$data['main_view'] = 'Akademi/rasio_dosen_mhs_view';
		$this->load->view('template', $data);
	}
	public function show_rasio(){
		error_reporting(0);
		$id_prodi = $this->input->post('id_prodi');
		$id_periode = $this->input->post('id_periode');
		$a = $this->laporan_model->rasio_dosen_mhs($id_prodi, $id_periode);
		$option = "";
		$option .= "<tr>
					<td>1</td>
					<td>".$id_prodi."</td>
					<td>".$a['data']->nama_prodi."</td>
					<td>".$a['data2']->semester."</td>
					<td>".$a['dosen']."</td>
					<td>".$a['mhs']."</td>
					<td>".$a['rasio']."</td>
					</tr>
					";
		echo $option;
	}
	public function get_semester($param = NULL) {
		$id_prodi = $param;
		$result = $this->db->where('id_prodi', $id_prodi)->get('tb_periode')->result();
		$option = "";
		foreach ($result as $data) {
			$option .= "<option value='".$data->id_periode."' >".$data->semester."</option>";
		}
		echo $option;

	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function laporan_tamu(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
		$data['main_view'] = 'Laporan/laporan_tamu_view';
		$this->load->view('template', $data);	
		} else {
			redirect('login');
		}
	}
	public function laporan_tamuku(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
    $tanggal_pendaftaran = $this->input->get('tanggal_pendaftaran');
    $tanggal_pendaftaran2 = $this->input->get('tanggal_pendaftaran2');
    $this->laporan_model->laporan_tamu($tanggal_pendaftaran, $tanggal_pendaftaran2);
    } else {
			redirect('login');
		}
  	}
  	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  	public function laporan_mahasiswa(){
  		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
		$data['main_view'] = 'Laporan/laporan_mahasiswa_view';
		$data['getPeriode'] = $this->laporan_model->getPeriode();
		$data['getAngkatan'] = $this->laporan_model->getTahunAngkatan();
		$data['getProdi'] = $this->laporan_model->getProdi();
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}	
	}
	public function laporan_mahasiswaku(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
    $id_periode = $this->input->get('id_periode');
    $id_prodi = $this->input->get('id_prodi');
    $filter = $this->input->get('filter');
    $tgl_du = $this->input->get('tgl_du');
    $this->laporan_model->laporan_mahasiswa($id_periode, $id_prodi, $filter, $tgl_du);
    } else {
			redirect('login');
		}	
  	}
  	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  	public function laporan_peserta_tes(){
  		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
  		$data['getTahun'] = $this->laporan_model->getTahun();
		$data['main_view'] = 'Laporan/laporan_peserta_tes_view';
		$this->load->view('template', $data);	
		} else {
			redirect('login');
		}	
	}
	public function laporan_peserta_tesku(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
    $tanggal_hasil_tes = $this->input->get('tanggal_hasil_tes');
    $this->laporan_model->laporan_peserta_tes($tanggal_hasil_tes);
    } else {
			redirect('login');
		}	
  	}
  	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  	public function laporan_data_getstudent(){
  		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
  		$data['getTahunSgs'] = $this->laporan_model->getTahunSgs();
		$data['main_view'] = 'Laporan/laporan_data_getstudent_view';
		$this->load->view('template', $data);	
		} else {
			redirect('login');
		}	
	}
	public function laporan_data_getstudentku(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 OR $this->session->userdata('level') == 3) {
    $tanggal_konfirmasi = $this->input->get('tanggal_konfirmasi');
    $this->laporan_model->laporan_data_getstudent($tanggal_konfirmasi);
    } else {
			redirect('login');
		}
  	}
  	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  	public function laporan_dmm(){
  		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
		$data['main_view'] = 'Laporan/laporan_dmm_view';
		$data['getSemester'] = $this->laporan_model->get_semester_dosen();
		$this->load->view('template', $data);	
		} else {
			redirect('login');
		}
	}
	public function laporan_dmm_dosen(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 ) {
	    $semester = $this->input->post('semester');
	    $id_dosen = $this->input->post('id_dosen');
	    $this->laporan_model->laporan_dmm_dosen($semester, $id_dosen);
	    } else {
			redirect('login');
		}
  	}
  	public function laporan_dmm_mahasiswa(){
  		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1 ) {
	    $semester = $this->input->post('semester');
	    $id_mahasiswa = $this->input->post('id_mahasiswa');
	    $this->laporan_model->laporan_dmm_mahasiswa($semester, $id_mahasiswa);
	    } else {
			redirect('login');
		}
  	}
  	public function laporan_dmm_matkul(){
  		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
	    $semester = $this->input->post('semester');
	    $kode_matkul = $this->input->post('kode_matkul');
	    $this->laporan_model->laporan_dmm_matkul($semester, $kode_matkul);
	    } else {
			redirect('login');
		}
  	}
  	public function get_autocomplete_dosen(){
		if(isset($_GET['term'])){
			$result = $this->laporan_model->autocomplete_dosen($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->id_dosen.' - '.$row->nama_dosen,
						'id' => $row->id_dosen);
				echo json_encode($result_array);
			
			}
		}
	}
	public function get_autocomplete_mahasiswa(){
		if(isset($_GET['term'])){
			$result = $this->laporan_model->autocomplete_mahasiswa($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->nim.' - '.$row->nama_mahasiswa,
						'id' => $row->id_mahasiswa);
				echo json_encode($result_array);
			
			}
		}
	}
	public function get_autocomplete_matkul(){
		if(isset($_GET['term'])){
			$result = $this->laporan_model->autocomplete_matkul($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->kode_matkul.' - '.$row->nama_matkul,
						'id' => $row->kode_matkul);
				echo json_encode($result_array);
			
			}
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function laporan_khs(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
		$data['main_view'] = 'Laporan/laporan_khs_view';
		$data['getPeriode'] = $this->laporan_model->getPeriode();
		$this->load->view('template', $data);	
		} else {
			redirect('login');
		}
	}
	public function laporan_khsku(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
	    $id_mahasiswa = $this->input->get('id_mahasiswa');
	    $semester = $this->input->get('semester');
	    $this->laporan_model->laporan_khs($id_mahasiswa, $semester);
	    } else {
			redirect('login');
		}
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function laporan_transkrip(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
		$data['main_view'] = 'Laporan/laporan_transkrip_view';
		$this->load->view('template', $data);	
		} else {
			redirect('login');
		}
	}
	public function laporan_transkripku(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
	    $id_mahasiswa = $this->input->get('id_mahasiswa');
	    $this->laporan_model->laporan_transkrip($id_mahasiswa);
	 } else {
			redirect('login');
		}
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function laporan_buku_induk(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
		$data['getProdi'] = $this->laporan_model->getProdi();
		$data['getTahunAngkatan'] = $this->laporan_model->getTahunAngkatan();
		$data['main_view'] = 'Laporan/laporan_buku_induk_view';
		$this->load->view('template', $data);	
		} else {
			redirect('login');
		}
	}

	public function laporan_buku_indukku(){
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
    $angkatan = $this->input->get('angkatan');
    $id_prodi = $this->input->get('id_prodi');
    $this->laporan_model->laporan_buku_induk($angkatan, $id_prodi);
    } else {
			redirect('login');
		}	
  	}
}


