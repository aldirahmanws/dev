<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function data_prodi(){
		return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_prodi.id_dosen')
    ->order_by('id_prodi','ASC')
		->get('tb_prodi')
		->result();
	}

	 public function save_prodi()
    {
        $data = array(
            'id_prodi'        => $this->input->post('id_prodi'),
            'nama_prodi'      	=> $this->input->post('nama_prodi'),
            'id_dosen'      		=> $this->input->post('id_dosen')
            
        );
    
        $this->db->insert('tb_prodi', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }
    
  
    public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_prodi.id_prodi,3) as kode', FALSE);
          $this->db->order_by('id_prodi','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_prodi');      //cek dulu apakah ada sudah ada kode di tabel.    
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
          $kodejadi = "PR".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

    public function hapus_prodi($id_prodi){
        $this->db->where('id_prodi', $id_prodi)
          ->delete('tb_prodi');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function get_prodi_by_id($id_prodi){
      return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_prodi.id_dosen')
              ->where('id_prodi', $id_prodi)
              ->get('tb_prodi')
              ->row();
  }

  public function save_edit_prodi($id_prodi){
    $data = array(
        'id_prodi'        => $this->input->post('id_prodi'),
        'nama_prodi'      => $this->input->post('nama_prodi'),
        'id_dosen'     => $this->input->post('id_dosen')
      );

    if (!empty($data)) {
            $this->db->where('id_prodi', $id_prodi)
        ->update('tb_prodi', $data);

          return true;
        } else {
            return null;
        }
  }
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */