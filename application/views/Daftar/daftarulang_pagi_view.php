<div class="row"> 
  <?php echo $this->session->flashdata('message');?>
  <?php echo form_open('daftar_ulang/save_mahasiswa_pagi'); ?>
  <div class="col-md-12">

  <div class="box box-primary">

    <h3 style="text-align:center">Daftar Ulang</h3>
  <div class="box-body">
    <div class="col-md-6">
      <?php echo $this->session->flashdata('message');?>
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="no">No. Registrasi</label>
                  <input type="text" name="id_du" class="form-control" id="id_du" placeholder=""  .input-sm value="<?php echo $du_pagi->id_du; ?>" readonly>
                   <input type="hidden" name="id_mahasiswa" class="form-control" id="id_mahasiswa" placeholder=""  value="<?php echo $kodeunik_mhs; ?>" readonly>
                   <input type="hidden" name="id_mahasiswa_ori" class="form-control" id="id_mahasiswa_ori" placeholder="" value="<?php echo $kodeunik_mhs; ?>" readonly>
                </div>
             
                
                 <?php if ($du_pagi->id_pt != NULL OR $du_pagi->id_pt != '' OR $du_pagi->id_waktu == 2) { ?>
                    <input type="hidden" name="id_hasil_tes" class="form-control" id="id_hasil_tes" placeholder=""  .input-sm value="" readonly>
                 <?php } else { ?>

                  <input type="hidden" name="id_hasil_tes" class="form-control" id="id_hasil_tes" placeholder=""  .input-sm value="<?php echo $kodeunik; ?>" readonly>

                  <?php } ?>

                  <input type="hidden" name="id_waktu" id="id_waktu" value="<?php echo $du_pagi->id_waktu; ?>">
                    
                
                <div class="form-group">
                  <label for="email">Nama Lengkap</label>
                  <input type="text" name="nama_mahasiswa" class="form-control" id="nama_mahasiswa" placeholder="Input Full Name" value="<?php echo $du_pagi->nama_pendaftar; ?>" required="" readonly>
                </div>
                <div class="form-group">
                  <label for="gender">L / P</label>
                   <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin" placeholder="Input Full Name" value="<?php echo $du_pagi->jk_pendaftar; ?>" required="" readonly>

          </select>                                     
                  
                </div>
                <div class="form-group">
                  <label for="email">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" required="">
                </div>
                <div class="form-group">
                  <label for="place">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" placeholder="Masukan tempat lahir" required="">
                </div>
                <div class="form-group">
                  <label for="religion">Agama</label>
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
                  <label for="address">Alamat Rumah</label>
                  <input type="text" name="alamat_mhs" class="form-control" id="alamat_mhs" placeholder="Input Home Address" value="<?php echo $du_pagi->alamat; ?>" required="">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="number" name="no_telepon" class="form-control" id="no_telepon" placeholder="Input Phone Number" value="<?php echo $du_pagi->no_telp; ?>" required="">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor HP</label>
                  <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="Masukkan nomor HP" required="">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Input Email" value="<?php echo $du_pagi->email; ?>" required="" readonly>
                </div>
                
              </div>
              <div class="col-md-6">

                <div class="form-group">
                  <label for="email">Kode Pos</label>
                  <input type="text" name="kode_pos" class="form-control" id="kode_pos" placeholder="Masukan Kode Pos"  value="">
                </div>
                 <input type="hidden" name="id_jalur_pendaftaran" id="id_jalur_pendaftaran" value="6">
                 <input type="hidden" name="id_pembiayaan_awal" id="id_pembiayaan_awal" value="1">
                <?php if ($du_pagi->id_pt != NULL OR $du_pagi->id_pt != '') { ?>

                  <input type="hidden" name="id_status" id="id_status" value="19">
                  <input type="hidden" name="id_pt" id="id_pt" value="1">
                <div class="form-group">
                  <label for="preschool">Asal Universitas</label>
                  <select id="asal_pt" name="asal_pt"class="form-control" required="" readonly>
                  <option value="<?php echo $du_pagi->id_pt; ?>"><?php echo $du_pagi->nama_pt; ?>
                  </select>
                  <input type="hidden" name="id_sekolah" id="id_sekolah" value="">   
                </div>
                 <div class="form-group">
                    <label>Asal Program Studi</label>
                        
                            <input type="text" name="asal_prodi" class="form-control " id="asal_prodi" placeholder="" required="" value="<?php echo $du_pagi->jurusan; ?>">
                            <input type="hidden" name="jurusan" id="jurusan" value="">
                        
                    </div>

                <div class="form-group">
                        <label>Jumlah Sks di akui</label>
                        
                            <input type="text" name="jml_sks_diakui" class="form-control " id="jml_sks_diakui" placeholder="" value="" >
                        
                    </div>
                     <div class="form-group">
                        <label>Jenis Pendaftaran</label>         
                            <select name="id_jenis_pendaftaran" id="id_jenis_pendaftaran" class="form-control" required="">
            <option value=""> Pilih Jenis Pendaftaran </option>          
            <option value="2">Pindahan</option>
             <option value="3">Alih Jenjang</option>
             <option value="4">Lintas Jalur</option>
             <option value="5">Rekognisi Pembelajaran Lampau</option>
             </select>
                       
                    </div>
                <?php } else { ?>
                  <input type="hidden" name="id_jenis_pendaftaran" id="id_jenis_pendaftaran" value="1">
                  <input type="hidden" name="asal_pt" id="asal_pt" value="">
                  <input type="hidden" name="asal_prodi" id="asal_prodi" value="">
                  <?php if ($du_pagi->id_waktu == 2) { ?>
                    <input type="hidden" name="id_status" id="id_status" value="19">
                  <?php } else { ?>
                    <input type="hidden" name="id_status" id="id_status" value="12">
                  <?php } ?>
                  
                  <div class="form-group">
                  <label for="preschool">Asal Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah"class="form-control" required="" readonly>
                  <option value="<?php echo $du_pagi->id_sekolah; ?>"><?php echo $du_pagi->nama_sekolah; ?>
                  <input type="hidden" name="id_pt" id="id_pt" value="1">
                </select>   
                </div>

                <div class="form-group">
                  <label for="major">Jurusan Asal</label>
                <select id="jurusan" name="jurusan" class="form-control" readonly>
                  <option value="<?php echo $du_pagi->jurusan; ?>"><?php echo $du_pagi->jurusan; ?></option>
                  
                </select>                                     
                </div>
                <input type="hidden" name="jml_sks_diakui" class="form-control " id="jml_sks_diakui" placeholder="" value="" >
                <?php } ?>
                  
                   
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="number" name="nik" class="form-control" id="nik" placeholder="Masukkan NIK" required="">
                </div>
                <div class="form-group">
                  <label for="mother">Nama Ibu</label>
                  <input type="text" name="nama_ibu" class="form-control" id="nama_ibu" placeholder="Masukkan nama ibu kandung" required="">
                </div>
                <div class="form-group">
                  <label for="prodi">Program Studi</label>
                  <select id="id_prodi" class="form-control" required="" name="id_prodi" ="" onchange="return get_concentrate(this.value), get_dosen_pa(this.value)" onclick="return get_prodi_periode(this.value)">
                    <option value="">Pilih Prodi</option>   
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
                  <select id="concentrate" name="concentrate" class="form-control" required="">
                  <option value=""> Pilih Prodi Dahulu </option>
                  </select> 
                   <input type="hidden" name="dosen_pa" id="dosen_pa" value="">                                  
                </div> 
                <div class="form-group">
                        <label >Periode Pendaftaran</label>
                       
                            <select name="id_periode" id="id_periode" class="form-control" required="">
                        <option value=""> Pilih Prodi Dahulu </option>
                       
                      </select>
                        
                    </div>
                 <div class="form-group">
                  <label for="mother">NIM</label>
                  <input type="text" name="nim" class="form-control" id="nim" placeholder="Masukan NIM" value="" required="" onkeyup="checkAvailability()"><span id="user-availability-status"></span>  
                </div>   
                <input type="hidden" name="id_jt" class="form-control" value="">
                <input type="hidden" name="id_transportasi" value="">
                <input type="hidden" name="nama_ayah" class="form-control" value="">
                 <input type="hidden" name="nama_ayah" class="form-control" value="">
                 <input type="hidden" name="nik_ayah" class="form-control" value="">
                 <input type="hidden" name="tanggal_lahir_ayah" class="form-control" value="">
                 <input type="hidden" name="pendidikan_ayah" class="form-control" value="">
                 <input type="hidden" name="pekerjaan_ayah" class="form-control" value="">
                 <input type="hidden" name="penghasilan_ayah" class="form-control" value="">

                  <input type="hidden" name="nik_ibu" class="form-control" value="">
                 <input type="hidden" name="tanggal_lahir_ibu" class="form-control" value="">
                 <input type="hidden" name="pendidikan_ibu" class="form-control" value="">
                 <input type="hidden" name="pekerjaan_ibu" class="form-control" value="">
                 <input type="hidden" name="penghasilan_ibu" class="form-control" value="">

                 <input type="hidden" name="nama_wali" class="form-control" value="">
                 <input type="hidden" name="tanggal_lahir_wali" class="form-control" value="">
                 <input type="hidden" name="pendidikan_wali" class="form-control" value="">
                 <input type="hidden" name="pekerjaan_wali" class="form-control" value="">
                 <input type="hidden" name="penghasilan_wali" class="form-control" value="">

                 <input type="hidden" name="jalan" class="form-control" value="">
                 <input type="hidden" name="dusun" class="form-control" value="">
                 <input type="hidden" name="kelurahan" class="form-control" value="">
                 <input type="hidden" name="kecamatan" class="form-control" value="">
                 <input type="hidden" name="rt" class="form-control" value="">
                 <input type="hidden" name="rw" class="form-control" value="">

                 <input type="hidden" name="nisn" class="form-control" value="">
                 <input type="hidden" name="npwp" class="form-control" value="">
                 <input type="hidden" name="kps" class="form-control" value="">
                 <input type="hidden" name="no_kps" class="form-control" value="">
                 <input type="hidden" name="kewarganegaraan" class="form-control" value="">

                 <input type="hidden" name="jenis_tinggal" class="form-control" value="">
                 <input type="hidden" name="alat_transportasi" class="form-control" value="">

                 <input type="hidden" name="foto_mhs" class="form-control" value="">
                 <input type="hidden" name="tgl_du" id="tgl_du" value="<?php echo  date('Y-m-d') ?>" >

                <button type="submit" id="myBtn" class="btn btn-info pull-right">Daftar</button>
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
                var id_prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>daftar_ulang/get_concentrate/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#concentrate").html(msg);

                    }
                });
            }
            function get_dosen_pa(p) {
                var id_prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>daftar_ulang/get_dosen_pa/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        document.getElementById("dosen_pa").value = msg;

                    }
                });
            }
            function checkAvailability() {
                $.ajax({
                    url: '<?php echo base_url(); ?>daftar_ulang/cek_nim/',
                    data: 'nim='+$("#nim").val(),
                    type: 'POST',
                    dataType: 'html',
                    success:function(data){
                    $("#user-availability-status").html(data);
                    },
                    error:function (){}
                });
            }
            function get_prodi_periode(p) {
                var id_prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>kurikulum/get_prodi_periode/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_periode").html(msg);
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
            // function checkAvailability() {
            // jQuery.ajax({
            // url: '<?php echo base_url(); ?>daftar_ulang/cek_nim/',
            // data:'nim='+$("#nim").val(),
            // type: "POST",
            // success:function(data){
            // $("#user-availability-status").html(data);
            // },
            // error:function (){}
            // });
            // }
        </script>