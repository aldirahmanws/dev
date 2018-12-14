
<?php echo $this->session->flashdata('message');?>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">AKTIVITAS PERKULIAHAN</h3>
            </div>
            <div class="box-body">
              <table class="">
                <tbody>
                  <form method="get" action="<?php echo base_url("aktivitas_perkuliahan/filter_data_ap/")?>">
                  <tr>
                    <th>Filter</th>
                  </tr>
                  <tr>                                                                    
                    <td>Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                      <select name="id_prodi" onchange="return get_prodi_periode2(this.value)">
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
                      <select name="id_periode" id="id_periode2">
                        <option value="">-- Semua --</option>
              
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

              <table id="example3" class="table2 table-hover table-striped table-condensed table-bordered" style="text-transform: uppercase;">
                <a class="btn btn-primary btn-sm btn-flat" href="" data-toggle="modal" data-target="#modal_view"><i class="fa fa-plus"></i> Tambah Akvititas</a> <br> <br>
                <thead>
                <tr>
                  <th rowspan="2" style="text-align: center" width="3px">No</th>
                  <th rowspan="2" style="text-align: center">NIM</th>
                  <th rowspan="2" style="text-align: center">Nama</th>
                  <th rowspan="2" style="text-align: center">Prodi</th>
                  <th rowspan="2" style="text-align: center">Angkatan</th>
                  <th rowspan="2" style="text-align: center">Periode</th>
                  <th rowspan="2" style="text-align: center">Status</th>
                  <th rowspan="2" style="text-align: center">IPS</th>
                  <th rowspan="2" style="text-align: center">IPK</th>
                  <th colspan="2" style="text-align: center">SKS</th>
                  <th rowspan="2" style="text-align: center">Aksi</th>
                </tr>
                <tr>
                  <th>Smt</th>
                  <th>Total</th>
                </tr>
                 
                </thead>

                <tbody>

                <?php 
                $no = 0;
                 $alert = "'Apakah anda yakin menghapus data ini ?'";

                foreach ($aktivitas as $data) { 
                  
                  

                  echo '                  
                <tr>
                  <td>'.++$no.'</td>
                  <td><a href="'.base_url('aktivitas_perkuliahan/detail_ap/'.$data->id_aktivitas.'/'.$data->id_mahasiswa.'/'.$data->id_periode.'/'.$data->semester_ak).'">'.$data->nim.'</a></td>
                  <td>'.$data->nama_mahasiswa.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.substr($data->tgl_du,0,4).'</td>
                  <td>'.$data->semester.'</td>
                  <td>'.$data->status_mhs.'</td>
                  <td>'.$data->ips.'</td>
                  <td>'.$data->ipk_ak.'</td>
                  <td>'.$data->sks_semester.'</td>
                  <td>'.$data->sks_total.'</td>
                  <td> <a href="'.base_url('aktivitas_perkuliahan/edit_ap/'.$data->id_aktivitas.'/'.$data->id_mahasiswa.'/'.$data->id_periode).'" class="btn btn-warning btn-xs btn-flat" ><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>
                  </td>
                  
                  </tr>
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
                <h3 class="modal-title" id="myModalLabel">TAMBAH AKTIVITAS PERKULIAHAN</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <form method="get" action="<?php echo base_url("aktivitas_perkuliahan/filter_ap/")?>">
                      <table class="table" style="text-transform: uppercase;">
                         <tr>
                           <td class="left_column">Mahasiswa <font color="#FF0000">*</font></td>
            <td colspan="9">: 
      <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="validate[required] text-input ui-autocomplete-input" size="20"  style="width: 50%;" required="" placeholder="Masukan Nama"><span role="status" aria-live="polite" class="ui-helper-hidden-accessible"></span>            <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" > <input type="hidden" name="nama_m" id="nama_m" > <input type="hidden" name="id_prodi" id="id_prodi" > 
      <input type="hidden" name="semester_aktif" id="semester_aktif" > <input type="hidden" name="nama" id="nama" > <input type="hidden" name="asal_pt" id="asal_pt" >
            </td>
        </tr>
        <tr>
            <td class="left_column" width="20%">Status <font color="#FF0000">*</font></td>
            <td colspan="9">:  
            <select name="id_status_ak" id="id_status_ak" class="validate[required]" required="">
            <option value="19"> Aktif </option>
            <option value="2"> Non Aktif </option>
            <option value="3"> Cuti </option>
        </select> 

      </td>

        </tr>

        <tr>
          <td class="left_column" width="20%">Periode<font color="#FF0000">*</font></td>
            <td colspan="9">:  
            <select name="id_periode" id="id_periode" class="validate[required]" required="" onchange="return get_nama_periode(this.value);">
            <option value=""> Pilih Periode</option>
        </select>     <input type="hidden" name="semester" id="semester" > <input type="hidden" name="id_grade" id="id_grade" >
       
      </td>
        
    </tr>
  
    <tr>
      <td colspan="9"> <span id="user-availability-status"></span> </td>
    </tr>

        
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info btn-flat" id="MyBtn">Tampilkan</button></td>
                  </tr>
              </form>

                        </table>

                    </div>

                </div>
            </div>
            </div>
        </div>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
 <script>

       document.getElementById("nama_mahasiswa").style.visibility = 'visible';
    jQuery(document).ready(function($){
    $('#nama_mahasiswa').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete2', 
      minLength:1,
      select: function(event, ui){
        $('#nama_mahasiswa').val(ui.item.label);
        $('#id_mahasiswa').val(ui.item.id);
        $('#nama_m').val(ui.item.nama_m);
        $('#id_prodi').val(ui.item.prodi);
        $('#asal_pt').val(ui.item.asal_pt);
        $('#semester_aktif').val(ui.item.semester_aktif);
        $('#id_grade').val(ui.item.grade);
        get_prodi_periode();
      }
    });    
  });
  
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
                      //console.log(id_prodi);
                        $("#id_periode").html(msg);


                    }
                });
            }
</script>
<script>

        function get_nama_periode() {
                var id_periode = document.getElementById('id_periode').value;

                $.ajax({
                    url: '<?php echo base_url(); ?>kurikulum/get_nama_periode/'+id_periode,
                    data: 'id_periode='+id_periode,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                      console.log(msg);

                        document.getElementById('semester').value = msg;
                        cek_duplikat();


                    }
                });
            }
  
  </script>
  <script type="text/javascript">
  function cek_duplikat(){
   $.ajax({
                    url: '<?php echo base_url(); ?>aktivitas_perkuliahan/cek_duplikat/',
                    data: 'id_mahasiswa='+$("#id_mahasiswa").val()+'&id_periode='+$("#id_periode").val(),
                    type: 'POST',
                    dataType: 'html',
                    success:function(data){
                    $("#user-availability-status").html(data);
                    },
                    error:function (){}
                });
              }
</script>
<script type="text/javascript">
            function get_prodi_periode2(p) {
                var id_prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>mahasiswa/get_prodi_periode2/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_periode2").html(msg);
                    }
                });
            }
</script>