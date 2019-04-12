      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">MASTER USER</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-condensed table-hover" style="text-transform: uppercase;">
                <!-- <a href="" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#modal-tambah" ><i class="fa fa-plus"></i> Tambah</a> <br> <br> -->
                <thead>
                <tr>
                  <th>No</th>
                  <th>Username</th>
                  <th>Jabatan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin mengapus data ini ?'";
                foreach ($data_user as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->username.'</td>
                  <td>'.$data->nama_level.'</td>
                  <td>

                  <a href="" data-toggle="modal" data-target="#modal_edit'.preg_replace('/[^a-zA-Z0-9]/', '', $data->username).'" class="btn btn-warning btn-flat btn-xs"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>

                  <a href="'.base_url('admin/hapus_user/'.$data->username).'" class="btn btn-danger btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>
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

       <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
           - Master user digunakan untuk mengelola data user.
           <br>
           - User harus mengisi seluruh inputan yang disediakan jika akan menambahkan user baru.
         </div>
      <!-- /.row -->
    </section>

    <?php foreach ($data_user as $i){ ?>

        <div class="modal fade" id="modal_edit<?php echo preg_replace('/[^a-zA-Z0-9]/', '', $i->username) ?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Admin</h3>
            </div>
                <div class="modal-body">
              <?php echo form_open('admin/edit_jabatan/'.$i->username); ?>
              <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                 

                 
                   

                    <?php if ($i->id_level == 1) { ?>
                <div class="col-xs-3">
                     
              <input type="radio" name="id_level" value="1" checked=""> Ya
            </div>
            <div class="col-xs-3">
              <input type="radio" name="id_level" value="<?php echo $i->level_before; ?>">  Tidak
            </div>
          <?php } else { ?>
            <div class="col-xs-3">
                     
              <input type="radio" name="id_level" value="1"> Ya
            </div>
            <div class="col-xs-3">
              <input type="radio" checked="" name="id_level" value="<?php echo $i->level_before; ?>">  Tidak
            </div>
          <?php } ?>
                  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-primary btn-flat pull-right">Save</button>
              </div>
              <!-- /.box-footer -->
            </div>
            <?php echo form_close();?>
            </div>
            </div>
        </div>
      </div>

      <?php } ?>

