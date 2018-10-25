<form  method="post" action="<?php echo base_url(); ?>master_prodi/save_edit_prodi/<?php echo $edit->id_prodi; ?>" enctype="multipart/form-data">
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Edit Prodi</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <?php echo $this->session->flashdata('message');?>
                      <div class="form-group">
                        <label for="email">Id Prodi</label>
                        <input type="text" name="id_prodi" class="form-control" id="id_prodi" placeholder="Masukkan Id prodi" value="<?php echo $edit->id_prodi; ?>" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Nama Prodi</label>
                        <input type="text" name="nama_prodi" class="form-control" id="nama_prodi" placeholder="Masukkan Nama prodi" value="<?php echo $edit->nama_prodi; ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Ketua Prodi</label>
                        <input type="text" name="ketua_prodi" class="form-control" id="ketua_prodi" placeholder="Masukkan Ketua Prodi" value="<?php echo $edit->ketua_prodi; ?>">
                      </div>
                      <div class="form-group mb-n">
                  <div class="col-sm-8">
                  <label for="exampleInputFile" class="">    </label>
                    <input type="submit" name="submit" class="btn btn-default" background_color="orange" id="largeinput" placeholder="Large Input" value="Edit">
                  </div>
                </div>      
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div>
        </form>