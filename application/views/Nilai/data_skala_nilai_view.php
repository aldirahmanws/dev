<?php echo $this->session->flashdata('message');?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">DATA SKALA NILAI</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="">
                <tbody>
                  <form method="get" action="<?php echo base_url("nilai/filter_nilai/")?>">
                  <tr>
                    <th>Filter</th>
                  </tr>
                  <tr>                                                                    
                    <td>Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
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
                    <td>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary btn-flat btn-xs" value="Cari">  
                    </td>
                  </tr>
                   </form>
                </tbody>
              </table>
              <br>
               <a href="<?php echo base_url(); ?>nilai/tambah_skala_nilai" class="btn btn-primary  btn-sm btn-flat"><i class="fa fa-plus"></i> Tambah Skala Nilai</a>
              
              <br>
              <br>
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Program Studi</th>
                  <th>Nilai Huruf</th>
                  <th>Nilai Indeks</th>
                  <th>Bobot Minimum</th>
                  <th>Bobot Maksimum</th>
                  <th>Tgl MulaiEfektif</th>
                  <th>Tgl Akhir Efektif</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
               $no = 0;
                foreach ($nilai as $data) {
                  
                  echo '
                <tr>
                  <td>'.++$no.'</td>
                  <td><a href="'.base_url('nilai/lihat_skala_nilai/'.$data->id_skala_nilai).'")>'.$data->nama_prodi.'</a></td>
                  <td>'.$data->nilai_huruf.'</td>
                  <td>'.$data->nilai_indeks.'</td>
                  <td>'.$data->bobot_nilai_minimum.'</td>
                  <td>'.$data->bobot_nilai_maksimum.'</td>
                  <td>'.date("d M Y", strtotime($data->tanggal_mulai_efektif)).'</td>
                  <td>'.date("d M Y", strtotime($data->tanggal_akhir_efektif)).'</td>
                  <td>
                    <a href="'.base_url('nilai/detail_skala_nilai/'.$data->id_skala_nilai).'" class="btn btn-warning  btn-xs btn-flat"><i class="fa fa-pencil"></i><span class="tooltiptext">Edit</span></a>

                     <a href="'.base_url('nilai/hapus_skala_nilai/'.$data->id_skala_nilai).'" class="btn btn-danger  btn-xs btn-flat"><i class="fa fa-trash"></i><span class="tooltiptext">Hapus</span></a>

                  </td>
                  
                </tr>
                ';
                
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
      </div>
      <!-- /.row -->
    </section>