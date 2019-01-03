<div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Edit Kurikulum</div>
            <div class="panel-body">
              <div class="row">
         <form  method="post" action="<?php echo base_url(); ?>kurikulum/edit_kurikulum/<?php echo $kurikulum->id_kurikulum; ?>" enctype="multipart/form-data">
		<table class="table">
    	  <tr>
            <td class="left_column">Nama Kurikulum <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_kurikulum" id="nama_kurikulum" class="validate[required] text-input" maxlength="20" size="80" style="width:80%" required="" value="<?php echo $kurikulum->nama_kurikulum; ?>"></td>
        </tr> 
        <tr>
            <td class="left_column">Program Studi <font color="#FF0000">*</font></td>
            <td>:  <select name="id_prodi" id="id_prodi" class="validate[required]" required="" onchange="return get_prodi_periode(this.value)">
            <option value="<?php echo $kurikulum->id_prodi; ?>"><?php echo $kurikulum->nama_prodi; ?></option>   
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
            <td class="left_column">Berlaku dari Angkatan</td>
            <td>: 
            <input type="number" name="ang_awal" id="ang_awal" class="text-input" style="width:10%" placeholder="ex: 2010" required="" value="<?php echo $kurikulum->ang_awal; ?>">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Berakhir pada Angkatan</td>
            <td>: 
            <input type="number" name="ang_akhir" id="ang_akhir" class="text-input" style="width:10%" placeholder="ex: 2013" required="" value="<?php echo $kurikulum->ang_akhir; ?>">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Jumlah Bobot Mata Kuliah Wajib (sks)</td>
            <td>: 
            <input type="text" name="bobot_matkul_wajib" id="bobot_matkul_wajib" class="text-input" style="width:10%" value="<?php echo $kurikulum->bobot_matkul_wajib; ?>" onkeyup="sum();">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Jumlah Bobot Mata Kuliah Pilihan (sks)</td>
            <td>: 
            <input type="text" name="bobot_matkul_pilihan" id="bobot_matkul_pilihan" class="text-input"  style="width:10%" value="<?php echo $kurikulum->bobot_matkul_pilihan; ?>" onkeyup="sum();">         
            </td>
        </tr>
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info">Simpan</button></td>
                  </tr>

    </table>
    </form>
</div>



