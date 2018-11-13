        <?php echo form_open('mahasiswa/save_mahasiswa'); ?>

        <div class="box box-info">
            <div class="box-header with-border">
              TAMBAH MAHASISWA
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
        <tr>
                  <input type="hidden" name="id_mahasiswa" class="form-control" id="id_mahasiswa" placeholder="" required .input-sm value="<?php echo $kodeunik_mhs ?>" >

            <td width="15%" class="left_column">Nama <font color="#FF0000">*</font></td>
            <td>:
                <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="text-input" size="10" style="width:70%"  required="">    </td>
      
            <td class="left_column">Waktu <font color="#FF0000">*</font></td>
            <td>:  <select name="id_waktu" id="id_waktu" required="">
                    <option value=""> Pilih Waktu </option>
                    <option value="1">Pagi</option>
                    <option value="2">Sore</option>
                    </select></td>
                                  
            </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=>Tempat Lahir <font color="#FF0000">*</font></td>
            <td width="35%">: <input type="text" name="tempat_lahir" id="tempat_lahir" class="text-input" size="10" style="width:70%" required="">          </td>
            <td class="left_column" width="15%">Tanggal Lahir <font color="#FF0000">*</font></td>
            <td>:
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="text-input" size="10" style="width:70%"  required="">                           </td>
        </tr>
        <tr>
            <td class="left_column">Jenis Kelamin <font color="#FF0000">*</font></td>
            <td>:  &nbsp;&nbsp;<label class="radio-inline"><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L" checked=""> Laki-laki</label> &nbsp; 
                <label class="radio-inline"><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P"> Perempuan</label> &nbsp; </td>
            <td class="left_column">Agama <font color="#FF0000">*</font></td>
            <td>:  <select name="agama" id="agama" required="">
            <option value="">Pilih Agama</option>
            
                              <option value="1">Islam</option>
                              <option value="2">Katholik</option>
                              <option value="3">Kristen</option>
                              <option value="4">Hindu</option>
                              <option value="5">Budha</option>
                              <option value="6">Konghucu</option>
             </select></td>
            </tr>
        </table>
            </div>
            <!-- /.box-body -->
          </div>


          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_0" data-toggle="tab">Profil</a></li>
              <li><a href="#tab_1" data-toggle="tab">Alamat</a></li>
              <li><a href="#tab_2" data-toggle="tab">Orang Tua</a></li>
              <li><a href="#tab_3" data-toggle="tab">Wali</a></li>
              <!--<li><a href="#tab_4" data-toggle="tab">Kebutuhan Khusus</a></li> -->
          
              <li class="pull-right"><button class="btn btn-sm btn-primary btn-flat" id="myBtn"><i class="fa fa-save"></i> Save</button> </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_0">
                <table width="90%" class="table">
                <tr>
                    <td class="left_column" width="15%">NIM <font color="#FF0000">*</font></td>
                    <td colspan="3">:  <input type="text" name="nim" id="nim" class="text-input" maxlength="16" size="50" style="width:40%" onkeyup="checkAvailability()" required="">     <span id="user-availability-status"></span>  
                        <input type="hidden" name="jurusan" id="jurusan" class="text-input" maxlength="16" size="50" value="">       
                        <input type="hidden" name="alamat_mhs" id="alamat_mhs" class="text-input" maxlength="16" size="50" value="">       

                    </td>
                   
                </tr>
                <tr>
                    <td class="left_column" width="15%" >Nama Prodi <font color="#FF0000">*</font></td>
                    <td>: <select name="id_prodi" id="id_prodi" onchange="return get_concentrate(this.value);" onblur="return get_prodi_periode(this.value);" required="">
                            <option value="">Pilih Prodi</option>  
                             <?php 

                  foreach($getProdi as $row)
                  { 
                    echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                  }
                  ?>
                             </select></td>
                </tr>
                <tr>
                    <td class="left_column">Nama Konsentrasi <font color="#FF0000">*</font></td>
                    <td>:
                        <select name="concentrate" id="concentrate" required="" >
                            <option value="">Pilih Prodi Dahulu</option>
                            
                             </select></td>
                </tr>
                <tr>
                    <td class="left_column"> Asal </td>
                    <td>:
                        <select name="asal" id="asal" onchange="return get_asal(this.value);">
                            <option value="">Pilih Asal</option>
                            <option value="1"> Sekolah </option>
                            <option value="2"> Universitas </option>
                            
                             </select></td>
                </tr>               
                <tr style="display: none" id="sekolah">
                    <td class="left_column"> Asal Sekolah </td>
                    <td>:
                        <select name="id_sekolah" id="id_sekolah" >
                            <option value="">Pilih Asal Sekolah</option>
                            <?php 

                  foreach($getPreschool as $row)
                  { 
                    echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
                  }
                  ?>        
                             </select></td>
                </tr>
                <tr style="display: none" id="asal_jurusan">
                    <td class="left_column"> Asal Jurusan</td>
                    <td>:
                        <select name="jurusan" id="jurusan"  >
                            <option value="">Pilih Jurusan </option>
                            <option value="IPA"> IPA </option>
                            <option value="IPS"> IPS </option>
                            <option value="Bahasa"> Bahasa </option>
                            <option value="Lainnya"> Lainnya </option>
                            
                             </select></td>
                </tr>
                
                <tr style="display: none" id="universitas">
                    <td class="left_column"> Asal Universitas</td>
                    <td>:
                        <select name="asal_pt" id="asal_pt" >
                            <option value="">Pilih Universitas</option>
                            <?php 

                  foreach($getUniversitas as $row)
                  { 
                    echo '<option value="'.$row->id_pt.'">'.$row->nama_pt.'</option>';
                  }
                  ?>
                            
                             </select></td>
                </tr>
                <tr style="display: none" id="asal_prodii">
                    <td class="left_column" width="15%"> Asal Prodi <font color="#FF0000">*</font></td>
                    <td colspan="4">:  <input type="text" name="asal_prodi" id="asal_prodi" class="validate[required] text-input" size="50" style="width:20%" value="">                            
                    </td>
                </tr>
                <tr style="display: none" id="sks_diakui">
                    <td class="left_column" width="15%">Jumlah SKS Diakui <font color="#FF0000">*</font></td>
                    <td colspan="4">:  <input type="number" name="jml_sks_diakui" id="jml_sks_diakui" class="validate[required] text-input" size="50" style="width:20%" value="">                            
                    </td>
                </tr>
                </div>
                <tr>
                    <td class="left_column" width="15%">Tanggal Pendaftaran <font color="#FF0000">*</font></td>
                    <td colspan="4">:  <input type="date" name="tgl_du" id="tgl_du" class="validate[required] text-input" maxlength="16" size="50" style="width:20%" required="">                            
                    </td>
                </tr>
                <tr>
                    <td class="left_column">Periode Pendaftaran <font color="#FF0000">*</font></td>
                    <td>:
                        <select name="id_periode" id="id_periode" required="">
                            <option value=""> Pilih Prodi Dahulu </option>
                            
                             </select></td>
                </tr>
               <tr>
                    <td class="left_column">Jenis Pendaftaran <font color="#FF0000">*</font></td>
                    <td>:
                        <select name="id_jenis_pendaftaran" id="id_jenis_pendaftaran" required="">
                            <option value=""> Pilih Jenis Pendaftaran </option>
                            <option value="1">Peserta Didik Baru</option>
                            <option value="2">Pindahan</option>
                            <option value="3">Alih Jenjang</option>
                            <option value="4">Lintas Jalur</option>
                            <option value="5">Rekognisi Pembelajaran Lampau</option>
                            
                             </select></td>
                </tr>
                <tr>
                    <td class="left_column" width="15%"> Semester Aktif <font color="#FF0000">*</font></td>
                    <td colspan="4">:  <select name="semester_aktif" id="semester_aktif" required="" onchange="return get_grade(this.value)"> 
                            <option value=""> Pilih Semester Aktif </option>
                            <option value="1"> 1 </option>
                            <option value="2"> 2 </option>
                            <option value="3"> 3 </option>
                            <option value="4"> 4 </option>
                            <option value="5"> 5 </option>
                            <option value="6"> 6 </option>
                            <option value="7"> 7 </option>
                            <option value="8"> 8 </option>
                             </select>                            
                    </td>
                </tr>
                <tr>
                    <td class="left_column" width="15%"> Grade <font color="#FF0000">*</font></td>
                    <td colspan="4">:  

                <select name="id_grade" id="id_grade" required="">
                            <option value="">Pilih Semester Aktif Dahulu</option>  
                            
                </select>  

                    </td>
                </tr>

               
            </table>

              </div>
              <div class="tab-pane" id="tab_1">
                <table width="90%" class="table">
                <tr>
                    <td class="left_column" width="15%">NIK <font color="#FF0000">*</font></td>
                    <td colspan="4">:  <input type="text" name="nik" id="nik" class="validate[required] text-input" maxlength="16" size="50" style="width:40%" required>                            <font color="grey"><em> ( Nomor NIK tanpa tanda baca ) </em></font>
                    </td>
                </tr>
        <tr>
                    <td class="left_column" width="15%">NISN</td>
                    <td colspan="5">: <input type="text" name="nisn" id="nisn" class="text-input" maxlength="10" size="10" style="width:70%"></td>
                </tr>
        <tr>
                    <td class="left_column" width="15%">NPWP</td>
                    <td colspan="5">: <input type="text" name="npwp" id="npwp" class="text-input" maxlength="15" size="15" style="width:70%"></td>
                </tr>
                <tr>
                    <td class="left_column">Kewarganegaraan <font color="#FF0000">*</font></td>
                    <td colspan="5">: 
                    <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="validate[required] text-input" style="width:70%" required="">          
                    </td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">Jalan</td>
                    <td colspan="5">: <input type="text" name="jalan" id="jalan" class="text-input" maxlength="80" size="80" style="width:70%"></td>
                </tr>
                <tr>
                    <td class="left_column">Dusun</td>
                    <td>: <input type="text" name="dusun" id="dusun" class="text-input" maxlength="60" size="60" style="width:80%"></td>
                    <td class="left_column">RT</td>
                    <td >: <input type="text" name="rt" id="rt" class="text-input" maxlength="2" size="2" style="width:50%" onkeydown="return onlyNumber(event,this,false,false)">  </td>
                    <td class="left_column">RW</td>
                    <td>: <input type="text" name="rw" id="rw" class="text-input" maxlength="2" size="2" style="width:50%" onkeydown="return onlyNumber(event,this,false,false)"></td>
                </tr>
                <tr>
                    <td class="left_column">Kelurahan <font color="#FF0000">*</font></td>
                    <td>: <input type="text" name="kelurahan" id="kelurahan" class="validate[required] text-input" maxlength="60" size="60" style="width:80%" required=""></td>
                    <td class="left_column">Kodepos</td>
                    <td colspan="4">: <input type="text" name="kode_pos" id="kode_pos" class="text-input" maxlength="5" size="5" style="width:30%" onkeydown="return onlyNumber(event,this,false,false)"></td>
                </tr>
                <tr>
                    <td class="left_column">Kecamatan <font color="#FF0000">*</font></td>
                    <td colspan="5">: 
                    <input type="text" name="kecamatan" id="kecamatan" class="validate[required] text-input" style="width:70%" required="">
                    </td>
                </tr>
                <tr>
                    <td class="left_column">Jenis Tinggal</td>
                    <td colspan="5">: <select name="id_jt" id="id_jt">
                    <option value="">-- Pilih Jenis Tinggal --</option>
                    <option value="1">Bersama orang tua</option>
                    <option value="2">Wali</option>
                    <option value="3">Kost</option>
                    <option value="4">Asrama</option>
                    <option value="5">Panti asuhan</option>
                    <option value="6">Lainnya</option>
                    </select></td>
                </tr>
                 <tr>
                    <td class="left_column">Alat Transportasi</td>
                    <td colspan="5">: <select name="id_transportasi" id="id_transportasi">
                    <option value="">-- Pilih Alat Transportasi --</option>
                    <option value="1">Jalan kaki</option>
                    <option value="2">Angkutan umum/bus/pete-pete</option>
                    <option value="3">Mobil/bus antar jemput</option>
                    <option value="4">Kereta api</option>
                    <option value="5">Ojek</option>
                    <option value="6">Andong/bendi/sado/dokar/delman/becak</option>
                    <option value="7">Perahu penyeberangan/rakit/getek</option>
                    <option value="8">Kuda</option>
                    <option value="9">Sepeda</option>
                    <option value="10">Sepeda motor</option>
                    <option value="11">Mobil pribadi</option>
                    <option value="12">Lainnya</option>
                </select></td>
                </tr>
                <tr>
                    <td class="left_column">Telepon</td>
                    <td>: <input type="text" name="no_telepon" id="no_telepon" class="text-input" maxlength="20" size="20" style="width:30%"></td>
                    <td class="left_column">HP</td>
                    <td colspan="4">: <input type="text" name="no_hp" id="no_hp" class="text-input" maxlength="20" size="20" style="width:30%"></td>
                </tr>
                <tr>
                    <td class="left_column">Email <font color="#FF0000">*</font></td>
                    <td colspan="5">: <input type="text" name="email" id="email" class="text-input" maxlength="60" size="60" style="width:30%" required=""></td>
                </tr>
                <tr>
                    <td class="left_column">Penerima KPS ? <font color="#FF0000">*</font></td>
                    <td>: 
                    <label class="radio-inline"><input type="radio" name="kps" id="kps" value="Tidak" checked="" onclick="disableTxt()"> Tidak</label> &nbsp; 
                <label class="radio-inline"><input type="radio" name="kps" id="kps" value="Ya" onclick="undisableTxt()"> Ya</label> &nbsp; 
                </td>
                    <td class="left_column">No KPS</td>
                    <td colspan = '4'>: <input type="text" name="no_kps" id="myText" class="text-input" maxlength="80" size="80" style="width:50%" value=""></td>
                </tr>




          </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <table width="90%" class="table">
                <tr>
                    <td colspan="2"><strong>Ayah</strong></td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">NIK</td>
                    <td>:  <input type="text" name="nik_ayah" id="nik_ayah" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)">                            <font color="grey"><em> ( Nomor KTP tanpa tanda baca ) </em></font>
                    </td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">Nama</td>
                    <td>: <input type="text" name="nama_ayah" id="nama_ayah" class="text-input" maxlength="100" size="100" style="width:50%"></td>
                </tr>
                <tr>
                    <td class="left_column">Tanggal Lahir</td>
                    <td>:
                        <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah" class="text-input" maxlength="50" size="50" style="width:20%">                                                                    </td>
                </tr>
                <tr>
                    <td class="left_column">Pendidikan</td>
                    <td>: <select name="pendidikan_ayah" id="pendidikan_ayah">
                        <option value="">-- Pilih Jenjang --</option>
                        <option value="Tidak sekolah">Tidak sekolah</option>
                        <option value="PAUD">PAUD</option>
                        <option value="TK / sederajat">TK / sederajat</option>
                        <option value="Putus SD">Putus SD</option>
                        <option value="SD / sederajat">SD / sederajat</option>
                        <option value="SMP / sederajat">SMP / sederajat</option>
                        <option value="SMA / sederajat">SMA / sederajat</option>
                        <option value="Paket A">Paket A</option>
                        <option value="Paket B">Paket B</option>
                        <option value="Paket C">Paket C</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="Profesi">Profesi</option>
                        <option value="Sp-1">Sp-1</option>
                        <option value="S2">S2</option>
                        <option value="S2 Terapan">S2 Terapan</option>
                        <option value="Sp-2">Sp-2</option>
                        <option value="S3">S3</option>
                        <option value="S3 Terapan">S3 Terapan</option>
                        <option value="Non formal">Non formal</option>
                        <option value="Informal">Informal</option>
                        <option value="Lainnya">Lainnya</option>
                        </select></td>
                </tr>
                <tr>
                    <td class="left_column">Pekerjaan</td>
                    <td>: <select name="pekerjaan_ayah" id="pekerjaan_ayah">
                        <option value="">-- Pilih Pekerjaan --</option>
                        <option value="Tidak bekerja">Tidak bekerja</option>
                        <option value="Nelayan">Nelayan</option>
                        <option value="Petani">Petani</option>
                        <option value="Peternak">Peternak</option>
                        <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                        <option value="Karyawan Swasta">Karyawan Swasta</option>
                        <option value="Pedagang Kecil">Pedagang Kecil</option>
                        <option value="Pedagang Besar">Pedagang Besar</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                        <option value="Wirausaha">Wirausaha</option>
                        <option value="Buruh">Buruh</option>
                        <option value="Pensiunan">Pensiunan</option>
                        <option value="Sudah Meninggal">Sudah Meninggal</option>
                        <option value="Lainnya">Lainnya</option>
                        </select></td>
                </tr>
                <tr>
                    <td class="left_column">Penghasilan</td>
                    <td>: <select name="penghasilan_ayah" id="penghasilan_ayah">
                        <option value="">-- Pilih Penghasilan --</option>
                        <option value="Kurang dari Rp. 500,000">Kurang dari Rp. 500,000</option>
                        <option value="Rp. 500,000 - Rp. 999,999">Rp. 500,000 - Rp. 999,999</option>
                        <option value="Rp. 1,000,000 - Rp. 1,999,999">Rp. 1,000,000 - Rp. 1,999,999</option>
                        <option value="Rp. 2,000,000 - Rp. 4,999,999">Rp. 2,000,000 - Rp. 4,999,999</option>
                        <option value="Rp. 5,000,000 - Rp. 20,000,000">Rp. 5,000,000 - Rp. 20,000,000</option>
                        <option value="Lebih dari Rp. 20,000,000">Lebih dari Rp. 20,000,000</option>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Ibu</strong></td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">NIK</td>
                    <td>:  <input type="text" name="nik_ibu" id="nik_ibu" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)">                            <font color="grey"><em> ( Nomor KTP tanpa tanda baca ) </em></font>
                    </td>
                </tr>
                
                <tr>
                    <td class="left_column">Nama <font color="#FF0000">*</font></td>
                    <td>:
            <input type="text" name="nama_ibu" id="nama_ibu" class="text-input" size="10" style="width:70%" required=""></td>
                </tr>
                <tr>
                    <td class="left_column">Tanggal Lahir</td>
                    <td>:
                        <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu" class="text-input" maxlength="60" size="60" style="width:20%">                    </td>
                </tr>
                <tr>
                    <td class="left_column">Pendidikan</td>
                    <td>: <select name="pendidikan_ibu" id="pendidikan_ibu">
                        <option value="">-- Pilih Jenjang --</option>
                        <option value="Tidak sekolah">Tidak sekolah</option>
                        <option value="PAUD">PAUD</option>
                        <option value="TK / sederajat">TK / sederajat</option>
                        <option value="Putus SD">Putus SD</option>
                        <option value="SD / sederajat">SD / sederajat</option>
                        <option value="SMP / sederajat">SMP / sederajat</option>
                        <option value="SMA / sederajat">SMA / sederajat</option>
                        <option value="Paket A">Paket A</option>
                        <option value="Paket B">Paket B</option>
                        <option value="Paket C">Paket C</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="Profesi">Profesi</option>
                        <option value="Sp-1">Sp-1</option>
                        <option value="S2">S2</option>
                        <option value="S2 Terapan">S2 Terapan</option>
                        <option value="Sp-2">Sp-2</option>
                        <option value="S3">S3</option>
                        <option value="S3 Terapan">S3 Terapan</option>
                        <option value="Non formal">Non formal</option>
                        <option value="Informal">Informal</option>
                        <option value="Lainnya">Lainnya</option>
                        </select></td>
                </tr>
                <tr>
                    <td class="left_column">Pekerjaan</td>
                    <td>: <select name="pekerjaan_ibu" id="pekerjaan_ibu">
                        <option value="">-- Pilih Pekerjaan --</option>
                        <option value="Tidak bekerja">Tidak bekerja</option>
                        <option value="Nelayan">Nelayan</option>
                        <option value="Petani">Petani</option>
                        <option value="Peternak">Peternak</option>
                        <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                        <option value="Karyawan Swasta">Karyawan Swasta</option>
                        <option value="Pedagang Kecil">Pedagang Kecil</option>
                        <option value="Pedagang Besar">Pedagang Besar</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                        <option value="Wirausaha">Wirausaha</option>
                        <option value="Buruh">Buruh</option>
                        <option value="Pensiunan">Pensiunan</option>
                        <option value="Sudah Meninggal">Sudah Meninggal</option>
                        <option value="Lainnya">Lainnya</option>
                        </select></td>
                </tr>
                <tr>
                    <td class="left_column">Penghasilan</td>
                    <td>: <select name="penghasilan_ibu" id="penghasilan_ibu">
                    <option value="">-- Pilih Penghasilan --</option>
                     <option value="Kurang dari Rp. 500,000">Kurang dari Rp. 500,000</option>
                        <option value="Rp. 500,000 - Rp. 999,999">Rp. 500,000 - Rp. 999,999</option>
                        <option value="Rp. 1,000,000 - Rp. 1,999,999">Rp. 1,000,000 - Rp. 1,999,999</option>
                        <option value="Rp. 2,000,000 - Rp. 4,999,999">Rp. 2,000,000 - Rp. 4,999,999</option>
                        <option value="Rp. 5,000,000 - Rp. 20,000,000">Rp. 5,000,000 - Rp. 20,000,000</option>
                        <option value="Lebih dari Rp. 20,000,000">Lebih dari Rp. 20,000,000</option>
                        </select></td>
                </tr>
            </table>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <table width="90%" class="table">
                <tr>
                    <td colspan="2"><strong>Wali</strong></td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">Nama</td>
                    <td>: <input type="text" name="nama_wali" id="nama_wali" class="text-input" maxlength="100" size="100" style="width:50%"></td>
                </tr>
                <tr>
                    <td class="left_column">Tanggal Lahir</td>
                    <td>:
                        <input type="date" name="tanggal_lahir_wali" id="tanggal_lahir_wali" class="text-input" maxlength="50" size="50" style="width:20%">                                                                    </td>
                </tr>
                <tr>
                    <td class="left_column">Pendidikan</td>
                    <td>: <select name="pendidikan_wali" id="pendidikan_wali">
                        <option value="">-- Pilih Jenjang --</option>
                        <option value="Tidak sekolah">Tidak sekolah</option>
                        <option value="PAUD">PAUD</option>
                        <option value="TK / sederajat">TK / sederajat</option>
                        <option value="Putus SD">Putus SD</option>
                        <option value="SD / sederajat">SD / sederajat</option>
                        <option value="SMP / sederajat">SMP / sederajat</option>
                        <option value="SMA / sederajat">SMA / sederajat</option>
                        <option value="Paket A">Paket A</option>
                        <option value="Paket B">Paket B</option>
                        <option value="Paket C">Paket C</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="Profesi">Profesi</option>
                        <option value="Sp-1">Sp-1</option>
                        <option value="S2">S2</option>
                        <option value="S2 Terapan">S2 Terapan</option>
                        <option value="Sp-2">Sp-2</option>
                        <option value="S3">S3</option>
                        <option value="S3 Terapan">S3 Terapan</option>
                        <option value="Non formal">Non formal</option>
                        <option value="Informal">Informal</option>
                        <option value="Lainnya">Lainnya</option>
                        </select></td>
                </tr>
                <tr>
                    <td class="left_column">Pekerjaan</td>
                    <td>: <select name="pekerjaan_wali" id="pekerjaan_wali">
                        <option value="">-- Pilih Pekerjaan --</option>
                        <option value="Tidak bekerja">Tidak bekerja</option>
                        <option value="Nelayan">Nelayan</option>
                        <option value="Petani">Petani</option>
                        <option value="Peternak">Peternak</option>
                        <option value="PNS/TNI/Polri">PNS/TNI/Polri</option>
                        <option value="Karyawan Swasta">Karyawan Swasta</option>
                        <option value="Pedagang Kecil">Pedagang Kecil</option>
                        <option value="Pedagang Besar">Pedagang Besar</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                        <option value="Wirausaha">Wirausaha</option>
                        <option value="Buruh">Buruh</option>
                        <option value="Pensiunan">Pensiunan</option>
                        <option value="Sudah Meninggal">Sudah Meninggal</option>
                        <option value="Lainnya">Lainnya</option>
                        </select></td>
                </tr>
                <tr>
                    <td class="left_column">Penghasilan</td>
                    <td>: <select name="penghasilan_wali" id="penghasilan_wali">
                        <option value="">-- Pilih Penghasilan --</option>
                        <option value="Kurang dari Rp. 500,000">Kurang dari Rp. 500,000</option>
                        <option value="Rp. 500,000 - Rp. 999,999">Rp. 500,000 - Rp. 999,999</option>
                        <option value="Rp. 1,000,000 - Rp. 1,999,999">Rp. 1,000,000 - Rp. 1,999,999</option>
                        <option value="Rp. 2,000,000 - Rp. 4,999,999">Rp. 2,000,000 - Rp. 4,999,999</option>
                        <option value="Rp. 5,000,000 - Rp. 20,000,000">Rp. 5,000,000 - Rp. 20,000,000</option>
                        <option value="Lebih dari Rp. 20,000,000">Lebih dari Rp. 20,000,000</option>
                        </select></td>
                </tr>
            </table>

              </div>
              <div class="tab-pane" id="tab_4">
                <table width="90%" class="table">
                <tr>
                    <td class="left_column" width="15%" valign="middle">Mahasiswa</td>
                    <td>
                    <table width="100%">u
                    <tr>
                    <td>
                                                            <input type="checkbox" name="id_kk[]" id="id_kk_1#A" value="1#A"> A - Tuna netra<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_2#B" value="2#B"> B - Tuna rungu<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_4#C" value="4#C"> C - Tuna grahita ringan<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_8#C1" value="8#C1"> C1 - Tuna grahita ringan<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_16#D" value="16#D"> D - Tuna daksa ringan<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_32#D1" value="32#D1"> D1 - Tuna daksa sedang<br></td><td>                                        <input type="checkbox" name="id_kk[]" id="id_kk_64#E" value="64#E"> E - Tuna laras<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_128#F" value="128#F"> F - Tuna wicara<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_256#H" value="256#H"> H - Hiperaktif<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_512#I" value="512#I"> I - Cerdas Istimewa<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_1024#J" value="1024#J"> J - Bakat Istimewa<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_2048#K" value="2048#K"> K - Kesulitan Belajar<br></td><td>                                        <input type="checkbox" name="id_kk[]" id="id_kk_4096#N" value="4096#N"> N - Narkoba<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_8192#O" value="8192#O"> O - Indigo<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_16384#P" value="16384#P"> P - Down Syndrome<br>                                        <input type="checkbox" name="id_kk[]" id="id_kk_32768#Q" value="32768#Q"> Q - Autis<br>                                        </td>
                    </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td class="left_column" width="15%" valign="middle">Ayah</td>
                    <td>
                    <table width="100%">
                    <tr>
                    <td>
                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_1#A" value="1#A"> A - Tuna netra<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_2#B" value="2#B"> B - Tuna rungu<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_4#C" value="4#C"> C - Tuna grahita ringan<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_8#C1" value="8#C1"> C1 - Tuna grahita ringan<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_16#D" value="16#D"> D - Tuna daksa ringan<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_32#D1" value="32#D1"> D1 - Tuna daksa sedang<br></td><td>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_64#E" value="64#E"> E - Tuna laras<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_128#F" value="128#F"> F - Tuna wicara<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_256#H" value="256#H"> H - Hiperaktif<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_512#I" value="512#I"> I - Cerdas Istimewa<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_1024#J" value="1024#J"> J - Bakat Istimewa<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_2048#K" value="2048#K"> K - Kesulitan Belajar<br></td><td>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_4096#N" value="4096#N"> N - Narkoba<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_8192#O" value="8192#O"> O - Indigo<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_16384#P" value="16384#P"> P - Down Syndrome<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ayah[]" id="id_kebutuhan_khusus_ayah_32768#Q" value="32768#Q"> Q - Autis<br>                                        </td>
                    </tr>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td class="left_column" width="15%" valign="middle">Ibu</td>
                    <td>
                    <table width="100%">
                    <tr>
                    <td>
                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_1#A" value="1#A"> A - Tuna netra<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_2#B" value="2#B"> B - Tuna rungu<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_4#C" value="4#C"> C - Tuna grahita ringan<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_8#C1" value="8#C1"> C1 - Tuna grahita ringan<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_16#D" value="16#D"> D - Tuna daksa ringan<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_32#D1" value="32#D1"> D1 - Tuna daksa sedang<br></td><td>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_64#E" value="64#E"> E - Tuna laras<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_128#F" value="128#F"> F - Tuna wicara<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_256#H" value="256#H"> H - Hiperaktif<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_512#I" value="512#I"> I - Cerdas Istimewa<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_1024#J" value="1024#J"> J - Bakat Istimewa<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_2048#K" value="2048#K"> K - Kesulitan Belajar<br></td><td>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_4096#N" value="4096#N"> N - Narkoba<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_8192#O" value="8192#O"> O - Indigo<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_16384#P" value="16384#P"> P - Down Syndrome<br>                                        <input type="checkbox" name="id_kebutuhan_khusus_ibu[]" id="id_kebutuhan_khusus_ibu_32768#Q" value="32768#Q"> Q - Autis<br>                                        </td>
                    </tr>
                    </table>
                    </td>
                </tr>
            </table>
            <?php echo form_close();?>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>

<script type="text/javascript">
function get_asal(param){
if(param=="1"){
document.getElementById("sekolah").style.display = null;
document.getElementById("asal_jurusan").style.display = null;
document.getElementById("universitas").style.display = 'none';
document.getElementById("asal_prodii").style.display = 'none';
document.getElementById("sks_diakui").style.display = 'none';
} else {
document.getElementById("sekolah").style.display = 'none';
document.getElementById("asal_jurusan").style.display = 'none';
document.getElementById("universitas").style.display = null;
document.getElementById("asal_prodii").style.display = null;
document.getElementById("sks_diakui").style.display = null;
}
}  
</script>

        <script>
            document.getElementById("myText").readOnly = true;
function disableTxt() {
    document.getElementById("myText").readOnly = true;
}

function undisableTxt() {
    document.getElementById("myText").readOnly = false;
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
     function get_grade(p) {
                var semester_aktif = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>daftar_ulang/get_grade/'+semester_aktif,
                    data: 'semester_aktif='+semester_aktif,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_grade").html(msg);

                    }
                });
            }
  </script> 

  <script type="text/javascript">
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
</script>  


