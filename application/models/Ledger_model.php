<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ledger_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}


  public function filter_matkul($kurikulum){
    return $this->db->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_kurikulum','tb_kurikulum.id_kurikulum=tb_detail_kurikulum.id_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->like('tb_kurikulum.nama_kurikulum', $kurikulum)
              ->get('tb_kp')
              ->result();
  }

  public function filter_mahasiswa($angkatan, $id_prodi){
    return $this->db->join('tb_mhs_add','tb_mhs_add.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->like('tb_mhs_add.tgl_du', $angkatan)
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