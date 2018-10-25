<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ledger_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$data['getProdi'] = $this->ledger_model->getProdi();
			$data['main_view'] = 'Ledger/ledger_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function filter_ledger()
	{
			$id_prodi = $this->input->get('id_prodi');
			$kurikulum = $this->input->get('kurikulum');
			$angkatan = $this->input->get('angkatan');
			$data['getProdi'] = $this->ledger_model->getProdi();
			$data['matkul'] = $this->ledger_model->filter_matkul($kurikulum);
			$data['mahasiswa'] = $this->ledger_model->filter_mahasiswa($angkatan, $id_prodi);
			$data['main_view'] = 'Ledger/ledger_view2';
			$this->load->view('template', $data);
	}

	public function get_kurikulum_by_prodi($param = NULL) {
		$prodi = $param;
		$result = $this->ledger_model->get_kurikulum_by_prodi($prodi);
		$option = "";
		$option .= '<option value="">Pilih Kurikulum</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->nama_kurikulum."'>".$data->nama_kurikulum."</option>";
			
		}
		echo $option;

	}

	
		
}