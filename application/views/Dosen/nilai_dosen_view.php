           <?php 
                if($this->session->userdata('level') == 2){ ?>
       
        
           <?php } else { ?>

         <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>master_dosen"><i class="fa fa-angle-left"></i> Back</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/detail_dosen/<?php echo $dosen->id_dosen; ?>">Profil Dosen</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/jadwal_dosen/<?php echo $dosen->id_dosen; ?>">Jadwal Dosen</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/nilai_dosen/<?php echo $dosen->id_dosen; ?>">Input Nilai</a>
         <br/><br/> 
           <?php }

           ?>
      <?php echo $this->session->flashdata('message');?>
       
            
            <!-- /.box-header -->
            


         <div class="box">
        <section class="content">
      <div class="row">
        
          
            <div class="box-header">
                   
            <!-- /.box-header -->
            <div class="box-body">
               <table id="example3" class="table2 table-bordered table-striped">
                
                <thead>
                <tr>
                  <th rowspan="2" style="text-align: center;width: 2%">No</th>
                  <th rowspan="2" style="text-align: center;width: 5%">Prodi</th>
                  <th rowspan="2" style="text-align: center;width: 20%">Kode MK</th>
                  <th rowspan="2" style="text-align: center;width: 40%">Nama MK</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Nama Kelas</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Bobot (SKS)</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Total Mahasiswa</th>
                  <th colspan="5" style="text-align: center;width: 15%">Data Terisi</th>
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
                  <td><a href="'.base_url('nilai_perkuliahan/detail_nilai/'.$data->id_kp.'/'.$dosen->id_dosen).'">'.$data->id_matkul.'</a></td>
                  <td>'.$data->nama_matkul.'</td>
                  <td>'.$data->nama_kelas.'</td>
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
            <!-- /.box-body -->
      

         
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
    
   
    </div>
          <!-- nav-tabs-custom -->
    
        <!-- /.col -->
