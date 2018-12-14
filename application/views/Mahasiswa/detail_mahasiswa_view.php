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
                  <input type="text" name="nim" class="form-control" id="nim" placeholder="" required .input-sm value="<?php echo $du->nim; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="email">Nama Lengkap</label>
                  <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" placeholder="Input Full Name" required value="<?php echo $du->nama_mahasiswa; ?>">
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select id="gender" name="id_kelamin" class="form-control">
            <option value="<?php echo $du->id_kelamin; ?>"><?php echo $du->jenis_kelamin; ?></option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>

          </select>                                     
                  
                </div>
                <div class="form-group">
                  <label for="email">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required value="<?php echo $du->tanggal_lahir; ?>">
                </div>
                <div class="form-group">
                  <label for="place">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Input Birth Place" required value="<?php echo $du->tempat_lahir; ?>">
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
                  <input type="text" name="alamat_mhs" class="form-control" id="alamat_mhs" placeholder="Input Home Address" required value="<?php echo $du->alamat_mhs; ?>">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="number" name="no_telepon" class="form-control" id="no_telepon" placeholder="Input Phone Number" required value="<?php echo $du->no_telepon; ?>">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor HP</label>
                  <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="Input Mobile Phone Number" required value="<?php echo $du->no_hp; ?>">
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Input Email" required value="<?php echo $du->email; ?>">
                </div>
                <div class="form-group">
                  <label for="email">Kode Pos</label>
                  <input type="text" name="kode_pos" class="form-control" id="kode_pos" placeholder="Input Email" required value="<?php echo $du->kode_pos; ?>">
                </div>
                <?php if ($du->asal_pt == NULL OR $du->asal_pt == '') { ?>
                  <div class="form-group">
                  <label for="preschool">Asal Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah"class="form-control">
                  <option value="<?php echo $du->id_sekolah; ?>"><?php echo $du->nama_sekolah; ?></option>
                   <?php 

                  foreach($getPreschool as $row)
                  { 
                    echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
                  }
                  ?>

                </select>   
                </div>
                 <div class="form-group">
                  <label for="major">Jurusan Asal</label>
                <select id="jurusan" name="jurusan" class="form-control" >
                  <option value="<?php echo $du->jurusan; ?>"><?php echo $du->jurusan; ?></option>
                  <option value="IPA">IPA</option>
                  <option value="IPS">IPS</option>
                  <option value="Management">Management</option>
                  <option value="Akuntansi">Akuntansi</option>
                  <option value="Lainnya">Lainnya</option>
                </select>                                     
                </div>
                <input type="hidden" name="asal_prodi" value="">
                <input type="hidden" name="asal_pt" value="">
                <?php } else { ?>
                <div class="form-group">
                  <label for="preschool">Asal Universitas</label>
                  <select id="asal_pt" name="asal_pt"class="form-control">
                  <option value="<?php echo $du->id_pt; ?>"><?php echo $du->nama_pt; ?></option>
                   <?php 

                  foreach($getUniversitas as $row)
                  { 
                    echo '<option value="'.$row->id_pt.'">'.$row->nama_pt.'</option>';
                  }
                  ?>

                </select>   
                </div>
                 <div class="form-group">
                  <label for="major">Jurusan Asal</label>
                <select id="asal_prodi" name="asal_prodi" class="form-control" >
                  <option value="<?php echo $du->asal_prodi; ?>"><?php echo $du->asal_prodi; ?></option>
                  <option value="IPA">IPA</option>
                  <option value="IPS">IPS</option>
                  <option value="Management">Management</option>
                  <option value="Akuntansi">Akuntansi</option>
                  <option value="Lainnya">Lainnya</option>
                </select>                                     
                </div>
                <input type="hidden" name="id_sekolah" value="">
                <input type="hidden" name="jurusan" value="">
              <?php } ?>
               
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="number" name="nik" class="form-control" id="nik" placeholder="Input NIK" required value="<?php echo $du->nik; ?>">
                </div>
                <div class="form-group">
                  <label for="mother">Nama Ibu</label>
                  <input type="text" name="nama_ibu" class="form-control" id="nama_ibu" placeholder="Input your mother Name" required value="<?php echo $du->nama_ibu; ?>">
                </div>
                <div class="form-group">
                  <label for="prodi">Program Studi</label>
                  <select id="id_prodi" class="form-control" name="id_prodi" onchange="return get_concentrate(this.value)">
                    <option value="<?php echo $du->id_prodi; ?>"><?php echo $du->nama_prodi; ?></option>   
                     <?php 

                  foreach($getProdi as $row)
                  { 
                    echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                  }
                  ?>
                  </select>                                     
                </div>
                <div class="form-group">
                  <label for="concentrate">Konsentrasi</label>
                  <select id="concentrate" name="concentrate" class="form-control">
                  <option value="<?php echo $du->id_konsentrasi; ?>"><?php echo $du->nama_konsentrasi; ?></option>
                  </select>                                     
                </div>
                
                <br>
                <br>
                <br>
                <br>
                <div class="box-footer">
                 
                <button type="submit" class="btn btn-info pull-right">Ubah</button>
                	</div>
                  
                            </form>
                        </div></div>
                          
                      </div>
                          </div>
                </div>
</div>
<script type="text/javascript">
            function get_concentrate(p) {
                var prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>daftar_ulang/get_concentrate/'+prodi,
                    data: 'prodi='+prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#concentrate").html(msg);

                    }
                });
            }
            // function get_price(p) {
            //     var produk = p;

            //     $.ajax({
            //         url: 'order/order_price/'+produk,
            //         data: 'produk='+produk,
            //         type: 'GET',
            //         dataType: 'html',
            //         success: function(msg) {
            //             var data = msg.split("|");
            //             var harga = data[0] * 1000;
            //             $("#js_hts").html(harga);
            //             $("#js_min").html(data[1]);
            //             $("#js_max").html(data[2]);
            //         }
            //     });
            // };
        </script>