<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    

	public function __construct()
	{
		parent::__construct();
	}
  public function pie_chart(){
    $a = $this->db->select('tb_prodi.nama_prodi, count(tb_prodi.id_prodi) as jumlah')
                    ->join('tb_konsentrasi', 'tb_konsentrasi.id_konsentrasi = tb_mahasiswa.id_konsentrasi')
                    ->join('tb_prodi', 'tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                    ->group_by('tb_prodi.nama_prodi')
                    ->get('tb_mahasiswa')
                    ->result();
        
        foreach ($a as $key) {
            $b = '#'.dechex(rand(0x777777, 0xFFFFFF));
            $arrayName[] = array('value' => $key->jumlah,
                                'color' => $b,
                                'label' => $key->nama_prodi);
        }
        $c = json_encode($arrayName);
        return $c;
  }
  public function dashboard_admin(){
    $jml_user = $this->db->select('count(*) as total')
                ->get('tb_user')
                ->row();
    $data_mhs_aktif = $this->db->query("SELECT count(*) AS total FROM tb_mahasiswa where id_status = '1' OR id_status = '19' ")->row();

    $data_prodi = $this->db->select('count(*) as total')
                ->get('tb_prodi')
                ->row();

    $data_dosen = $this->db->select('count(*) as total')
                ->get('tb_dosen')
                ->row();

    $data_mhs = $this->db->query("SELECT count(*) AS total FROM tb_mahasiswa")->row();

    return array(
      'data_mhs_aktif' => $data_mhs_aktif->total,
      'data_prodi' => $data_prodi->total,
      'data_dosen' => $data_dosen->total,
      'data_mhs' => $data_mhs->total,
      'jml_user' => $jml_user->total

      );
  }
	public function dashboard_finance(){
    $belum_bayar = $this->db->select('count(*) as total')
                ->where('id_status','23')
                ->get('tb_pendaftaran')
                ->row();

    $lunas = $this->db->query("SELECT COUNT(*) AS total FROM tb_pendaftaran WHERE id_status = 20 OR id_status = 1")->row();

    return array(
      'belum_bayar' => $belum_bayar->total,
      'lunas' => $lunas->total

      );
  }
  public function dashboard_marketing_data(){
    $yes = $this->db->query('SELECT distinct(DATE_FORMAT(tanggal_pendaftaran,"%Y-%m")) as tanggal_pendaftaran FROM `tb_pendaftaran` order by tanggal_pendaftaran desc LIMIT 3');
    return $yes->result();
    
        
  }
  public function dashboard_marketing_data2(){
    $yes = $this->db->query('SELECT distinct(DATE_FORMAT(tgl_du,"%Y-%m")) as tgl_du FROM `tb_mahasiswa` JOIN tb_pendidikan ON tb_pendidikan.id_mahasiswa = tb_mahasiswa.id_mahasiswa  order by tgl_du desc LIMIT 3');
    return $yes->result();
              
        
  } 

  public function dashboard_semester_ipk($id_mahasiswa){
    return $this->db->where('id_mahasiswa', $id_mahasiswa)
                    ->order_by('semester_ak', 'asc')
                    ->get('tb_aktivitas_perkuliahan')
                    ->result();
              
        
  }  
  public function dashboard_marketing(){
    $data_tamu = $this->db->select('count(*) as total')
                ->get('tb_pendaftaran')
                ->row();

    $data_peserta_tes = $this->db->select('count(*) as total')
                ->get('tb_hasil_tes')
                ->row();

    $data_sgs = $this->db->select('count(*) as total')
                ->where('id_status', 1)
                ->where('sgs is NOT NULL')
                ->where('sgs !=',' ')
                ->get('tb_pendaftaran')
                ->row();
     $data_mhs = $this->db->query("SELECT count(*) AS total FROM tb_mahasiswa where id_status = '1' OR id_status = '19' ")->row();

    return array(
      'data_tamu' => $data_tamu->total,
      'data_peserta_tes' => $data_peserta_tes->total,
      'data_mhs' => $data_mhs->total,
      'data_sgs' => $data_sgs->total

      );
  }
  public function dashboard_akademik(){
    $data_mhs_aktif = $this->db->query("SELECT count(*) AS total FROM tb_mahasiswa where id_status = '1' OR id_status = '19' ")->row();

    $data_prodi = $this->db->select('count(*) as total')
                ->get('tb_prodi')
                ->row();

    $data_dosen = $this->db->select('count(*) as total')
                ->get('tb_dosen')
                ->row();

   $data_mhs = $this->db->query("SELECT count(*) AS total FROM tb_mahasiswa")->row();

    return array(
      'data_mhs_aktif' => $data_mhs_aktif->total,
      'data_prodi' => $data_prodi->total,
      'data_dosen' => $data_dosen->total,
      'data_mhs' => $data_mhs->total,

      );
  }

  public function dashboard_dosen($id_dosen){
    $data_kelas = $this->db->select('count(*) as total')
                ->join('tb_kp', 'tb_kp.id_kp=tb_kelas_dosen.id_kp')
                ->join('tb_periode', 'tb_periode.id_periode=tb_kp.id_periode')
                ->where('tb_kelas_dosen.id_dosen', $id_dosen)
                ->where('tb_periode.tgl_awal_kul <=', date('Y-m-d'))
                ->where('tb_periode.tgl_akhir_kul >=', date('Y-m-d'))
                ->get('tb_kelas_dosen')
                ->row();
     return array(
      'data_kelas' => $data_kelas->total
      );
        
  }

  public function notifikasi_pembayaran($id_mahasiswa, $semester_aktif, $id_waktu){
    if($id_waktu == '1'){
      if($semester_aktif == '1'){
        $cek = $this->db->select('count(*) as total')
                ->where('tb_detail_pembayaran.id_mahasiswa', $id_mahasiswa)
                ->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
                ->get('tb_detail_pembayaran')
                ->row();
        if($cek->total != 5){
          return '<div class="alert alert-danger"> Harap Lunasi Angsuran </div>';
        }
      }
    }
  }
	
  
}

/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */