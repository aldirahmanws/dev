<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('calendar_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('dosen_model');
		ini_set('display_errors', 0);
		if ($this->session->userdata('logged_in') != TRUE) {
			redirect('login');
		}
	}

	public function index()
	{
		if ($this->session->userdata('level') == 5) {
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_prodi = $session->id_prodi;
				$semester_aktif = $session->semester_aktif;
				$id_mahasiswa = $session->id_mahasiswa;
				$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
		} elseif ($this->session->userdata('level') == 2) {
			$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
				$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		} else {

		}

		$var1 = $this->calendar_model->data();
		foreach ($var1 as $key) {
			$key->waktu_start = date('h:i a', strtotime($key->start));
			$key->waktu_end = date('h:i a', strtotime($key->end));
			$key->tanggal = date('d F Y', strtotime($key->start));
			$cek[] = array('title' => $key->title,
						 'start' => $key->start,
						 'waktu' => $key->waktu_start.' - '.$key->waktu_end,
						 'tanggal' => $key->tanggal,
						 'end' => $key->end,
						 'backgroundColor' => $key->backgroundColor,
						 'description' => $key->description,
						 'url' => '#',
						 // 'url' => 'http://www.mikesmithdev.com/blog/pdf-secure-access-and-log-downloads/',
						 'borderColor' => $key->backgroundColor);
		}
		$cek = json_encode($cek);
		
		$data['calendar'] = $cek;
		$data['aldi'] = 'cek';
		$data['main_view'] = 'modal_calendar';
		$this->load->view('template', $data);
		// }
	}

	public function calendar_landing()
	{
		$var1 = $this->calendar_model->data();
		foreach ($var1 as $key) {
			$key->waktu_start = date('h:i a', strtotime($key->start));
			$key->waktu_end = date('h:i a', strtotime($key->end));
			$key->tanggal = date('d F Y', strtotime($key->start));
			$cek[] = array('title' => $key->title,
						 'start' => $key->start,
						 'waktu' => $key->waktu_start.' - '.$key->waktu_end,
						 'tanggal' => $key->tanggal,
						 'end' => $key->end,
						 'backgroundColor' => $key->backgroundColor,
						 'description' => $key->description,
						 'url' => '#',
						 // 'url' => 'http://www.mikesmithdev.com/blog/pdf-secure-access-and-log-downloads/',
						 'borderColor' => $key->backgroundColor);
		}
		$cek = json_encode($cek);
		
		$data['calendar'] = $cek;
		$data['aldi'] = 'cek';
		$this->load->view('modal_calendar_landing', $data);
		// }
	}
	function google(){
		$data['main_view'] = 'modal_calendar';
		$this->load->view('template', $data);
	}
	function master_calendar(){
		if ($this->session->userdata('level') != 5) {
		if ($this->session->userdata('level') == 2) {
			$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
				$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
		} else {
			
		}
		$data['calendar'] = $this->calendar_model->data();
		$data['main_view'] = 'Calendar/master_calendar';
		$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}
	public function edit_calendar(){
			$title = $this->input->post('title');
					if ($this->calendar_model->edit_calendar() == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data '.$title.' berhasil diubah</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            			redirect('calendar/master_calendar');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit '.$title.' gagal . </div>');
            			redirect('calendar/master_calendar');
					}
		}
	public function tambah_calendar(){
		$title = $this->input->post('title');
		if($this->calendar_model->tambah_calendar() == TRUE){
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data '.$title.' berhasil ditambah</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            redirect('calendar/master_calendar');
        } else {
        	$this->session->set_flashdata('message', '<div class="alert alert-danger"> Tambah '.$title.' gagal . </div>');
        	redirect('calendar/master_calendar');
        }
	}
	public function hapus_calendar($id){
		if ($this->calendar_model->hapus_calendar($id) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data kalender berhasil dihapus</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('calendar/master_calendar');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger">Hapus gagal</div>');
			redirect('calendar/master_calendar');
		}
	}
}