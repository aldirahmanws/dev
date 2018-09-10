<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
		$this->load->model('kurikulum_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['kurikulum'] = $this->kurikulum_model->data_kurikulum();
			$data['main_view'] = 'kurikulum/kurikulum_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}


	public function simpan_kurikulum()
	{
			if($this->kurikulum_model->simpan_kurikulum() == TRUE){
				$prodi = $this->input->post('nama_kurikulum');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Data '.$prodi.' berhasil ditambahkan</div>');
            	redirect('kurikulum');
			
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('kurikulum');
		}
	}

	public function simpan_detail_kurikulum()
	{
		$id_kurikulum = $this->uri->segment(3);
			if($this->kurikulum_model->simpan_detail_kurikulum() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Mata kuliah berhasil ditambahkan </div>');
				$data = $this->input->post('id_kurikulum');
            	redirect('kurikulum/detail_kurikulum/'.$data);
			
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('kurikulum/detail_kurikulum/'.$id_kurikulum);
		}
	}

	public function detail_kurikulum()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_kurikulum = $this->uri->segment(3);
			$data['kurikulum'] = $this->kurikulum_model->detail_kurikulum($id_kurikulum);
			$detail_dk = $this->uri->segment(3);
			$data['dk'] = $this->kurikulum_model->detail_dk($detail_dk);
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'kurikulum/detail_kurikulum_view';
			$this->load->view('template', $data);
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('kurikulum');
		}
	}

	public function detail_kurikulum2()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$id_kurikulum = $this->uri->segment(3);
			$data['kurikulum'] = $this->kurikulum_model->detail_kurikulum($id_kurikulum);
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'kurikulum/edit_kurikulum_view';
			$this->load->view('template', $data);
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('kurikulum');
		}
	}

	public function detail_matkul_kurikulum()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$detail_dk = $this->uri->segment(3);
			$data['kurikulum'] = $this->kurikulum_model->detail_matkul($detail_dk);
			$data['main_view'] = 'kurikulum/edit_detail_kurikulum_view';
			$this->load->view('template', $data);
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('kurikulum');
		}
	}

	 function autocomplete(){
		$searchTerm = $_GET['term'];
		//mendapatkan data yang sesuai dari tabel daftar_kota
		$query = $this->db->query("SELECT * FROM tb_matkul WHERE nama_matkul LIKE '%".$searchTerm."%' ORDER BY nama_matkul ASC");
		foreach($query->result_array() as $row){
		    $data[] = $row['nama_matkul'];
		    $data[] = $row['kode_matkul'];
		    $data[] = $row['bobot_matkul'];
		    $data[] = $row['bobot_tatap_muka'];
		    $data[] = $row['bobot_praktik_lapangan'];
		    $data[] = $row['bobot_simulasi'];
		    $data[] = $row['bobot_praktikum'];
		}
		//return data json
		echo json_encode($data);
	}
	public function get_autocomplete(){
		if(isset($_GET['term'])){
			$result = $this->kurikulum_model->autocomplete($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->kode_matkul.' - '.$row->nama_matkul.' - (sks) '.$row->bobot_matkul,
						'bobot' => $row->bobot_matkul,
						'bp' => $row->bobot_praktikum,
						'btm' => $row->bobot_tatap_muka,
						'bpl' => $row->bobot_praktik_lapangan,
						'bs' => $row->bobot_simulasi,
						'id' => $row->kode_matkul);
				echo json_encode($result_array);
			
			}
		}
	}

	public function hapus_kurikulum(){
		$id_kurikulum = $this->uri->segment(3);
		if ($this->kurikulum_model->hapus_kurikulum($id_kurikulum) == TRUE && $this->kurikulum_model->hapus_detail_kurikulum($id_kurikulum) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Kurikulum berhasil </div>');
			redirect('kurikulum');
		} else {
			$this->session->set_flashdata('message', 'Hapus kurikulum Berhasil');
			redirect('kurikulum');
		}
	}

	public function hapus_matkul_kurikulum(){
		$id_detail_kurikulum = $this->uri->segment(3);
		$id_kurikulum = $this->uri->segment(4);
		if ($this->kurikulum_model->hapus_matkul_kurikulum($id_detail_kurikulum) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Mata Kuliah berhasil </div>');
            	redirect('kurikulum/detail_kurikulum/'.$id_kurikulum);
		} else {
			$this->session->set_flashdata('message', 'Hapus Mata Kuliah Berhasil');
            	redirect('kurikulum');
		}
	}

	public function edit_kurikulum(){
			$id_kurikulum = $this->uri->segment(3);
					if ($this->kurikulum_model->edit_kurikulum($id_kurikulum) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success"> Edit Kurikulum berhasil </div>');
            			redirect('kurikulum');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit Kurikulum Gagal </div>');
            			redirect('kurikulum');
					}
		} 

	public function edit_detail_kurikulum(){
			$id_detail_kurikulum = $this->uri->segment(3);
					if ($this->kurikulum_model->edit_detail_kurikulum($id_detail_kurikulum) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success"> Edit Mata Kuliah berhasil </div>');
            			$data = $this->input->post('id_kurikulum');
            			redirect('kurikulum/detail_kurikulum/'.$data);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit Kurikulum Gagal </div>');
            			redirect('kurikulum');
					}
		} 


	public function get_prodi_periode($param = NULL) {
		$prodi = $param;
		$result = $this->kurikulum_model->get_prodi_periode($prodi);
		$option = "";
		$option .= '<option value="">Pilih Semester</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->id_periode."'>".$data->semester."</option>";
			
		}
		echo $option;

	}

	public function get_nama_periode($param = NULL) {
		$periode = $param;
		$result = $this->kurikulum_model->get_nama_periode($periode);
		$ea = $result->semester;
		echo $ea;
	}

	function remove(){
			foreach ($_POST['id'] as $id) {
				$this->kurikulum_model->delete($id);
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success"> Hapus Mata Kuliah Berhasil </div>');
			redirect('kurikulum');
		}
}