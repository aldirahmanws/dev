<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biaya_sekolah_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function data_biaya(){
     $this->db->select('*');
     $this->db->from('tb_biaya');
     $this->db->join('tb_waktu','tb_waktu.id_waktu=tb_biaya.id_waktu');
     $query = $this->db->get();
     return $query->result();
	}

   public function get_biaya_by_id($id_biaya){
    $this->db->select('*');
     $this->db->from('tb_biaya');
     $this->db->join('tb_waktu','tb_waktu.id_waktu=tb_biaya.id_waktu');
     $this->db->where('tb_biaya.id_biaya', $id_biaya);
     $query = $this->db->get();
     return $query->row();
  }

	public function get_prodi(){
		return $this->db->get('tb_prodi')->result();
	}
  public function getJenisPembayaran($id){
    $this->db->distinct();
    $this->db->select('tb_biaya.jenis_biaya');
     $this->db->from('tb_biaya');
     $this->db->join('tb_waktu','tb_waktu.id_waktu=tb_biaya.id_waktu');
     $this->db->where('tb_waktu.waktu', $id);
     $query = $this->db->get();
     return $query->result();

    

  }
  public function getTA(){
    $this->db->distinct();
    $this->db->select('periode');
     $this->db->from('tb_biaya');
     $query = $this->db->get();
     return $query->result();

    

  }

	public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_biaya.id_biaya,5) as kode', FALSE);
          $this->db->order_by('id_biaya','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_biaya');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }
          $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "BS".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

    public function save_biaya_sekolah()
    {
        $data = array(
            'id_biaya'        => $this->input->post('id_biaya'),
            'jenis_biaya'        => $this->input->post('jenis_biaya'),
            'nama_biaya'      	=> $this->input->post('nama_biaya'),
            'jumlah_biaya'      		=> $this->input->post('jumlah_biaya'),
            'id_waktu'          => $this->input->post('id_waktu'),
            'periode'          => $this->input->post('periode')
            
        );
    
        $this->db->insert('tb_biaya', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function hapus_biaya($id_biaya){
        $this->db->where('id_biaya', $id_biaya)
          ->delete('tb_biaya');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

   public function getWaktu(){
    return $this->db->get('tb_waktu')
                    ->result();
   }


  public function save_edit_biaya_sekolah($id_biaya){

    $data = array(
       'id_biaya'        => $this->input->post('id_biaya'),
        'nama_biaya'        => $this->input->post('nama_biaya'),
        'jenis_biaya'        => $this->input->post('jenis_biaya'),
        'jumlah_biaya'          => $this->input->post('jumlah_biaya'),
        'id_waktu'          => $this->input->post('id_waktu'),
        'periode'          => $this->input->post('periode')
      );
    if (!empty($data)) {
            $this->db->where('id_biaya', $id_biaya)
        ->update('tb_biaya', $data);

          return true;
        } else {
            return null;
        }
  }

}

/* End of file konsentrasi_model.php */
/* Location: ./application/models/konsentrasi_model.php */