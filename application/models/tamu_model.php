<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

  public function getUniversitas(){
    return $this->db->get('tb_pt')->result();
  }

	public function data_tamu(){
		return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah','left')
              ->join('tb_pt','tb_pt.id_pt=tb_pendaftaran.id_pt','left')
		          ->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_pendaftaran.id_waktu')
              ->join('tb_sumber','tb_sumber.id_sumber=tb_pendaftaran.id_sumber')
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_pendaftaran.id_status')
              ->where('tb_pendaftaran.id_status !=', 1)
              ->order_by('tb_pendaftaran.id_pendaftaran','DESC')
		          ->get('tb_pendaftaran')
		          ->result();
	}

  public function data_tamu_out(){
    $this->db->select('*');
     $this->db->from('tb_pendaftaran');
     $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah','left');
     $this->db->join('tb_pt','tb_pt.id_pt=tb_pendaftaran.id_pt','left');
     $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi');
     $this->db->where('id_status',2);
     $this->db->order_by('tb_pendaftaran.id_pendaftaran', 'DESC');
     $query = $this->db->get();
     return $query->result();
  }

  public function data_sgs(){
    $this->db->select('*');
     $this->db->from('tb_pendaftaran');
    $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_pendaftaran.sgs');
    $this->db->where('id_sumber', 4);
    $this->db->order_by('tb_mahasiswa.id_mahasiswa', 'DESC');
     $query = $this->db->get();
     return $query->result();
  }

  public function get_tamu_by_id($id_pendaftaran){
      return $this->db->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
  }

  public function detail_tamu($id_mahasiswa){
    return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah','left')
            ->join('tb_pt','tb_pt.id_pt=tb_pendaftaran.id_pt','left')
            ->join('tb_waktu','tb_waktu.id_waktu=tb_pendaftaran.id_waktu')
            ->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi')
            ->join('tb_sumber','tb_sumber.id_sumber=tb_pendaftaran.id_sumber')
            ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_pendaftaran.jk_pendaftar')
            ->where('id_pendaftaran', $id_mahasiswa)
            ->get('tb_pendaftaran')
            ->row();
  }

	public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_pendaftaran.id_pendaftaran,4) as kode', FALSE);
          $this->db->order_by('id_pendaftaran','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_pendaftaran');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }
          $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "TM".$kodemax;    // hasilnya ODJ-991-0001 dst.
          return $kodejadi; 
    }

    public function save_tamu()
    {
        $data = array(
            'id_pendaftaran'      => $this->input->post('id_pendaftaran', TRUE),
            'nama_pendaftar'      => $this->input->post('nama_pendaftar', TRUE),
            'id_sekolah'      => $this->input->post('id_sekolah', TRUE),
            'id_pt'      => $this->input->post('id_pt', TRUE),
            'jurusan'      => $this->input->post('jurusan', TRUE),
            'alamat'     => $this->input->post('alamat', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'no_telp'     => $this->input->post('no_telp', TRUE),
            'tanggal_pendaftaran'     => date('Y-m-d'),
            'id_status'     => '22',
            'id_waktu'     => $this->input->post('waktu', TRUE),
            'jk_pendaftar' => $this->input->post('jk_pendaftar', TRUE),
            'id_sumber' => $this->input->post('sumber', TRUE),
            'id_prodi' => $this->input->post('id_prodi', TRUE),
            'sgs' => $this->input->post('student')
            
        );
    
        $this->db->insert('tb_pendaftaran', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function hapus_tamu($id_tamu){
        $this->db->where('id_pendaftaran', $id_tamu)
          ->delete('tb_pendaftaran');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

  
  public function save_bukti_transfer($upload_bukti, $id_pendaftaran)
   {
    $data = array('id_status'     => '23',
      'bukti_transfer' => $upload_bukti['file_name'] )
                  ;
    $this->db->where('id_pendaftaran', $id_pendaftaran)->update('tb_pendaftaran', $data);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  } 

  public function save_update_status2($id_pendaftaran){
    $data = array(
       'id_status'     => '1'
      );

    $this->db->where('id_du', $id_pendaftaran)
        ->update('tb_pendaftaran', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function save_edit_tamu($id_pendaftaran){
    $data = array(
            'id_pendaftaran'      => $this->input->post('id_pendaftaran', TRUE),
            'nama_pendaftar'      => $this->input->post('nama_pendaftar', TRUE),
            'id_sekolah'      => $this->input->post('id_sekolah', TRUE),
            'id_pt'      => $this->input->post('id_pt', TRUE),
            'jurusan'      => $this->input->post('jurusan', TRUE),
            'alamat'     => $this->input->post('alamat', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'no_telp'     => $this->input->post('no_telp', TRUE),
            'id_waktu'     => $this->input->post('id_waktu', TRUE),
            'jk_pendaftar' => $this->input->post('jk_pendaftar', TRUE),
            'id_sumber' => $this->input->post('id_sumber', TRUE),
            'id_prodi' => $this->input->post('id_prodi', TRUE),
            'sgs' => $this->input->post('sgs', TRUE),
      );

    if (!empty($data)) {
            $this->db->where('id_pendaftaran', $id_pendaftaran)
        ->update('tb_pendaftaran', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_f1($no_du){

    $data = array(
            'f1'      => $this->input->post('f1', TRUE),
            'f2'      => $this->input->post('f2', TRUE),
            'f3'      => $this->input->post('f3', TRUE),
            'notes'      => $this->input->post('notes', TRUE),
            'id_status'      => $this->input->post('id_status')
      );

    if (!empty($data)) {
            $this->db->where('id_pendaftaran', $no_du)
        ->update('tb_pendaftaran', $data);

          return true;
        } else {
            return null;
        }
  }

  


}

/* End of file konsentrasi_model.php */
/* Location: ./application/models/konsentrasi_model.php */