        <?php echo $this->session->flashdata('message');?>
         <?php 
                if($this->session->userdata('level') == 5){ ?>
       <!--  <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi">Prestasi</a> -->
        
           <?php } else { ?>

		<a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa"><i class="fa fa-angle-left"></i> Back</a>
       <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->nik; ?>">History Pendidikan</a>
       <?php if ($mahasiswa->id_jenis_pendaftaran == '2') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/transfer_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">Nilai Transfer</a>
        <?php } ?>
        <?php if ($mahasiswa->asal_pt == 1 OR $mahasiswa->asal_pt == '' OR $mahasiswa->asal_pt == ' ') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>/<?php echo $mahasiswa->id_konsentrasi; ?>">KRS Mahasiswa</a>
        <?php } else { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/kelas_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">KRS Mahasiswa</a>
        <?php } ?> 
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/jadwal_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">Jadwal Kuliah</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">History Nilai</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan/<?php echo $mahasiswa->id_mahasiswa; ?>">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $mahasiswa->id_mahasiswa; ?>">Prestasi</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/checklist_pembayaran/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->id_prodi; ?>">Pembayaran</a>
        
         <br/><br/>  
           <?php }

           ?>

        <div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
        <tr>


            <td width="15%" class="left_column">Nama <font color="#FF0000">*</font></td>
            <td>: <?php echo $mahasiswa->nama_mahasiswa; ?>   </td>
      
           
                                  
            <input type="hidden" name="stat_pd" value="A">
            </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=>Tempat Lahir <font color="#FF0000">*</font></td>
            <td width="35%">: <?php echo $mahasiswa->tempat_lahir; ?>        </td>
            <td class="left_column" width="15%">Tanggal Lahir <font color="#FF0000">*</font></td>
            <td>:
               <?php echo $mahasiswa->tanggal_lahir; ?>                        </td>
        </tr>
        <tr>
            <td class="left_column">Jenis Kelamin</td>
            <td>: <?php echo $mahasiswa->jenis_kelamin; ?></td>
            <td class="left_column">Agama <font color="#FF0000">*</font></td>
            <td>:
            <?php echo $mahasiswa->agama; ?>
        </table>
            </div>
            <!-- /.box-body -->
          </div>
          
          <div class="">
            <?php 
                if($this->session->userdata('level') == 5){ ?>

                <?php } else { ?>
                        <a class="btn btn-primary btn-sm btn-flat pull-right"  data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Tambah Pendidikan</a><br><br>
                <?php } ?>
            
          </div>
          <div class="box box-info">
            <div class="box-body">
            <table class="table table-bordered table-striped" id="example3">
  <thead>
  <tr>
    <th style="width:5%" style="text-align:center">No.</th>
    <th width="10%" style="text-align:center">NIM</th>
    <th width="10%" style="text-align:center">Jenis Pendaftaran</th>
    <th width="15%" style="text-align:center">Periode</th>
    <th width="15%" style="text-align:center">Tanggal Masuk</th>
    <th style="text-align:center">Perguruan Tinggi</th>
    <th style="text-align:center">Program Studi</th>
    <?php if($this->session->userdata('level') != 5){?>
        <th style="text-align:center"></th>
    <?php } ?>
  </tr>
  </thead>
  <tbody>
    <?php 
        $alert = "'Menghapus histori pendidikan berarti menghapus data mahasiswa. Anda yakin ?'";
        $no = 0;
        foreach($history as $data):
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->nim;?></td>
        <td style="text-align:center"><?php echo $data->nama_pendaftaran;?></td>
        <td style="text-align:center"><?php echo $data->semester;?></td>
        <td style="text-align:center"><?php echo date("d M Y", strtotime($data->tgl_du));?></td>
        <td style="text-align:center">STIE Jakarta International College</td>
        <td style="text-align:center"><?php echo $data->nama_prodi;?></td >
        <?php if($this->session->userdata('level') != 5){?>
        <td style="text-align:center">

                <a href="" data-toggle="modal" data-target="#modal_detil<?php echo $data->id_pendidikan; ?>" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-list"></i><span class="tooltiptext">Detail</span></a>

                <a href="<?php echo base_url() ?>mahasiswa/hapus_pendidikan/<?php echo $data->id_mahasiswa; ?>" onclick="return confirm(<?php echo $alert ?>)" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i><span class="tooltiptext">Hapus</span></a>
                        </td> <?php }?>
    </tr>
