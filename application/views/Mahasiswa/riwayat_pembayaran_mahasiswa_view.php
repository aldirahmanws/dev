           <?php 
                if($this->session->userdata('level') == 5){ 
                  $id_mahasiswa = $this->uri->segment(3); $semester_aktif = $mahasiswa->semester_aktif?>

        <!-- <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi">Prestasi</a> -->
        
           <?php } else { ?>
           

          <?php if ($mahasiswa->tanggal_keluar == '0000-00-00' OR $mahasiswa->tanggal_keluar == NULL) { ?>
                          <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa"><i class="fa fa-angle-left"></i> Back</a>
                       <?php } else { ?>
                        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_ld"><i class="fa fa-angle-left"></i> Back</a>
                       <?php } ?> 
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $this->uri->segment(3); ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $this->uri->segment(3); ?>/<?php echo $mahasiswa->nik; ?>">History Pendidikan</a>
        <?php if ($mahasiswa->id_jenis_pendaftaran == '2') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/transfer_nilai/<?php echo $this->uri->segment(3); ?>">Nilai Transfer</a>
        <?php } ?>
        <?php if ($mahasiswa->tanggal_keluar == '0000-00-00' OR $mahasiswa->tanggal_keluar == NULL) { ?>
        <?php if ($mahasiswa->asal_pt == 1 OR $mahasiswa->asal_pt == '' OR $mahasiswa->asal_pt == ' ') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $this->uri->segment(3) ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>/<?php echo $mahasiswa->id_konsentrasi; ?>">KRS Mahasiswa</a>
        <?php } else { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/kelas_mhs/<?php echo $this->uri->segment(3) ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">KRS Mahasiswa</a>
        <?php } ?> 
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/jadwal_mhs/<?php echo $this->uri->segment(3) ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">Jadwal Kuliah</a>
      <?php } ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $this->uri->segment(3); ?>">History Nilai</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan/<?php echo $this->uri->segment(3); ?>">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $this->uri->segment(3); ?>">Prestasi</a>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>mahasiswa/checklist_pembayaran/<?php echo $this->uri->segment(3); ?>/<?php echo $mahasiswa->id_prodi; ?>">Pembayaran</a>
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
            <td class="left_column" width="15%">Peringkat / Grade</td>
            <td width="35%">: <?php echo $mahasiswa->grade; ?>            </td>
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
              <h3 class="box-title">Riwayat Pembayaran</h3>
          

              <!-- <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah Matkul Mengulang
              </button>
              <br>
              <br> -->
      

            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Tanggal</th>
                  <th>Jenis Biaya</th>
                  <th>Nama Biaya</th>
                  <th>Biaya</th>
                  <th>Diskon</th>
                  <th>Denda</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                  $no = 0;
                foreach ($riwayat as $i) {
                   if ($i->jenis_biaya == 'Angsuran Tahun 1'){
                    $iae = $i->jumlah_biaya;
                    $iea = $i->jumlah_biaya  - $i->potongan + $i->denda;
                  } else if($i->jenis_biaya == 'KRS'){
                    $iae = $i->jumlah_biaya * $i->bobot_matkul;
                    $iea = ($i->jumlah_biaya * $i->bobot_matkul)   - $i->potongan + $i->denda;
                    $i->nama_biaya = $i->nama_biaya.' - '.$i->kode_matkul;
                  }  else if($i->jenis_biaya == 'Angsuran Tahun 2' or $i->jenis_biaya == 'Angsuran Tahun 3' or $i->jenis_biaya == 'Angsuran Tahun 4' or $i->jenis_biaya == 'Angsuran Tahun 5' or $i->jenis_biaya == 'Angsuran Tahun 6' or $i->jenis_biaya == 'Angsuran Tahun 7' or $i->jenis_biaya == 'Angsuran Tahun 8' or $i->jenis_biaya == 'Angsuran Tahun 9'){
                    $iae = $i->jumlah_biaya;
                    $iea = $i->jumlah_biaya - $i->potongan + $i->denda;
                  } else {
                    $iae = $i->jumlah_biaya;
                    $iea = $i->jumlah_biaya   - $i->potongan + $i->denda;
                  }

                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.date("d M Y", strtotime($i->tanggal_pembayaran)).'</td>
                  <td>'.$i->jenis_biaya.'</td>
                  <td>'.$i->nama_biaya.'</td>
                  <td style="text-align:right">'.number_format($iae, 2, ",", ".").'</td>
                  <td style="text-align:right">'.number_format($i->potongan, 2, ",", ".").'</td>
                  <td style="text-align:right">'.number_format($i->denda, 2, ",", ".").'</td>
                  <td style="text-align:right">'.number_format($iea, 2, ",", ".").'</td>
                </tr>
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
       <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" class="validate[required] text-input"  size="40" style="width: 90%;" value="<?php echo $this->uri->segment(3); ?>">
       <input type="hidden" name="semester_aktif" id="semester_aktif" class="validate[required] text-input"  size="40" style="width: 90%;" value="<?php echo $mahasiswa->semester_aktif; ?>">
      </td>
      <input type="hidden" name="id_kp" id="id_kp2" class="validate[required] text-input"  size="5" style="width: 90%;">
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

        