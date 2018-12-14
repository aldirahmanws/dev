<?php echo $this->session->flashdata('message');?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">ASAL SEKOLAH</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-hover table-condensed" style="text-transform: uppercase;">
              <a href="<?php echo base_url() ?>master_asal_sekolah/page_tambah_asal_sekolah" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Sekolah</th>
                  <th>Nama Sekolah</th>
                  <th>Alamat</th>
                  <th>Jenis</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin mengapus data ini ?'";
                foreach ($asal_sekolah as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_sekolah.'
                  </td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->alamat_sekolah.'</td>
                  <td>'.$data->jenis_sekolah.'</td>
                  <td>
                    <a href="'.base_url('master_asal_sekolah/edit_asal_sekolah/'.$data->id_sekolah).'" class="btn btn-warning btn-xs btn-flat" ><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>
                    <a href="'.base_url('master_asal_sekolah/hapus_asal_sekolah/'.$data->id_sekolah).'" class="btn btn-danger btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>
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