       <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA KURIKULUM</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
              <table id="example3" class="table2 table-hover table-striped table-condensed table-bordered" style="text-transform: uppercase;">
                <a class="btn btn-primary btn-sm btn-flat" href="" data-toggle="modal" data-target="#modal_view"><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th rowspan="2" style="vertical-align : middle;">No</th>
                  <th rowspan="2" style="vertical-align : middle;">Nama Kurikulum</th>
                  <th rowspan="2" style="vertical-align : middle;">Program Studi</th>
                  <th rowspan="2" style="vertical-align : middle;">Berlaku Pada Angkatan</th>
                  <th colspan="3">Aturan Jumlah SKS</th>
                  <th rowspan="2" style="vertical-align : middle;">Aksi</th>
                </tr>
                  <th>Lulus</th>
                  <th>Wajib</th>
                  <th>Pilhan</th>
                </thead>

                <tbody>

                <?php 
                $no = 0;
                 $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($kurikulum as $data) {
                  $jumlah_sks = $data->bobot_matkul_wajib + $data->bobot_matkul_pilihan;
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td><a href="'.base_url('kurikulum/detail_kurikulum/'.$data->id_kurikulum).'">'.$data->nama_kurikulum.'</a></td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->ang_awal.' - '.$data->ang_akhir.'</td>
                  <td>'.$jumlah_sks.'</td>
                  <td>'.$data->bobot_matkul_wajib.'</td>
                  <td>'.$data->bobot_matkul_pilihan.'</td>
                  <td>
                        <a href="'.base_url('kurikulum/detail_kurikulum2/'.$data->id_kurikulum).'" class="btn btn-warning  btn-xs btn-flat"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>
                        <a href="'.base_url('kurikulum/hapus_kurikulum/'.$data->id_kurikulum).'" class="btn btn-danger  btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>
 
                  </td>

                ' ;
                
                
              }
              ?>
        
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
            <td>:  <select name="id_prodi" id="id_prodi" class="validate[required]" required="" onchange="return get_prodi_periode(this.value)" onblur="return get_concentrate(this.value)">
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
            <td class="left_column">Berlaku dari Angkatan</td>
            <td>: 
            <input type="number" name="ang_awal" id="ang_awal" class="text-input" style="width:30%" placeholder="ex: 2010" required="">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Berakhir pada Angkatan</td>
            <td>: 
            <input type="number" name="ang_akhir" id="ang_akhir" class="text-input" style="width:30%" placeholder="ex: 2013" required="">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Jumlah SKS</td>
            <td>: 
            <input type="text" name="jumlah_sks" id="jumlah_sks" class="text-input" readonly style="width:10%; background-color:#E0E0E0" value="0">            <font color="#999999"><em> ( sks Jumlah bobot mata kuliah wajib + sks Jumlah bobot mata kuliah pilihan)</em></font>
            </td>
        </tr>
        <tr>
            <td class="left_column">Jumlah Bobot Mata Kuliah Wajib (sks)</td>
            <td>: 
            <input type="text" name="bobot_matkul_wajib" id="bobot_matkul_wajib" class="text-input" style="width:10%" value="0" onkeyup="sum();">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Jumlah Bobot Mata Kuliah Pilihan (sks)</td>
            <td>: 
            <input type="text" name="bobot_matkul_pilihan" id="bobot_matkul_pilihan" class="text-input"   style="width:10%" value="0" onkeyup="sum();">         
            </td>
        </tr>
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info btn-flat">Simpan</button></td>
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