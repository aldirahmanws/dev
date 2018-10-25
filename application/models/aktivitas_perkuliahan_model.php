<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas_perkuliahan_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function data_aktivitas_perkuliahan(){
		return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_aktivitas_perkuliahan.id_mahasiswa')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_mhs_add','tb_mhs_add.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_periode','tb_periode.id_periode=tb_aktivitas_perkuliahan.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_aktivitas_perkuliahan.id_status')
              ->get('tb_aktivitas_perkuliahan')
              ->result();
	}

  public function filter_data_ap($id_prodi, $id_periode){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_aktivitas_perkuliahan.id_mahasiswa')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_mhs_add','tb_mhs_add.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_periode','tb_periode.id_periode=tb_aktivitas_perkuliahan.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_aktivitas_perkuliahan.id_status')
              ->like('tb_prodi.id_prodi', $id_prodi)
              ->like('tb_aktivitas_perkuliahan.id_periode', $id_periode)
              ->get('tb_aktivitas_perkuliahan')
              ->result();
  }

  function cek_duplikat($id_mahasiswa, $id_periode){
      $query = $this->db->select('*')
                ->from('tb_aktivitas_perkuliahan')
                ->where('id_mahasiswa', $id_mahasiswa)
                ->where('id_periode', $id_periode)
                ->get();
                if ($query->num_rows() > 0)
                {
                    echo '<span class="label label-success"> Data sudah ada dalam daftar </span><script>document.getElementById("MyBtn").disabled = true;</script>';

                } else{
                echo '<span class="label label-success"> Klik Tampilkan </span><script>document.getElementById("MyBtn").disabled = false;</script>';
                
                }
    }

  function filter_ap($id_mahasiswa,$id_periode){

     $this->db->select('*');
     $this->db->from('tb_kelas_mhs');
     $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp');
     $this->db->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal');
     $this->db->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum');
     $this->db->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul');
     $this->db->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai');
     $this->db->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode');
     $this->db->like('tb_kelas_mhs.id_mahasiswa',$id_mahasiswa);
     $this->db->like('tb_periode.id_periode',$id_periode);
     $query = $this->db->get();
     return $query->result();
      }


   public function save_ap()
    {        
        $data = array(
            'id_mahasiswa'      => $this->input->post('id_mahasiswa', TRUE),
            'id_periode'     => $this->input->post('id_periode', TRUE),
            'id_status'     => $this->input->post('id_status_ak', TRUE),
            'ips'     => $this->input->post('ips', TRUE),
            'ipk_ak'      => $this->input->post('ipk_ak', TRUE),
            'sks_semester'      => $this->input->post('sks_semester', TRUE),
            'sks_total'      => $this->input->post('sks_total', TRUE),
            'semester_ak' => $this->input->post('semester_ak', TRUE)
            
        );
        $this->db->insert('tb_aktivitas_perkuliahan', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

    public function save_edit_ap($id_aktivitas){
    $data = array(
            'id_aktivitas'      => $this->input->post('id_aktivitas', TRUE),
            'id_status'     => $this->input->post('id_status_ak', TRUE),
            'ips'     => $this->input->post('ips', TRUE),
            'ipk_ak'      => $this->input->post('ipk_ak', TRUE),
            'sks_semester'      => $this->input->post('sks_semester', TRUE),
            'sks_total'      => $this->input->post('sks_total', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_aktivitas', $id_aktivitas)
        ->update('tb_aktivitas_perkuliahan', $data);

          return true;
        } else {
            return null;
        }
  }

      

  public function update_status($id_mahasiswa){
    $data = array(
            'id_status'      => $this->input->post('id_status_ak', TRUE),
            'semester_aktif'      => $this->input->post('semester_aktif', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_mahasiswa', $data);

          return true;
        } else {
            return null;
        }
  }

   public function update_ipk($id_mahasiswa, $ipk_ak){
    $data = array(
            'id_mahasiswa'      => $this->input->post('id_mahasiswa', TRUE),
            'ipk'      => $this->input->post('ipk_ak', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_mhs_add', $data);

          return true;
        } else {
            return null;
        }
  }


  

  public function getStatus(){
      return $this->db->get('tb_status_mhs')
              ->result();
  } 

   public function getGrade(){
      return $this->db->get('tb_grade')
              ->result();
  } 

  public function detail_ap($id_aktivitas){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_aktivitas_perkuliahan.id_mahasiswa')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_periode','tb_periode.id_periode=tb_aktivitas_perkuliahan.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_aktivitas_perkuliahan.id_status')
              ->where('id_aktivitas', $id_aktivitas)
              ->get('tb_aktivitas_perkuliahan')
              ->row();
  }

  public function data_ipk($id_mahasiswa, $semester_ak){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
              ->where('tb_detail_kurikulum.semester_kurikulum >=' , '1')
              ->where('tb_detail_kurikulum.semester_kurikulum <=', $semester_ak)
              ->get('tb_kelas_mhs')
              ->result();
  }


}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */