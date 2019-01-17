<form  method="post" action="<?php echo base_url(); ?>daftar_ulang/save_edit_du/<?php echo $du->id_mahasiswa; ?>" enctype="multipart/form-data">
  <?php echo $this->session->flashdata('message');?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Detail Mahasiswa <?php echo $du->nama_mahasiswa; ?></div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  
                
                <div class="form-group">
                  <label for="no">NIM</label>
                  <input type="text" name="nim" class="form-control" id="nim" required .input-sm value="<?php echo $du->nim; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="email">Nama Lengkap</label>
                  <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" required value="<?php echo $du->nama_mahasiswa; ?>">
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <input type="text" name="id_kelamin" class="form-control" id="id_kelamin" required value="<?php echo $du->jenis_kelamin; ?>">                                   
                  
                </div>
                <div class="form-group">
                  <label for="email">Tanggal Lahir</label>
                  <input type="text" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required value="<?php echo date("d-m-Y", strtotime($du->tanggal_lahir)); ?>">
                </div>
                <div class="form-group">
                  <label for="place">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"  required value="<?php echo $du->tempat_lahir; ?>">
                </div>
                <div class="form-group">
                  <label for="religion">Agama</label>
                <select id="agama" name="id_agama" class="form-control">
                  <option value="<?php echo $du->id_agama; ?>"><?php echo $du->agama; ?></option>
                  <option value="1">Islam</option>
                  <option value="2">Katholik</option>
                  <option value="3">Kristen</option>
                  <option value="4">Hindu</option>
                  <option value="5">Budha</option>
                  <option value="6">Konghucu</option>

                </select>                                     
                </div>
                <div class="form-group">
                  <label for="address">Alamat Rumah</label>
                  <input type="text" name="alamat_mhs" class="form-control" id="alamat_mhs" required value="<?php echo $du->alamat_mhs; ?>">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="number" name="no_telepon" class="form-control" id="no_telepon" required value="<?php echo $du->no_telepon; ?>">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor HP</label>
                  <input type="number" name="no_hp" class="form-control" id="no_hp" required value="<?php echo $du->no_hp; ?>">
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" required value="<?php echo $du->email; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Kode Pos</label>
                  <input type="text" name="kode_pos" class="form-control" id="kode_pos" required value="<?php echo $du->kode_pos; ?>">
                </div>
                <?php if ($du->asal_pt == NULL OR $du->asal_pt == '' OR $du->asal_pt == ' ') { ?>
                  <div class="form-group">
                  <label for="preschool">Asal Sekolah</label>
                  <input type="text" name="id_sekolah" class="form-control" id="id_sekolah" required value="<?php echo $du->nama_sekolah; ?>">
                </div>
                 <div class="form-group">
                  <label for="major">Jurusan Asal</label>
               <input type="text" name="jurusan" class="form-control" id="jurusan" required value="<?php echo $du->jurusan; ?>">                                   
                </div>
                <input type="hidden" name="asal_prodi" value="">
                <input type="hidden" name="asal_pt" value="">
                <?php } else { ?>
                <div class="form-group">
                  <label for="preschool">Asal Universitas</label>
                 <input type="text" name="asal_pt" class="form-control" id="asal_pt" required value="<?php echo $du->nama_pt; ?>">  
                </div>
                 <div class="form-group">
                  <label for="major">Jurusan Asal</label>
                 <input type="text" name="asal_prodi" class="form-control" id="asal_prodi" required value="<?php echo $du->asal_prodi; ?>">                                 
                </div>
                <input type="hidden" name="id_sekolah" value="">
                <input type="hidden" name="jurusan" value="">
              <?php } ?>
               
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="number" name="nik" class="form-control" id="nik"  required value="<?php echo $du->nik; ?>">
                </div>
                <div class="form-group">
                  <label for="mother">Nama Ibu</label>
                  <input type="text" name="nama_ibu" class="form-control" id="nama_ibu"  required value="<?php echo $du->nama_ibu; ?>">
                </div>
                <div class="form-group">
                  <label for="prodi">Program Studi</label>
                   <input type="text" name="id_prodi" class="form-control" id="id_prodi" required value="<?php echo $du->nama_prodi; ?>">                                   
                </div>
                <div class="form-group">
                  <label for="concentrate">Konsentrasi</label>
                   <input type="text" name="concentrate" class="form-control" id="concentrate" required value="<?php echo $du->nama_konsentrasi; ?>">                                    
                </div>
                
                <br>
                <br>
                <br>
                <br>
                <div class="box-footer">
                 
                
                	</div>
                  
                            </form>
                        </div></div>
                          
                      </div>
                          </div>
                </div>
</div>
