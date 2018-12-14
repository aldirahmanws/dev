<form  method="post" action="<?php echo base_url(); ?>tamu/save_edit_tamu/<?php echo $edit->id_pendaftaran; ?>" enctype="multipart/form-data">
  <?php echo $this->session->flashdata('message');?>
<div class="row"> 
	

	<div class="col-md-12">

	<div class="box box-primary">

		<h3 style="text-align:center">Detail Tamu</h3>
	<div class="box-body">
    <div class="col-md-6">
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="no">No. Tamu</label>
                  <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" placeholder=""  .input-sm value="<?php echo $edit->id_pendaftaran; ?>" readonly required>
                </div>
                <div class="form-group">
                  <label for="email">Nama Lengkap</label>
                  <input type="text" name="nama_pendaftar" class="form-control" id="nama_pendaftar" placeholder="Input Full Name" required="" value="<?php echo $edit->nama_pendaftar; ?>">
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select id="jk_pendaftar" name="jk_pendaftar" class="form-control" ="" required="">
            <option value="<?php echo $edit->jk_pendaftar; ?>"><?php echo $edit->jenis_kelamin; ?></option>
            <option value="L">Laki - laki</option>
            <option value="P">Perempuan</option>

          </select>                                     
                  
                </div>
                                                
                
                <div class="form-group">
                  <label for="address">Alamat Rumah</label>
                  <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Input Home Address" required="" value="<?php echo $edit->alamat; ?>">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="number" name="no_telp" class="form-control" id="no_telp" placeholder="Input Phone Number" required="" value="<?php echo $edit->no_telp; ?>">
                </div>
                   <div class="form-group">
                  <label for="waktu">Waktu</label>
                  <select id="id_waktu" name="id_waktu" class="form-control" ="" required="">
                    <option value="<?php echo $edit->id_waktu; ?>"><?php echo $edit->waktu; ?></option>
                    <option value="1">Pagi</option>
                    <option value="2">Sore</option>

                  </select>                                     
                  
                </div>
                

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Input Email" required="" value="<?php echo $edit->email; ?>">
                </div>

                <?php if ($edit->id_pt == NULL OR $edit->id_pt == '') { ?>
                  <div class="form-group">
                  <label for="preschool">Asal Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah"class="form-control" required="">
                  <option value="<?php echo $edit->id_sekolah; ?>"><?php echo $edit->nama_sekolah; ?></option>
                  <?php 

                  foreach($getPreschool as $row)
                  { 
                    echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
                  }
                  ?>

                </select>   
                </div>
                <div class="form-group">
                  <label for="major">Jurusan di Sekolah Sebelumnya</label>
                <select id="jurusan" name="jurusan" class="form-control" ="">
                  <option value="<?php echo $edit->jurusan; ?>"><?php echo $edit->jurusan; ?></option>
                  <option value="ipa">IPA</option>
                  <option value="ips">IPS</option>
                  <option value="tkj">TKJ</option>
                  <option value="rpl">RPL</option>
                </select>                                     
                </div>
                <input type="hidden" name="id_pt" value="">
                <?php } else { ?>
                  <div class="form-group">
                  <label for="preschool">Asal Universitas</label>
                  <select id="id_pt" name="id_pt"class="form-control" required="">
                  <option value="<?php echo $edit->id_pt; ?>"><?php echo $edit->nama_pt; ?></option>
                  <?php 

                  foreach($getUniversitas as $row)
                  { 
                    echo '<option value="'.$row->id_pt.'">'.$row->nama_pt.'</option>';
                  }
                  ?>

                </select>   
                </div>
                  <div class="form-group">
                  <label for="phone">Asal Prodi</label>
                  <input type="text" name="jurusan" class="form-control" id="jurusan" placeholder="Input Phone Number" required="" value="<?php echo $edit->jurusan; ?>">
                </div>
                <input type="hidden" name="id_sekolah" value="">
                <?php } ?>
                
               


                <div class="form-group">
                  <label for="prodi">Program Studi</label>
                  <select id="id_prodi" class="form-control" name="id_prodi" ="" onchange="return get_concentrate(this.value)">
                    <option value="<?php echo $edit->id_prodi; ?>"><?php echo $edit->nama_prodi; ?></option>   
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
                <select id="id_sumber" name="id_sumber" class="form-control" ="" onchange="return get_student(this.value)">
                  <option value="<?php echo $edit->id_sumber; ?>"><?php echo $edit->nama_sumber; ?></option>
                  <option value="1">Brosur</option>
                  <option value="2">Iklan</option>
                  <option value="3">Marketing</option>
                  <option value="4">Student get Student</option>
                </select>                                     
                </div>
                <div id="input_student">
                <label for="major">Student Get Student</label>
                <div class="input-group" >
               
                <!-- /btn-group -->
                <input type="text" class="form-control" id="student" name="sgs" value="<?php echo $edit->sgs; ?>" readonly>
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

                

                <button type="submit" class="btn btn-info pull-right">Update</button>
              		<?php echo form_close();?>
            
          
	</div>
            </form>
        </div></div>
          
      </div>
          </div>
</div>
</div>
<script>
    if(document.getElementById("sumber").value=="4")
        document.getElementById("input_student").style.visibility = 'visible';
        else
        document.getElementById("input_student").style.visibility = 'hidden';
    function myFunction(name) {
        document.getElementById("student").value = name;
    }
    function get_student(param){
        if(param=="4")
        document.getElementById("input_student").style.visibility = 'visible';
        else
        document.getElementById("input_student").style.visibility = 'hidden';
    }
</script>
       