<div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-pencil"></i> Edit Kelas Perkuliahan</div>
            <div class="panel-body">
              <div class="row">
         <form  method="post" action="<?php echo base_url(); ?>kelas_perkuliahan/save_edit_kp/<?php echo $kp->id_kp; ?>" enctype="multipart/form-data">
		<table class="table">
    	   <tr>
          <td class="left_column">Mata Kuliah 
            </td>
          <td colspan="9">: 
      <input type="text" name="jadwal" id="jadwal" class="validate[required] text-input"  size="5" style="width: 90%;background-color:#E0E0E0" required="" placeholder="Masukan mata kuliah yang sudah terjadwal"  value="<?php echo $kp->nama_matkul; ?>" readonly>
      <input type="hidden" name="id_jadwal" id="id_jadwal" class="validate[required] text-input"  size="5" style="width: 90%;" value="<?php echo $kp->id_jadwal; ?>"></td>
        </tr> 
        <tr>
          <td class="left_column">Nama Kelas 
            </td>
          <td colspan="9">: 
      <input type="text" name="nama_kelas" id="nama_kelas" class="validate[required] text-input"  size="5" style="width: 40%;" required="" value="<?php echo $kp->nama_kelas; ?>"> </td>
        </tr> 
        <tr>
          <td class="left_column">Konsentrasi 
            </td>
          <td colspan="9">: 
      <input type="text" name="konsentrasi" id="id_konsentrasi" class="validate[required] text-input"  size="5" style="width: 40%; background-color:#E0E0E0" readonly="" value="<?php echo $kp->nama_konsentrasi; ?>">
      </td>
        </tr> 
        <tr>
          <td class="left_column">Bahasan</td>
            <td colspan="9">: 
      <textarea wrap="soft" name="bahasan" id="bahasan" class="text-input" rows="5" cols="50" maxlength="200"><?php echo $kp->bahasan; ?></textarea></td>
        </tr>
        <tr>
          <input type="hidden" name="id_kp" id="id_kp" class="text-input" maxlength="3" size="2"  style="width:10%" value="<?php echo $this->uri->segment(3); ?>"> 
         <td class="left_column">Tanggal Mulai Efektif</td>
            <td colspan="9">:
        <input type="date" name="tgl_mulai" id="tgl_mulai" class="text-input hasDatepicker" maxlength="50" size="50" style="width:50%" value="<?php echo $kp->tgl_mulai; ?>">            </td>
        </tr>
        <tr>
          <td class="left_column">Tanggal Akhir Efektif 
         </td>
         <td colspan="9">:
        <input type="date" name="tgl_akhir" id="tgl_akhir" class="text-input hasDatepicker" maxlength="50" size="50" style="width:50%" value="<?php echo $kp->tgl_akhir; ?>">            </td>
        </tr>
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button></td>
                  </tr>
    </table>
    </form>
</div>

<script type="text/javascript">
            function get_prodi_periode(p) {
                var id_prodi = p;

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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
 <script>
       document.getElementById("jadwal").style.visibility = 'visible';

    jQuery(document).ready(function($){
    $('#jadwal').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete_jadwal', 
      minLength:1,
      select: function(event, ui){
        $('#jadwal').val(ui.item.label);
        $('#id_jadwal').val(ui.item.id);
        $('#ruang').val(ui.item.ruang);
        $('#prodi').val(ui.item.prodi);
        $('#konsentrasi').val(ui.item.konsentrasi);
      }
    });    
  });

  </script>
<script type="text/javascript">
            function get_prodi_periode2(p) {
                var id_prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>kurikulum/get_prodi_periode/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_periode2").html(msg);
                    }
                });
            }
</script>

