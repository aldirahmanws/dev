<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class nilai_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function data_skala_nilai(){
		return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_skala_nilai.id_prodi')
              ->order_by('nama_prodi','asc')
              ->order_by('bobot_nilai_maksimum','desc')
              ->get('tb_skala_nilai')
              ->result();
	}


  public function filter_nilai($id_prodi){
    $this->db->select('*');
     $this->db->from('tb_skala_nilai');
     $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_skala_nilai.id_prodi');
     $this->db->like('tb_prodi.id_prodi',$id_prodi);
     $query = $this->db->get();
     return $query->result();
  }

	public function detail_skala_nilai($id_du){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_skala_nilai.id_prodi')
              ->where('tb_skala_nilai.id_skala_nilai', $id_du)
              ->get('tb_skala_nilai')
              ->row();
  }

  public function save_skala_nilai()
    {        
        $data = array(
            'id_prodi'      => $this->input->post('id_prodi', TRUE),
            'nilai_huruf'      => $this->input->post('nilai_huruf', TRUE),
            'nilai_indeks'      => $this->input->post('nilai_indeks', TRUE),
            'bobot_nilai_minimum'      => $this->input->post('bobot_nilai_minimum', TRUE),
            'bobot_nilai_maksimum'     => $this->input->post('bobot_nilai_maksimum', TRUE),
            'tanggal_mulai_efektif'     => $this->input->post('tanggal_mulai_efektif', TRUE),
            'tanggal_akhir_efektif'     => $this->input->post('tanggal_akhir_efektif', TRUE)
        );
    
        $this->db->insert('tb_skala_nilai', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function save_edit_skala_nilai($id_tes){
    $data = array(
           'id_prodi'      => $this->input->post('id_prodi', TRUE),
            'nilai_huruf'      => $this->input->post('nilai_huruf', TRUE),
            'nilai_indeks'      => $this->input->post('nilai_indeks', TRUE),
            'bobot_nilai_minimum'      => $this->input->post('bobot_nilai_minimum', TRUE),
            'bobot_nilai_maksimum'     => $this->input->post('bobot_nilai_maksimum', TRUE),
            'tanggal_mulai_efektif'     => $this->input->post('tanggal_mulai_efektif', TRUE),
            'tanggal_akhir_efektif'     => $this->input->post('tanggal_akhir_efektif', TRUE)
          );

    if (!empty($data)) {
            $this->db->where('id_skala_nilai', $id_tes)
        ->update('tb_skala_nilai', $data);

          return true;
        } else {
            return null;
        }
  }

   public function hapus_skala_nilai($id_skala_nilai){
        $this->db->where('id_skala_nilai', $id_skala_nilai)
          ->delete('tb_skala_nilai');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }


}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */