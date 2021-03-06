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
                ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah','left')
                ->join('tb_pt','tb_pt.id_pt=tb_pendaftaran.id_pt','left')
                ->join('tb_waktu','tb_waktu.id_waktu=tb_pendaftaran.id_waktu','left')
                ->where('tanggal_pendaftaran >=', $tanggal_pendaftaran)
                ->where('tanggal_pendaftaran <=', $tanggal_pendaftaran2)
                ->order_by("tanggal_pendaftaran", "asc")
                ->get();
      $row = $query->result();
      $coo = $this->db->select('count(tb_pendaftaran.nama_pendaftar) as total')
                ->from('tb_pendaftaran')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi')
                ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah','left')
                ->join('tb_pt','tb_pt.id_pt=tb_pendaftaran.id_pt','left')
                ->join('tb_waktu','tb_waktu.id_waktu=tb_pendaftaran.id_waktu','left')
                ->where('tanggal_pendaftaran >=', $tanggal_pendaftaran)
                ->where('tanggal_pendaftaran <=', $tanggal_pendaftaran2)
                ->order_by("tanggal_pendaftaran", "asc")
                ->get();
      $eee = $coo->row();

                if ($query->num_rows() > 0)
                { 
                  $tanggal_pendaftaran = date("d M Y", strtotime($tanggal_pendaftaran));
                  $tanggal_pendaftaran2 = date("d M Y", strtotime($tanggal_pendaftaran2));
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
                    if ($data->id_pt == NULL OR $data->id_pt == '') {
                      $asal = $data->nama_sekolah;
                    } else {
                      $asal = $data->nama_pt;
                    }
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->nama_pendaftar."</td>
                      <td>".$asal."</td>
                      <td>".$data->nama_prodi."</td>
                      <td>".$data->waktu."</td>
                      <td>".date("d M Y", strtotime($data->tanggal_pendaftaran))."</td>
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
                  $option .= '
                  <section class="content" id="ea">
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
    function laporan_mahasiswa($id_periode, $id_prodi, $filter, $tgl_du){      
      if($filter == 'angkatan'){
        $a = 'tb_pendidikan.tgl_du';
        $b = $tgl_du;
        $c = 'Angkatan';
      } else {
        $a = 'tb_periode.semester';
        $b = $id_periode;
        $c = 'Periode';
      }
      $query = $this->db->select('tb_prodi.id_prodi, tb_mahasiswa.nama_mahasiswa, tb_mahasiswa.nim, tb_bio.tempat_lahir, tb_bio.tanggal_lahir, tb_ibu.nama_ibu, tb_agama.agama, tb_kependudukan.nik, tb_alamat.kecamatan, tb_alamat.kelurahan, tb_sekolah.nama_sekolah, tb_pt.nama_pt, tb_mahasiswa.id_sekolah')
                ->join('tb_pendidikan', 'tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_periode','tb_periode.id_periode=tb_pendidikan.id_periode')
                ->join('tb_bio','tb_mahasiswa.id_mahasiswa=tb_bio.id_mahasiswa')
                ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
                ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
                ->join('tb_ibu','tb_ibu.id_mahasiswa=tb_mahasiswa.id_mahasiswa', 'left' )
                ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_mahasiswa.id_mahasiswa', 'left' )
                ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa', 'left' )
                ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah', 'left')
                ->join('tb_pt','tb_pt.id_pt=tb_pendidikan.asal_pt','left')
                ->like($a , $b)
                ->like('tb_prodi.id_prodi' , $id_prodi)
                ->where('tb_mahasiswa.id_status !=', 2)
                ->get('tb_mahasiswa');
      $row = $query->result();
      $pp = $this->db->select('nama_prodi')
            ->where('id_prodi', $id_prodi)
            ->get('tb_prodi')
            ->row();
      $coo = $this->db->select('count(tb_mahasiswa.nama_mahasiswa) as total')
                ->join('tb_pendidikan', 'tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_periode','tb_periode.id_periode=tb_pendidikan.id_periode')
                ->join('tb_bio','tb_mahasiswa.id_mahasiswa=tb_bio.id_mahasiswa')
                ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
                ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
                ->join('tb_ibu','tb_ibu.id_mahasiswa=tb_mahasiswa.id_mahasiswa', 'left' )
                ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_mahasiswa.id_mahasiswa', 'left' )
                ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa', 'left' )
                ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah', 'left')
                ->join('tb_pt','tb_pt.id_pt=tb_pendidikan.asal_pt','left')
                ->like('tb_periode.semester' , $id_periode)
                ->like('tb_prodi.id_prodi' , $id_prodi)
                ->where('tb_mahasiswa.id_status !=', 2)
                ->get('tb_mahasiswa');
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
                <td width="120px">'.$c.'</td>
                <td width="300px">: '.$b.'</td>
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
                  <th>Kode Prodi</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Tempat, Tanggal Lahir</th>
                  <th>Ibu Kandung</th>
                  <th>Agama</th>
                  <th>NIK</th>
                  <th>Kelurahan</th>
                  <th>Kecamatan</th>
                  <th>Asal</th>
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $data) {
                    if ($data->id_sekolah == NULL OR $data->id_sekolah == '') {
                      $asal = $data->nama_pt;
                    } else {
                      $asal = $data->nama_sekolah;
                    }
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->id_prodi."</td>
                      <td>".$data->nim."</td>
                      <td>".$data->nama_mahasiswa."</td>
                      <td>".$data->tempat_lahir.', '.date("d M Y", strtotime($data->tanggal_lahir))."</td>
                      <td>".$data->nama_ibu."</td>
                      <td>".$data->agama."</td>
                      <td>".$data->nik."</td>
                      <td>".$data->kelurahan."</td>
                      <td>".$data->kecamatan."</td>
                      <td>".$asal."</td>
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
                  $this->db->reconnect();
                } else{
                echo '<span class="label label-success"> Tidak Ada Data.</span>';
                
                }
    }
    function laporan_peserta_tes($tanggal_hasil_tes){
      $query = $this->db->select('*')
                ->from('tb_hasil_tes')
                ->join('tb_mahasiswa','tb_mahasiswa.id_hasil_tes=tb_hasil_tes.id_hasil_tes')
                ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah','left')
                ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_status_mhs','tb_status_mhs.id_status=tb_mahasiswa.id_status')
                ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
                ->like('tanggal_hasil_tes', $tanggal_hasil_tes)
                ->get();
      $row = $query->result();
      $coo = $this->db->select('count(tb_hasil_tes.id_hasil_tes) as total')
                ->from('tb_hasil_tes')
                ->join('tb_mahasiswa','tb_mahasiswa.id_hasil_tes=tb_hasil_tes.id_hasil_tes')
                ->like('tanggal_hasil_tes', $tanggal_hasil_tes)
                ->get();
      $eee = $coo->row();

                if ($query->num_rows() > 0)
                { 
                  $no = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body">
            <h4><b>Laporan Peserta Tes</h4></b>
            <table>
              <tr>
                <td width="120px">Perguruan Tinggi</td>
                <td width="300px">: 033082 - STIE Jakarta International College</td>
                <td width="120px">Alamat</td>
                <td>: Jalan Perunggu No 53-54 10640</td>
              </tr>
              <tr>
                <td width="120px">Tahun</td>
                <td width="300px">: '.$tanggal_hasil_tes.'</td>
                <td width="120px">Jumlah Peserta Tes</td>
                <td>: '.$eee->total.'</td>
              </tr>
            </table>
            <br>
              <table id="example1" class="table table-bordered table-striped" style="text-align:center">
                <thead  style="text-align:center">
                <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2">Nama Peserta</th>
                  <th rowspan="2">Asal Sekolah</th>
                  <th rowspan="2">Program Studi</th>
                  <th rowspan="2">Konsentrasi</th>
                  <th colspan="3">Jawaban Benar</th>
                  <th rowspan="2">Nilai</th>
                </tr>
                <tr>
                  <th>MTK</th>
                  <th>B.Inggris</th>
                  <th>Psikotes</th>
                </tr>
                </thead>
                <tbody>';

                  foreach ($row as $data) {
                    if ($data->id_status == 19) {
                       $status_a = 'Aktif';
                    } else {
                      $status_a = $data->status_mhs;
                    }

                    $nilai = ((($data->nilai_mat + $data->nilai_bing + $data->nilai_psikotes) / 9) * 10);

                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->nama_mahasiswa."</td>
                      <td>".$data->nama_sekolah."</td>
                      <td>".$data->nama_prodi."</td>
                      <td>".$data->nama_konsentrasi."</td>
                      <td>".$data->nilai_mat."</td>
                      <td>".$data->nilai_bing."</td>
                      <td>".$data->nilai_psikotes."</td>
                      <td>".round($nilai,2)."</td>
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
                  $option .= '
                  <section class="content" id="ea">
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
    function laporan_data_getstudent($tanggal){
      $query = $this->db->select('*')
                ->from('tb_pendaftaran')
                ->join('tb_mahasiswa','tb_mahasiswa.nim=tb_pendaftaran.sgs')
                ->like('tb_pendaftaran.tanggal_pendaftaran', $tanggal)
                ->get();
      $row = $query->result();
      $coo = $this->db->select('count(tb_pendaftaran.id_pendaftaran) as total')
                ->from('tb_pendaftaran')
                ->join('tb_mahasiswa','tb_mahasiswa.nim=tb_pendaftaran.sgs')
                ->like('tb_pendaftaran.tanggal_pendaftaran', $tanggal)
                ->get();
      $eee = $coo->row();

                if ($query->num_rows() > 0)
                { 
                  $no = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body">
            <h4><b>Laporan Student Get Student</h4></b>
            <table>
              <tr>
                <td width="120px">Perguruan Tinggi</td>
                <td width="300px">: 033082 - STIE Jakarta International College</td>
                <td width="120px">Alamat</td>
                <td>: Jalan Perunggu No 53-54 10640</td>
              </tr>
              <tr>
                <td width="120px">Tahun</td>
                <td width="300px">: '.$tanggal.'</td>
                <td width="120px">Jumlah Peserta Tes</td>
                <td>: '.$eee->total.'</td>
              </tr>
            </table>
            <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pendaftar</th>
                  <th>Nama Narasumber</th>
                  <th>NIM</th>
                  <th>Tanggal Pendaftaran</th>
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $data) {
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->nama_pendaftar."</td>
                      <td>".$data->nama_mahasiswa."</td>
                      <td>".$data->nim."</td>
                      <td>".date("d-m-Y", strtotime($data->tanggal_pendaftaran))."</td>
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
                  $option .= '
                  <section class="content" id="ea">
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
    function laporan_dmm_dosen($semester, $id_dosen){
      $query = $this->db->select('tb_matkul.kode_matkul, tb_matkul.nama_matkul, tb_matkul.bobot_matkul, tb_kp.id_kp, tb_prodi.nama_prodi, tb_matkul.id_matkul')
                ->distinct()
                ->from('tb_kelas_dosen')
                ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
                ->join('tb_kp','tb_kp.id_kp=tb_kelas_dosen.id_kp')
                ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
                ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
                ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
                ->where('tb_periode.semester' , $semester)
                ->like('tb_kelas_dosen.id_dosen' , $id_dosen)
                ->get();
      $row = $query->result();
      $pp = $this->db->select('nama_dosen')
            ->where('id_dosen', $id_dosen)
            ->get('tb_dosen')
            ->row();

                if ($query->num_rows() > 0)
                { 
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
                <td width="300px">: '.$semester.'</td>
                <td width="120px">Nama Dosen</td>
                <td>: '.$pp->nama_dosen.'</td>
              </tr>
            </table>
            <br>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Matakuliah</th>
                  <th>Nama Matakuliah</th>
                  <th>Sks</th>
                  <th>Jurusan</th>
                  <th>Jumlah Mahasiswa</th>
                </tr>
                </thead>
                <tbody>';
                  $totalsks = 0;
                  foreach ($row as $data) {
                    $totalsks += $data->bobot_matkul;
                    $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE id_kp = '$data->id_kp'")->row();
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->id_matkul."</td>
                      <td>".$data->nama_matkul."</td>
                      <td>".$data->bobot_matkul."</td>
                      <td>".$data->nama_prodi."</td>
                      <td>".$total_mahasiswa->total."</td>
                    </tr>"

                    ;
                    
                  }
                  $option .= '
                  <tr>
                      <td colspan="3" style="text-align:right"> <b>Total SKS : </b></td>
                      <td><b>'.$totalsks.'</b></td>
                      <td colspan="2"></td>
                    </tr>
                  </tbody>
                  
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
    function laporan_dmm_mahasiswa($semester, $id_mahasiswa){
      $query = $this->db->select('*')
                ->from('tb_kelas_mhs')
                ->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
                ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
                ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi', 'left')
                ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum', 'left')
                ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul', 'left')
                ->join('tb_kelas_dosen','tb_kelas_dosen.id_kp=tb_kp.id_kp', 'left')
                ->join('tb_dosen','tb_dosen.id_dosen=tb_kelas_dosen.id_dosen', 'left')
                ->where('tb_periode.semester' , $semester)
                ->where('tb_kelas_mhs.id_mahasiswa' , $id_mahasiswa)
                ->get();
      $row = $query->result();
      $pp = $this->db->select('nama_mahasiswa')
            ->where('id_mahasiswa', $id_mahasiswa)
            ->get('tb_mahasiswa')
            ->row();

                if ($query->num_rows() > 0)
                { 
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
                <td width="300px">: '.$semester.'</td>
                <td width="120px">Nama Mahasiswa</td>
                <td>: '.$pp->nama_mahasiswa.'</td>
              </tr>
              
            </table>
            <br>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Matakuliah</th>
                  <th>Nama Matakuliah</th>
                  <th>Sks</th>
                  <th>Jurusan</th>
                  <th>NIDN</th>
                  <th>Nama Dosen</th>
                </tr>
                </thead>
                <tbody>';
                  
                  foreach ($row as $data) {
                    $totalsks += $data->bobot_matkul;
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->id_matkul."</td>
                      <td>".$data->nama_matkul."</td>
                      <td>".$data->bobot_matkul."</td>
                      <td>".$data->nama_prodi."</td>
                      <td>".$data->nidn."</td>
                      <td>".$data->nama_dosen."</td>
                    </tr>"
                    ;
                    
                  }
                  $option .= '
                   <tr>
                      <td colspan="3" style="text-align:right"> <b>Total SKS : </b></td>
                      <td><b>'.$totalsks.'</b></td>
                      <td colspan="3"></td>
                    </tr>

                    </tbody>
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
    function laporan_dmm_matkul($semester, $kode_matkul){
      $query = $this->db->select('*')
                ->from('tb_kelas_mhs')
                ->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
                ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
                ->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa')
                ->join('tb_bio','tb_mahasiswa.id_mahasiswa=tb_bio.id_mahasiswa')
                ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_konsentrasi','tb_mahasiswa.id_konsentrasi=tb_konsentrasi.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
                ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
                ->where('tb_matkul.kode_matkul', $kode_matkul)
                ->where('tb_periode.semester', $semester)
                ->get();
      $row = $query->result();
      $pp = $this->db->select('nama_matkul')
            ->where('kode_matkul', $kode_matkul)
            ->get('tb_matkul')
            ->row();
      $coo = $this->db->select('count(distinct tb_kelas_mhs.id_mahasiswa) as total')
               ->from('tb_kelas_mhs')
                ->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
                ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
                ->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa')
                ->join('tb_bio','tb_mahasiswa.id_mahasiswa=tb_bio.id_mahasiswa')
                ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_konsentrasi','tb_mahasiswa.id_konsentrasi=tb_konsentrasi.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
                ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
                ->where('tb_matkul.kode_matkul', $kode_matkul)
                ->where('tb_periode.semester', $semester)
                ->get();
      $total = $coo->row();

                if ($query->num_rows() > 0)
                { 
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
                <td width="300px">: '.$semester.'</td>
                <td width="120px">Nama Matakuliah</td>
                <td>: '.$pp->nama_matkul.'</td>
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
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Jurusan</th>
                  <th>Angkatan</th>
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $data) {
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->nim."</td>
                      <td>".$data->nama_mahasiswa."</td>
                      <td>".$data->nama_prodi."</td>
                      <td>".substr($data->tgl_du, 0,4)."</td>
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
    function laporan_khs($id_mahasiswa, $semester){
      $query = $this->db->select('*')
                ->from('tb_kelas_mhs')
                ->join('tb_kp','tb_kp.id_kp=tb_kelas_mhs.id_kp')
                ->join('tb_periode','tb_periode.id_periode=tb_kp.id_periode')
                ->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa')
                ->join('tb_bio','tb_mahasiswa.id_mahasiswa=tb_bio.id_mahasiswa')
                ->join('tb_konsentrasi','tb_mahasiswa.id_konsentrasi=tb_konsentrasi.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')
                ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kp.id_detail_kurikulum')
                ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
                ->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai')
                ->like('tb_periode.semester' , $semester)
                ->where('tb_kelas_mhs.id_mahasiswa' , $id_mahasiswa)
                ->get();
      $row = $query->result();
     
      $pp = $this->db->select('*')
            ->where('id_mahasiswa', $id_mahasiswa)            
            ->join('tb_konsentrasi', 'tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
            ->join('tb_prodi', 'tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
            ->join('tb_dosen','tb_dosen.id_dosen=tb_mahasiswa.dosen_pa')
            ->join('tb_grade','tb_grade.id_grade=tb_mahasiswa.id_grade')
            ->get('tb_mahasiswa')
            ->row();

                if ($query->num_rows() > 0)
                { 
                  $no = 0;
                  $no2 = 0;
                  $totalsi = 0;
                  $totalsi2 = 0;
                  $totalbobot = 0;
                  $totalbobot2 = 0;


                  if ($pp->id_waktu == 2) {
                    $tampil_grade = '';
                    $enter = '<br>';
                  } else {
                    $tampil_grade = '<text style="text-align:right; font-size:10px"><b>Grade</b> :  '.$pp->grade.' </text>';
                    $enter = '';
                  }


                  $option = "";
                  $option .= '<section class="content" id="ea">

                  

      <div class="row">

        <div class="col-xs-12">

        <div class="col-xs-12" style="border:1px solid black">

       

        <h4 style="text-align:center" > <b>Kartu Hasil Studi (KHS)</h4></b>
        <br>
        <IMG src="'.base_url().'/uploads/STIE-01.png" class="pull-right" style="width:120px; margin-right: 2%">

            <table style="margin-left:2%; font-size:10px">
              <tr>
                <td width="200px"><b>Nama Mahasiswa</b></td>
                <td width="200px">: '.$pp->nama_mahasiswa.'</td>
              </tr>
              <tr>
                <td><b>NIM</b></td>
                <td>: '.$pp->nim.'</td>
              </tr>
              <tr>
                <td ><b>Program Studi</b></td>
                <td>: '.$pp->nama_prodi.' </td>
              </tr>
              <tr>
                <td ><b>Periode</b></td>
                <td >: '.$semester.'</td>
              </tr>
            </table>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table2 table-bordered table-striped" style="font-size:10px">
                <thead>
                <tr>
                    <th style="width:5%;text-align:center;" height="10" rowspan="2">No.</th>
                    <th style="text-align:center" height="10" rowspan="2">Kode MK</th>
                    <th style="text-align:center" height="10" rowspan="2">Nama MK</th>
                    <th style="text-align:center" height="10" rowspan="2" width="5%">Bobot MK<br />(sks)</th>
                     <th style="text-align:center" height="5" colspan="3">Nilai</th>
                     <th style="text-align:center"  height="10" rowspan="2">sks * N.indeks</th>
                   
                </tr>
                <tr>
                    <th style="width:5%;text-align:center">Angka</th>
                    <th style="width:5%;text-align:center">Huruf</th>
                    <th style="width:5%;text-align:center">Indeks</th>
                    
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $data) {
                    $totalbobot += $data->bobot_matkul;
                    $ea = $data->bobot_matkul * $data->nilai_indeks;
                    $totalsi += $ea;
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td style='text-align:center'>".$data->id_matkul."</td>
                      <td>".$data->nama_matkul."</td>
                      <td style='text-align:center'>".$data->bobot_matkul."</td>
                      <td style='text-align:center'>".$data->nilai_d."</td>
                      <td style='text-align:center'>".$data->nilai_huruf."</td>
                      <td style='text-align:center'>".$data->nilai_indeks."</td>
                      <td style='text-align:center'>".$data->bobot_matkul * $data->nilai_indeks."</td>
                    </tr>"
                    ;
                    
                  }

                   $tanggal = date('m');

                  if ($tanggal == 1) {
                    $bulan = 'Januari';
                  } elseif ($tanggal == 2) {
                    $bulan = 'Februari';
                  } elseif ($tanggal == 3) {
                    $bulan = 'Maret';
                  } elseif ($tanggal == 4) {
                    $bulan = 'April';
                  } elseif ($tanggal == 5) {
                    $bulan = 'Mei';
                  } elseif ($tanggal == 6) {
                    $bulan = 'Juni';
                  } elseif ($tanggal == 7) {
                    $bulan = 'Juli';
                  } elseif ($tanggal == 8) {
                    $bulan = 'Agustus';
                  } elseif ($tanggal == 9) {
                    $bulan = 'September';
                  } elseif ($tanggal == 10) {
                    $bulan = 'Oktober';
                  } elseif ($tanggal == 11) {
                    $bulan = 'November';
                  } else {
                    $bulan = 'Desember';
                  }
                  
                  if ($totalbobot == 0) {
                      $totalbobot = 1;
                  } else {
                      $totalbobot;
                  }

                  

                  $ipk = $totalsi / $totalbobot;
                  $option .= '</tbody>
                  <tr>
                    <td colspan="3" style="text-align:right"> <b> Jumlah Bobot : </b></td>
                    <td style="text-align:center">  '.$totalbobot.' </td>
                    <td colspan="3" style="text-align:right"> <b> Sks * N.indeks : </b></td>
                    <td style="text-align:center"> '.$totalsi.'</td>

                </tr>
                <tr>
                    <td style="text-align:right" colspan="7"> IPS : </td>
                    <td style="text-align:center"> '.substr($ipk,0,4).'  </td>
                </tr>
              </table>

              '.$tampil_grade.'
              

               <text style="text-align:right; font-size:10px;" class="pull-right"> Jakarta, ................................ </text> '.$enter.'

              <p style="text-align:right; font-size:10px"> Pembimbing Akademik </p>

              <br>

              <p style="text-align:right; font-size:10px"> '.$pp->nama_dosen.'</p>
              </div>

            </div>
            </div>

            <br clear="all" style="page-break-before:always" />
            <br clear="all" style="page-break-before:always" />


            <div class="col-xs-12" margin-top:100px>
             <div class="col-xs-12" style="border:1px solid black">

       

        <h4 style="text-align:center" > <b>Kartu Hasil Studi (KHS)</h4></b>
        <br>
        <IMG src="'.base_url().'/uploads/STIE-01.png" class="pull-right" style="width:120px; margin-right: 2%">

            <table style="margin-left:2%; font-size:10px">
              <tr>
                <td width="200px"><b>Nama Mahasiswa</b></td>
                <td width="200px">: '.$pp->nama_mahasiswa.'</td>
              </tr>
              <tr>
                <td><b>NIM</b></td>
                <td>: '.$pp->nim.'</td>
              </tr>
              <tr>
                <td ><b>Program Studi</b></td>
                <td>: '.$pp->nama_prodi.' </td>
              </tr>
              <tr>
                <td ><b>Periode</b></td>
                <td >: '.$semester.'</td>
              </tr>
            </table>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table2 table-bordered table-striped" style="font-size:10px">
                <thead>
                <tr>
                    <th style="width:5%;text-align:center;" height="10" rowspan="2">No.</th>
                    <th style="text-align:center" height="10" rowspan="2">Kode MK</th>
                    <th style="text-align:center" height="10" rowspan="2">Nama MK</th>
                    <th style="text-align:center" height="10" rowspan="2">Bobot MK<br />(sks)</th>
                     <th style="text-align:center" height="5" colspan="3">Nilai</th>
                     <th style="text-align:center"  height="10" rowspan="2">sks * N.indeks</th>
                   
                </tr>
                <tr>
                    <th style="width:5%;text-align:center">Angka</th>
                    <th style="width:5%;text-align:center">Huruf</th>
                    <th style="width:5%;text-align:center">Indeks</th>
                    
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $data) {
                    $totalbobot2 += $data->bobot_matkul;
                    $ea = $data->bobot_matkul * $data->nilai_indeks;
                    $totalsi2 += $ea;
                    $option .= "
                    <tr>
                      <td>".++$no2."</td>
                      <td style='text-align:center'>".$data->id_matkul."</td>
                      <td>".$data->nama_matkul."</td>
                      <td style='text-align:center'>".$data->bobot_matkul."</td>
                      <td style='text-align:center'>".$data->nilai_d."</td>
                      <td style='text-align:center'>".$data->nilai_huruf."</td>
                      <td style='text-align:center'>".$data->nilai_indeks."</td>
                      <td style='text-align:center'>".$data->bobot_matkul * $data->nilai_indeks."</td>
                    </tr>"
                    ;
                    
                  }

                   $tanggal = date('m');

                  if ($tanggal == 1) {
                    $bulan = 'Januari';
                  } elseif ($tanggal == 2) {
                    $bulan = 'Februari';
                  } elseif ($tanggal == 3) {
                    $bulan = 'Maret';
                  } elseif ($tanggal == 4) {
                    $bulan = 'April';
                  } elseif ($tanggal == 5) {
                    $bulan = 'Mei';
                  } elseif ($tanggal == 6) {
                    $bulan = 'Juni';
                  } elseif ($tanggal == 7) {
                    $bulan = 'Juli';
                  } elseif ($tanggal == 8) {
                    $bulan = 'Agustus';
                  } elseif ($tanggal == 9) {
                    $bulan = 'September';
                  } elseif ($tanggal == 10) {
                    $bulan = 'Oktober';
                  } elseif ($tanggal == 11) {
                    $bulan = 'November';
                  } else {
                    $bulan = 'Desember';
                  }
                  
                  if ($totalbobot2 == 0) {
                      $totalbobot2 = 1;
                  } else {
                      $totalbobot2;
                  }
                  $ipk = $totalsi2 / $totalbobot2;
                  $option .= '</tbody>
                  <tr>
                    <td colspan="3" style="text-align:right"> <b> Jumlah Bobot : </b></td>
                    <td style="text-align:center">  '.$totalbobot2.' </td>
                    <td colspan="3" style="text-align:right"> <b> Sks * N.indeks : </b></td>
                    <td style="text-align:center"> '.$totalsi2.'</td>

                </tr>
                <tr>
                    <td style="text-align:right" colspan="7"> IPS : </td>
                    <td style="text-align:center"> '.substr($ipk,0,4).'  </td>
                </tr>
              </table>
              
              '.$tampil_grade.'
              

               <text style="text-align:right; font-size:10px;" class="pull-right"> Jakarta, ................................ </text> '.$enter.'

              <p style="text-align:right; font-size:10px"> Pembimbing Akademik </p>

              <br>

              <p style="text-align:right; font-size:10px"> '.$pp->nama_dosen.'</p>
              </div>

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
    function laporan_transkrip($id_mahasiswa){
      $query = $this->db->select('*')
                ->from('tb_kelas_mhs')
                ->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_kelas_mhs.id_mahasiswa')
                ->join('tb_detail_kurikulum','tb_detail_kurikulum.id_detail_kurikulum=tb_kelas_mhs.id_detail_kurikulum')
                ->join('tb_matkul','tb_matkul.kode_matkul=tb_detail_kurikulum.kode_matkul')
                ->join('tb_skala_nilai','tb_skala_nilai.id_skala_nilai=tb_kelas_mhs.id_skala_nilai')
                ->where('tb_kelas_mhs.id_mahasiswa' , $id_mahasiswa)
                ->order_by('tb_detail_kurikulum.semester_kurikulum', 'ASC')
                ->get();
      $row = $query->result();
     
      $pp = $this->db->select('*')
            ->where('id_mahasiswa', $id_mahasiswa)            
            ->join('tb_konsentrasi', 'tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
            ->join('tb_prodi', 'tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
            ->get('tb_mahasiswa')
            ->row();

                if ($query->num_rows() > 0)
                { 
                  $no = 0;
                  $totalsi = 0;
                  $totalsi2 = 0;
                  $totalbobot = 0;
                  $totalbobot2 = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
        <h4 style="text-align:center" ><b>Transkrip Nilai</h4></b>
          <IMG src="'.base_url().'/uploads/STIE-01.png" class="pull-right" style="width:120px; margin-right: 2%">
          <br>

            <table style="font-size:10px;margin-left:2%">
              <tr>
                <td width="200px"><b>Nama Mahasiswa</b></td>
                <td width="300px">: '.$pp->nama_mahasiswa.'</td>
              </tr>
              <tr>
                <td width="200px"><b>Program Studi</b></td>
                <td>: '.$pp->nama_prodi.' </td>
              </tr>
              <tr>
                 <td><b>NIM</b></td>
                <td>: '.$pp->nim.'</td>
              </tr>
             
            </table>
            <br>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table2 table-bordered table-striped" style="font-size:10px">
                <thead>
                <tr>
                    <th style="width:5%;text-align:center" height="10" rowspan="2">No.</th>
                    <th style="text-align:center" height="10" rowspan="2">Kode MK</th>
                    <th style="text-align:center" height="10" rowspan="2">Nama MK</th>
                    <th style="text-align:center" height="10" rowspan="2">Bobot MK<br />(sks)</th>
                     <th style="text-align:center" height="5" colspan="3">Nilai</th>
                     <th style="text-align:center"  height="10" rowspan="2">sks * N.indeks</th>
                   
                </tr>
                <tr>
                    <th style="width:5%;text-align:center">Angka</th>
                    <th style="width:5%;text-align:center">Huruf</th>
                    <th style="width:5%;text-align:center">Indeks</th>
                    
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $data) {
                    $totalbobot += $data->bobot_matkul;
                    $ea = $data->bobot_matkul * $data->nilai_indeks;
                    $totalsi += $ea;
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->id_matkul."</td>
                      <td>".$data->nama_matkul."</td>
                      <td style='text-align:right'>".$data->bobot_matkul."</td>
                      <td style='text-align:right'>".$data->nilai_d."</td>
                      <td style='text-align:right'>".$data->nilai_huruf."</td>
                      <td style='text-align:right'>".$data->nilai_indeks."</td>
                      <td style='text-align:right'>".$data->bobot_matkul * $data->nilai_indeks."</td>
                    </tr>"
                    ;
                    
                  }
                  
                  if ($totalbobot == 0) {
                      $totalbobot = 1;
                  } else {
                      $totalbobot;
                  }
                  $ipk = $totalsi / $totalbobot;
                  $cc = round($ipk, 2);
                  $option .= '</tbody>
                  <tr>
                    <td colspan="3" style="text-align:right"> <b> Jumlah Bobot : </b></td>
                    <td style="text-align:right">  '.$totalbobot.' </td>
                    <td colspan="3" style="text-align:right"> <b> Jumlah sks * N.indeks : </b></td>
                    <td style="text-align:right"> '.$totalsi.'</td>

                </tr>
                <tr>
                    <td style="text-align:right" colspan="7"> IPK : </td>
                    <td style="text-align:right"> '.$cc.'  </td>
                </tr>
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

    function laporan_buku_induk($angkatan, $id_prodi){
      $query = $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama_mahasiswa, tb_bio.tempat_lahir, tb_bio.tanggal_lahir, tb_ibu.nama_ibu, tb_agama.agama, tb_bio.id_kelamin, tb_kependudukan.kewarganegaraan, tb_alamat.kecamatan, tb_alamat.kelurahan, tb_alamat.rt, tb_alamat.rw, tb_alamat.jalan, tb_bio.foto_mahasiswa, tb_sekolah.nama_sekolah, tb_alamat.alamat_mhs, tb_kontak.no_telepon, tb_kontak.no_hp, tb_pendidikan.tgl_du, tb_ld.no_seri_ijazah, tb_ld.tgl_sk_yudisium, tb_pt.nama_pt, tb_pendidikan.asal_pt')
                ->from('tb_ld')
                ->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_ld.id_mahasiswa')
                ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_bio','tb_mahasiswa.id_mahasiswa=tb_bio.id_mahasiswa')
                ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
                ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_ibu','tb_ibu.id_mahasiswa=tb_mahasiswa.id_mahasiswa' )
                ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah', 'left' )
                ->join('tb_pt','tb_pt.id_pt=tb_pendidikan.asal_pt', 'left' )
                ->where('tb_ld.id_status', '11')
                ->like('tb_pendidikan.tgl_du' , $angkatan)
                ->like('tb_prodi.id_prodi' , $id_prodi)
                ->get();
      $row = $query->result();
      $pp = $this->db->select('nama_prodi')
            ->where('tb_prodi.id_prodi', $id_prodi)
            ->get('tb_prodi')
            ->row();
      $coo = $this->db->select('count(*) as total')
                ->from('tb_ld')
                ->join('tb_mahasiswa','tb_mahasiswa.id_mahasiswa=tb_ld.id_mahasiswa')
                ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_bio','tb_mahasiswa.id_mahasiswa=tb_bio.id_mahasiswa')
                ->join('tb_agama','tb_agama.id_agama=tb_bio.id_agama')
                ->join('tb_pendidikan','tb_pendidikan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_ibu','tb_ibu.id_mahasiswa=tb_mahasiswa.id_mahasiswa' )
                ->join('tb_kontak','tb_kontak.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_kependudukan','tb_kependudukan.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_alamat','tb_alamat.id_mahasiswa=tb_mahasiswa.id_mahasiswa')
                ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_mahasiswa.id_sekolah', 'left' )
                ->where('tb_ld.id_status', '11')
                ->like('tb_pendidikan.tgl_du' , $angkatan)
                ->like('tb_prodi.id_prodi' , $id_prodi)
                ->get();
      $total = $coo->row();

                if ($query->num_rows() > 0)
                { 
                  if(empty($pp->nama_prodi)){
                    $cc = 'Semua';
                  } else {
                    $cc = $pp->nama_prodi;
                  }
                  $no = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
          
            <h4><b>Laporan Buku Induk</h4></b>
            <table>
              <tr>
                <td width="120px">Perguruan Tinggi</td>
                <td width="300px">: 033082 - STIE Jakarta International College</td>
                <td width="120px">Alamat</td>
                <td>: Jalan Perunggu No 53-54 10640</td>
              </tr>
              <tr>
                <td width="120px">Periode</td>
                <td width="300px">: '.$angkatan.'</td>
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
              <table id="example1" class="table2 table-bordered ">
                <thead>
                <tr>
                  <th rowspan="3" style="text-align:center; width:3%">NO</th>
                  <th rowspan="3" style="text-align:center">NIM</th>
                  <th rowspan="3" style="text-align:center">NAMA MAHASISWA</th>
                  <th rowspan="3" style="text-align:center">JK</th>
                  <th rowspan="3" style="text-align:center">TEMPAT / TGL. LAHIR</th>
                  <th rowspan="2" style="text-align:center">WNI</th>
                  <th  style="text-align:center">NAMA SEKOLAH</th>
                  <th rowspan="3" style="width:10%; text-align:center">FOTO</th>
                </tr>
                <tr>
                  <th  style="text-align:center">TAHUN LULUS</th>
                 
                </tr>
                <tr>
                  <th style="text-align:center">AGAMA</th>
                  <th style="text-align:center">NO. IJAZAH</th>
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $data) {
                    if ($data->asal_pt == NULL OR $data->asal_pt == '') {
                      $asal = $data->nama_sekolah;
                    } else {
                      $asal = $data->nama_pt;
                    }
                    if ($data->kewarganegaraan == 'Indonesia' OR $data->kewarganegaraan == 'indonesia' OR $data->kewarganegaraan == 'indo' OR $data->kewarganegaraan == '') {
                      $warga = 'WNI'; 
                    } else {
                      $warga = 'WNA';
                    }
                    $option .= '
                    <tr>
                      <td rowspan="5">'.++$no.'</td>
                      <td rowspan="3">'.$data->nim.'</td>
                      <td rowspan="3"><b>'.$data->nama_mahasiswa.'</b></td>
                      <td rowspan="5" style="text-align:center; width:3%">'.$data->id_kelamin.'</td>
                      <td rowspan="5">'.$data->tempat_lahir.', '.$data->tanggal_lahir.'</td>
                      <td rowspan="3">'.$warga.'</td>
                      <td>'.$asal.'</td>
                      
                      <td rowspan="5" style="width:10%; text-align:center"><img id="output" width="120" height="160" src="'.base_url('uploads/'.$data->foto_mahasiswa).'" alt="Photo" onerror="this.src='.base_url('uploads/user.jpg').'"></td>
                    </tr>
                    <tr>
                     <td>'.substr($data->tgl_sk_yudisium,0,4).'</td>
                    </tr>
                    <tr>
                     <td>'.$data->no_seri_ijazah.'</td>
                    </tr>
                    <tr>
                      <td>Alamat : </td>
                      <td>'.$data->alamat_mhs.'</td>
                      <td rowspan="2">'.$data->agama.'</td>
                      <td rowspan="2">Nama Ibu : '.$data->nama_ibu.'</td>
                    </tr>
                    <tr>
                      <td>No. Telp : </td>
                      <td>'.$data->no_telepon.'</td>
                    </tr>
                    '
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
    function laporan_keuangan($tanggal_awal, $tanggal_akhir, $id_prodi, $id_waktu){
      $query = $this->db->select('*')
                ->from('tb_detail_pembayaran')
                ->join('tb_pembayaran', 'tb_pembayaran.kode_pembayaran=tb_detail_pembayaran.kode_pembayaran')
                ->join('tb_mahasiswa', 'tb_mahasiswa.id_mahasiswa=tb_pembayaran.id_mahasiswa')
                ->join('tb_konsentrasi', 'tb_konsentrasi.id_konsentrasi=tb_mahasiswa.id_konsentrasi')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                ->join('tb_biaya', 'tb_biaya.id_biaya=tb_detail_pembayaran.id_biaya')
                ->join('tb_matkul', 'tb_matkul.kode_matkul=tb_detail_pembayaran.kode_matkul','left')
                ->where('tanggal_cetak >=', $tanggal_awal)
                ->where('tanggal_cetak <=', $tanggal_akhir)
                ->like('tb_prodi.id_prodi', $id_prodi)
                ->like('tb_mahasiswa.id_waktu', $id_waktu)
                ->order_by('tanggal_cetak', 'asc')
                ->order_by('tb_pembayaran.kode_pembayaran', 'asc')
                ->get();
      $row = $query->result();
      $prodi = $this->db->where('id_prodi', $id_prodi)->get('tb_prodi')->row()->nama_prodi;
      $waktu = $this->db->where('id_waktu', $id_waktu)->get('tb_waktu')->row()->waktu;
      if($prodi == ''){
        $prodi = 'Semua';
      }
      if($waktu == ''){
        $waktu = 'Semua';
      }
                if ($query->num_rows() > 0)
                { 
                  $tanggal_awal = date("d M Y", strtotime($tanggal_awal));
                  $tanggal_akhir = date("d M Y", strtotime($tanggal_akhir));
                  $no = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body">
            <h4><b>Laporan Pembayaran</h4></b>
            <table>
              <tr>
                <td width="120px">Perguruan Tinggi</td>
                <td width="300px">: 033082 - STIE Jakarta International College</td>
                <td width="120px">Alamat</td>
                <td>: Jalan Perunggu No 53-54 10640</td>
              </tr>
              <tr>
                <td width="120px">Tanggal Awal</td>
                <td width="300px">: '.$tanggal_awal.'</td>
                <td width="120px">Tanggal Akhir</td>
                <td>: '.$tanggal_akhir.'</td>
              </tr>
              <tr>
                <td width="120px">Prodi</td>
                <td width="300px">: '.$prodi.'</td>
                <td width="120px">Waktu</td>
                <td>: '.$waktu.'</td>
              </tr>
            </table>
            <br>
              <table id="example1" class="table2 table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Laporan</th>
                  <th>No. Tanda Terima</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Jenis Biaya</th>
                  <th>Nama Biaya</th>
                  <th>Biaya</th>
                </tr>
                </thead>
                <tbody>';
                  foreach ($row as $i) {
                    if ($i->jenis_biaya == 'Angsuran Tahun 1'){
                    /*$dataea = $i->jumlah_biaya * $i->diskon / 100;*/
                    $dataea = 0;
                    $iae = $i->jumlah_biaya - $dataea;
                    $iea = $i->jumlah_biaya - $dataea  - $i->potongan + $i->denda;
                  } else if($i->jenis_biaya == 'KRS'){
                    $iae = $i->jumlah_biaya * $i->bobot_matkul;
                    $iea = ($i->jumlah_biaya * $i->bobot_matkul)   - $i->potongan + $i->denda;
                    $i->nama_biaya = $i->nama_biaya.' - '.$i->id_matkul;
                  }  else if($i->jenis_biaya == 'Angsuran Tahun 2' or $i->jenis_biaya == 'Angsuran Tahun 3' or $i->jenis_biaya == 'Angsuran Tahun 4'){
                    /*$dataea = $i->jumlah_biaya * $i->diskon / 100;*/
                    $dataea = 0;
                    $iae = $i->jumlah_biaya - $dataea;
                    $iea = $i->jumlah_biaya - $dataea   - $i->potongan + $i->denda;
                  } else {
                    $dataea = 0;
                    $iae = $i->jumlah_biaya;
                    $iea = $i->jumlah_biaya - $dataea   - $i->potongan + $i->denda;
                  }
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".date("d M Y", strtotime($i->tanggal_cetak))."</td>
                      <td>".$i->kode_pembayaran."</td>
                      <td>".$i->nim."</td>
                      <td>".$i->nama_mahasiswa."</td>
                      <td>".$i->jenis_biaya."</td>
                      <td>".$i->nama_biaya."</td>
                      <td>".$iea."</td>
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
                  $option .= '
                  <section class="content" id="ea">
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

    function getPeriode()
    {
        $ea =  $this->db->select('tb_periode.semester')
                ->distinct()
                ->from('tb_periode')
                ->join('tb_prodi','tb_prodi.id_prodi=tb_periode.id_prodi')
                ->get();
        return $ea->result();

    }
    function getTahun()
    {
        $ea =  $this->db->select('DATE_FORMAT(tb_hasil_tes.tanggal_hasil_tes, "%Y") as tanggal_hasil_tes')
                ->distinct()
                ->from('tb_hasil_tes')
                ->join('tb_mahasiswa','tb_mahasiswa.id_hasil_tes=tb_hasil_tes.id_hasil_tes')
                ->get();
        return $ea->result();

    }
    function getTahunAngkatan()
    {
        $ea =  $this->db->select('DATE_FORMAT(tb_pendidikan.tgl_du, "%Y") as tgl_du')
                ->distinct()
                ->order_by('tgl_du','ASC')
                ->get('tb_pendidikan');
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
    public function getTahunSgs(){
      $this->db->select('DATE_FORMAT(tb_pendaftaran.tanggal_pendaftaran, "%Y") as tanggal_pendaftaran')->distinct();
      $this->db->from('tb_pendaftaran');
      $this->db->join('tb_mahasiswa','tb_mahasiswa.nim=tb_pendaftaran.sgs');
      $this->db->where('id_sumber',4);
      $query = $this->db->get();
      return $query->result();
  }
  public function get_semester_dosen(){
      return $this->db->select('semester')
              ->distinct()
              ->get('tb_periode')
              ->result();
  }
  public function autocomplete_dosen($nama){
     $this->db->select('*');
     $this->db->from('tb_dosen');
     $this->db->like('nama_dosen',$nama);
     $query = $this->db->get();
     return $query->result();
  }
  public function autocomplete_mahasiswa($nama){
     $this->db->select('*');
     $this->db->from('tb_mahasiswa');
     $this->db->like('nama_mahasiswa',$nama);
     $this->db->or_like('nim',$nama);
     $query = $this->db->get();
     return $query->result();
  }
  public function autocomplete_matkul($nama){
     $this->db->select('*');
     $this->db->from('tb_matkul');
     $this->db->like('nama_matkul',$nama);
     $query = $this->db->get();
     return $query->result();
  }
  public function autocomplete_nim($nama){
     $this->db->select('*');
     $this->db->from('tb_mahasiswa');
     $this->db->like('nim',$nama);
     $query = $this->db->get();
     return $query->result();
  }
  public function rasio_dosen_mhs($id_prodi, $id_periode){
    $a = $this->db->select('distinct(tb_kelas_dosen.id_dosen)')
                        ->join('tb_dosen', 'tb_dosen.id_dosen=tb_kelas_dosen.id_dosen')
                        ->join('tb_kp', 'tb_kp.id_kp=tb_kelas_dosen.id_kp')
                        ->join('tb_periode', 'tb_periode.id_periode=tb_kp.id_periode')
                        ->join('tb_konsentrasi', 'tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
                        ->join('tb_prodi', 'tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                        ->where('tb_dosen.status', '1')
                        ->where('tb_prodi.id_prodi', $id_prodi)
                        ->where('tb_periode.id_periode', $id_periode)
                        ->get('tb_kelas_dosen')
                        ->num_rows();
        $b = $this->db->select('distinct(tb_kelas_mhs.id_mahasiswa)')
                        ->join('tb_kp', 'tb_kp.id_kp=tb_kelas_mhs.id_kp')
                        ->join('tb_periode', 'tb_periode.id_periode=tb_kp.id_periode')
                        ->join('tb_konsentrasi', 'tb_konsentrasi.id_konsentrasi=tb_kp.id_konsentrasi')
                        ->join('tb_prodi', 'tb_prodi.id_prodi=tb_konsentrasi.id_prodi')
                        ->where('tb_prodi.id_prodi', $id_prodi)
                        ->where('tb_periode.id_periode', $id_periode)
                        ->get('tb_kelas_mhs')
                        ->num_rows();
        $aa = $this->db->where('id_prodi', $id_prodi)->get('tb_prodi')->row();
        $bb = $this->db->where('id_periode', $id_periode)->get('tb_periode')->row();
        $c = $b / $a;
        $c = round($c, 2);
        $d = $a / $a;
        if (is_nan($c)){
          $c = 0;
        }
        if (is_nan($d)){
          $d = 0;
        }
        return array(
          'dosen' => $a,
          'mhs' => $b,
          'rasio' => $d.' : '.$c,
          'data' => $aa,
          'data2' => $bb
        );
  }
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */