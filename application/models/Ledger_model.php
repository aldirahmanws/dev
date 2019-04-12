<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}


  public function filter_matkul($angkatan, $id_prodi){
    return $this->db->select('tb_matkul.kode_matkul,tb_matkul.nama_matkul,tb_matkul.id_matkul,tb_detail_kurikulum.semester_kurikulum, tb_matkul.bobot_matkul')
              ->distinct()
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_kelas_mhs.id_mahasiswa')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kelas_mhs.id_detail_kurikulum')
              ->join('tb_kurikulum','tb_kurikulum.id_kurikulum=tb_detail_kurikulum.id_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->like('tb_pendidikan.tgl_du', $angkatan)
              ->like('tb_matkul.id_prodi', $id_prodi)
              ->order_by('tb_detail_kurikulum.semester_kurikulum','asc')
              ->order_by('tb_matkul.nama_matkul','asc')
              ->get('tb_kelas_mhs')
              ->result();
  }

  public function filter_mahasiswa($angkatan, $id_prodi){
    return $this->db->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->like('tb_pendidikan.tgl_du', $angkatan)
              ->like('tb_prodi.id_prodi', $id_prodi)
              ->get('tb_mahasiswa')
              ->result();
  }


  public function getProdi(){
     return $this->db->get('tb_prodi')
              ->result();
  }

  public function get_kurikulum_by_prodi($id_prodi){
     return $this->db->where('id_prodi', $id_prodi)
              ->get('tb_kurikulum')
              ->result();
  }




}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */