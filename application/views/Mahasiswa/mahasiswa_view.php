<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Mahasiswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="">
                <tbody>
                  <tr>
                    <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Filter</th>
                  </tr>
                  <tr>                                                                    
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="kota">
                        <option value="">-- PILIH --</option>
                        <option value="010100">KAB. KEPULAUAN SERIBU</option>
                        <option value="016000">KOTA JAKARTA PUSAT</option>
                        <option value="016100">KOTA JAKARTA UTARA</option>
                        <option value="016200">KOTA JAKARTA BARAT</option>
                      </select>
                    </td>                                            
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="kota">
                        <option value="">-- PILIH --</option>
                        <option value="010100">KAB. KEPULAUAN SERIBU</option>
                        <option value="016000">KOTA JAKARTA PUSAT</option>
                        <option value="016100">KOTA JAKARTA UTARA</option>
                        <option value="016200">KOTA JAKARTA BARAT</option>
                      </select>
                    </td>                                              
                  </tr>
                  <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="kota">
                        <option value="">-- PILIH --</option>
                        <option value="010100">KAB. KEPULAUAN SERIBU</option>
                        <option value="016000">KOTA JAKARTA PUSAT</option>
                        <option value="016100">KOTA JAKARTA UTARA</option>
                        <option value="016200">KOTA JAKARTA BARAT</option>
                      </select>
                    </td>           
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="kota">
                        <option value="">-- PILIH --</option>
                        <option value="010100">KAB. KEPULAUAN SERIBU</option>
                        <option value="016000">KOTA JAKARTA PUSAT</option>
                        <option value="016100">KOTA JAKARTA UTARA</option>
                        <option value="016200">KOTA JAKARTA BARAT</option>
                      </select>
                    </td>                                                         
                  </tr>
                </tbody>
              </table>
              <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>L/P</th>
                  <th>Agama</th>
                  <th>Tanggal Lahir </th>
                  <th>Program Studi</th>
                  <th>Status</th>
                  <th>Angkatan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
               
                foreach ($mahasiswa as $data) {
                  echo '
                  
                <tr>
                  <td>'.$data->nim.'</td>
                  <td>'.$data->nama_du.'
                  </td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->tanggal_du.'</td>
                  <td>
                       <a href="'.base_url('mahasiswa/detail_mahasiswa/'.$data->id_du).'" class="btn btn-info btn-sm">Detail</a>

                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
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