<?php endforeach; ?>
  
  </tbody>
</table>
</div>

          </div>
          <div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">History Pendidikan</h3>
            </div>
            <?php echo form_open('mahasiswa/simpan_pendidikan/'.$mahasiswa->id_mahasiswa); ?>
            <div class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-xs-4" >NIM</label>
                        <div class="col-xs-6">
                            <input type="text" name="nim" class="form-control input-sm pull-left" id="nim" placeholder="" required="" onkeyup="checkAvailability()"><br><span id="user-availability-status"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Jenis Pendaftaran</label>
                        <div class="col-xs-6">
                            <select name="id_jenis_pendaftaran" id="id_jenis_pendaftaran" class="form-control input-sm" required="">
            <option value="">-- Pilih Jenis Pendaftaran --</option>
            <option value="1">Peserta Didik Baru</option>
            <option value="2">Pindahan</option>
             <option value="3">Alih Jenjang</option>
             <option value="4">Lintas Jalur</option>
             <option value="5">Rekognisi Pembelajaran Lampau</option>
             </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Jalur Pendaftaran</label>
                        <div class="col-xs-6">
                            <select name="id_jalur_pendaftaran" id="id_jalur_pendaftaran" class="form-control input-sm" required="">
            <option value="">-- Pilih Jalur Pendaftaran --</option>
            <option value="1">SBMPTN</option>
            <option value="2">SNMPTN</option>
             <option value="3">PMDK</option>
             <option value="4">Prestasi</option>
             <option value="5">Seleksi Jalur PTN</option>
             <option value="6">Seleksi Jalur PTS</option>
              <option value="7">Ujian Masuk Bersama PTN (UMB-PT)</option>
               <option value="8">Ujian Masuk Bersama PTS (UMB-PTS)</option>
                <option value="9">Program Internasional</option>
                 <option value="10">Program Kerjasama Perusahaan/Institusi/Pemerintah</option>
             </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Pembiayaan Awal</label>
                        <div class="col-xs-6">
                            <select name="id_pembiayaan_awal" id="id_pembiayaan_awal" class="form-control input-sm">
            <option value="">-- Pilih Pembiayaan Awal --</option>
            <option value="1">Mandiri</option>
            <option value="2">Beasiswa Tidak Penuh</option>
             <option value="3">Beasiswa Penuh</option>
             </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Perguruan Tinggi</label>
                        <div class="col-xs-6">
                            <input type="text" name="perguruan_tinggis" class="form-control input-sm pull-left" id="perguruan_tinggis" placeholder="" required="" value="033082 - STIE Jakarta International College" readonly="">
                            <input type="hidden" name="id_pt" class="form-control input-sm pull-left" id="id_pt" placeholder="" required="" value="1" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Tanggal Masuk</label>
                        <div class="col-xs-6">
                            <input type="date" name="tgl_du" class="form-control input-sm pull-left" id="tgl_du" placeholder="" required="">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Nama Prodi</label>
                        <div class="col-xs-6">
                            <select name="id_prodi" onchange="return get_concentrate(this.value)" onblur="return get_prodi_periode(this.value)"  class="form-control input-sm pull-left" required="">
                        <option value="">-- Pilih Prodi --</option>
                        <?php 

                                        foreach($getProdi as $row)
                                        { 
                                          echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                        }
                                    ?>
                      </select>
                  </div>
                        </div>
                        <div class="form-group">
                        <label class=" col-xs-4" >Nama Konsentrasi</label>
                        <div class="col-xs-6">
                            <select name="concentrate" id="concentrate" class="form-control input-sm pull-left" required="">
                        <option value="">-- Pilih Prodi Dahulu --</option>
                    
                      </select>
                  </div>
                        </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Periode Pendaftaran</label>
                        <div class="col-xs-6">
                            <select name="id_periode" id="id_periode" class="form-control input-sm pull-left" required="">
                        <option value="">-- Pilih periode --</option>
                       
                      </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Jumlah Sks di akui</label>
                        <div class="col-xs-6">
                            <input type="text" name="jml_sks_diakui" class="form-control input-sm pull-left" id="jml_sks_diakui" placeholder="" required="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Asal Perguruan Tinggi</label>
                        <div class="col-xs-6">
                            <select name="asal_pt" class="form-control input-sm pull-left" required="">
                        <option value=""> Pilih Perguruan Tinggi </option>
                        <?php 

                                        foreach($getUniversitas as $row)
                                        { 
                                          echo '<option value="'.$row->id_pt.'">'.$row->nama_pt.'</option>';
                                        }
                                    ?>
                      </select>
                  </div>
                        </div>
                   <div class="form-group">
                        <label class=" col-xs-4" >Asal Program Studi</label>
                        <div class="col-xs-6">
                            <input type="text" name="asal_prodi" class="form-control input-sm pull-left" id="asal_prodi" placeholder="" required="" >
                        </div>
                    </div>
                    <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" class="text-input" size="10" style="width:70%" value="<?php echo $kodeunik_mhs; ?>" readonly>
                    <input type="hidden" name="id_mahasiswa_ori" id="id_mahasiswa_ori" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->id_mahasiswa; ?>" readonly>
                    <input type="hidden" name="nama_mahasiswa" id="nama_mahasiswa" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->nama_mahasiswa; ?>" readonly>
                    <input type="hidden" name="id_waktu" id="id_waktu" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->id_waktu; ?>" readonly>
