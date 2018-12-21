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
     $this->db->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu');
     $this->db->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode');
     $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi');
     $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi');
     $this->db->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum');
     $this->db->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul');
     //$this->db->where('tgl_awal_kul <=', date('Y-m-d'));
     //$this->db->where('tgl_akhir_kul >=', date('Y-m-d'));
     $this->db->like('tb_prodi.id_prodi',$id_prodi);
     $this->db->like('tb_periode.id_periode',$id_periode);
     $query = $this->db->get();
     return $query->result();
  }

  public function detail_nilai($id_kp){
      return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
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
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
               ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
               ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->where('id_kelas_mhs', $id_kp)
              ->get('tb_kelas_mhs')
              ->row();
  }

  public function data_nilai($id_kp){
      return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa','left')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp','left')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai','left')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->where('tb_kelas_mhs.id_kp', $id_kp)
              ->get('tb_kelas_mhs')
              ->result();
  }

  public function data_skala_nilai(){
      return $this->db->get('tb_skala_nilai')
              ->result();
  }

  public function get_skala($nilai, $id_prodi){
    $query = $this->db->select('*')
              ->where('bobot_nilai_minimum <=', $nilai)
              ->where('bobot_nilai_maksimum >=', $nilai)
              ->where('id_prodi', $id_prodi)
              ->where('tanggal_mulai_efektif <=', date('Y-m-d'))
              ->where('tanggal_akhir_efektif >=', date('Y-m-d'))
              ->get('tb_skala_nilai')
              ->row();

     $data = array(
            'ea'        => $query->id_skala_nilai,
            
        );
     print_r($data['ea']) ;
     // function save_edit_nilai($id_kelas_mhs, $a);
  }

  public function get_skala_tes($nilai){
    $query = $this->db->select('*')
              ->where('grade_awal <=', $nilai)
              ->where('grade_akhir >=', $nilai)
              ->like('ket', '1')
              ->where('tgl_awal_grade <=', date('Y-m-d'))
              ->where('tgl_akhir_grade >=', date('Y-m-d'))
              ->get('tb_grade')
              ->row();

     $data = array(
            'ea'        => $query->id_grade,
            
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