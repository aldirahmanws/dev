<form  method="post" action="<?php echo base_url(); ?>finance/gagal_konfirmasi/<?php echo $edit->id_pendaftaran; ?>" enctype="multipart/form-data">
  <?php echo $this->session->flashdata('message');?>
<div class="row"> 
  

  <div class="col-md-12">

  <div class="box box-primary">

    <h3 style="text-align:center">Form Penolakan</h3>
  <div class="box-body">
    <div class="col-md-6">
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="no">No. Tamu</label>
                  <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" placeholder=""  .input-sm value="<?php echo $edit->id_pendaftaran; ?>" readonly required>
                </div>
                <div class="form-group">
                  <label for="no">Alasan Penolakan</label>
                  <textarea type="text" class="form-control input-sm" id="notes" name="notes" placeholder=""><?php echo $edit->notes; ?></textarea>
                </div>
               
                
               <button type="submit" class="btn btn-danger pull-right">Tolak</button>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

                

               
                  <?php echo form_close();?>
            
          
  </div>
            </form>
        </div></div>
          
      </div>
          </div>
</div>
</div>




