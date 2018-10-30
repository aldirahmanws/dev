      
       <?php echo $this->session->flashdata('message');?>
        <div class="box box-info">
            
            <!-- /.box-header --> 
            <div class="box-body">
              <table class="table">

        <tr>


            <td width="15%" class="left_column">Nama Kurikulum <font color="#FF0000">*</font></td>
            <td>: <?php echo $kurikulum->nama_kurikulum; ?>   </td>
      
           <td class="left_column" width="25%">Tanggal Mulai <font color="#FF0000">*</font></td>
            <td>:
               <?php echo $kurikulum->semester; ?>                        </td>
                                  
           
            </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=>Program Studi <font color="#FF0000">*</font></td>
            <td width=20%">: <?php echo $kurikulum->nama_prodi; ?>        </td>
            <td class="left_column" width="15%">Jumlah Bobot Matakuliah Wajib <font color="#FF0000">*</font></td>
            <td>:
               <?php echo $kurikulum->bobot_matkul_wajib; ?>                        </td>
            <td class="left_column" width="15%">SKS Matakuliah Wajib </td>
            <td>: <?php 
                    $totalwajib = 0;
                     foreach($dk as $data){
                        if ($data->wajib == 'Y') {
                          $totalwajib += $data->bobot_matkul;
                        }
                      } echo $totalwajib;
                  ?>
                
                </td>
        </tr>
        <tr>
            <td class="left_column">Jumlah SKS</td>
            <td width=20%">: <?php  $jumlah_sks = $kurikulum->bobot_matkul_wajib + $kurikulum->bobot_matkul_pilihan;;echo $jumlah_sks; ?></td>
            <td class="left_column">Jumlah Bobot Matakuliah Pilihan <font color="#FF0000">*</font></td>
            <td>:
            <?php echo $kurikulum->bobot_matkul_pilihan; ?>
             <td class="left_column" width="15%">SKS Matakuliah Pilihan</td>
            <td>: <?php 
                    $totalpilihan = 0;
                     foreach($dk as $data){
                        if ($data->wajib == 'T') {
                          $totalpilihan += $data->bobot_matkul;
                        }
                      } echo $totalpilihan;
                  ?>
                  </td>
        </table>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="">
           

              <form method="get" action="<?php echo base_url(); ?>kurikulum/salin_matkul/<?php echo $kurikulum->id_kurikulum; ?>/" enctype="multipart/form-data">
               <a class="btn btn-default btn-flat btn-sm pull-right"  href="<?php echo base_url(); ?>kurikulum" style="margin-left: 10px"><i class="fa fa-angle-left"></i> Back</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="btn btn-primary btn-flat btn-sm pull-right"  data-toggle="modal" data-target="#modal_tambah" style="margin-left: 10px">

              <i class="fa fa-plus"></i> Tambah Mata Kuliah</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   
            <button type="submit" class="btn btn-warning btn-flat btn-sm pull-right" ><i class="fa fa-copy"></i> Salin Mata Kuliah </button>
          <div class="col-xs-3 pull-right">
             <select name="id_kurikulum" class="form-control">
                        <?php 

                                        foreach($getKurikulum as $row)
                                        { 
                                          echo '<option value="'.$row->id_kurikulum.'">'.$row->nama_kurikulum.'</option>';
                                        }
                                    ?>
                      </select>
                    </div>
              </form>




            <br>
            
          </div>


          <div class="box box-info">
            <?php echo form_open('kurikulum/remove/'.$this->uri->segment(3)); ?>
 
            <table class="table2 table-bordered table-striped" style="text-transform: uppercase;">
  <thead>
  <tr>
    <th  style="text-align:center" rowspan="2">No.</th>
    <th  style="text-align:center" rowspan="2">Kode MK</th>
    <th  style="text-align:center" rowspan="2">Nama MK</th>
    <th  style="text-align:center" colspan="5">Bobot Mata Kuliah</th>
    <th  style="text-align:center" rowspan="2">Semester</th>
    <th style="text-align:center" rowspan="2">Wajib</th>
    <th style="text-align:center" rowspan="2"> Aksi</th>
    <th style="text-align:center" rowspan="2"> Check</th>
  </tr>
  <tr>
    <th  style="text-align:center">Mata Kuliah</th>
    <th  style="text-align:center">Tatap Muka</th>
    <th  style="text-align:center">Praktikum</th>
    <th  style="text-align:center">Prakt Lap.</th>
    <th  style="text-align:center">Simulasi</th>
    
  </tr>
  </thead>
  <tbody>

    <?php 
        $no = 0;
        $totalbobot = 0;
        $totaltm = 0;
        $totalprak = 0;
        $totalpl = 0;
        $totalsim = 0;
        $alert = "'Apakah anda yakin menghapus data ini ?'";
        foreach($dk as $data):
        ;
      ?>

      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->id_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nama_matkul;?></td>
        <td style="text-align:center"><?php $totalbobot += $data->bobot_matkul;echo $data->bobot_matkul;?></td>
        <td style="text-align:center"><?php $totaltm += $data->bobot_tatap_muka;echo $data->bobot_tatap_muka;?></td>
        <td style="text-align:center"><?php $totalprak += $data->bobot_praktikum;echo $data->bobot_praktikum;?></td>
        <td style="text-align:center"><?php $totalpl += $data->bobot_praktik_lapangan;echo $data->bobot_praktik_lapangan;?></td >
        <td style="text-align:center"><?php $totalsim += $data->bobot_simulasi;echo $data->bobot_simulasi;?></td >
        <td style="text-align:center"><?php echo $data->semester_kurikulum;?></td >
        <td style="text-align:center"><?php

          if ($data->wajib == 'Y') $check = '<i class="fa fa-check"></i>'; else $check = '';

          echo $check;

          ?>
  
        </td >
        <td style="text-align:center">
                <a href="<?php echo base_url(); ?>kurikulum/hapus_matkul_kurikulum/<?php echo $data->id_detail_kurikulum; ?>/<?php echo $this->uri->segment(3); ?>" onclick="return confirm(<?php echo $alert; ?>)" class="btn btn-danger btn-xs btn-flat"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus Matkul</span></a>

                <a href="<?php echo base_url(); ?>kurikulum/detail_matkul_kurikulum/<?php echo $data->id_detail_kurikulum; ?>" class="btn btn-warning btn-xs btn-flat"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Detail Matkul</span></a> </td>
          <td style="text-align:center"><input type="checkbox" name="id[]" value="<?php echo $data->id_detail_kurikulum; ?>"></td>

    </tr>
