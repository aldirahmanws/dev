<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mahasiswa_model');
		$this->load->model('daftar_ulang_model');
		$this->load->model('konsentrasi_model');
		$this->load->model('kurikulum_model');
	}
	public function index()
	{		
			if($this->session->userdata('level') == 5){
				$id_mahasiswa = $this->session->userdata('id_mahasiswa');
				$data['id_mahasiswa'] = $this->session->userdata('id_mahasiswa');
				$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
				$data['main_view'] = 'Mahasiswa/lihat_mahasiswa_dikti_view';
				$this->load->view('template', $data);	
			} else {
				redirect(base_url('login'));
			}
			
	}
	public function mahasiswa_data()
	{
			$data['mahasiswa'] = $this->mahasiswa_model->data_mahasiswa();
			$data['main_view'] = 'Mahasiswa/data_mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function mahasiswa2()
	{
			$data['mahasiswa'] = $this->mahasiswa_model->data_mahasiswa();
			$data['main_view'] = 'Mahasiswa/data_mahasiswa_view2';
			$this->load->view('template', $data);
	}
	

	public function detail_mahasiswa()
	{
			$id_du = $this->uri->segment(3);
			$data['du'] = $this->daftar_ulang_model->detail_du($id_du);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$data['main_view'] = 'Mahasiswa/detail_mahasiswa_view';
			$this->load->view('template', $data);
	}


	public function data_mahasiswa()
	{
			$data['mahasiswa'] = $this->mahasiswa_model->data_mahasiswa_dikti();
			$data['drop_down_prodi'] = $this->konsentrasi_model->get_prodi();
			$data['main_view'] = 'Mahasiswa/mahasiswa_view';
			$this->load->view('template', $data);
	}
	

	public function filter_mahasiswa()
	{
			$data['drop_down_prodi'] = $this->konsentrasi_model->get_prodi();
			$id_prodi=$this->input->get('id_prodi');
			$agama=$this->input->get('agama');
			$jenis_kelamin=$this->input->get('jenis_kelamin');
			$angkatan=$this->input->get('tanggal_du');
			$data['mahasiswa'] = $this->mahasiswa_model->filter_mahasiswa($id_prodi,$agama,$jenis_kelamin,$angkatan);
			$data['main_view'] = 'Mahasiswa/mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function filter_nilai(){
			$id_mahasiswa = $this->uri->segment(3);
			$id_periode=$this->input->get('id_periode');
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['nilai'] = $this->mahasiswa_model->filter_nilai($id_mahasiswa,$id_periode);
			$data['nilai2'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/history_ips_view';
			$this->load->view('template', $data);
	}
	public function filter_nilai_ak(){
			$id_mahasiswa = $this->input->get('id_mahasiswa');
			$id_periode=$this->input->get('id_periode');
    		$this->mahasiswa_model->filter_nilai_ak($id_mahasiswa, $id_periode);
  	
	}
	public function get_prodi_periode($param = NULL) {
		$prodi = $param;
		$result = $this->kurikulum_model->get_prodi_periode2($prodi);
		$option = "";
		$option .= '<option value="uygydg">Pilih Periode</option>';
		foreach ($result as $data) {
			$option = 
			$option .= "<option value='".$data->semester."'>".$data->semester."</option>";
			
		}
		echo $option;
	}

	public function detail_mahasiswa_dikti()
	{
			$id_mahasiswa = $this->uri->segment(3);
			$data['getStatus'] = $this->mahasiswa_model->getStatus();
			$data['getGrade'] = $this->mahasiswa_model->getGrade();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getConcentrate'] = $this->daftar_ulang_model->getProdi();
			$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/detail_mahasiswa_dikti_view';
			$this->load->view('template', $data);
	}
	public function krs_mahasiswa()
	{
			if($this->session->userdata('id_mahasiswa') != null){
				$id_mahasiswa = $this->session->userdata('id_mahasiswa');
				$session = $this->mahasiswa_model->session_mahasiswa($id_mahasiswa);
				$id_prodi = $session->id_prodi;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$id_prodi = $this->uri->segment(4);
				$semester_aktif = $this->uri->segment(5);
			}
			
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['krs'] = $this->mahasiswa_model->data_krs_mhs($id_mahasiswa, $id_prodi, $semester_aktif);
			//$data['periode2'] = $this->mahasiswa_model->getPer($id_prodi);
			$data['periode'] = $this->mahasiswa_model->Periode_krs($id_prodi);
			$data['main_view'] = 'Mahasiswa/krs_mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function jadwal_mhs()
	{
			if($this->session->userdata('id_mahasiswa') != null){
				$id_mahasiswa = $this->session->userdata('id_mahasiswa');
				$session = $this->mahasiswa_model->session_mahasiswa($id_mahasiswa);
				$id_prodi = $session->id_prodi;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$id_prodi = $this->uri->segment(4);
				$semester_aktif = $this->uri->segment(5);
			}
			$data['periode'] = $this->mahasiswa_model->Periode_krs($id_prodi);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa, $semester_aktif);
			$data['senin'] = $this->mahasiswa_model->jadwal_mhs_senin($id_mahasiswa, $semester_aktif);
			$data['selasa'] = $this->mahasiswa_model->jadwal_mhs_selasa($id_mahasiswa, $semester_aktif);
			$data['rabu'] = $this->mahasiswa_model->jadwal_mhs_rabu($id_mahasiswa, $semester_aktif);
			$data['kamis'] = $this->mahasiswa_model->jadwal_mhs_kamis($id_mahasiswa, $semester_aktif);
			$data['jumat'] = $this->mahasiswa_model->jadwal_mhs_jumat($id_mahasiswa, $semester_aktif);
			$data['main_view'] = 'Mahasiswa/jadwal_mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function kelas_mhs()
	{
			if($this->session->userdata('id_mahasiswa') != null){
				$id_mahasiswa = $this->session->userdata('id_mahasiswa');
				$session = $this->mahasiswa_model->session_mahasiswa($id_mahasiswa);
				$id_prodi = $session->id_prodi;
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$semester_aktif = $this->uri->segment(5);
				$id_prodi = $this->uri->segment(4);
			}
			$data['periode'] = $this->mahasiswa_model->Periode_krs($id_prodi);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa, $semester_aktif);
			$data['kelas'] = $this->mahasiswa_model->kelas_mhs($id_mahasiswa, $semester_aktif);
			$data['main_view'] = 'Mahasiswa/kelas_mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function history_nilai()
	{
			if($this->session->userdata('id_mahasiswa') != null){
				$id_mahasiswa = $this->session->userdata('id_mahasiswa');
			} else {
				$id_mahasiswa = $this->uri->segment(3);
			}
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['nilai'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['nilai2'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/history_nilai_view';
			$this->load->view('template', $data);
	}

	public function aktivitas_perkuliahan()
	{
			if($this->session->userdata('id_mahasiswa') != null){
				$id_mahasiswa = $this->session->userdata('id_mahasiswa');
			} else {
				$id_mahasiswa = $this->uri->segment(3);
			}
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['aktivitas'] = $this->mahasiswa_model->data_ap($id_mahasiswa);
			$data['main_view'] = 'mahasiswa/aktivitas_perkuliahan_mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function transkip_nilai()
	{
			$id_mahasiswa = $this->uri->segment(3);
			$ipk = $this->uri->segment(4);
			$id_grade = $this->uri->segment(5);
			if($this->mahasiswa_model->update_ipk($id_mahasiswa, $ipk) == TRUE && $this->mahasiswa_model->update_grade($id_mahasiswa, $id_grade) ){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Update IPK Berhasil </div>');
            	redirect('mahasiswa/transkip_nilai2/'.$id_mahasiswa);
			} 	
	}

	public function transkip_nilai2()
	{
			$id_mahasiswa = $this->uri->segment(3);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_krs_mahasiswa($id_mahasiswa);
			$data['nilai2'] = $this->mahasiswa_model->data_nilai_mhs($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/transkip_nilai_view';
			$this->load->view('template', $data);
	}




	public function aktivasi_perkuliahan()
	{
			$data['main_view'] = 'Mahasiswa/aktivasi_perkuliahan_view';
			$this->load->view('template', $data);
	}
	

	public function lihat_mahasiswa_dikti()
	{
			$id_mahasiswa = $this->uri->segment(3);
			$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/lihat_mahasiswa_dikti_view';
			$this->load->view('template', $data);
	}

	public function page_tambah_mahasiswa()
	{
			$data['kodeunik_mhs'] = $this->mahasiswa_model->buat_kode_mhs();
			$data['getStatus'] = $this->mahasiswa_model->getStatus();
			$data['getGrade'] = $this->mahasiswa_model->getGrade();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Mahasiswa/tambah_mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function history_pendidikan()
	{
			if($this->session->userdata('id_mahasiswa') != null){
				$id_mahasiswa = $this->session->userdata('id_mahasiswa');
				$history = $this->session->userdata('id_mahasiswa');
			} else {
				$id_mahasiswa = $this->uri->segment(3);
				$history = $this->uri->segment(3);
			}
			$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
			$data['history'] = $this->mahasiswa_model->history_pendidikan($history);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['main_view'] = 'Mahasiswa/history_pendidikan_view';
			$this->load->view('template', $data);
	}

	public function simpan_pendidikan()
	{
		$id_mahasiswa = $this->uri->segment(3);
			if($this->mahasiswa_model->simpan_pendidikan($id_mahasiswa) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah History Pendidikan Berhasil </div>');
            	redirect('mahasiswa/history_pendidikan/'.$id_mahasiswa);
			} 
	}

	public function simpan_krs_mhs()
	{
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$id_prodi = $this->uri->segment(3);
		$semester_aktif = $this->uri->segment(4);
			if($this->mahasiswa_model->simpan_krs_mhs() == TRUE && $this->mahasiswa_model->update_status($id_mahasiswa) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah History Pendidikan Berhasil </div>');
            	redirect('mahasiswa/kelas_mhs/'.$id_mahasiswa.'/'.$id_prodi.'/'.$semester_aktif);
			} 
	}

	public function simpan_krs_mengulang()
	{
		$id_mahasiswa = $this->input->post('id_mahasiswa');
		$id_prodi = $this->uri->segment(3);
		$semester_aktif = $this->uri->segment(4);
			if($this->mahasiswa_model->simpan_krs_mengulang() == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah History Pendidikan Berhasil </div>');
            	redirect('mahasiswa/kelas_mhs/'.$id_mahasiswa.'/'.$id_prodi.'/'.$semester_aktif);
			} 
	}

	public function prestasi()
	{
			if($this->session->userdata('id_mahasiswa') != null){
				$id_mahasiswa = $this->session->userdata('id_mahasiswa');
			} else {
				$id_mahasiswa = $this->uri->segment(3);
			}
			$data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
			$data['prestasi'] = $this->mahasiswa_model->prestasi($id_mahasiswa);
			$data['main_view'] = 'Mahasiswa/prestasi_mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function detail_prestasi()
	{
			$id_prestasi = $this->uri->segment(3);
			$data['prestasi'] = $this->mahasiswa_model->detail_prestasi($id_prestasi);
			$data['main_view'] = 'Mahasiswa/edit_prestasi_mahasiswa_view';
			$this->load->view('template', $data);
	}

	public function simpan_prestasi()
	{
		$id_mahasiswa = $this->uri->segment(3);
			if($this->mahasiswa_model->simpan_prestasi($id_mahasiswa) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah Prestasi Berhasil </div>');
            	redirect('mahasiswa/prestasi/'.$id_mahasiswa);
			} 
	}

	public function edit_prestasi()
	{
		$id_prestasi = $this->uri->segment(3);
		$id_mahasiswa = $this->input->post('id_mahasiswa');
			if($this->mahasiswa_model->edit_prestasi($id_prestasi) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Edit Prestasi Berhasil </div>');
            	redirect('mahasiswa/prestasi/'.$id_mahasiswa);
			} 
	}

	public function save_edit_mahasiswa()
	{
		 $id_mahasiswa = $this->uri->segment(3);
			if($this->mahasiswa_model->save_edit_mahasiswa($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_ayah($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_ibu($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_alamat($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_wali($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_kependudukan($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_bio($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_kontak($id_mahasiswa) == TRUE && $this->mahasiswa_model->save_edit_mhs_add($id_mahasiswa) == TRUE){
				$nama_du = $this->input->post('nama_mahasiswa');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_du.' berhasil didaftarkan. </div>');
            	redirect('mahasiswa/data_mahasiswa');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Gagal </div>');
            	redirect('mahasiswa/data_mahasiswa');
			} 
	} 

	public function save_mahasiswa()
	{
			if($this->mahasiswa_model->save_mahasiswa() == TRUE && $this->mahasiswa_model->save_ayah() == TRUE  && $this->mahasiswa_model->save_ibu() == TRUE && $this->mahasiswa_model->save_alamat() == TRUE && $this->mahasiswa_model->save_wali() == TRUE && $this->mahasiswa_model->save_kependudukan() == TRUE && $this->mahasiswa_model->save_bio() == TRUE && $this->mahasiswa_model->save_kontak() == TRUE && $this->mahasiswa_model->save_tgl_du_mhs() == TRUE){
				$nama_du = $this->input->post('nama_mahasiswa');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_du.' berhasil didaftarkan. </div>');
            	redirect('mahasiswa/data_mahasiswa');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Data  '.$nama_pendaftar.' Sudah Ada </div>');
            	redirect('mahasiswa/data_mahasiswa');
			} 
	} 

	public function save_edit_foto_mahasiswa(){
	    $config['upload_path'] = './uploads/';
	    $config['allowed_types'] = 'jpg|png|jpeg';
	    $this->load->library('upload', $config);
	    if($this->upload->do_upload('foto_mahasiswa')){
	      if($this->mahasiswa_model->save_edit_foto_mahasiswa($this->upload->data(), $this->uri->segment(3)) == TRUE){
	        $this->session->set_flashdata('message', 'Upload Bukti Berhasil');
	            redirect('mahasiswa/detail_mahasiswa_dikti/'.$this->uri->segment(3));
	      } else {
	        $this->session->set_flashdata('message', 'Update foto gagal');
	            redirect('mahasiswa/detail_mahasiswa_dikti/'.$this->uri->segment(3));
	      }
	    } else {
	      $this->session->set_flashdata('message', $this->upload->display_errors());
	        redirect('mahasiswa/detail_mahasiswa_dikti/'.$this->uri->segment(3));
	    }
        
	}

	public function data_ld(){
		$data['ld'] = $this->mahasiswa_model->data_ld();
		$data['getProdi'] = $this->daftar_ulang_model->getProdi();
		$data['main_view'] = 'ld/lulus_do_view';
		$this->load->view('template', $data);
	}

	public function get_autocomplete_ipk(){
		if(isset($_GET['term'])){
			$result = $this->mahasiswa_model->autocomplete_ipk($_GET['term']);
			if(count($result) > 0){
				foreach ($result as $row) 
					$result_array[] = array(
						'label' => $row->nim.' - '.$row->nama_mahasiswa,
						'id' => $row->id_mahasiswa,
						'nama' => $row->nama_mahasiswa,
						'ipk' => $row->ipk,
						'prodi' => $row->id_prodi);
				echo json_encode($result_array);
			
			}
		}
	}

	public function simpan_ld()
	{
		$id_mahasiswa = $this->input->post('id_mahasiswa');
			if($this->mahasiswa_model->simpan_ld() == TRUE  && $this->mahasiswa_model->update_status_ld($id_mahasiswa) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah Mahasiswa Berhasil </div>');
            	redirect('mahasiswa/data_ld');
			} 
	}

	public function edit_ld()
	{
		$id_mahasiswa = $this->input->post('id_mahasiswa');
			if($this->mahasiswa_model->edit_ld($id_mahasiswa) == TRUE  && $this->mahasiswa_model->edit_status_ld($id_mahasiswa) == TRUE){
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Tambah Mahasiswa Berhasil </div>');
            	redirect('mahasiswa/data_ld');
			} 
	}

	public function filter_ld()
	{
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$id_prodi=$this->input->get('id_prodi');
			$id_status=$this->input->get('id_status');
			$angkatan=$this->input->get('angkatan');
			$data['ld'] = $this->mahasiswa_model->filter_ld($id_prodi,$id_status,$angkatan);
			$data['main_view'] = 'ld/lulus_do_view';
			$this->load->view('template', $data);
	}
		
}