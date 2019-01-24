
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
              <div class="table-responsive">
              <table id="example1" class="table table-striped table-hover table-responsive table-condensed" style="text-transform: uppercase;">
                <a href="" data-toggle="modal" data-target="#modal_tambah" class="btn btn-primary btn-flat btn-sm" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th style="width: 2%">No</th>
                  <th>Nama Universitas</th>
                  <th style="width: 5%">Aksi</th>
                </tr>
                </thead>
                <tbody>

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

      <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
            - Master universitas digunakan untuk mengelola data universitas.
            <br>
            - Data ini dibutuhkan untuk kelengkapan administrasi ketika mahasiswa registrasi (Pindahan, mutasi, alih jenjang).
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

<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
        $('#example1').DataTable( {
            data:           <?= $universitas; ?>,  
            deferRender:    true,
            scrollCollapse: true,
            scroller:       true,
            "autoWidth": true
        } );
        
    } );
</script>

   

