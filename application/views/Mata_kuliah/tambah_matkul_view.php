<div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Tambah Mata Kuliah</div>
            <div class="panel-body">
              <div class="row">
         <?php echo form_open('mata_kuliah/simpan_matkul'); ?>
		<table class="table">
    	<tr>
            <td class="left_column" width="20%">Kode Mata Kuliah <font color="#FF0000">*</font></td>
            <td>: 
            <input type="text" name="kode_matkul" id="kode_matkul" class="validate[required] text-input" maxlength="20" size="20" style="width:20%" required=""></td>
        </tr>
        <tr>
            <td class="left_column">Nama Mata Kuliah <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_matkul" id="nama_matkul" class="validate[required] text-input"  size="20" style="width:50%" required=""></td>
        </tr> 
        <tr>
            <td class="left_column">Nama Mata Kuliah (<i>English Ver.</i>)<font color="#FF0000">*</font></td>
            <td>: <input type="text" name="matkul_english" id="matkul_english" class="validate[required] text-input"  size="20" style="width:50%" required=""></td>
        </tr> 
        <tr>
            <td class="left_column">Program Studi <font color="#FF0000">*</font></td>
            <td>:  <select name="id_prodi" id="id_prodi" class="validate[required]" required="" onchange="return get_concentrate(this.value)">
            <option value="">Pilih Prodi</option>   
                    <?php 

                  foreach($getProdi as $row)
                  { 
                    echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                  }
                  ?>
              </select>

        </td>
        </tr>
        <tr>
            <td class="left_column">Jenis Mata Kuliah</td>
            <td>: <label class="radio-inline"><input type="radio" name="jenis_matkul" value="A" > Wajib Nasional</label> &nbsp; 
            <label class="radio-inline"><input type="radio" name="jenis_matkul" value="B" checked > Wajib Program Studi</label> &nbsp; 
            <label class="radio-inline"><input type="radio" name="jenis_matkul" value="C" > Pilihan</label> &nbsp; 
            <label class="radio-inline"><input type="radio" name="jenis_matkul" value="D" > Peminatan</label> &nbsp; 
            <label class="radio-inline"><input type="radio" name="jenis_matkul" value="E" > Tugas akhir/Skripsi/Tesis/Disertasi</label> &nbsp; 
            </td>
        </tr>
                <tr>
            <td class="left_column">Bobot Mata Kuliah (sks)</td>
            <td>: 
            <input type="text" name="bobot_matkul" id="bobot_matkul" class="text-input" maxlength="2" size="2" readonly style="width:5%; background-color:#E0E0E0" readonly="" value="0">            <font color="#999999"><em> ( sks Tatap Muka + sks Praktikum + sks Praktek Lapangan + sks Simulasi )</em></font>
            </td>
        </tr>
        <tr>
            <td class="left_column">Bobot Tatap Muka (sks)</td>
            <td>: <input type="text" name="bobot_tatap_muka" id="bobot_tatap_muka" class="text-input" maxlength="2" size="2" style="width:5%" onkeydown="return onlyNumber(event,this,false,false)" value="0" onkeyup="sum();"></td>
        </tr>
        <tr>
            <td class="left_column">Bobot Praktikum (sks)</td>
            <td>: <input type="text" name="bobot_praktikum" id="bobot_praktikum"  class="text-input" maxlength="2" size="2" style="width:5%" onkeydown="return onlyNumber(event,this,false,false)" value="0" onkeyup="sum();"></td>
        </tr>
        <tr>
            <td class="left_column">Bobot Praktik Lapangan (sks)</td>
            <td>: <input type="text" name="bobot_praktik_lapangan" id="bobot_praktik_lapangan"  class="text-input" maxlength="2" size="2" style="width:5%" onkeydown="return onlyNumber(event,this,false,false)" value="0" onkeyup="sum();"></td>
        </tr>
        <tr>
            <td class="left_column">Bobot Simulasi (sks)</td>
            <td>: <input type="text" name="bobot_simulasi" id="bobot_simulasi" class="text-input" maxlength="2" size="2" style="width:5%" onkeydown="return onlyNumber(event,this,false,false)" value="0" onkeyup="sum();"></td>
        </tr>
        <tr>
            <td class="left_column">Metode Pembelajaran</td>
            <td>: 
            <input type="text" name="metode_pembelajaran" id="metode_pembelajaran" class="text-input" maxlength="50" size="50" style="width:50%">           </td>
        </tr>
                <tr>
         <td class="left_column">Tanggal Mulai Efektif</td>
            <td>:
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="text-input" maxlength="50" size="50" style="width:20%">               
            </td>
        </tr>
        <tr>
         <td class="left_column">Tanggal Akhir Efektif</td>
            <td>:
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="text-input" maxlength="50" size="50" style="width:20%">            </td>
        </tr>
        <tr>
          <td colspan="4"><button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button></td>
        </tr>

    </table>
    <?php echo form_close();?>
</div>

<script>
function sum() {
      var bobot_tatap_muka = document.getElementById('bobot_tatap_muka').value;
      var bobot_simulasi = document.getElementById('bobot_simulasi').value;
      var bobot_praktikum = document.getElementById('bobot_praktikum').value;
      var bobot_praktik_lapangan = document.getElementById('bobot_praktik_lapangan').value;
      var result = parseInt(bobot_tatap_muka) + parseInt(bobot_simulasi) + parseInt(bobot_praktikum) + parseInt(bobot_praktik_lapangan);
      if (!isNaN(result)) {
         document.getElementById('bobot_matkul').value = result;
      }
}
</script>
