      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA MATA KULIAH</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo form_open('mata_kuliah/remove'); ?>
              
              <table id="example3" class="table2 table-hover table-striped table-condensed" style="text-transform: uppercase;">
                <a href="<?php echo base_url(); ?>mata_kuliah/tambah_matkul" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode MK</th>
                  <th>Nama MK</th>
                  <th>Bobot MK (sks)</th>
                  <th>Program Studi</th>
                  <th>Jenis MK</th>
                  <th>Aksi</th>
                  <th style="width: 2%" >Check</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin mengapus data ini ?'";
                foreach ($matkul as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td><a href="" data-toggle="modal" data-target="#modal_view'.$data->kode_matkul.'">'.$data->id_matkul.'</a></td>
                  <td>'.$data->nama_matkul.'</a></td>
                  <td>'.$data->bobot_matkul.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_jenis_matkul.'</td>
                  <td style="text-align:center"> 
                  <a href="'.base_url('mata_kuliah/detail_matkul/'.$data->kode_matkul).'" class="btn btn-warning btn-xs btn-flat"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>

                   <a href="'.base_url('mata_kuliah/hapus_matkul/'.$data->kode_matkul).'" class="btn btn-danger  btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>
                   </td>
                   <td style="text-align: center"><input type="checkbox" name="id[]" value="'.$data->kode_matkul.'"></td>
                ' ;
                
              }
              ?>
                </tbody>
              </table>
              <input type="submit" value="Hapus Mata Kuliah Terpilih" onclick="return confirm('Anda yakin menghapus data yang sudah anda pilih ?')" class="btn btn-danger pull-right btn-flat">
              <br>
             
              <?php echo form_close()?>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<?php 
        foreach($matkul as $i):
        ?>
        <div class="modal fade" id="modal_view<?php echo $i->kode_matkul;?>">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Detail Mata Kuliah</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <table class="table">
                          <tr>
          <td class="left_column" width="40%">Kode Mata Kuliah <font color="#FF0000">*</font></td>
            <td>: 
      <?php echo $i->kode_matkul;?></td>
        </tr>
        <tr>
          <td class="left_column">Nama Mata Kuliah <font color="#FF0000">*</font></td>
            <td>: <?php echo $i->nama_matkul;?></td>
        </tr> 
        <tr>
            <td class="left_column">Program Studi Pengampu <font color="#FF0000">*</font></td>
            <td>:  <?php echo $i->nama_prodi;?></td>
        </tr>
        <tr>
            <td class="left_column">Jenis Mata Kuliah</td>
            <td>: <?php echo $i->nama_jenis_matkul;?></td>
        </tr>
            <tr>
          <td class="left_column">Bobot Mata Kuliah (sks)</td>
            <td>: 
      <?php echo $i->bobot_matkul;?>            <font color="#999999"></font>
            </td>
        </tr>
        <tr>
          <td class="left_column">Bobot Tatap Muka (sks)</td>
            <td>: <?php echo $i->bobot_tatap_muka;?></td>
        </tr>
        <tr>
          <td class="left_column">Bobot Praktikum (sks)</td>
            <td>: <?php echo $i->bobot_praktikum;?></td>
        </tr>
        <tr>
          <td class="left_column">Bobot Praktik Lapangan (sks)</td>
            <td>: <?php echo $i->bobot_praktik_lapangan;?></td>
        </tr>
        <tr>
          <td class="left_column">Bobot Simulasi (sks)</td>
            <td>: <?php echo $i->bobot_simulasi;?></td>
        </tr>
        <tr>
            <td class="left_column">Metode Pembelajaran</td>
            <td>: 
      <?php echo $i->metode_pembelajaran;?>      </td>
        </tr>
                <tr>
         <td class="left_column">Tanggal Mulai Efektif</td>
            <td>: 
      <?php echo $i->tanggal_mulai;?>            
            </td>
        </tr>
        <tr>
         <td class="left_column">Tanggal Akhir Efektif</td>
            <td>:
        <?php echo $i->tanggal_akhir;?>           </td>
        </tr>

                        </table>

                    </div>

                </div>
            </div>
            </div>
        </div>

    <?php endforeach;?>

    <?php 
        foreach($matkul as $i):
        ?>
        <div class="modal fade" id="modal_edit<?php echo $i->kode_matkul;?>">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Periode</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('mata_kuliah/edit_matkul'); ?>
                      <table class="table">
      <tr>
          <td class="left_column" width="40%">Kode Mata Kuliah <font color="#FF0000">*</font></td>
            <td>: 
      <input type="text" name="kode_matkul" id="kode_matkul" class="validate[required] text-input" maxlength="20" size="20" style="width:30%" value="<?php echo $i->kode_matkul;?>"></td>
        </tr>
        <tr>
          <td class="left_column">Nama Mata Kuliah <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_matkul" id="nama_matkul" class="validate[required] text-input" maxlength="20" size="20" style="width:80%" value="<?php echo $i->nama_matkul;?>"> </td>
        </tr> 
        <tr>
            <td class="left_column">Program Studi <font color="#FF0000">*</font></td>
            <td>:  <select name="id_prodi" id="id_prodi" class="validate[required]">
              <option value="<?php echo $i->id_prodi;?>"><?php echo $i->nama_prodi;?></option>   
                                  <?php 

                                foreach($getProdi as $row)
                                { 
                                  echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                }
                                ?>
              </select></td>
        </tr>
        <tr>
            <td class="left_column">Jenis Mata Kuliah</td>
            <td>: <select name="jenis_matkul" id="jenis_matkul" class="validate[required]">
              <option value="<?php echo $i->jenis_matkul;?>"><?php echo $i->nama_jenis_matkul;?></option>   
                                  <?php 

                                foreach($getJenisMatkul as $row)
                                { 
                                  echo '<option value="'.$row->id_jenis_matkul.'">'.$row->nama_jenis_matkul.'</option>';
                                }
                                ?>
              </select></td>
        </tr>
            <tr>
          <td class="left_column">Bobot Mata Kuliah (sks)</td>
            <td>: 
      <input type="text" name="bobot_matkul" id="bobot_matkul" class="text-input" maxlength="2" size="2" readonly style="width:10%" value="<?php echo $i->bobot_matkul;?>">            
            </td>
        </tr>
        <tr>
          <td class="left_column">Bobot Tatap Muka (sks)</td>
            <td>: <input type="text" name="bobot_tatap_muka" id="bobot_tatap_muka" class="text-input" maxlength="2" size="2" style="width:10%" onkeydown="return onlyNumber(event,this,false,false)" value="<?php echo $i->bobot_tatap_muka;?>" onkeyup="sum();" ></td>
        </tr>
        <tr>
          <td class="left_column">Bobot Praktikum (sks)</td>
            <td>: <input type="text" name="bobot_praktikum" id="bobot_praktikum" value="<?php echo $i->bobot_praktikum;?>" class="text-input" maxlength="2" size="2" style="width:10%" onkeydown="return onlyNumber(event,this,false,false)" onkeyup="sum();"></td>
        </tr>
        <tr>
          <td class="left_column">Bobot Praktik Lapangan (sks)</td>
            <td>: <input type="text" name="bobot_praktik_lapangan" id="bobot_praktik_lapangan" value="<?php echo $i->bobot_praktik_lapangan;?>" class="text-input" maxlength="2" size="2" style="width:10%" onkeydown="return onlyNumber(event,this,false,false)" onkeyup="sum();"></td>
        </tr>
        <tr>
          <td class="left_column">Bobot Simulasi (sks)</td>
            <td>: <input type="text" name="bobot_simulasi" id="bobot_simulasi" value="<?php echo $i->bobot_simulasi;?>" class="text-input" maxlength="2" size="2" style="width:10%" onkeydown="return onlyNumber(event,this,false,false)" onkeyup="sum();"></td>
        </tr>
        <tr>
            <td class="left_column">Metode Pembelajaran</td>
            <td>: 
      <input type="text" name="metode_pembelajaran" id="metode_pembelajaran" class="text-input" maxlength="50" size="50" style="width:50%" value="<?php echo $i->metode_pembelajaran;?>">     </td>
        </tr>
                <tr>
         <td class="left_column">Tanggal Mulai Efektif</td>
            <td>:
      <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="text-input" maxlength="50" size="50" style="width:60%" value="<?php echo $i->tanggal_mulai;?>">             
            </td>
        </tr>
        <tr>
         <td class="left_column">Tanggal Akhir Efektif</td>
            <td>:
        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="text-input" maxlength="50" size="50" style="width:60%" value="<?php echo $i->tanggal_akhir;?>">            </td>
        </tr>
        <tr>
          <td colspan="4"><button type="submit" class="btn btn-info">Update</button></td>
        </tr>

    </table>

                    </div>

                </div>
            </div>
            </div>
        </div>
        <?php echo form_close();?>

    <?php endforeach;?>


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
<script type="text/javascript">
    $(document).ready(function() {
      $("input[name='checkAll']").click(function() {
        var checked = $(this).attr("checked");
        $("#myTable tr td input:checkbox").attr("checked", checked);
      });
    });
  </script>