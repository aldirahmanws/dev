        <?php echo $this->session->flashdata('message');?>
        <div class="box">
        <table class="table">
        <tbody><tr>
            <td class="left_column" width="20%">Program Studi <font color="#FF0000">*</font></td>
            <td colspan="3" width="20%">:  
      <?php echo $kp->nama_prodi; ?>      </td>

      <td class="left_column">Mata Kuliah  <font color="#FF0000">*</font></td>
            <td colspan="3">: 
      <?php echo $kp->nama_matkul; ?>             
            </td>
        </tr>
        <tr>
            <td class="left_column" width="20%">Semester <font color="#FF0000">*</font></td>
            <td colspan="3">:  <?php echo $kp->semester; ?>            <input type="hidden" name="id_smt" id="id_smt" value="20171">
            </td>
        <td class="left_column">Bobot Mata Kuliah</td>
            <td colspan="3">: 
      <?php echo $kp->bobot_matkul; ?>             <font color="#999999"><em> ( sks Tatap Muka + sks Praktikum + sks Praktek Lapangan + sks Simulasi )</em></font>
            </td>

        </tr>
        <tr>
<td class="left_column">Nama Kelas <font color="#FF0000">*</font>
            </td>
          <td colspan="3">: 
      <?php echo $kp->nama_kelas; ?> </td>

      
            <td class="left_column">Bahasan</td>
            <td colspan="3">: 
      <?php echo $kp->bahasan; ?> </td>
          
    </tr>
         <tr>
          <td class="left_column">Tanggal Mulai Efektif</td>
            <td colspan="3">:
          <?php echo $kp->tgl_mulai; ?>          </td>
          
        <td class="left_column">Total Mahasiswa</td>
        
            <td colspan="3">: <b> <?php echo $dsn['jumlah_mhs']; ?>  </b> mahasiswa</td>
            <input type="text" name="total_mhs2" id="total_mhs2" value="<?php $total_mhs2 = $kp->total_mhs -1;echo $total_mhs2; ?>">

           
            

        </tr>
        <tr>
            <td class="left_column">Tanggal Akhir Efektif 
         </td>
         <td colspan="9">:
             <?php echo $kp->tgl_akhir; ?>        </td>
    

        </tr>
       
       
    </tbody></table>
</div>
<div class="">

            <?php if( $dsn['dosen'] != 1 OR 0) echo '
             <a class="btn btn-primary pull-right" style="margin-right: 10px" data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Tambah Dosen</a>
            
            '; else echo '
             
            ';
            ?>

             <?php if( $dsn['jumlah_mhs'] <= 39) echo '
             <a class="btn btn-primary pull-right"  data-toggle="modal" style="margin-right: 10px"data-target="#modal_tambah_mhs"><i class="fa fa-plus"></i> Tambah Mahasiswa</a>
            
            '; else echo '
             
            ';
            ?>

             <a class="btn btn-primary pull-right" style="margin-right: 10px"  href="<?php echo base_url('kelas_perkuliahan'); ?>"></i> Kembali </a> <br> <br>

          </div> <br>
    <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Dosen Pengajar</a></li>
              <li><a href="#tab_2" data-toggle="tab">Mahasiswa KRS / Peserta Kelas</a></li>
              <!-- <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li> -->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
    <section class="content">
      <div class="row">
        
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th  rowspan="2" style="text-align:center">No</th>
                    <th  rowspan="2" style="text-align:center">NIDN</th>
                    <th rowspan="2" style="text-align:center">Nama Dosen</th>
                    <th  rowspan="2" style="text-align:center">Bobot (sks)</th>
                    <th  colspan="2" style="text-align:center">Pertemuan</th>
                        <th  rowspan="2" style="text-align:center">Jenis Evaluasi</th>
                        <th rowspan="2" > Aksi</th>
                    </tr>
                    <tr>
                            <th style="text-align:center">Rencana</th>
                            <th style="text-align:center">Realisasi</th>
                    </tr>
                    
                    </thead>
                <tbody> 
                    

                <?php 
                $no = 0;
                 $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($dosen as $data) {
                  echo '
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_dosen.'</a></td>
                  <td>'.$data->nama_dosen.'</td>
                  <td id="bobot_dosen">'.$data->bobot_dosen.'</td>
                  <td id="rencana">'.$data->rencana.'</td>
                  <td id="realisasi">'.$data->realisasi.'</td>
                  <td>'.$data->jenis_evaluasi.'</td>
                  <td>

                         <a class="btn btn-warning  btn-sm" data-toggle="modal" data-target="#modal_edit'.$data->id_kelas_dosen.'"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit Dosen</span></a>
                  </td>

                ' ;
              }
              ?>
            </tr>
            <tr>
              <th colspan="3"> Jumlah SKS</th>
              <td id="jumlah_sks">

               </td>
              <td colspan="4"></td>
            </tr>
                </tbody>
              </table>
            </div>
            <div></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <section class="content">
      <div class="row">
        
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th width="10%">NIM</th>
                    <th>Nama Mahasiwa</th>
                    <th>L/P</th>
                    <th>Prodi</th>
                    <th>Angkatan</th>
                    <th>Aksi</th>
                  <!-- <th>Aksi</th> -->
                </tr>
                </thead>
                <tbody> 
                    <?php 
                $no = 0;
                 $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($mhs as $data) {

                  
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nim.'</a></td>
                  <td>'.$data->nama_mahasiswa.'</td>
                  <td>'.$data->jenis_kelamin.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->angkatan.'</td>
                  <td>
                        <a href="'.base_url('kelas_perkuliahan/hapus_kelas_mhs/'.$data->id_kelas_mhs.'/'.$data->id_kp.'/'.$total_mhs2).'" class="btn btn-danger  btn-sm" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>

                         <a href="'.base_url('kelas_perkuliahan/page_edit_kelas_mhs/'.$data->id_kelas_mhs).'" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>
                  </td>

                ' ;
              }
              ?>
             
                        
                    </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <!-- /.col -->
      
      <!-- /.row -->
    </section>
              </div>
              <!-- /.tab-pane -->
              <!--<div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div> 
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
           <div class="callout callout-info">
        
            <strong>Keterangan :</strong>
      <br />
      - Perkuliahan Reguler<br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal mulai efektif = Tanggal mulai perkuliahan dalam satu semester<br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal akhir efektif = Tanggal akhir perkuliahan dalam satu semester
      <br />
          - Fasilitas hitung sks disediakan untuk membantu perhitungan sks dosen secara otomatis.
      <br />
      - Rumus Perhitungan sks dosen = ( Rencana Pertemuan : Jumlah Seluruh Rencana Pertemuan Seluruh Dosen ) x sks Matakuliah.

         </div>

