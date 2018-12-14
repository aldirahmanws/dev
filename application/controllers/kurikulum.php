<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
		$this->load->model('kurikulum_model');
		ini_set('display_errors', 0);
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['kurikulum'] = $this->kurikulum_model->data_kurikulum();
			$data['main_view'] = 'Kurikulum/kurikulum_view';
			$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}


	public function simpan_kurikulum()
	{
			if($this->kurikulum_model->simpan_kurikulum() == TRUE){
				$prodi = $this->input->post('nama_kurikulum');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data '.$prodi.' berhasil ditambahkan</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data mata kuliah berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
				$data = $this->input->post('id_kurikulum');
            	redirect('kurikulum/detail_kurikulum/'.$data);
			
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('kurikulum/detail_kurikulum/'.$id_kurikulum);
		}
	}

	public function detail_kurikulum()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
			$id_kurikulum = $this->uri->segment(3);
			$data['kurikulum'] = $this->kurikulum_model->detail_kurikulum($id_kurikulum);
			$detail_dk = $this->uri->segment(3);
			$data['getKurikulum'] = $this->kurikulum_model->getKurikulum();
			$data['dk'] = $this->kurikulum_model->detail_dk($detail_dk);
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Kurikulum/detail_kurikulum_view';
			$this->load->view('template', $data);
			} else{
            	redirect('login');
		}
	}

	public function detail_kurikulum2()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
			$id_kurikulum = $this->uri->segment(3);
			$data['kurikulum'] = $this->kurikulum_model->detail_kurikulum($id_kurikulum);
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Kurikulum/edit_kurikulum_view';
			$this->load->view('template', $data);
			} else{
            	redirect('login');
		}
	}

	public function detail_matkul_kurikulum()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') == 6 OR $this->session->userdata('level') == 1) {
			$detail_dk = $this->uri->segment(3);
			$data['kurikulum'] = $this->kurikulum_model->detail_matkul($detail_dk);
			$data['main_view'] = 'Kurikulum/edit_detail_kurikulum_view';
			$this->load->view('template', $data);
			} else{
            	redirect('login');
		}
	}

	public function get_autocomplete(){
		if(isset($_GET['term'])){
			$result = $this->kurikulum_model->autocomplete($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->id_matkul.' - '.$row->nama_matkul.' - '.$row->nama_prodi,
						'bobot' => $row->bobot_matkul,
						'bp' => $row->bobot_praktikum,
						'btm' => $row->bobot_tatap_muka,
						'bpl' => $row->bobot_praktik_lapangan,
						'bs' => $row->bobot_simulasi,
						'im' => $row->id_matkul,
						'ip' => $row->id_prodi,
						'id' => $row->kode_matkul);

				echo json_encode($result_array);
			
			}
		}
	}

	public function hapus_kurikulum(){
		$id_kurikulum = $this->uri->segment(3);
		if ($this->kurikulum_model->hapus_kurikulum($id_kurikulum) == TRUE && $this->kurikulum_model->hapus_detail_kurikulum($id_kurikulum) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data kurikulum berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data mata kuliah berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('kurikulum/detail_kurikulum/'.$id_kurikulum);
		} else {
			$this->session->set_flashdata('message', 'Hapus Mata Kuliah Berhasil');
            	redirect('kurikulum');
		}
	}

	public function edit_kurikulum(){
			$id_kurikulum = $this->uri->segment(3);
					if ($this->kurikulum_model->edit_kurikulum($id_kurikulum) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data kurikulum berhasil diubah</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            			redirect('kurikulum');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit Kurikulum Gagal </div>');
            			redirect('kurikulum');
					}
		} 

	public function edit_detail_kurikulum(){
			$id_detail_kurikulum = $this->uri->segment(3);
					if ($this->kurikulum_model->edit_detail_kurikulum($id_detail_kurikulum) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data mata kuliah berhasil diubah</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
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
		$option .= '<option value="">Pilih Periode</option>';
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
		$id_kurikulum = $this->uri->segment(3);
			foreach ($_POST['id'] as $id) {
				$this->kurikulum_model->delete($id);
			}
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data mata kuliah terpilih berhasil dihapus</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('kurikulum/detail_kurikulum/'.$id_kurikulum);
		}

	public function salin_matkul()
	{
			$id_kurikulum_get=$this->input->get('id_kurikulum');
			$id_kurikulum = $this->uri->segment(3);
			$data['kurikulum'] = $this->kurikulum_model->detail_kurikulum($id_kurikulum);
			$data['kurikulum2'] = $this->kurikulum_model->detail_kurikulum($id_kurikulum_get);
			$data['dk'] = $this->kurikulum_model->salin_matkul($id_kurikulum_get);
			$data['main_view'] = 'Kurikulum/salin_matkul_view';
			$this->load->view('template', $data);
	}

	public function simpan_salin_matkul()
	{
		$id_kurikulum = $this->input->post('id_kurikulum');
			if($this->kurikulum_model->simpan_salin_matkul() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data mata kuliah berhasil disalin</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('kurikulum/detail_kurikulum/'.$id_kurikulum);
			} 
	}
}