<?php echo $this->session->flashdata('message');?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Tambah Prodi</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  
                  <?php echo form_open('master_prodi/save_prodi'); ?>
                      <div class="form-group">
                        <label for="email">Id Prodi</label>
                        <input type="text" name="id_prodi" class="form-control" id="id_prodi" placeholder="Masukkan Id prodi" value="" required="">
                      </div>
                      <div class="form-group">
                        <label for="email">Nama Prodi</label>
                        <input type="text" name="nama_prodi" class="form-control" id="nama_prodi" placeholder="Masukkan Nama prodi">
                      </div>
                      <div class="form-group">
                        <label for="email">Ketua Prodi</label>
                        <input type="text" name="ketua_prodi" class="form-control" id="ketua_prodi" placeholder="Masukkan Ketua Prodi">
                        <input type="hidden" name="id_dosen" class="form-control" id="id_dosen">
                      </div>
                      <button type="submit" class="btn btn-info">Save</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                  <?php echo form_close();?>
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div>


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