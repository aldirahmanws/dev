<?php echo $this->session->flashdata('message');?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Tambah Dosen</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  <?php echo $this->session->flashdata('message');?>
                  <form  method="post" runat="server" action="<?php echo base_url(); ?>master_dosen/save_dosen" enctype="multipart/form-data">
                   
                      <div class="form-group">
                        <label for="text">Nama Dosen <font color="#FF0000">*</font></label>
                        <input type="text" name="nama_dosen" class="form-control" id="nama_dosen" required="">
                         
                      </div>
                      <div class="form-group">
                        <label for="number">NIDN / NUP/ NIDK</label>
                        <input type="text" name="nidn" class="form-control" id="nidn" value="">
                      </div>
                      <div class="form-group">
                        <label for="text">NIP</label>
                        <input type="number" name="nip" class="form-control" id="nip" value="">
                      </div>
                      <div class="form-group">
                        <label for="text">Jenis Kelamin <font color="#FF0000">*</font></label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required="">
                            <option value="">Pilih Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                          </select>  
                      </div>
                       <div class="form-group">
                        <label for="text">Agama</label>
                        <select id="agama" name="agama" class="form-control" required="">
                             <option value="">Pilih Agama</option>
                              <option value="1">Islam</option>
                              <option value="2">Katholik</option>
                              <option value="3">Kristen</option>
                              <option value="4">Hindu</option>
                              <option value="5">Budha</option>
                              <option value="6">Konghucu</option>
                          </select> 
                      </div>
                      <div class="form-group">
                        <label for="text">Jenis Dosen <font color="#FF0000">*</font></label>
                        <select id="jenis_dosen" name="jenis_dosen" class="form-control" required="">
                             <option value="1">Tetap</option>
                              <option value="2">Tidak Tetap</option>
                          </select> 
                      </div>
                       
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="text">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="">
                      </div>
                       <div class="form-group">
                        <label for="text">Tanggal Lahir <font color="#FF0000">*</font></label>
                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required=" value">
                      </div>
                       <div class="form-group">
                        <label for="text">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" value="">
                      </div>
                       <div class="form-group">
                        <label for="text">Email <font color="#FF0000">*</font></label>
                        <input type="email" name="email" class="form-control" id="email" required="">
                      </div>
                       <div class="form-group">
                        <label for="text">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" id="no_telepon" value="">
                      </div>
                       <div class="form-group">
                        <label for="text">Foto Dosen</label>
                        <input type="file" name="foto_dosen" id="foto_dosen" class="form-control" value="">
                      </div>
                       <br>
                       <br>
                      <button type="submit" class="btn btn-info pull-right">Simpan</button>
                      
                  <?php echo form_close();?>
              </div></div></div>
            </div>
          </div>
        </div>
          </div>
        <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
            - Master dosen digunakan untuk mengelola data dosen.
            <br />
            - User wajib mengisi inputan yang disediakan (wajib dengan tanda bintang merah).
            <br />
            - Username dan password dosen akan dikirim otomatis melalui email sesuai inputan.
         </div>


