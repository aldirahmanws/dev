<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_ulang_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

     public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_mahasiswa.id_hasil_tes,4) as kode', FALSE); 
          $this->db->order_by('id_hasil_tes','DESC');    
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
          $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "TES".$kodemax;    // hasilnya ODJ-991-0001 dst.
          return $kodejadi; 
    }

  
    function cek_nim($nim){
      $query = $this->db->select('*')
                ->from('tb_mahasiswa')
                ->where('nim', $nim)
                ->get();
                if ($query->num_rows() > 0)
                {
                    echo '<span class="label label-danger">NIM Not Available</span><script>document.getElementById("myBtn").disabled = true;</script>';

                } else{
                echo '<span class="label label-success"> NIM  Available.</span><script>document.getElementById("myBtn").disabled = false;</script>';
                
                }
    }

     function getProdi()
    {
        return $this->db->get('tb_prodi')
                    ->result();

    }

    function getAngkatan()
    {
        return $this->db->get('tb_angkatan')
                    ->result();

    }

    function getJenisMatkul()
    {
        return $this->db->get('tb_jenis_matkul')
                    ->result();

    }

    function getPeriode()
    {
        return $this->db->get('tb_periode')
                    ->result();

    }

    public function get_concentrate($data){
      return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_prodi=tb_prodi.id_prodi')
              ->where('tb_prodi.id_prodi',$data)
              ->get('tb_prodi')
              ->result();
  }
  
    function getPreschool()
    {
        return $this->db->get('tb_sekolah')
                    ->result();

    }

  public function page_du_pagi($id_pendaftaran){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah')
              ->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
  }

    public function page_du_sore($id_pendaftaran){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah')
              ->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
  }

  public function data_peserta_tes(){
    return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_mahasiswa.id_prodi')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')  
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu') 
              ->join('tb_tgl_du','tb_tgl_du.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->where('tb_mahasiswa.id_waktu', '1')
              ->get('tb_mahasiswa')
              ->result();
  }

  public function get_du_by_id($id_mahasiswa){
      return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }


  public function save_hasil_tes()
    {        
        $data = array(
            'id_hasil_tes'      => $this->input->post('id_hasil_tes', TRUE),
            'nilai_mat'      => $this->input->post('mtk', TRUE),
            'nilai_bing'      => $this->input->post('bing', TRUE),
            'nilai_psikotes'     => $this->input->post('psikotes', TRUE),
            'total_nilai'     => $this->input->post('nilai', TRUE),
            'total_jawaban'     => $this->input->post('total_jawaban', TRUE),
            'grade'     => $this->input->post('grade', TRUE),
            'tanggal_hasil_tes'     => date('Y-m-d')

        );
    
        $this->db->insert('tb_hasil_tes', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function save_update_status($id_tes){
    $data = array(
       'status_mahasiswa'     => 'Aktif'
      );

    $this->db->where('id_hasil_tes', $id_tes)
        ->update('tb_mahasiswa', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function detail_nilai($id_mahasiswa){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_mahasiswa.id_prodi')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi') 
              ->join('tb_hasil_tes','tb_hasil_tes.id_hasil_tes=tb_mahasiswa.id_hasil_tes')  
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')  
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')             
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }

   public function get_hasil_tes($id_mahasiswa){
      return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')  
              ->join('tb_hasil_tes','tb_hasil_tes.id_hasil_tes=tb_mahasiswa.id_hasil_tes')
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }

  public function get_biaya($cek){
      return $this->db->where('nama_biaya', $cek)
              ->get('tb_biaya')
              ->row();
  }

  public function detail_du($id_mahasiswa){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_mahasiswa.id_prodi')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_ibu','tb_ibu.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }



  /*



   

    


    

  public function save_edit_hasil_tes($id_tes){
    $data = array(
            'id_hasil_tes'      => $this->input->post('id_hasil_tes', TRUE),
            'nilai_mat'      => $this->input->post('mtk', TRUE),
            'nilai_bing'      => $this->input->post('bing', TRUE),
            'nilai_psikotes'     => $this->input->post('psikotes', TRUE),
            'total_nilai'     => $this->input->post('nilai', TRUE),
            'total_jawaban'     => $this->input->post('total_jawaban', TRUE),
            'grade'     => $this->input->post('grade', TRUE),
            'tanggal_hasil_tes'     => date('Y-m-d')
      );

    if (!empty($data)) {
            $this->db->where('id_hasil_tes', $id_tes)
        ->update('tb_hasil_tes', $data);

          return true;
        } else {
            return null;
        }
  } */

}
   
/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */
