  <?php echo $this->session->flashdata('message');?>
<div class="row"> 

	<?php echo form_open('daftar_ulang/daftar_ulang'); ?>
	<div class="col-md-12">

	<div class="box box-primary">

		<h3 style="text-align:center">Daftar Ulang</h3>
	<div class="box-body">
    <div class="col-md-6">
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="no">No. Daftar Ulang</label>
                  <input type="text" name="no_du" class="form-control" id="no_du" placeholder=""  .input-sm value="<?php echo $kodeunik; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="no">Kode Tes</label>
                  <input type="text" name="no_du" class="form-control" id="no_du" placeholder=""  .input-sm value="<?php echo $du_pagi->id_hasil_tes2; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="email">Nama Lengkap</label>
                  <input type="text" name="nama_du" class="form-control" id="nama_du" placeholder="Input Full Name" value="<?php echo $du_pagi->nama_pendaftar; ?>">
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select id="gender" name="gender" class="form-control" ="">
            <option value="">Select Gender</option>
            <option value="laki-laki">Laki - laki</option>
            <option value="perempuan">Perempuan</option>

          </select>                                     
                  
                </div>
                <div class="form-group">
                  <label for="email">Tanggal Lahir</label>
                  <input type="date" name="tgl_lahir_du" class="form-control" id="tgl_lahir_du" >
                </div>
                <div class="form-group">
                  <label for="place">Tempat Lahir</label>
                  <input type="text" name="tpt_lahir_du" class="form-control" id="tpt_lahir_du" placeholder="Input Birth Place" >
                </div>
                <div class="form-group">
                  <label for="religion">Agama</label>
                <select id="agama_du" name="agama_du" class="form-control" ="">
                  <option value="">Pilih Agama</option>
                  <option value="kristen">Kristen</option>
                  <option value="islam">Islam</option>
                  <option value="hindu">Hindu</option>
                  <option value="buddha">Buddha</option>
                  <option value="konghuchu">Konghuchu</option>

                </select>                                     
                </div>
                <div class="form-group">
                  <label for="address">Alamat Rumah</label>
                  <input type="text" name="alamat_du" class="form-control" id="alamat_du" placeholder="Input Home Address" >
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="number" name="no_telp_du" class="form-control" id="no_telp_du" placeholder="Input Phone Number" value="<?php echo $du_pagi->no_telp; ?>">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor HP</label>
                  <input type="number" name="no_telpm_du" class="form-control" id="no_telpm_du" placeholder="Input Mobile Phone Number" >
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email_du" class="form-control" id="email_du" placeholder="Input Email" value="<?php echo $du_pagi->email; ?>">
                </div>
                <div class="form-group">
                  <label for="preschool">Asal Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah"class="form-control" ="">
                  <option value="<?php echo $du_pagi->id_sekolah2; ?>"><?php echo $du_pagi->nama_sekolah; ?></option>
                  <?php 

                  foreach($getPreschool as $row)
                  { 
                    echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
                  }
                  ?>

                </select>   
                </div>
                <div class="form-group">
                  <label for="major">Jurusan Asal Sekolah</label>
                <select id="jurusan" name="jurusan" class="form-control" ="">
                  <option value="<?php echo $du_pagi->jurusan; ?>"><?php echo $du_pagi->jurusan; ?></option>
                  <option value="ipa">IPA</option>
                  <option value="ips">IPS</option>
                  <option value="tkj">TKJ</option>
                  <option value="rpl">RPL</option>
                </select>                                     
                </div>
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="number" name="nik_du" class="form-control" id="nik_du" placeholder="Input NIK" >
                </div>
                <div class="form-group">
                  <label for="mother">Nama Ibu</label>
                  <input type="text" name="ibu_kandung_du" class="form-control" id="ibu_kandung_du" placeholder="Input your mother Name" >
                </div>
                <div class="form-group">
                  <label for="prodi">Program Studi</label>
                  <select id="id_prodi" class="form-control" name="id_prodi" ="" onchange="return get_concentrate(this.value)">
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
                  <label for="concentrate">Konsentrasi</label>
                  <select id="concentrate" name="concentrate" class="form-control" ="">
                  <option value="">Select Program Study First</option>
                  </select>                                     
                </div>
                <div class="form-group">
                  <label for="intake">Intake</label>
                  <select id="intake" name="intake" class="form-control" ="">
                    <option value="">Pilih Intake</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                  </select>                                                                          
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
<script type="text/javascript">
            function get_kelas(p) {
                var kelas = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>pendaftaran/get_kelas/'+kelas,
                    data: 'kelas='+kelas,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#form_kelas").html(msg);

                    }
                });
            }
        </script>

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