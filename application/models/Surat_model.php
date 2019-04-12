<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

   public function dashboard_surat(){

    $data_unconfirm = $this->db->select('count(*) as total')
                ->where('id_status_sisp', '1')
                ->get('tb_sisp')
                ->row();

    $data_unconfirm_dosen = $this->db->select('count(*) as total')
                ->where('id_status_sisp', '1')
                ->where('verificator', $this->session->userdata('username'))
                ->get('tb_sisp')
                ->row();

    $data_all = $this->db->select('count(*) as total')
                ->get('tb_sisp')
                ->row();

    $data_approved = $this->db->select('count(*) as total')
                ->where('id_status_sisp', '4')
                ->get('tb_sisp')
                ->row();

    $data_verified = $this->db->select('count(*) as total')
                ->where('id_status_sisp', '2')
                ->get('tb_sisp')
                ->row();

    $data_rejected = $this->db->select('count(*) as total')
                ->where('id_status_sisp', '5')
                ->get('tb_sisp')
                ->row();

    return array(
      'data_unconfirm_dosen' => $data_unconfirm_dosen->total,
      'data_unconfirm' => $data_unconfirm->total,
      'data_all' => $data_all->total,
      'data_approved' => $data_approved->total,
      'data_verified' => $data_verified->total,
      'data_rejected' => $data_rejected->total

      );
  }

  public function data_sisp_all(){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_sisp.id_mahasiswa')
              ->join('tb_status_sisp','tb_status_sisp.id_status_sisp=tb_sisp.id_status_sisp')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_sisp.verificator','left')
              ->order_by('tb_sisp.tgl_permohonan', 'DESC')
              ->get('tb_sisp')
              ->result();
  }

   public function data_sisp(){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_sisp.id_mahasiswa')
              ->join('tb_status_sisp','tb_status_sisp.id_status_sisp=tb_sisp.id_status_sisp')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_sisp.verificator','left')
              ->where('tb_sisp.id_status_sisp', 1)
              ->order_by('tb_sisp.tgl_permohonan', 'ASC')
              ->get('tb_sisp')
              ->result();
  }

	public function data_sisp_approved(){
		return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_sisp.id_mahasiswa')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_status_sisp','tb_status_sisp.id_status_sisp=tb_sisp.id_status_sisp')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->where('tb_sisp.id_status_sisp', 4)
              ->get('tb_sisp')
              ->result();
	}

  public function data_sisp_verified(){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_sisp.id_mahasiswa')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_status_sisp','tb_status_sisp.id_status_sisp=tb_sisp.id_status_sisp')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_sisp.verificator','left')
              ->where('tb_sisp.id_status_sisp', 2)
              ->order_by('tb_sisp.tgl_verifikasi', 'ASC')
              ->get('tb_sisp')
              ->result();
  }
  public function data_sisp_rejected(){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_sisp.id_mahasiswa')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_status_sisp','tb_status_sisp.id_status_sisp=tb_sisp.id_status_sisp')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->where('tb_sisp.id_status_sisp', 5)
              ->get('tb_sisp')
              ->result();
  }

  public function data_sisp_mhs($id_mahasiswa){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_sisp.id_mahasiswa')
              ->join('tb_status_sisp','tb_status_sisp.id_status_sisp=tb_sisp.id_status_sisp')
              ->where('tb_sisp.id_mahasiswa', $id_mahasiswa)
              ->get('tb_sisp')
              ->result();
  }

   public function data_sisp_dosen($id_dosen){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_sisp.id_mahasiswa')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_status_sisp','tb_status_sisp.id_status_sisp=tb_sisp.id_status_sisp')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->where('tb_sisp.verificator', $id_dosen)
              ->where('tb_sisp.id_status_sisp', 1)
              ->order_by('tb_sisp.tgl_permohonan', 'ASC')
              ->get('tb_sisp')
              ->result();
  }

  public function detail_sisp($no_permohonan){
    return $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_sisp.id_mahasiswa')
              ->join('tb_status_sisp','tb_status_sisp.id_status_sisp=tb_sisp.id_status_sisp')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_sisp.verificator','left')
              ->where('tb_sisp.no_permohonan', $no_permohonan)
              ->get('tb_sisp')
              ->row();
  }

  public function pilih_max_code(){
    return $this->db->select('MAX(no_permohonan) as no_max')
              ->get('tb_sisp')
              ->row();
  }

  public function simpan_sisp($id_mahasiswa, $semester_romawi)
    {        
        $data = array(
            'no_permohonan'      => $this->buat_kode(),
            'tgl_permohonan'      => date('Y-m-d'),
            'id_mahasiswa'      => $id_mahasiswa,
            'semester_romawi'      => $semester_romawi,
            'judul_skripsi'     => $this->input->post('judul_skripsi', TRUE),
            'nama_pt'     => $this->input->post('nama_pt', TRUE),
            'alamat_pt'     => $this->input->post('alamat_pt', TRUE),
            'id_status_sisp'     => '1',
            'verificator'      => $this->input->post('verificator', TRUE),
        );
    
        $this->db->insert('tb_sisp', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }
    }

    public function verifikasi_sisp($no_permohonan){
    $data = array(
            'id_status_sisp'         => '2',
            'tgl_verifikasi'         => date('Y-m-d')
      );

    if (!empty($data)) {
            $this->db->where('no_permohonan', $no_permohonan)
        ->update('tb_sisp', $data);

          return true;
        } else {
            return null;
        }
  }

  public function setujui_sisp($no_permohonan){
    $data = array(
            'no_permohonan'        => $this->input->post('no_permohonan2'),
            'no_surat'        => $this->input->post('no_surat'),
            'id_status_sisp'         => '4',
            'tgl_persetujuan'         => date('Y-m-d'),
            'approver'         => 'Zahroh'
      );

    if (!empty($data)) {
            $this->db->where('no_permohonan', $no_permohonan)
        ->update('tb_sisp', $data);

          return true;
        } else {
            return null;
        }
  }

  public function edit_sisp($no_permohonan){
    $data = array(
            'judul_skripsi'     => $this->input->post('judul_skripsi', TRUE),
            'nama_pt'     => $this->input->post('nama_pt', TRUE),
            'alamat_pt'     => $this->input->post('alamat_pt', TRUE),
      );

    if (!empty($data)) {
            $this->db->where('no_permohonan', $no_permohonan)
        ->update('tb_sisp', $data);

          return true;
        } else {
            return null;
        }
  }

   public function tolak_sisp($no_permohonan){
    $data = array(
            'no_permohonan'        => $this->input->post('no_permohonan'),
            'note'     => $this->input->post('note', TRUE),
            'id_status_sisp'        => '5',
      );

    if (!empty($data)) {
            $this->db->where('no_permohonan', $no_permohonan)
        ->update('tb_sisp', $data);

          return true;
        } else {
            return null;
        }
  }

   public function hapus_sisp($no_permohonan){
        $this->db->where('no_permohonan', $no_permohonan)
          ->delete('tb_sisp');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function session_surat_mahasiswa($id_mahasiswa){
      return $this->db->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_status_mhs','tb_status_mhs.id_status=tb_mahasiswa.id_status')        
              ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
              ->join('tb_dosen','tb_dosen.id_dosen=tb_prodi.id_dosen')
              ->join('tb_ld','tb_ld.id_mahasiswa=tb_mahasiswa.id_mahasiswa','left')
              ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
              ->get('tb_mahasiswa')
              ->row();
  }

    public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_sisp.no_permohonan,4) as kode', FALSE);
          $this->db->order_by('no_permohonan','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_sisp');      //cek dulu apakah ada sudah ada kode di tabel.    
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
          $kodejadi = "SP".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

    function cek_no_surat($no_surat){
      $query = $this->db->select('*')
                ->from('tb_sisp')
                ->where('no_surat', $no_surat)
                ->get();
                if ($query->num_rows() > 0)
                {
                    echo '<span class="label label-danger">No. Surat Sudah Ada</span><script>document.getElementById("myBtn").disabled = true;</script>';

                } else{
                echo '<span class="label label-success"> No. Surat Tersedia </span><script>document.getElementById("myBtn").disabled = false;</script>';
                
                }
    }


}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */