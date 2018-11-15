<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asal_sekolah_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_asal_sekolah(){
		return $this->db->get('tb_sekolah')->result();
	}

  public function get_asal_sekolah_by_id($id_sekolah){
      return $this->db->where('id_sekolah', $id_sekolah)
              ->get('tb_sekolah')
              ->row();
  }

	public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_sekolah.id_sekolah,3) as kode', FALSE);
          $this->db->order_by('id_sekolah','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_sekolah');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }
          $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "SE".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

     public function save_asal_sekolah()
    {
        $data = array(
            'id_sekolah'        => $this->input->post('id_sekolah'),
            'nama_sekolah'        => $this->input->post('nama_sekolah'),
            'alamat_sekolah'         => $this->input->post('alamat_sekolah'),
            'jenis_sekolah'         => $this->input->post('jenis_sekolah'),
            
        );
    
        $this->db->insert('tb_sekolah', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }
 public function hapus_asal_sekolah($id_sekolah){
        $this->db->where('id_sekolah', $id_sekolah)
          ->delete('tb_sekolah');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

  public function save_edit_asal_sekolah($id_sekolah){
    $data = array(
       'id_sekolah'        => $this->input->post('id_sekolah'),
        'nama_sekolah'        => $this->input->post('nama_sekolah'),
        'alamat_sekolah'         => $this->input->post('alamat_sekolah'),
        'jenis_sekolah'         => $this->input->post('jenis_sekolah'),
      );

    if (!empty($data)) {
            $this->db->where('id_sekolah', $id_sekolah)
        ->update('tb_sekolah', $data);

          return true;
        } else {
            return null;
        }
  }

    
}

/* End of file konsentrasi_model.php */
/* Location: ./application/models/konsentrasi_model.php */