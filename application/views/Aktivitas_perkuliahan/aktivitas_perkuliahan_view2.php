<?php 
// print_r($nilai_ta_sblm);
?>
        <div class="box box-info">
        <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_0" data-toggle="tab">Rincian Data IPS Periode <?php echo $this->input->get('semester') ?></a></li>
             <li><a href="#tab_1" data-toggle="tab">Rincian Data IPK Hingga Periode <?php echo $this->input->get('semester') ?></a></li> 
             <li><a href="#tab_2" data-toggle="tab">Rincian Data IPK untuk perolehan grade</a></li>
            
             
            </ul>

        <div class="tab-content">

         <div class="tab-pane" id="tab_1">

<table id="table1" class="table table-striped table-bordered" >
    <thead>
    <tr>
        <th style="width:5%;text-align:center" rowspan="2">No.</th>
        <th style="text-align:center" rowspan="2">Kode MK</th>
        <th style="text-align:center" rowspan="2">Nama MK</th>
         <th style="text-align:center" rowspan="2">Semester</th>
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
        foreach($nilai_ipk as $data):
             $dataee = $data->bobot_matkul * $data->nilai_indeks;
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->id_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nama_matkul;?></td>
        <td style="text-align:center"><?php echo $data->semester_kurikulum;?></td>
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


   

    <input type="hidden" name="ipk" id="ipk" value="<?php $ipk2 = round($ipk, 2); echo $ipk2; ?>"> 


     

</div>

<div class="tab-pane" id="tab_2">


    <table id="table1" class="table table-striped table-bordered" >

      <h3>Semester <?php echo $this->input->get('semester_aktif'); ?></h3>
    <thead>
    <tr>
        <th style="width:5%;text-align:center" rowspan="2">No.</th>
        <th style="text-align:center" rowspan="2">Kode MK</th>
        <th style="text-align:center" rowspan="2">Nama MK</th>
         <th style="text-align:center" rowspan="2">Semester</th>
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
        $totalsi_skrg = 0;
        $totalbobot_skrg = 0;
        foreach($nilai_ips_skrg as $data):
             $dataee = $data->bobot_matkul * $data->nilai_indeks;
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->id_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nama_matkul;?></td>
        <td style="text-align:center"><?php echo $data->semester_kurikulum;?></td>
        <td style="text-align:center"><?php $totalbobot_skrg += $data->bobot_matkul; echo $data->bobot_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nilai_d;?></td>
        <td style="text-align:center"><?php echo $data->nilai_huruf;?></td>
        <td style="text-align:center"><?php echo $data->nilai_indeks;?></td>
        <td style="text-align:center"><?php $totalsi_skrg += $dataee; echo $dataee;?></td>
        
       
    </tr>
   
<?php endforeach; ?>

    <tr>
         <td colspan="4" style="text-align:right"> <b> Jumlah Bobot : </b></td>
        <td style="text-align:center">  <?php 
        if ($totalbobot_skrg == 0) {
            echo $totalbobot_skrg = 1;
        } else {
            echo $totalbobot_skrg;
        }  ?> </td>
        <td colspan="3" style="text-align:right"> <b> Jumlah sks * N.indeks : </b></td>
        <td style="text-align:center"> <?php echo $totalsi_skrg; ?></td>

    </tr>
    <tr>
        <th style="text-align:right" colspan="8"> IPK : </th>
        <th style="text-align:center"> <?php $ipk_skrg = $totalsi_skrg / $totalbobot_skrg; echo round($ipk_skrg, 2); ?>   </th>
    </tr>

    

  
  </tbody>
    </table>

    <input type="hidden" name="ipk_skrg" id="ipk_skrg" value="<?php echo $totalsi_skrg ?>">
    <input type="hidden" name="bobot_skrg" id="bobot_skrg" value="<?php echo $totalbobot_skrg ?>">


     <table id="table1" class="table table-striped table-bordered" >
       <h3>Semester <?php echo $this->input->get('semester_aktif') -1; ?></h3>
    <thead>
    <tr>
        <th style="width:5%;text-align:center" rowspan="2">No.</th>
        <th style="text-align:center" rowspan="2">Kode MK</th>
        <th style="text-align:center" rowspan="2">Nama MK</th>
         <th style="text-align:center" rowspan="2">Semester</th>
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
        $totalsi_sblm = 0;
        $totalbobot2_sblm = 0;

        foreach($nilai_ips_sblm as $data):
             $dataee = $data->bobot_matkul * $data->nilai_indeks;
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->id_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nama_matkul;?></td>
        <td style="text-align:center"><?php echo $data->semester_kurikulum;?></td>
        <td style="text-align:center"><?php $totalbobot2_sblm += $data->bobot_matkul; echo $data->bobot_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nilai_d;?></td>
        <td style="text-align:center"><?php echo $data->nilai_huruf;?></td>
        <td style="text-align:center"><?php echo $data->nilai_indeks;?></td>
        <td style="text-align:center"><?php $totalsi_sblm += $dataee; echo $dataee;?></td>
        
       
    </tr>
   
