<?php echo $this->session->flashdata('message');?>
<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">BIAYA PERKULIAHAN</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table width="100%">
                <tr>
                  <th><i class="fa fa-filter"></i> Filter:</th>
                </tr>
                <tr>
                  <td>Grade</td>
                  <td>
                    <select id="filter_grade">
                      <option value="">-- Semua --</option>
                      <?php 
                      $grade = $this->db->get('tb_grade')->result();
                      foreach ($grade as $key) {
                        if($this->input->get('grade') == $key->id_grade){
                          $a = 'selected=""';
                        } else {
                          $a = '';
                        }
                        ?>
                        <option value="<?= $key->id_grade ?>" <?= $a; ?> ><?= $key->grade ?></option>
                      <?php }
                      ?>
                    </select>
                  </td>
                  <td>Waktu</td>
                  <td>
                    <select id="filter_waktu">
                      <option value="">-- Semua --</option>
                      <?php 
                      $waktu = $this->db->get('tb_waktu')->result();
                      foreach ($waktu as $key) {
                        if($this->input->get('waktu') == $key->id_waktu){
                          $a = 'selected=""';
                        } else {
                          $a = '';
                        }
                        ?>
                        <option value="<?= $key->id_waktu ?>" <?= $a ?> ><?= $key->waktu ?></option>
                      <?php }
                      ?>
                    </select>
                  </td>
                  <td>Tahun Akademik</td>
                  <td>
                    <select id="filter_ta">
                      <option value="">-- Semua --</option>
                      <?php 
                      $ta = $this->db->select('distinct(periode)')->get('tb_biaya')->result();
                      foreach ($ta as $key) {
                        if($this->input->get('ta') == $key->periode){
                          $a = 'selected=""';
                        } else {
                          $a = '';
                        }
                        ?>
                        <option value="<?= $key->periode ?>" <?= $a ?>><?= $key->periode ?></option>
                      <?php }
                      ?>
                    </select>
                  </td>
                  <td>Jenis Biaya</td>
                  <td>
                    <select id="filter_jb">
                      <option value="">-- Semua --</option>
                      <?php 
                      $ta = $this->db->select('distinct(jenis_biaya)')->get('tb_biaya')->result();
                      foreach ($ta as $key) {
                        if($this->input->get('jb') == $key->jenis_biaya){
                          $a = 'selected=""';
                        } else {
                          $a = '';
                        }
                        ?>
                        <option value="<?= $key->jenis_biaya ?>" <?= $a ?>><?= $key->jenis_biaya ?></option>
                      <?php }
                      ?>
                    </select>
                  </td>
                  <td><button class="btn btn-primary btn-flat" onclick="filter()">Cari</button></td>
                </tr>
              </table>
              </div>
              <br>
              <table id="example1" class="table table-striped table-condensed table-hover" style="text-transform: uppercase;">
              <a href="<?php echo base_url() ?>master_biaya_sekolah/page_tambah_biaya_sekolah" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Biaya</th>
                  <th>Grade</th>
                  <th>Jenis Biaya</th>
                  <th>Nama Biaya</th>
                  <th>Jumlah Biaya</th>
                  <th>Tahun Akademik</th>
                  <th>Waktu Kuliah</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin mengapus data ini ?'";
                foreach ($data_biaya as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_biaya.'
                  </td>
                  <td>'.$data->grade.'
                  </td>
                  <td>'.$data->jenis_biaya.'</td>
                  <td>'.$data->nama_biaya.'</td>
                  <td>'.$data->jumlah_biaya.'</td>
                  <td>'.$data->periode.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>
                    <a href="'.base_url('master_biaya_sekolah/edit_biaya_sekolah/'.$data->id_biaya).'" class="btn btn-warning btn-xs btn-flat" ><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>
                    <a href="'.base_url('master_biaya_sekolah/hapus_biaya/'.$data->id_biaya).'" class="btn btn-danger btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>
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
    <script type="text/javascript">
      function filter() {
        var grade = document.getElementById('filter_grade').value;
        var waktu = document.getElementById('filter_waktu').value;
        var ta = document.getElementById('filter_ta').value;
        var jb = document.getElementById('filter_jb').value;
        window.location.href = "<?= base_url(); ?>master_biaya_sekolah?grade="+grade+'&waktu='+waktu+'&ta='+ta+'&jb='+jb;
      }
    </script>