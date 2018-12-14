<form  method="post" action="<?php echo base_url(); ?>nilai/save_edit_skala_nilai/<?php echo $nilai->id_skala_nilai; ?>" enctype="multipart/form-data">
  <?php echo $this->session->flashdata('message');?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Detail Skala Nilai</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  
                 
                          <div class="form-group">
                            <label>Program Studi</label>
                               <select name="id_prodi" class="form-control select2" style="width: 100%;" required="">
                              <option value="<?php echo $nilai->id_prodi; ?>"><?php echo $nilai->nama_prodi; ?></option>
                                  <?php 

                                        foreach($getProdi as $row)
                                        { 
                                          echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                        }
                                    ?>
                            </select>
                       
                      </div>
                       <div class="form-group">
                        <label for="email">Nilai Huruf</label>
                        <input type="text" name="nilai_huruf" class="form-control" id="nilai_huruf" placeholder="A / A-"  required value="<?php echo $nilai->nilai_huruf; ?>">
                      </div>
                       <div class="form-group">
                        <label for="email">Nilai Indeks</label>
                        <input type="text" name="nilai_indeks" class="form-control" id="nilai_indeks" placeholder="3.8 / 4" value="<?php echo $nilai->nilai_indeks; ?>">
                      </div>
                       <div class="form-group">
                        <label for="email">Bobot Nilai Minimum</label>
                        <input type="text" name="bobot_nilai_minimum" class="form-control" id="bobot_nilai_minimum" placeholder="87 / 87.8" value="<?php echo $nilai->bobot_nilai_minimum; ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                       <div class="form-group">
                        <label for="email">Bobot Nilai Maksimum</label>
                        <input type="text" name="bobot_nilai_maksimum" class="form-control" id="bobot_nilai_maksimum" placeholder="92 / 92.4" value="<?php echo $nilai->bobot_nilai_maksimum; ?>">
                      </div>
                       <div class="form-group">
                        <label for="email">Tanggal Mulai Efektif</label>
                        <input type="date" name="tanggal_mulai_efektif" class="form-control" id="tanggal_mulai_efektif" placeholder="Masukkan Tanggal" value="<?php echo $nilai->tanggal_mulai_efektif; ?>">
                      </div>
                       <div class="form-group">
                        <label for="email">Tanggal Akhir Efektif</label>
                        <input type="date" name="tanggal_akhir_efektif" class="form-control" id="tanggal_akhir_efektif" placeholder="Masukkan Tanggal" value="<?php echo $nilai->tanggal_akhir_efektif; ?>">
                      </div>
                      <br>
                      <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-save"></i> Update</button>
                      
                  </form>
                </div>
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>