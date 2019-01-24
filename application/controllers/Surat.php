<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('surat_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('dosen_model');
		ini_set('display_errors', 0);
	}

	public function index(){
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6){
				$data['dashboard'] = $this->surat_model->dashboard_surat();
				$data['main_view'] = 'Surat/dashboard_sisp_view';
				$this->load->view('template', $data);
			} else if ($this->session->userdata('level') == 2) {
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
				$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['dashboard'] = $this->surat_model->dashboard_surat();
				$data['main_view'] = 'Surat/dashboard_sisp_view';
				$this->load->view('template', $data);
			} else {
				redirect('login');
			}
			} else {
			redirect('login');
		}
	}

	public function data_sisp()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 5){
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_mahasiswa = $session->id_mahasiswa;
				$id_prodi = $session->id_prodi;
				$semester_aktif = $session->semester_aktif;
				$data['mahasiswa'] = $this->surat_model->session_surat_mahasiswa($id_mahasiswa);
				$data['surat'] = $this->surat_model->data_sisp_mhs($id_mahasiswa);
				$data['main_view'] = 'Mahasiswa/data_sisp_mhs_view';
			} else if ($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
				$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
				$data['surat'] = $this->surat_model->data_sisp_dosen($id_dosen);
				$data['main_view'] = 'Dosen/data_sisp_dosen_view';
			} elseif ($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6) {
				$data['surat'] = $this->surat_model->data_sisp();
				$data['main_view'] = 'Surat/data_sisp_view';
			} else {
				redirect('login');
			}
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function data_sisp_all()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
				$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
				$data['surat'] = $this->surat_model->data_sisp_all();
				$data['main_view'] = 'Surat/data_sisp_all_view';
			} elseif ($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6) {
				$data['surat'] = $this->surat_model->data_sisp_all();
				$data['main_view'] = 'Surat/data_sisp_all_view';
			} else {
				redirect('login');
			}
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function data_sisp_approved()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6){
				$data['surat'] = $this->surat_model->data_sisp_approved();
				$data['main_view'] = 'Surat/data_sisp_approved_view';
				$this->load->view('template', $data);
			} elseif ($this->session->userdata('level') == 2) {
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
				$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['surat'] = $this->surat_model->data_sisp_approved();
				$data['main_view'] = 'Surat/data_sisp_approved_view';
				$this->load->view('template', $data);
			} else {
				redirect('login');
			}
			} else {
			redirect('login');
		}
	}

	public function data_sisp_verified()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6){
				$data['surat'] = $this->surat_model->data_sisp_verified();
				$data['main_view'] = 'Surat/data_sisp_verified_view';
				$this->load->view('template', $data);
			} else {
				redirect('login');
			}
			} else {
			redirect('login');
		}
	}

	public function data_sisp_rejected()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6){
				$data['surat'] = $this->surat_model->data_sisp_rejected();
				$data['main_view'] = 'Surat/data_sisp_rejected_view';
				$this->load->view('template', $data);
			} elseif ($this->session->userdata('level') == 2) {
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
				$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['surat'] = $this->surat_model->data_sisp_rejected();
				$data['main_view'] = 'Surat/data_sisp_rejected_view';
				$this->load->view('template', $data);
			} else {
				redirect('login');
			}
			} else {
			redirect('login');
		}
	}

	public function detail_sisp()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6){
				$no_permohonan = $this->uri->segment(3);
				$data['surat'] = $this->surat_model->detail_sisp($no_permohonan);
				$data['main_view'] = 'Surat/detail_sisp_view';
				$this->load->view('template', $data);
			} elseif ($this->session->userdata('level') == 5) {
				$no_permohonan = $this->uri->segment(3);
				$username = $this->session->userdata('username');
				$session = $this->mahasiswa_model->session_mahasiswa($username);
				$id_mahasiswa = $session->id_mahasiswa;
				$data['mahasiswa'] = $this->surat_model->session_surat_mahasiswa($id_mahasiswa);
				$data['surat'] = $this->surat_model->detail_sisp($no_permohonan);
				$data['main_view'] = 'Surat/detail_sisp_view';
				$this->load->view('template', $data);
			} elseif ($this->session->userdata('level') == 2) {
				$no_permohonan = $this->uri->segment(3);
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
				$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['surat'] = $this->surat_model->detail_sisp($no_permohonan);
				$data['main_view'] = 'Surat/detail_sisp_view';
				$this->load->view('template', $data);
			} else {
				redirect('login');
			}
			} else {
			redirect('login');
		}
	}

	public function print_sisp()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6){
				$no_permohonan = $this->uri->segment(3);
				$data['surat'] = $this->surat_model->detail_sisp($no_permohonan);
				$data['main_view'] = 'Surat/print_sisp_view';
				$this->load->view('template', $data);
			} elseif ($this->session->userdata('level') == 2) {
				$no_permohonan = $this->uri->segment(3);
				$username = $this->session->userdata('username');
				$session = $this->dosen_model->detail_dosen($username);
				$id_dosen = $session->id_dosen;
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
				$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['surat'] = $this->surat_model->detail_sisp($no_permohonan);
				$data['main_view'] = 'Surat/print_sisp_view';
				$this->load->view('template', $data);
			} else {
				redirect('login');
			}
			} else {
			redirect('login');
		}
	}

	public function simpan_sisp()
	{
		$id_mahasiswa = $this->uri->segment(3);
		$semester_aktif = $this->uri->segment(4);

		if ($semester_aktif == '7') {
			$semester_romawi = 'VII';
		} else if ($semester_aktif == '8') {
			$semester_romawi = 'VIII';
		} else if ($semester_aktif == '9') {
			$semester_romawi = 'IX';
		} else {
			$semester_romawi = 'X';
		}

			if($this->surat_model->simpan_sisp($id_mahasiswa, $semester_romawi) == TRUE){
				$no_permohonan = $this->surat_model->pilih_max_code();
				$code = $no_permohonan->no_max;
				$surat = $this->surat_model->detail_sisp($code);

				$this->load->library('email');
						$config = array(
							'protocol' => 'smtp',
							'smtp_host' 	=> 'ssl://smtp.googlemail.com',
							'smtp_port' 	=> 465,
							'smtp_user' 	=> 'jic.itservices@gmail.com',
							'smtp_pass' 	=> 'm0nash01',
							'mailtype'		=> 'html',
							'wordwrap'	=> TRUE
						);
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from('jic.itservices@gmail.com','Do not reply to this email (Surat Pengantar Riset)');
						$recipientArr = array($surat->email,'isthi.wahyuningtyas@jic.ac.id','waluyo.waluyo@jic.ac.id','sarwono.sarwono@jic.ac.id');
						$this->email->to($recipientArr);
						
						$this->email->subject('Permohonan Surat Pengantar Riset');
						$this->email->message('
							<table>
							<tr>
							<td colspan="2"> Yth. Verifikator, </td>
							</tr>
							<tr>
							<td colspan="2"> '.$surat->nama_dosen.'</td>
							</tr>
							<tr>
							<td colspan="2"> Kaprodi '.$surat->nama_prodi.'</td>
							</tr>
							<tr>
							<td colspan="2"> <br> </td>
							</tr>
							<tr>
							<td colspan="2"> Berikut ini adalah data mahasiswa yang mengajukan permohonan surat pengantar riset.</td>
							</tr>
							<tr>
							<td colspan="2"> <br> </td>
							</tr>	
							<tr>
							<td style="width:15%"> NIM </td>
							<td> : '.$surat->nim.' </td>
							</tr>
							<tr>
							<td> Tanggal Permohonan </td>
							<td> : '.date("d-m-Y", strtotime($surat->tgl_permohonan)).' </td>
							</tr>	
							<tr>
							<td> Nama </td>
							<td> : '.$surat->nama_mahasiswa.' </td>
							</tr>
							<tr>
							<td> Jurusan </td>
							<td> : '.$surat->nama_prodi.' </td>
							</tr>	
							<tr>
							<td> Semester </td>
							<td> : '.$surat->semester_romawi.' </td>
							</tr>
							<tr>
							<td> Judul Skripsi </td>
							<td> : '.$surat->judul_skripsi.' </td>
							</tr>
							<tr>
							<td> Nama PT/Institusi </td>
							<td> : '.$surat->nama_pt.' </td>
							</tr>
							<tr>
							<td> Alamat PT/Institusi </td>
							<td> : '.$surat->alamat_pt.' </td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Verifikasi data dapat dilakukan melalui Sistem Informasi Akademik. </td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Klik <a href="http://www.jic-stie.ac.id/siakad"> disini </a> untuk membuka memvrifikasi surat pengantar riset. </td>
							</tr>

							</table>
							');

						if($this->email->send()){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data surat pengantar riset berhasil diajukan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('surat/data_sisp');
            } else {
            	echo $this->email->print_debugger(array('headers'));
            }
			} 
	}

	public function verifikasi_sisp()
	{
	 $no_permohonan = $this->uri->segment(3);
			if($this->surat_model->verifikasi_sisp($no_permohonan) == TRUE){
				$surat = $this->surat_model->detail_sisp($no_permohonan);

				$this->load->library('email');
						$config = array(
							'protocol' => 'smtp',
							'smtp_host' 	=> 'ssl://smtp.googlemail.com',
							'smtp_port' 	=> 465,
							'smtp_user' 	=> 'jic.itservices@gmail.com',
							'smtp_pass' 	=> 'm0nash01',
							'mailtype'		=> 'html',
							'wordwrap'	=> TRUE
						);
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from('jic.itservices@gmail.com','Do not reply to this email (Surat Pengantar Riset)');
						$recipientArr = array('zahroh.dhoffir@jic.ac.id','sarwono.sarwono@jic.ac.id');
						$this->email->to($recipientArr);
						
						$this->email->subject('Permohonan Surat Pengantar Riset');
						$this->email->message('
							<table>
							<tr>
							<td colspan="2"> Yth. Ibu Zahroh Dhoffir, </td>
							</tr>
							<tr>
							<td colspan="2"> <br> </td>
							</tr>
							<tr>
							<td colspan="2"> Berikut ini adalah data mahasiswa yang sudah diverifikasi untuk pengajuan surat pengantar riset dan menunggu persetujuan Ibu untuk proses pembuatan Surat Pengantar tersebut. </td>
							</tr>
							<tr>
							<td colspan="2"> <br> </td>
							</tr>	
							<tr>
							<td style="width:15%"> NIM </td>
							<td> : '.$surat->nim.' </td>
							</tr>
							<tr>
							<td> Tanggal Permohonan </td>
							<td> : '.date("d-m-Y", strtotime($surat->tgl_permohonan)).' </td>
							</tr>	
							<tr>
							<td> Nama </td>
							<td> : '.$surat->nama_mahasiswa.' </td>
							</tr>
							<tr>
							<td> Jurusan </td>
							<td> : '.$surat->nama_prodi.' </td>
							</tr>	
							<tr>
							<td> Semester </td>
							<td> : '.$surat->semester_romawi.' </td>
							</tr>
							<tr>
							<td> Judul Skripsi </td>
							<td> : '.$surat->judul_skripsi.' </td>
							</tr>
							<tr>
							<td> Nama PT/Institusi </td>
							<td> : '.$surat->nama_pt.' </td>
							</tr>
							<tr>
							<td> Alamat PT/Institusi </td>
							<td> : '.$surat->alamat_pt.' </td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Persetujuan data permohonan dapat dilakukan melalui Sistem Informasi Akademik. </td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Klik <a href="http://www.jic-stie.ac.id/siakad"> disini </a> untuk menyetujui surat pengantar riset.</td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Terima Kasih </td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Regards, </td>
							</tr>
							<tr>
							<td colspan="2">'.$surat->nama_dosen.'</td>
							</tr>
							<tr>
							<td colspan="2"> Kaprodi '.$surat->nama_prodi.'</td>
							</tr>

							</table>
							');

						if($this->email->send()){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data surat pengantar riset berhasil diverifikasi </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('surat/data_sisp');
            }
			} 
	}

	public function setujui_sisp()
	{
		$no_permohonan = $this->input->post('no_permohonan2');

			if($this->surat_model->setujui_sisp($no_permohonan) == TRUE){
				$surat = $this->surat_model->detail_sisp($no_permohonan);

				$this->load->library('email');
						$config = array(
							'protocol' => 'smtp',
							'smtp_host' 	=> 'ssl://smtp.googlemail.com',
							'smtp_port' 	=> 465,
							'smtp_user' 	=> 'jic.itservices@gmail.com',
							'smtp_pass' 	=> 'm0nash01',
							'mailtype'		=> 'html',
							'wordwrap'	=> TRUE
						);
						$this->email->initialize($config);
						$this->email->set_newline("\r\n");
						$this->email->from('jic.itservices@gmail.com','Do not reply to this email (Surat Pengantar Riset)');
						$recipientArr = array($surat->email);
						$this->email->to($recipientArr);
						
						$this->email->subject('Permohonan Surat Pengantar Riset');
						$this->email->message('
							<table>
							<tr>
							<td colspan="2"> Yth. '.$surat->nama_dosen.', </td>
							</tr>
							<tr>
							<td colspan="2"> <br> </td>
							</tr>
							<tr>
							<td colspan="2"> Berikut ini adalah data mahasiswa yang sudah disetujui untuk pengajuan surat pengantar riset. </td>
							</tr>
							<tr>
							<td colspan="2"> <br> </td>
							</tr>	
							<tr>
							<td style="width:15%"> NIM </td>
							<td> : '.$surat->nim.' </td>
							</tr>
							<tr>
							<td> Tanggal Permohonan </td>
							<td> : '.date("d-m-Y", strtotime($surat->tgl_permohonan)).' </td>
							</tr>	
							<tr>
							<td> Nama </td>
							<td> : '.$surat->nama_mahasiswa.' </td>
							</tr>
							<tr>
							<td> Jurusan </td>
							<td> : '.$surat->nama_prodi.' </td>
							</tr>	
							<tr>
							<td> Semester </td>
							<td> : '.$surat->semester_romawi.' </td>
							</tr>
							<tr>
							<td> Judul Skripsi </td>
							<td> : '.$surat->judul_skripsi.' </td>
							</tr>
							<tr>
							<td> Nama PT/Institusi </td>
							<td> : '.$surat->nama_pt.' </td>
							</tr>
							<tr>
							<td> Alamat PT/Institusi </td>
							<td> : '.$surat->alamat_pt.' </td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Silahkan download Surat Pengantar Riset yang sudah disetujui melalui Sistem Informasi Akademik. </td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Klik <a href="http://www.jic-stie.ac.id/siakad"> disini </a> untuk mendownload surat pengantar riset.</td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Terima Kasih </td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Regards, </td>
							</tr>
							<tr>
							<td colspan="2"> Zahroh Dhoffir </td>
							</tr>
							<tr>
							<td colspan="2"> <br></td>
							</tr>
							<tr>
							<td colspan="2"> Mohon untuk tidak membalas email ini, karena email ini dikirim secara otomatis melalui sistem. </td>
							</tr>

							</table>
							');

						if($this->email->send()){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data surat pengantar riset berhasil disetujui </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('surat/data_sisp_verified');
            }
			} 
	}

	public function edit_sisp()
	{
		$no_permohonan = $this->input->post('no_permohonan');

			if($this->surat_model->edit_sisp($no_permohonan) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data surat berhasil diubah </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('surat/data_sisp');
			} 
	}

	public function tolak_sisp()
	{
		$no_permohonan = $this->input->post('no_permohonan');

			if($this->surat_model->tolak_sisp($no_permohonan) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data surat pengantar riset berhasil ditolak </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('surat/data_sisp');
			} 
	}

	public function tolak_sisp_setujui()
	{
		$no_permohonan = $this->input->post('no_permohonan');

			if($this->surat_model->tolak_sisp($no_permohonan) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data surat pengantar riset berhasil ditolak </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('surat/data_sisp_approved');
			} 
	}

	public function hapus_sisp()
	{
		$no_permohonan = $this->uri->segment(3);

			if($this->surat_model->hapus_sisp($no_permohonan) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data surat pengantar riset berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('surat/data_sisp');
			} 
	}

	public function hapus_sisp_setujui()
	{
		$no_permohonan = $this->uri->segment(3);

			if($this->surat_model->hapus_sisp($no_permohonan) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data surat pengantar riset berhasil dihapus </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('surat/data_sisp_approved');
			} 
	}

	public function cek_no_surat(){
		$no_surat = $this->input->post('no_surat');
		$this->surat_model->cek_no_surat($no_surat);
	}
		
}