</div>


<div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Dosen</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('kelas_perkuliahan/simpan_kelas_dosen'); ?>
                      <table class="table">
                         <tr>
            <td class="left_column">Nama Dosen <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_dosen" id="nama_dosen" class="validate[required] text-input" maxlength="50" size="50" style="width:80%" required="">
              <input type="hidden" name="id_dosen" id="id_dosen" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required=""></td>
        </tr> 
        <tr>
            <td class="left_column">Rencana</td>
            <td>: 
            <input type="text" name="rencana" id="rencana" class="text-input" maxlength="3" size="2"  style="width:10%" value="0" onkeyup="sum();">       
            </td>
        </tr>
        <tr>
            <td class="left_column">Realisasi</td>
            <td>: 
            <input type="text" name="realisasi" id="realisasi" class="text-input" maxlength="3" size="2" style="width:10%" value="0">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Bobot (sks)</td>
            <td>: 
            <input type="text" name="bobot_dosen" id="bobot_dosen" class="text-input" maxlength="3" size="2"  style="width:10%; background-color: #E0E0E0;" value="<?php echo $kp->bobot_matkul;?>" readonly>         
            </td>
        </tr>
        <tr>
            <td class="left_column">Jenis Evaluasi</td>
            <td>: 
            <input type="text" name="jenis_evaluasi" id="jenis_evaluasi" class="text-input" size="2"  style="width:40%" >         
            </td>
            <input type="hidden" name="id_kp" id="id_kp" class="text-input" maxlength="3" size="2"  style="width:10%" value="<?php echo $this->uri->segment(3); ?>"> 
            
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

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
  <script>
       document.getElementById("nama_dosen").style.visibility = 'visible';

    jQuery(document).ready(function($){
    $('#nama_dosen').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete', 
      minLength:1,
      select: function(event, ui){
        $('#nama_dosen').val(ui.item.label)  ;
        $('#id_dosen').val(ui.item.id);
      }
    });    
  });

  </script>

  <script>

      var rencana = document.getElementById('rencana').innerHTML;
      var realisasi = document.getElementById('realisasi').innerHTML;
      var bobot_dosen = document.getElementById('bobot_dosen').innerHTML;
      var result = parseInt(rencana) / parseInt(realisasi) * parseInt(bobot_dosen);
      if (!isNaN(result)) {
         document.getElementById('jumlah_sks').innerHTML = result;
      }
</script>

<?php 
        foreach($dosen as $i):
        ?>


