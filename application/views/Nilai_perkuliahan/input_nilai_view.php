
<div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-pencil"></i> Input Nilai</div>
            <div class="panel-body">
              <div class="row">
         <form  method="post" action="<?php echo base_url(); ?>nilai_perkuliahan/save_edit_nilai/<?php echo $dnilai->id_kelas_mhs; ?>/<?php echo $dnilai->id_mahasiswa; ?>/<?php echo $dnilai->id_detail_kurikulum; ?>" enctype="multipart/form-data">
    <table class="table">
      <tr>
            <td class="left_column">Nama Mahasiswa</td>
            <td>: <?php echo $dnilai->nama_mahasiswa; ?>
             </td>
        </tr> 
        <tr>
            <td class="left_column">NIM </td>
            <td>: <?php echo $dnilai->nim; ?> 
             </td>
        </tr> 
        <tr>
            <td class="left_column">Mata Kuliah </td>
            <td>: <?php echo $dnilai->nama_matkul; ?> 
             </td>
        </tr> 
        <tr>
            <td class="left_column">Absensi (<?php echo $persentase->persen_absensi; ?>%)</td>
            <td>: <input type="text" name="absensi" id="absensi" class="validate[required] text-input" size="50" style="width:5%" maxlength="5" required="" value="<?php echo $dnilai->absensi; ?>"  onkeyup="sum(); get_skala()">
             </td>
        </tr> 
         <tr>
            <td class="left_column">Nilai Tugas & Latihan (<?php echo $persentase->persen_tugas; ?>%)</td>
            <td>: <input type="text" name="nilai_tugas" id="nilai_tugas" class="validate[required] text-input" size="50" style="width:5%" maxlength="5" required="" value="<?php echo $dnilai->nilai_tugas; ?>" onkeyup="sum(); get_skala()">
             </td>
        </tr> 
        <tr>
            <td class="left_column">Penyajian Paper (<?php echo $persentase->persen_paper; ?>%)</td>
            <td>: <input type="text" name="nilai_paper" id="nilai_paper" class="validate[required] text-input" size="50" style="width:5%" maxlength="5" required="" value="<?php echo $dnilai->nilai_paper; ?>" onkeyup="sum(); get_skala()">
             </td>
        </tr> 
         <tr>
            <td class="left_column">Nilai UTS (<?php echo $persentase->persen_uts; ?>%)</td>
            <td>: <input type="text" name="nilai_uts" id="nilai_uts" class="validate[required] text-input" size="50" style="width:5%" maxlength="5" required="" value="<?php echo $dnilai->nilai_uts; ?>" onkeyup="sum(); get_skala()">
             </td>
        </tr> 
         <tr>
            <td class="left_column">Nilai UAS (<?php echo $persentase->persen_uas; ?>%)</td>
            <td>: <input type="text" name="nilai_uas" id="nilai_uas" class="validate[required] text-input" size="50" style="width:5%" maxlength="5" required="" value="<?php echo $dnilai->nilai_uas; ?>" onkeyup="sum(); get_skala()">
             </td>
        </tr> 
        <tr>
            <td class="left_column">Nilai Akhir</td>
            <td>: <input type="text"  name="nilai" id="nilai" class="validate[required] text-input" size="50" style="width:5%;background-color: #E0E0E0" maxlength="5" required="" value="<?php echo $dnilai->nilai_d; ?>" onkeyup="return get_skala(this.value)">  <input type="hidden" name="id_skala_nilai" id="ee" value="">
              <input type="hidden" name="id_kp" id="kp" value="<?php echo $dnilai->id_kp; ?>">
               <input type="hidden" name="id_prodi" id="id_prodi" value="<?php echo $dnilai->id_prodi; ?>">
               
             </td>
        </tr> 

                  <tr>
                    <td colspan="5"><button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button>
                      <a class="btn btn-default btn-flat" style="margin-right: 10px"  href="<?php echo base_url(); ?>nilai_perkuliahan/detail_nilai/<?php echo $this->uri->segment(4); ?>"><i class="fa fa-angle-left"></i> Back </a>
                    </td>
                    
                  </tr>

    </table>

</div>
</form>
</div>
</div>
<div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
         - Nilai akhir dijumlah secara otomatis sesuai persentase yang telah disepakati.

         <br>

  &nbsp; <b> Notes 1 : User bisa menginput manual nilai akhir yang tidak memerlukan semua komposisi nilai dan persentase. </b> 
  <br>
  &nbsp; <b> Notes 2 : Nilai akhir yang berbeda persentase tapi tetap butuh semua atau 1 komposisi nilai maka harus diinput di akhir ketika komposisi nilai lain selesai diinput. </b>


         </div>



<script>
function sum() {
      var absensi = document.getElementById('absensi').value;
      var nilai_tugas = document.getElementById('nilai_tugas').value;
      var nilai_paper = document.getElementById('nilai_paper').value;
      var nilai_uts = document.getElementById('nilai_uts').value;
      var nilai_uas = document.getElementById('nilai_uas').value;

      var persentase_absensi = '<?= $persentase->persen_absensi; ?>';
      var persentase_tugas = '<?= $persentase->persen_tugas; ?>';
      var persentase_paper = '<?= $persentase->persen_paper; ?>';
      var persentase_uts = '<?= $persentase->persen_uts; ?>';
      var persentase_uas = '<?= $persentase->persen_uas; ?>';

      		var nilai_akhir = ( parseInt(absensi) * persentase_absensi / 100 )  + ( parseInt(nilai_tugas) * persentase_tugas / 100 )  + ( parseInt(nilai_paper) * persentase_paper  / 100 )  + ( parseInt(nilai_uts) * persentase_uts / 100 )  + ( parseInt(nilai_uas) * persentase_uas / 100 )  ;
      if (!isNaN(nilai_akhir)) {
         document.getElementById('nilai').value = nilai_akhir;
         console.log(persentase_absensi);
      }
}
</script>


<script type="text/javascript">
            function get_skala(p) {
                var nilai = document.getElementById('nilai').value;
                var id_prodi = document.getElementById('id_prodi').value;

                $.ajax({
                    url: '<?php echo base_url(); ?>nilai_perkuliahan/get_skala/',
                    data: 'nilai='+nilai+'&id_prodi='+id_prodi,
                    type: 'POST',
                    dataType: 'html',
                    success: function(data) {
                      // console.log(data);
                        document.getElementById('ee').value = data;
                    },
                    error:function (){}
                });
            }
</script>


