<style type="text/css">
  @page {
  size: A4;
}

</style>


<body onload="myFunction()" class="page">
   <section class="content" id="ea" >
          
    
          <br>
          <br>
      <div class="row">
        
          
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
  </body>

     <script>
      print1();
    function print1(){
      
     var printContents = document.getElementById("ea").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents; 
    }

    function myFunction(){
window.close();
}

  </script>