<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_tes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
		ini_set('display_errors', 0);
	}

	public function page_input_nilai()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
				$id_du = $this->uri->segment(3);
				$data['hasil_tes'] = $this->daftar_ulang_model->get_du_by_id($id_du);
				$data['main_view'] = 'hasil_tes_view';
				$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function cetak_hasil_tes()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['main_view'] = 'Tes/hasil_tes_cetak_view';
				$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function save_hasil_tes()
	{	
		$id_tes = $this->input->post('id_hasil_tes');	
			if($this->daftar_ulang_model->save_hasil_tes() == TRUE){
				$id_tes = $this->input->post('id_hasil_tes');
				$this->daftar_ulang_model->save_update_status($id_tes);
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success">Hasil Tes berhasil ditambahkan </div>');
            	redirect('daftar_ulang/data_peserta_tes');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Hasil Tes gagal ditambahkan </div>');
            	redirect('hasil_tes/page_input_nilai');
			} 
	} 

	 public function print_hasil_tes(){
	 	if ($this->session->userdata('logged_in') == TRUE) {
        
        $id_du = $this->uri->segment(3);
        $edit = $this->daftar_ulang_model->get_hasil_tes($id_du);
        $cek = $edit->grade;
        $data['biaya'] = $this->daftar_ulang_model->get_biaya($cek);
        $data['edit'] = $edit;
        $id_hasil_tes = $this->uri->segment(4);
		$data['total_n'] = $this->daftar_ulang_model->total_nilai($id_hasil_tes);
        $data['main_view'] = 'Tes/hasil_tes_cetak_view';
        $this->load->view('template', $data);
        } else {
			redirect('login');
		}
  }

  public function detail_tes(){
        if ($this->session->userdata('logged_in') == TRUE) {
        $id_pendaftaran = $this->uri->segment(3);
        $data['edit'] = $this->pendaftaran_model->get_hasil_tes($id_pendaftaran);
        $data['main_view'] = 'Tes/detail_hasil_tes_view';
        $this->load->view('template', $data);
        } else {
			redirect('login');
		}
  }

  public function save_edit_hasil_tes(){
      $id_du = $this->uri->segment(3);
          if ($this->daftar_ulang_model->save_edit_hasil_tes($id_du) == TRUE) {
            $data['message'] = 'Edit Hasil Tes berhasil';
            redirect('daftar_ulang/data_peserta_tes');
          } else {
            $data['main_view'] = 'Prodi/master_konsentrasi_view';
            $data['message'] = 'Edit Konsentrasi gagal';
            redirect('master_konsentrasi/edit_konsentrasi');
          }
        }
}