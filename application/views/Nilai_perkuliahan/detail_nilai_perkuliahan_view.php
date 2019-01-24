        
        <?php echo $this->session->flashdata('message');?>
        <div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table">
        <tr>


            <td width="15%" class="left_column">Program Studi <font color="#FF0000">*</font></td>
            <td>: <?php echo $kp->nama_prodi; ?>   </td>
            <td class="left_column" width="15%" value=>Semester <font color="#FF0000">*</font></td>
            <td width="35%">: <?php echo $kp->semester; ?>       </td>
           
                                  
            <input type="hidden" name="stat_pd" value="A">
            </td>
        </tr>
        <tr>
            <td class="left_column" width="15%">Mata Kuliah <font color="#FF0000">*</font></td>
            <td>:
               <?php echo $kp->kode_matkul; ?> - <?php echo $kp->nama_matkul; ?> ( <?php echo $kp->bobot_matkul; ?> )                        </td>
               <td class="left_column" width="15%">Nama Kelas <font color="#FF0000">*</font></td>
            <td>:
               <?php echo $kp->nama_kelas; ?>                        </td>
        </tr>
        
        </table>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="">

            <?php 
               if($this->session->userdata('level') == 1){ ?>

            <a class="btn btn-default btn-sm btn-flat pull-right"  href="<?php echo base_url(); ?>nilai_perkuliahan"><i class="fa fa-angle-left"></i> Back</a>
            <?php } ?>

             <?php 
               if($this->session->userdata('level') == 2){ ?>

            <a class="btn btn-primary btn-flat btn-sm pull-right" style="margin-right: 10px"  href="<?php echo base_url(); ?>master_dosen/nilai_dosen/<?php echo $this->uri->segment(4); ?>"></i> Daftar Kelas </a>

          <?php } ?>

            <p class="btn btn-primary btn-flat btn-sm pull-right" style="margin-right: 10px" onclick="print1()"><i class="fa fa-print"></i>  Cetak Absensi</p>
            <br><br>
          </div>

          <div class="box box-info">
            <table class="table table-bordered table-striped" id="example3" style="text-transform: uppercase;">
  <thead>
  <tr>
    <th style="width:5%" style="text-align:center" rowspan="2">No.</th>
    <th width="15%" style="text-align:center" rowspan="2">NIM</th>
    <th width="25%" style="text-align:center" rowspan="2">Nama Mahasiswa</th>
    <th width="5%" style="text-align:center" rowspan="2">Angkatan</th>
    <th width="5%" style="text-align:center" rowspan="2">Absensi</th>
    <th width="5%" style="text-align:center" colspan="4">Nilai</th>
    <th width="10%" style="text-align:center" colspan="2">Nilai Akhir</th>
    <th style="text-align:center" rowspan="2"> Aksi</th>
  </tr>
   <tr>
    <th  style="text-align:center">Tugas</th>
    <th  style="text-align:center">Paper</th>
    <th style="text-align:center">UTS</th>
    <th  style="text-align:center">UAS</th>
    <th  style="text-align:center">Angka</th>
    <th  style="text-align:center">Huruf</th>
  </tr>
  </thead>
  <tbody>
    <?php 
        $no = 0;
        foreach($nilai as $data):
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->nim;?></td>
        <td style="text-align:center"><?php echo $data->nama_mahasiswa;?></td>
        <td style="text-align:center"><?php echo substr($data->tgl_du, 0, 4);?></td>
        <td style="text-align:center"><?php if ($data->absensi == 0) {
          $a = '<font style="color:red" class="glyphicon glyphicon-warning-sign"></font>';
        } else {
          $a = $data->absensi; }; echo $a;?></td>
        <td style="text-align:center"><?php if ($data->nilai_tugas == 0) {
          $a = '<font style="color:red" class="glyphicon glyphicon-warning-sign"></font>';
        } else {
          $a = $data->nilai_tugas; }; echo $a;?></td>
        <td style="text-align:center"><?php if ($data->nilai_paper == 0) {
          $a = '<font style="color:red" class="glyphicon glyphicon-warning-sign"></font>';
        } else {
          $a = $data->nilai_paper; }; echo $a;?></td>
        <td style="text-align:center"><?php if ($data->nilai_uts == 0) {
          $a = '<font style="color:red" class="glyphicon glyphicon-warning-sign"></font>';
        } else {
          $a = $data->nilai_uts; }; echo $a;?></td>
       <td style="text-align:center"><?php if ($data->nilai_uas == 0) {
          $a = '<font style="color:red" class="glyphicon glyphicon-warning-sign"></font>';
        } else {
          $a = $data->nilai_uas; }; echo $a;?></td>
        <td style="text-align:center"><?php if ($data->nilai_d == 0) {
          $a = '<font style="color:red" class="glyphicon glyphicon-warning-sign"></font>';
        } else {
          $a = $data->nilai_d; }; echo $a;?></td>
        <td style="text-align:center"><?php echo $data->nilai_huruf;?> ( <?php echo $data->nilai_indeks;?> ) </td >
        <td style="text-align:center"> 
          <?php if ($data->tgl_awal_kul <= date('Y-m-d') AND $data->tgl_akhir_kul >= date('Y-m-d')){ ?>

                 <a href="<?php echo base_url(); ?>nilai_perkuliahan/edit_nilai/<?php echo $data->id_kelas_mhs; ?>/<?php echo $data->id_kp; ?>" class="btn btn-warning btn-xs btn-flat"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext"> Input Nilai </span></a>
          <?php } ?>

    </tr>
<?php endforeach; ?>
  
  </tbody>
</table>

          </div>

           <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
           - Digunakan untuk menginputkan nilai mahasiswa aktif pada semester ini (Klik icon pensil "input nilai" untuk memasukan data nilai).

           <br>

           - <b>Jika angka 0 diinputkan, sama dengan nilai kosong (belum diinput), angka 0 atau kosong diberi tanda seru segitiga merah.</b>

           <br>

           - Tanda nilai akhir sudah terisi adalah munculnya nilai indeks (nilai huruf). 

         </div>

           <div class="tab-pane" id="tab_3">
                <section class="content" id="ea" style="display: none">

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
            <td colspan="3">:  <?php echo $kp->semester; ?>           
            </td>
        <td class="left_column">Total Mahasiswa</td>
        
            <td colspan="3">: <b> <?php echo $dsn['jumlah_mhs']; ?>  </b> mahasiswa</td>

        </tr>
        <tr>
<td class="left_column">Nama Kelas <font color="#FF0000">*</font>
            </td>
          <td colspan="3">: 
      <?php echo $kp->nama_kelas; ?> </td>

      
            <td class="left_column">Dosen</td>
            <td colspan="3">: 
      <?php echo $kp->nama_dosen; ?> </td>
          
    </tr>


       
       
    </tbody></table>
      
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 2%">No</th>
                    <th style="width: 18%">Nama Mahasiswa</th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    


                  <!-- <th>Aksi</th> -->
                </tr>
                </thead>
                <tbody> 
                  <?php 
                    $no = 0;
                    $alert = "'Apakah anda yakin menghapus data ini ?'";
                    //
                foreach ($mhs as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_mahasiswa.'</a></td>
                  <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>
                    <th style="width: 4%"></th>

                ' ;
              }
             


              ?>
             
                        
                    </tr>
                </tbody>
              </table>
           
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
              </div>

              <script>
    function print1(){
      //document.getElementById("ngok").style.display = "block";
      //document.getElementById("ngoks").style.display = "block";
      //document.getElementById("ngoks1").style.display = "block";
     var printContents = document.getElementById("ea").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents; 
    }
  </script>
           

        
        
       