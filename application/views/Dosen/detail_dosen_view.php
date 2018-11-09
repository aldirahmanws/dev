           <?php 
               if($this->session->userdata('level') == 2){ ?>
    
        
           <?php } else { ?>
         <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>master_dosen"><i class="fa fa-angle-left"></i> Back</a>
         <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>master_dosen/detail_dosen/<?php echo $dosen->id_dosen; ?>">Profil</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/jadwal_dosen/<?php echo $dosen->id_dosen; ?>">Jadwal</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/nilai_dosen/<?php echo $dosen->id_dosen; ?>">Input Nilai</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/aktivitas_mengajar/<?php echo $dosen->id_dosen; ?>">Aktivitas Mengajar</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/jabatan_fungsional/<?php echo $dosen->id_dosen; ?>">Jabatan Fungsional</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/pendidikan/<?php echo $dosen->id_dosen; ?>">Pendidikan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/pelatihan/<?php echo $dosen->id_dosen; ?>">Pelatihan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/sertifikasi/<?php echo $dosen->id_dosen; ?>">Sertifikasi</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/penelitian/<?php echo $dosen->id_dosen; ?>">Penelitian</a>
       
         <br/><br/> 
           <?php }

           ?>
      <?php echo $this->session->flashdata('message');?>
        <div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table" style="text-transform: uppercase;">
        <tr>

            <td width="15%" class="left_column"><b>Nama</b> <font color="#FF0000">*</font></td>
            <td>:
               <?php echo $dosen->nama_dosen; ?> </td>
      
            <td class="left_column"><b>Tanggal Lahir</b> <font color="#FF0000">*</font></td>
            <td>:  <?php echo date("d M Y", strtotime($dosen->tgl_lahir)); ?>
                                  
            <input type="hidden" name="stat_pd" value="A">
            </td>

        </tr>
        <tr>
            <td class="left_column" width="15%" value=><b>Jenis Kelamin</b> <font color="#FF0000">*</font></td>
            <td width="35%">: <?php echo $dosen->jenis_kelamin; ?>        </td>
            <td class="left_column" width="15%"><b>Agama</b> <font color="#FF0000">*</font></td>
            <td>:
                <?php echo $dosen->agama; ?>                           </td>
        </tr>
        
        </table>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_0" data-toggle="tab">PROFIL</a></li>
            <?php if($this->session->userdata('level') == 2){ ?>
            <li><a href="#tab_1" data-toggle="tab">Ganti Password</a></li>
          <?php } ?>
              <!--<li><a href="#tab_4" data-toggle="tab">Kebutuhan Khusus</a></li> -->
             
                        <a class="btn btn-warning btn-flat pull-right" href="<?php echo base_url();?>master_dosen/page_edit_dosen/<?php echo $dosen->id_dosen; ?>"><i class="fa fa-pencil"></i> EDIT PROFIL</a>
              
              
            </ul>



            <div class="tab-content">

                 <div class="tab-pane active" id="tab_0">
                <table width="90%" class="table" style="text-transform: uppercase;">
                
                <tr>
                    <td class="left_column" width="15%">NIP</td>
                    <td colspan="6">:  <?php echo $dosen->nip; ?>
                    </td>

                    <?php if($this->session->userdata('level') == 2){ ?>
                    <td rowspan="8" width="15%">
                      <form  method="post" runat="server" action="<?php echo base_url(); ?>profile/save_data" enctype="multipart/form-data">
                        <div class="btn btn-file" >
              <img src="<?php echo base_url();?>uploads/<?php echo $dosen->foto; ?>" onerror="this.src='<?php echo base_url();?>uploads/user.jpg'" id="avatar" height="200" width="200"  alt="avatar">
              <input type="file" id="foto" name="foto" onchange="loadFile(event)">

            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
          </form></td>
            <?php } else { ?>
          <td rowspan="8" width="15%">
                      
                        <div class="btn btn-file" >
              <img src="<?php echo base_url();?>uploads/<?php echo $dosen->foto; ?>" onerror="this.src='<?php echo base_url();?>uploads/user.jpg'" id="avatar" height="200" width="200"  alt="avatar">
              

            </div>
          </td>
            <?php } ?>
                </tr>
                <tr>
                    <td class="left_column" width="15%">NIDN/NUP/NIDK</td>
                    <td colspan="6" size="100">: <?php echo $dosen->id_dosen; ?></td>
                </tr>
                 <tr>
                    <td class="left_column" width="15%">Email</td>
                    <td colspan="6" size="100">: <?php echo $dosen->email; ?></td>
                </tr>
                 <tr>
                    <td class="left_column" width="15%">No. Telepon</td>
                    <td colspan="6" size="100">: <?php echo $dosen->no_hp; ?></td>
                </tr>
                 <tr>
                    <td class="left_column" width="15%">Jenis Dosen</td>
                    <td colspan="6" size="100">: <?php echo $dosen->status_dosen; ?></td>
                </tr>
                <tr>
                    <td class="left_column" width="15%">Status</td>
                    <td colspan="6" size="100">: <?php echo $dosen->status_mhs; ?></td>
                </tr>
                 <tr>
                    <td class="left_column" width="15%">Alamat</td>
                    <td colspan="6" size="100">: <?php echo $dosen->alamat; ?></td>
                </tr>
                
            </table>

              </div>

               <div class="tab-pane" id="tab_1">
                <table width="90%" class="table" style="text-transform: uppercase;">
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
              
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
    <script>
    function loadFile(event) {
                var output = document.getElementById('avatar');
                output.src = URL.createObjectURL(event.target.files[0]);
            }
</script>
        <!-- /.col -->
