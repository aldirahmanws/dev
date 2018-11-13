<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kepuasan_model extends CI_Model {

      

  	public function __construct()
  	{
  		parent::__construct();
  	}
    public function get_kepuasan(){
        return $this->db->select('tb_kepuasan.id_prodi, nama_prodi, tb_kepuasan.id_periode, semester, tb_kepuasan.id_dosen, nama_dosen, tb_kepuasan.kode_matkul, nama_matkul, jml_pertanyaan, jml_mahasiswa, total_nilai_5, total_nilai_4, total_nilai_3, total_nilai_2, total_nilai_1, id_kepuasan')
                        ->join('tb_prodi', 'tb_prodi.id_prodi = tb_kepuasan.id_prodi', 'left')
                        ->join('tb_periode', 'tb_periode.id_periode =tb_kepuasan.id_periode' ,'left')
                        ->join('tb_dosen', 'tb_dosen.id_dosen = tb_kepuasan.id_dosen', 'left')
                        ->join('tb_matkul', 'tb_matkul.kode_matkul = tb_kepuasan.kode_matkul', 'left')
                        ->get('tb_kepuasan')->result();
    }
    public function get_prodi(){
        return $this->db->get('tb_prodi')->result();
    }
    public function get_dosen(){
        return $this->db->get('tb_dosen')->result();
    }
    public function get_periode(){
        return $this->db->get('tb_periode')->result();
    }
    public function get_matkul(){
        return $this->db->get('tb_matkul')->result();
    }
    //===================================================================================\\
    //===================================================================================\\
    public function add_kepuasan()
    {
        $data = array(
            'id_prodi'                        => $this->input->post('id_prodi'),
            'id_periode'                        => $this->input->post('id_periode'),
            'id_dosen'                        => $this->input->post('id_dosen'),
            'kode_matkul'                        => $this->input->post('kode_matkul'),
            'jml_pertanyaan'                        => $this->input->post('jml_pertanyaan'),
            'jml_mahasiswa'                        => $this->input->post('jml_mahasiswa'),
            'total_nilai_5'                        => $this->input->post('total_nilai_5'),
            'total_nilai_4'                        => $this->input->post('total_nilai_4'),
            'total_nilai_3'                        => $this->input->post('total_nilai_3'),
            'total_nilai_2'                        => $this->input->post('total_nilai_2'),
            'total_nilai_1'                        => $this->input->post('total_nilai_1')
        );
    
        $this->db->insert('tb_kepuasan', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }
    public function edit_kepuasan(){
        $data = array(
            'id_prodi'                        => $this->input->post('id_prodi'),
            'id_periode'                        => $this->input->post('id_periode'),
            'id_dosen'                        => $this->input->post('id_dosen'),
            'kode_matkul'                        => $this->input->post('kode_matkul'),
            'jml_pertanyaan'                        => $this->input->post('jml_pertanyaan'),
            'jml_mahasiswa'                        => $this->input->post('jml_mahasiswa'),
            'total_nilai_5'                        => $this->input->post('total_nilai_5'),
            'total_nilai_4'                        => $this->input->post('total_nilai_4'),
            'total_nilai_3'                        => $this->input->post('total_nilai_3'),
            'total_nilai_2'                        => $this->input->post('total_nilai_2'),
            'total_nilai_1'                        => $this->input->post('total_nilai_1')
        );

        if (!empty($data)) {
                $this->db->where('id_kepuasan', $this->input->post('id_kepuasan'))
            ->update('tb_kepuasan', $data);

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