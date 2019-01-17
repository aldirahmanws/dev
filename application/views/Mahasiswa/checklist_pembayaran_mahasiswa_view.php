           <?php 
                if($this->session->userdata('level') == 5){ 
                  $id_mahasiswa = $mahasiswa->id_mahasiswa; $semester_aktif = $mahasiswa->semester_aktif?>

        <!-- <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi">Prestasi</a> -->
        
           <?php } else { ?>
           
        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa"><i class="fa fa-angle-left"></i> Back</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->nik; ?>">History Pendidikan</a>
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
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>mahasiswa/checklist_pembayaran/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->id_prodi; ?>">Pembayaran</a>
        
         <br/><br/>  
           <?php }           ?>
        <div class="box box-info">
        <div class="box-body">
        <table class="table" style="text-transform: uppercase;">
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
              <h3 class="box-title">Tabel Angsuran </h3>
          

               <a class="pull-right" href="<?php echo base_url(); ?>mahasiswa/riwayat_pembayaran/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->id_prodi; ?>"><button type="button" class="btn btn-warning pull-right">
                 Riwayat Pembayaran
              </button>
              </a>

              <br>
              <br> 
      

            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%">No</th>
                  <th>Jenis Biaya</th>
                  <th>Jenis Biaya</th>
                  <th>Lunas</th>
                </tr>
                </thead>
                <tbody> 

                  <?php if ($mahasiswa->semester_aktif == 1 OR $mahasiswa->semester_aktif == 2) { ?>
                
                <tr>
                  <td>1</td>
                  <td>Angsuran Tahun 1</td>
                  <td>Angsuran 1</td>
                  <td><?php if ($a11 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Angsuran Tahun 1</td>
                  <td>Angsuran 2</td>
                  <td><?php if ($a12 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Angsuran Tahun 1</td>
                  <td>Angsuran 3</td>
                  <td><?php if ($a13 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Angsuran Tahun 1</td>
                  <td>Angsuran 4</td>
                  <td><?php if ($a14 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Angsuran Tahun 1</td>
                  <td>Angsuran 5</td>
                  <td><?php if ($a15 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Angsuran Tahun 1</td>
                  <td>Angsuran 6</td>
                  <td><?php if ($a16 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Angsuran Tahun 1</td>
                  <td>Angsuran 7</td>
                  <td><?php if ($a17 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Angsuran Tahun 1</td>
                  <td>Angsuran 8</td>
                  <td><?php if ($a18 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Angsuran Tahun 1</td>
                  <td>Angsuran 9</td>
                  <td><?php if ($a19 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>

              <?php } else if ($mahasiswa->semester_aktif == 3 OR $mahasiswa->semester_aktif == 4) { ?>
               

                <tr>
                  <td>1</td>
                  <td>Angsuran Tahun 2</td>
                  <td>Angsuran 1</td>
                  <td><?php if ($a21 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Angsuran Tahun 2</td>
                  <td>Angsuran 2</td>
                  <td><?php if ($a22 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Angsuran Tahun 2</td>
                  <td>Angsuran 3</td>
                  <td><?php if ($a23 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Angsuran Tahun 2</td>
                  <td>Angsuran 4</td>
                  <td><?php if ($a24 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Angsuran Tahun 2</td>
                  <td>Angsuran 5</td>
                  <td><?php if ($a25 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Angsuran Tahun 2</td>
                  <td>Angsuran 6</td>
                  <td><?php if ($a26 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Angsuran Tahun 2</td>
                  <td>Angsuran 7</td>
                  <td><?php if ($a27 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Angsuran Tahun 2</td>
                  <td>Angsuran 8</td>
                  <td><?php if ($a28 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Angsuran Tahun 2</td>
                  <td>Angsuran 9</td>
                  <td><?php if ($a29 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>

              <?php } else if ($mahasiswa->semester_aktif == 5 OR $mahasiswa->semester_aktif == 6) { ?>

                <tr>
                  <td>1</td>
                  <td>Angsuran Tahun 3</td>
                  <td>Angsuran 1</td>
                  <td><?php if ($a31 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Angsuran Tahun 3</td>
                  <td>Angsuran 2</td>
                  <td><?php if ($a32 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Angsuran Tahun 3</td>
                  <td>Angsuran 3</td>
                  <td><?php if ($a33 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Angsuran Tahun 3</td>
                  <td>Angsuran 4</td>
                  <td><?php if ($a34 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Angsuran Tahun 3</td>
                  <td>Angsuran 5</td>
                  <td><?php if ($a35 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Angsuran Tahun 3</td>
                  <td>Angsuran 6</td>
                  <td><?php if ($a36 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Angsuran Tahun 3</td>
                  <td>Angsuran 7</td>
                  <td><?php if ($a37 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Angsuran Tahun 3</td>
                  <td>Angsuran 8</td>
                  <td><?php if ($a38 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Angsuran Tahun 3</td>
                  <td>Angsuran 9</td>
                  <td><?php if ($a39 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>

              <?php } else if($mahasiswa->semester_aktif == 7 OR $mahasiswa->semester_aktif == 8)  { ?>
                <tr>
                  <td>1</td>
                  <td>Angsuran Tahun 4</td>
                  <td>Angsuran 1</td>
                  <td><?php if ($a41 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Angsuran Tahun 4</td>
                  <td>Angsuran 2</td>
                  <td><?php if ($a42 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Angsuran Tahun 4</td>
                  <td>Angsuran 3</td>
                  <td><?php if ($a43 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Angsuran Tahun 4</td>
                  <td>Angsuran 4</td>
                  <td><?php if ($a44 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Angsuran Tahun 4</td>
                  <td>Angsuran 5</td>
                  <td><?php if ($a45 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Angsuran Tahun 4</td>
                  <td>Angsuran 6</td>
                  <td><?php if ($a46 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Angsuran Tahun 4</td>
                  <td>Angsuran 7</td>
                  <td><?php if ($a47 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Angsuran Tahun 4</td>
                  <td>Angsuran 8</td>
                  <td><?php if ($a48 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Angsuran Tahun 4</td>
                  <td>Angsuran 9</td>
                  <td><?php if ($a49 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>

              <?php } else if ($mahasiswa->semester_aktif == 9 OR $mahasiswa->semester_aktif == 10) { ?>
                  
                <tr>
                  <td>1</td>
                  <td>Angsuran Tahun 5</td>
                  <td>Angsuran 1</td>
                  <td><?php if ($a51 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Angsuran Tahun 5</td>
                  <td>Angsuran 2</td>
                  <td><?php if ($a52 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Angsuran Tahun 5</td>
                  <td>Angsuran 3</td>
                  <td><?php if ($a53 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Angsuran Tahun 5</td>
                  <td>Angsuran 4</td>
                  <td><?php if ($a54 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Angsuran Tahun 5</td>
                  <td>Angsuran 5</td>
                  <td><?php if ($a55 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Angsuran Tahun 5</td>
                  <td>Angsuran 6</td>
                  <td><?php if ($a56 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Angsuran Tahun 5</td>
                  <td>Angsuran 7</td>
                  <td><?php if ($a57 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Angsuran Tahun 5</td>
                  <td>Angsuran 8</td>
                  <td><?php if ($a58 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Angsuran Tahun 5</td>
                  <td>Angsuran 9</td>
                  <td><?php if ($a59 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>

              <?php } else if ($mahasiswa->semester_aktif == 11 OR $mahasiswa->semester_aktif == 12) { ?>
                  
                <tr>
                  <td>1</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 1</td>
                  <td><?php if ($a61 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 2</td>
                  <td><?php if ($a62 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 3</td>
                  <td><?php if ($a63 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 4</td>
                  <td><?php if ($a64 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 5</td>
                  <td><?php if ($a65 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 6</td>
                  <td><?php if ($a66 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 7</td>
                  <td><?php if ($a67 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 8</td>
                  <td><?php if ($a68 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 9</td>
                  <td><?php if ($a69 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>

              <?php } else { ?>
                  
                <tr>
                  <td>1</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 1</td>
                  <td><?php if ($a71 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 2</td>
                  <td><?php if ($a72 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 3</td>
                  <td><?php if ($a73 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 4</td>
                  <td><?php if ($a74 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 5</td>
                  <td><?php if ($a75 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 6</td>
                  <td><?php if ($a76 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>7</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 7</td>
                  <td><?php if ($a77 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>8</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 8</td>
                  <td><?php if ($a78 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
                <tr>
                  <td>9</td>
                  <td>Angsuran Tahun 6</td>
                  <td>Angsuran 9</td>
                  <td><?php if ($a79 != null) { echo '<i class="fa fa-check"> ';} else { echo '';} ?></td>
                </tr>
              <?php } ?>

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
       <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" class="validate[required] text-input"  size="40" style="width: 90%;" value="<?php echo $mahasiswa->id_mahasiswa; ?>">
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

    