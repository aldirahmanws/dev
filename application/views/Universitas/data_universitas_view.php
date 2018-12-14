
     <?php echo $this->session->flashdata('message');?>
     
     

               <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA UNIVERSITAS</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-hover table-responsive table-condensed" style="text-transform: uppercase;">
                <a href="" data-toggle="modal" data-target="#modal_tambah" class="btn btn-primary btn-flat btn-sm" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Universitas</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($universitas as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>

                  <td>'.$data->nama_pt.'</a></td>
                  <td>
                <a href="" data-toggle="modal" data-target="#modal_edit'.$data->id_pt.'" class="btn btn-warning btn-flat btn-xs"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>

                  <a href="'.base_url('universitas/hapus_universitas/'.$data->id_pt).'" class="btn btn-danger btn-flat btn-xs" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>

                         
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
                <h3 class="modal-title" id="myModalLabel"> Tambah Universitas</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('universitas/save_universitas'); ?>
                      <table class="table">
                          <tr>
          <td>Nama Universitas <font color="#FF0000">*</font></td>
            <td colspan="9">  <input type="text" name="nama_pt" id="nama_pt" style="width:300px" />
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
        foreach($universitas as $i):
        ?>
        <div class="modal fade" id="modal_edit<?php echo $i->id_pt;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Universitas</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('universitas/edit_universitas'); ?>
                      <table class="table">
        <tr>
          <td>Nama Universitas <font color="#FF0000">*</font></td>
            <td colspan="9">  <input type="text" name="nama_pt" id="nama_pt" value="<?php echo $i->nama_pt; ?>" style="width:300px"/>
              <input type="hidden" name="id_pt" id="id_pt" value="<?php echo $i->id_pt; ?>" />
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

