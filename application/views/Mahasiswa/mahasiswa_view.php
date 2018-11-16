<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">DATA MAHASISWA</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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
                 
               </form>
                 <hr>   
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                 <a href="<?php echo base_url(); ?>mahasiswa/page_tambah_mahasiswa" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>L/P</th>
                  <th>Waktu</th>
                  <th>Tgl. Lahir </th>
                  <th>Program Studi</th>
                  <th>Status</th>
                  <th>Angkatan</th>
                  <th style="width: 10%">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
               $no = 0;
                foreach ($mahasiswa as $data) {
                  if ($data->id_status == 19) {
                    $status = 'Aktif';}
                    else if ($data->id_status == 1){
                      $status = 'Aktif';
                    } else {
                      $status = $data->status_mhs;
                    }
                  if ($data->id_status != 12) {
                  
                  echo '
                <tr>
                  <td>'.++$no.'</td>
                  <td><a href="'.base_url('mahasiswa/lihat_mahasiswa_dikti/'.$data->id_mahasiswa).'")>'.$data->nama_mahasiswa.'</a></td>
                  <td>'.$data->nim.'</td>
                  <td>'.$data->jenis_kelamin.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.date("d M Y", strtotime($data->tanggal_lahir)).'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$status.'</td>
                  <td>'.substr($data->tgl_du,0,4).'</td>
                  <td>

                  <a href="'.base_url('mahasiswa/detail_mahasiswa_dikti/'.$data->id_mahasiswa).'" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i><span class="tooltiptext">Edit</span></a>
                  <a href="'.base_url('mahasiswa/lihat_mahasiswa_dikti/'.$data->id_mahasiswa).'" class="btn btn-primary btn-xs btn-flat"><i class="fa fa-list"></i><span class="tooltiptext">Detail</span></a>
                    

                  </td>
                  
                </tr>
                ';

                  }
                
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