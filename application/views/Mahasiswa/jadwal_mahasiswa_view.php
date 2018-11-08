           <?php 
                if($this->session->userdata('level') == 5){ ?>
      
        
           <?php } else {
           $id_mahasiswa = $mahasiswa->id_mahasiswa;?>
        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa"><i class="fa fa-angle-left"></i> Back</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>">Detail Mahasiswa</a>
       <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->nik; ?>">History Pendidikan</a>
        <?php if ($mahasiswa->id_jenis_pendaftaran == '2') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/transfer_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">Nilai Transfer</a>
        <?php } ?>

        <?php if ($mahasiswa->asal_pt == 1 OR $mahasiswa->asal_pt == '') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>/<?php echo $mahasiswa->id_konsentrasi; ?>">KRS Mahasiswa</a>
        <?php } else { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/kelas_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">KRS Mahasiswa</a>
        <?php } ?> 
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>mahasiswa/jadwal_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">Jadwal Kuliah</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">History Nilai</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan/<?php echo $mahasiswa->id_mahasiswa; ?>">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $mahasiswa->id_mahasiswa; ?>">Prestasi</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/checklist_pembayaran/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->id_prodi; ?>">Pembayaran</a>
      
         <br/><br/>  
           <?php }           ?>
        <div class="box box-info">
        <div class="box-body">
              <table class="table">
        <tr>
            <td width="15%" class="left_column">NIM</td>
            <td>: <?php echo $mahasiswa->nim; ?></td>
            <td width="15%" class="left_column">Nama</td>
            <td>: <?php echo $mahasiswa->nama_mahasiswa; ?></td>
        </tr>
        <tr>
            <td class="left_column" width="15%">Program Studi</td>
            <td width="35%">: <?php echo $mahasiswa->nama_prodi; ?>            </td>
            <td class="left_column" width="15%">Angkatan</td>
            <td>: <?php echo substr($mahasiswa->tgl_du,0,4); ?>           </td>
        </tr>
        <tr>
           <td class="left_column" width="15%">Periode</td>
            <td width="35%">: <?php echo $periode->semester; ?>            </td>
             <td class="left_column" width="15%">Semester</td>
            <td>: <?php 
             echo $mahasiswa->semester_aktif;?></td>
        </tr>
               

        </table>
            </div>
            <!-- /.box-body -->
          </div>
        <div class="box">
        <section class="content">
      <div class="row">
        
          
            <div class="box-header">
              <h3 class="box-title">Senin</h3>       
            <!-- /.box-header -->
            <div class="box-body">
              <table  class="table table-bordered table-striped" style="text-transform: uppercase;">
                <thead>
                <tr>
                  <th  style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:20%">Dosen</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:15%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($senin as $i) {
                  if ($i->id_periode == $periode->id_periode) {
                  
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:30%">'.$i->nama_matkul.'</td>
                  <td style="width:20%">'.$i->nama_dosen.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
              }
                }   
              
            ?>
                </tbody>
              </table>

            </div>
            <!-- /.box-body -->
          </div>

          <div class="box-header">
              <h3 class="box-title">Selasa</h3>       
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" style="text-transform: uppercase;">
                <thead>
                 <tr>
                  <th  style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:20%">Dosen</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:15%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($selasa as $i) {
                  if ($i->id_periode == $periode->id_periode) {
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:30%">'.$i->nama_matkul.'</td>
                  <td style="width:20%">'.$i->nama_dosen.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
                  }
                }    
              
            ?>
                </tbody>
              </table>

            </div>
            <!-- /.box-body -->
          </div>

          <div class="box-header">
              <h3 class="box-title">Rabu</h3>       
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" style="text-transform: uppercase;">
                <thead>
                 <tr>
                  <th  style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:20%">Dosen</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:15%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($rabu as $i) {
                  if ($i->id_periode == $periode->id_periode) {
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:30%">'.$i->nama_matkul.'</td>
                  <td style="width:20%">'.$i->nama_dosen.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
                  }
                }   
              
            ?>
                </tbody>
              </table>

            </div>
            <!-- /.box-body -->
          </div>

          <div class="box-header">
              <h3 class="box-title">Kamis</h3>       
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" style="text-transform: uppercase;">
                <thead>
                 <tr>
                  <th  style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:20%">Dosen</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:15%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($kamis as $i) {
                  if ($i->id_periode == $periode->id_periode) {
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:30%">'.$i->nama_matkul.'</td>
                  <td style="width:20%">'.$i->nama_dosen.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
                  }
                }   
              
            ?>
                </tbody>
              </table>

            </div>
            <!-- /.box-body -->
          </div>

          <div class="box-header">
              <h3 class="box-title">Jumat</h3>       
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped" style="text-transform: uppercase;">
                <thead>
                 <tr>
                  <th  style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:20%">Dosen</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:15%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($jumat as $i) {
                  if ($i->id_periode == $periode->id_periode) {
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:30%">'.$i->nama_matkul.'</td>
                  <td style="width:20%">'.$i->nama_dosen.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
                 }
                }   
              
            ?>
                </tbody>
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
    

   

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
 <script>
       document.getElementById("nama_matkul").style.visibility = 'visible';

    jQuery(document).ready(function($){
    $('#nama_matkul').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete_kp', 
      minLength:1,
      select: function(event, ui){
        $('#nama_matkul').val(ui.item.label);
        $('#id_kp2').val(ui.item.id);
      }
    });    
  });

  </script>