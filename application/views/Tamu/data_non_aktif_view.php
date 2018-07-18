<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Non Aktif</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Asal Sekolah</th>
                  <th>Catatan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($edit as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_pendaftar.'
                  </td>
                   <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->notes.'</td>
                  <td>
                      <a href="'.base_url('tamu/detail_out/'.$data->id_pendaftaran).'" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-list-alt"></i><span class="tooltiptext">Detail </span></a>
                  </td>
                </tr>
                ';
                
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