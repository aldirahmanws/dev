      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">JADWAL PERKULIAHAN</h3>
            </div>
            <div class="box-body">
              <table class="table-responsive">
                <tbody>
                  <form method="get" action="<?php echo base_url("jadwal/filter_jadwal/")?>">
                  <tr>
                    <th>Filter</th>
                  </tr>
                  <tr>                                                                    
                    <td>Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                      <select name="id_prodi">
                        <option value="">-- Semua --</option>
                        <?php 

                                        foreach($getProdi as $row)
                                        { 
                                          echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                        }
                                    ?>
                      </select>

                    </td>                                            
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semester</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="semester" id="semester">
                        <option value="">-- Semua --</option>
                          <?php 

                                        foreach($getPeriode2 as $row)
                                        { 
                                          echo '<option value="'.$row->semester.'">'.$row->semester.'</option>';
                                        }
                                    ?>
                      </select>
                    </td>
                    <td>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary btn-xs btn-flat" value="Cari">  
                    </td>

                  </tr>
                  
                </tbody>
              </table>
                      
               </form>
               <br>

    
              <div class="table-responsive">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
             

               <a class="btn btn-primary btn-sm btn-flat" href="" data-toggle="modal" data-target="#modal_view"><i class="fa fa-plus"></i> Tambah Jadwal</a>

               <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Prodi</th>
                  <th>Konsentrasi</th>
                  <th>Mata Kuliah</th>
                  <th>Hari</th>
                  <th>Waktu</th>
                  <th>Sesi</th>
                  <th>Ruang</th>
                  <th>Semester</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($jadwal as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td><a href="" data-toggle="modal" data-target="#modal_lihat'.$data->id_jadwal.'">'.$data->nama_matkul.'</a></td>
                  <td>'.$data->hari.'</td>
                  <td>'.substr($data->jam_awal,0,-3).' - '.substr($data->jam_akhir,0,-3).'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->nama_ruang.'</td>
                  <td>'.$data->semester.'</td>
                  <td> 
                  <a href="'.base_url('jadwal/detail_jadwal/'.$data->id_jadwal).'" class="btn btn-warning  btn-xs btn-flat"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit Jadwal</span></a>
                  <a href="'.base_url('jadwal/hapus_jadwal/'.$data->id_jadwal).'" class="btn btn-danger  btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus Jadwal</span></a>
                         
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

      <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
            - Menu jadwal hanya menampilkan jadwal pada periode aktif.
            <br>
            - Untuk melihat riwayat jadwal di periode sebelumnya, gunakan fitur filter.
         </div>
      <!-- /.row -->
    </section>

        <div class="modal fade" id="modal_view" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Jadwal</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('jadwal/simpan_jadwal'); ?>
                      <table class="table" style="text-transform: uppercase;">
                       <tr>
          <td class="left_column">Mata Kuliah</td>
            <td>: <input type="text" name="nama_matkul" id="nama_matkul" class="text-input" maxlength="80" size="80" style="width:400px">
            <input type="hidden" name="id_detail_kurikulum" id="id_detail_kurikulum" class="text-input" maxlength="80" size="80" style="width:100px">
            <input type="hidden" name="id_prodi" id="id_prodi" class="text-input" maxlength="80" size="80" style="width:100px">
          </td>
        </tr>
                     
                         <tr>
          <td class="left_column">Konsentrasi</td>
            <td>: <select name="id_konsentrasi" id="id_konsentrasi" class="validate[required]" required=""  >
              <option value=""> Pilih Konsentrasi</option>


      </select> 
          </td>
        </tr>
        <tr>
          <td class="left_column">Periode <font color="#FF0000">*</font></td>
            <td>: 
      <select name="id_periode" id="id_periode" class="validate[required]" required="">
          <option value=""> Pilih Semester</option>


          </select>            </td>
        </tr> 
       
         <tr>
          <td class="left_column">Hari</td>
            <td>: <select name="id_hari" id="id_hari" class="validate[required]" required="" style="width: 100px" >
        <option value=""> Pilih Hari </option>
        <option value="1"> Senin </option>
        <option value="2"> Selasa </option>
        <option value="3"> Rabu </option>
        <option value="4"> Kamis </option>
        <option value="5"> Jumat </option>


      </select>  </td>
        </tr>
         <tr>
          <td class="left_column">Jam Awal</td>
            <td>: <input type="time" name="jam_awal" id="jam_awal" class="text-input" maxlength="80" size="80" style="width:100px"></td>
        </tr>
        <tr>
          <td class="left_column">Jam Akhir</td>
            <td>: <input type="time" name="jam_akhir" id="jam_akhir" class="text-input" maxlength="80" size="80" style="width:100px"></td>
        </tr>
        <tr>
          <td class="left_column">Sesi</td>
            <td>: <select name="id_waktu" id="id_waktu" class="validate[required]" required="" style="width: 80px">
        <option value="1"> Pagi </option>
        <option value="2"> Sore </option>
      </select>  </td>
        </tr>
         <tr>
          <td class="left_column">Ruang</td>
            <td>: <select name="ruang" id="ruang" class="validate[required]" required="" style="width: 100px" >
        <option value=""> Pilih Ruang </option>
        <?php 

                                        foreach($getRuang as $row)
                                        { 
                                          echo '<option value="'.$row->id_ruang.'">'.$row->nama_ruang.'</option>';
                                        }
                                    ?>
      </select>
    </td>
        </tr>
        <tr>
          <td><span id="user-availability-status"></span></td>
        </tr>
        <tr>
                    <td colspan="4"><button type="submit" class="btn btn-primary btn-flat" id="MyBtn"><i class="fa fa-save"></i> Save</button></td>
                  </tr>

                        </table>
                        <?php echo form_close();?>

                    </div>

                </div>
            </div>
            </div>
        </div>

        <?php 
        foreach($jadwal as $i):
        ?>
        <div class="modal fade" id="modal_lihat<?php echo $i->id_jadwal;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Detail Jadwal</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <table class="table">
      <tr>
          <td class="left_column">Program Studi </td>
            <td>: 
       <?php echo $i->nama_prodi;?>         </td>
        </tr> 
        <tr>
          <td class="left_column">Mata Kuliah </td>
            <td>: 
       <?php echo $i->nama_matkul;?>         </td>
        </tr> 
        <tr>
          <td class="left_column">Periode </td>
            <td>: 
      <?php echo $i->semester;?>           </td>
        </tr> 
        <tr>
          <td class="left_column">Semester </td>
            <td>: 
      <?php echo $i->semester_kurikulum;?>           </td>
        </tr> 
      <tr>
          <td class="left_column">Kelas</td>
            <td>: <?php echo $i->nama_ruang;?>
          </td>
        </tr>
         <tr>
          <td class="left_column">Hari</td>
            <td>: <?php echo $i->hari;?> </td>
        </tr>
         <tr>
          <td class="left_column">Jam Awal</td>
            <td>: <?php echo $i->jam_awal;?></td>
        </tr>
        <tr>
          <td class="left_column">Jam Akhir</td>
            <td>: <?php echo $i->jam_akhir;?></td>
        </tr>
        <tr>
          <td class="left_column">Sesi</td>
            <td>: <?php echo $i->waktu;?> </td>
        </tr>
      
        
    </table>

                    </div>

                </div>
            </div>
            </div>
        </div>
        

    <?php endforeach;?>
   


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
 <script>
       document.getElementById("nama_matkul").style.visibility = 'visible';

    jQuery(document).ready(function($){
    $('#nama_matkul').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete_mk', 
      minLength:1,
      select: function(event, ui){
        $('#nama_matkul').val(ui.item.label);
        $('#id_prodi').val(ui.item.prodi);
        $('#id_detail_kurikulum').val(ui.item.idk);
       
        get_concentrate();
        get_prodi_periode();
      }
    });    
  });

  </script>

  <script type="text/javascript">
            function get_concentrate() {
                var id_prodi = document.getElementById('id_prodi').value;

                $.ajax({
                    url: '<?php echo base_url(); ?>kelas_perkuliahan/get_concentrate2/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_konsentrasi").html(msg);

                    }
                });
            }
  </script>

  <script type="text/javascript">
            function get_prodi_periode() {
                 var id_prodi = document.getElementById('id_prodi').value;
                $.ajax({
                    url: '<?php echo base_url(); ?>kurikulum/get_prodi_periode/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_periode").html(msg);
                    }
                });
            }
</script>




     