<?php endforeach; ?>

    <tr>
         <td colspan="4" style="text-align:right"> <b> Jumlah Bobot : </b></td>
        <td style="text-align:center">  <?php 
        if ($totalbobot2_sblm == 0) {
            echo $totalbobot2_sblm = 1;
        } else {
            echo $totalbobot2_sblm;
        }  ?> </td>
        <td colspan="3" style="text-align:right"> <b> Jumlah sks * N.indeks : </b></td>
        <td style="text-align:center"> <?php echo $totalsi_sblm; ?></td>

    </tr>
    <tr>
        <th style="text-align:right" colspan="8"> IPK : </th>
        <th style="text-align:center"> <?php $ipk_sblm = $totalsi_sblm / $totalbobot2_sblm; echo round($ipk_sblm, 2); ?>   </th>
    </tr>

  
  </tbody>

    <input type="hidden" name="ipk_skrg" id="ipk_skrg" value="<?php echo $totalsi_sblm ?>">

    <input type="hidden" name="bobot_skrg" id="bobot_skrg" value="<?php echo $totalbobot2_sblm ?>">
    </table>

    <?php

    if ($totalbobot2_sblm == 1) {
      $total_bobot_sblm_final = 0;
    } else {
      $total_bobot_sblm_final = $totalbobot2_sblm;
    }

    if ($totalbobot_skrg == 1) {
      $total_bobot_skrg_final = 0;
    } else {
      $total_bobot_skrg_final = $totalbobot_skrg;
    }

    $total_bobot_final = $totalbobot2_sblm + $total_bobot_skrg_final;
    $total_sks_indeks = $totalsi_sblm + $totalsi_skrg;

    $ipk_final = $total_sks_indeks / $total_bobot_final;

    $ipk_jadi = round($ipk_final,2);

     ?>

     <h4> Total Bobot = <b> <?php echo $total_bobot_final ?> </b> <br> </h4>
      <h4> Total Sks * Nilai Indeks = <b> <?php echo $total_sks_indeks ?> </b> <br> </h4>
     <h4>  IPK = <b>  <?php echo $ipk_jadi ?> </b> <br> </h4>

     

</div>

        <div class="tab-pane active" id="tab_0">

                
              
              
        <table id="table1" class="table table-striped table-bordered" >
    <thead>
    <tr>
        <th style="width:5%;text-align:center" rowspan="2">No.</th>
        <th style="text-align:center" rowspan="2">Kode MK</th>
        <th style="text-align:center" rowspan="2">Nama MK</th>  
        <th style="text-align:center" rowspan="2">Semester</th>        
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
        $totalbobot = 0;
        foreach($nilai as $data):
             $dataee = $data->bobot_matkul * $data->nilai_indeks;
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->id_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nama_matkul;?></td>
        <td style="text-align:center"><?php echo $data->semester_kurikulum;?></td>
        <td style="text-align:center"><?php $totalbobot += $data->bobot_matkul; echo $data->bobot_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nilai_d;?></td>
        <td style="text-align:center"><?php echo $data->nilai_huruf;?></td>
        <td style="text-align:center"><?php echo $data->nilai_indeks;?></td>
        <td style="text-align:center"><?php $totalsi += $dataee; echo $dataee;?></td>
        
       
    </tr>
   
