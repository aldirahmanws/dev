
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
              <table id="example1" class="table2 table-hover table-striped table-condensed table-bordered" style="text-transform: uppercase;">
                
                <thead>
                <tr>
                  <th rowspan="2" style="text-align: center;width: 2%">No</th>
                  <th rowspan="2" style="text-align: center;width: 5%">Prodi</th>
                  <th rowspan="2" style="text-align: center;width: 5%">Konsentrasi</th>
                  <th rowspan="2" style="text-align: center;width: 20%">Kode MK</th>
                  <th rowspan="2" style="text-align: center;width: 40%">Nama MK</th>
                  <th rowspan="2" style="text-align: center;width: 2%">Wajib</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Nama Kelas</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Waktu</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Bobot (SKS)</th>
                  <th rowspan="2" style="text-align: center;width: 10%">Total Mahasiswa</th>
                  <th colspan="6" style="text-align: center;width: 15%">Data Terisi</th>
                </tr>
                <tr>
                  <th style="text-align: center;width: 3%">Absensi</th>
                  <th style="text-align: center;width: 3%">Tugas</th>
                  <th style="text-align: center;width: 3%">Paper</th>
                  <th style="text-align: center;width: 3%">UTS</th>
                  <th style="text-align: center;width: 3%">UAS</th>
                  <th style="text-align: center;width: 3%">Nilai Akhir</th>
                </tr>
                 
                </thead>

                <tbody>

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
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
        $('#example1').DataTable( {
            data:           <?= $nilai_perkuliahan; ?>,  
            deferRender:    true,
            scrollCollapse: true,
            scroller:       true,
            "autoWidth": true
        } );
        
    } );
</script>
