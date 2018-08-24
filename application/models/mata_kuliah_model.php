<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mata_kuliah_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	 public function simpan_matkul()
    {
        $data = array(
            'kode_matkul'           => $this->input->post('kode_matkul'),
            'nama_matkul'           => $this->input->post('nama_matkul'),
            'id_konsentrasi'                 => $this->input->post('id_konsentrasi'),
            'jenis_matkul'      	  => $this->input->post('jenis_matkul'),
            'bobot_matkul'      		=> $this->input->post('bobot_matkul'),
            'bobot_praktikum'         => $this->input->post('bobot_praktikum'),
            'bobot_tatap_muka'         => $this->input->post('bobot_tatap_muka'),
            'bobot_praktik_lapangan'         => $this->input->post('bobot_praktik_lapangan'),
            'bobot_simulasi'         => $this->input->post('bobot_simulasi'),
            'metode_pembelajaran'         => $this->input->post('metode_pembelajaran'),
            'tanggal_mulai'         => $this->input->post('tanggal_mulai'),
            'tanggal_akhir'         => $this->input->post('tanggal_akhir')
            
        );
    
        $this->db->insert('tb_matkul', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

  public function data_matkul(){
   return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_matkul.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_jenis_matkul','tb_jenis_matkul.id_jenis_matkul=tb_matkul.jenis_matkul')
              ->order_by('nama_matkul')
              ->get('tb_matkul')
              ->result();
  }

  public function detail_matkul($kode_matkul){
      return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_matkul.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_jenis_matkul','tb_jenis_matkul.id_jenis_matkul=tb_matkul.jenis_matkul')
              ->where('tb_matkul.kode_matkul', $kode_matkul)
              ->get('tb_matkul')
              ->row();
  }

  public function edit_matkul($id_periode){
    $data = array(
           'kode_matkul'                        => $this->input->post('kode_matkul'),
            'nama_matkul'                        => $this->input->post('nama_matkul'),
            'id_konsentrasi'                 => $this->input->post('id_konsentrasi'),
            'jenis_matkul'            => $this->input->post('jenis_matkul'),
            'bobot_matkul'              => $this->input->post('bobot_matkul'),
            'bobot_praktikum'         => $this->input->post('bobot_praktikum'),
            'bobot_tatap_muka'         => $this->input->post('bobot_tatap_muka'),
            'bobot_praktik_lapangan'         => $this->input->post('bobot_praktik_lapangan'),
            'bobot_simulasi'         => $this->input->post('bobot_simulasi'),
            'metode_pembelajaran'         => $this->input->post('metode_pembelajaran'),
            'tanggal_mulai'         => $this->input->post('tanggal_mulai'),
            'tanggal_akhir'         => $this->input->post('tanggal_akhir')
      );

    if (!empty($data)) {
            $this->db->where('kode_matkul', $id_periode)
        ->update('tb_matkul', $data);

          return true;
        } else {
            return null;
        }
  }

  public function hapus_matkul($kode_matkul){
        $this->db->where('kode_matkul', $kode_matkul)
          ->delete('tb_matkul');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }
    
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */