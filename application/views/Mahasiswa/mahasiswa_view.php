<?php echo $this->session->flashdata('message');?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">DATA MAHASISWA</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table width="100%">
                <tbody>
                  <form method="get" action="<?php echo base_url("mahasiswa/filter_mahasiswa/")?>">
                  <tr>
                    <th><i class="fa fa-filter"></i> Filter:</th>
                  </tr>
                  <tr>                                                                    
                    <td style="padding-right: 20px;">Program Studi</td>     
                    <td style="padding-right: 30px;">
                      
                      <select name="id_prodi">
                        <option value="">-- Semua --</option>
                        <?php 

                                        foreach($drop_down_prodi as $row)
                                        { 
                                          echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                        }
                                    ?>
                      </select>

                    </td>                                            
                    <td  style="padding-right: 20px;">Agama</td>     
                    <td style="padding-right: 30px;">
                      <select name="id_agama">
                        <option value="">-- Semua --</option>
                        <option value="1">Islam</option>
                              <option value="2">Katholik</option>
                              <option value="3">Kristen</option>
                              <option value="4">Hindu</option>
                              <option value="5">Budha</option>
                              <option value="6">Konghucu</option>
                      </select>
                    </td>
                    <td style="padding-right: 20px;">Jenis Kelamin</td>     
                    <td style="padding-right: 30px;">
                      <select name="id_kelamin">
                        <option value="">-- Semua --</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </td>           
                    <td style="padding-right: 20px;">Angkatan</td>     
                    <td style="padding-right: 80px;">
                      <select name="angkatan">
                        <option value="">-- Semua --</option>
                         <?php 

                            foreach($getTahunAngkatan as $row)
                            { 
                              echo '<option value="'.$row->tgl_du.'">'.$row->tgl_du.'</option>';
                            }
                            ?>
                      </select>   
                    </td>                
                    <td style="padding-left: : 50px;">
                     <input type="submit" class="btn btn-primary btn-flat btn-sm pull-right" value="Cari">
                    </td>

                  </tr>
                </tbody>
              </table>
              </div>
                 
               </form>
                 <hr>   
                 <div class="table-responsive">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                 <a href="<?php echo base_url(); ?>mahasiswa/page_tambah_mahasiswa" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID MHS</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>L/P</th>
                  <th>Waktu</th>
                  <th>Prodi</th>
                  <th>Konsentrasi</th>
                  <th>Status</th>
                  <th>Angkatan</th>
                  <th>SMT</th>
                  <th>Grade</th>
                  <th style="width: 10%">Aksi</th>
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
      <!-- /.row -->
    </section>

    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
        $('#example1').DataTable( {
            data:           <?= $mahasiswa; ?>,  
            deferRender:    true,
            scrollCollapse: true,
            scroller:       true,
            "autoWidth": true
        } );
        
    } );
</script>