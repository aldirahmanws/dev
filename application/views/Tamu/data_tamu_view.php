<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">DATA TAMU</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                 <a href="<?php echo base_url(); ?>tamu/page_tambah_tamu" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
             
                <thead>
                <tr>
                  <th>No. Tamu</th>
                  <th>Nama Tamu</th>
                  <th>Asal Sekolah</th>
                  <th>Minat Prodi</th>
                  <th>Waktu</th>
                  <th>Tgl. Daftar Tamu</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                foreach ($tamu as $data) {
                  if ($data->status_bayar == 'Tamu') {
                  
                  echo '
                  
                <tr>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->tanggal_pendaftaran.'</td>
                  <td>'.$data->status_bayar.'</td>
                  
                  <td>
                  
                     <a href="'.base_url('tamu/f1/'.$data->id_pendaftaran).'" class="btn btn-warning btn-xs btn-flat" ><i class="fa fa-phone"></i><span class="tooltiptext">Follow Up</span></a>

                     <a href="'.base_url('tamu/detail_tamu/'.$data->id_pendaftaran).'" class="btn btn-info btn-xs btn-flat"><i class="fa fa-file-text-o"></i><span class="tooltiptext">Detail</span></a>
                     
                     
                      <a href="'.base_url('tamu/page_upload/'.$data->id_pendaftaran).'" class="btn btn-default btn-xs btn-flat"><i class="fa fa-upload"></i><span class="tooltiptext">UPLOAD</span></a>


                  

                  </td>
                </tr>
                ';
                
              } else if ($data->status_bayar == 'Lunas') {
                if ($data->waktu == 'Pagi') {
                  echo '
                  
                <tr>
                  
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->tanggal_pendaftaran.'</td>
                  <td>'.$data->status_bayar.'</td>
                  
                  <td>
                     <a href="'.base_url('uploads/'.$data->bukti_transfer).'" class="btn btn-success btn-xs btn-flat" target="_blank"><i class="fa fa-file-image-o"></i><span class="tooltiptext">Lihat Bukti</span></a>
                     <a href="'.base_url('tamu/detail_tamu/'.$data->id_pendaftaran).'" class="btn btn-info btn-xs btn-flat"><i class="fa fa-file-text-o"></i><span class="tooltiptext">Detail</span></a>
                  <a href="'.base_url('daftar_ulang/page_du_pagi/'.$data->id_pendaftaran).'" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-plus-circle"></i><span class="tooltiptext">REGISTRASI</span></a>


                  </td>
                </tr>
                ';
                }
                else {
                   echo '
                  
                <tr>
                  
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->tanggal_pendaftaran.'</td>
                  <td>'.$data->status_bayar.'</td>
                  
                  <td>
                   <a href="'.base_url('uploads/'.$data->bukti_transfer).'" class="btn btn-success btn-xs btn-flat" target="_blank"><i class="fa fa-file-image-o"></i><span class="tooltiptext">Lihat Bukti</span></a>
                   <a href="'.base_url('tamu/detail_tamu/'.$data->id_pendaftaran).'" class="btn btn-info btn-xs btn-flat"><i class="fa fa-file-text-o"></i><span class="tooltiptext">Detail</span></a>
                      <a href="'.base_url('daftar_ulang/page_du_sore/'.$data->id_pendaftaran).'" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-plus-circle"></i><span class="tooltiptext">REGISTRASI</span></a>
                     
                  </td>
                </tr>
                ';
                }
              
              ?>

              <?php
            } else if ($data->status_bayar != 'Non Aktif' AND $data->status_bayar != 'Aktif') {
                   echo '
                <tr>
                
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->tanggal_pendaftaran.'</td>
                  <td>'.$data->status_bayar.'</td>
                  <td>
                   <a href="'.base_url('uploads/'.$data->bukti_transfer).'" class="btn btn-success btn-xs btn-flat" target="_blank"><i class="fa fa-file-image-o"></i><span class="tooltiptext">Lihat Bukti</span></a>
                   <a href="'.base_url('tamu/detail_tamu/'.$data->id_pendaftaran).'" class="btn btn-info btn-xs btn-flat"><i class="fa fa-file-text-o"></i><span class="tooltiptext">Detail</span></a>
                     
                  </td>

                </tr>
                ';
            }
            }
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
