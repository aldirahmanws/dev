

<?php
$ea = $this->session->flashdata('message');
if(!empty($ea)){
    echo '<div class="callout callout-info">';
    echo $ea;
    echo '</div>';
}
?>
<form  method="post" action="<?php echo base_url(); ?>mahasiswa/save_edit_mahasiswa/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->nim; ?>" enctype="multipart/form-data">
        
        <div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
        <tr>

            <td width="15%" class="left_column">Nama <font color="#FF0000">*</font></td>
            <td>:
                <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->nama_mahasiswa; ?>" readonly>    </td>
      
             <td class="left_column">Waktu <font color="#FF0000">*</font></td>
            <td>:  <select name="id_waktu" id="id_waktu" required="">
                    <option value="<?php echo $mahasiswa->id_waktu; ?>"> <?php echo $mahasiswa->waktu; ?> </option>
                    <option value="1">Pagi</option>
                    <option value="2">Sore</option>
                    </select></td>
                                  
            </td>
           
        </tr>
        <tr>
            <td class="left_column" width="15%" value=>Tempat Lahir <font color="#FF0000">*</font></td>
            <td width="35%">: <input type="text" name="tempat_lahir" id="tempat_lahir" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->tempat_lahir; ?>" readonly>          </td>
            <td class="left_column" width="15%">Tanggal Lahir <font color="#FF0000">*</font></td>
            <td>:
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->tanggal_lahir; ?>" readonly>                           </td>
        </tr>
        <tr>
            <td class="left_column">Jenis Kelamin</td>
            <td>: <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->jenis_kelamin; ?>" readonly></td>
            <td class="left_column">Agama <font color="#FF0000">*</font></td>
            <td>:  <select name="id_agama" id="id_agama">
            <option value="<?php echo $mahasiswa->id_agama; ?>"><?php echo $mahasiswa->agama; ?></option>
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
              <li><a href="#tab_1" data-toggle="tab">Alamats</a></li>
              <li><a href="#tab_2" data-toggle="tab">Orang Tua</a></li>
              <li><a href="#tab_3" data-toggle="tab">Wali</a></li>
              <li class="pull-right"><button class="btn btn-sm btn-primary btn-flat"><i class="fa fa-save"></i> Save</button> </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_0">
                <table width="90%" class="table">
                <tr>
                    <td class="left_column" width="15%">NIM</td>
                    <td colspan="3">:  <input type="text" name="nim" id="nim" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->nim; ?>">

                    </td>
                    <td rowspan="8" width="15%">
                        <div class="btn btn-file" >
                  <img  data-toggle="modal" data-target="#modal-default" id="output" height="200" width="150" class="pull-right" width="40%" src="<?php echo base_url(); ?>uploads/<?php echo $mahasiswa->foto_mahasiswa; ?>" alt="Photo" onerror="this.src='<?php echo base_url();?>uploads/user.jpg'" src="#" alt="Your Image">
                </div>
                </td>
                </tr>
                 <tr>
                    <td class="left_column" width="15%" >Nama Prodi <font color="#FF0000">*</font></td>
                    <td>: <select name="id_prodi" id="id_prodi" required="" onchange="return get_concentrate(this.value)">
                            <option value="<?php echo $mahasiswa->id_prodi; ?>"><?php echo $mahasiswa->nama_prodi; ?></option>  
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
                            <option value="<?php echo $mahasiswa->id_konsentrasi; ?>"><?php echo $mahasiswa->nama_konsentrasi; ?></option>
                            
                             </select></td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">Tanggal Pendaftaran <font color="#FF0000">*</font></td>
                    <td colspan="4">:  <input type="date" name="tgl_du" id="tgl_du" class="validate[required] text-input" maxlength="16" size="50" style="width:20%" value="<?php echo $mahasiswa->tgl_du; ?>">                            
                    </td>
                </tr>
               
                <tr>
                    <td class="left_column" width="15%"> Grade <font color="#FF0000">*</font></td>
                    <td colspan="4">:  <select name="id_grade" id="id_grade" required="">
                            <option value="<?php echo $mahasiswa->id_grade; ?>"><?php echo $mahasiswa->grade; ?></option>  
                             <?php 

                  foreach($getGrade as $row)
                  { 
                    echo '<option value="'.$row->id_grade.'">'.$row->grade.'</option>';
                  }
                  ?>
                             </select>                            
                    </td>
                </tr>
            </table>

              </div>
              <div class="tab-pane" id="tab_1">
                <table width="90%" class="table">
                <tr>
                    <td class="left_column" width="15%">NIK <font color="#FF0000">*</font></td>
                    <td colspan="4">:  <input type="text" name="nik" id="nik" value="<?php echo $mahasiswa->nik; ?>" class="validate[required] text-input" maxlength="16" size="50" style="width:40%">                            <font color="grey"><em> ( Nomor NIK tanpa tanda baca ) </em></font>
                    </td>
                </tr>
        <tr>
                    <td class="left_column" width="15%">NISN</td>
                    <td colspan="5">: <input type="text" name="nisn" id="nisn" class="text-input" maxlength="10" size="10" style="width:70%" value="<?php echo $mahasiswa->nisn; ?>"></td>
                </tr>
        <tr>
                    <td class="left_column" width="15%">NPWP</td>
                    <td colspan="5">: <input type="text" name="npwp" id="npwp" class="text-input" maxlength="15" size="15" style="width:70%" value="<?php echo $mahasiswa->npwp; ?>"></td>
                </tr>
                <tr>
                    <td class="left_column">Kewarganegaraan <font color="#FF0000">*</font></td>
                    <td colspan="5">: 
                    <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="validate[required] text-input" style="width:70%" value="<?php echo $mahasiswa->kewarganegaraan; ?>"> 
                    </td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">Jalan</td>
                    <td colspan="5">: <input type="text" name="jalan" id="jalan" class="text-input" maxlength="80" size="80" style="width:70%" value="<?php echo $mahasiswa->jalan; ?>"></td>
                </tr>
                <tr>
                    <td class="left_column">Dusun</td>
                    <td>: <input type="text" name="dusun" id="dusun" class="text-input" maxlength="60" size="60" style="width:80%" value="<?php echo $mahasiswa->dusun; ?>"></td>
                    <td class="left_column">RT</td>
                    <td >: <input type="text" name="rt" id="rt" class="text-input" maxlength="2" size="2" style="width:50%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->rt; ?>">  </td>
                    <td class="left_column">RW</td>
                    <td>: <input type="text" name="rw" id="rw" class="text-input" maxlength="2" size="2" style="width:50%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->rw; ?>"></td>
                </tr>
                <tr>
                    <td class="left_column">Kelurahan <font color="#FF0000">*</font></td>
                    <td>: <input type="text" name="kelurahan" id="kelurahan" class="validate[required] text-input" maxlength="60" size="60" style="width:80%" value="<?php echo $mahasiswa->kelurahan; ?>"></td>
                    <td class="left_column">Kodepos</td>
                    <td colspan="4">: <input type="text" name="kode_pos" id="kode_pos" class="text-input" maxlength="5" size="5" style="width:30%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->kode_pos; ?>"></td>
                </tr>
                <tr>
                    <td class="left_column">Kecamatan <font color="#FF0000">*</font></td>
                    <td colspan="5">: 
                    <input type="text" name="kecamatan" id="kecamatan" class="validate[required] text-input" style="width:70%" value="<?php echo $mahasiswa->kecamatan; ?>">
                    </td>
                </tr>
                <tr>
                    <td class="left_column">Jenis Tinggal</td>
                    <td colspan="5">: <select name="jenis_tinggal" id="jenis_tinggal">
                    <option value="<?php echo $mahasiswa->jenis_tinggal; ?>"><?php echo $mahasiswa->jenis_tinggal; ?></option>
                    <option value="Bersama orang tua">Bersama orang tua</option>
                    <option value="Wali">Wali</option>
                    <option value="Kost">Kost</option>
                    <option value="Asrama">Asrama</option>
                    <option value="Panti asuhan">Panti asuhan</option>
                    <option value="Lainnya">Lainnya</option>
                    </select></td>
                </tr>
                 <tr>
                    <td class="left_column">Alat Transportasi</td>
                    <td colspan="5">: <select name="alat_transportasi" id="alat_transportasi">
                    <option value="<?php echo $mahasiswa->transportasi; ?>"><?php echo $mahasiswa->transportasi; ?></option>
                    <option value="Jalan kaki">Jalan kaki</option>
                    <option value="Angkutan umum/bus/pete-pete">Angkutan umum/bus/pete-pete</option>
                    <option value="Mobil/bus antar jemput">Mobil/bus antar jemput</option>
                    <option value="Kereta api">Kereta api</option>
                    <option value="Ojek">Ojek</option>
                    <option value="Andong/bendi/sado/dokar/delman/becak">Andong/bendi/sado/dokar/delman/becak</option>
                    <option value="Perahu penyeberangan/rakit/getek">Perahu penyeberangan/rakit/getek</option>
                    <option value="Kuda">Kuda</option>
                    <option value="Sepeda">Sepeda</option>
                    <option value="Sepeda motor">Sepeda motor</option>
                    <option value="Mobil pribadi">Mobil pribadi</option>
                    <option value="Lainnya">Lainnya</option>
                </select></td>
                </tr>
                <tr>
                    <td class="left_column">Telepon</td>
                    <td>: <input type="text" name="no_telepon" id="no_telepon" class="text-input" maxlength="20" size="20" style="width:30%" value="<?php echo $mahasiswa->no_telepon; ?>"></td>
                    <td class="left_column">HP</td>
                    <td colspan="4">: <input type="text" name="no_hp" id="no_hp" class="text-input" maxlength="20" size="20" style="width:30%" value="<?php echo $mahasiswa->no_hp; ?>"></td>
                </tr>
                <tr>
                    <td class="left_column">Email</td>
                    <td colspan="5">: <input type="text" name="email" id="email" class="text-input" maxlength="60" size="60" style="width:30%" value="<?php echo $mahasiswa->email; ?>"></td>
                </tr>
                <tr>
                    <td class="left_column">Penerima KPS ? <font color="#FF0000">*</font></td>
                    <td>: 
                    <label class="radio-inline"><input type="radio" name="kps" value="Tidak" > Tidak</label> &nbsp; 
                <label class="radio-inline"><input type="radio" name="kps" value="Ya" > Ya</label> &nbsp; 
                </td>
                    <td class="left_column">No KPS</td>
                    <td colspan = '4'>: <input type="text" name="no_kps" id="no_kps" class="text-input" maxlength="80" size="80" disabled style="width:50%" value="<?php echo $mahasiswa->no_kps; ?>"></td>
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
                    <td>:  <input type="text" name="nik_ayah" id="nik_ayah" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->nik_ayah; ?>">                            <font color="grey"><em> ( Nomor KTP tanpa tanda baca ) </em></font>
                    </td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">Nama</td>
                    <td>: <input type="text" name="nama_ayah" id="nama_ayah" class="text-input" maxlength="100" size="100" style="width:50%" value="<?php echo $mahasiswa->nama_ayah; ?>"></td>
                </tr>
                <tr>
                    <td class="left_column">Tanggal Lahir</td>
                    <td>:
                        <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->tanggal_lahir_ayah; ?>">                                                                    </td>
                </tr>
                <tr>
                    <td class="left_column">Pendidikan</td>
                    <td>: <select name="pendidikan_ayah" id="pendidikan_ayah">
                        <option value="<?php echo $mahasiswa->pendidikan_ayah; ?>"><?php echo $mahasiswa->pendidikan_ayah; ?></option>
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
                        <option value="<?php echo $mahasiswa->pekerjaan_ayah; ?>"><?php echo $mahasiswa->pekerjaan_ayah; ?></option>
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
                        <option value="<?php echo $mahasiswa->penghasilan_ayah; ?>"><?php echo $mahasiswa->penghasilan_ayah; ?></option>
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
                    <td>:  <input type="text" name="nik_ibu" id="nik_ibu" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->nik_ibu; ?>">                            <font color="grey"><em> ( Nomor KTP tanpa tanda baca ) </em></font>
                    </td>
                </tr>
                
                <tr>
                    <td class="left_column">Nama</td>
                    <td>:
            <input type="text" name="nama_ibu" id="nama_ibu" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->nama_ibu; ?>" readonly></td>
                </tr>
                <tr>
                    <td class="left_column">Tanggal Lahir</td>
                    <td>:
                        <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu" class="text-input" maxlength="60" size="60" style="width:20%" value="<?php echo $mahasiswa->tanggal_lahir_ibu; ?>">                    </td>
                </tr>
                <tr>
                    <td class="left_column">Pendidikan</td>
                    <td>: <select name="pendidikan_ibu" id="pendidikan_ibu">
                        <option value="<?php echo $mahasiswa->pendidikan_ibu; ?>"><?php echo $mahasiswa->pekerjaan_ibu; ?></option>
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
                        <option value="<?php echo $mahasiswa->pekerjaan_ibu; ?>"><?php echo $mahasiswa->pekerjaan_ibu; ?></option>
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
                    <option value="<?php echo $mahasiswa->penghasilan_ibu; ?>"><?php echo $mahasiswa->penghasilan_ibu; ?></option>
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
                    <td>: <input type="text" name="nama_wali" id="nama_wali" class="text-input" maxlength="100" size="100" style="width:50%" value="<?php echo $mahasiswa->nama_wali; ?>"></td>
                </tr>
                <tr>
                    <td class="left_column">Tanggal Lahir</td>
                    <td>:
                        <input type="date" name="tanggal_lahir_wali" id="tanggal_lahir_wali" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->tanggal_lahir_wali; ?>">                                                                    </td>
                </tr>
                <tr>
                    <td class="left_column">Pendidikan</td>
                    <td>: <select name="pendidikan_wali" id="pendidikan_wali">
                        <option value="<?php echo $mahasiswa->pendidikan_wali; ?>"><?php echo $mahasiswa->pendidikan_wali; ?></option>
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
                        <option value="<?php echo $mahasiswa->pekerjaan_wali; ?>"><?php echo $mahasiswa->pekerjaan_wali; ?></option>
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
                        <option value="<?php echo $mahasiswa->penghasilan_wali; ?>"><?php echo $mahasiswa->penghasilan_wali; ?></option>
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
            </div>
            <!-- /.tab-content -->
          </div>
      </form>
          <!-- nav-tabs-custom -->
       
        <!-- /.col -->
<script>
    function loadFile(event) {
                var output = document.getElementById('outputku');
                output.src = URL.createObjectURL(event.target.files[0]);
            }
</script>
<script type="text/javascript">
</script>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
      <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<div class="modal fade" id="modal-default" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Foto</h4>
              </div>
              <div class="modal-body">
                
                <div class="form-horizontal">
                <form  method="post" runat="server" action="<?php echo base_url(); ?>mahasiswa/save_edit_foto_mahasiswa/<?php echo $mahasiswa->id_mahasiswa; ?>" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="box-body">
                        <div class="form-group">
                             <img  id="outputku" height="200" width="200"  src="<?php echo base_url(); ?>uploads/<?php echo $mahasiswa->foto_mahasiswa; ?>" alt="Photo" onerror="this.src='<?php echo base_url();?>uploads/user.jpg'" src="#" alt="Your Image" >
                        </div>
                        <div class="form-group">
                            <input type="file" id="foto_mahasiswa" name="foto_mahasiswa" onchange="loadFile(event)">
                        </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                  <!-- /.box-body -->
                  <!-- /.box-footer -->
                  </div></form>

                </div>
          </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      

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
  </script>  