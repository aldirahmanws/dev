<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Student Get Student</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pendaftar</th>
                  <th>Mahasiswa Narasumber</th>
                  <th>NIM</th>
                  <th>Tanggal Pendaftaran</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($edit as $data) {
                  if ($data->status_bayar == 'Aktif') {
                    
                  

                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_pendaftar.'
                  </td>
                  <td>'.$data->nama_mahasiswa.'</td> 
                  <td>'.$data->nim.'</td> 
                  <td>'.$data->tanggal_pendaftaran.'</td>
                  <td>
                       

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