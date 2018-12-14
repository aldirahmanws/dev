<?php echo $this->session->flashdata('message');?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              
              <h3 class="box-title">Data Peserta Tes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
             
                <thead>
                <tr>
                  <th>No</th>
                  <th>No. Pendafataran</th>
                  <th>Nama Pendaftaran</th>
                  <th>Asal Sekolah</th>
                  <th>Email</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($pra_pendaftar as $data) {
                  if ($data->status_tes != 'done') {
                  
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->email.'</td>
                  
                  <td>
                     <a href="'.base_url('pendaftaran/print_pendaftaran/'.$data->id_pendaftaran).'" class="btn btn-warning btn-sm" >Print Soal</a>
                    
                      <a href="'.base_url('hasil_tes/index/'.$data->id_pendaftaran).'" class="btn btn-info btn-sm" >Input Nilai</a>
                  </td>
                </tr>
                ';
                
              } else {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->email.'</td>
                  
                  <td>
                     <a href="'.base_url('hasil_tes/print_hasil_tes/'.$data->id_pendaftaran).'" class="btn btn-warning btn-sm" >Print Hasil Tes</a>
                      <a href="'.base_url('hasil_tes/detail_tes/'.$data->id_pendaftaran).'" class="btn btn-danger btn-sm" >Detail</a>
                     <a href="'.base_url('daftar_ulang/index/'.$data->id_pendaftaran).'" class="btn btn-info btn-sm" >Daftar Ulang</a>
                     
                  </td>
                </tr>
                ';

              } }
              ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>