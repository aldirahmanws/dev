
        <div class="box box-info">
        <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_0" data-toggle="tab">Rincian Data IPS Periode <?php echo $ap->semester; ?></a></li>
             <li><a href="#tab_1" data-toggle="tab">Rincian Data IPK Hingga Periode <?php echo $ap->semester; ?></a></li> 
            
             
            </ul>

        <div class="tab-content">

         <div class="tab-pane" id="tab_1">

<table id="table1" class="table table-striped table-bordered" >
    <thead>
    <tr>
        <th style="width:5%;text-align:center" rowspan="2">No.</th>
        <th style="text-align:center" rowspan="2">Kode MK</th>
        <th style="text-align:center" rowspan="2">Nama MK</th>
         <th style="text-align:center" rowspan="2">Periode</th>
        <th style="text-align:center" rowspan="2">Bobot MK<br />(sks)</th>
         <th style="text-align:center" colspan="3">Nilai<br />(sks)</th>
         <th style="text-align:center" rowspan="2">sks * N.indeks</th>
       
    </tr>
    <tr>
        <th style="width:5%;text-align:center">Angka</th>
        <th style="text-align:center">Huruf</th>
        <th style="text-align:center">Indeks</th>
        
    </tr>
    </thead>
    <tbody>
    <?php 

        $no = 0;
        $totalsi = 0;
        $totalbobot2 = 0;
        foreach($nilai2 as $data):
             $dataee = $data->bobot_matkul * $data->nilai_indeks;
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->kode_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nama_matkul;?></td>
        <td style="text-align:center"><?php echo $data->semester;?></td>
        <td style="text-align:center"><?php $totalbobot2 += $data->bobot_matkul; echo $data->bobot_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nilai_d;?></td>
        <td style="text-align:center"><?php echo $data->nilai_huruf;?></td>
        <td style="text-align:center"><?php echo $data->nilai_indeks;?></td>
        <td style="text-align:center"><?php $totalsi += $dataee; echo $dataee;?></td>
        
       
    </tr>
   
<?php endforeach; ?>

    <tr>
         <td colspan="4" style="text-align:right"> <b> Jumlah Bobot : </b></td>
        <td style="text-align:center">  <?php 
        if ($totalbobot2 == 0) {
            echo $totalbobot2 = 1;
        } else {
            echo $totalbobot2;
        }  ?> </td>
        <td colspan="3" style="text-align:right"> <b> Jumlah sks * N.indeks : </b></td>
        <td style="text-align:center"> <?php echo $totalsi; ?></td>

    </tr>
    <tr>
        <th style="text-align:right" colspan="8"> IPK : </th>
        <th style="text-align:center"> <?php $ipk = $totalsi / $totalbobot2; echo round($ipk, 2); ?>   </th>
    </tr>

  
  </tbody>
    </table>

    <input type="hidden" name="ipk" id="ipk" value="<?php $ipk2 = round($ipk, 2);echo $ipk2; ?>"> 

    <?php if ($ipk <= 3.5) {
         $a = '7';
    } elseif ($ipk < 3.76) {
         $a = '6';
    } else {
         $a = '5';
    } ?>

     

</div>

        <div class="tab-pane active" id="tab_0">

                
              
              
        <table id="table1" class="table table-striped table-bordered" >
    <thead>
    <tr>
        <th style="width:5%;text-align:center" rowspan="2">No.</th>
        <th style="text-align:center" rowspan="2">Kode MK</th>
        <th style="text-align:center" rowspan="2">Nama MK</th>        <th style="text-align:center" rowspan="2">Bobot MK<br />(sks)</th>
         <th style="text-align:center" colspan="3">Nilai<br />(sks)</th>
         <th style="text-align:center" rowspan="2">sks * N.indeks</th>
       
    </tr>
    <tr>
        <th style="width:5%;text-align:center">Angka</th>
        <th style="text-align:center">Huruf</th>
        <th style="text-align:center">Indeks</th>
        
    </tr>
    </thead>
    <tbody>
    <?php 

        $no = 0;
        $totalsi = 0;
        $totalbobot = 0;
        foreach($nilai as $data):
             $dataee = $data->bobot_matkul * $data->nilai_indeks;
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->kode_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nama_matkul;?></td>
        <td style="text-align:center"><?php $totalbobot += $data->bobot_matkul; echo $data->bobot_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nilai_d;?></td>
        <td style="text-align:center"><?php echo $data->nilai_huruf;?></td>
        <td style="text-align:center"><?php echo $data->nilai_indeks;?></td>
        <td style="text-align:center"><?php $totalsi += $dataee; echo $dataee;?></td>
        
       
    </tr>
   