<input type="hidden" name="id_du" id="id_du" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->id_du; ?>" readonly>
<input type="hidden" name="id_sekolah" id="id_sekolah" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->id_sekolah; ?>" readonly>
<input type="hidden" name="id_hasil_tes" id="id_hasil_tes" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->id_hasil_tes; ?>" readonly>

<input type="hidden" name="tempat_lahir" id="tempat_lahir" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->tempat_lahir; ?>" readonly>
<input type="hidden" name="tanggal_lahir" id="tanggal_lahir" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->tanggal_lahir; ?>" readonly>
<input type="hidden" name="jenis_kelamin" id="jenis_kelamin" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->id_kelamin; ?>" readonly>
<input type="hidden" name="agama" id="agama" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->id_agama; ?>">

<input type="hidden" name="nim_lama" id="nim_lama" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->nim; ?>">

<input type="hidden" name="id_grade" id="id_grade" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->id_grade; ?>">
<input type="hidden" name="jurusan" id="jurusan" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->jurusan; ?>">
<input type="hidden" name="kps" id="kps" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->kps; ?>">
<input type="hidden" name="no_kps" id="no_kps" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->no_kps; ?>">
<input type="hidden" name="foto_mahasiswa" id="foto_mahasiswa" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->foto_mahasiswa; ?>">
<input type="hidden" name="alamat_mhs" id="alamat_mhs" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->alamat_mhs; ?>">