<div class="modal fade" id="modal_edit<?php echo $i->id_kelas_dosen;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Kurikulum</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('kelas_perkuliahan/edit_kelas_dosen/'.$i->id_kelas_dosen); ?>
                      <table class="table">
                         <tr>
            <td class="left_column">Nama Dosen <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_dosen" id="nama_dosen2" class="validate[required] text-input" maxlength="50" size="50" style="width:80%" required="" value="<?php echo $i->nama_dosen; ?>">
              <input type="hidden" name="id_dosen" id="id_dosen2" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required="" value="<?php echo $i->id_dosen; ?>"></td>
        </tr> 
        <tr>
            <td class="left_column">Rencana</td>
            <td>: 
            <input type="text" name="rencana" id="rencana" class="text-input" maxlength="3" size="2"  style="width:10%" value="<?php echo $i->rencana; ?>" onkeyup="sum();">   

            <input type="hidden" name="id_kp" id="id_kp" class="text-input" maxlength="3" size="2"  style="width:10%" value="<?php echo $i->id_kp; ?>" onkeyup="sum();">      
            </td>
        </tr>
        <tr>
            <td class="left_column">Realisasi</td>
            <td>: 
            <input type="text" name="realisasi" id="realisasi" class="text-input" maxlength="3" size="2" style="width:10%" value="<?php echo $i->realisasi; ?>">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Bobot (sks)</td>
            <td>: 
            <input type="text" name="bobot_dosen" id="bobot_dosen" class="text-input" maxlength="3" size="2"  style="width:10%" value="<?php echo $i->bobot_dosen; ?>">         
            </td>
        </tr>
        <tr>
            <td class="left_column">Jenis Evaluasi</td>
            <td>: 
            <input type="text" name="jenis_evaluasi" id="jenis_evaluasi" class="text-input" size="2"  style="width:40%" value="<?php echo $i->jenis_evaluasi; ?>">         
            </td>
           
            
        </tr>
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info">Simpan</button></td>
                  </tr>
                   <?php endforeach;?>
              <?php echo form_close();?>

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
       document.getElementById("nama_dosen2").style.visibility = 'visible';

    jQuery(document).ready(function($){
    $('#nama_dosen2').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete', 
      minLength:1,
      select: function(event, ui){
        $('#nama_dosen2').val(ui.item.label)  ;
        $('#id_dosen2').val(ui.item.id);
      }
    });    
  });

  </script>

  <div class="modal fade" id="modal_tambah_mhs" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Mahasiswa</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('kelas_perkuliahan/simpan_kelas_mhs'); ?>
                      <table class="table">
                         <tr>
            <td class="left_column">Nama Mahasiswa <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="validate[required] text-input" maxlength="50" size="50" style="width:80%" required="" >
              <input type="text" name="id_mahasiswa" id="id_mahasiswa" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required=""><span id="user-availability-status"></span>

              <input type="text" name="prodi" id="prodimhs" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" >
              
              <input type="text" name="prodi" id="prodikp" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required="" value="<?php echo $kp->id_prodi; ?>">



            <input type="text" name="id_kp" id="id_kp2" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" value="<?php echo $this->uri->segment(3); ?>">

            <input type="hidden" name="total_mhs" id="total_mhs" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" value="<?php echo $dsn['jumlah_mhs'] + 1; ?>">

            
          </td>
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info" id="myBtn">Simpan</button></td>
                  </tr>
              <?php echo form_close();?>

                        </table>

                    </div>

                </div>
            </div>
            </div>
        </div>

         <script>

       document.getElementById("nama_mahasiswa").style.visibility = 'visible';
    jQuery(document).ready(function($){
    $('#nama_mahasiswa').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete2', 
      minLength:1,
      select: function(event, ui){
        $('#nama_mahasiswa').val(ui.item.label);
        $('#id_mahasiswa').val(ui.item.id);
        $('#prodimhs').val(ui.item.prodi);
        ea();
        
      }
    });    
  });
  
  </script>

  <script>
    function disabledB(){
    ea();
    }
    function ea(){
     var prodimhs = document.getElementById('prodimhs').value;
    var prodikp = document.getElementById('prodikp').value;

    if (prodikp == prodimhs && hai() == true)
      {
         document.getElementById("myBtn").disabled = false;
      } else {
        document.getElementById("myBtn").disabled = true;
      }
      
    
    }
</script>

<script type="text/javascript">
  function checkAvailability() {
    hai();
            }
  function hai(){
   $.ajax({
                    url: '<?php echo base_url(); ?>kelas_perkuliahan/cek_mahasiswa/',
                    data: 'id_mahasiswa='+$("#id_mahasiswa").val()+'&id_kp2='+$("#id_kp2").val(),
                    type: 'POST',
                    dataType: 'html',
                    success:function(data){
                    $("#user-availability-status").html(data);
                    },
                    error:function (){}
                });
              }
</script>