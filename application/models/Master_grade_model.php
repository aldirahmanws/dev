<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_grade_model extends CI_Model {

      

  	public function __construct()
  	{
  		parent::__construct();
  	}
    //===================================================================================\\
    //===================================================================================\\
    public function add_grade()
    {
        $data = array(
            'grade'                        => $this->input->post('grade'),
            'diskon'                        => $this->input->post('diskon'),
            'grade_awal'                        => $this->input->post('grade_awal'),
            'grade_akhir'                        => $this->input->post('grade_akhir'),
            'tgl_awal_grade'                        => $this->input->post('tgl_awal_grade'),
            'tgl_akhir_grade'                        => $this->input->post('tgl_akhir_grade')
        );
    
        $this->db->insert('tb_grade', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }
    public function edit_grade(){
        $data = array(
            'grade'                        => $this->input->post('grade'),
            'diskon'                        => $this->input->post('diskon'),
            'grade_awal'                        => $this->input->post('grade_awal'),
            'grade_akhir'                        => $this->input->post('grade_akhir'),
            'tgl_awal_grade'                        => $this->input->post('tgl_awal_grade'),
            'tgl_akhir_grade'                        => $this->input->post('tgl_akhir_grade')
        );

        if (!empty($data)) {
                $this->db->where('id_grade', $this->input->post('id_grade'))
            ->update('tb_grade', $data);

              return true;
            } else {
                return null;
            }
    }
    //===================================================================================\\
    //===================================================================================\\
    

}

/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */