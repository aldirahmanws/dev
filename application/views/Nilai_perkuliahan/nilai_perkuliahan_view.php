
<?php echo $this->session->flashdata('message');?>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">DATA NILAI PERKULIAHAN</h3>
            </div>
            <div class="box-body">
              <table class="">
                <tbody>
                  <form method="get" action="<?php echo base_url("nilai_perkuliahan/filter_kp/")?>">
                  <tr>
                    <th>Filter</th>
                  </tr>
                  <tr>                                                                    
                    <td>Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                      <select name="id_prodi">
                        <option value="">-- Semua --</option>
                        <?php 

                                        foreach($getProdi as $row)
                                        { 
                                          echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                        }
                                    ?>
                      </select>

                    </td>                                            
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semester</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="id_periode" id="id_periode2">
                        <option value="">-- Semua --</option>
                        <?php 

                                        foreach($getPeriode2 as $row)
                                        { 
                                          echo '<option value="'.$row->semester.'">'.$row->semester.'</option>';
                                        }
                                    ?>
              
                      </select>
                    </td>
                    <td>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary btn-xs btn-flat" value="Cari">  
                    </td>

                  </tr>
                  
                </tbody>
              </table>
                      
               </form>
               <br>
              <div class="table-responsive">
              <table id="example3" class="table2 table-hover table-striped table-condensed table-bordered" style="text-transform: uppercase;">
                
                <thead>
                <tr>
                  <th rowspan="2" style="text-align: center;width: 2%">No</th>
                  <th rowspan="2" style="text-align: center;width: 5%">Prodi</th>
                  <th rowspan="2" style="text-align: center;width: 20%">Kode MK</th>
                  <th rowspan="2" style="text-align: center;width: 40%">Nama MK</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Nama Kelas</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Waktu</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Bobot (SKS)</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Total Mahasiswa</th>
                  <th colspan="6" style="text-align: center;width: 15%">Data Terisi</th>
                </tr>
                <tr>
                  <th style="text-align: center;width: 3%">Absensi</th>
                  <th style="text-align: center;width: 3%">Nilai Tugas</th>
                  <th style="text-align: center;width: 3%">Nilai Paper</th>
                  <th style="text-align: center;width: 3%">Nilai UTS</th>
                  <th style="text-align: center;width: 3%">Nilai UAS</th>
                  <th style="text-align: center;width: 3%">Nilai Akhir</th>
                </tr>
                 
                </thead>

                <tbody>

                <?php 
                $no = 0;
                 $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($kp as $data) {                
                  $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE id_kp = '$data->id_kp'")->row();
                  $total_nilai = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_d != 0 AND id_kp = '$data->id_kp'")->row();
                  $absensi = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE absensi != 0 AND id_kp = '$data->id_kp'")->row();
                  $nilai_tugas = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_tugas != 0 AND id_kp = '$data->id_kp'")->row();
                  $nilai_uts = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uts != 0 AND id_kp = '$data->id_kp'")->row();
                  $nilai_uas = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uas != 0 AND id_kp = '$data->id_kp'")->row();
                  $nilai_paper = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE nilai_uas != 0 AND id_kp = '$data->id_kp'")->row();
                  

                  echo '                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td><a href="'.base_url('nilai_perkuliahan/detail_nilai/'.$data->id_kp).'">'.$data->id_matkul.'</a></td>
                  <td>'.$data->nama_matkul.'</td>
                  <td>'.$data->nama_kelas.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->bobot_matkul.'</td>
                  <td>'.$total_mahasiswa->total.'</td>
                  <td>'.$absensi->total.'</td>
                  <td>'.$nilai_tugas->total.'</td>
                  <td>'.$nilai_paper->total.'</td>
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
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="callout callout-info">

      <strong>Keterangan :</strong>
            <br />
         - Nilai perkuliahan digunakan untuk mengolah data nilai perkuliahan mahasiswa.
         <br />

         - Nilai yang ditampilkan hanya nilai yang aktif pada periode atau semester ini.

         <br>

         - Untuk melihat nilai perkuliahan pada periode sebelumnya, gunakan fitur filter.

         <br>

         - Klik kode mata kuliah untuk melihat data nilai mahasiswa pada mata kuliah tersebut.



         </div>
      <!-- /.row -->
    </section>
    
<script type="text/javascript">
            function get_prodi_periode2(p) {
                var id_prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>mahasiswa/get_prodi_periode2/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_periode2").html(msg);
                    }
                });
            }
</script>
