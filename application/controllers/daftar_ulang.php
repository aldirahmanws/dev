<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class daftar_ulang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
		$this->load->model('tamu_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('user_model');
		$this->load->model('finance_model');
		ini_set('display_errors', 0);
	}

	public function page_du_pagi()
	{
		if ($this->session->userdata('logged_in') == TRUE  && $this->session->userdata('level') != 5) {
			$id_pendaftaran = $this->uri->segment(3);
			$data['du_pagi'] = $this->daftar_ulang_model->page_du_pagi($id_pendaftaran);
			$data['kodeunik'] = $this->daftar_ulang_model->buat_kode();
			$data['kodeunik_mhs'] = $this->mahasiswa_model->buat_kode_mhs();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$data['main_view'] = 'Daftar/daftarulang_pagi_view';
			$this->load->view('template', $data);
			} else {
			redirect('login');
		}

	}
	public function save_mahasiswa_pagi()
	{
		$id_pendaftaran = $this->uri->segment(3);
			if($this->mahasiswa_model->save_ayah() == TRUE  && $this->mahasiswa_model->save_ibu() == TRUE && $this->mahasiswa_model->save_alamat() == TRUE && $this->mahasiswa_model->save_wali() == TRUE && $this->mahasiswa_model->save_kependudukan() == TRUE && $this->mahasiswa_model->save_bio() == TRUE && $this->mahasiswa_model->save_kontak() == TRUE && $this->mahasiswa_model->simpan_pendidikan() == TRUE && $this->mahasiswa_model->save_mahasiswa_pagi() == TRUE && $this->daftar_ulang_model->ubah_status_pendaftaran($id_pendaftaran) == TRUE)
							if ($this->input->post('id_jenis_pendaftaran') != 1 OR $this->input->post('id_waktu') == 2) {
								$nama_du = $this->input->post('nama_mahasiswa');
							$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data '.$nama_du.' berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			            	redirect('mahasiswa/mahasiswa_data');
							} else {
								$nama_du = $this->input->post('nama_mahasiswa');
							$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data '.$nama_du.' berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			            	redirect('daftar_ulang/data_peserta_tes');
							} else {
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Data  '.$nama_pendaftar.' Sudah Ada </div>');
            	redirect('daftar_ulang/page_du_pagi');
			} 
	} 

	public function data_peserta_tes()
	{
		if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('level') != 5 && $this->session->userdata('level') != 4 && $this->session->userdata('level') != 2 && $this->session->userdata('level') != 6) {
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
			$data['du'] = $this->daftar_ulang_model->data_peserta_tes();
			$data['main_view'] = 'Daftar/data_daftarulang_view';
			$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		} else {
			redirect('login');
		}

			
	}

	public function detail_nilai()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 3 || $this->session->userdata('level') == 1){
			$id_du = $this->uri->segment(3);
			$data['edit'] = $this->daftar_ulang_model->detail_nilai($id_du);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$data['main_view'] = 'Tes/detail_hasil_tes_view';
			$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		} else {
			redirect('login');
		}
			
	}

	public function print_ljk(){
		if ($this->session->userdata('logged_in') == TRUE) {
        $id_mahasiswa= $this->uri->segment(3);
        $data['edit'] = $this->daftar_ulang_model->get_du_by_id($id_mahasiswa);
        $data['main_view'] = 'tes_backup';
        $this->load->view('template', $data);
        } else {
			redirect('login');
		}
   }

	public function get_concentrate($param = NULL) {
		// $layanan =$this->input->post('layanan');
		$prodi = $param;
		$result = $this->daftar_ulang_model->get_concentrate($prodi);
		$option = "";
		$option .= '<option value="">Pilih Konsentrasi</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->id_konsentrasi."' >".$data->nama_konsentrasi."</option>";
		}
		echo $option;

	}

	public function get_dosen_pa($param = NULL) {
		$prodi = $param;
		$result = $this->daftar_ulang_model->get_dosen_pa($prodi);
		$option = $result->id_dosen;
		echo $option;

	}

	public function get_grade($param = NULL) {
		// $layanan =$this->input->post('layanan');
		$semester_aktif = $param;
		$result = $this->daftar_ulang_model->get_grade($semester_aktif);
		$option = "";
		$option .= '<option value="">Pilih Grade</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->id_grade."' >".$data->grade."</option>";
		}
		echo $option;

	}

	public function cek_nim(){
		$nim = $this->input->post('nim');
		$this->daftar_ulang_model->cek_nim($nim);
	}

	 public function save_edit_du()
      {
		 $id_mahasiswa = $this->uri->segment(3);
			if($this->mahasiswa_model->save_edit_mahasiswa_du($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_bio($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_alamat($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_kependudukan($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_kontak($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_ibu($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_pendidikan_du($id_mahasiswa) == TRUE){
				$nama_du = $this->input->post('nama_mahasiswa');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data '.$nama_du.' berhasil diubah</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('mahasiswa/mahasiswa_data');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Gagal </div>');
            	redirect('mahasiswa/mahasiswa_data');
			} 
	} 
	function random_password() 
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array(); 
        $alpha_length = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) 
        {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }
        return implode($password); 
    }
}