<?php endforeach; ?>
<tr>
        <td colspan="3" style="text-align:right"> <b> Jumlah SKS : </b></td>
        <td style="text-align:center"><?php echo $totalbobot; ?></td>
        <td style="text-align:center"><?php echo $totaltm; ?></td>
        <td style="text-align:center"><?php echo $totalprak; ?></td>
        <td style="text-align:center"><?php echo $totalpl; ?></td>
        <td style="text-align:center"><?php echo $totalsim; ?></td>
        <td style="text-align:center" colspan="2"></td >
        <td style="text-align:center" colspan="2">
                
                        </td>
    </tr>
  
  </tbody>
</table>
<input type="submit" value="Hapus Mata Kuliah Terpilih" onclick="return confirm('Anda yakin menghapus data yang sudah anda pilih ?')" class="btn btn-danger btn-flat btn-sm pull-right" style="padding-right: 10px;"> 
              <br><br>
              
              <?php echo form_close()?>

          </div>
          
       

         <div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Mata Kuliah</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('kurikulum/simpan_detail_kurikulum'); ?>
                      <table class="table">
                         <tr>
            <td class="left_column">Nama Mata Kuliah <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_matkul" id="nama_matkul" class="validate[required] text-input" maxlength="20" size="40" style="width:80%">
            </td>
           
        </tr> 
          
       <input type="hidden" name="kode_matkul" id="kode_matkul" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required="">
         
        
            <input type="hidden" name="id_kurikulum" id="nama_kurikulum" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required="" value="<?php echo $this->uri->segment(3); ?>">

           <input type="hidden" name="id_prodi_matkul" id="id_prodi_matkul" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required="" value="">
            <input type="hidden" name="id_prodi_kurikulum" id="id_prodi_kurikulum" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required="" value="<?php echo $kurikulum->id_prodi; ?>">
        
            
       
        <tr>
            <td class="left_column">Semester <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="semester_kurikulum" id="semester_kurikulum" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required=""></td>
        </tr> 
        <tr>
          <td class="left_column">Wajib <font color="#FF0000">*</font></td>
          <td>: 
          <label class="radio-inline"><input type="radio" name="wajib" id="wajib" value="Y" checked="" > Ya</label> &nbsp; 
          <label class="radio-inline"><input type="radio" name="wajib" id="wajib" value="T"> Tidak</label> &nbsp; 
                </td>
    </tr>
        
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-primary btn-flat" id="myBtn"><i class="fa fa-save"></i> Save</button></td>
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
       document.getElementById("nama_matkul").style.visibility = 'visible';

    jQuery(document).ready(function($){
    $('#nama_matkul').autocomplete({
      source:'<?php echo base_url(); ?>kurikulum/get_autocomplete', 
      minLength:1,
      select: function(event, ui){
        $('#nama_matkul').val(ui.item.label)  ;
        $('#kode_matkul').val(ui.item.id);
        $('#id_prodi_matkul').val(ui.item.ip);
        cek_prodi();
      }
    });    
  }

  );

  </script>
 <script>
   function cek_prodi(){
     var id_prodi_matkul = document.getElementById('id_prodi_matkul').value;
    var id_prodi_kurikulum = document.getElementById('id_prodi_kurikulum').value;
   

    if (id_prodi_matkul == id_prodi_kurikulum)
      {
         document.getElementById("myBtn").disabled = false;

      } else {
        document.getElementById("myBtn").disabled = true;
      }
    
    }
</script>

  

