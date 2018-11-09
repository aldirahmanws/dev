<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tamu_model');
		$this->load->model('daftar_ulang_model');
		$this->load->model('mahasiswa_model');
		ini_set('display_errors', 0);
	}

	public function index(){

		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
			redirect(base_url('dashboard'));
		} else {
			redirect(base_url('login'));
		}
		
	}
	public function data_tamu(){
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
				$data['tamu'] = $this->tamu_model->data_tamu();
				$data['main_view'] = 'Tamu/data_tamu_view';
				$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		

	}
	public function page_tambah_tamu(){
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
				$data['kodeunik'] = $this->tamu_model->buat_kode();
				$data['getUniversitas'] = $this->tamu_model->getUniversitas();
				$data['getProdi'] = $this->daftar_ulang_model->getProdi();
				$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
				$data['mahasiswa'] = $this->mahasiswa_model->data_mahasiswa();
				$data['main_view'] = 'Tamu/tambah_tamu_view';
				$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		

	}

	public function detail_tamu()
	{
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
			$id_du = $this->uri->segment(3);
			$data['edit'] = $this->tamu_model->detail_tamu($id_du);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getUniversitas'] = $this->tamu_model->getUniversitas();
			$data['mahasiswa'] = $this->mahasiswa_model->data_mahasiswa();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$data['main_view'] = 'Tamu/detail_tamu_view';
			$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		
	}

	public function data_out()
	{
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
			$data['edit'] = $this->tamu_model->data_tamu_out();
			$data['main_view'] = 'Tamu/data_non_aktif_view';
			$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		
	}

	public function detail_out()
	{
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
			$id_pendaftaran = $this->uri->segment(3);
			$data['edit'] = $this->tamu_model->detail_tamu($id_pendaftaran);
			$data['main_view'] = 'Tamu/detail_non_aktif_view';
			$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		
	}

	public function save_tamu()
	{
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
			if($this->tamu_model->save_tamu() == TRUE){
				$nama_pendaftar = $this->input->post('nama_pendaftar');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_pendaftar.' berhasil didaftarkan. </div>');
            	redirect('tamu/data_tamu');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('tamu/data_tamu');
			} 
		} else {
			redirect(base_url('login'));
		}
		
	} 

	public function hapus_tamu($id_tamu){
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
			if ($this->tamu_model->hapus_tamu($id_tamu) == TRUE) {
				$this->session->set_flashdata('message','<div class="alert alert-success">Hapus tamu berhasil </div>');
				redirect('tamu/data_tamu');
			} else {
				$this->session->set_flashdata('message', 'Hapus Tamu Gagal');
				redirect('tamu/data_tamu');
			}
		} else {
			redirect(base_url('login'));
		}
		
	}


	public function page_upload(){
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
			$id_pendaftaran = $this->uri->segment(3);
			$data['edit'] = $this->tamu_model->get_tamu_by_id($id_pendaftaran);
			$data['main_view'] = 'Tamu/upload_bukti_view';
			$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		
	}


	public function save_bukti_transfer(){
	    $config['upload_path'] = './uploads/';
	    $config['allowed_types'] = 'jpg|png|jpeg|pdf';
	    $this->load->library('upload', $config);

	    if($this->upload->do_upload('bukti_transfer')){
	      if($this->tamu_model->save_bukti_transfer($this->upload->data(), $this->uri->segment(3)) == TRUE){
	        $this->session->set_flashdata('message','<div class="alert alert-success">Upload bukti berhasil </div>');
	            redirect('tamu/data_tamu');
	      } else {
	        $this->session->set_flashdata('message','<div class="alert alert-success">Hapus tamu berhasil </div>');
	            redirect('tamu/page_upload');
	      }
	    } else {
	      $this->session->set_flashdata('failed', $this->upload->display_errors());
	        redirect('tamu/page_upload');
	    }
	  } 

	  public function save_edit_tamu(){
      $id_pendaftaran = $this->uri->segment(3);
          if ($this->tamu_model->save_edit_tamu($id_pendaftaran) == TRUE) {
            $this->session->set_flashdata('message','<div class="alert alert-success">Edit tamu berhasil </div>');
            redirect('tamu/data_tamu');
          } else {
            $data['main_view'] = 'Tamu/detail_tamu_view';
            $data['message'] = 'mahasiswa/detail_mahasiswa';
            redirect('tamu/detail_tamu_view');
          }
        }

        public function f1(){
        		$id_du = $this->uri->segment(3);
        		$data['main_view'] = 'Tamu/f1_view';
				$data['edit'] = $this->tamu_model->get_tamu_by_id($id_du);
				
				$this->load->view('template', $data);
		
		}

		  public function save_f1(){
      	  $id_du = $this->uri->segment(3);
          if ($this->tamu_model->save_f1($id_du) == TRUE) {
            $this->session->set_flashdata('message','<div class="alert alert-success"> Follow Up Berhasil </div>');
            redirect('tamu/data_tamu');
          } else {
          	$this->session->set_flashdata('message','<div class="alert alert-danger"> Follow Up Gaga l</div>');
            $data['main_view'] = 'Tamu/f1_view';
            redirect('tamu/detail_tamu_view');
        	
          }
        }

        

        public function data_sgs(){
        	if ($this->session->userdata('logged_in') == TRUE) {
				$data['edit'] = $this->tamu_model->data_sgs();
				$data['main_view'] = 'Tamu/sgs_view';
				$this->load->view('template', $data);
			} else {
			redirect('login');
		}
		
	}

	

		


}

/* End of file master_konsentrasi.php */
/* Location: ./application/controllers/master_konsentrasi.php */