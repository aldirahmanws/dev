<form  method="post" action="<?php echo base_url(); ?>mahasiswa/edit_ld/<?php echo $mahasiswa->id_mahasiswa; ?>" enctype="multipart/form-data">
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Edit Data Kelulusan </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <?php echo $this->session->flashdata('message');?>
                      <div class="form-group">
                        <label for="email">Nama</label>
                        <input type="text" name="id_sekolah" class="form-control" id="id_sekolah" placeholder="Masukkan Id konsentrasi" value="<?php echo $mahasiswa->nama_mahasiswa; ?>" readonly>
                         <input type="hidden" name="id_sekolah" class="form-control" id="id_sekolah" placeholder="Masukkan Id konsentrasi" value="<?php echo $mahasiswa->id_mahasiswa; ?>" readonly>
                      </div>
                    </div>
                      <div class="col-lg-6">
                      <div class="form-group">
                        <label for="email">Jenis Keluar</label>
                         <select name="id_status" id="id_status" class="form-control"  required="">
                      <option value="<?php echo $mahasiswa->id_status; ?>"><?php echo $mahasiswa->status_mhs; ?></option>
                      <option value="11">Lulus</option>
                      <option value="13">Mutasi</option>
                      <option value="5">Dikeluarkan</option>
                      <option value="7">Mengundurkan diri</option>
                      <option value="14">Putus Sekolah</option>
                      <option value="8">Meninggal Dunia</option>
                      <option value="10">Hilang</option>
                      <option value="15">Lainnya</option>
                      </select>    
                      </div>
                      <div class="form-group">
                        <label for="email">Tanggal Keluar</label>
                        <input type="date" name="tanggal_keluar" class="form-control" id="tanggal_keluar" placeholder="Masukkan Nama konsentrasi" value="<?php echo $mahasiswa->tanggal_keluar; ?>">
                      </div>
                        <div class="form-group">
                        <label for="email">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Masukkan Nama konsentrasi" value="<?php echo $mahasiswa->keterangan; ?>">
                      </div>
                    </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                        <label for="email">SK Yudisium</label>
                        <input type="text" name="sk_yudisium" class="form-control" id="sk_yudisium" placeholder="Masukkan Nama konsentrasi" value="<?php echo $mahasiswa->sk_yudisium; ?>">
                      </div>
                        <div class="form-group">
                        <label for="email">Tanggal SK Yudisium</label>
                        <input type="date" name="tgl_sk_yudisium" class="form-control" id="tgl_sk_yudisium" placeholder="Masukkan Nama konsentrasi" value="<?php echo $mahasiswa->tgl_sk_yudisium; ?>">
                      </div>
                       <div class="form-group">
                        <label for="email">No. Seri Ijazah</label>
                        <input type="text" name="no_seri_ijazah" class="form-control" id="no_seri_ijazah" placeholder="Masukkan Nama konsentrasi" value="<?php echo $mahasiswa->no_seri_ijazah; ?>">
                      </div>
                      </div>


                  <div class="col-sm-8">
                  <label for="exampleInputFile" class="pull-right">    </label>
                    <input type="submit" name="submit" class="btn btn-iinfo" background_color="orange" id="largeinput" placeholder="Large Input" value="Update">
                  </div>
               
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>
        </form>