<?php echo $this->session->flashdata('message');?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-pencil"></i> EDIT DOSEN</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  <?php echo $this->session->flashdata('message');?>
                  <?php echo form_open('master_dosen/edit_dosen/'.$dosen->id_dosen); ?>
                      <div class="form-group">
                        <label for="text">Nama Dosen</label>
                        <input type="text" name="nama_dosen" class="form-control" id="nama_dosen" value="<?php echo $dosen->nama_dosen; ?>">
                         <input type="hidden" name="id_dosen" class="form-control" id="id_dosen"  value="<?php echo $dosen->id_dosen; ?>">
                      </div>
                          <div class="form-group">
                        <label for="number">NIDN / NUP/ NIDK</label>
                        <input type="text" name="nidn" class="form-control" id="nidn" value="<?php echo $dosen->nidn; ?>">
                      </div>
                    
                      <div class="form-group">
                        <label for="text">NIP</label>
                        <input type="number" name="nip" class="form-control" id="nip" value="<?php echo $dosen->nip; ?>">
                      </div>
                      <div class="form-group">
                        <label for="text">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required="">
                            <option value="<?php echo $dosen->id_kelamin; ?>"><?php echo $dosen->jenis_kelamin; ?></option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                          </select>  
                      </div>
                       <div class="form-group">
                        <label for="text">Agama</label>
                        <select id="agama" name="agama" class="form-control" required="">
                             <option value="<?php echo $dosen->id_agama; ?>"><?php echo $dosen->agama; ?></option>
                              <option value="1">Islam</option>
                              <option value="2">Katholik</option>
                              <option value="3">Kristen</option>
                              <option value="4">Hindu</option>
                              <option value="5">Budha</option>
                              <option value="6">Konghucu</option>
                          </select> 
                      </div>
                       
                    </div>
                    <div class="col-lg-6">
                       
                       <div class="form-group">
                        <label for="text">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo $dosen->alamat; ?>">
                      </div>
                       <div class="form-group">
                        <label for="text">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?php echo $dosen->email; ?>">
                      </div>
                      <div class="form-group">
                        <label for="text">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="<?php echo $dosen->tgl_lahir; ?>">
                      </div>
                       <div class="form-group">
                        <label for="text">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" id="no_telepon" value="<?php echo $dosen->no_hp; ?>">
                      </div>
                       <div class="form-group">
                        <label for="text">Jenis Dosen</label>
                        <select id="jenis_dosen" name="jenis_dosen" class="form-control" required="">
                             <option value="<?php echo $dosen->id_status_dosen; ?>"><?php echo $dosen->status_dosen; ?></option>
                             <option value="1">Tetap</option>
                              <option value="2">Tidak Tetap</option>
                          </select> 
                      </div>
                      <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i> Update</button>
                      </div>
                  <?php echo form_close();?>
              </div></div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>