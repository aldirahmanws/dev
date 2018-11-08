<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}
  function barang_gg(){
    $hasil=$this->db->query("SELECT * FROM tb_pembayaran");
    return $hasil->result();
  }
  public function autocomplete($nama){

    // $this->db->like('nama_mahasiswa' , $nama, 'BOTH');
    // $this->db->order_by('id_mahasiswa', 'asc');
    // $this->db->limit(5);
    // return $this->db->get('tb_mahasiswa')->result();
     $this->db->select('*');
     $this->db->from('tb_mahasiswa');
     // $this->db->join('tb_pembayaran','tb_mahasiswa.id_mahasiswa=tb_pembayaran.id_mahasiswa');
     $this->db->like('tb_mahasiswa.nim',$nama);
     $this->db->or_like('tb_mahasiswa.nama_mahasiswa',$nama);
     $query = $this->db->get();
     return $query->result();
  }
  function coba_mahasiswa($id){
    $this->db->select('*');
     $this->db->from('tb_pembayaran');
     $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_pembayaran.id_mahasiswa');
     $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_pembayaran.id_biaya');
     $this->db->where('tb_pembayaran.id_mahasiswa', $id);
     $query = $this->db->get();
     return $query->result();
  }
  function get_data_ranking($id){
    $this->db->select('*');
     $this->db->from('tb_mahasiswa');
     $this->db->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_pembayaran.id_mahasiswa');
     $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_pembayaran.id_biaya');
     $this->db->where('tb_pembayaran.id_mahasiswa', $id);
     $query = $this->db->get();
     return $query->result();
  }

   public function riwayat_pembayaran($id_mahasiswa){
    $this->db->select('*');
     $this->db->from('tb_pembayaran');
     $this->db->where('tb_pembayaran.id_mahasiswa', $id_mahasiswa);
     $query = $this->db->get();
     return $query->result();
  }

  public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_pembayaran.kode_pembayaran,6) as kode', FALSE);
          $this->db->order_by('kode_pembayaran','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_pembayaran');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }
          $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "KP".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }
  public function dashboard(){
    $belum_bayar = $this->db->select('count(*) as total')
                ->where('id_status','Proses Pengecekan')
                ->get('tb_pendaftaran')
                ->row();

    $lunas = $this->db->query("SELECT COUNT(*) AS total FROM tb_pendaftaran WHERE id_status = '20' OR id_status = '1'")->row();

    return array(
      'belum_bayar' => $belum_bayar->total,
      'lunas' => $lunas->total

      );
  }

	public function data_mahasiswa(){
		return $this->db->where('id_status' , 23)
		->order_by('id_pendaftaran','ASC')
		->get('tb_pendaftaran')
		->result();
	}
 

  public function data_lunas(){
    $query = $this->db->query("SELECT * FROM tb_pendaftaran WHERE id_status = '20' OR id_status = '1'")->result();
    return $query;
  }

	public function save_konfirmasi($id_pendaftaran){
    $data = array(
       'id_pendaftaran'     => $id_pendaftaran,
       'id_du'            => $this->input->post('id_daftar_ulang', TRUE),
        'id_status'  => '20',
        'tanggal_konfirmasi'  => date('Y-m-d')
      );

    $this->db->where('id_pendaftaran', $id_pendaftaran)
        ->update('tb_pendaftaran', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function gagal_konfirmasi($id_pendaftaran){
    $data = array(
       'id_pendaftaran'     => $id_pendaftaran,
        'id_status'  => '21'
      );

    $this->db->where('id_pendaftaran', $id_pendaftaran)
        ->update('tb_pendaftaran', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  function cek_id_daftar_ulang($id){
      $query = $this->db->select('*')
                ->from('tb_pendaftaran')
                ->where('id_du', $id)
                ->get();
                if ($query->num_rows() > 0)
                {
                    echo '<span class="label label-danger">No Registrasi Tidak Tersedia</span>
                    <input type="hidden" name="reg" class="callout callout-danger" id="reg" value="No Regristrasi Tidak Tersedia">
                    <script>document.getElementById("btn_update").disabled = true;</script>';
                    $this->db->reconnect();
                } else{
                echo '<span class="label label-success">No Registrasi Tersedia</span>
                      <input type="hidden" name="reg" class="btn btn-info" id="reg" value="No Registrasi Tersedia" readonly="">
                      <script>document.getElementById("btn_update").disabled = false;</script>';
                    $this->db->reconnect();

                
                }
    }
     public function get_dropdown_pembayaran($data, $waktu, $periode){
      $this->db->select('*');
     $this->db->from('tb_biaya');
     $this->db->join('tb_waktu','tb_waktu.id_waktu=tb_biaya.id_waktu');
     $this->db->where('tb_waktu.waktu', $waktu);
     $this->db->where('tb_biaya.jenis_biaya', $data);
     $this->db->where('tb_biaya.periode', $periode);
     $query = $this->db->get();
     return $query->result();
  }
  public function get_ta($data, $waktu){
      $this->db->distinct();
      $this->db->select('tb_biaya.jenis_biaya');
     $this->db->from('tb_biaya');
     $this->db->join('tb_waktu','tb_waktu.id_waktu=tb_biaya.id_waktu');
     $this->db->where('tb_waktu.waktu', $waktu);
     $this->db->where('tb_biaya.periode', $data);
     $query = $this->db->get();
     return $query->result();
  }
  public function get_biaya_pembayaran($data){
      return $this->db->where('id_biaya',$data)
              ->get('tb_biaya')
              ->row();
  }
  public function get_yaya($data){
      return $this->db->where('id_grade',$data)
              ->get('tb_grade')
              ->row();
  }
  function get_data_detail_mahasiswa($ya){
    return $this->db->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
              ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
              ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
              ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin')
              ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
              ->join('tb_grade','tb_grade.id_grade=tb_mahasiswa.id_grade', 'left')
              ->where('tb_mahasiswa.id_mahasiswa', $ya)
              ->get('tb_mahasiswa')

              ->row();
  }
  public function tambah_pembayaran()
    {
        $data = array(
            'id_mahasiswa'                        => $this->input->post('id_mhsa'),
            'id_biaya'                        => $this->input->post('pembayaran'),
            'total_biaya'                 => $this->input->post('biaya')
            
        );
    
        $this->db->insert('tb_pembayaran', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function all(){
    //query semua record di table products
    $hasil = $this->db->get('tb_biaya');
    if($hasil->num_rows() > 0){
      return $hasil->result();
    } else {
      return array();
    }
  }
  
  public function find($id){
    //Query mencari record berdasarkan ID-nya
    $hasil = $this->db->where('id_biaya', $id)
              ->limit(1)
              ->get('tb_biaya');
    if($hasil->num_rows() > 0){
      return $hasil->row();
    } else {
      return array();
    }
  }
  public function simpan_cart()
    {
        $data = array(
             'kode_pembayaran'      => $this->input->post('kode_pembayaran'),
             'id_mahasiswa'   => $this->input->post('id_mhsa'),
             'id_biaya'   => $this->input->post('pembayaran'),
             'tanggal_pembayaran'    => $this->input->post('tanggal_pembayaran')
            
        );
    
        $this->db->insert('tb_detail_pembayaran', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }
    public function data_pembayaran_mahasiswa($ya){
    $this->db->select('*');
    
     $this->db->from('tb_mahasiswa');
     $this->db->join('tb_detail_pembayaran','tb_detail_pembayaran.id_mahasiswa=tb_mahasiswa.id_mahasiswa');
     $this->db->join('tb_biaya','tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya');
     $this->db->join('tb_grade','tb_grade.id_grade=tb_detail_pembayaran.id_grade', 'left');
     $this->db->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_pembayaran.kode_matkul' ,'left');
     $this->db->join('tb_pembayaran','tb_pembayaran.kode_pembayaran=tb_detail_pembayaran.kode_pembayaran');
     $this->db->where('tb_mahasiswa.id_mahasiswa', $ya);
     $query = $this->db->get();
     return $query->result();
    }

    public function simpan_pembayaran()
    {
          $invoice = array(
             'kode_pembayaran'      => $this->input->post('kodeku_pembayaran'),
             'id_mahasiswa'   => $this->input->post('id_mhsa')
            
        );
        $this->db->insert('tb_pembayaran', $invoice);
        // put ordered items in orders table
        foreach($this->cart->contents() as $item){
          $data = array(
            'kode_pembayaran'    => $item['kode'],
            'id_mahasiswa'    => $item['idmhsa'],
            'id_biaya'    => $item['id'],
            'kode_matkul'    => $item['kdmatkul'],
            'tanggal_pembayaran'       => $item['tgl'],
            'id_grade'       => $item['idgrade'],
            'potongan'       => $item['potongan'],
            'denda'       => $item['denda'],
            'keterangan'       => $item['keterangan']
          );
          $this->db->insert('tb_detail_pembayaran', $data);
        }
        
        return TRUE;

    }
    function cek_mahasiswa($id_mahasiswa){
      $query = $this->db->select('*')
                ->from('tb_mahasiswa')
                ->join('tb_bio','tb_bio.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
                ->join('tb_kelamin','tb_kelamin.id_kelamin=tb_bio.id_kelamin')
                ->join('tb_grade','tb_grade.id_grade=tb_mahasiswa.id_grade')
                ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
                ->where('tb_mahasiswa.id_mahasiswa', $id_mahasiswa)
                ->get();
      $row = $query->row();
                if ($query->num_rows() > 0)
                {
                    echo '<div class="box-body">
              <table class="table">
        <tr>


            <td width="15%" class="left_column">Nama Mahasiswa <font color="#FF0000">*</font></td>
            <td>:  '.$row->nama_mahasiswa.' </td>
      
           <td class="left_column" width="25%">NIM <font color="#FF0000">*</font></td>
            <td>:  '.$row->nim.'
                                     </td>
                                  
           
            </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=>Jenis Kelamin <font color="#FF0000">*</font></td>
            <td width="25%">: '.$row->jenis_kelamin.'       </td>
            <td class="left_column" width="15%">Ranking <font color="#FF0000">*</font></td>
            <td>: '.$row->grade.'
                                     </td>
        </tr>
        <tr>
            <td class="left_column">Nomor Telephone</td>
            <td>: '.$row->no_telepon.'</td>
            <td class="left_column">Program Studi <font color="#FF0000">*</font></td>
            <td>: '.$row->nama_prodi.'</td>
          </tr>
           <tr>
            <td class="left_column">Kelas </td>
            <td>: '.$row->waktu.'</td>
            <td colspan="2"><a href="'.base_url('finance/detail_pembayaran/'.$row->id_mahasiswa).'" class="btn btn-warning btn-sm">Lihat</a></td>
          </tr>
        </table>
            </div>';

                } else{
                echo '<span class="label label-success"> NIM  Available.</span>';
                
                }
    }
    
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */
