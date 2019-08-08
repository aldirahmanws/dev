<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_perkuliahan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kelas_perkuliahan_model');
		$this->load->model('daftar_ulang_model');
		$this->load->model('finance_model');
		$this->load->model('nilai_perkuliahan_model');
		$this->load->model('dosen_model');
		$this->load->model('jadwal_model');
		ini_set('display_errors', 0);
		if ($this->session->userdata('level') == 4 OR $this->session->userdata('level') == 5 OR $this->session->userdata('level') == 3) {
			redirect('login');
		}
	}


	public function index(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$data['getProdi'] = $this->daftar_ulang_model->getProdi();
				$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
				$data['getPeriode2'] = $this->jadwal_model->getPeriode();

				$ambil_db = $this->kelas_perkuliahan_model->data_kp();
				$c = 0;
				//$alert = "'Apakah anda yakin mengapus data ini ?'";
				foreach ($ambil_db as $key) {

				 $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE id_kp = '$key->id_kp'")->row();
                  $total_nilai = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_d != 0 AND id_kp = '$key->id_kp'")->row();
                  $absensi = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE absensi != 0 AND id_kp = '$key->id_kp'")->row();
                  $nilai_tugas = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_tugas != 0 AND id_kp = '$key->id_kp'")->row();
                  $nilai_uts = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uts != 0 AND id_kp = '$key->id_kp'")->row();
                  $nilai_uas = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uas != 0 AND id_kp = '$key->id_kp'")->row();
                  $nilai_paper = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uas != 0 AND id_kp = '$key->id_kp'")->row();

					$arrayName[] = array(++$c,$key->nama_prodi, $key->nama_konsentrasi, '<a href="'.base_url('nilai_perkuliahan/detail_nilai/'.$key->id_kp).'")>'.$key->id_matkul.'</a> ' ,$key->nama_matkul,$key->wajib ,$key->nama_kelas,$key->waktu,$key->bobot_matkul,$total_mahasiswa->total,$absensi->total, $nilai_tugas->total, $nilai_uts->total, $nilai_uas->total, $nilai_paper->total, $total_nilai->total);	
				}
			
				$ambil_db = json_encode($arrayName);
				$data['nilai_perkuliahan'] = $ambil_db;

				$data['main_view'] = 'Nilai_perkuliahan/nilai_perkuliahan_view';
				$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function filter_kp()
	{
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPeriode'] = $this->daftar_ulang_model->getPeriode();
			$data['getPeriode2'] = $this->jadwal_model->getPeriode();
			$id_prodi=$this->input->get('id_prodi');
			$id_periode=$this->input->get('id_periode');

			$ambil_db = $this->kelas_perkuliahan_model->filter_kp($id_prodi,$id_periode);
				$c = 0;
				//$alert = "'Apakah anda yakin mengapus data ini ?'";
				foreach ($ambil_db as $key) {

				 $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE id_kp = '$key->id_kp'")->row();
                  $total_nilai = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_d != 0 AND id_kp = '$key->id_kp'")->row();
                  $absensi = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE absensi != 0 AND id_kp = '$key->id_kp'")->row();
                  $nilai_tugas = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_tugas != 0 AND id_kp = '$key->id_kp'")->row();
                  $nilai_uts = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uts != 0 AND id_kp = '$key->id_kp'")->row();
                  $nilai_uas = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uas != 0 AND id_kp = '$key->id_kp'")->row();
                  $nilai_paper = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uas != 0 AND id_kp = '$key->id_kp'")->row();

					$arrayName[] = array(++$c,$key->nama_prodi, $key->nama_konsentrasi, '<a href="'.base_url('nilai_perkuliahan/detail_nilai/'.$key->id_kp).'")>'.$key->id_matkul.'</a> ' ,$key->nama_matkul,$key->wajib ,$key->nama_kelas,$key->waktu,$key->bobot_matkul,$total_mahasiswa->total,$absensi->total, $nilai_tugas->total, $nilai_uts->total, $nilai_uas->total, $nilai_paper->total, $total_nilai->total);	
				}
			
				$ambil_db = json_encode($arrayName);
				$data['nilai_perkuliahan'] = $ambil_db;
			$data['main_view'] = 'Nilai_perkuliahan/nilai_perkuliahan_view';
			$this->load->view('template', $data);
	}


	public function detail_nilai(){
		if ($this->session->userdata('logged_in') == TRUE) {
				
				$id_kp = $this->uri->segment(3);
				
				if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				 $session = $this->dosen_model->session_dosen($username);
            		$id_dosen = $session->id_dosen;
            		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
			} else {
				$id_dosen = $this->uri->segment(4);
			}
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
				$data['kp'] = $this->nilai_perkuliahan_model->detail_nilai($id_kp);
				$data['dsn'] = $this->kelas_perkuliahan_model->jumlah_dosen($id_kp);
				$data['mhs'] = $this->kelas_perkuliahan_model->data_kelas_mhs($id_kp);
				$data['nilai'] = $this->nilai_perkuliahan_model->data_nilai($id_kp);
				$data['persentase'] = $this->nilai_perkuliahan_model->data_persentase($id_kp);
				$data['main_view'] = 'Nilai_perkuliahan/detail_nilai_perkuliahan_view';
				$this->load->view('template', $data);
			} else {
			redirect('login');
		}
	}

	public function edit_nilai(){
		if ($this->session->userdata('logged_in') == TRUE) {
				$id_kelas_mhs = $this->uri->segment(3);
				$id_kp = $this->uri->segment(4);

				if($this->session->userdata('level') == 2){
				$username = $this->session->userdata('username');
				 $session = $this->dosen_model->session_dosen($username);
            		$id_dosen = $session->id_dosen;
            		$data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
				$data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
			} 
				$data['persentase'] = $this->nilai_perkuliahan_model->data_persentase($id_kp);
				$data['dnilai'] = $this->nilai_perkuliahan_model->edit_nilai($id_kelas_mhs);
				$data['skala'] = $this->nilai_perkuliahan_model->data_skala_nilai();
				$data['main_view'] = 'Nilai_perkuliahan/input_nilai_view';
				$this->load->view('template', $data);
		} else {
			redirect('login');
		}
	}

	public function get_skala() {
		
		$nilai = $this->input->post('nilai');
		$id_prodi = $this->input->post('id_prodi');
	    $this->nilai_perkuliahan_model->get_skala($nilai, $id_prodi);	
	} 

	public function save_edit_nilai(){
			$id_kelas_mhs = $this->uri->segment(3);
			$id_mahasiswa = $this->uri->segment(4);
			$id_detail_kurikulum = $this->uri->segment(5);

					if ($this->nilai_perkuliahan_model->save_edit_nilai($id_kelas_mhs) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Input nilai berhasil </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            			$id_kp = $this->input->post('id_kp');
            			redirect('nilai_perkuliahan/detail_nilai/'.$id_kp);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit Mahasiswa Gagal </div>');
            			redirect('kelas_perkuliahan');
					}
		}


		public function simpan_persentase(){
			$id_kp = $this->uri->segment(3);

					if ($this->nilai_perkuliahan_model->simpan_persentase($id_kp) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Prrsentase Berhasil Diubah  </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            			redirect('nilai_perkuliahan/detail_nilai/'.$id_kp);
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Edit Mahasiswa Gagal </div>');
            			redirect('nilai_perkuliahan/detail_nilai/'.$id_kp);
					}
		}



}

/* End of file kelas_perkuliahan.php */
/* Location: ./application/controllers/kelas_perkuliahan.php */