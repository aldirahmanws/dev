<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
        $this->load->model('dosen_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('surat_model');
        ini_set('display_errors', 0);
	}
    public function pie_chart(){
        
        $this->load->view('pie_chart');
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
        } elseif ($this->session->userdata('username') == 'zahroh.dhoffir') {
            $data['dashboard'] = $this->surat_model->dashboard_surat();
                $data['main_view'] = 'Surat/dashboard_sisp_view';
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
                   // 'waktu' => $results->tgl_du,
                   'no_telp' => $total_mahasiswa->total
                    );
            }

            $ea = json_encode($arr);
            $arr2 = array();
            foreach ($var2 as $results) {
            $date2 = $results->tgl_du;
            $total_mahasiswa2 = $this->db->query("SELECT count(*) AS total FROM tb_mahasiswa JOIN tb_pendidikan ON tb_pendidikan.id_mahasiswa = tb_mahasiswa.id_mahasiswa WHERE tgl_du like '$date2%'")->row();
            $arr2[] = array(
                   'waktu' => $results->tgl_du,
                   // 'waktu' => $results->tgl_du,
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
            $var2 = $this->dashboard_model->dashboard_marketing_data2();
            

            $arr2 = array();
            foreach ($var2 as $results) {
            $date2 = $results->tgl_du;
            $total_mahasiswa2 = $this->db->query("SELECT count(*) AS total FROM tb_mahasiswa JOIN tb_pendidikan ON tb_pendidikan.id_mahasiswa = tb_mahasiswa.id_mahasiswa WHERE tgl_du like '$date2%'")->row();
            $arr2[] = array(
                   'waktu' => $results->tgl_du,
                   // 'waktu' => $results->tgl_du,
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
            $var2 = $this->dashboard_model->dashboard_marketing_data2();
            
            $arr2 = array();
            foreach ($var2 as $results) {
            $date2 = $results->tgl_du;
            $total_mahasiswa2 = $this->db->query("SELECT count(*) AS total FROM tb_mahasiswa JOIN tb_pendidikan ON tb_pendidikan.id_mahasiswa = tb_mahasiswa.id_mahasiswa WHERE tgl_du like '$date2%'")->row();
            $arr2[] = array(
                   'waktu' => $results->tgl_du,
                   // 'waktu' => $results->tgl_du,
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

            $semester_aktivtas = $this->db->query("SELECT * FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' ORDER BY semester_ak asc")->result();        

            $arr2 = array();
            foreach ($semester_aktivtas as $results) {
            $semester = $results->semester_ak;
            $ipk_mahasiswa = $this->db->query("SELECT max(ipk_ak) as ipk FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = '$semester'")->row();

            $arr2[] = array($results->semester_ak , $ipk_mahasiswa->ipk

                    );
            }
           

            $ea2 = json_encode($arr2);

            $arr3 = array();
            foreach ($semester_aktivtas as $papa) {
             $semester_ips = $papa->semester_ak;
             $ips_mahasiswa = $this->db->query("SELECT max(ips) as ipss FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = '$semester_ips'")->row();

             $arr3[] = array($papa->semester_ak , $ips_mahasiswa->ipss

                    );

            }

            $ea3 = json_encode($arr3);

            $data['encode2'] = $ea2;
            $data['encode3'] = $ea3;
            $data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
            $data['informasi2'] = $this->dashboard_model->notifikasi_pembayaran($id_mahasiswa, $semester_aktif, $id_waktu);
            $data['senin'] = $this->mahasiswa_model->jadwal_mhs_senin($id_mahasiswa);
            $data['selasa'] = $this->mahasiswa_model->jadwal_mhs_selasa($id_mahasiswa);
            $data['rabu'] = $this->mahasiswa_model->jadwal_mhs_rabu($id_mahasiswa);
            $data['kamis'] = $this->mahasiswa_model->jadwal_mhs_kamis($id_mahasiswa);
            $data['jumat'] = $this->mahasiswa_model->jadwal_mhs_jumat($id_mahasiswa);
            $data['dashboard'] = $this->dashboard_model->dashboard_admin();
            $data['informasi'] = $this->dosen_model->informasi_dosen($id_level);
            $data['main_view'] = 'Mahasiswa/dashboard_mahasiswa_view';
            $this->load->view('template', $data);
        } else if($this->session->userdata('level') == 2){
            $username = $this->session->userdata('username');
            $id_level = $this->session->userdata('level');
            $session = $this->dosen_model->session_dosen($username);
          
                $id_dosen = $session->id_dosen;
            $data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
            $data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
            $data['informasi'] = $this->dosen_model->informasi_dosen($id_level);
            $data['dashboard'] = $this->dashboard_model->dashboard_dosen($id_dosen);
            $data['main_view'] = 'Dosen/dashboard_dosen_view';
            $this->load->view('template', $data);
            
            
        } else if($this->session->userdata('level') == 7){
            redirect('login/blank');
            
        } else {
            redirect(base_url('login'));
        }
        } else {
            redirect('login');
        }
            
    }
}