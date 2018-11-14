      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">MASTER USER</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-condensed table-hover" style="text-transform: uppercase;">
                <a href="" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#modal-tambah" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th width="20px">No</th>
                  <th>Username</th>
                  <th>Jabatan</th>
                  <th width="20px">Aksi</th>
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
      <!-- /.row -->
    </section>
        <div class="modal fade" id="modal-tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah User</h3>
            </div>
                <div class="modal-body">
              <?php echo form_open('admin/signup'); ?>
              <div class="form-horizontal">
              <div class="box-body">
                <!-- <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required="">
                  </div>
                </div> -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Jabatan</label>

                  <div class="col-sm-10">
                    <select id="id_level" required="" class="form-control" name="id_level">
                      <option value="">Pilih Level</option>   
                      <?php 

                      foreach($dropdown_level as $row)
                        { 
                          echo '<option value="'.$row->id_level.'">'.$row->nama_level.'</option>';
                        }
                      ?>
                    </select> 
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-default btn-flat">Reset</button>
                <button type="submit" class="btn btn-primary btn-flat pull-right">Tambah</button>
              </div>
              <!-- /.box-footer -->
            </div>
            <?php echo form_close();?>
            </div>
            </div>
        </div>

