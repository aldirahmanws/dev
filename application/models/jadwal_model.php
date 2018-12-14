<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function data_jadwal(){
		return $this->db->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_jadwal.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_hari','tb_hari.id_hari=tb_jadwal.id_hari')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_jadwal.id_waktu')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->where('tgl_awal_kul <=', date('Y-m-d'))
              ->where('tgl_akhir_kul >=', date('Y-m-d'))
              ->get('tb_jadwal')
              ->result();
	}

  public function detail_jadwal($id_jadwal){
    return $this->db->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_jadwal.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_hari','tb_hari.id_hari=tb_jadwal.id_hari')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_jadwal.id_waktu')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->where('id_jadwal', $id_jadwal)
              ->get('tb_jadwal')
              ->row();
  }

  public function jadwal_mhs($id_prodi){
    return $this->db->join('tb_kp','tb_kp.id_kp=tb_jadwal.id_kp')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->join('tb_hari','tb_hari.id_hari=tb_jadwal.id_hari')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_jadwal.id_waktu')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_kp.id_prodi')
              ->where('id_jadwal', $id_jadwal)
              ->get('tb_jadwal')
              ->row();
  }

  function cek_duplikat($jam_awal, $jam_akhir, $id_hari, $id_kp){
     $query = $this->db->select('*')
                ->from('tb_jadwal')
                ->where('jam_awal <=', $jam_awal)
                ->where('jam_akhir >=', $jam_awal)
                ->where('jam_awal <=', $jam_akhir)
                ->where('jam_akhir >=', $jam_akhir)
                ->where('id_hari', $id_hari)
                ->where('id_kp', $id_kp)
                ->get();
                if ($query->num_rows() > 0)
                {
                    echo '<span class="label label-success"> Jadwal sudah digunakan </span><script>document.getElementById("MyBtn").disabled = true;</script>';

                } else{
                echo '<span class="label label-success"> Klik Simpan </span><script>document.getElementById("MyBtn").disabled = false;</script>';
                
                }
    }

  function filter_ap($id_mahasiswa,$id_periode){

     $this->db->select('*');
     $this->db->from('tb_kelas_mhs');
     $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp');
     $this->db->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum');
     $this->db->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul');
     $this->db->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai');
     $this->db->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode');
     $this->db->like('tb_kelas_mhs.id_mahasiswa',$id_mahasiswa);
     $this->db->like('tb_periode.id_periode',$id_periode);
     $query = $this->db->get();
     return $query->result();
      }


   public function simpan_jadwal()
    {        
        $data = array(
            'id_periode'     => $this->input->post('id_periode', TRUE),
            'id_hari'     => $this->input->post('id_hari', TRUE),
            'jam_awal'     => $this->input->post('jam_awal', TRUE),
            'jam_akhir'      => $this->input->post('jam_akhir', TRUE),
            'id_waktu'      => $this->input->post('id_waktu', TRUE),
            'id_konsentrasi'      => $this->input->post('id_konsentrasi', TRUE),
            'id_detail_kurikulum'      => $this->input->post('id_detail_kurikulum', TRUE),
            'id_ruang'      => $this->input->post('ruang', TRUE)
            
        );
        $this->db->insert('tb_jadwal', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }      

  public function edit_jadwal($id_jadwal){
    $data = array(
            'id_periode'     => $this->input->post('id_periode', TRUE),
            'id_hari'     => $this->input->post('id_hari', TRUE),
            'jam_awal'     => $this->input->post('jam_awal', TRUE),
            'jam_akhir'      => $this->input->post('jam_akhir', TRUE),
            'id_waktu'      => $this->input->post('id_waktu', TRUE),
            'id_konsentrasi'      => $this->input->post('id_konsentrasi', TRUE),
            'id_detail_kurikulum'      => $this->input->post('id_detail_kurikulum', TRUE),
            'id_ruang'      => $this->input->post('id_ruang', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_jadwal', $id_jadwal)
        ->update('tb_jadwal', $data);

          return true;
        } else {
            return null;
        }
  }

   

  public function hapus_jadwal($id_jadwal){
        $this->db->where('id_jadwal', $id_jadwal)
          ->delete('tb_jadwal');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }


}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */