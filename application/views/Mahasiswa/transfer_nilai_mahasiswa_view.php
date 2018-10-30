           <?php 
                if($this->session->userdata('level') == 5){ 
                  $id_mahasiswa = $mahasiswa->id_mahasiswa; $semester_aktif = $mahasiswa->semester_aktif?>

        <!-- <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi">Prestasi</a> -->
        
           <?php } else {
           $id_mahasiswa = $mahasiswa->id_mahasiswa; $semester_aktif = $mahasiswa->semester_aktif?>
           
        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa"><i class="fa fa-angle-left"></i> Back</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->nik; ?>">History Pendidikan</a>
        <?php if ($mahasiswa->id_jenis_pendaftaran == '2') { ?>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>mahasiswa/transfer_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">Nilai Transfer</a>
        <?php } ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>/<?php echo $mahasiswa->id_konsentrasi; ?>">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/jadwal_mhs/<?php echo $mahasiswa->id_mahasiswa ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">Jadwal Kuliah</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">History Nilai</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan/<?php echo $mahasiswa->id_mahasiswa; ?>">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $mahasiswa->id_mahasiswa; ?>">Prestasi</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/checklist_pembayaran/<?php echo $mahasiswa->id_mahasiswa; ?>/<?php echo $mahasiswa->id_prodi; ?>">Pembayaran</a>
        
         <br/><br/>  
           <?php }           ?>
        <div class="box box-info">
        <div class="box-body">
              <table class="table" >
        <tr>
            <td width="15%" class="left_column">NIM</td>
            <td>: <?php echo $mahasiswa->nim; ?></td>
            <td width="15%" class="left_column">Nama</td>
            <td>: <?php echo $mahasiswa->nama_mahasiswa; ?></td>
        </tr>
        <tr>
            <td class="left_column" width="15%">Program Studi</td>
            <td width="35%">: <?php echo $mahasiswa->nama_prodi; ?>            </td>
            <td class="left_column" width="15%">Angkatan</td>
            <td>: <?php echo substr($mahasiswa->tgl_du,0,4); ?>           </td>
        </tr>
        
                

        </table>
            </div>
            <!-- /.box-body -->
          </div>
          
          
        <div class="box">
        <section class="content">
      <div class="row">
        
          
            <div class="box-header">
              <h3 class="box-title">DATA NILAI TRANSFER</h3>
             

              <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah Nilai Transfer
              </button>
              <br>
              <br>

            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table class="table table-bordered table-striped" id="example3">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Matkul Asal</th>
                  <th>Mata Kuliah Asal </th>
                  <th>SKS Matkul Asal</th>
                  <th>Nilai Huruf Asal</th>
                  <th>Kode Matkul Diakui</th>
                  <th>Mata Kuliah Diakui</th>
                  <th>SKS Matkul Diakui</th>
                  <th>Nilai Huruf</th>
                  <th>Nilai Angka</th>
                </tr>
                </thead>
                <tbody> 
                    
                  <?php 
                $no = 0;
              
                foreach ($transfer as $i) {
                  
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$i->kode_matkul_asal.'</td>
                  <td>'.$i->matkul_asal.'</td>
                  <td>'.$i->sks_matkul_asal.'</td>
                  <td>'.$i->nilai_huruf_asal.'</td>
                  <td>'.$i->id_matkul.'</td>
                  <td>'.$i->nama_matkul.'</td>
                  <td>'.$i->bobot_matkul.'</td>
                  <td>'.$i->nilai_transfer.'</td>
                  <td>'.$i->nilai_huruf.'</td>
                </tr>
                ' ;
                  
                }   
             
                
            ?>
                </tbody>
              </table>
              </div>

            </div>
          

             
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
    
   
    </div>
    <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
            - Fitur ini di gunakan untuk menampilkan dan mengelola KRS per mahasiswa pada periode berlaku
            <br />
            - Fitur ini cocok di gunakan apabila sumber data yang digunakan adalah daftar KRS per mahasiswa
            <br />
            - Bila sumber data yang digunakan adalah daftar absensi , silahkan ke menu <a href="http://10.10.0.4:8082/kelaskuliah">[ Kelas Perkuliahan ]</a>            <br />
            - Untuk menambahkan Kelas yang di tawarkan, silahkan ke menu <a href="http://10.10.0.4:8082/kelaskuliah">[ Kelas Perkuliahan ]</a>          <br />
            - Anda dapat menambahkan KRS secara kolektif pada mahasiswa ini, klik pada 
            <a style="cursor:pointer" onclick="return showKelas(this)" title="Menampilkan Kelas yang ditawarkan">[ KRS Kolektif ]</a>
            <br />
            
    </div>

    <div class="modal fade" id="modal-default" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Transfer Nilai</h3>
                
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('mahasiswa/simpan_nilai_transfer/'.$mahasiswa->id_mahasiswa); ?>
                      <table class="table">
        <tr>
          <td class="left_column">Kode Matkul Asal <font color="#FF0000">*</font>
            </td>
          <td colspan="15">: 
      <input type="text" name="kode_matkul_asal" id="kode_matkul_asal" class="validate[required] text-input"  size="40" style="width: 50%;" required="">
      
      </td>
    </tr>
      <tr>
          <td class="left_column">Mata Kuliah Asal <font color="#FF0000">*</font>
            </td>
          <td colspan="15">: 
      <input type="text" name="matkul_asal" id="matkul_asal" class="validate[required] text-input"  size="40" style="width: 90%;" required="">
      
      </td>
      
        </tr> 
        <tr>
          <td class="left_column">SKS Matkul Asal <font color="#FF0000">*</font>
            </td>
          <td colspan="15">: 
      <input type="text" name="sks_matkul_asal" id="sks_matkul_asal" class="validate[required] text-input"  size="40" style="width: 20%;" required="">
      
      </td>
      
        </tr>
        <tr>
          <td class="left_column">Nilai Huruf Asal <font color="#FF0000">*</font>
            </td>
          <td colspan="15">: 
      <input type="text" name="nilai_huruf_asal" id="nilai_huruf_asal" class="validate[required] text-input"  size="40" style="width: 20%;" required="">
      
      </td>
      
        </tr> 
        <tr>
          <td class="left_column">Mata Kuliah Diakui <font color="#FF0000">*</font>
            </td>
          <td colspan="15">: 
      <input type="text" name="nama_matkul" id="nama_matkul" class="validate[required] text-input"  size="40" style="width: 90%;" required="">
       <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" class="validate[required] text-input"  size="40" style="width: 90%;" value="<?php echo $mahasiswa->id_mahasiswa; ?>">
       
      
      </td>
      
       
        </tr>
        <tr>
          <td class="left_column">Kode Mata Kuliah <font color="#FF0000">*</font>
            </td>
          <td colspan="15">: 
     
      <input type="hidden" name="kode_matkul" id="kode_matkul" class="validate[required] text-input"  size="5" style="width: 90%;">
      <input type="hidden" name="id_detail_kurikulum" id="id_detail_kurikulum" class="validate[required] text-input"  size="5" style="width: 90%;">
      <input type="text" name="id_matkul" id="id_matkul" class="validate[required] text-input"  size="5" style="width: 50%;background-color: #E0E0E0" readonly="">
       
        </tr> 
        <tr>
          <td class="left_column">Nilai Diakui <font color="#FF0000">*</font>
            </td>
          <td colspan="15">: 
     
     
      <input type="text" name="nilai" id="nilai" class="validate[required] text-input"  size="5" style="width: 20%;" onkeyup="return get_skala(this.value)">
      <input type="hidden" name="id_prodi" id="id_prodi" class="validate[required] text-input"  size="5" style="width: 90%;" value="<?php echo $mahasiswa->id_prodi; ?>">
      <input type="hidden" name="id_skala_nilai" id="id_skala_nilai" class="validate[required] text-input"  size="5" style="width: 90%;">
       
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
       document.getElementById("nama_matkul").style.visibility = 'visible';

    jQuery(document).ready(function($){
    $('#nama_matkul').autocomplete({
      source:'<?php echo base_url(); ?>kelas_perkuliahan/get_autocomplete_mk', 
      minLength:1,
      select: function(event, ui){
        $('#nama_matkul').val(ui.item.label);
        $('#kode_matkul').val(ui.item.id);
        $('#id_matkul').val(ui.item.im);
        $('#id_detail_kurikulum').val(ui.item.idk);

      }
    });    
  });

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
                        document.getElementById('id_skala_nilai').value = data;
                    },
                    error:function (){}
                });
            }
</script>