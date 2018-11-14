
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA DOSEN</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a class="btn btn-primary btn-sm btn-flat" href="<?php echo base_url(); ?>master_dosen/page_tambah_dosen"><i class="fa fa-plus"></i> Tambah</a> <br> <br>
              <div class="table-responsive">
              <table id="example1" class="table table-striped table-condensed table-hover" style="text-transform: uppercase;">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Dosen</th>
                  <th>NIDN/NUP/NIDK</th>
                  <th>NIP</th>
                  <th>Jenis Kelamin</th>
                  <th>No. Telp</th>
                  <th>Status</th>
                  <th>Jenis</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($dosen as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td> <a href="'.base_url('master_dosen/detail_dosen/'.$data->id_dosen).'"/>'.$data->nama_dosen.'
                  </td>
                  <td>'.$data->nidn.'</td>
                  <td>'.$data->nip.'</td>
                  <td>'.$data->jenis_kelamin.'</td>
                  <td>'.$data->no_hp.'</td>
                  <td>'.$data->status_mhs.'</td>
                  <td>'.$data->status_dosen.'</td>
                  <td>   
                     <a href="'.base_url('master_dosen/page_edit_dosen/'.$data->id_dosen).'" class="btn btn-warning btn-xs btn-flat"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit Dosen</span></a>

                        <a href="'.base_url('master_dosen/hapus_dosen/'.$data->id_dosen).'" class="btn btn-danger btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus Dosen</span></a>

                      
                  </td>
                </tr>
                ';
                
              }
              ?>
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>