<input type="hidden" name="nik" id="nik" value="<?php echo $mahasiswa->nik; ?>" class="validate[required] text-input" maxlength="16" size="50" style="width:40%">
<input type="hidden" name="nisn" id="nisn" class="text-input" maxlength="10" size="10" style="width:70%" value="<?php echo $mahasiswa->nisn; ?>">
<input type="hidden" name="npwp" id="npwp" class="text-input" maxlength="15" size="15" style="width:70%" value="<?php echo $mahasiswa->npwp; ?>">
<input type="hidden" name="kewarganegaraan" id="kewarganegaraan" class="validate[required] text-input" style="width:70%" value="<?php echo $mahasiswa->kewarganegaraan; ?>">
<input type="hidden" name="jalan" id="jalan" class="text-input" maxlength="80" size="80" style="width:70%" value="<?php echo $mahasiswa->jalan; ?>">
<input type="hidden" name="dusun" id="dusun" class="text-input" maxlength="60" size="60" style="width:80%" value="<?php echo $mahasiswa->dusun; ?>">
<input type="hidden" name="rt" id="rt" class="text-input" maxlength="2" size="2" style="width:50%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->rt; ?>">
<input type="hidden" name="rw" id="rw" class="text-input" maxlength="2" size="2" style="width:50%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->rw; ?>">
<input type="hidden" name="kelurahan" id="kelurahan" class="validate[required] text-input" maxlength="60" size="60" style="width:80%" value="<?php echo $mahasiswa->kelurahan; ?>">
<input type="hidden" name="kode_pos" id="kode_pos" class="text-input" maxlength="5" size="5" style="width:30%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->kode_pos; ?>">
<input type="hidden" name="kecamatan" id="kecamatan" class="validate[required] text-input" style="width:70%" value="<?php echo $mahasiswa->kecamatan; ?>">
<input type="hidden" name="id_jt" id="id_jt" class="validate[required] text-input" style="width:70%" value="<?php echo $mahasiswa->id_jt; ?>">
<input type="hidden" name="id_transportasi" id="id_transportasi" class="validate[required] text-input" style="width:70%" value="<?php echo $mahasiswa->id_transportasi; ?>">

<input type="hidden" name="no_telepon" id="no_telepon" class="text-input" maxlength="20" size="20" style="width:30%" value="<?php echo $mahasiswa->no_telepon; ?>">
<input type="hidden" name="no_hp" id="no_hp" class="text-input" maxlength="20" size="20" style="width:30%" value="<?php echo $mahasiswa->no_hp; ?>">
<input type="hidden" name="email" id="email" class="text-input" maxlength="60" size="60" style="width:30%" value="<?php echo $mahasiswa->email; ?>">
<input type="hidden" name="no_kps" id="no_kps" class="text-input" maxlength="80" size="80" disabled style="width:50%" value="<?php echo $mahasiswa->no_kps; ?>">
<input type="hidden" name="nik_ayah" id="nik_ayah" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->nik_ayah; ?>">
<input type="hidden" name="nama_ayah" id="nama_ayah" class="text-input" maxlength="100" size="100" style="width:50%" value="<?php echo $mahasiswa->nama_ayah; ?>">
<input type="hidden" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->tanggal_lahir_ayah; ?>">

<input type="hidden" name="pendidikan_ayah" id="pendidikan_ayah" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->pendidikan_ayah; ?>">

<input type="hidden" name="pekerjaan_ayah" id="pekerjaan_ayah" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->pekerjaan_ayah; ?>">
<input type="hidden" name="penghasilan_ayah" id="penghasilan_ayah" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->penghasilan_ayah; ?>">

<input type="hidden" name="nik_ibu" id="nik_ibu" class="text-input" maxlength="16" size="50" style="width:40%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $mahasiswa->nik_ibu; ?>">
 <input type="hidden" name="nama_ibu" id="nama_ibu" class="text-input" size="10" style="width:70%" value="<?php echo $mahasiswa->nama_ibu; ?>" readonly>
<input type="hidden" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu" class="text-input" maxlength="60" size="60" style="width:20%" value="<?php echo $mahasiswa->tanggal_lahir_ibu; ?>">
<input type="hidden" name="pendidikan_ibu" id="pendidikan_ibu" class="text-input" maxlength="60" size="60" style="width:20%" value="<?php echo $mahasiswa->pendidikan_ibu; ?>">
<input type="hidden" name="pekerjaan_ibu" id="pekerjaan_ibu" class="text-input" maxlength="60" size="60" style="width:20%" value="<?php echo $mahasiswa->pekerjaan_ibu; ?>">
<input type="hidden" name="penghasilan_ibu" id="penghasilan_ibu" class="text-input" maxlength="60" size="60" style="width:20%" value="<?php echo $mahasiswa->penghasilan_ibu; ?>">

<input type="hidden" name="nama_wali" id="nama_wali" class="text-input" maxlength="100" size="100" style="width:50%" value="<?php echo $mahasiswa->nama_wali; ?>">
<input type="hidden" name="tanggal_lahir_wali" id="tanggal_lahir_wali" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->tanggal_lahir_wali; ?>">
<input type="hidden" name="pendidikan_wali" id="pendidikan_wali" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->pendidikan_wali; ?>">

