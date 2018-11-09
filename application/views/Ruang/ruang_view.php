      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA RUANG</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-hover table-responsive table-condensed" style="text-transform: uppercase;">
                <a href="" data-toggle="modal" data-target="#modal_tambah" class="btn btn-primary btn-flat btn-sm" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Ruang</th>
                  <th>Nama Ruang</th>
                  <th>Kapasitas</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($ruang as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>

                  <td><a href="" data-toggle="modal" data-target="#modal_view'.$data->id_ruang.'">'.$data->id_ruang.'</a></td>
                  <td>'.$data->nama_ruang.'</td>
                  <td>'.$data->kapasitas.'</td>
                  <td>'.$data->keterangan.'</td>
                  <td>
                <a href="" data-toggle="modal" data-target="#modal_edit'.$data->id_ruang.'" class="btn btn-warning btn-flat btn-xs"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit Ruangan</span></a>

                  <a href="'.base_url('ruang/hapus_ruang/'.$data->id_ruang).'" class="btn btn-danger btn-flat btn-xs" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus Ruangan</span></a>

                         
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

     <div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel"> Tambah Ruangan</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('ruang/simpan_ruang'); ?>
                      <table class="table">
                          <tr>
          <td>Nama Ruang <font color="#FF0000">*</font></td>
            <td colspan="9">  <input type="text" name="nama_ruang" id="nama_ruang" />
        </tr>
        <tr>
          <td class="left_column">Kapasitas</td>
            <td> <input type="number" name="kapasitas" id="kapasitas" class="text-input" style="width:50px"></td>
        </tr> 
        <tr>
          <td class="left_column">Keterangan</td>
            <td colspan="9"> 
      <textarea wrap="soft" name="keterangan" id="keterangan" class="text-input" rows="5" cols="50" maxlength="60"></textarea></td>
        </tr> 
        <tr>
          <td colspan="4"><button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button></td>
        </tr>
                        </table>
                        <?php echo form_close();?>

                    </div>

                </div>
            </div>
            </div>
        </div>

<?php 
        foreach($ruang as $i):
        ?>
        <div class="modal fade" id="modal_view<?php echo $i->id_ruang;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Detail Ruang</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <table class="table">
                          <tr>
                              <td class="left_column" width="40%">Nama Ruangan </td>
                                <td colspan="9">  <?php echo $i->nama_ruang?>
                            </tr>
                          <tr>
                              <td class="left_column" width="20%">Kapasitas</td>
                                <td>
                           <?php echo $i->kapasitas ?></td>
                            </tr>
                            <tr>
                              <td class="left_column">Keterangan</td>
                                <td> <?php echo $i->keterangan ?></td>
                            </tr> 
                           
                        </table>

                    </div>

                </div>
            </div>
            </div>
        </div>

    <?php endforeach;?>

    <?php 
        foreach($ruang as $i):
        ?>
        <div class="modal fade" id="modal_edit<?php echo $i->id_ruang;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Ruang</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('ruang/edit_ruang'); ?>
                      <table class="table">
        <tr>
          <td>Nama Ruang <font color="#FF0000">*</font></td>
            <td colspan="9">  <input type="text" name="nama_ruang" id="nama_ruang" value="<?php echo $i->nama_ruang; ?>" />
              <input type="hidden" name="id_ruang" id="id_ruang" value="<?php echo $i->id_ruang; ?>" />
        </tr>
        <tr>
          <td class="left_column">Kapasitas</td>
            <td> <input type="number" name="kapasitas" id="kapasitas" class="text-input" style="width:50px" value="<?php echo $i->kapasitas; ?>"></td>
        </tr> 
        <tr>
          <td class="left_column">Keterangan</td>
            <td colspan="9"> 
      <textarea wrap="soft" name="keterangan" id="keterangan" class="text-input" rows="5" cols="50" maxlength="60"><?php echo $i->keterangan; ?></textarea></td>
        </tr> 
        <tr>
          <td colspan="4"><button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button></td>
        </tr>
    </table>

                    </div>

                </div>
            </div>
            </div>
        </div>
        <?php echo form_close();?>

    <?php endforeach;?>

