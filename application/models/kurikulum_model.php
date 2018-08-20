<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	 public function simpan_kurikulum()
    {
        $data = array(
            'id_kurikulum'         => $this->input->post('id_kurikulum'),
            'nama_kurikulum'      => $this->input->post('nama_kurikulum'),
            'id_prodi'                 => $this->input->post('id_prodi'),
            'id_periode'                 => $this->input->post('id_periode'),
            'jumlah_sks'      	  => $this->input->post('jumlah_sks'),
            'bobot_matkul_wajib'      		=> $this->input->post('bobot_matkul_wajib'),
            'bobot_matkul_pilihan'         => $this->input->post('bobot_matkul_pilihan')
            
        );
    
        $this->db->insert('tb_kurikulum', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    /*public function bobot($id_kurikulum){

    $bobot_matkuls = $this->db->query("SELECT SUM(bobot_matkul) AS total FROM tb_detail_kurikulum WHERE id_kurikulum = $id_kurikulum")->row();
    $bobot_btm = $this->db->query("SELECT SUM(btm) AS total FROM tb_detail_kurikulum WHERE id_kurikulum = $id_kurikulum")->row();
    $bobot_bp = $this->db->query("SELECT SUM(bp) AS total FROM tb_detail_kurikulum WHERE id_kurikulum = $id_kurikulum")->row();
    $bobot_bpl = $this->db->query("SELECT SUM(bpl) AS total FROM tb_detail_kurikulum WHERE id_kurikulum = $id_kurikulum")->row();
    $bobot_bs = $this->db->query("SELECT SUM(bs) AS total FROM tb_detail_kurikulum WHERE id_kurikulum = $id_kurikulum")->row();
    $bobot_wajib = $this->db->query("SELECT SUM(bobot_matkul) AS total FROM tb_detail_kurikulum WHERE wajib LIKE 'Y' AND id_kurikulum LIKE $id_kurikulum")->row();
    $bobot_pilihan = $this->db->query("SELECT SUM(bobot_matkul) AS total FROM tb_detail_kurikulum WHERE wajib = 'T'  AND id_kurikulum LIKE $id_kurikulum")->row();


    return array(
      'bobot_matkuls' => $bobot_matkuls->total,
      'bobot_btm' => $bobot_btm->total,
      'bobot_bp' => $bobot_bp->total,
      'bobot_bpl' => $bobot_bpl->total,
      'bobot_bs' => $bobot_bs->total,
      'bobot_wajib' => $bobot_wajib->total,
      'bobot_pilihan' => $bobot_pilihan->total,
      );
      
    } */

    public function autocomplete($nama){
     $this->db->select('*');
     $this->db->from('tb_matkul');
     $this->db->like('tb_matkul.nama_matkul',$nama);
     $query = $this->db->get();
     return $query->result();
  }

    public function simpan_detail_kurikulum()
    {
        $data = array(
            'id_kurikulum'         => $this->input->post('id_kurikulum'),
            'kode_matkul'         => $this->input->post('kode_matkul'),
            'semester_kurikulum'   => $this->input->post('semester_kurikulum'),
            'wajib'                 => $this->input->post('wajib')
        );
    
        $this->db->insert('tb_detail_kurikulum', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

  public function data_kurikulum(){

   return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_kurikulum.id_prodi')
              ->join('tb_periode','tb_periode.id_periode=tb_kurikulum.id_periode')
              ->get('tb_kurikulum')
              ->result();

  }

  public function detail_kurikulum($id_kurikulum){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_kurikulum.id_prodi')
              ->join('tb_periode','tb_periode.id_periode=tb_kurikulum.id_periode')
              ->where('tb_kurikulum.id_kurikulum', $id_kurikulum)
              ->get('tb_kurikulum')
              ->row();
  }

   public function detail_dk($dk){
      return $this->db->join('tb_kurikulum','tb_kurikulum.id_kurikulum=tb_detail_kurikulum.id_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->where('tb_kurikulum.id_kurikulum', $dk)
              ->order_by('semester_kurikulum')
              ->get('tb_detail_kurikulum')
              ->result();
  }

  public function detail_matkul($dk){
      return $this->db->join('tb_kurikulum','tb_kurikulum.id_kurikulum=tb_detail_kurikulum.id_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->where('tb_detail_kurikulum.id_detail_kurikulum', $dk)
              ->get('tb_detail_kurikulum')
              ->row();
  }

  public function get_prodi_periode($data){
      return $this->db->where('tb_periode.id_prodi',$data)
              ->where('tgl_akhir_kul >=',  date('Y-m-d'))
              ->where('tgl_awal_kul <=',  date('Y-m-d'))
              ->get('tb_periode')
              ->result();
  }

  public function get_prodi_periode2($data){
      return $this->db->where('tb_periode.id_prodi',$data)
              ->get('tb_periode')
              ->result();
  }

  public function get_nama_periode($data){
      return $this->db->where('tb_periode.id_periode',$data)
              ->get('tb_periode')
              ->row();
  }

  public function edit_kurikulum($id_kurikulum){
    $data = array(
            'id_kurikulum'         => $this->input->post('id_kurikulum'),
            'nama_kurikulum'      => $this->input->post('nama_kurikulum'),
            'id_prodi'                 => $this->input->post('id_prodi'),
            'id_periode'                 => $this->input->post('id_periode'),
            'jumlah_sks'          => $this->input->post('jumlah_sks'),
            'bobot_matkul_wajib'          => $this->input->post('bobot_matkul_wajib'),
            'bobot_matkul_pilihan'         => $this->input->post('bobot_matkul_pilihan')
      );

    if (!empty($data)) {
            $this->db->where('id_kurikulum', $id_kurikulum)
        ->update('tb_kurikulum', $data);

          return true;
        } else {
            return null;
        }
  }

  public function edit_detail_kurikulum($id_detail_kurikulum){
    $data = array(
            'id_detail_kurikulum'         => $this->input->post('id_detail_kurikulum'),
            'id_kurikulum'         => $this->input->post('id_kurikulum'),
            'kode_matkul'         => $this->input->post('kode_matkul'),
            'semester_kurikulum'   => $this->input->post('semester_kurikulum'),
            'wajib'                 => $this->input->post('wajib')
      );

    if (!empty($data)) {
            $this->db->where('id_detail_kurikulum', $id_detail_kurikulum)
        ->update('tb_detail_kurikulum', $data);

          return true;
        } else {
            return null;
        }
  }

  public function hapus_kurikulum($id_kurikulum){
        $this->db->where('id_kurikulum', $id_kurikulum)
          ->delete('tb_kurikulum');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function hapus_detail_kurikulum($id_kurikulum){
        $this->db->where('id_kurikulum', $id_kurikulum)
          ->delete('tb_detail_kurikulum');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

     public function hapus_matkul_kurikulum($id_detail_kurikulum){
        $this->db->where('id_detail_kurikulum', $id_detail_kurikulum)
          ->delete('tb_detail_kurikulum');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }
    
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */