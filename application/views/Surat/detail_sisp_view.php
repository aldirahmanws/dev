    <style type="text/css">
  @page {
  size: A4;
}

</style>      
      <?php echo $this->session->flashdata('message');?>
        <div class="box box-info">


            
            <!-- /.box-header -->
            <div class="box-body">
              <h3> DETAIL SURAT PENGANTAR RISET</h3><br>
              <table class="table" style="text-transform: uppercase;">
        <tr>

            <td width="15%" class="left_column"><b>No. Permohonan</b> </td>
            <td>:
               <?php echo $surat->no_permohonan; ?> </td>
      
            <td class="left_column"><b>Tgl. Permohonan</b> </td>
            <td>:  <?php echo date("d M Y", strtotime($surat->tgl_permohonan)); ?>
                                  
            <input type="hidden" name="stat_pd" value="A">
            </td>

        </tr>
        <tr>
            <td class="left_column" width="15%" value=><b>Nama</b> </td>
            <td width="35%">: <?php echo $surat->nama_mahasiswa; ?>        </td>
            <td class="left_column" width="15%"><b>Verifikator</b> </td>
            <td>:
              <?php if($surat->tgl_verifikasi != '0000-00-00') { ?> 
                <?php echo $surat->nama_dosen; ?>       
                <?php } ?>                    </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=><b>NIM</b> </td>
            <td width="35%">: <?php echo $surat->nim; ?>        </td>
            <td class="left_column" width="15%"><b>Tgl. Verifikasi</b> </td>
            <td>:
                 <?php if ($surat->tgl_verifikasi == '0000-00-00') { 
                  $a = '';
                 } else {
                  $a = date("d M Y", strtotime($surat->tgl_verifikasi));
                 } echo $a ?>                         </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=><b>Prodi</b> </td>
            <td width="35%">: <?php echo $surat->nama_prodi; ?>        </td>
            <td class="left_column" width="15%"><b>Approver</b> </td>
            <td>:
                 <?php echo $surat->approver; ?>                       </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=><b>Semester</b> </td>
            <td width="35%">: <?php echo $surat->semester_romawi; ?>        </td>
            <td class="left_column" width="15%"><b>Tgl. Persetujuan</b> </td>
            <td>: 
                 <?php if ($surat->tgl_persetujuan == '0000-00-00') { 
                  $a = '';
                 } else {
                  $a = date("d M Y", strtotime($surat->tgl_persetujuan));
                 } echo $a ?>                        </td>
        </tr>
         <tr>
            <td class="left_column" width="15%" value=><b>Status</b> </td>
            <td colspan="3" style="color: blue">: <b><?php $sudah_bayar = $this->db->query("SELECT count(*) AS total FROM tb_detail_pembayaran JOIN tb_biaya ON tb_biaya.id_biaya = tb_detail_pembayaran.id_biaya WHERE tb_biaya.nama_biaya LIKE 'Surat Pengantar Riset' AND tb_detail_pembayaran.id_mahasiswa = '$surat->id_mahasiswa'")->row(); if ($sudah_bayar->total >= 1) {
              $sudah = $surat->status_sisp;
            } else {
              $sudah = 'Payment Process';
            } echo $sudah;  ?> </b>      </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=><b>Nama PT</b> </td>
            <td colspan="3">: <?php echo $surat->nama_pt; ?>        </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=><b>Alamat PT</b> </td>
            <td colspan="3">: <?php echo $surat->alamat_pt; ?>        </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=><b>Keterangan</b> </td>
            <td colspan="3">: <?php echo $surat->note; ?>        </td>
        </tr>
        
        </table>
            </div>
            <!-- /.box-body -->
          </div>

          <?php if ($surat->id_status_sisp == 4 AND $this->session->userdata('level') != 5) { ?>
            <p class="btn btn-warning pull-right btn-flat" onclick="print1()" > Cetak </p>
          <?php } ?>
         
          <!-- nav-tabs-custom -->
   <section class="content" id="ea" style="display: none">
          
          <br>
          <br>
          <br>
          <br>
          
      <div class="row" style="margin-left: 10px; margin-right: 10px" class="page">
        
          
            <div class="box-header">
              <h3 class="box-title"> <br>
              <br>
              <br></h3>

             
              <div>
                <table>
                  <?php 
                  $tanggal = date('d-m-Y');
                  $bulan = array (1 =>   'Januari',
                                          'Februari',
                                          'Maret',
                                          'April',
                                          'Mei',
                                          'Juni',
                                          'Juli',
                                          'Agustus',
                                          'September',
                                          'Oktober',
                                          'November',
                                          'Desember'
                                        );
                    $split = explode('-', $tanggal);
                    $abc = $split[0] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[2];
                  ?>
                  <tr>
                    <td style="width: 100px" colspan="3">Nomor : <?php echo $surat->no_surat; ?></td>
                    <td style="text-align: right"><?php echo $abc; ?></td>
                  </tr>
                  <tr>
                    <td colspan="4"><br></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="width: 15%">Kepada Yth. <br> <b><?php echo $surat->nama_pt;?></b><br><?php echo $surat->alamat_pt; ?></td>
                    <td colspan="2"></td>
                  </tr>
                  <tr>
                    <td colspan="4"><br></td>
                  </tr>
                   <tr>
                    <td colspan="4">

                  </td>
                  </tr>
                  <tr>
                    <td colspan="4" style="text-align: center">Perihal : <u>Permohonan Bantuan untuk Mengadakan Penelitian (Riset) </u></td>
                  </tr>
                   <tr>
                    <td colspan="4"><br>

                  </td>
                  </tr>
                  <tr>
                    <td colspan="4">Dengan hormat,</td>
                  </tr>
                  <tr>
                    <td colspan="4"><br></td>
                  </tr>
                  <tr>
                    <td colspan="4">Berkenaan dengan penyelesaian tugas penyusunan skripsi bagi mahasiswa STIE Jakarta International College, mahasiswa kami telah memilih <?php echo $surat->nama_pt; ?> sebagai subyek penelitian.</td>
                  </tr>
                  <tr>
                    <td colspan="4"><br></td>
                  </tr>
                  <tr>
                    <td colspan="4">Oleh karena itu kami selaku Ketua Program Studi <?php echo $surat->nama_prodi; ?> STIE Jakarta International College, mohon kesediaan Bapak/Ibu untuk memberikan ijin bagi mahasiswa kami :</td>
                  </tr>
                   <tr>
                    <td colspan="4"><br></td>
                  </tr>
                  <tr>
                    <td style="width: 5%">Nama </td>
                    <td colspan="3">: <?php echo $surat->nama_mahasiswa; ?></td>
                  </tr>
                   <tr>
                    <td style="width: 5%">NIM </td>
                    <td colspan="3">: <?php echo $surat->nim; ?></td>
                  </tr>
                   <tr>
                    <td style="width: 5%">Jurusan </td>
                    <td colspan="3">: <?php echo $surat->nama_prodi; ?></td>
                  </tr>
                   <tr>
                    <td style="width: 5%">Semester </td>
                    <td colspan="3">: <?php echo $surat->semester_romawi; ?></td>
                  </tr>
                   <tr>
                    <td style="width: 5%">Judul Skripsi</td>
                    <td colspan="3">: <?php echo $surat->judul_skripsi; ?></td>
                  </tr>
                   <tr>
                    <td colspan="4"><br>

                  </td>
                  </tr>
                  <tr>
                    <td colspan="4">Untuk melakukan penelitian dan pengumpulan data di institusi yang Bapak/Ibu pimpin.
                  </td>
                  </tr>
                   <tr>
                    <td colspan="4"><br>

                  </td>
                  </tr>
                  <tr>
                    <td colspan="4">Mohon pula bantuan Bapak/Ibu memberikan surat keterangan telah menyelesaikan riset, setelah mahasiswa yang bersangkutan selesai melakukan penelitian.

                  </td>
                  </tr>
                   <tr>
                    <td colspan="4"><br>

                  </td>
                  </tr>
                  <tr>
                    <td colspan="4">Demikian permohonan ini kami sampaikan. Atas bantuan dan kerjasama yang baik, kami ucapkan terima kasih.

                  </td>
                  </tr>
                  <tr>
                    <td colspan="4"><br>
                  </td>
                  </tr>
                  <tr>
                    <td colspan="4"><br>

                  </td>
                  </tr>
                  <tr>
                    <td>Hormat Kami, <br> STIE JIC

                  </td>
                  <td colspan="3">

                  </td>
                  </tr>
                   <tr>
                    <td colspan="4"><br>
                  </td>
                  </tr>
                  <tr>
                    <td colspan="4"><br>

                  </td>
                  </tr>
                  <tr>
                    <td colspan="4"><br>

                  </td>
                  </tr>
                  <tr>
                    <td colspan="4"><br>

                  </td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo $surat->nama_dosen;?> <br> Kaprodi <?php echo $surat->nama_prodi;?>

                  </td>
                  <td colspan="2"></td>
                  </tr>
                  <tr>
                    <td colspan="4"><br>

                  </td>
                  </tr>
                  <tr>
                    <td colspan="4">Cc. Ketua STIE JIC

                  </td>
                  </tr>
                  

                </table>
              </div>
        
   
            
            <!-- /.box-header -->
           
              
              
                  
              
          
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

       
        
       
        
        
        <!-- /.col -->
      
      <!-- /.row -->
    </section>

     <script>
    function print1(){
      
     var printContents = document.getElementById("ea").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents; 
    }
    //window.location = '<?= base_url(); ?>surat/data_sisp_approved';
  </script>