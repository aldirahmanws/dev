           <?php echo $this->session->flashdata('message');?>
           <?php 
                if($this->session->userdata('level') == 5){ ?>
        <!-- <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi">Prestasi</a> -->
        
           <?php } else {
          ?>
           

         <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa"><i class="fa fa-angle-left"></i> Back</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->nik; ?>">History Pendidikan</a>
       <?php if ($mahasiswa->id_jenis_pendaftaran == '2') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/transfer_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">Nilai Transfer</a>
        <?php } ?>

        <?php if ($mahasiswa->asal_pt == 1 OR $mahasiswa->asal_pt == '' OR $mahasiswa->asal_pt == ' ') { ?>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>/<?php echo $mahasiswa->id_konsentrasi; ?>">KRS Mahasiswa</a>
        <?php } else { ?>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>mahasiswa/kelas_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">KRS Mahasiswa</a>
        <?php } ?> 
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/jadwal_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">Jadwal Kuliah</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">History Nilai</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan/<?php echo $mahasiswa->id_mahasiswa; ?>">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $mahasiswa->id_mahasiswa; ?>">Prestasi</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/checklist_pembayaran/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->id_prodi; ?>">Pembayaran</a>
         <br/><br/>  
           <?php }           ?>
      
          
          
        <div class="box">
        <section class="content" >
          
          
      <div class="row">
        
          
            <div class="box-header">
              <h3 class="box-title">
              Data KRS yang anda ambil semester <?php echo $mahasiswa->semester_aktif; ?></h3>

            
            
            <!-- /.box-header -->
            <div class="box-body">
              <p class="btn btn-warning pull-right btn-flat" onclick="print1()"> Cetak </p> <br><br><br>
              <table class="table2 table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">No</th>
                  <th style="width: 15%; text-align: center;">Kode Matkul</th>
                  <th style="width: 35%; text-align: center;">Mata Kuliah</th>
                  <th style="width: 5%; text-align: center;">Beban Kredit</th>
                  <th style="width: 35%; text-align: center;">Nama Dosen</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $totalbobot = 0;
                if ($mahasiswa->id_status == '1') {
                foreach ($kelas as $i) {

                  $totalbobot += $i->bobot_matkul;
                  echo '
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$i->id_matkul.'</td>
                  <td>'.$i->nama_matkul.'</td>
                  <td>'.$i->bobot_matkul.'</td>
                  <td>'.$i->nama_dosen.'</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td><i>'.$i->matkul_english.'</i></td>
                  <td></td>
                  <td></td>
                </tr>
                ' ;
              
            }
          } 
            ?>
            
            
                </tbody>
              </table>
              
              
              
                  
              
          
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

       
        
       
        
        
        <!-- /.col -->
      
      <!-- /.row -->
    </section>

    <section class="content" id="ea" style="display: none">
          
          
      <div class="row">
        
          
            <div class="box-header">
              <h3 class="box-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>KARTU RENCANA STUDY</b> <br>
              <br>
              <br></h3>

             <IMG src="<?php echo base_url(); ?>uploads/jiclogo.png" class="pull-right">
              <div>
                <table>
                  <tr>
                    <td style="width: 100px">&nbsp;&nbsp;&nbsp;&nbsp;Nama</td>
                    <td>: <?php echo $mahasiswa->nama_mahasiswa; ?></td>
                  </tr>
                  <tr>
                    <td style="width: 100px">&nbsp;&nbsp;&nbsp;&nbsp;NIM</td>
                    <td>: <?php echo $mahasiswa->nim; ?></td>
                  </tr>
                  <tr>
                    <td style="width: 100px">&nbsp;&nbsp;&nbsp;&nbsp;Program Studi</td>
                    <td>: <?php echo $mahasiswa->nama_prodi; ?></td>
                  </tr>
                  <tr>
                    <td style="width: 100px">&nbsp;&nbsp;&nbsp;&nbsp;Semester</td>
                    <td>: <?php echo $mahasiswa->semester_aktif; ?></td>
                  </tr>
                  <tr>
                    <td style="width: 100px">&nbsp;&nbsp;&nbsp;&nbsp;TA</td>
                    <td>: <?php echo $periode->semester; ?></td>
                  </tr>
                  

                </table>
        
          </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table2 table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">No</th>
                  <th style="width: 15%; text-align: center;">Kode Matkul</th>
                  <th style="width: 35%; text-align: center;">Mata Kuliah</th>
                  <th style="width: 5%; text-align: center;">Beban Kredit</th>
                  <th style="width: 35%; text-align: center;">Nama Dosen</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $totalbobot = 0;
                if ($mahasiswa->id_status == '1') {
                foreach ($kelas as $i) {
                  if ($i->id_periode == $periode->id_periode) {
              
                  $totalbobot += $i->bobot_matkul;
                  echo '
                <tr>
                  <td style="text-align:center">'.++$no.'</td>
                  <td style="text-align:center">'.$i->id_matkul.'</td>
                  <td>'.$i->nama_matkul.'</td>
                  <td style="text-align:center">'.$i->bobot_matkul.'</td>
                  <td>'.$i->nama_dosen.'</td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td>'.$i->matkul_english.'</td>
                  <td></td>
                  <td></td>
                </tr>
                ' ;
              }
            }
          } 
            ?>
            
            
                </tbody>
              </table>
              <div>
              <br>
              Beban Kredit : <?php echo $totalbobot; ?> <br> <br>
              Mengetahui &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jakarta, <?php echo date('d-M-Y'); ?><br>
              Pembimbing Akademik &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mahasiswa<br><br><br><br><br>
              <table  style="width: 100%">
                <tr>
                 <td><?php echo $this->session->userdata('username'); ?></td>
                <td style="text-align: right; padding-right:30px"><?php echo $mahasiswa->nama_mahasiswa; ?></td>
                </tr>
              </table>
               </div>
              
              
                  
              
          
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

       
        
       
        
        
        <!-- /.col -->
      
      <!-- /.row -->
    </section>

   
    
   
    </div>

    <script>
    function print1(){
      //document.getElementById("ngok").style.display = "block";
      //document.getElementById("ngoks").style.display = "block";
      //document.getElementById("ngoks1").style.display = "block";
     var printContents = document.getElementById("ea").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents; 
    }
  </script>

   

        