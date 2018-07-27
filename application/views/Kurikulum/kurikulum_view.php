      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kurikulum</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <a class="btn btn-info btn-sm" href="" data-toggle="modal" data-target="#modal_view"><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2">Nama Kurikulum</th>
                  <th rowspan="2">Program Studi</th>
                  <th rowspan="2">Mulai Berlaku</th>
                  <th colspan="3">Aturan Jumlah SKS</th>
                  <th colspan="2">Jumlah SKS Kuliah</th>
                  <th rowspan="2">Aksi</th>
                </tr>
                  <th>Lulus</th>
                  <th>Wajib</th>
                  <th>Pilhan</th>
                  <th>Wajib</th>
                  <th>Pilihan</th>
                </thead>

                <tbody>

                <?php 
                $no = 0;
                foreach ($kurikulum as $data) {

                  
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td><a href="'.base_url('kurikulum/detail_kurikulum/'.$data->id_kurikulum).'">'.$data->nama_kurikulum.'</a></td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->semester.'</td>
                  <td>'.$data->jumlah_sks.'</td>
                  <td>'.$data->bobot_matkul_wajib.'</td>
                  <td>'.$data->bobot_matkul_pilihan.'</td>
                  <td>'.$bobot.'</td>
                  <td>'.$data->bobot_matkul_wajib.'</td>
                  <td></td>

                ' ;
                
                
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
    
        <div class="modal fade" id="modal_view" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Kurikulum</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('kurikulum/simpan_kurikulum'); ?>
                      <table class="table">
                         <tr>
            <td class="left_column">Nama Kurikulum <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_kurikulum" id="nama_kurikulum" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required=""></td>
        </tr> 
        <tr>
            <td class="left_column">Program Studi <font color="#FF0000">*</font></td>
            <td>:  <select name="id_prodi" id="id_prodi" class="validate[required]" required="">
            <option value="">Pilih Prodi</option>   
                    <?php 

                  foreach($getProdi as $row)
                  { 
                    echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                  }
                  ?>
              </select>

        </td>
        </tr>
        <tr>
            <td class="left_column">Mulai Berlaku <font color="#FF0000">*</font></td>
            <td>:  <select name="id_periode" id="id_periode" class="validate[required]" required="">
            <option value="">Pilih Semester</option>   
                    <?php 

                  foreach($getPeriode as $row)
                  { 
                    echo '<option value="'.$row->id_periode.'">'.$row->semester.'</option>';
                  }
                  ?>
              </select>

        </td>
        </tr>
        <tr>
            <td class="left_column">Jumlah SKS</td>
            <td>: 
            <input type="text" name="jumlah_sks" id="jumlah_sks" class="text-input" maxlength="2" size="2" readonly style="width:10%; background-color:#E0E0E0" value="0">            <font color="#999999"><em> ( sks Jumlah bobot mata kuliah wajib + sks Jumlah bobot mata kuliah pilihan)</em></font>
            </td>
        </tr>
        <tr>
            <td class="left_column">Jumlah Bobot Mata Kuliah Wajib (sks)</td>
            <td>: 
            <input type="text" name="bobot_matkul_wajib" id="bobot_matkul_wajib" class="text-input" maxlength="2" size="2" style="width:10%" value="0" onkeyup="sum();">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Jumlah Bobot Mata Kuliah Pilihan (sks)</td>
            <td>: 
            <input type="text" name="bobot_matkul_pilihan" id="bobot_matkul_pilihan" class="text-input" maxlength="2" size="2"  style="width:10%" value="0" onkeyup="sum();">         
            </td>
        </tr>
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info">Simpan</button></td>
                  </tr>
              <?php echo form_close();?>

                        </table>

                    </div>

                </div>
            </div>
            </div>
        </div>

<script>
function sum() {
      var bobot_matkul_wajib = document.getElementById('bobot_matkul_wajib').value;
      var bobot_matkul_pilihan = document.getElementById('bobot_matkul_pilihan').value;
      var result = parseInt(bobot_matkul_wajib) + parseInt(bobot_matkul_pilihan);
      if (!isNaN(result)) {
         document.getElementById('jumlah_sks').value = result;
      }
}
</script>


    

