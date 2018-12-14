<?php echo $this->session->flashdata('message');?>
<div class="row"> 
  

  <div class="col-md-12">

  <div class="box box-primary">

    <h3 style="text-align:center">Detail Tamu Non Aktif</h3>
  <div class="box-body">
    <div class="col-md-6">
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="no">No. Tamu</label>
                  <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" placeholder=""  .input-sm value="<?php echo $edit->id_pendaftaran; ?>" readonly required>
                </div>
                <div class="form-group">
                  <label for="no">Follow Up 1</label>
                  <input type="text" name="f1" class="form-control" id="f1" placeholder=""  .input-sm value="<?php echo $edit->f1; ?>" >
                </div>
                <div class="form-group">
                  <label for="no">Follow Up 2</label>
                  <input type="text" name="f2" class="form-control" id="f2" placeholder=""  .input-sm value="<?php echo $edit->f2; ?>" >
                </div>
                <div class="form-group">
                  <label for="no">Follow Up 3</label>
                  <input type="text" name="f3" class="form-control" id="f3" placeholder=""  .input-sm value="<?php echo $edit->f3; ?>" >
                </div>
                <div class="form-group">
                  <label for="no">Catatan</label>
                 <textarea type="text" class="form-control input-sm" id="inputEmail3" placeholder=""><?php echo $edit->notes; ?></textarea>
                </div>
                
               
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

                

               
                 
            
          
  </div>
            </form>
        </div></div>
          
      </div>
          </div>
</div>
</div>




