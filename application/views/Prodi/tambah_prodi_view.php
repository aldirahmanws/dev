<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Tambah Prodi</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <?php echo $this->session->flashdata('message');?>
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
                      </div>
                      <button type="submit" class="btn btn-info">Tambah</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                  <?php echo form_close();?>
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>