   
<?php echo $this->session->flashdata('message');?>
<?php if ($this->session->userdata('level') != 2) { ?>
          <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>master_dosen"><i class="fa fa-angle-left"></i> Back</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/detail_dosen/<?php echo $dosen->id_dosen; ?>">Profil</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/jadwal_dosen/<?php echo $dosen->id_dosen; ?>">Jadwal</a>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>master_dosen/nilai_dosen/<?php echo $dosen->id_dosen; ?>">Input Nilai</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/aktivitas_mengajar/<?php echo $dosen->id_dosen; ?>">Aktivitas Mengajar</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/jabatan_fungsional/<?php echo $dosen->id_dosen; ?>">Jabatan Fungsional</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/pendidikan/<?php echo $dosen->id_dosen; ?>">Pendidikan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/pelatihan/<?php echo $dosen->id_dosen; ?>">Pelatihan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/sertifikasi/<?php echo $dosen->id_dosen; ?>">Sertifikasi</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/penelitian/<?php echo $dosen->id_dosen; ?>">Penelitian</a>
         <br/><br/> 
          <?php } ?>
      
       
            
            <!-- /.box-header -->
            


         <div class="box">
        <section class="content">
      <div class="row">
        
          
            <div class="box-header">
                   
            <!-- /.box-header -->
            <div class="box-body">

              <div class="table-responsive">
               <table id="example3" class="table2 table-bordered table-striped">
                
                <thead>
                <tr>
                  <th rowspan="2" style="text-align: center;width: 2%">No</th>
                  <th rowspan="2" style="text-align: center;">Prodi</th>
                  <th rowspan="2" style="text-align: center;">Konsentrasi</th>
                  <th rowspan="2" style="text-align: center;">Kode MK</th>
                  <th rowspan="2" style="text-align: center;">Nama MK</th>
                  <th rowspan="2" style="text-align: center;">Kelas</th>
                  <th rowspan="2" style="text-align: center;">Waktu</th>
                  <th rowspan="2" style="text-align: center;">Bobot (SKS)</th>
                  <th rowspan="2" style="text-align: center;">Total Mahasiswa</th>
                  <th colspan="5" style="text-align: center;">Data Terisi</th>
                </tr>
                <tr>
                  <th style="text-align: center;width: 3%">Absensi</th>
                  <th style="text-align: center;width: 3%">Nilai Tugas</th>
                  <th style="text-align: center;width: 3%">Nilai UTS</th>
                  <th style="text-align: center;width: 3%">Nilai UAS</th>
                  <th style="text-align: center;width: 3%">Nilai Akhir</th>
                </tr>
                 
                </thead>

                <tbody>

                <?php 
                $no = 0;
                 $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($nilai as $data) {                
                  $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE id_kp = '$data->id_kp'")->row();
                  $total_nilai = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_d != 0 AND id_kp = '$data->id_kp'")->row();
                  $absensi = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE absensi != 0 AND id_kp = '$data->id_kp'")->row();
                  $nilai_tugas = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_tugas != 0 AND id_kp = '$data->id_kp'")->row();
                  $nilai_uts = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uts != 0 AND id_kp = '$data->id_kp'")->row();
                  $nilai_uas = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uas != 0 AND id_kp = '$data->id_kp'")->row();
                  

                  echo '                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td><a href="'.base_url('nilai_perkuliahan/detail_nilai/'.$data->id_kp.'/'.$dosen->id_dosen).'">'.$data->id_matkul.'</a></td>
                  <td>'.$data->nama_matkul.'</td>
                  <td>'.$data->nama_kelas.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->bobot_matkul.'</td>
                  <td>'.$total_mahasiswa->total.'</td>
                  <td>'.$absensi->total.'</td>
                  <td>'.$nilai_tugas->total.'</td>
                  <td>'.$nilai_uts->total.'</td>
                  <td>'.$nilai_uas->total.'</td>
                  <td>'.$total_nilai->total.'</td>
                  
                  </tr>
                ' ;
                
                
              }
              ?>
        
                </tbody>
              </table>
              </div>

            </div>
            <!-- /.box-body -->
      

         
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
    
   
    </div>

     <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
            - Digunakan untuk menginputkan nilai mahasiswa aktif pada semester ini (Klik kode mata kuliah untuk membuka data nilai).
            <br />
            - Data terisi digunakan untuk mendata jumlah nilai yang sudah diinput oleh user.
            <br />
            
         </div>
          <!-- nav-tabs-custom -->
    
        <!-- /.col -->
