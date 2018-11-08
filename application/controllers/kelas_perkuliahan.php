<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas_perkuliahan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kelas_perkuliahan_model');
		$this->load->model('daftar_ulang_model');
		$this->load->model('finance_model');
	}

	public function filter_kp()
	{
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$id_prodi=$this->input->get('id_prodi');
			$id_periode=$this->input->get('id_periode');
			$data['kp'] = $this->kelas_perkuliahan_model->filter_kp($id_prodi,$id_periode);
			$data['main_view'] = 'Kelas_perkuliahan/kelas_perkuliahan_view';
			$this->load->view('template', $data);
	}

	public function index(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['getProdi'] = $this->daftar_ulang_model->getProdi();
				$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
				$data['kp'] = $this->kelas_perkuliahan_model->data_kp();
				$data['main_view'] = 'Kelas_perkuliahan/kelas_perkuliahan_view';
				$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function detail_kp(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$id_kp = $this->uri->segment(3);
				$data['getProdi'] = $this->daftar_ulang_model->getProdi();
				$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
				$data['kp'] = $this->kelas_perkuliahan_model->detail_kp($id_kp);
				$data['main_view'] = 'Kelas_perkuliahan/edit_kelas_perkuliahan_view';
				$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function detail_kelas(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$id_kp = $this->uri->segment(3);
				$data['getProdi'] = $this->daftar_ulang_model->getProdi();
				$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
				$data['kp'] = $this->kelas_perkuliahan_model->detail_kp($id_kp);
				$data['dsn'] = $this->kelas_perkuliahan_model->jumlah_dosen($id_kp);
				$data['dosen'] = $this->kelas_perkuliahan_model->data_kelas_dosen($id_kp);
				$data['mhs'] = $this->kelas_perkuliahan_model->data_kelas_mhs($id_kp);
				$data['main_view'] = 'Kelas_perkuliahan/detail_kelas_perkuliahan_view';
				$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function page_edit_kelas_mhs(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$id_kp = $this->uri->segment(3);
				$data['mhs'] = $this->kelas_perkuliahan_model->detail_kelas_mhs($id_kp);
				$data['main_view'] = 'Kelas_perkuliahan/edit_kelas_mhs_view';
				$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function save_kp()
	{
			if($this->kelas_perkuliahan_model->save_kp() == TRUE){
				$username = $this->input->post('nama_kp');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Kelas berhasil ditambahkan. </div>');
            	redirect('kelas_perkuliahan');
			} 
	}

	public function get_concentrate2($param = NULL) {
		// $layanan =$this->input->post('layanan');
		$prodi = $param;
		$result = $this->kelas_perkuliahan_model->get_concentrate2($prodi);
		$option = "";
		$option .= '<option value="">Pilih Konsentrasi</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->id_konsentrasi."' >".$data->nama_konsentrasi."</option>";
		}
		echo $option;

	}

	public function simpan_kelas_dosen()
	{
		$id_kp = $this->input->post('id_kp');
			if($this->kelas_perkuliahan_model->simpan_kelas_dosen() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Dosen berhasil ditambahkan. </div>');
            	redirect('kelas_perkuliahan/detail_kelas/'.$id_kp);
			} 
	}

	public function cek_mahasiswa(){
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$id_kp = $this->input->post('id_kp2');
		$this->kelas_perkuliahan_model->cek_mahasiswa($id_mahasiswa, $id_kp);
	}

	public function hapus_kp($id_kp){
		if ($this->kelas_perkuliahan_model->hapus_kp($id_kp) == TRUE && $this->kelas_perkuliahan_model->hapus_kelas_dosen($id_kp) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Kelas Berhasil </div>');
			redirect('kelas_perkuliahan');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Hapus Kelas Gagal </div>');
			redirect('kelas_perkuliahan');
		}
	}

	public function save_edit_kp(){
			$id_kp = $this->uri->segment(3);
					if ($this->kelas_perkuliahan_model->save_edit_kp($id_kp) == TRUE) {
						$username = $this->input->post('nama_kp');
						$this->session->set_flashdata('message', '<div class="alert alert-success"> Edit Kelas Berhasil </div>');
						redirect('kelas_perkuliahan');
					} else {
						$data['main_view'] = 'Prodi/kelas_perkuliahan_view';
						$data['message'] = 'Edit kp gagal';
						redirect('kelas_perkuliahan/edit_kp');
					}
			}

	public function get_autocomplete(){
		if(isset($_GET['term'])){
			$result = $this->kelas_perkuliahan_model->autocomplete($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->id_dosen.' - '.$row->nama_dosen,
						'id' => $row->id_dosen);
				echo json_encode($result_array);
			
			}
		}
	}

	public function edit_kelas_dosen(){
			$id_kelas_dosen = $this->input->post('id_kelas_dosen');
			$id_kp = $this->input->post('id_kp');

					if ($this->kelas_perkuliahan_model->edit_kelas_dosen($id_kelas_dosen) == TRUE  && $this->kelas_perkuliahan_model->edit_id_dosen($id_kp)) {
						$this->session->set_flashdata('message', '<div class="alert alert-success"> Edit dosen berhasil </div>');
            			$id_kp = $this->input->post('id_kp');
            			redirect('kelas_perkuliahan/detail_kelas/'.$id_kp);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit Dosen Gagal </div>');
            			redirect('kelas_perkuliahan');
					}
		}

		public function save_edit_kelas_mhs(){
			$id_detail_kurikulum = $this->uri->segment(3);
					if ($this->kelas_perkuliahan_model->edit_kelas_mhs($id_detail_kurikulum) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success"> Edit Mahasiswa berhasil </div>');
            			$id_kp = $this->input->post('id_kp');
            			redirect('kelas_perkuliahan/detail_kelas/'.$id_kp);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit Mahasiswa Gagal </div>');
            			redirect('kelas_perkuliahan');
					}
		}

		
	public function get_autocomplete2(){
		if(isset($_GET['term'])){
			$result = $this->kelas_perkuliahan_model->autocomplete2($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->nim.' - '.$row->nama_mahasiswa,
						'id' => $row->id_mahasiswa,
						'nama_m' => $row->nama_mahasiswa,
						'status' => $row->id_status,
						'grade' => $row->id_grade,
						'semester_aktif' => $row->semester_aktif,
						'prodi' => $row->id_prodi);
				echo json_encode($result_array);
			
			}
		}
	}

	
	public function get_autocomplete_mk(){
		if(isset($_GET['term'])){
			$result = $this->kelas_perkuliahan_model->autocomplete_mk($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->id_matkul.' - '.$row->nama_matkul.' - (sks) '.$row->bobot_matkul.'-'.$row->nama_kurikulum,
						'bobot' => $row->bobot_matkul,
						'kurikulum' => $row->nama_kurikulum,
						'prodi' => $row->id_prodi,
						'idk' => $row->id_detail_kurikulum,
						'im' => $row->id_matkul,
						'id' => $row->kode_matkul);
				echo json_encode($result_array);
			
			}
		}
	}

	public function get_autocomplete_jadwal(){
		if(isset($_GET['term'])){
			$result = $this->kelas_perkuliahan_model->autocomplete_jadwal($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->nama_prodi.' - '.$row->hari.' - ('.substr($row->jam_awal,0,-3).'-'.substr($row->jam_akhir,0,-3).') - '.$row->nama_matkul,
						'ruang' => $row->nama_ruang,
						'prodi' => $row->nama_prodi,
						'konsentrasi' => $row->nama_konsentrasi,
						'id' => $row->id_jadwal);
				echo json_encode($result_array);
			
			}
		}
	}

	public function get_autocomplete_kp(){
		if(isset($_GET['term'])){
			$result = $this->kelas_perkuliahan_model->autocomplete_kp($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->nama_kelas.' - '.$row->nama_matkul.' - '.$row->nama_prodi,
						'prodi' => $row->id_prodi,
						'periode' => $row->id_periode,
						'idk' => $row->id_detail_kurikulum,
						'id' => $row->id_kp);
				echo json_encode($result_array);
			
			}
		}
	}

	public function get_autocomplete_kp_transfer(){
		if(isset($_GET['term'])){
			$result = $this->kelas_perkuliahan_model->autocomplete_kp_transfer($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->nama_prodi.' - '.$row->nama_matkul.' - '.$row->nama_kurikulum,
						'km' => $row->kode_matkul,
						'im' => $row->id_matkul,
						'id' => $row->id_kp);
				echo json_encode($result_array);
			
			}
		}
	}

	public function simpan_kelas_mhs()
	{
		$id_kp = $this->input->post('id_kp');
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$id_periode = $this->input->post('id_periode');
			if($this->kelas_perkuliahan_model->simpan_kelas_mhs() == TRUE && $this->kelas_perkuliahan_model->update_status_mhs($id_mahasiswa) == TRUE && $this->kelas_perkuliahan_model->update_status_aktivitas($id_mahasiswa, $id_periode) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah Mahasiswa Berhasil </div>');
				$id_kp = $this->input->post('id_kp');
            	redirect('kelas_perkuliahan/detail_kelas/'.$id_kp);
			} 
	}

	public function hapus_kelas_mhs(){
		$id_detail_kurikulum = $this->uri->segment(3);
		$id_kp = $this->uri->segment(4);
		if ($this->kelas_perkuliahan_model->hapus_kelas_mhs($id_detail_kurikulum) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Mahasiswa Berhasil </div>');
            	redirect('kelas_perkuliahan/detail_kelas/'.$id_kp);
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Hapus Mahasiswa Gagal </div>');
			redirect('Mahasiswa');
		}
	}

}

/* End of file kelas_perkuliahan.php */
/* Location: ./application/controllers/kelas_perkuliahan.php */