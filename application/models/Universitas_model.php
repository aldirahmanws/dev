<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Universitas_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function data_universitas(){
		return $this->db->get('tb_pt')
              ->result();
	}

  public function save_universitas()
    {        
        $data = array(
            'nama_pt'      => $this->input->post('nama_pt', TRUE)
        );
    
        $this->db->insert('tb_pt', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function edit_universitas($id_pt){
    $data = array(
           'id_pt'      => $this->input->post('id_pt', TRUE),
           'nama_pt'      => $this->input->post('nama_pt', TRUE)
          );

    if (!empty($data)) {
            $this->db->where('id_pt', $id_pt)
        ->update('tb_pt', $data);

          return true;
        } else {
            return null;
        }
  }

   public function hapus_universitas($id_pt){
        $this->db->where('id_pt', $id_pt)
          ->delete('tb_pt');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }


}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */