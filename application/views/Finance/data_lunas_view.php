<?php echo $this->session->flashdata('message');?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data Registrasi Lunas</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                <thead>
                <tr>
                  <th>No</th>
                  <th>No. Tamu</th>

                  <th>Nama Pendaftar</th>
                  <th>Tanggal Konfirmasi</th>
                  <th>Gambar</th>
                  <!-- <th>Aksi</th> -->
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($mahasiswa as $data) {


                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td name="id_pendaftaran">'.$data->id_pendaftaran.'
                  </td>

                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->tanggal_konfirmasi.'
                  </td>

               
                  <td> <a href="'.base_url('uploads/'.$data->bukti_transfer).'" class="btn btn-info btn-xs btn-flat" target="_blank">Lihat Bukti</a>
                  </td>
                  
                  

       
                ' ;
                
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