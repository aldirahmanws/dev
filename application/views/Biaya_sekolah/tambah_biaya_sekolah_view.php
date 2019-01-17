<?php echo $this->session->flashdata('message');
$date = date('Y-m-d');
?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> TAMBAH BIAYA PERKULIAHAN</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  
                  <?php echo form_open('master_biaya_sekolah/save_biaya_sekolah'); ?>
                      <div class="form-group">
                        <label for="email">Id Biaya</label>
                        <input type="text" name="id_biaya" class="form-control" id="id_biaya" placeholder="Masukkan Id Konsentrasi" value="<?= $kodeunik; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="email">Grade</label>
                        <select class="form-control" name="id_grade">
                          <?php 
                              $grade = $this->db->where('tgl_awal_grade <= ', $date )
                                                  ->where('tgl_akhir_grade >= ', $date )
                                                  ->get('tb_grade')
                                                  ->result(); 

                              foreach ($grade as $key) {?>
                                <option value="<?= $key->id_grade ?>"><?= $key->grade ?></option>
                              <?php }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="email">Jenis Biaya</label>
                        <input type="text" name="jenis_biaya" class="form-control" id="jenis_biaya" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="email">Nama Biaya</label>
                        <input type="text" name="nama_biaya" class="form-control" id="nama_biaya" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="email">Jumlah Biaya</label>
                        <input type="number" name="jumlah_biaya" class="form-control" id="jumlah_biaya" placeholder="">
                      </div>

                      <div class="form-group">
                        <label for="email">Waktu Kuliah</label>
                          <select id="id_waktu" name="id_waktu"class="form-control" required="">
                            <option value="">Pilih Waktu</option>
                            <?php 

                                foreach($getWaktu as $row)
                                { 
                                  echo '<option value="'.$row->id_waktu.'">'.$row->waktu.'</option>';
                                }
                            ?>
                          </select>   
                      </div>
                      <div class="form-group">
                        <label for="email">Tahun Akademik</label>
                        <input type="text" name="periode" class="form-control" id="periode" placeholder="ex 2000/2001">
                        <br>

                      <button type="reset" class="btn btn-default btn-flat">Reset</button>
                      <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button>
                     
                  <?php echo form_close();?>
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>