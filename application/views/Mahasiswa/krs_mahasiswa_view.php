           <?php 
                if($this->session->userdata('level') == 5){ 
                  $id_mahasiswa = $mahasiswa->id_mahasiswa; $semester_aktif = $mahasiswa->semester_aktif?>

        <!-- <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi">Prestasi</a> -->
        
           <?php } else {
           $id_mahasiswa = $mahasiswa->id_mahasiswa; $semester_aktif = $mahasiswa->semester_aktif?>
           
        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa"><i class="fa fa-angle-left"></i> Back</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->nik; ?>">History Pendidikan</a>
        <?php if ($mahasiswa->id_jenis_pendaftaran == '2') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/transfer_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">Nilai Transfer</a>
        <?php } ?>

       <?php if ($mahasiswa->asal_pt == 1 OR $mahasiswa->asal_pt == '' OR $mahasiswa->asal_pt = ' ') { ?>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>/<?php echo $mahasiswa->id_konsentrasi; ?>">KRS Mahasiswa</a>
        <?php } else { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/kelas_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">KRS Mahasiswa</a>
        <?php } ?> 
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/jadwal_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">Jadwal Kuliah</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">History Nilai</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan/<?php echo $mahasiswa->id_mahasiswa; ?>">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $mahasiswa->id_mahasiswa; ?>">Prestasi</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/checklist_pembayaran/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->id_prodi; ?>">Pembayaran</a>
        
         <br/><br/>  
           <?php }           ?>
        <div class="box box-info">
        <div class="box-body">
              <table class="table" >
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
              <h3 class="box-title">Data KRS</h3>
              <?php if($mahasiswa->semester_aktif == 3 AND 5 AND 7) { ?>

              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah Matkul Mengulang
              </button>
              <br>
              <br>
            <?php } ?>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Prodi</th>
                  <th>Kode Matkul</th>
                  <th>Nama Matkul</th>
                  <th>SKS</th>
                  <th>Dosen</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
                $id_kp = '';
                $id_detail_kurikulum = '';
                if ($mahasiswa->id_status != '1') {
                foreach ($krs as $i) {
                  if ($i->nama_konsentrasi == 'Semua' OR $i->id_konsentrasi == $mahasiswa->id_konsentrasi AND $periode->id_periode == $i->id_periode) { if ($i->waktu == $mahasiswa->waktu) {
                    
                  
                       
                  $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE id_kp = '$i->id_kp'")->row();
                  if(date('Y-m-d') > $i->tgl_mulai AND date('Y-m-d') < $i->tgl_akhir){
                  if ($total_mahasiswa->total < $i->kapasitas) {
                   $id_kp .= $i->id_kp.',';
                   $id_detail_kurikulum .= $i->id_detail_kurikulum.',';         
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$i->nama_prodi.'</td>
                  <td>'.$i->id_matkul.'</td>
                  <td>'.$i->nama_matkul.'</td>
                  <td>'.$i->bobot_matkul.'</td>
                  <td>'.$i->nama_dosen.'</td>
                </tr>
                ' ;
                  
                }   
              } else {
                echo '
                 <tr>
                    <td colspan="6"> Waktu mengisi KRS '.$i->nama_matkul.' sudah berakhir. Segera hubungi akademik!</td>
                  </tr>
                ';
              }
              } }
            }
          } else {
            echo '
              <td colspan="6"> Anda sudah mengisi KRS</td>
            ';
          }
            ?>
                </tbody>
              </table>

            </div>
            <?php echo form_open('mahasiswa/simpan_krs_mhs/'.$mahasiswa->id_prodi.'/'.$mahasiswa->semester_aktif.'/'.$periode->id_periode);?>
              <input type="hidden" class="form-control" id="id_mahasiswa" name="id_mahasiswa" value="<?php echo $id_mahasiswa ?>">
              <input type="hidden" class="form-control" id="semester_aktif" name="semester_aktif" value="<?php echo $semester_aktif ?>">
               <input type="hidden" class="form-control" id="id_kp" name="id_kp" value="<?php echo $id_kp ?>">
               <input type="hidden" class="form-control" id="id_detail_kurikulum" name="id_detail_kurikulum" value="<?php echo $id_detail_kurikulum ?>">
               
               <?php
               if ($mahasiswa->id_status != '1' ) { echo ' 
              <button type="submit"  class="btn btn-success">Simpan</button> ';
            } 
                 ?>
 <?php echo form_close();?>
              <?php 
              if ($mahasiswa->id_status == '1') { echo '
              <br>
              <a href="'.base_url('mahasiswa/kelas_mhs/'.$mahasiswa->id_mahasiswa.'/'.$mahasiswa->id_prodi.'/'.$mahasiswa->semester_aktif).'" class="btn btn-warning btn-flat btn-sm pull-right">Lihat KRS Semester Ini</a>
              ';
            } ?>

             
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
            - Bila sumber data yang digunakan adalah daftar absensi , silahkan ke menu [ Kelas Perkuliahan ]           <br />
            - Untuk menambahkan Kelas yang di tawarkan, silahkan ke menu [ Kelas Perkuliahan ]          <br />
           
            <br />
            
    </div>

    <div class="modal fade" id="modal-default" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Matkul Mengulang</h3>
                <h4 class="modal-title" id="myModalLabel2">Untuk semester <?php echo $mahasiswa->semester_aktif; ?></h4>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('mahasiswa/simpan_krs_mengulang/'.$mahasiswa->id_prodi.'/'.$mahasiswa->semester_aktif); ?>
                      <table class="table">
        <tr>
          <td class="left_column">Masukan Matkul <font color="#FF0000">*</font>
            </td>
          <td colspan="15">: 
      <input type="text" name="nama_matkul" id="nama_matkul" class="validate[required] text-input"  size="40" style="width: 90%;" required="">
       <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" class="validate[required] text-input"  size="40" style="width: 90%;" value="<?php echo $mahasiswa->id_mahasiswa; ?>">
       <input type="hidden" name="semester_aktif" id="semester_aktif" class="validate[required] text-input"  size="40" style="width: 90%;" value="<?php echo $mahasiswa->semester_aktif; ?>">
      </td>
      <input type="hidden" name="id_kp" id="id_kp2" class="validate[required] text-input"  size="5" style="width: 90%;">
      <input type="hidden" name="id_detail_kurikulum" id="id_detail_kurikulum2" class="validate[required] text-input"  style="width: 90%;">
        </tr> 
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info">Simpan</button></td>
                  </tr>
              <?php echo form_close();?>

                        </table>

                    </div>

                </div>
            </div>
            </div>
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
        $('#id_detail_kurikulum2').val(ui.item.idk);
        $('#id_kp2').val(ui.item.id);
      }
    });    
  });

  </script>


