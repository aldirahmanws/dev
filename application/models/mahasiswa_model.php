<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

   public function  buat_kode_mhs()   {
          $this->db->SELECT('RIGHT(tb_mahasiswa.id_mahasiswa,5) as kode', FALSE);
          $this->db->order_by('id_mahasiswa','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_mahasiswa');      //cek dulu apakah ada sudah ada kode di tabel.    
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
          $kodejadi = "M".$kodemax;    // hasilnya ODJ-991-0001 dst.
          return $kodejadi; 
    }
    public function session_mahasiswa($username){
      return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu') 
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_mahasiswa.id_status')
              ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin')
              ->where('tb_mahasiswa.nim', $username)
              ->get('tb_mahasiswa')
              ->row();
    }

	public function data_mahasiswa(){
		return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu') 
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_mahasiswa.id_status')
              ->order_by('tb_mahasiswa.id_mahasiswa', 'DESC')
              ->get('tb_mahasiswa')
              ->result();
	}

  public function data_mahasiswa_dikti(){
    return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi') 
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_mahasiswa.id_status')
              ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu') 
              ->where('tb_mahasiswa.id_status',1)
              ->or_where('tb_mahasiswa.id_status',19)
              ->or_where('tb_mahasiswa.id_status',2)
              ->or_where('tb_mahasiswa.id_status',3)
              ->or_where('tb_mahasiswa.id_status',4)
              ->order_by('tb_mahasiswa.id_mahasiswa', 'DESC')
              ->get('tb_mahasiswa')
              ->result();
  }

  public function filter_mahasiswa($id_prodi, $id_agama, $id_kelamin, $angkatan){
   return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')  
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu') 
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_mahasiswa.id_status')
              ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->like('tb_prodi.id_prodi', $id_prodi)
              ->like('tb_bio.id_agama', $id_agama)
              ->like('tb_bio.id_kelamin', $id_kelamin)
              ->like('tb_pendidikan.tgl_du', $angkatan)
              ->order_by('tb_mahasiswa.id_mahasiswa','asc')
              ->get('tb_mahasiswa')
              ->result();
  }

   function filter_nilai($id_mahasiswa,$semester){

     $this->db->select('*');
     $this->db->from('tb_kelas_mhs');
     $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp');
     $this->db->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum');
     $this->db->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul');
     $this->db->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai');
     $this->db->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode');
     $this->db->like('tb_kelas_mhs.id_mahasiswa',$id_mahasiswa);
     $this->db->like('tb_periode.semester',$semester);
     $query = $this->db->get();
     return $query->result();
      }


      public function data_nilai_mhs($id_mahasiswa){
       $c = $this->db->select('tb_kelas_mhs.id_detail_kurikulum')
                  ->distinct()
                  ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kelas_mhs.id_detail_kurikulum')
                          ->where('tb_kelas_mhs.nilai_d !=', 0)
                          ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
                          ->order_by('tb_detail_kurikulum.semester_kurikulum', 'ASC')
                          ->get('tb_kelas_mhs')
                          ->result();

      
              foreach ($c as $b) {
      $a = $this->db->select('MAX(tb_kelas_mhs.nilai_d) as nilai_d, tb_matkul.nama_matkul, tb_matkul.bobot_matkul, tb_matkul.id_matkul, tb_kelas_mhs.nilai_tugas, tb_kelas_mhs.nilai_paper, tb_kelas_mhs.nilai_uts, tb_kelas_mhs.nilai_uas, tb_kelas_mhs.absensi, tb_skala_nilai.nilai_huruf, tb_skala_nilai.nilai_indeks, tb_detail_kurikulum.semester_kurikulum')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kelas_mhs.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai')
              ->where('tb_kelas_mhs.id_detail_kurikulum', $b->id_detail_kurikulum)
              ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
              ->order_by('tb_detail_kurikulum.semester_kurikulum', 'ASC')
              ->get('tb_kelas_mhs')
              ->row();
           
            $row[] = $a;
              }
         
        return $row;
  } 

  public function data_nilai_mhs_pindahan($id_mahasiswa, $smt_pindah){
      return $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
              ->where('tb_detail_kurikulum.semester_kurikulum >=', '1')
              ->where('tb_detail_kurikulum.semester_kurikulum <=', $smt_pindah)
              ->get('tb_kelas_mhs')
              ->result();
  } 

  public function data_ap($id_mahasiswa){
      return $this->db->join('tb_status_mhs','tb_status_mhs.id_status=tb_aktivitas_perkuliahan.id_status')
              ->join('tb_periode','tb_periode.id_periode=tb_aktivitas_perkuliahan.id_periode')
              ->where('tb_aktivitas_perkuliahan.id_mahasiswa', $id_mahasiswa)
              ->get('tb_aktivitas_perkuliahan')
              ->result();
  } 

  public function detail_mahasiswa_dikti($id_mahasiswa){
      return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_ayah','tb_ayah.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_ibu','tb_ibu.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_wali','tb_wali.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_grade','tb_grade.id_grade=tb_mahasiswa.id_grade')
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_mahasiswa.id_status')
              ->join('tb_jenis_tinggal','tb_jenis_tinggal.id_jt=tb_bio.id_jt','left')
              ->join('tb_transportasi','tb_transportasi.id_transportasi=tb_bio.id_transportasi','left')
              ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_mahasiswa.dosen_pa')
              ->join('tb_ld','tb_ld.id_mahasiswa=tb_mahasiswa.id_mahasiswa','left')
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }

  public function detail_krs_mahasiswa($id_mahasiswa){
      return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_grade','tb_grade.id_grade=tb_mahasiswa.id_grade')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_mahasiswa.dosen_pa')
              ->join('tb_ld','tb_ld.id_mahasiswa=tb_mahasiswa.id_mahasiswa','left')
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  } 

  public function data_krs_mhs($id_prodi, $semester_aktif){

     $c = $this->db->select('tb_jadwal.id_kp')
                  ->distinct()
                  ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
                  ->join('tb_kp','tb_kp.id_kp=tb_jadwal.id_kp')
                  ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
                  ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_jadwal.id_konsentrasi')
                  ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                  ->where('tb_detail_kurikulum.semester_kurikulum', $semester_aktif)
                  ->where('tb_detail_kurikulum.wajib', 'Y')
                  ->where('tb_prodi.id_prodi', $id_prodi)
                  ->where('tgl_mulai <= ', date('Y-m-d'))
                  ->where('tgl_akhir >= ', date('Y-m-d'))
                  ->get('tb_jadwal')
                  ->result();

      
              foreach ($c as $b) {
      $a = $this->db->select('MAX(tb_ruang.kapasitas) as kapasitas, tb_konsentrasi.nama_konsentrasi, tb_konsentrasi.id_konsentrasi, tb_waktu.id_waktu, tb_waktu.waktu, tb_kp.id_kp, tb_kp.tgl_mulai, tb_kp.tgl_akhir, tb_detail_kurikulum.id_detail_kurikulum, tb_matkul.id_matkul, tb_matkul.nama_matkul, tb_matkul.bobot_matkul, tb_dosen.nama_dosen, tb_periode.id_periode, tb_matkul.kode_matkul, tb_kurikulum.ang_awal, tb_kurikulum.ang_akhir')
              ->join('tb_kp','tb_kp.id_kp=tb_jadwal.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
              ->join('tb_kurikulum','tb_kurikulum.id_kurikulum=tb_detail_kurikulum.id_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->where('tb_jadwal.id_kp', $b->id_kp)
              ->get('tb_jadwal')
              ->row();
           
            $row[] = $a;
              }
         
        return $row;

  } 

  public function data_krs_pilihan($semester_aktif, $id_konsentrasi){

     $c = $this->db->select('tb_jadwal.id_kp')
                  ->distinct()
                  ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
                  ->join('tb_kp','tb_kp.id_kp=tb_jadwal.id_kp')
                  ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
                  ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_jadwal.id_konsentrasi')
                  ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                  ->where('tb_detail_kurikulum.semester_kurikulum', $semester_aktif)
                  ->where('tb_detail_kurikulum.wajib !=', 'Y')
                  ->where('tgl_mulai <= ', date('Y-m-d'))
                  ->where('tgl_akhir >= ', date('Y-m-d'))
                  ->get('tb_jadwal')
                  ->result();

      
              foreach ($c as $b) {
      $a = $this->db->select('MAX(tb_ruang.kapasitas) as kapasitas, tb_konsentrasi.nama_konsentrasi, tb_konsentrasi.id_konsentrasi, tb_waktu.id_waktu, tb_waktu.waktu, tb_kp.id_kp, tb_kp.tgl_mulai, tb_kp.tgl_akhir, tb_detail_kurikulum.id_detail_kurikulum, tb_matkul.id_matkul, tb_matkul.nama_matkul, tb_matkul.bobot_matkul, tb_dosen.nama_dosen, tb_periode.id_periode, tb_matkul.kode_matkul')
              ->join('tb_kp','tb_kp.id_kp=tb_jadwal.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->where('tb_jadwal.id_kp', $b->id_kp)
              ->where('tb_kp.id_konsentrasi !=', $id_konsentrasi)
              ->where('tb_detail_kurikulum.wajib !=', 'Y')
              ->get('tb_jadwal')
              ->row();
           
            $row[] = $a;
              }
         
        return $row;

  } 

  public function total_krs_pilihan($semester_aktif, $id_konsentrasi){

     $c = $this->db->select('tb_jadwal.id_kp')
                  ->distinct()
                  ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
                  ->join('tb_kp','tb_kp.id_kp=tb_jadwal.id_kp')
                  ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
                  ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_jadwal.id_konsentrasi')
                  ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                  ->where('tb_detail_kurikulum.semester_kurikulum', $semester_aktif)
                  ->where('tb_detail_kurikulum.wajib !=', 'Y')
                  ->where('tgl_mulai <= ', date('Y-m-d'))
                  ->where('tgl_akhir >= ', date('Y-m-d'))
                  ->get('tb_jadwal')
                  ->result();

      
              foreach ($c as $b) {
      $a = $this->db->select('MAX(tb_ruang.kapasitas) as kapasitas, tb_konsentrasi.nama_konsentrasi, tb_konsentrasi.id_konsentrasi, tb_waktu.id_waktu, tb_waktu.waktu, tb_kp.id_kp, tb_kp.tgl_mulai, tb_kp.tgl_akhir, tb_detail_kurikulum.id_detail_kurikulum, tb_matkul.id_matkul, tb_matkul.nama_matkul, tb_matkul.bobot_matkul, tb_dosen.nama_dosen, tb_periode.id_periode, tb_matkul.kode_matkul')
              ->join('tb_kp','tb_kp.id_kp=tb_jadwal.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_kp.id_waktu')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
              ->where('tb_jadwal.id_kp', $b->id_kp)
              ->where('tb_kp.id_konsentrasi !=', $id_konsentrasi)
              ->where('tb_detail_kurikulum.wajib !=', 'Y')
              ->get('tb_jadwal')
              ->row();
           
            $row[] = $a;
              }
         
        return $row;

  } 

   

  public function data_transfer_nilai($id_mahasiswa){
      return $this->db->join('tb_matkul','tb_matkul.kode_matkul=tb_transfer_nilai.kode_matkul')
              ->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_transfer_nilai.id_skala_nilai')
              ->where('tb_transfer_nilai.id_mahasiswa', $id_mahasiswa)
              ->get('tb_transfer_nilai')
              ->result();
  }

  public function simpan_nilai_transfer()
    {        
        $data = array(
            'id_mahasiswa'      =>$this->input->post('id_mahasiswa', TRUE),
            'kode_matkul_asal'      => $this->input->post('kode_matkul_asal', TRUE),
            'matkul_asal'      => $this->input->post('matkul_asal', TRUE),
            'sks_matkul_asal'      => $this->input->post('sks_matkul_asal', TRUE),
            'nilai_huruf_asal'     => $this->input->post('nilai_huruf_asal', TRUE),
            'kode_matkul'     => $this->input->post('kode_matkul', TRUE),
            'nilai_transfer'     => $this->input->post('nilai', TRUE),
            'id_skala_nilai'     => $this->input->post('id_skala_nilai', TRUE),
        );
        $this->db->insert('tb_transfer_nilai', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

     public function simpan_nilai_kp()
    {        
        $data = array(
            'id_mahasiswa'      =>$this->input->post('id_mahasiswa', TRUE),
            'id_detail_kurikulum'      => $this->input->post('id_detail_kurikulum', TRUE),
            'nilai_d'      => $this->input->post('nilai', TRUE),
            'id_skala_nilai'      => $this->input->post('id_skala_nilai', TRUE),
        );
        $this->db->insert('tb_kelas_mhs', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

  public function kelas_mhs($id_mahasiswa){

      return $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp','left')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen','left')
              ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->get('tb_kelas_mhs')
              ->result();
  } 

   public function Periode_krs($id_prodi){
      return $this->db->select('semester, id_periode')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->where('id_prodi', $id_prodi)
              ->get('tb_periode')
              ->row();
  } 

  public function getStatus(){
      return $this->db->get('tb_status_mhs')
              ->result();
  } 

   public function getGrade(){
      return $this->db->where('tgl_awal_grade <=', date('Y-m-d'))
              ->where('tgl_akhir_grade >=', date('Y-m-d'))
              ->get('tb_grade')
              ->result();
  } 


  public function history_pendidikan($nik){
      return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_pendidikan.id_mahasiswa')
              ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_pendidikan.id_mahasiswa')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_periode','tb_periode.id_periode=tb_pendidikan.id_periode')
              ->join('tb_pt','tb_pt.id_pt=tb_pendidikan.asal_pt','left')
              ->join('tb_jenis_pendaftaran','tb_jenis_pendaftaran.id_jenis_pendaftaran=tb_pendidikan.id_jenis_pendaftaran')
              ->join('tb_pembiayaan_awal','tb_pembiayaan_awal.id_pembiayaan=tb_pendidikan.id_pembiayaan_awal','left')
              ->join('tb_jalur_pendaftaran','tb_jalur_pendaftaran.id_jalur_pendaftaran=tb_pendidikan.id_jalur_pendaftaran','left')
              ->where('tb_kependudukan.nik', $nik)
              ->get('tb_pendidikan')
              ->result();
  }

  public function jadwal_mhs_senin($id_mahasiswa){
      return $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp','left')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen','left')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
              ->where('tb_jadwal.id_hari', '1')
              ->order_by('tb_jadwal.jam_awal', 'ASC')
              ->get('tb_kelas_mhs')
              ->result();
  }

  public function jadwal_mhs_selasa($id_mahasiswa){
    return $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp','left')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen','left')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
              ->where('tb_jadwal.id_hari', '2')
              ->order_by('tb_jadwal.jam_awal', 'ASC')
              ->get('tb_kelas_mhs')
              ->result();
  }

  public function jadwal_mhs_rabu($id_mahasiswa){
    return $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp','left')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen','left')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
              ->where('tb_jadwal.id_hari', '3')
              ->order_by('tb_jadwal.jam_awal', 'ASC')
              ->get('tb_kelas_mhs')
              ->result();
  }

  public function jadwal_mhs_kamis($id_mahasiswa){
    return $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp','left')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen','left')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
              ->where('tb_jadwal.id_hari', '4')
              ->order_by('tb_jadwal.jam_awal', 'ASC')
              ->get('tb_kelas_mhs')
              ->result();
  }

  public function jadwal_mhs_jumat($id_mahasiswa){
     return $this->db->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
              ->join('tb_jadwal','tb_jadwal.id_kp=tb_kp.id_kp')
              ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_jadwal.id_detail_kurikulum')
              ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
              ->join('tb_ruang','tb_ruang.id_ruang=tb_jadwal.id_ruang')
              ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp','left')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen','left')
              ->join('tb_periode','tb_periode.id_periode=tb_jadwal.id_periode')
              ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
              ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
              ->where('tb_kelas_mhs.id_mahasiswa', $id_mahasiswa)
              ->where('tb_jadwal.id_hari', '5')
              ->order_by('tb_jadwal.jam_awal', 'ASC')
              ->get('tb_kelas_mhs')
              ->result();
  }

  public function prestasi($history){
      return $this->db->where('tb_prestasi.id_mahasiswa', $history)
              ->get('tb_prestasi')
              ->result();
  }

  public function detail_prestasi($history){
      return $this->db->where('tb_prestasi.id_prestasi', $history)
              ->get('tb_prestasi')
              ->row();
  }

  public function simpan_prestasi($id_mahasiswa)
    {
        $data = array(
            'id_mahasiswa'        => $id_mahasiswa,
            'jenis_prestasi'        => $this->input->post('jenis_prestasi'),
            'tingkat_prestasi'        => $this->input->post('tingkat_prestasi'),
            'nama_prestasi'        => $this->input->post('nama_prestasi'),
            'penyelenggara'        => $this->input->post('penyelenggara'),
            'tahun'        => $this->input->post('tahun'),
            'peringkat'        => $this->input->post('peringkat')

        );
    
        $this->db->insert('tb_prestasi', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
        }
    }

    public function simpan_krs_mhs()
    {
      $id_kp2 = explode(',', $this->input->post('id_kp'));
      $id_detail_kurikulum = explode(',', $this->input->post('id_detail_kurikulum'));
      for($i=0; $i+1<count($id_kp2);$i++){
        for($i=0; $i+1<count($id_detail_kurikulum);$i++){
        $data = array('id_mahasiswa'        => $this->input->post('id_mahasiswa'),
                      'id_detail_kurikulum'        => $id_detail_kurikulum[$i],
                      'id_kp'        => $id_kp2[$i]);
        $this->db->insert('tb_kelas_mhs', $data);
      }
    }
      if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

    public function simpan_krs_mengulang()
    {
        $data = array(
            'id_mahasiswa'            => $this->input->post('id_mahasiswa'),
            'id_kp'                   => $this->input->post('id_kp'),
            'id_detail_kurikulum'     => $this->input->post('id_detail_kurikulum'),
        );
    
        $this->db->insert('tb_kelas_mhs', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
        }
    }

    public function simpan_krs_pilihan($id_mahasiswa, $id_kp, $id_detail_kurikulum)
    {
        $data = array(
            'id_mahasiswa'        => $id_mahasiswa,
            'id_kp'        => $id_kp,
            'id_detail_kurikulum'        => $id_detail_kurikulum,
        );
    
        $this->db->insert('tb_kelas_mhs', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
        }
    }

    public function edit_kelas_mengulang($id_mahasiswa, $id_detail_kurikulum){
    $data = array(
            'id_mahasiswa' => $this->input->post('id_mahasiswa'),
            'id_detail_kurikulum' => $this->input->post('id_detail_kurikulum')
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
                     ->where('id_detail_kurikulum', $id_detail_kurikulum)
                     ->update('tb_kelas_mhs', $data);

          return true;
        } else {
            return null;
        }
  }

    public function save_pendidikan()
    {
        $data = array(
            'id_mahasiswa'        => $this->input->post('id_mahasiswa'),
            'tgl_du'        => $this->input->post('tgl_du'),
            'id_jenis_pendaftaran'        => $this->input->post('id_jenis_pendaftaran'),
            'id_jalur_pendaftaran'        => '6',
            'id_pt'        => '1',
            'asal_pt'      => $this->input->post('asal_pt', TRUE),
            'asal_prodi'      => $this->input->post('asal_prodi', TRUE),
            'jml_sks_diakui'      => $this->input->post('jml_sks_diakui', TRUE),
            'id_periode'        => $this->input->post('id_periode')

        );
    
        $this->db->insert('tb_pendidikan', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
        }
    }


    public function simpan_pendidikan()
    {
        $data = array(
            'id_mahasiswa'        => $this->input->post('id_mahasiswa_ori'),
            'id_jenis_pendaftaran'        => $this->input->post('id_jenis_pendaftaran'),
            'id_jalur_pendaftaran'        => $this->input->post('id_jalur_pendaftaran'),
            'id_pembiayaan_awal'        => $this->input->post('id_pembiayaan_awal'),
            'id_pt'        => $this->input->post('id_pt'),
            'jml_sks_diakui'        => $this->input->post('jml_sks_diakui'),
            'asal_pt'        => $this->input->post('asal_pt'),
            'asal_prodi'        => $this->input->post('asal_prodi'),
            'id_periode'        => $this->input->post('id_periode'),
            'tgl_du'        => $this->input->post('tgl_du'),

        );
    
        $this->db->insert('tb_pendidikan', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
        }
    }

    public function simpan_pendidikan_pindahan()
    {
        $data = array(
            'id_mahasiswa'        => $this->input->post('id_mahasiswa'),
            'id_jenis_pendaftaran'        => $this->input->post('id_jenis_pendaftaran'),
            'id_jalur_pendaftaran'        => $this->input->post('id_jalur_pendaftaran'),
            'id_pembiayaan_awal'        => $this->input->post('id_pembiayaan_awal'),
            'id_pt'        => $this->input->post('id_pt'),
            'jml_sks_diakui'        => $this->input->post('jml_sks_diakui'),
            'asal_pt'        => $this->input->post('asal_pt'),
            'asal_prodi'        => $this->input->post('asal_prodi'),
            'id_periode'        => $this->input->post('id_periode'),
            'tgl_du'        => $this->input->post('tgl_du'),

        );
    
        $this->db->insert('tb_pendidikan', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
        }
    }

    public function ubah_status_mhs_pindahan($id_mahasiswa){
    $data = array(
            'id_status'      => '2',
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_mahasiswa', $data);

          return true;
        } else {
            return null;
        }
  }

  public function hapus_user_mhs_pindahan($nim_lama){
        $this->db->where('username', $nim_lama)
          ->delete('tb_user');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function edit_prestasi($id_mahasiswa){
    $data = array(
            'id_mahasiswa'        => $this->input->post('id_mahasiswa'),
            'jenis_prestasi'        => $this->input->post('jenis_prestasi'),
            'tingkat_prestasi'        => $this->input->post('tingkat_prestasi'),
            'nama_prestasi'        => $this->input->post('nama_prestasi'),
            'penyelenggara'        => $this->input->post('penyelenggara'),
            'tahun'        => $this->input->post('tahun'),
            'peringkat'        => $this->input->post('peringkat')
      );

    if (!empty($data)) {
            $this->db->where('id_prestasi', $id_mahasiswa)
        ->update('tb_prestasi', $data);

          return true;
        } else {
            return null;
        }
  }


  public function get_mahasiswa_by_du($id_mahasiswa){
       return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->where('id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }

  public function save_mahasiswa()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'nama_mahasiswa'      => $this->input->post('nama_mahasiswa', TRUE),
            'nim'      => $this->input->post('nim', TRUE),
            'id_status'      => '19',
            'id_sekolah'      => $this->input->post('id_sekolah', TRUE),
            'id_konsentrasi'      => $this->input->post('concentrate', TRUE),
            'id_waktu'      => $this->input->post('id_waktu', TRUE),
            'semester_aktif'      => $this->input->post('semester_aktif', TRUE),
            'id_grade'      => $this->input->post('id_grade', TRUE),
            'dosen_pa'      => $this->input->post('dosen_pa', TRUE)

        );
    
        $this->db->insert('tb_mahasiswa', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function save_mahasiswa_pindahan()
    {        
        $data = array(
            'id_mahasiswa'      => $this->input->post('id_mahasiswa', TRUE),
            'nama_mahasiswa'      => $this->input->post('nama_mahasiswa', TRUE),
            'nim'      => $this->input->post('nim', TRUE),
            'id_status'      => '19',
            'id_konsentrasi'      => $this->input->post('concentrate', TRUE),
            'id_waktu'      => $this->input->post('id_waktu', TRUE),
            'semester_aktif'      => '3',
            'id_grade'      => $this->input->post('id_grade', TRUE),
            'id_du'      => $this->input->post('id_du', TRUE),
            'id_sekolah'      => $this->input->post('id_sekolah', TRUE),
            'id_hasil_tes'      => $this->input->post('id_hasil_tes', TRUE),

        );
    
        $this->db->insert('tb_mahasiswa', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

  public function save_mahasiswa_pagi()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'id_du'      => $this->input->post('id_du', TRUE),
            'nama_mahasiswa'      => $this->input->post('nama_mahasiswa', TRUE),
            'nim'      => $this->input->post('nim', TRUE),
            'id_status'      => $this->input->post('id_status', TRUE),
            'id_grade' => '4',
            'id_konsentrasi'      => $this->input->post('concentrate', TRUE),
            'id_hasil_tes'      => $this->input->post('id_hasil_tes', TRUE),
            'id_sekolah'      => $this->input->post('id_sekolah', TRUE),
            'id_waktu'      => $this->input->post('id_waktu', TRUE),
            'semester_aktif'      => '1',
            'dosen_pa'      => $this->input->post('dosen_pa', TRUE),
        );
    
        $this->db->insert('tb_mahasiswa', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

     public function save_mahasiswa_sore()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'id_du'      => $this->input->post('id_du', TRUE),
            'nama_mahasiswa'      => $this->input->post('nama_mahasiswa', TRUE),
            'nim'      => $this->input->post('nim', TRUE),
            'id_status'      => '19',
            'id_konsentrasi'      => $this->input->post('concentrate', TRUE),
            'id_sekolah'      => $this->input->post('id_sekolah', TRUE),
            'id_waktu'      => '2',
            'id_grade'      => '4',
            'semester_aktif'  => '1'
        );
    
        $this->db->insert('tb_mahasiswa', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function save_bio()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'id_kelamin'      => $this->input->post('jenis_kelamin', TRUE),
            'tanggal_lahir'      => $this->input->post('tanggal_lahir', TRUE),
            'tempat_lahir'     => $this->input->post('tempat_lahir', TRUE),
            'id_agama'     => $this->input->post('agama', TRUE),
            'id_jt'      => $this->input->post('id_jt', TRUE),
            'id_transportasi'      => $this->input->post('id_transportasi', TRUE),
        );
    
        $this->db->insert('tb_bio', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function save_kontak()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'email'     => $this->input->post('email', TRUE),
            'no_telepon'     => $this->input->post('no_telepon', TRUE),
            'no_hp'     => $this->input->post('no_hp', TRUE)
        );
    
        $this->db->insert('tb_kontak', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

     public function save_ayah()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'nama_ayah'      => $this->input->post('nama_ayah', TRUE),
            'nik_ayah'      => $this->input->post('nik_ayah', TRUE),
            'tanggal_lahir_ayah'      => $this->input->post('tanggal_lahir_ayah', TRUE),
            'pendidikan_ayah'      => $this->input->post('pendidikan_ayah', TRUE),
            'pekerjaan_ayah'     => $this->input->post('pekerjaan_ayah', TRUE),
            'penghasilan_ayah'     => $this->input->post('penghasilan_ayah', TRUE)
            
        );
        $this->db->insert('tb_ayah', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

     public function save_ibu()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'nama_ibu'     => $this->input->post('nama_ibu', TRUE),
            'nik_ibu'     => $this->input->post('nik_ibu', TRUE),
            'tanggal_lahir_ibu'     => $this->input->post('tanggal_lahir_ibu', TRUE),
            'pendidikan_ibu'      => $this->input->post('pendidikan_ibu', TRUE),
            'pekerjaan_ibu'      => $this->input->post('pekerjaan_ibu', TRUE),
            'penghasilan_ibu'      => $this->input->post('penghasilan_ibu', TRUE)
            
        );
        $this->db->insert('tb_ibu', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

    public function save_wali()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'nama_wali'      => $this->input->post('nama_wali', TRUE),
            'tanggal_lahir_wali'      => $this->input->post('tanggal_lahir_wali', TRUE),
            'pendidikan_wali'      => $this->input->post('pendidikan_wali', TRUE),
            'pekerjaan_wali'     => $this->input->post('pekerjaan_wali', TRUE),
            'penghasilan_wali'     => $this->input->post('penghasilan_wali', TRUE)
        );
        $this->db->insert('tb_wali', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

    public function save_alamat()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'jalan'      => $this->input->post('jalan', TRUE),
            'dusun'      => $this->input->post('dusun', TRUE),
            'kelurahan'      => $this->input->post('kelurahan', TRUE),
            'kecamatan'     => $this->input->post('kecamatan', TRUE),
            'rt'     => $this->input->post('rt', TRUE),
            'rw'     => $this->input->post('rw', TRUE),
            'kode_pos'     => $this->input->post('kode_pos', TRUE),
            'alamat_mhs'     => $this->input->post('alamat_mhs', TRUE),
            'jurusan'     => $this->input->post('jurusan', TRUE),
        );
        $this->db->insert('tb_alamat', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

    public function save_kependudukan()
    {        
        $data = array(
            'id_mahasiswa'      => $this->buat_kode_mhs(),
            'nik'      => $this->input->post('nik', TRUE),
            'nisn'      => $this->input->post('nisn', TRUE),
            'npwp'      => $this->input->post('npwp', TRUE),
            'kewarganegaraan'     => $this->input->post('kewarganegaraan', TRUE),
            'kps'     => $this->input->post('kps', TRUE),
            'no_kps'     => $this->input->post('no_kps', TRUE)
        );
        $this->db->insert('tb_kependudukan', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

    public function save_edit_foto_mahasiswa($foto_mahasiswa, $id_mahasiswa)
   {    
    $data = array('foto_mahasiswa' => $foto_mahasiswa['file_name'] )
                  ;
    $this->db->where('id_mahasiswa', $id_mahasiswa)->update('tb_bio', $data);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

    public function save_edit_mahasiswa($id_mahasiswa){
    $data = array(
            'nama_mahasiswa'      => $this->input->post('nama_mahasiswa', TRUE),
            'nim'      => $this->input->post('nim', TRUE),   
            'id_konsentrasi'      => $this->input->post('concentrate', TRUE),
            'id_waktu'      => $this->input->post('id_waktu', TRUE),
            'dosen_pa'      => $this->input->post('dosen_pa', TRUE),
            'id_grade'      => $this->input->post('id_grade', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_mahasiswa', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_edit_mahasiswa_du($id_mahasiswa){
    $data = array(
            'nama_mahasiswa'      => $this->input->post('nama_mahasiswa', TRUE),
            'nim'      => $this->input->post('nim', TRUE),   
            'id_konsentrasi'      => $this->input->post('concentrate', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_mahasiswa', $data);

          return true;
        } else {
            return null;
        }
  }


  public function save_edit_bio($id_mahasiswa){
    $data = array(
            'tanggal_lahir'      => $this->input->post('tanggal_lahir', TRUE),
            'tempat_lahir'     => $this->input->post('tempat_lahir', TRUE),
            'id_agama'     => $this->input->post('id_agama', TRUE),
            'id_jt'     => $this->input->post('id_jt', TRUE),
            'id_transportasi'     => $this->input->post('id_transportasi', TRUE),

      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_bio', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_edit_bio_mhs($id_mahasiswa){
    $data = array(
            'id_jt'     => $this->input->post('id_jt', TRUE),
            'id_transportasi'     => $this->input->post('id_transportasi', TRUE),

      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_bio', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_edit_kontak($id_mahasiswa){
    $data = array(
            'email'     => $this->input->post('email', TRUE),
            'no_telepon'     => $this->input->post('no_telepon', TRUE),
            'no_hp'     => $this->input->post('no_hp', TRUE)

      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_kontak', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_edit_ayah($id_mahasiswa){
    $data = array(
            'nama_ayah'      => $this->input->post('nama_ayah', TRUE),
            'nik_ayah'      => $this->input->post('nik_ayah', TRUE),
            'tanggal_lahir_ayah'      => $this->input->post('tanggal_lahir_ayah', TRUE),
            'pendidikan_ayah'      => $this->input->post('pendidikan_ayah', TRUE),
            'pekerjaan_ayah'     => $this->input->post('pekerjaan_ayah', TRUE),
            'penghasilan_ayah'     => $this->input->post('penghasilan_ayah', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_ayah', $data);

          return true;
        } else {
            return null;
        }
  }

   public function save_edit_pendidikan_du($id_mahasiswa){
    $data = array(
            'asal_pt'      => $this->input->post('asal_pt', TRUE),
            'asal_prodi'      => $this->input->post('asal_prodi', TRUE),
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_pendidikan', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_edit_pendidikan($id_mahasiswa){
    $data = array(
            'tgl_du'      => $this->input->post('tgl_du', TRUE),
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_pendidikan', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_edit_ibu($id_mahasiswa){
    $data = array(
            'nama_ibu'     => $this->input->post('nama_ibu', TRUE),
            'nik_ibu'     => $this->input->post('nik_ibu', TRUE),
            'tanggal_lahir_ibu'     => $this->input->post('tanggal_lahir_ibu', TRUE),
            'pendidikan_ibu'      => $this->input->post('pendidikan_ibu', TRUE),
            'pekerjaan_ibu'      => $this->input->post('pekerjaan_ibu', TRUE),
            'penghasilan_ibu'      => $this->input->post('penghasilan_ibu', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_ibu', $data);
          return true;
        } else {
            return null;
        }
  }

  public function save_edit_alamat($id_mahasiswa){
    $data = array(
            'jalan'      => $this->input->post('jalan', TRUE),
            'dusun'      => $this->input->post('dusun', TRUE),
            'kelurahan'      => $this->input->post('kelurahan', TRUE),
            'kecamatan'     => $this->input->post('kecamatan', TRUE),
            'rt'     => $this->input->post('rt', TRUE),
            'rw'     => $this->input->post('rw', TRUE),
            'kode_pos'     => $this->input->post('kode_pos', TRUE),
            'alamat_mhs'     => $this->input->post('alamat_mhs', TRUE),
            'jurusan'     => $this->input->post('jurusan', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_alamat', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_edit_kependudukan($id_mahasiswa){
    $data = array(
            'nik'      => $this->input->post('nik', TRUE),
            'nisn'      => $this->input->post('nisn', TRUE),
            'npwp'      => $this->input->post('npwp', TRUE),
            'kewarganegaraan'     => $this->input->post('kewarganegaraan', TRUE),
            'kps'     => $this->input->post('kps', TRUE),
            'no_kps'     => $this->input->post('no_kps', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_kependudukan', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_edit_kependudukan_mhs($id_mahasiswa){
    $data = array(
            'nik'      => $this->input->post('nik', TRUE),
            'nisn'      => $this->input->post('nisn', TRUE),
            'npwp'      => $this->input->post('npwp', TRUE),
            'kewarganegaraan'     => $this->input->post('kewarganegaraan', TRUE),
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_kependudukan', $data);

          return true;
        } else {
            return null;
        }
  }

 public function save_edit_wali($id_mahasiswa){
    $data = array(
            'nama_wali'      => $this->input->post('nama_wali', TRUE),
            'tanggal_lahir_wali'      => $this->input->post('tanggal_lahir_wali', TRUE),
            'pendidikan_wali'      => $this->input->post('pendidikan_wali', TRUE),
            'pekerjaan_wali'     => $this->input->post('pekerjaan_wali', TRUE),
            'penghasilan_wali'     => $this->input->post('penghasilan_wali', TRUE)
      );

   if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_wali', $data);

          return true;
        } else {
            return null;
        }
  }

  public function save_edit_user($nim){
    $data = array(
            'username'      => $this->input->post('nim', TRUE),
      );

   if (!empty($data)) {
            $this->db->where('username', $nim)
        ->update('tb_user', $data);

          return true;
        } else {
            return null;
        }
  }

  public function update_grade($id_mahasiswa, $id_grade){
    $data = array(
            'id_mahasiswa'      => $this->input->post('id_mahasiswa', TRUE),
            'id_grade'      => $id_grade
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_mahasiswa', $data);

          return true;
        } else {
            return null;
        }
  }

  public function data_ld(){
       return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_ld.id_mahasiswa')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_ld.id_status')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin')
              ->get('tb_ld')
              ->result();
  }

  public function update_status_ld($id_mahasiswa){
    $data = array(
            'id_mahasiswa' => $this->input->post('id_mahasiswa', TRUE),
            'id_status'      => $this->input->post('id_status', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_mahasiswa', $data);

          return true;
        } else {
            return null;
        }
  }

  public function update_status($id_mahasiswa){
    $data = array(
            'id_mahasiswa' => $this->input->post('id_mahasiswa', TRUE),
            'id_status'      => '1'
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_mahasiswa', $data);

          return true;
        } else {
            return null;
        }
  }

   public function simpan_ld()
    {        
        $data = array(
            'id_mahasiswa'      =>$this->input->post('id_mahasiswa', TRUE),
            'id_status'      => $this->input->post('id_status', TRUE),
            'keterangan'      => $this->input->post('keterangan', TRUE),
            'sk_yudisium'      => $this->input->post('sk_yudisium', TRUE),
            'tgl_sk_yudisium'     => $this->input->post('tgl_sk_yudisium', TRUE),
            'no_seri_ijazah'     => $this->input->post('no_seri_ijazah', TRUE),
            'tanggal_keluar'     => $this->input->post('tanggal_keluar', TRUE)
        );
        $this->db->insert('tb_ld', $data);
        if($this->db->affected_rows() > 0){
                return true;
        } else {
            return false;
        }
    }

     public function edit_status_ld($id_mahasiswa){
    $data = array(
            'id_status'      => $this->input->post('id_status', TRUE)
      );

    if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_mahasiswa', $data);

          return true;
        } else {
            return null;
        }
  }

  public function edit_ld($id_mahasiswa){
    $data = array(
            'id_status'      => $this->input->post('id_status', TRUE),
            'keterangan'      => $this->input->post('keterangan', TRUE),
            'sk_yudisium'      => $this->input->post('sk_yudisium', TRUE),
            'tgl_sk_yudisium'     => $this->input->post('tgl_sk_yudisium', TRUE),
            'no_seri_ijazah'     => $this->input->post('no_seri_ijazah', TRUE),
            'tanggal_keluar'     => $this->input->post('tanggal_keluar', TRUE)
      );

   if (!empty($data)) {
            $this->db->where('id_mahasiswa', $id_mahasiswa)
        ->update('tb_ld', $data);

          return true;
        } else {
            return null;
        }
  }

  public function filter_ld($id_prodi, $id_status, $angkatan){
    $this->db->select('*');
     $this->db->from('tb_ld');
     $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_ld.id_mahasiswa');
     $this->db->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa');
     $this->db->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa');
     $this->db->join('tb_status_mhs','tb_status_mhs.id_status=tb_ld.id_status');
     $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi');
     $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi');
      $this->db->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama');
     $this->db->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin');
     $this->db->like('tb_prodi.id_prodi',$id_prodi);
     $this->db->like('tb_pendidikan.tgl_du',$angkatan);
     $this->db->like('tb_ld.id_status',$id_status);
     $query = $this->db->get();
     return $query->result();
  }

   public function autocomplete_ipk($nama){
    $this->db->select('*');
     $this->db->from('tb_mahasiswa');
     $this->db->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa');
     $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi');
     $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi');
      $this->db->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama');
     $this->db->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin');
     $this->db->like('tb_mahasiswa.nama_mahasiswa', $nama);
     $query = $this->db->get();
     return $query->result();
  }

  public function data_user_mhs($username){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_mahasiswa', 'tb_mahasiswa.id_mahasiswa=tb_user.username', 'left')
                  ->where('tb_mahasiswa.nim', $username);

        $query = $this->db->get();
        return $query->result();
    }

    public function data_riwayat_pembayaran($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->join('tb_pembayaran','tb_pembayaran.kode_pembayaran=tb_detail_pembayaran.kode_pembayaran')
              ->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_detail_pembayaran.id_mahasiswa')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->order_by('tb_pembayaran.tanggal_cetak','desc')
              ->get('tb_detail_pembayaran')
              ->result();
  } 

  public function checklist_11($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 1')
              ->like('jenis_biaya', 'Angsuran Tahun 1')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_12($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 2')
              ->like('jenis_biaya', 'Angsuran Tahun 1')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_13($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 3')
              ->like('jenis_biaya', 'Angsuran Tahun 1')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_14($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 4')
              ->like('jenis_biaya', 'Angsuran Tahun 1')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_15($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 5')
              ->like('jenis_biaya', 'Angsuran Tahun 1')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_16($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 6')
              ->like('jenis_biaya', 'Angsuran Tahun 1')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_17($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 7')
              ->like('jenis_biaya', 'Angsuran Tahun 1')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_18($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 8')
              ->like('jenis_biaya', 'Angsuran Tahun 1')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_19($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 9')
              ->like('jenis_biaya', 'Angsuran Tahun 1')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_21($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 1')
              ->like('jenis_biaya', 'Angsuran Tahun 2')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_22($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 2')
              ->like('jenis_biaya', 'Angsuran Tahun 2')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_23($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 3')
              ->like('jenis_biaya', 'Angsuran Tahun 2')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_24($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 4')
              ->like('jenis_biaya', 'Angsuran Tahun 2')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_25($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 5')
              ->like('jenis_biaya', 'Angsuran Tahun 2')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_26($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 6')
              ->like('jenis_biaya', 'Angsuran Tahun 2')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_27($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 7')
              ->like('jenis_biaya', 'Angsuran Tahun 2')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_28($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 8')
              ->like('jenis_biaya', 'Angsuran Tahun 2')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_29($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 9')
              ->like('jenis_biaya', 'Angsuran Tahun 2')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_31($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 1')
              ->like('jenis_biaya', 'Angsuran Tahun 3')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_32($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 2')
              ->like('jenis_biaya', 'Angsuran Tahun 3')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_33($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 3')
              ->like('jenis_biaya', 'Angsuran Tahun 3')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_34($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 4')
              ->like('jenis_biaya', 'Angsuran Tahun 3')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_35($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 5')
              ->like('jenis_biaya', 'Angsuran Tahun 3')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_36($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 6')
              ->like('jenis_biaya', 'Angsuran Tahun 3')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_37($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 7')
              ->like('jenis_biaya', 'Angsuran Tahun 3')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_38($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 8')
              ->like('jenis_biaya', 'Angsuran Tahun 3')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_39($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 9')
              ->like('jenis_biaya', 'Angsuran Tahun 3')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_41($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 1')
              ->like('jenis_biaya', 'Angsuran Tahun 4')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_42($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 2')
              ->like('jenis_biaya', 'Angsuran Tahun 4')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_43($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 3')
              ->like('jenis_biaya', 'Angsuran Tahun 4')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_44($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 4')
              ->like('jenis_biaya', 'Angsuran Tahun 4')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_45($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 5')
              ->like('jenis_biaya', 'Angsuran Tahun 4')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_46($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 6')
              ->like('jenis_biaya', 'Angsuran Tahun 4')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_47($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 7')
              ->like('jenis_biaya', 'Angsuran Tahun 4')
              ->get('tb_detail_pembayaran')
              ->row();
  } 
  public function checklist_48($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 8')
              ->like('jenis_biaya', 'Angsuran Tahun 4')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_49($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 9')
              ->like('jenis_biaya', 'Angsuran Tahun 4')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_51($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 1')
              ->like('jenis_biaya', 'Angsuran Tahun 5')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_52($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 2')
              ->like('jenis_biaya', 'Angsuran Tahun 5')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_53($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 3')
              ->like('jenis_biaya', 'Angsuran Tahun 5')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_54($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 4')
              ->like('jenis_biaya', 'Angsuran Tahun 5')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_55($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 5')
              ->like('jenis_biaya', 'Angsuran Tahun 5')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_56($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 6')
              ->like('jenis_biaya', 'Angsuran Tahun 5')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_57($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 7')
              ->like('jenis_biaya', 'Angsuran Tahun 5')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_58($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 8')
              ->like('jenis_biaya', 'Angsuran Tahun 5')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_59($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 9')
              ->like('jenis_biaya', 'Angsuran Tahun 5')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_61($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 1')
              ->like('jenis_biaya', 'Angsuran Tahun 6')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_62($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 2')
              ->like('jenis_biaya', 'Angsuran Tahun 6')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_63($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 3')
              ->like('jenis_biaya', 'Angsuran Tahun 6')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_64($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 4')
              ->like('jenis_biaya', 'Angsuran Tahun 6')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_65($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 5')
              ->like('jenis_biaya', 'Angsuran Tahun 6')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_66($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 6')
              ->like('jenis_biaya', 'Angsuran Tahun 6')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_67($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 7')
              ->like('jenis_biaya', 'Angsuran Tahun 6')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_68($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 8')
              ->like('jenis_biaya', 'Angsuran Tahun 6')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_69($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 9')
              ->like('jenis_biaya', 'Angsuran Tahun 6')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_71($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 1')
              ->like('jenis_biaya', 'Angsuran Tahun 7')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_72($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 2')
              ->like('jenis_biaya', 'Angsuran Tahun 7')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_73($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 3')
              ->like('jenis_biaya', 'Angsuran Tahun 7')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_74($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 4')
              ->like('jenis_biaya', 'Angsuran Tahun 7')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_75($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 5')
              ->like('jenis_biaya', 'Angsuran Tahun 7')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_76($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 6')
              ->like('jenis_biaya', 'Angsuran Tahun 7')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_77($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 7')
              ->like('jenis_biaya', 'Angsuran Tahun 7')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_78($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 8')
              ->like('jenis_biaya', 'Angsuran Tahun 7')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function checklist_79($id_mahasiswa){
      return $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
              ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
              ->like('nama_biaya', 'Angsuran 9')
              ->like('jenis_biaya', 'Angsuran Tahun 7')
              ->get('tb_detail_pembayaran')
              ->row();
  } 

  public function hapus_mhs_bio($id_mahasiswa){
        $this->db->where('id_mahasiswa', $id_mahasiswa)
          ->delete('tb_bio');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

     public function hapus_mhs_alamat($id_mahasiswa){
        $this->db->where('id_mahasiswa', $id_mahasiswa)
          ->delete('tb_alamat');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

     public function hapus_mhs_ayah($id_mahasiswa){
        $this->db->where('id_mahasiswa', $id_mahasiswa)
          ->delete('tb_ayah');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

     public function hapus_mhs_ibu($id_mahasiswa){
        $this->db->where('id_mahasiswa', $id_mahasiswa)
          ->delete('tb_ibu');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

     public function hapus_mhs_wali($id_mahasiswa){
        $this->db->where('id_mahasiswa', $id_mahasiswa)
          ->delete('tb_wali');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

     public function hapus_mhs_kependudukan($id_mahasiswa){
        $this->db->where('id_mahasiswa', $id_mahasiswa)
          ->delete('tb_kependudukan');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

     public function hapus_mhs_kontak($id_mahasiswa){
        $this->db->where('id_mahasiswa', $id_mahasiswa)
          ->delete('tb_kontak');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

     public function hapus_mhs_pendidikan($id_mahasiswa){
        $this->db->where('id_mahasiswa', $id_mahasiswa)
          ->delete('tb_pendidikan');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

     public function hapus_mhs_mahasiswa($id_mahasiswa){
        $this->db->where('id_mahasiswa', $id_mahasiswa)
          ->delete('tb_mahasiswa');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function edit_pendidikan($id_pendidikan){
    $data = array(
            'id_jalur_pendaftaran'        => $this->input->post('id_jalur_pendaftaran'),
            'id_pembiayaan_awal'        => $this->input->post('id_pembiayaan_awal'),
            'tgl_du'         => $this->input->post('tgl_du')
      );

    if (!empty($data)) {
            $this->db->where('id_pendidikan', $id_pendidikan)
        ->update('tb_pendidikan', $data);

          return true;
        } else {
            return null;
        }
  }
 
 function getTahunAngkatan()
    {
        $ea =  $this->db->select('DATE_FORMAT(tb_pendidikan.tgl_du, "%Y") as tgl_du')
                ->distinct()
                ->order_by('tgl_du','ASC')
                ->get('tb_pendidikan');
        return $ea->result();

    }
              
              
              

}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */