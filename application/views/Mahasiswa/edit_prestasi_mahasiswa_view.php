<form  method="post" action="<?php echo base_url(); ?>mahasiswa/edit_prestasi/<?php echo $prestasi->id_prestasi; ?>" enctype="multipart/form-data">
  <?php echo $this->session->flashdata('message');?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Detail Prestasi</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  
                 
                          <div class="form-group">
                            <label>Jenis Prestasi</label>
                            <select name="jenis_prestasi" id="jenis_prestasi" required="" class="form-control select2">
                                <option value="<?php echo $prestasi->jenis_prestasi; ?>"> <?php echo $prestasi->jenis_prestasi; ?></option>
                                <option value="Sains">Sains</option>
                                <option value="Olahraga">Olahraga</option>
                                 <option value="Seni">Seni</option>
                                 <option value="Lain-lain">Lain-lain</option>
                                 </select>
                       
                      </div>
                       <div class="form-group">
                        <label for="email">Tingkat Prestasi</label>
                       <select name="tingkat_prestasi" id="tingkat_prestasi" required="" class="form-control select2">
                            <option value="<?php echo $prestasi->tingkat_prestasi; ?>"> <?php echo $prestasi->tingkat_prestasi; ?></option>
                            <option value="Islam">Sekolah</option>
                            <option value="Kecamatan">Kecamatan</option>
                             <option value="Kab/Kota">Kab/Kota</option>
                             <option value="Provinsi">Provinsi</option>
                             <option value="Nasional">Nasional</option>
                             <option value="Internasional">Internasional</option>
                             <option value="Lainnya">Lainnya</option>
                             </select>
                      </div>
                       <div class="form-group">
                        <label for="email">Nama Prestasi</label>
                        <input type="text" name="nama_prestasi" class="form-control" id="nama_prestasi"  value="<?php echo $prestasi->nama_prestasi; ?>">
                        <input type="hidden" name="id_mahasiswa" class="form-control" id="id_mahasiswa"  value="<?php echo $prestasi->id_mahasiswa; ?>">
                      </div>
                       <div class="form-group">
                        <label for="email">Tahun</label>
                        <input type="text" name="tahun" class="form-control" id="tahun" value="<?php echo $prestasi->tahun; ?>">
                      </div>
                    
                       <div class="form-group">
                        <label for="email">Penyelenggara</label>
                        <input type="text" name="penyelenggara" class="form-control" id="penyelenggara" placeholder="92 / 92.4" value="<?php echo $prestasi->penyelenggara; ?>">
                      </div>
                       <div class="form-group">
                        <label for="email">Peringkat</label>
                        <input type="text" name="peringkat" class="form-control" id="peringkat" placeholder="Masukkan Tanggal" value="<?php echo $prestasi->peringkat; ?>">
                      </div>
                      <br>
                      <button type="submit" class="btn btn-info pull-left">Ubah</button>
                      
                  </form>
                </div>
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>