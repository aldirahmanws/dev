<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
        $this->load->model('dosen_model');
        $this->load->model('mahasiswa_model');
	}
    public function pie_chart(){
        

    }
	public function index()
	{
        if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 4){
			$data['dashboard'] = $this->dashboard_model->dashboard_finance();
             $id_level = $this->session->userdata('level');
            $data['informasi'] = $this->dosen_model->informasi_dosen($id_level);
            $data['main_view'] = 'Finance/dashboard_finance_view';
            $this->load->view('template', $data);
		} else if($this->session->userdata('level') == 3){
            $data['pie'] = $this->dashboard_model->pie_chart();
            $data['dashboard'] = $this->dashboard_model->dashboard_marketing();
            $var1 = $this->dashboard_model->dashboard_marketing_data();
            $var2 = $this->dashboard_model->dashboard_marketing_data2();
            
            $arr = array();
            foreach ($var1 as $results) {
            $date = date("Y-m", strtotime($results->tanggal_pendaftaran));
            $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_pendaftaran WHERE tanggal_pendaftaran like '$date%'")->row();
            $arr[] = array(
                   'waktu' => $date,
                   // 'waktu' => $results->tanggal_pendaftaran,
                   'no_telp' => $total_mahasiswa->total
                    );
            }

            $ea = json_encode($arr);
            $arr2 = array();
            foreach ($var2 as $results) {
            $date2 = $results->tanggal_pendaftaran;
            $total_mahasiswa2 = $this->db->query("SELECT count(*) AS total FROM tb_pendaftaran WHERE tanggal_pendaftaran like '$date2%'")->row();
            $arr2[] = array(
                   'waktu' => $results->tanggal_pendaftaran,
                   // 'waktu' => $results->tanggal_pendaftaran,
                   'no_telp' => $total_mahasiswa2->total
                    );
            }

            $ea2 = json_encode($arr2);

            $data['encode'] = $ea;
            $data['encode2'] = $ea2;
            $id_level = $this->session->userdata('level');
            $data['informasi'] = $this->dosen_model->informasi_dosen($id_level);
            $data['main_view'] = 'Tamu/dashboard_marketing_view';
            $this->load->view('template', $data);
        } else if($this->session->userdata('level') == 6){
            $var1 = $this->dashboard_model->dashboard_marketing_data();
            $var2 = $this->dashboard_model->dashboard_marketing_data2();
            
            $arr = array();
            foreach ($var1 as $results) {
            $date = date("Y-m", strtotime($results->tanggal_pendaftaran));
            $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_pendaftaran WHERE tanggal_pendaftaran like '$date%'")->row();
            $arr[] = array(
                   'waktu' => $date,
                   // 'waktu' => $results->tanggal_pendaftaran,
                   'no_telp' => $total_mahasiswa->total
                    );
            }

            $ea = json_encode($arr);
            $arr2 = array();
            foreach ($var2 as $results) {
            $date2 = $results->tanggal_pendaftaran;
            $total_mahasiswa2 = $this->db->query("SELECT count(*) AS total FROM tb_pendaftaran WHERE tanggal_pendaftaran like '$date2%'")->row();
            $arr2[] = array(
                   'waktu' => $results->tanggal_pendaftaran,
                   // 'waktu' => $results->tanggal_pendaftaran,
                   'no_telp' => $total_mahasiswa2->total
                    );
            }

            $ea2 = json_encode($arr2);
            $data['encode2'] = $ea2;
            $data['pie'] = $this->dashboard_model->pie_chart();
            $data['dashboard'] = $this->dashboard_model->dashboard_akademik();
             $id_level = $this->session->userdata('level');
            $data['informasi'] = $this->dosen_model->informasi_dosen($id_level);
            $data['main_view'] = 'Akademi/dashboard_akademik_view';
            $this->load->view('template', $data);
        } else if($this->session->userdata('level') == 1){
            $var1 = $this->dashboard_model->dashboard_marketing_data();
            $var2 = $this->dashboard_model->dashboard_marketing_data2();
            $arr = array();
            foreach ($var1 as $results) {
            $date = date("Y-m", strtotime($results->tanggal_pendaftaran));
            $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_pendaftaran WHERE tanggal_pendaftaran like '$date%'")->row();
            $arr[] = array(
                   'waktu' => $date,
                   // 'waktu' => $results->tanggal_pendaftaran,
                   'no_telp' => $total_mahasiswa->total
                    );
            }

            $ea = json_encode($arr);
            $arr2 = array();
            foreach ($var2 as $results) {
            $date2 = $results->tanggal_pendaftaran;
            $total_mahasiswa2 = $this->db->query("SELECT count(*) AS total FROM tb_pendaftaran WHERE tanggal_pendaftaran like '$date2%'")->row();
            $arr2[] = array(
                   'waktu' => $results->tanggal_pendaftaran,
                   // 'waktu' => $results->tanggal_pendaftaran,
                   'no_telp' => $total_mahasiswa2->total
                    );
            }

            $ea2 = json_encode($arr2);
            $data['encode2'] = $ea2;
            $data['pie'] = $this->dashboard_model->pie_chart();
            $data['dashboard'] = $this->dashboard_model->dashboard_admin();
             $id_level = $this->session->userdata('level');
            $data['informasi'] = $this->dosen_model->informasi_dosen($id_level);
            $data['main_view'] = 'Admin/dashboard_admin_view';
            $this->load->view('template', $data);
        } else if($this->session->userdata('level') == 5){
            $id_level = $this->session->userdata('level');
            $username = $this->session->userdata('username');
            $session = $this->mahasiswa_model->session_mahasiswa($username);
            $semester_aktif = $session->semester_aktif;
            $id_mahasiswa = $session->id_mahasiswa;
            $id_waktu = $session->id_waktu;
            $data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
            $data['informasi2'] = $this->dashboard_model->notifikasi_pembayaran($id_mahasiswa, $semester_aktif, $id_waktu);
            $data['informasi'] = $this->dosen_model->informasi_dosen($id_level);
            $data['main_view'] = 'Mahasiswa/dashboard_mahasiswa_view';
            $this->load->view('template', $data);
        } else if($this->session->userdata('level') == 2){
            $username = $this->session->userdata('username');
            $id_level = $this->session->userdata('level');
            $session = $this->dosen_model->detail_dosen($username);
            $id_dosen = $session->id_dosen;
            $data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
            $data['informasi'] = $this->dosen_model->informasi_dosen($id_level);
            $data['dashboard'] = $this->dashboard_model->dashboard_dosen($id_dosen);
            $data['main_view'] = 'Dosen/dashboard_dosen_view';
            $this->load->view('template', $data);
        } else {
			redirect(base_url('login'));
		}
        } else {
            redirect('login');
        }
			
	}

}