<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}
    function laporan_tamu($tanggal_pendaftaran, $tanggal_pendaftaran2){
      $query = $this->db->select('*')
                ->from('tb_pendaftaran')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi')
                ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah')
                ->where('tanggal_pendaftaran >=', $tanggal_pendaftaran)
                ->where('tanggal_pendaftaran <=', $tanggal_pendaftaran2)
                ->order_by("tanggal_pendaftaran", "asc")
                ->get();
      $row = $query->result();
      $coo = $this->db->select('count(tb_pendaftaran.nama_pendaftar) as total')
                ->from('tb_pendaftaran')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi')
                ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah')
                ->where('tanggal_pendaftaran >=', $tanggal_pendaftaran)
                ->where('tanggal_pendaftaran <=', $tanggal_pendaftaran2)
                ->get();
      $eee = $coo->row();

                if ($query->num_rows() > 0)
                { 
                  $tanggal_pendaftaran = date("d-m-Y", strtotime($tanggal_pendaftaran));
                  $tanggal_pendaftaran2 = date("d-m-Y", strtotime($tanggal_pendaftaran2));
                  $no = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body">
            <h4><b>Laporan Jumlah Tamu</h4></b>
            <table>
              <tr>
                <td width="120px">Perguruan Tinggi</td>
                <td width="300px">: 033082 - STIE Jakarta International College</td>
                <td width="120px">Alamat</td>
                <td>: Jalan Perunggu No 53-54 10640</td>
              </tr>
              <tr>
                <td width="120px">Tanggal Awal</td>
                <td width="300px">: '.$tanggal_pendaftaran.'</td>
                <td width="120px">Tanggal Akhir</td>
                <td>: '.$tanggal_pendaftaran2.'</td>
              </tr>
              <tr>
                <td width="120px">Jumlah Tamu</td>
                <td width="300px">: '.$eee->total.'</td>
              </tr>
            </table>
            <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Tamu</th>
                  <th>Asal Sekolah</th>
                  <th>Minat Prodi</th>
                  <th>Waktu</th>
                  <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $data) {
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->nama_pendaftar."</td>
                      <td>".$data->nama_sekolah."</td>
                      <td>".$data->nama_prodi."</td>
                      <td>".$data->waktu."</td>
                      <td>".$data->tanggal_pendaftaran."</td>
                    </tr>";
                    
                  }
                  $option .= '</tbody>
              </table>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>';
                  echo $option;

                } else{
                $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Semester</th>
                </tr>
                </thead>
                <tbody>
                  <td></td><td></td>
                  </tbody>
              </table>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>';
                  echo $option;
                
                }
    }
    function laporan_mahasiswa($id_periode, $id_prodi){
      $query = $this->db->select('*')
                ->from('tb_kp')
                ->join('tb_kelas_mhs','tb_kelas_mhs.id_kp=tb_kp.id_kp')
                ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
                ->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa')
                ->join('tb_konsentrasi','tb_mahasiswa.id_konsentrasi=tb_konsentrasi.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_kp.id_prodi')
                ->join('tb_angkatan','tb_angkatan.id_angkatan=tb_mahasiswa.id_angkatan')
                ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
                ->where('tb_periode.semester' , $id_periode)
                ->like('tb_kp.id_prodi' , $id_prodi)
                ->order_by("tb_angkatan.angkatan", "asc")
                ->get();
      $row = $query->result();
      $pp = $this->db->select('nama_prodi')
            ->where('id_prodi', $id_prodi)
            ->get('tb_prodi')
            ->row();
      $coo = $this->db->select('count(tb_mahasiswa.nama_mahasiswa) as total')
                ->from('tb_kp')
                ->join('tb_kelas_mhs','tb_kelas_mhs.id_kp=tb_kp.id_kp')
                ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
                ->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa')
                ->join('tb_konsentrasi','tb_mahasiswa.id_konsentrasi=tb_konsentrasi.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_kp.id_prodi')
                ->join('tb_angkatan','tb_angkatan.id_angkatan=tb_mahasiswa.id_angkatan')
                ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
                ->where('tb_periode.semester' , $id_periode)
                ->like('tb_kp.id_prodi' , $id_prodi)
                ->get();
      $total = $coo->row();

                if ($query->num_rows() > 0)
                { 
                  if(empty($pp->nama_prodi)){
                    $cc = 'All';
                  } else {
                    $cc = $pp->nama_prodi;
                  }
                  $no = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
          
            <h4><b>Laporan Mahasiswa</h4></b>
            <table>
              <tr>
                <td width="120px">Perguruan Tinggi</td>
                <td width="300px">: 033082 - STIE Jakarta International College</td>
                <td width="120px">Alamat</td>
                <td>: Jalan Perunggu No 53-54 10640</td>
              </tr>
              <tr>
                <td width="120px">Periode</td>
                <td width="300px">: '.$id_periode.'</td>
                <td width="120px">Program Studi</td>
                <td>: '.$cc.'</td>
              </tr>
              <tr>
                <td width="120px">Jumlah Mahasiswa</td>
                <td width="300px">: '.$total->total.'</td>
              </tr>
            </table>
            <br>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Mahasiswa</th>
                  <th>Program Studi</th>
                  <th>Konsentrasi</th>
                  <th>Waktu</th>
                  <th>Angkatan</th>
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $data) {
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->nama_mahasiswa."</td>
                      <td>".$data->nama_prodi."</td>
                      <td>".$data->nama_konsentrasi."</td>
                      <td>".$data->waktu."</td>
                      <td>".$data->angkatan."</td>
                    </tr>"
                    ;
                    
                  }
                  $option .= '</tbody>
              </table>
            </div>
            
            <!-- /.box-body -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>';
                  echo $option;

                } else{
                echo '<span class="label label-success"> Tidak Ada Data.</span>';
                
                }
    }
    function getPeriode()
    {
        $ea =  $this->db->select('tb_periode.semester')
                ->distinct()
                ->from('tb_periode')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_periode.id_prodi')
                ->get();
        return $ea->result();

    }
    function getProdi()
    {
        $ea =  $this->db->select('tb_prodi.id_prodi, tb_prodi.nama_prodi')
                ->distinct()
                ->from('tb_periode')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_periode.id_prodi')
                ->get();
        return $ea->result();

    }
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */