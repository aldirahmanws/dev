        <div class="box">
        <table class="table">
        <tbody><tr>
            <td class="left_column" width="20%">Program Studi <font color="#FF0000">*</font></td>
            <td colspan="3" width="20%">:  
			<?php echo $kp->nama_prodi; ?>			</td>

      <td class="left_column">Mata Kuliah  <font color="#FF0000">*</font></td>
            <td colspan="3">: 
      <?php echo $kp->nama_matkul; ?>             
            </td>
        </tr>
        <tr>
            <td class="left_column" width="20%">Semester <font color="#FF0000">*</font></td>
            <td colspan="3">:  <?php echo $kp->semester; ?>            <input type="hidden" name="id_smt" id="id_smt" value="20171">
            </td>
        <td class="left_column">Bobot Mata Kuliah</td>
            <td colspan="3">: 
      <?php echo $kp->bobot_matkul; ?>             <font color="#999999"><em> ( sks Tatap Muka + sks Praktikum + sks Praktek Lapangan + sks Simulasi )</em></font>
            </td>

        </tr>
        <tr>
<td class="left_column">Nama Kelas <font color="#FF0000">*</font>
            </td>
          <td colspan="3">: 
      <?php echo $kp->nama_kelas; ?> </td>

      <td class="left_column">Bobot Tatap Muka</td>
            <td colspan="3">: <?php echo $kp->bobot_tatap_muka; ?>   sks</td>
        	
		</tr>
				 <tr>
        	<td class="left_column">Bahasan</td>
            <td colspan="3">: 
      &nbsp;<?php echo $kp->bahasan; ?> </td>
      <td class="left_column">Bobot Praktikum</td>
            <td colspan="3">: <?php echo $kp->bobot_praktikum; ?>   sks</td>

        </tr>
        <tr>
        	 <td class="left_column">Tanggal Mulai Efektif</td>
            <td colspan="3">:
        &nbsp;    <?php echo $kp->tgl_mulai; ?>          </td>
        <td class="left_column">Bobot Praktek Lapangan</td>
            <td colspan="3">: <?php echo $kp->bobot_praktik_lapangan; ?>   sks</td>

        </tr>
        <tr>
        	<td class="left_column">Tanggal Akhir Efektif 
         </td>
         <td colspan="3">:
        &nbsp;     <?php echo $kp->tgl_akhir; ?>        </td>
        <td class="left_column">Bobot Simulasi</td>
            <td colspan="3">: <?php echo $kp->bobot_simulasi; ?>   sks</td>
        </tr>
       
    </tbody></table>
</div>
<div class="">
            <a class="btn btn-primary pull-right"  data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Tambah Dosen</a><br><br>
          </div> <br>
    <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Dosen Pengajar</a></li>
              <li><a href="#tab_2" data-toggle="tab">Mahasiswa KRS / Peserta Kelas</a></li>
              <li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
    <section class="content">
      <div class="row">
        
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th  rowspan="2" style="text-align:center">No</th>
                    <th  rowspan="2" style="text-align:center">NIDN</th>
                    <th rowspan="2" style="text-align:center">Nama Dosen</th>
                    <th  rowspan="2" style="text-align:center">Bobot (sks)</th>
                    <th  colspan="2" style="text-align:center">Pertemuan</th>
                        <th  rowspan="2" style="text-align:center">Jenis Evaluasi</th>
                        <th rowspan="2" > Aksi</th>
                    </tr>
                    <tr>
                            <th style="text-align:center">Rencana</th>
                            <th style="text-align:center">Realisasi</th>
                    </tr>
                    
                    </thead>
                <tbody> 
                    

                <?php 
                $no = 0;
                 $alert = "'Apakah anda yakin menghapus data ini ?'";
                foreach ($dosen as $data) {

                  
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_dosen.'</a></td>
                  <td>'.$data->nama_dosen.'</td>
                  <td>'.$data->bobot_dosen.'</td>
                  <td>'.$data->rencana.'</td>
                  <td>'.$data->realisasi.'</td>
                  <td>'.$data->jenis_evaluasi.'</td>
                  <td>
                        <a href="'.base_url('kurikulum/hapus_kurikulum/'.$data->id_kelas_dosen).'" class="btn btn-danger  btn-sm" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus Kurikulum</span></a>
                         <a href="'.base_url('kurikulum/detail_kurikulum2/'.$data->id_kelas_dosen).'" class="btn btn-warning  btn-sm"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit Kurikulum</span></a>
                  </td>

                ' ;
                
                
              }
              ?>


            </tr>
                </tbody>
              </table>
            </div>
            <div></div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <section class="content">
      <div class="row">
        
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th width="10%">NIM</th>
                    <th>Nama Mahasiwa</th>
                    <th>L/P</th>
                    <th>Jurusan</th>
                    <th>Angkatan</th>
                    <th></th>
                  <!-- <th>Aksi</th> -->
                </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td style="text-align:center">1</td>
                        <td>171711120731</td>
                        <td>GITA SAFITRI</td>
                        <td>P</td>
                        <td>Akuntansi</td>
                        <td>2017</td>
                        <td>
                        </td>
                        
                    </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into electronic typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

</div>

<div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Kurikulum</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('kelas_perkuliahan/simpan_kelas_dosen'); ?>
                      <table class="table">
                         <tr>
            <td class="left_column">Nama Dosen <font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_dosen" id="nama_dosen" class="validate[required] text-input" maxlength="50" size="50" style="width:80%" required="">
              <input type="hidden" name="id_dosen" id="id_dosen" class="validate[required] text-input" maxlength="20" size="40" style="width:80%" required=""></td>
        </tr> 
        <tr>
            <td class="left_column">Rencana</td>
            <td>: 
            <input type="text" name="rencana" id="rencana" class="text-input" maxlength="3" size="2"  style="width:10%" value="0" onkeyup="sum();">       
            </td>
        </tr>
        <tr>
            <td class="left_column">Realisasi</td>
            <td>: 
            <input type="text" name="realisasi" id="realisasi" class="text-input" maxlength="3" size="2" style="width:10%" value="0">  
            </td>
        </tr>
        <tr>
            <td class="left_column">Bobot (sks)</td>
            <td>: 
            <input type="text" name="bobot_dosen" id="bobot_dosen" class="text-input" maxlength="3" size="2"  style="width:10%" value="<?php echo $kp->bobot_matkul;?>">         
            </td>
        </tr>
        <tr>
            <td class="left_column">Jenis Evaluasi</td>
            <td>: 
            <input type="text" name="jenis_evaluasi" id="jenis_evaluasi" class="text-input" size="2"  style="width:40%" >         
            </td>
            <input type="hidden" name="id_kp" id="id_kp" class="text-input" maxlength="3" size="2"  style="width:10%" value="<?php echo $this->uri->segment(3); ?>"> 
            
        </tr>
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info">Simpan</button></td>
                  </tr>
              <?php echo form_close();?>

                        </table>

                    </div>

                </div>
            </div>
            </div>
        </div>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
  <script>
       document.getElementById("nama_dosen").style.visibility = 'visible';

    jQuery(document).ready(function($){
    $('#nama_dosen').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete', 
      minLength:1,
      select: function(event, ui){
        $('#nama_dosen').val(ui.item.label)  ;
        $('#id_dosen').val(ui.item.id);
      }
    });    
  });

  </script>