<?php endforeach; ?>

    <tr>
         <td colspan="3" style="text-align:right"> <b> Jumlah Bobot : </b></td>
        <td style="text-align:center">  <?php 
        if ($totalbobot == 0) {
            echo $totalbobot = 1;
        } else {
            echo $totalbobot;
        }  ?> </td>
        <td colspan="3" style="text-align:right"> <b> Jumlah sks * N.indeks : </b></td>
        <td style="text-align:center"> <?php echo $totalsi; ?></td>

    </tr>
    <tr>
        <th style="text-align:right" colspan="7"> IPS : </th>
        <th style="text-align:center"> <?php $ips = $totalsi / $totalbobot; echo round($ips, 2); ?>   </th>
    </tr>

  
  </tbody>
    </table>
    </div>
     </div>
   </div>
 </div>
</div>
<div class="box ">
<?php echo form_open('aktivitas_perkuliahan/save_edit_ap'); ?>

              <table class="table">
        <tr>
            <td width="15%" class="left_column">Nama</td>
            <td>: <input type="text" name="nama" id="nama" class="text-input" maxlength="16" style="width:40%" value="<?php echo $ap->nama_mahasiswa; ?>" readonly>
              <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" class="text-input" maxlength="16" style="width:40%" value="<?php echo $ap->id_mahasiswa; ?>" readonly>
              <input type="hidden" name="id_aktivitas" id="id_aktivitas" class="text-input" maxlength="16" style="width:40%" value="<?php echo $ap->id_aktivitas; ?>" readonly>
             
            </td>
            <td width="15%" class="left_column">Periode</td>
            <td>: <input type="text" name="semester" id="semester" class="text-input" maxlength="16" style="width:80%" value="<?php echo $ap->semester; ?>">
              <input type="hidden" name="id_periode" id="id_periode" class="text-input" maxlength="16" style="width:40%" value="<?php echo $ap->id_periode; ?>">

              <input type="hidden" name="semester_aktif" id="semester_aktif" class="text-input" maxlength="16" style="width:40%" value="<?php echo $ap->semester_ak + 1; ?>">
              
            </td>
        </tr>
        <tr>
             <td width="15%" class="left_column">Status Mahasiswa</td>
            <td>: <input type="text" name="Status" id="Status" class="text-input" maxlength="16" style="width:40%" value="<?php
            if($ap->id_status == 1){
              echo 'Aktif';
            } else if ($ap->id_status == '2'){
              echo 'Non-Aktif'; }
              else if($ap->id_status == '3'){
                echo 'Cuti';
              }
             ?>" readonly>
               <input type="hidden" name="id_status_ak" id="id_status_ak" class="text-input" maxlength="16" style="width:40%" value="<?php echo $ap->id_status; ?>">
            </td>

            <td class="left_column" width="15%">IPS</td>
            <td>: <input type="text" name="ips" id="ips" class="text-input" maxlength="16" size="30" style="width:40%" value="<?php echo round($ips,2); ?>">          </td>
        </tr>
        <tr>
             <td width="15%" class="left_column">Jumlah SKS Semester</td>
            <td>: <input type="text" name="sks_semester" id="sks_semester" class="text-input" maxlength="16" size="30" style="width:40%" value="<?php echo $totalbobot; ?>" readonly>
              
            </td>
            <td class="left_column" width="15%">IPK</td>
            <td>: <input type="text" name="ipk_ak" id="ipk_ak" class="text-input" maxlength="16" size="30" style="width:40%" value="<?php echo $ipk2; ?>">    
              <?php if ($ipk2 <= 3.5) {
                     $a = '7';
                } elseif ($ipk2 < 3.76) {
                     $a = '6';
                } else {
                     $a = '5';
                } ?>

             <input type="hidden" name="id_grade" id="id_grade" value="<?php echo $a; ?>">
                    </td>
        </tr>
        <tr>
             <td width="15%" class="left_column">Jumlah SKS total</td>
            <td>: <input type="text" name="sks_total" id="sks_total" class="text-input" maxlength="16" size="90" style="width:40%" value="<?php 
              if ($totalbobot2 == 1){
                $ab = '0';
              } else {
                $ab = $totalbobot2;
              }
            echo $ab; ?>">
              
            </td>
            <td width="15%" class="left_column"></td>
            <td> <button type="submit" class="btn btn-info">Simpan</button>
              
            </td>
        </tr>    
        <?php echo form_close();?>

        </table>
            
       
      </div>

        
    <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
            - Fitur ini di gunakan untuk menampilkan nilai perkuliahan mahasiswa setiap periode 
            <br />
            - Perhitungan IPS = Jumlah ( N.Indeks * sks ) / Jumlah sks
            <br />
            - Untuk mengisikan nilai , silahkan ke menu [ Nilai Perkuliahan ]   
            <br />
            
    </div>


</div>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    <script type="text/javascript">
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
</script>

<script type="text/javascript">
  function hai(){
   $.ajax({
                    url: '<?php echo base_url(); ?>mahasiswa/filter_nilai_ak/',
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
