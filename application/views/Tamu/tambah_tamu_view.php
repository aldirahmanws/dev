<div class="row"> 
  <?php echo $this->session->flashdata('message');?>
  <?php echo form_open('tamu/save_tamu'); ?>
  <div class="col-md-12">

  <div class="box box-primary">

    <h3 style="text-align:center">Tambah Tamu</h3>
  <div class="box-body">
    <div class="col-md-6">
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="no">No. Tamu</label>
                  <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" placeholder=""  .input-sm value="<?php echo $kodeunik; ?>" readonly required>
                </div>
                <div class="form-group">
                  <label for="email">Nama Lengkap</label>
                  <input type="text" name="nama_pendaftar" class="form-control" id="nama_pendaftar" placeholder="Input Full Name" required="">
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select id="jk_pendaftar" name="jk_pendaftar" class="form-control" ="" required="">
            <option value="">Select Gender</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>

          </select>                                     
                  
                </div>
                                                
                
                <div class="form-group">
                  <label for="address">Alamat Rumah</label>
                  <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Input Home Address" required="">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="number" name="no_telp" class="form-control" id="no_telp" placeholder="Input Phone Number" required="">
                </div>
                   <div class="form-group">
                  <label for="waktu">Waktu</label>
                  <select id="waktu" name="waktu" class="form-control" ="" required="">
                    <option value="">Pilih Waktu Kuliah</option>
                    <option value="1">Pagi</option>
                    <option value="2">Sore</option>

                  </select>                                     
                  
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Input Email" required="">
                </div>

                <div class="form-group" >
                  <label for="preschool">Universitas / Sekolah</label>
                  <select id="pilih_asal" name="pilih_asal"class="form-control" required="" onchange="return get_asal(this.value);" onclick="return get_asal2(this.value);">
                  <option value="">Pilih Universitas / Sekolah</option>
                  <option value="1"> Sekolah </option>
                  <option value="2"> Universitas </option>

                </select>   
                </div>

                <div class="form-group" id="sekolah" style="display: none">
                  <label for="preschool">Asal Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah" class="form-control select2" style="width: 100%">
                  <option value="">Pilih Sekolah</option>
                  <?php 

                  foreach($getPreschool as $row)
                  { 
                    echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
                  }
                  ?>

                </select>  
                
                </div>

                <div class="form-group" id="universitas"  style="display: none">
                  <label for="preschool">Asal Universitas</label>
                  <select name="id_pt" id="id_pt" class="form-control select2" style="width: 100%;">
                  <option value="">Pilih Universitas</option>
                  <?php 

                  foreach($getUniversitas as $row)
                  { 
                    echo '<option value="'.$row->id_pt.'">'.$row->nama_pt.'</option>';
                  }
                  ?>

                </select>  
                
                </div>

                <div class="form-group">
                  <label for="major">Jurusan di Sekolah / Universitas Sebelumnya</label>
                <select id="jurusan" name="jurusan" class="form-control" required="">
                  <option value="">Pilih Jurusan</option>
                  <option value="IPA">IPA</option>
                  <option value="IPS">IPS</option>
                  <option value="Management">Management</option>
                  <option value="Akuntansi">Akuntansi</option>
                  <option value="Lainnya">Lainya</option>
                </select>                                     
                </div>
               


                <div class="form-group">
                  <label for="prodi">Program Studi</label>
                  <select id="id_prodi" class="form-control" name="id_prodi" ="" onchange="return get_concentrate(this.value)" required="">
                    <option value="">Pilih Program Studi</option>   
                    <?php 

                  foreach($getProdi as $row)
                  { 
                    echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                  }
                  ?>
                  </select>                                     
                </div>   

                <div class="form-group">
                  <label for="major">Sumber Informasi</label>
                <select id="sumber" name="sumber" class="form-control" ="" onchange="return get_student(this.value)" required="">
                  <option value="">Pilih Sumber</option>
                  <option value="1">Brosur</option>
                  <option value="2">Iklan</option>
                  <option value="3">Marketing</option>
                  <option value="4">Student get Student</option>
                </select>                                     
                </div>
                <div id="input_student" style="visibility: hidden;">
                <label for="major">Student Get Student</label>
                <div class="input-group" >
               
                <!-- /btn-group -->
                <input type="text" class="form-control" id="student" name="student" value="" hidden="">
                 <div class="input-group-btn">
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default"><i class="fa fa-search"></i></button>
                </div>
                </div></div>
                <br>
                 
                <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Mahasiswa</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Nama Prodi</th>
                  <th>Waktu</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($mahasiswa as $data) {
                  if ($data->id_status == 1 OR $data->id_status == 19) {
                    
                  echo '
                  
                <tr>
                  <td id="nim">'.$data->nim.'
                  </td>
                  <td>'.$data->nama_mahasiswa.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td><p class="btn btn-default btn-sm" data-dismiss="modal" onclick="myFunction('.$data->nim.')">Pilih</p></td>
                </tr>
                ';
                }
              }
              ?>
                </tbody>
              </table>
            </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

                

                <button type="submit" class="btn btn-info pull-right">Daftar</button>
                  <?php echo form_close();?>
            
          
  </div>
            </form>
        </div></div>
          
      </div>
          </div>
</div>
</div>
<script>
function myFunction(name) {
    document.getElementById("student").value = name;
}
function get_student(param){
if(param=="4")
document.getElementById("input_student").style.visibility = 'visible';
else
document.getElementById("input_student").style.visibility = 'hidden';
}

function get_asal(param){
if(param=="1")
document.getElementById("sekolah").style.display = null;
else
document.getElementById("sekolah").style.display = 'none';
}

function get_asal2(param){
if(param=="2")
document.getElementById("universitas").style.display = null;
else
document.getElementById("universitas").style.display = 'none';
}
</script>


       