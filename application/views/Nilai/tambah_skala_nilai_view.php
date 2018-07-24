<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Tambah Skala Nilai</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  <?php echo $this->session->flashdata('message');?>
                  <?php echo form_open('nilai/save_skala_nilai'); ?>
                          <div class="form-group">
                            <label>Program Studi</label>
                               <select name="id_prodi" class="form-control select2" style="width: 100%;" required="">
                              <option value=""> -- Pilih Prodi -- </option>
                                  <?php 

                                        foreach($drop_down_prodi as $row)
                                        { 
                                          echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                        }
                                    ?>
                            </select>
                       
                      </div>
                       <div class="form-group">
                        <label for="email">Nilai Huruf</label>
                        <input type="text" name="nilai_huruf" class="form-control" id="nilai_huruf" placeholder="A / A-"  required>
                      </div>
                       <div class="form-group">
                        <label for="email">Nilai Indeks</label>
                        <input type="text" name="nilai_indeks" class="form-control" id="nilai_indeks" placeholder="3.8 / 4">
                      </div>
                       <div class="form-group">
                        <label for="email">Bobot Nilai Minimum</label>
                        <input type="text" name="bobot_nilai_minimum" class="form-control" id="bobot_nilai_minimum" placeholder="87 / 87.8">
                      </div>
                    </div>
                    <div class="col-lg-6">
                       <div class="form-group">
                        <label for="email">Bobot Nilai Maksimum</label>
                        <input type="text" name="bobot_nilai_maksimum" class="form-control" id="bobot_nilai_maksimum" placeholder="92 / 92.4">
                      </div>
                       <div class="form-group">
                        <label for="email">Tanggal Mulai Efektif</label>
                        <input type="date" name="tanggal_mulai_efektif" class="form-control" id="tanggal_mulai_efektif" placeholder="Masukkan Tanggal">
                      </div>
                       <div class="form-group">
                        <label for="email">Tanggal Akhir Efektif</label>
                        <input type="date" name="tanggal_akhir_efektif" class="form-control" id="tanggal_akhir_efektif" placeholder="Masukkan Tanggal">
                      </div>
                      <br>
                      <button type="submit" class="btn btn-info pull-right">Tambah</button>
                      
                  <?php echo form_close();?>
                </div>
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>