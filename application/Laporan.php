<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Laporan_model');
    $this->load->model('Pegawai_model');
    ini_set('display_errors', 0);
    if ($this->session->userdata('logged_in') != TRUE) {
      redirect('login');
    }
	}

	public function pegawai(){
		$data['get_status_pegawai'] = $this->db->get('tb_status_pegawai')->result();
		$data['get_jenis_pegawai'] = $this->db->get('tb_jenis_pegawai')->result();
		$data['get_divisi'] = $this->db->get('tb_divisi')->result();
		$data['get_campus'] = $this->db->get('tb_campus')->result();
		$data['main_view'] = 'Laporan/laporan_pegawai_view';
		$this->load->view('template', $data);
	}
	
	function tampil_pegawai(){
		$tanggal_masuk = $this->input->post('tanggal_masuk');
		$tanggal_masuk2 = $this->input->post('tanggal_masuk2');
		$id_status_pegawai = $this->input->post('id_status_pegawai');
		$id_jp = $this->input->post('id_jp');
		$id_divisi = $this->input->post('id_divisi');
		$id_campus = $this->input->post('id_campus');
      	$a = $this->db->join('tb_campus', 'tb_campus.id_campus = tb_pegawai.id_campus' , 'left')
      					->join('tb_divisi', 'tb_divisi.id_divisi = tb_pegawai.id_divisi', 'left');
        if($tanggal_masuk != '' && $tanggal_masuk2 != ''){
        $a = 
                        $this->db->where('tb_pegawai.tgl_masuk >=', $tanggal_masuk)
                        ->where('tb_pegawai.tgl_masuk <=', $tanggal_masuk2);
        }
        $a = $this->db

                        ->like('tb_pegawai.id_status_pegawai' , $id_status_pegawai)
                        ->like('tb_pegawai.id_jp' , $id_jp)
                        ->like('tb_pegawai.id_divisi' , $id_divisi)
                        ->like('tb_pegawai.id_campus' , $id_campus)
                        ->get('tb_pegawai');
      	$result = $a->result();

                if ($a->num_rows() > 0)
                { 
                  if($tanggal_masuk != '' && $tanggal_masuk2 != ''){
                    $tanggal_masuk = date("d M Y", strtotime($tanggal_masuk));
                    $tanggal_masuk2 = date("d M Y", strtotime($tanggal_masuk2));  
                  } else {
                    $tanggal_masuk = 'Semua';
                    $tanggal_masuk2 = 'Semua';
                  }
                  
                  $no = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body">
            <h4><b>Laporan Pegawai</h4></b>
            <table>
              <tr>
                <td width="120px">Tanggal Awal</td>
                <td width="300px">: '.$tanggal_masuk.'</td>
                <td width="120px">Tanggal Akhir</td>
                <td>: '.$tanggal_masuk2.'</td>
              </tr>
              <tr>
                <td width="120px">Jumlah Pegawai</td>
                <td width="300px">: '.count($result).'</td>
              </tr>
            </table>
            <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>Nama Pegawai</th>
                  <th>No Telephone</th>
                  <th>Email</th>
                  <th>Tanggal Masuk</th>
                  <th>Divisi</th>
                  <th>Campus</th>
                </tr>
                </thead>
                <tbody>';
                  foreach ($result as $data) {
                    if($data->tgl_masuk != '0000-00-00'){
                      $tgl_masuk = date("d M Y", strtotime($data->tgl_masuk));
                    } else {
                      $tgl_masuk = '-';
                    }
                    $option .= "
                    <tr>
                      <td>".++$no."</td>
                      <td>".$data->nama_pegawai."</td>
                      <td>".$data->no_telepon."</td>
                      <td>".$data->email."</td>
                      <td>".$tgl_masuk."</td>
                      <td>".$data->nama_campus."</td>
                      <td>".$data->nama_divisi."</td>
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
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>Nama Pegawai</th>
                  <th>Tempat Lahir</th>
                  <th>Alamat</th>
                  <th>No Telephone</th>
                  <th>Email</th>
                  <th>Tanggal Masuk</th>
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
    public function absensi(){
      $data['main_view'] = 'Laporan/laporan_absensi_view';
      $this->load->view('template', $data);
    }
    function tampil_absensi(){
    $tanggal_masuk = $this->input->post('tanggal_masuk');
    $tanggal_masuk2 = $this->input->post('tanggal_masuk2');
    $nama_pegawai = $this->input->post('nama_pegawai');
        $a = $this->db->select('*, tb_absensi.id_nik');
        if($tanggal_masuk != '' && $tanggal_masuk2 != ''){
        $a = 
                        $this->db->where('tb_absensi.tanggal_absensi >=', $tanggal_masuk)
                        ->where('tb_absensi.tanggal_absensi <=', $tanggal_masuk2);
        }
        $a = $this->db
                        ->like('tb_pegawai.nama_pegawai' , $nama_pegawai)
                        ->join('tb_pegawai', 'tb_pegawai.id_nik = tb_absensi.id_nik')
                        ->group_by('tb_absensi.id_nik')
                        ->order_by('tb_absensi.id_nik', 'asc')
                        ->order_by('tanggal_absensi', 'desc')

                        ->get('tb_absensi');

        $result = $a->result();

                if ($a->num_rows() > 0)
                { 
                  if($tanggal_masuk != '' && $tanggal_masuk2 != ''){
                    $tanggal_masuks = date("d M Y", strtotime($tanggal_masuk));
                    $tanggal_masuk2s = date("d M Y", strtotime($tanggal_masuk2));  
                  } else {
                    $tanggal_masuks = 'Semua';
                    $tanggal_masuk2s = 'Semua';
                  }
                  
                  $no = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body">
            <h4><b>Laporan Pegawai</h4></b>
            <table>
              <tr>
                <td width="120px">Tanggal Awal</td>
                <td width="300px">: '.$tanggal_masuks.'</td>
                <td width="120px">Tanggal Akhir</td>
                <td>: '.$tanggal_masuk2s.'</td>
              </tr>
            </table>
            <br>
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th>Tanggal Absensi</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                  <th>Telat (Menit)</th>
                  <th>Potongan</th>
                </tr>
                </thead>
                <tbody>';
                  foreach ($result as $data) {
                    if($data->tgl_masuk != '0000-00-00'){
                      $tgl_masuk = date("d M Y", strtotime($data->tgl_masuk));
                    } else {
                      $tgl_masuk = '-';
                    }
                    $detail_absensi = $this->db->select('*, tb_absensi.id_nik')
                        ->join('tb_pegawai', 'tb_pegawai.id_nik = tb_absensi.id_nik');
                    if($tanggal_masuk != '' && $tanggal_masuk2 != ''){
        $detail_absensi = $this->db->where('tb_absensi.tanggal_absensi >=', $tanggal_masuk)->where('tb_absensi.tanggal_absensi <=', $tanggal_masuk2);
        }
                    $detail_absensi = $this->db
                        /*->like('tb_pegawai.nama_pegawai' , $nama_pegawai)*/
                        /*->where('tanggal_absensi', $data->tanggal_absensi)*/
                        ->where('tb_absensi.id_nik', $data->id_nik)
                        ->group_by('tanggal_absensi')
                        ->order_by('tb_absensi.id_nik', 'asc')
                        ->order_by('tanggal_absensi', 'desc')
                        ->get('tb_absensi')
                        ->result();
                    $option .= "<tr style='background-color: #ecf0f5'><td colspan='7'>".$data->nama_pegawai."</td></tr>";
                    $mk = 0;
                    foreach ($detail_absensi as $datas) {
                      $jam_kerja = $this->db->where('id_pegawai', $datas->id_pegawai)->get('tb_jam_kerja')->row();
                      $time_in = $this->db->where('tanggal_absensi', $datas->tanggal_absensi)
                               ->where('id_nik', $datas->id_nik)
                               ->order_by('jam_absensi', 'asc')
                               ->get('tb_absensi')->row()->jam_absensi;
                      $time_out = $this->db->where('tanggal_absensi', $datas->tanggal_absensi)
                               ->where('id_nik', $datas->id_nik)
                               ->order_by('jam_absensi', 'desc')
                               ->get('tb_absensi')->row()->jam_absensi;
                      if($datas->status == 'pending'){
                        $k = '#fff972';
                      } else if($datas->telat > 0 && $data->potongan == 0){
                        $k = '#45ff455e';
                      } else if($datas->potongan > 0){
                        $k = '#f443363b';
                      } else {
                        $k = '';
                      }
                      $option .= "<tr style='background-color: ".$k."'>
                        <td>".$datas->tanggal_absensi."</td>
                        <td>".$time_in."</td>
                        <td>".$time_out."</td>
                        <td>".$datas->telat."</td>
                        <td>".$datas->potongan."</td>
                      </tr>  ";
                      $mk += $datas->potongan;
                    }
                    $option .= '<tr><td colspan="3"></td><td>Total</td><td>'.$mk.'</td></tr>';
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
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="1%">No</th>
                  <th>Nama Pegawai</th>
                  <th>Tempat Lahir</th>
                  <th>Alamat</th>
                  <th>No Telephone</th>
                  <th>Email</th>
                  <th>Tanggal Masuk</th>
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
  public function autocomplete_user(){
    if(isset($_GET['term'])){
        $result = $this->Pegawai_model->autocomplete_user($_GET['term']);
        if(count($result) > 0){
          foreach ($result as $row) 
            $result_array[] = array(
              'label' => $row->nama_pegawai,
            );
          echo json_encode($result_array);
        
        }
      }
  }

   public function cuti(){
      $data['main_view'] = 'Laporan/laporan_cuti_view';
      $this->load->view('template', $data);
    }
    public function tampil_cuti(){
    $tanggal_masuk = $this->input->post('tanggal_masuk');
    $tanggal_masuk2 = $this->input->post('tanggal_masuk2');
    $nama_pegawai = $this->input->post('nama_pegawai');
        $a = $this->db->select('*, tb_cuti.id_pegawai');
        if($tanggal_masuk != '' && $tanggal_masuk2 != ''){
        $a = 
                        $this->db->where('tb_cuti.tgl_mulai_cuti >=', date("Y-m-d", strtotime($tanggal_masuk)))
                        ->where('tb_cuti.tgl_mulai_cuti <=', date("Y-m-d", strtotime($tanggal_masuk2)))
                        ->or_where('tb_cuti.tgl_selesai_cuti >=', date("Y-m-d", strtotime($tanggal_masuk)))
                        ->where('tb_cuti.tgl_selesai_cuti <=', date("Y-m-d", strtotime($tanggal_masuk2)));
        }
        $a = $this->db->where('tb_cuti.status','approved')
                        ->like('tb_pegawai.nama_pegawai' , $nama_pegawai)
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_cuti.id_pegawai')
                        ->group_by('tb_pegawai.nama_pegawai','asc')
                        ->order_by('tb_cuti.tgl_mulai_cuti', 'desc')
                        ->get('tb_cuti');

        $result = $a->result();

                if ($a->num_rows() > 0)
                { 
                  if($tanggal_masuk != '' && $tanggal_masuk2 != ''){
                    $tanggal_masuks = date("d M Y", strtotime($tanggal_masuk));
                    $tanggal_masuk2s = date("d M Y", strtotime($tanggal_masuk2));  
                  } else {
                    $tanggal_masuks = 'Semua';
                    $tanggal_masuk2s = 'Semua';
                  }
                  
                  $no = 0;
                  $option = "";
                  $option .= '<section class="content" id="ea">
      <div class="row">
        <div class="col-xs-12">
            <!-- /.box-header -->
            <div class="box-body">
            <h4><b>Laporan Pegawai</h4></b>
            <table>
              <tr>
                <td width="120px">Tanggal Awal</td>
                <td width="300px">: '.$tanggal_masuks.'</td>
                <td width="120px">Tanggal Akhir</td>
                <td>: '.$tanggal_masuk2s.'</td>
              </tr>
            </table>
            <br>
              <table id="example1" class="table table-bordered">
                <thead>
                 <tr>
                  <th>Tgl. Cuti</th>
                  <th>Tgl. Pengajuan</th>      
                  <th>Tgl. Disetujui</th>
                  <th>Penyetuju</th>
                  <th>Tipe Cuti</th>
                  <th>Total Hari</th>
                  <th>Keterangan</th>
                </tr>

                </thead>
                <tbody>';
                  foreach ($result as $data) {
                   $mk = 0;

                   $detail_cuti = $this->db->where('tb_cuti.id_pegawai', $data->id_pegawai)
                        ->where('tb_cuti.status','approved')
                        ->where('tb_cuti.tgl_mulai_cuti >=', date("Y-m-d", strtotime($tanggal_masuk)))
                        ->where('tb_cuti.tgl_mulai_cuti <=', date("Y-m-d", strtotime($tanggal_masuk2)))
                        ->or_where('tb_cuti.tgl_selesai_cuti >=', date("Y-m-d", strtotime($tanggal_masuk)))
                        ->where('tb_cuti.tgl_selesai_cuti <=', date("Y-m-d", strtotime($tanggal_masuk2)))
                        ->order_by('tb_cuti.tgl_mulai_cuti', 'asc')
                        ->get('tb_cuti')
                        ->result();

                   $option .= "<tr style='background-color: #ecf0f5'><td colspan='7'>".$data->nama_pegawai."</td></tr>";

                   foreach ($detail_cuti as $datas) {

                    $verifikator =  $this->db->select('nama_pegawai as abc')
                            ->join('tb_pegawai', 'tb_pegawai.id_pegawai = tb_cuti.id_penyetuju')
                            ->where('tb_cuti.id_cuti', $datas->id_cuti)
                            ->get('tb_cuti')
                            ->row();

                      $option .= "<tr>
                         <td>".date("d M Y", strtotime($datas->tgl_mulai_cuti))." - ".date("d M Y", strtotime($datas->tgl_selesai_cuti))."</td>
                        <td>".date("d M Y", strtotime($datas->date))."</td>
                        <td>".date("d M Y", strtotime($datas->date_penyetuju))."</td>
                        <td>".$verifikator->abc."</td>
                        
                        <td>".$datas->filter_cuti."</td>
                        <td>".$datas->total_hari."</td>
                        <td>".$datas->keterangan_cuti."</td>

                      </tr>  ";
                      $mk += $datas->total_hari;
                      
                    }
                      $option .= '<tr><td colspan="4"></td><td>Total</td><td colspan="2">'.$mk.'</td></tr>';
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
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Tgl. Cuti</th>
                  <th>Nama</th>
                  <th>Tgl. Pengajuan</th>      
                  <th>Tgl. Disetujui</th>
                  <th>Penyetuju</th>
                  <th>Tipe Cuti</th>
                  <th>Total Hari</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                  <td colspan="7"> Tidak Ada Data</td>
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
}



