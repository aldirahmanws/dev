<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('informasi_model');
		$this->load->model('dosen_model');
		$this->load->model('mahasiswa_model');
		ini_set('display_errors', 0);
	}

	public function index(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['getJabatan'] = $this->informasi_model->getJabatan();
				$data['informasi'] = $this->informasi_model->data_informasi();
				$data['main_view'] = 'Informasi/informasi_view';
				$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function simpan_informasi()
	{
			if($this->informasi_model->simpan_informasi() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data informasi berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('informasi');
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data informasi gagal ditambah </div>');
            	redirect('informasi');
		}
	}

	public function simpan_informasi2()
	{
			if($this->informasi_model->simpan_informasi() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data informasi berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('informasi/saring_level/'.$this->session->userdata('level'));
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data informasi gagal ditambah </div>');
            	redirect('informasi/saring_level/'.$this->session->userdata('level'));
		}
	}

	public function hapus_informasi(){
		$id_informasi = $this->uri->segment(3);
		if ($this->informasi_model->hapus_informasi($id_informasi) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data informasi berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			if ($this->session->userdata('level') != 1 AND $this->session->userdata('level') != 1) {
							redirect('informasi/saring_level/'.$this->session->userdata('level'));
						} else {
							redirect('informasi');
						}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data informasi gagal dihapus </div>');
			redirect('informasi');
		}
	}


	public function edit_informasi(){
			$id_informasi = $this->input->post('id_info');
					if ($this->informasi_model->edit_informasi($id_informasi) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data informasi berhasil diubah</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
						if ($this->session->userdata('level') != 1 AND $this->session->userdata('level') != 1) {
							redirect('informasi/saring_level/'.$this->session->userdata('level'));
						} else {
							redirect('informasi');
						}
						
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Data informasi gagal diedit </div>');
						redirect('informasi');
					}
			}

	public function filter_informasi()
	{
			$data['getJabatan'] = $this->informasi_model->getJabatan();
			$pengirim1=$this->input->get('pengirim1');
			$penerima1=$this->input->get('penerima1');
			$data['informasi'] = $this->informasi_model->filter_informasi($pengirim1, $penerima1);
			$data['main_view'] = 'Informasi/informasi_view';
			$this->load->view('template', $data);
	}

	public function saring_level()
	{
		if ($this->session->userdata('level') == 2) {
			$username = $this->session->userdata('username');
			$data['dosen'] = $this->dosen_model->detail_dosen($username);
		} else if ($this->session->userdata('level') == 5) {
			$id_mahasiswa = $this->session->userdata('username');
			$data['mahasiswa'] = $this->mahasiswa_model->session_mahasiswa($id_mahasiswa);
		}
			$id_level= $this->uri->segment(3);
			$data['getJabatan'] = $this->informasi_model->getJabatan();
			$data['informasi'] = $this->informasi_model->filter_informasi2($id_level);
			$data['main_view'] = 'Informasi/informasi_view';
			$this->load->view('template', $data);
	}
		


}

/* End of file master_konsentrasi.php */
/* Location: ./application/controllers/master_konsentrasi.php */