<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	 public function simpan_periode()
    {
        $data = array(
            'semester'                        => $this->input->post('semester'),
            'id_prodi'                        => $this->input->post('id_prodi'),
            'target_mhs_baru'                 => $this->input->post('target_mhs_baru'),
            'pendaftar_ikut_seleksi'      	  => $this->input->post('pendaftar_ikut_seleksi'),
            'pendaftar_lulus_seleksi'      		=> $this->input->post('pendaftar_lulus_seleksi'),
            'daftar_ulang'         => $this->input->post('daftar_ulang'),
            'mengundurkan_diri'         => $this->input->post('mengundurkan_diri'),
            'tgl_awal_kul'         => $this->input->post('tgl_awal_kul'),
            'tgl_akhir_kul'         => $this->input->post('tgl_akhir_kul'),
            'jumlah_minggu_pertemuan'         => $this->input->post('jumlah_minggu_pertemuan')
            
        );
    
        $this->db->insert('tb_periode', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }
  public function data_periode(){
    $this->db->select('*');
     $this->db->from('tb_periode');
     $this->db->join('tb_prodi','tb_periode.id_prodi=tb_prodi.id_prodi');
     $this->db->order_by('tb_periode.semester','DESC');
     $query = $this->db->get();
     return $query->result();
    }
  

  public function edit_periode($id_periode){
    $data = array(
            'semester'                        => $this->input->post('semester'),
            'id_prodi'                        => $this->input->post('id_prodi'),
            'target_mhs_baru'                 => $this->input->post('target_mhs_baru'),
            'pendaftar_ikut_seleksi'          => $this->input->post('pendaftar_ikut_seleksi'),
            'pendaftar_lulus_seleksi'         => $this->input->post('pendaftar_lulus_seleksi'),
            'daftar_ulang'         => $this->input->post('daftar_ulang'),
            'mengundurkan_diri'         => $this->input->post('mengundurkan_diri'),
            'tgl_awal_kul'         => $this->input->post('tgl_awal_kul'),
            'tgl_akhir_kul'         => $this->input->post('tgl_akhir_kul'),
            'jumlah_minggu_pertemuan'         => $this->input->post('jumlah_minggu_pertemuan')
      );

    if (!empty($data)) {
            $this->db->where('id_periode', $id_periode)
        ->update('tb_periode', $data);

          return true;
        } else {
            return null;
        }
  }

   public function hapus_periode($id_periode){
        $this->db->where('id_periode', $id_periode)
          ->delete('tb_periode');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }
    
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */