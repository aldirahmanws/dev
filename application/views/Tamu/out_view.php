<form  method="post" action="<?php echo base_url(); ?>tamu/save_out/<?php echo $edit->id_pendaftaran; ?>" enctype="multipart/form-data">
  <?php echo $this->session->flashdata('message');?>
<div class="row"> 
  

  <div class="col-md-12">

  <div class="box box-primary">

    <h3 style="text-align:center">Form Non Aktif</h3>
  <div class="box-body">
    <div class="col-md-6">
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="no">No. Tamu</label>
                  <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" placeholder=""  .input-sm value="<?php echo $edit->id_pendaftaran; ?>" readonly required>
                </div>
                <div class="form-group">
                  <label for="no">Catatan</label>
                  <input type="text" name="notes" class="form-control" id="notes" placeholder=""  .input-sm value="<?php echo $edit->notes; ?>" required>
                </div>
                
               <button type="submit" class="btn btn-info pull-right">Update</button>
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


