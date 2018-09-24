           <?php 
                if($this->session->userdata('level') == 5){ ?>
        <!-- <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi">Prestasi</a> -->
        
           <?php } else { ?>

         <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $mahasiswa->id_mahasiswa; ?>">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>/<?php echo $mahasiswa->id_konsentrasi; ?>">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/jadwal_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">Jadwal Kuliah</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">History Nilai</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan/<?php echo $mahasiswa->id_mahasiswa; ?>">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $mahasiswa->id_mahasiswa; ?>">Prestasi</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/checklist_pembayaran/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->id_prodi; ?>">Pembayaran</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa">Kembali</a>
         <br/><br/>  
           <?php }

           ?>
      
        <div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
        <tr>

            <td width="15%" class="left_column">Nama <font color="#FF0000">*</font></td>
            <td>:
               <?php echo $mahasiswa->nama_mahasiswa; ?> </td>
      
            <td class="left_column">Nama Ibu <font color="#FF0000">*</font></td>
            <td>:  <?php echo $mahasiswa->nama_ibu; ?>
                                  
            <input type="hidden" name="stat_pd" value="A">
            </td>

        </tr>
        <tr>
            <td class="left_column" width="15%" value=>Tempat Lahir <font color="#FF0000">*</font></td>
            <td width="35%">: <?php echo $mahasiswa->tempat_lahir; ?>        </td>
            <td class="left_column" width="15%">Tanggal Lahir <font color="#FF0000">*</font></td>
            <td>:
                <?php echo $mahasiswa->tanggal_lahir; ?>                           </td>
        </tr>
        <tr>
            <td class="left_column">Jenis Kelamin</td>
            <td>: <?php echo $mahasiswa->jenis_kelamin; ?></td>
            <td class="left_column">Agama <font color="#FF0000">*</font></td>
            <td>:  <?php echo $mahasiswa->agama; ?></td>
            </tr>
        </table>
            </div>
            <!-- /.box-body -->
          </div>
          <?php echo $this->session->flashdata('message');?>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_0" data-toggle="tab">Profil</a></li>
              <li><a href="#tab_1" data-toggle="tab">Alamat</a></li>
              <li><a href="#tab_2" data-toggle="tab">Orang Tua</a></li>
              <li><a href="#tab_3" data-toggle="tab">Wali</a></li>
              <?php 
                if($this->session->userdata('level') == 5){ ?>
                <li><a href="#tab_5" data-toggle="tab">Ganti Password</a></li> 
                <?php } else { ?>
                    <li class="pull-right"><button class="btn btn-sm btn-success"><a href="<?php echo base_url();?>mahasiswa/detail_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>" class="text-muted"  style="color:white;">Ubah</a></button></li>
                <?php } ?>
              
            </ul>



            <div class="tab-content">

                 <div class="tab-pane active" id="tab_0">
                <table width="90%" class="table">
                
                <tr>
                    <td class="left_column" width="15%">NIM</td>
                    <td colspan="6">:  <?php echo $mahasiswa->nim; ?>
                    </td>
                    <td rowspan="8" width="15%">
                        <div class="btn btn-file" >
                 
                  <img id="output" height="200" width="150" class="pull-right" width="40%" src="<?php echo base_url(); ?>uploads/<?php echo $mahasiswa->foto_mahasiswa; ?>" alt="Your Image" onerror="this.src='<?php echo base_url();?>uploads/user.jpg'">
                </div></td>
                </tr>
                <tr>
                    <td class="left_column" width="15%"> Prodi</td>
                    <td colspan="6" size="100">: <?php echo $mahasiswa->nama_prodi; ?></td>
                </tr>
                 <tr>
                    <td class="left_column" width="15%"> Konsentrasi</td>
                    <td colspan="6" size="100">: <?php echo $mahasiswa->nama_konsentrasi; ?></td>
                </tr>
                 <tr>
                    <td class="left_column" width="15%"> Tanggal Pendaftaran</td>
                    <td colspan="6" size="100">: <?php echo $mahasiswa->tgl_du; ?></td>
                </tr>
                 <tr>
                    <td class="left_column" width="15%"> Status</td>
                    <td colspan="6" size="100">: <?php echo $mahasiswa->status_mhs; ?></td>
                </tr>
                
            </table>

              </div>
              <div class="tab-pane" id="tab_1">
                <table width="90%" class="table">
                <tr>
                    <td class="left_column" width="15%">NIK <font color="#FF0000">*</font></td>
                    <td colspan="4">:  <?php echo $mahasiswa->nik; ?>
                    </td>
                </tr>
        <tr>
                    <td class="left_column" width="15%">NISN</td>
                    <td colspan="5">: <?php echo $mahasiswa->nisn; ?></td>
                </tr>
        <tr>
                    <td class="left_column" width="15%">NPWP</td>
                    <td colspan="5">: <?php echo $mahasiswa->npwp; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Kewarganegaraan <font color="#FF0000">*</font></td>
                    <td colspan="5">: 
                    <?php echo $mahasiswa->kewarganegaraan; ?>
                    </td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">Jalan</td>
                    <td colspan="5">: <?php echo $mahasiswa->jalan; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Dusun</td>
                    <td>: <?php echo $mahasiswa->dusun; ?></td>
                    <td class="left_column">RT</td>
                    <td>: <?php echo $mahasiswa->rt; ?> </td>
                    <td class="left_column">RW</td>
                    <td>: <?php echo $mahasiswa->rw; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Kelurahan <font color="#FF0000">*</font></td>
                    <td>: <?php echo $mahasiswa->kelurahan; ?></td>
                    <td class="left_column">Kodepos</td>
                    <td colspan="4">: <?php echo $mahasiswa->kode_pos; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Kecamatan <font color="#FF0000">*</font></td>
                    <td colspan="5">: 
                    <?php echo $mahasiswa->kecamatan; ?>
                    </td>
                </tr>
                <tr>
                    <td class="left_column">Jenis Tinggal</td>
                    <td colspan="5">: <?php echo $mahasiswa->jenis_tinggal; ?></td>
                </tr>
                 <tr>
                    <td class="left_column">Alat Transportasi</td>
                    <td colspan="5">: <?php echo $mahasiswa->transportasi; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Telepon</td>
                    <td>: <?php echo $mahasiswa->no_telepon; ?></td>
                    <td class="left_column">HP</td>
                    <td colspan="4">: <?php echo $mahasiswa->no_hp; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Email</td>
                    <td colspan="5">: <?php echo $mahasiswa->email; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Penerima KPS ? <font color="#FF0000">*</font></td>
                    <td>: 
                    <?php echo $mahasiswa->kps; ?>
                </td>
                    <td class="left_column">No KPS</td>
                    <td colspan = '4'>: <?php echo $mahasiswa->no_kps; ?></td>
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
                    <td>:  <?php echo $mahasiswa->nik_ayah; ?>
                    </td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">Nama</td>
                    <td>: <?php echo $mahasiswa->nama_ayah; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Tanggal Lahir</td>
                    <td>:
                       <?php echo $mahasiswa->tanggal_lahir_ayah; ?>                                                                    </td>
                </tr>
                <tr>
                    <td class="left_column">Pendidikan</td>
                    <td>: <?php echo $mahasiswa->pendidikan_ayah; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Pekerjaan</td>
                    <td>: <?php echo $mahasiswa->pekerjaan_ayah; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Penghasilan</td>
                    <td>: <?php echo $mahasiswa->penghasilan_ayah; ?></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Ibu</strong></td>
                </tr>
                <tr>
                    <?php echo $mahasiswa->nik_ibu; ?>
                    </td>
                </tr>
                
                <tr>
                    <td class="left_column">Nama</td>
                    <td>:
            <?php echo $mahasiswa->nama_ibu; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Tanggal Lahir</td>
                    <td>:
                       <?php echo $mahasiswa->tanggal_lahir_ibu; ?>                   </td>
                </tr>
                <tr>
                    <td class="left_column">Pendidikan</td>
                    <td>: <?php echo $mahasiswa->pendidikan_ibu; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Pekerjaan</td>
                    <td>: <?php echo $mahasiswa->pekerjaan_ibu; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Penghasilan</td>
                    <td>: <?php echo $mahasiswa->penghasilan_ibu; ?></td>
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
                    <td>: <?php echo $mahasiswa->nama_wali; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Tanggal Lahir</td>
                    <td>:
                       <?php echo $mahasiswa->tanggal_lahir_wali; ?>                                                                    </td>
                </tr>
                <tr>
                    <td class="left_column">Pendidikan</td>
                    <td>: <?php echo $mahasiswa->pendidikan_wali; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Pekerjaan</td>
                    <td>: <?php echo $mahasiswa->pekerjaan_wali; ?></td>
                </tr>
                <tr>
                    <td class="left_column">Penghasilan</td>
                    <td>: <?php echo $mahasiswa->penghasilan_wali; ?></td>
                </tr>
            </table>

              </div>
              <div class="tab-pane" id="tab_4">
                <table width="90%" class="table">
                <tr>
                    <td class="left_column" width="15%" valign="middle">Mahasiswa</td>
                    <td>
                    <table width="100%">
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
            </form>

              </div>
              <!-- /.tab-pane -->
              <?php if($this->session->userdata('level') == 5){ ?>
              <div class="tab-pane" id="tab_5">
                <table width="90%" class="table">
                <form  method="post" runat="server" action="<?php echo base_url(); ?>profile/save_data" enctype="multipart/form-data">
                <div class="form-group">
                        <div class="col-xs-12">
                          <div class="col-sm-2">
                              <label for="first_name" ><h5><b>Username</b></h5></label>
                          </div>
                          <div class="col-xs-4">
                              <input type="text" class="form-control" name="username" id="username" value="<?php echo $this->session->userdata('username')?>" title="enter your first name if any." readonly="">
                          </div>
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-xs-12">
                          <div class="col-sm-2">
                              <label for="first_name"><h5 style="font-size: 13.5px"><b>Password Lama</b></h5></label>
                          </div>
                          <div class="col-xs-4">
                              <input type="password" class="form-control" name="password" id="password" placeholder="****" title="enter your first name if any.">
                          </div>
                        </div>
                </div>
                <div class="form-group">
                        <div class="col-xs-12">
                          <div class="col-sm-2">
                              <label for="first_name"><h5><b>Password Baru</b></h5></label>
                          </div>
                          <div class="col-xs-4">
                              <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="****" title="enter your first name if any.">
                          </div>
                        </div>
                </div>
                <div class="form-group" >
                        <br><br><br><br><br><br><br>
                        <div class="col-xs-12">
                          <div class="col-xs-6">
                          <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                          <button class="btn btn-default pull-right" type="reset"><i class="glyphicon glyphicon-repeat"></i> Cancel</button>
                        </div>
                          
                        </div>
                      </div>
                      </form>
                              
                
            </table>
        </div>
        <?php } ?>

              
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
