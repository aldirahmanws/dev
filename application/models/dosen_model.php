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
              ->order_by('tb_dosen.nama_dosen')
              ->get('tb_dosen')
              ->result();
	}

  public function detail_dosen($id_dosen){
    return $this->db->join('tb_status_mhs','tb_status_mhs.id_status=tb_dosen.status','left')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->where('tb_dosen.id_dosen', $id_dosen)
              ->get('tb_dosen')
              ->row();
  }

  public function session_dosen($username){
    return $this->db->like('tb_dosen.email', $username)
              ->get('tb_dosen')
              ->row();
  }

  public function foto_dosen($username){
    return $this->db->like('username', $username)
              ->get('tb_user')
              ->row();
  }

  public function detail_dosen2($id_dosen){
    return $this->db->select('tb_dosen.id_dosen')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_prodi.id_dosen')
              ->where('tb_prodi.id_dosen', $id_dosen)
              ->get('tb_prodi')
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

 

	 public function save_dosen($upload)
    {
        $data = array(
            'id_dosen'        => $this->buat_kode_dosen(),
            'nama_dosen'        => $this->input->post('nama_dosen'),
            'no_hp'      		=> $this->input->post('no_telepon'),
            'nip'     	=> $this->input->post('nip'),
            'tgl_lahir'       => $this->input->post('tanggal_lahir'),
            'tpt_lahir_dosen'       => $this->input->post('tempat_lahir'),
            'status'       => '1',
            'email'       => $this->input->post('email'),
            'jenis_dosen'       => $this->input->post('jenis_dosen'),
            'id_agama'       => $this->input->post('agama'),
            'id_kelamin'       => $this->input->post('jenis_kelamin'),
            'alamat'       => $this->input->post('alamat'),
            'nidn'       => $this->input->post('nidn'),
            'foto_dosen'         => $upload['file_name'],

        );
    
        $this->db->insert('tb_dosen', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function edit_dosen($id_dosen,$upload){
    $data = array(
            'id_dosen'        => $this->input->post('id_dosen'),
            'nama_dosen'        => $this->input->post('nama_dosen'),
            'no_hp'         => $this->input->post('no_telepon'),
            'nip'       => $this->input->post('nip'),
            'tgl_lahir'       => $this->input->post('tanggal_lahir'),
            'tpt_lahir_dosen'       => $this->input->post('tempat_lahir'),
            'status'       => '1',
            'email'       => $this->input->post('email'),
            'jenis_dosen'       => $this->input->post('jenis_dosen'),
            'id_agama'       => $this->input->post('agama'),
            'id_kelamin'       => $this->input->post('jenis_kelamin'),
            'alamat'       => $this->input->post('alamat'),
            'nidn'       => $this->input->post('nidn'),
      );

    $data2 = array('foto_dosen' => $upload['file_name'] );
    if (!empty($data)) {
            $this->db->where('id_dosen', $id_dosen)
        ->update('tb_dosen', $data);
        if($upload['file_name'] != null){
            $this->db->where('id_dosen', $id_dosen)
            ->update('tb_dosen', $data2);

        }
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
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '1')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->order_by('tb_jadwal.jam_awal','ASC')
              ->get('tb_kelas_dosen')
              ->result();
  }

  public function jadwal_dosen_selasa($id_dosen){
   return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '2')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->order_by('tb_jadwal.jam_awal','ASC')
              ->get('tb_kelas_dosen')
              ->result();
  }

  public function jadwal_dosen_rabu($id_dosen){
    return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '3')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->order_by('tb_jadwal.jam_awal','ASC')
              ->get('tb_kelas_dosen')
              ->result();
  }

  public function jadwal_dosen_kamis($id_dosen){
    return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '4')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->order_by('tb_jadwal.jam_awal','ASC')
              ->get('tb_kelas_dosen')
              ->result();
  }

  public function jadwal_dosen_jumat($id_dosen){
    return $this->db->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->join('tb_status_dosen','tb_status_dosen.id_status_dosen=tb_dosen.jenis_dosen')
              ->join('tb_agama','tb_agama.id_agama=tb_dosen.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_dosen.id_kelamin')
              ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->where('tb_jadwal.id_hari', '5')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->order_by('tb_jadwal.jam_awal','ASC')
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
     $this->db->from('tb_kelas_dosen');
     $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp');
     $this->db->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode');
     $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi');
     $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi');
     $this->db->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum');
     $this->db->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul');
     $this->db->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu');
     $this->db->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'));
     $this->db->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'));
     $this->db->where('tb_kelas_dosen.id_dosen', $id_dosen);
     $query = $this->db->get();
     return $query->result();
  }

  public function aktivitas_mengajar($id_dosen){
    return $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu')
              ->where('tb_kelas_dosen.id_dosen', $id_dosen)
              ->order_by('tb_periode.semester','desc')
              ->order_by('tb_matkul.nama_matkul','ASC')
              ->get('tb_kelas_dosen')
              ->result();
  }

   public function jabatan_fungsional($id_dosen){
    return $this->db->where('tb_jabatan_fungsional.id_dosen', $id_dosen)
              ->get('tb_jabatan_fungsional')
              ->result();
  }

  public function tambah_jabatan_fungsional($id_dosen)
    {
        $data = array(
            'id_dosen'        => $id_dosen,
            'nama_jabatan'        => $this->input->post('nama_jabatan'),
            'sk_jabatan'         => $this->input->post('sk_jabatan'),
            'tmt_jabatan'       => $this->input->post('tmt_jabatan')

        );
    
        $this->db->insert('tb_jabatan_fungsional', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function hapus_jabatan_fungsional($id_jabatan_fungsional){
        $this->db->where('id_jf', $id_jabatan_fungsional)
          ->delete('tb_jabatan_fungsional');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function pendidikan($id_dosen){
    return $this->db->where('id_dosen', $id_dosen)
              ->get('tb_pendidikan_dosen')
              ->result();
  }

  public function tambah_pendidikan($id_dosen)
    {
        $data = array(
            'id_dosen'        => $id_dosen,
            'bidang_studi'        => $this->input->post('bidang_studi'),
            'jenjang'         => $this->input->post('jenjang'),
            'gelar'       => $this->input->post('gelar'),
            'perguruan_tinggi'       => $this->input->post('perguruan_tinggi'),
            'fakultas'       => $this->input->post('fakultas'),
            'tahun_lulus'       => $this->input->post('tahun_lulus'),

        );
    
        $this->db->insert('tb_pendidikan_dosen', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function hapus_pendidikan($id_pd){
        $this->db->where('id_pd', $id_pd)
          ->delete('tb_pendidikan_dosen');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function pelatihan($id_dosen){
    return $this->db->where('id_dosen', $id_dosen)
              ->get('tb_pelatihan_dosen')
              ->result();
  }

  public function tambah_pelatihan($id_dosen)
    {
        $data = array(
            'id_dosen'        => $id_dosen,
            'nama_pelatihan'        => $this->input->post('nama_pelatihan'),
            'jenis_pelatihan'         => $this->input->post('jenis_pelatihan'),
            'lokasi_pelatihan'       => $this->input->post('lokasi_pelatihan'),
            'tgl_awal_pelatihan'       => $this->input->post('tgl_awal_pelatihan'),
            'tgl_akhir_pelatihan'       => $this->input->post('tgl_akhir_pelatihan'),
        );
    
        $this->db->insert('tb_pelatihan_dosen', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function hapus_pelatihan($id_pelatihan){
        $this->db->where('id_pelatihan', $id_pelatihan)
          ->delete('tb_pelatihan_dosen');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function sertifikasi($id_dosen){
    return $this->db->where('id_dosen', $id_dosen)
              ->get('tb_sertifikasi_dosen')
              ->result();
  }

  public function tambah_sertifikasi($id_dosen)
    {
        $data = array(
            'id_dosen'        => $id_dosen,
            'no_peserta'        => $this->input->post('no_peserta'),
            'bidang_studi'         => $this->input->post('bidang_studi'),
            'jenis_sertifikasi'       => $this->input->post('jenis_sertifikasi'),
            'tahun_sertifikasi'       => $this->input->post('tahun_sertifikasi'),
            'no_sk_sertifikasi'       => $this->input->post('no_sk_sertifikasi'),
        );
    
        $this->db->insert('tb_sertifikasi_dosen', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function hapus_sertifikasi($id_sertifikasi){
        $this->db->where('id_sertifikasi', $id_sertifikasi)
          ->delete('tb_sertifikasi_dosen');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function penelitian($id_dosen){
    return $this->db->where('id_dosen', $id_dosen)
              ->get('tb_penelitian_dosen')
              ->result();
  }

  public function tambah_penelitian($id_dosen)
    {
        $data = array(
            'id_dosen'        => $id_dosen,
            'judul_penelitian'        => $this->input->post('judul_penelitian'),
            'bidang_ilmu'         => $this->input->post('bidang_ilmu'),
            'lembaga'       => $this->input->post('lembaga'),
            'tahun_penelitian'       => $this->input->post('tahun_penelitian'),
            'sumber_dana'       => $this->input->post('sumber_dana'),
            'total_dana'       => $this->input->post('total_dana'),
        );
    
        $this->db->insert('tb_penelitian_dosen', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function hapus_penelitian($id_penelitian){
        $this->db->where('id_penelitian', $id_penelitian)
          ->delete('tb_penelitian_dosen');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

	

}

/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */