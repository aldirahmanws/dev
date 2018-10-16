<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_model extends CI_Model {

    

	public function __construct()
	{
		parent::__construct();
	}

	public function data_dosen(){
		return $this->db->join('tb_status_mhs','tb_status_mhs.id_status=tb_dosen.status')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->get('tb_dosen')
              ->result();
	}

  public function detail_dosen($id_dosen){
    return $this->db->join('tb_status_mhs','tb_status_mhs.id_status=tb_dosen.status')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_user','tb_user.username=tb_dosen.id_dosen')
              ->where('id_dosen', $id_dosen)
              ->get('tb_dosen')
              ->row();
  }

  public function informasi_dosen($id_level){
    $this->db->select('penerima.nama_level as penerimah, pengirim.nama_level as pengirimh, tb_informasi.judul_info, tb_informasi.deskripsi_info,tb_informasi.id_info, tb_informasi.pengirim, tb_informasi.penerima, tb_informasi.tgl_info');
     $this->db->from('tb_informasi');
     $this->db->join('tb_jabatan AS penerima','penerima.id_level=tb_informasi.penerima');
    $this->db->join('tb_jabatan AS pengirim','pengirim.id_level=tb_informasi.pengirim');
     $this->db->where('tb_informasi.penerima', $id_level);
     $this->db->limit('1');
     $this->db->order_by('id_info','DESC');
     $query = $this->db->get();
     return $query->result();
  }

  public function foto_dosen($id_dosen){
    return $this->db->where('username', $id_dosen)
              ->get('tb_user')
              ->row();
  }

  public function  buat_kode_dosen()   {
          $this->db->SELECT('RIGHT(tb_dosen.id_dosen,4) as kode', FALSE);
          $this->db->order_by('id_dosen','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_dosen');      //cek dulu apakah ada sudah ada kode di tabel.    
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
          $kodejadi = "DO".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

 

	 public function save_dosen()
    {
        $data = array(
            'id_dosen'        => $this->input->post('id_dosen'),
            'nama_dosen'        => $this->input->post('nama_dosen'),
            'no_hp'      		=> $this->input->post('no_telepon'),
            'nip'     	=> $this->input->post('nip'),
            'tgl_lahir'       => $this->input->post('tanggal_lahir'),
            'status'       => '1',
            'email'       => $this->input->post('email'),
            'jenis_dosen'       => $this->input->post('jenis_dosen'),
            'id_agama'       => $this->input->post('agama'),
            'id_kelamin'       => $this->input->post('jenis_kelamin'),
            'alamat'       => $this->input->post('alamat'),
            'nidn'       => $this->input->post('nidn'),

        );
    
        $this->db->insert('tb_dosen', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

     /*public function  buat_kode_dosen()   {
          $this->db->select("MAX(id_dosen)+1 AS id");
          $this->db->from("tb_dosen");
          $query = $this->db->get();

          return $query->row()->id;
    }  */

    public function edit_dosen($id_dosen){
    $data = array(
            'id_dosen'        => $this->input->post('id_dosen'),
            'nama_dosen'        => $this->input->post('nama_dosen'),
            'no_hp'         => $this->input->post('no_telepon'),
            'nip'       => $this->input->post('nip'),
            'tgl_lahir'       => $this->input->post('tanggal_lahir'),
            'status'       => '1',
            'email'       => $this->input->post('email'),
            'jenis_dosen'       => $this->input->post('jenis_dosen'),
            'id_agama'       => $this->input->post('agama'),
            'id_kelamin'       => $this->input->post('jenis_kelamin'),
            'alamat'       => $this->input->post('alamat'),
            'nidn'       => $this->input->post('nidn'),
      );

   if (!empty($data)) {
            $this->db->where('id_dosen', $id_dosen)
        ->update('tb_dosen', $data);

          return true;
        } else {
            return null;
        }
  }

  public function edit_username($id_dosen){
    $data = array(
            'username'        => $this->input->post('id_dosen'),
      );

   if (!empty($data)) {
            $this->db->where('username', $id_dosen)
        ->update('tb_user', $data);

          return true;
        } else {
            return null;
        }
  }

  public function jadwal_dosen_senin($id_dosen){
    return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '1')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->get('tb_kelas_dosen')
              ->result();
  }

  public function jadwal_dosen_selasa($id_dosen){
    return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '2')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->get('tb_kelas_dosen')
              ->result();
  }

  public function jadwal_dosen_rabu($id_dosen){
    return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '3')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->get('tb_kelas_dosen')
              ->result();
  }

  public function jadwal_dosen_kamis($id_dosen){
    return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '4')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->get('tb_kelas_dosen')
              ->result();
  }

  public function jadwal_dosen_jumat($id_dosen){
    return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '5')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->get('tb_kelas_dosen')
              ->result();
  }

  public function hapus_dosen($id_dosen){
        $this->db->where('id_dosen', $id_dosen)
          ->delete('tb_dosen');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function data_kp($id_dosen){

   $this->db->select('*');
     $this->db->from('tb_kp');
     $this->db->join('tb_jadwal','tb_jadwal.id_jadwal=tb_kp.id_jadwal');
     $this->db->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang');
     $this->db->join('tb_konsentrasi_kelas','tb_konsentrasi_kelas.id_konsentrasi=tb_jadwal.id_konsentrasi');
     $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi_kelas.id_prodi');
     $this->db->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum');
     $this->db->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul');
     $this->db->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp','left');
     $this->db->where('tb_kelas_dosen.id_dosen', $id_dosen);
     $query = $this->db->get();
     return $query->result();
  }

	

}

/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */