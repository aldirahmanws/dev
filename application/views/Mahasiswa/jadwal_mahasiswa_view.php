           <?php 
                if($this->session->userdata('id_mahasiswa') != null){ ?>
      
        
           <?php } else {
           $id_mahasiswa = $mahasiswa->id_mahasiswa;?>

        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $mahasiswa->id_mahasiswa; ?>">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>">KRS Mahasiswa</a>
         <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/jadwal_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>">Jadwal Kuliah</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan/<?php echo $mahasiswa->id_mahasiswa; ?>">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $mahasiswa->id_mahasiswa; ?>">Prestasi</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa">Kembali</a>
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
            <td>: <?php echo $mahasiswa->angkatan; ?>           </td>
        </tr>
        <tr>
            <td class="left_column">Periode </td>
            <td colspan="3">: <?php 
             echo $periode->semester;?></td>
        </tr>
                <tr>
            <!-- <td class="left_column">Kelas </td>
            
            <input type="text" name="kelas" id="kelas" class="text-input"> -->
            <td colspan="3">
            
                
            
                        </td>
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
              <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th  style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:30%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($senin as $i) {
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:50%">'.$i->nama_matkul.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
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
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:15%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($selasa as $i) {
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:50%">'.$i->nama_matkul.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
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
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:15%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($rabu as $i) {
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:50%">'.$i->nama_matkul.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
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
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:15%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($kamis as $i) {
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:50%">'.$i->nama_matkul.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
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
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:5%">No</th>
                  <th style="width:50%">Nama Matkul</th>
                  <th style="width:30%">Waktu</th>
                  <th style="width:15%">Kelas/Ruang</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                foreach ($jumat as $i) {
                            
                  echo '
                  
                <tr>
                  <td style="width:5%">'.++$no.'</td>
                  <td style="width:50%">'.$i->nama_matkul.'</td>
                  <td style="width:30%">'.substr($i->jam_awal,0,-3).' - '.substr($i->jam_akhir,0,-3).'</td>
                  <td style="width:15%">'.$i->nama_kelas.' / '.$i->nama_ruang.'</td>
                ' ;
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
    <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
            - Fitur ini di gunakan untuk menampilkan dan mengelola KRS per mahasiswa pada periode berlaku
            <br />
            - Fitur ini cocok di gunakan apabila sumber data yang digunakan adalah daftar KRS per mahasiswa
            <br />
            - Bila sumber data yang digunakan adalah daftar absensi , silahkan ke menu <a href="http://10.10.0.4:8082/kelaskuliah">[ Kelas Perkuliahan ]</a>            <br />
            - Untuk menambahkan Kelas yang di tawarkan, silahkan ke menu <a href="http://10.10.0.4:8082/kelaskuliah">[ Kelas Perkuliahan ]</a>          <br />
            - Anda dapat menambahkan KRS secara kolektif pada mahasiswa ini, klik pada 
            <a style="cursor:pointer" onclick="return showKelas(this)" title="Menampilkan Kelas yang ditawarkan">[ KRS Kolektif ]</a>
            <br />
            
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