<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_perkuliahan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

  public function filter_kp($id_prodi, $id_periode){
    $this->db->select('*');
     $this->db->from('tb_kp');
     $this->db->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal');
     $this->db->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang');
     $this->db->join('tb_konsentrasi_kelas','tb_konsentrasi_kelas.id_konsentrasi=tb_jadwal.id_konsentrasi');
     $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi_kelas.id_prodi');
     $this->db->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum');
     $this->db->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul');
     $this->db->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode');
     $this->db->like('tb_prodi.id_prodi',$id_prodi);
     $this->db->like('tb_periode.id_periode',$id_periode);
     $query = $this->db->get();
     return $query->result();
  }

  public function detail_nilai($id_kp){
      return $this->db->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_konsentrasi_kelas','tb_konsentrasi_kelas.id_konsentrasi=tb_jadwal.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi_kelas.id_prodi')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp','left')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen','left')
              ->where('tb_kp.id_kp', $id_kp)
              ->get('tb_kp')
              ->row();
  }

  public function edit_nilai($id_kp){
      return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
               ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
               ->join('tb_konsentrasi_kelas','tb_konsentrasi_kelas.id_konsentrasi=tb_jadwal.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi_kelas.id_prodi')
              ->where('id_kelas_mhs', $id_kp)
              ->get('tb_kelas_mhs')
              ->row();
  }

  public function data_nilai($id_kp){
      return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa','left')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp','left')
              ->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_konsentrasi_kelas','tb_konsentrasi_kelas.id_konsentrasi=tb_jadwal.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi_kelas.id_prodi')
              ->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai','left')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->where('tb_kelas_mhs.id_kp', $id_kp)
              ->get('tb_kelas_mhs')
              ->result();
  }

  public function data_skala_nilai(){
      return $this->db->get('tb_skala_nilai')
              ->result();
  }

  public function get_skala($nilai, $id_prodi){
      $query = $this->db->query("SELECT * FROM tb_skala_nilai WHERE '$nilai' BETWEEN bobot_nilai_minimum AND bobot_nilai_maksimum AND id_prodi LIKE '$id_prodi'")->row();

     //print_r($query);

     $data = array(
            'ea'        => $query->id_skala_nilai,
            
        );
     print_r($data['ea']) ;
     // function save_edit_nilai($id_kelas_mhs, $a);
  }
  

  public function save_edit_nilai($id_kelas_mhs){
    $data = array(
            'id_skala_nilai'        => $this->input->post('id_skala_nilai'),
            'nilai_d'       => $this->input->post('nilai'),
            'id_kp'       => $this->input->post('id_kp'),
            'absensi'       => $this->input->post('absensi'),
            'nilai_tugas'       => $this->input->post('nilai_tugas'),
            'nilai_uts'       => $this->input->post('nilai_uts'),
            'nilai_uas'       => $this->input->post('nilai_uas'),
            'nilai_paper'       => $this->input->post('nilai_paper'),
        );

    if (!empty($data)) {
            $this->db->where('id_kelas_mhs', $id_kelas_mhs)
        ->update('tb_kelas_mhs', $data);

          return true;
        } else {
            return null;
        }
  }

   


}

/* End of file kp_model.php */
/* Location: ./application/models/kp_model.php */