<input type="hidden" name="pekerjaan_wali" id="pekerjaan_wali" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->pekerjaan_wali; ?>">

<input type="hidden" name="penghasilan_wali" id="penghasilan_wali" class="text-input" maxlength="50" size="50" style="width:20%" value="<?php echo $mahasiswa->penghasilan_wali; ?>">

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary btn-flat" id="myBtn"><i class="fa fa-save"></i> Save</button>
                </div>
            <?php echo form_close();?>
            </div></div>
            </div>
        </div>

<?php 
        foreach($history as $i):
        ?>

        <div class="modal fade" id="modal_detil<?php echo $i->id_pendidikan; ?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">History Pendidikan</h3>
            </div>
            <?php echo form_open('mahasiswa/edit_pendidikan/'.$i->id_pendidikan.'/'.$i->nik.'/'.$i->id_mahasiswa); ?>
            <div class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-xs-4" >NIM</label>
                        <div class="col-xs-6">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" value="<?php echo $i->nim; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Jenis Pendaftaran</label>
                        <div class="col-xs-6">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" value="<?php echo $i->nama_pendaftaran; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Jalur Pendaftaran</label>
                        <div class="col-xs-6">
                            <select name="id_jalur_pendaftaran" id="id_jalur_pendaftaran" class="form-control input-sm" required="">
            <option value="<?php echo $i->id_jalur_pendaftaran; ?>"> <?php echo $i->nama_jalur; ?> </option>
            <option value="1">SBMPTN</option>
            <option value="2">SNMPTN</option>
             <option value="3">PMDK</option>
             <option value="4">Prestasi</option>
             <option value="5">Seleksi Jalur PTN</option>
             <option value="6">Seleksi Jalur PTS</option>
              <option value="7">Ujian Masuk Bersama PTN (UMB-PT)</option>
               <option value="8">Ujian Masuk Bersama PTS (UMB-PTS)</option>
                <option value="9">Program Internasional</option>
                 <option value="10">Program Kerjasama Perusahaan/Institusi/Pemerintah</option>
             </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Tanggal Masuk</label>
                        <div class="col-xs-6">
                            <input type="date" name="tgl_du" class="form-control input-sm pull-left" id="tgl_du" placeholder="" value="<?php echo $i->tgl_du; ?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Pembiayaan Awal</label>
                        <div class="col-xs-6">
                            <select name="id_pembiayaan_awal" id="id_pembiayaan_awal" class="form-control input-sm">
                            <option value="<?php echo $i->id_pembiayaan_awal; ?>"> <?php echo $i->nama_pembiayaan; ?></option>
                            <option value="1">Mandiri</option>
                            <option value="2">Beasiswa Tidak Penuh</option>
                             <option value="3">Beasiswa Penuh</option>
                             </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Perguruan Tinggi</label>
                        <div class="col-xs-6">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" value="STIE Jakarta International College" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Program Studi</label>
                        <div class="col-xs-6">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" value="<?php echo $i->nama_prodi; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Periode Pendaftaran</label>
                        <div class="col-xs-6">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" required="" value="<?php echo $i->semester; ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Jumlah Sks di akui</label>
                        <div class="col-xs-6">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" value="<?php echo $i->jml_sks_diakui; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Asal Perguruan Tinggi</label>
                        <div class="col-xs-6">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" value="<?php echo $i->nama_pt; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class=" col-xs-4" >Asal Program Studi</label>
                        <div class="col-xs-6">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" value="<?php echo $i->asal_prodi; ?>" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-primary btn-flat" id="myBtn"><i class="fa fa-save"></i> Update</button>
                </div>

                </div>
            <?php echo form_close();?>

            </div></div>
            </div>
        </div>
        <?php endforeach;?>
        <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
            - Fitur ini digunakan untuk menampilkan history pendidikan setiap mahasiswa
            <br />
            - Data yang dapat di ubah hanya data pada periode aktif
         </div>


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