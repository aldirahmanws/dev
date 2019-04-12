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
                      $grade = $this->db->select('distinct(grade)')->get('tb_grade')->result();
                      foreach ($grade as $key) {
                        if($this->input->get('grade') == $key->grade){
                          $a = 'selected=""';
                        } else {
                          $a = '';
                        }
                        ?>
                        <option value="<?= $key->grade ?>" <?= $a; ?> ><?= $key->grade ?></option>
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
                      $ta = $this->db->select('distinct(periode)')->order_by('periode','desc')->get('tb_biaya')->result();
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

              
                </tbody>
              </table>
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
            - Master biaya kuliah digunakan untuk mengelola data seluruh biaya perkuliahan mulai dari angsuran, administrasi, dan biaya lainnya.

            <br />
            - Setiap tahun akademik baru, finance diwajibkan untuk menginputkan data biaya kuliah.

            <br />

              - Data dibedakan per grade, finance wajib menginputkan data biaya kuliah per grade meskipun harganya sama.
              <br />
             &nbsp; <b>Contoh : Amenities untuk grade A: 800000, grade B: 800000, grade C: 800000. Finance wajib menginput semuanya. </b>
              <br />
              - Data dibedakan per waktu kuliah, finance wajib menginputkan data biaya kuliah per waktu kuliah meskipun harganya sama.
              <br />
              &nbsp; <b> Contoh : Almamater untuk pagi: 200000, sore: 200000. Finance wajib menginput semuanya. </b>
         </div>

         <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
        $('#example1').DataTable( {
            data:           <?= $biaya_kuliah; ?>,  
            deferRender:    true,
            scrollCollapse: true,
            scroller:       true,
            "autoWidth": true
        } );
        
    } );
</script>
      <!-- /.row -->
    </section>
    <script type="text/javascript">
      function filter() {
        var grade = document.getElementById('filter_grade').value;
        var waktu = document.getElementById('filter_waktu').value;
        var ta = document.getElementById('filter_ta').value;
        var jb = document.getElementById('filter_jb').value;
        window.location.href = "<?= base_url(); ?>master_biaya_sekolah/filter?grade="+grade+'&waktu='+waktu+'&ta='+ta+'&jb='+jb;
      }
    </script>