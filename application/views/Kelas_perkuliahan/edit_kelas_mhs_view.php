<div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Edit Mahasiswa</div>
            <div class="panel-body">
              <div class="row">
         <form  method="post" action="<?php echo base_url(); ?>kelas_perkuliahan/save_edit_kelas_mhs/<?php echo $mhs->id_kelas_mhs; ?>" enctype="multipart/form-data">
    <table class="table">
       <tr>
            <td class="left_column">Nama Mahasiswa <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="validate[required] text-input" size="50" style="width:80%" required="" value="<?php echo $mhs->nama_mahasiswa; ?>">
              <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" class="text-input" maxlength="3" size="2"  style="width:10%" value="">
             </td>
        </tr> 
        <tr>
            <td class="left_column">NIM</td>
            <td>: 
            <input type="text" name="nim" id="nim" class="text-input" maxlength="3" size="2"  style="width:20%; background-color:#E0E0E0;" value="<?php echo $mhs->nim; ?>" onkeyup="sum();" readonly >   

            <input type="hidden" name="id_kp" id="id_kp" class="text-input" maxlength="3" size="2"  style="width:10%; background-color:#E0E0E0;" value="<?php echo $mhs->id_kp; ?>" >      
            </td>
        </tr>
        <tr>
            <td class="left_column">L/P</td>
            <td>: 
            <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="text-input" maxlength="3" size="2" style="width:5%; background-color:#E0E0E0;" value="<?php echo $mhs->jenis_kelamin; ?>" readonly>  
            </td>
        </tr>
        <tr>
            <td class="left_column">Prodi</td>
            <td>: 
            <input type="text" name="id_prodi" id="id_prodi" class="text-input" maxlength="3" size="2"  style="width:20%; background-color:#E0E0E0;" value="<?php echo $mhs->nama_prodi; ?>" readonly>         
            </td>
        </tr>
        <tr>
            <td class="left_column">Angkatan</td>
            <td>: 
            <input type="text" name="angkatan" id="angkatan" class="text-input" size="2"  style="width:10%; background-color:#E0E0E0;" value="<?php echo substr($mhs->tgl_du,0,4); ?>" readonly>         
            </td>
           
            
        </tr>
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info">Simpan</button></td>
                  </tr>
    </table>
    </form>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
  <script>

       document.getElementById("nama_mahasiswa").style.visibility = 'visible';
    jQuery(document).ready(function($){
    $('#nama_mahasiswa').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete3', 
      minLength:1,
      select: function(event, ui){
        $('#nama_mahasiswa').val(ui.item.label);
        $('#id_mahasiswa').val(ui.item.id);
        $('#id_prodi').val(ui.item.id_prodi);
        $('#jenis_kelamin').val(ui.item.jenis_kelamin);
        $('#angkatan').val(ui.item.angkatan);
        $('#nim').val(ui.item.nim);
      }
    });    
  });
  
  </script>