<?php endforeach; ?>

    <tr>
         <td colspan="4" style="text-align:right"> <b> Jumlah Bobot : </b></td>
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
        <th style="text-align:right" colspan="8"> IPS : </th>
        <th style="text-align:center"> <?php $ips = $totalsi / $totalbobot; echo round($ips, 2); ?>   </th>
    </tr>

  
  </tbody>
    </table>
    </div>
     </div>
   </div>
 </div>
</div>
<?php 


?>
<div class="box ">
<?php echo form_open('aktivitas_perkuliahan/save_ap'); ?>

              <table class="table">
        <tr>
            <td width="15%" class="left_column">Nama</td>
            <td>: <input type="text" name="nama" id="nama" class="text-input" maxlength="16" style="width:40%" value="<?php echo $this->input->get('nama_m'); ?>" readonly>
              <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" class="text-input" maxlength="16" style="width:40%" value="<?php echo $this->input->get('id_mahasiswa'); ?>" readonly>
              <input type="hidden" name="semester_ak" id="semester_ak" class="text-input" maxlength="16" style="width:40%" value="<?php if ($this->input->get('smt_pindah') != NULL) {
                echo $this->input->get('smt_pindah');
              } else {
                echo $this->input->get('semester_aktif');
              }
              ?>">


             
            </td>
            <td width="15%" class="left_column">Periode</td>
            <td>: <input type="text" name="semester" id="semester" class="text-input" maxlength="16" style="width:80%" value="<?php echo $this->input->get('semester') ?>">
              <input type="hidden" name="id_periode" id="id_periode" class="text-input" maxlength="16" style="width:40%" value="<?php echo $this->input->get('id_periode') ?>">

              <?php  

            

        


              ?>

              <input type="hidden" name="semester_aktif" id="semester_aktif" class="text-input" maxlength="16" style="width:40%" value="<?php 
              if($this->input->get('id_status_ak') == '19'){
              echo $this->input->get('semester_aktif') + 1;
              } else {
                echo $this->input->get('semester_aktif'); 
              }
              ?>">
              
            </td>
        </tr>
        <tr>
             <td width="15%" class="left_column">Status Mahasiswa</td>
            <td>: <input type="text" name="Status" id="Status" class="text-input" maxlength="16" style="width:40%" value="<?php 
            if ($this->input->get('id_status_ak') == 19){
              $a = 'Aktif'; }
              else if ($this->input->get('id_status_ak') == 2){
              $a = 'Non Aktif'; }
              else if($this->input->get('id_status_ak') == 3){
                $a = 'Cuti';
              } else {
                $a = 'Pindahan';
              }
            echo $a; ?>" readonly>
               <input type="hidden" name="id_status_ak" id="id_status_ak" class="text-input" maxlength="16" style="width:40%" value="<?php 
                if ($this->input->get('id_status_ak') == 6) {
                  echo '19';
                } else {
                  echo $this->input->get('id_status_ak');
                }
               ?>">

               
            </td>

            <td class="left_column" width="15%">IPS</td>
            <td>: <input type="text" name="ips" id="ips" class="text-input" maxlength="16" size="30" style="width:40%" value="<?php 
              if ($this->input->get('id_status_ak') == 19){
              $a = round($ips,2);}
              else if ($this->input->get('id_status_ak') == 2){
              $a = '0'; }
              else if($this->input->get('id_status_ak') == 3){
                $a = '0';
              } else {
                $a = round($ips,2);
              }
            echo$a;

            ?>">          </td>
        </tr>
        <tr>
             <td width="15%" class="left_column">Jumlah SKS Semester</td>
            <td>: <input type="text" name="sks_semester" id="sks_semester" class="text-input" maxlength="16" size="30" style="width:40%" value="<?php 
            if ($this->input->get('id_status_ak') == 19){
              if ($totalbobot == 1){
                $ab = '0';
              } else {
                $ab = $totalbobot;
              }
              $a = $ab; }
              else if ($this->input->get('id_status_ak') == 2){
              $a = '0'; }
              else if($this->input->get('id_status_ak') == 3){
                $a = '0';
              } else {
                $a = $totalbobot;
              }
            echo $a; ?>" readonly>
              
            </td>
            <td class="left_column" width="15%">IPK</td>
            <td>: <input type="text" name="ipk_ak" id="ipk_ak" class="text-input" maxlength="16" size="30" style="width:40%" value="<?php echo $ipk2; ?>">    
             

              <?php $gradee = $this->db->select('id_grade AS wow')
                    ->where('grade_awal <=', $ipk_jadi)
                    ->where('grade_akhir >=', $ipk_jadi)
                    ->like('grade', 'gr')
                    ->where('tgl_awal_grade <=', $this->input->get('tgl_du'))
                    ->where('tgl_akhir_grade >=', $this->input->get('tgl_du'))
                    ->get('tb_grade')
                    ->row();

                    $grade_atas = $this->db->select('id_grade AS wew')
                    ->like('grade', 'non')
                    ->where('grade_akhir <=', 4)
                    ->where('tgl_awal_grade <=', $this->input->get('tgl_du'))
                    ->where('tgl_akhir_grade >=', $this->input->get('tgl_du'))
                    ->get('tb_grade')
                    ->row();
              ?>

                <?php if ($this->input->get('semester_aktif') == 1 OR $this->input->get('semester_aktif') == 3 OR $this->input->get('semester_aktif') == 5 OR $this->input->get('semester_aktif') == 7 OR $this->input->get('asal_pt') != 1 AND $this->input->get('asal_pt') != '' AND $this->input->get('asal_pt') != NULL AND $this->input->get('asal_pt') != ' ') {
                 $grade_aktif = $this->input->get('id_grade');
                } elseif ($this->input->get('semester_aktif') >= 9) {
                  $grade_aktif = $grade_atas->wew;
                } elseif ($this->input->get('id_waktu') == 2) {
                  $grade_aktif = $grade_atas->wew;
                } else {
                  $grade_aktif = $gradee->wow;
                }

                ?>

             <input type="hidden" name="id_grade" id="id_grade" value="<?php echo $grade_aktif; ?>">
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

            <td width="15%" class="left_column">IPK Grade</td>
            <td>: <input type="text" name="ipk_grade" id="ipk_grade" class="text-input" maxlength="16" style="width:40%" value="<?php
              
              echo $ipk_jadi;

              ?>
              ">
              
            </td>
           
        </tr>    

        <tr>
            <td width="15%" class="left_column">Semester Sekarang</td>
            <td>: <input type="text" name="semester_skrg" id="semester_skrg" class="text-input" maxlength="16" style="width:40%" value="<?php
              echo $this->input->get('semester_aktif');
              ?>">
              
            </td>

           <td width="15%" class="left_column">Grade Baru</td>
            <td>: <input type="text" name="grade_aktif" id="grade_aktif" class="text-input" maxlength="16" style="width:70%" value="<?php
              $grade_lama = $this->db->where('id_grade', $this->input->get('id_grade'))->get('tb_grade')->row(); 

              echo $grade_lama->grade;

              ?>
              ">
              
            </td>
              
            </td>
        </tr>    

        <tr>
            <td width="15%" class="left_column">Semester Berikutnya</td>
            <td>: <input type="text" name="grade_sblm" id="grade_sblm" class="text-input" maxlength="16" style="width:40%" value="<?php 
              if($this->input->get('id_status_ak') == '19'){
              echo $this->input->get('semester_aktif') + 1;
              } else {
                echo $this->input->get('semester_aktif'); 
              }
              ?>">
              
            </td>

             <td width="15%" class="left_column">Grade Sebelumnya </td>
            <td>: <input type="text" name="grade_aktif" id="grade_aktif" class="text-input" maxlength="16" style="width:70%" value="<?php
              $grade_baru = $this->db->where('id_grade', $grade_aktif)->get('tb_grade')->row(); 

              echo $grade_baru->grade;

              ?>
              ">
              
            </td>
        </tr>   
         <tr>
            <td width="15%" class="left_column"> Waktu </td>
            <td> : <b> <?php $mahasiswa = $this->db->join('tb_waktu','tb_waktu.id_waktu=tb_mahasiswa.id_waktu')->where('id_mahasiswa', $this->input->get('id_mahasiswa'))->get('tb_mahasiswa')->row();

            echo $mahasiswa->waktu; ?> </b>
              
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
