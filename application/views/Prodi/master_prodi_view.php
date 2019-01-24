<?php echo $this->session->flashdata('message');?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">PROGRAM STUDI</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-condensed table-hover" style="text-transform: uppercase;">
              <a href="<?php echo base_url() ?>master_prodi/page_tambah_prodi" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Prodi</th>
                  <th>Nama Prodi</th>
                  <th>Ketua Prodi</th>
                  <th style="width: 10%">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin mengapus data ini ?'";
                foreach ($prodi as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_prodi.'
                  </td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_dosen.'</td>
                  <td>
                  <a href="'.base_url('index.php/master_prodi/edit_prodi/'.$data->id_prodi).'" class="btn btn-warning btn-xs btn-flat"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>
                  <a href="'.base_url('index.php/master_prodi/hapus_prodi/'.$data->id_prodi).'" class="btn btn-danger btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>
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

       <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
           - Master prodi digunakan untuk mengelola data program studi perkuliahan.
           <br />
            - User wajib mengisi seluruh inputan yang disediakan.
         </div>
      <!-- /.row -->
    </section>