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
              ->where('tb_konsentrasi.nama_konsentrasi !=', 'Semua')
              ->get('tb_prodi')
              ->result();
  }

  public function get_dosen_pa($data){
      return $this->db->where('id_prodi',$data)
              ->get('tb_prodi')
              ->row();
  }


  public function get_grade($semester_aktif){
      return $this->db->like('tb_grade.ket',$semester_aktif)
              ->get('tb_grade')
              ->result();
  }
  
    function getPreschool()
    {
        return $this->db->get('tb_sekolah')
                    ->result();

    }

  public function page_du_pagi($id_pendaftaran){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah','left')
              ->join('tb_pt','tb_pt.id_pt=tb_pendaftaran.id_pt','left')
              ->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
  }

    public function page_du_sore($id_pendaftaran){
      return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah','left')
              ->join('tb_pt','tb_pt.id_pt=tb_pendaftaran.id_pt','left')
              ->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
  }

  public function data_peserta_tes(){
    return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah','left')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu') 
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_mahasiswa.id_status')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->where('tb_mahasiswa.id_waktu', '1')
              ->where('tb_mahasiswa.semester_aktif', '1')
              ->where('tb_mahasiswa.id_hasil_tes !=', '')
              ->where('tb_mahasiswa.id_hasil_tes !=', NULL)
              ->where('tb_mahasiswa.id_hasil_tes !=', ' ')
              ->order_by('tb_mahasiswa.id_hasil_tes','desc')
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
            'no_surat_tes'     => $this->input->post('no_surat_tes', TRUE),
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
       'id_status'     => '19',
       'semester_aktif' => '1',
       'id_grade'     => $this->input->post('id_grade', TRUE)
      );

    $this->db->where('id_hasil_tes', $id_tes)
        ->update('tb_mahasiswa', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

   public function ubah_status_pendaftaran($id_pendaftaran){
    $data = array(
       'id_status'     => '1'
      );

    $this->db->where('id_pendaftaran', $id_pendaftaran)
        ->update('tb_pendaftaran', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function detail_nilai($id_mahasiswa){
      return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah','left')
              ->join('tb_hasil_tes','tb_hasil_tes.id_hasil_tes=tb_mahasiswa.id_hasil_tes')  
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')  
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_grade','tb_grade.id_grade=tb_mahasiswa.id_grade')             
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }

   public function get_hasil_tes($id_mahasiswa){
      return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah','left')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')  
              ->join('tb_hasil_tes','tb_hasil_tes.id_hasil_tes=tb_mahasiswa.id_hasil_tes')
              ->join('tb_grade','tb_grade.id_grade=tb_mahasiswa.id_grade') 
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }

  public function total_nilai($id_hasil_tes){

     $total_nilai = $this->db->query("SELECT nilai_mat + nilai_bing + nilai_psikotes AS total FROM tb_mahasiswa join tb_hasil_tes ON tb_hasil_tes.id_hasil_tes = tb_mahasiswa.id_hasil_tes WHERE tb_hasil_tes.id_hasil_tes = '$id_hasil_tes'")->row();

return array(
      'total_nilai' => $total_nilai->total
      );

  }

  public function get_biaya($cek){
      return $this->db->where('nama_biaya', $cek)
              ->get('tb_biaya')
              ->row();
  }

  public function detail_du($id_mahasiswa){
      return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah','left')
              ->join('tb_pt','tb_pt.id_pt=tb_pendidikan.asal_pt','left')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa') 
              ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_ibu','tb_ibu.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin')
              ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }
  public function insert_registrasi($cc, $id_mahasiswa){
    $query = $this->db->where('jenis_biaya', 'Registrasi')
                    ->like('nama_biaya', 'Uang Pendaftaran')
                    ->or_like('nama_biaya', 'Almamater')
                    ->or_like('nama_biaya', 'Amenities') 
                    ->order_by('periode', 'DESC')
                    ->limit(3)
                    ->get('tb_biaya')
                    ->result();
    $invoice = array(
             'kode_pembayaran'      => $cc,
             'id_mahasiswa'   => $id_mahasiswa
            
        );
        $this->db->insert('tb_pembayaran', $invoice);
    foreach ($query as $key) {
      $arr = array('kode_pembayaran' => $cc,
                    'id_mahasiswa' => $id_mahasiswa,
                    'tanggal_pembayaran' => date('d-m-Y'),
                    'id_biaya' => $key->id_biaya
         );
      $this->db->insert('tb_detail_pembayaran', $arr);
    }
  }




   

    


    

 

}
   
/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */
