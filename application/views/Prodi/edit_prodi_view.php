<form  method="post" action="<?php echo base_url(); ?>master_prodi/save_edit_prodi/<?php echo $edit->id_prodi; ?>" enctype="multipart/form-data">
  <?php echo $this->session->flashdata('message');?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Edit Prodi</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  
                      <div class="form-group">
                        <label for="email">Id Prodi</label>
                        <input type="text" name="id_prodi" class="form-control" id="id_prodi" placeholder="Masukkan Id prodi" value="<?php echo $edit->id_prodi; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Nama Prodi</label>
                        <input type="text" required="" name="nama_prodi" class="form-control" id="nama_prodi" placeholder="Masukkan Nama prodi" value="<?php echo $edit->nama_prodi; ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Ketua Prodi</label>
                        <input type="text" name="ketua_prodi" required="" class="form-control" id="ketua_prodi" placeholder="Masukkan Ketua Prodi" value="<?php echo $edit->nama_dosen; ?>">
                         <input type="hidden" name="id_dosen" class="form-control" id="id_dosen" placeholder="Masukkan Ketua Prodi" value="<?php echo $edit->id_dosen; ?>">
                      </div>
                      <div class="form-group mb-n">
                  <div class="col-sm-8">
                  <label for="exampleInputFile" class="">    </label>
                    <input type="submit" name="submit" class="btn btn-default btn-flat" background_color="orange" id="largeinput" placeholder="Large Input" value="Edit">
                  </div>
                </div>      
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div>
        </form>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
  <script>
       document.getElementById("ketua_prodi").style.visibility = 'visible';

    jQuery(document).ready(function($){
    $('#ketua_prodi').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete', 
      minLength:1,
      select: function(event, ui){
        $('#ketua_prodi').val(ui.item.label)  ;
        $('#id_dosen').val(ui.item.id);
      }
    });    
  });

  </script>