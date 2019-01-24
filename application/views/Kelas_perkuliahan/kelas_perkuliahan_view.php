
<?php echo $this->session->flashdata('message');?>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">KELAS PERKULIAHAN</h3>
            </div>
            <div class="box-body">
              <table class="">
                <tbody>
                  <form method="get" action="<?php echo base_url("kelas_perkuliahan/filter_kp/")?>">
                  <tr>
                    <th>Filter</th>
                  </tr>
                  <tr>                                                                    
                    <td>Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                      <select name="id_prodi" onchange="return get_prodi_periode2(this.value)">
                        <option value="">-- Semua --</option>
                        <?php 

                                        foreach($getProdi as $row)
                                        { 
                                          echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                        }
                                    ?>
                      </select>

                    </td>                                            
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semester</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="id_periode" id="id_periode2">
                        <option value="">-- Semua --</option>
              
                      </select>
                    </td>
                    <td>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary btn-xs btn-flat" value="Cari">  
                    </td>

                  </tr>
                  
                </tbody>
              </table>
                      
               </form>
               <br>
               <div class="table-responsive">
              <table id="example3" class="table2 table-hover table-striped table-condensed" style="text-transform: uppercase;">
                <a class="btn btn-primary btn-sm btn-flat" href="" data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Tambah Kelas</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID KP</th>
                  <th>ID DK</th>
                  <th>Wajib</th>
                  <th>Prodi</th>
                  <th>Kosentrasi</th>
                  <th>Kode MK</th>
                  <th>Nama MK</th>
                  <th>Nama Kelas</th>
                  <th>Periode</th>
                  <th>Nama Dosen</th>
                  <th>Waktu</th>
                  <th>Jumlah Mahasiswa</th>
                  <th width="6%">Aksi</th>
                </tr>
                 
                </thead>

                <tbody>

                <?php 
                $no = 0;
                 $alert = "'Apakah anda yakin menghapus data ini ?'";

                foreach ($kp as $data) { 
                  $total_mahasiswa = $this->db->query("SELECT count(*) AS total FROM tb_kelas_mhs WHERE id_kp = '$data->id_kp'")->row();

                  $nama_dosen = $this->db->query("SELECT nama_dosen AS abc FROM tb_kelas_dosen RIGHT JOIN tb_kp ON tb_kp.id_kp = tb_kelas_dosen.id_kp left JOIN tb_dosen ON tb_dosen.id_dosen = tb_kelas_dosen.id_dosen WHERE tb_kp.id_kp = '$data->id_kp'")->row();
                  if ($nama_dosen->abc == null) {
                    $a = '<a href="'.base_url('kelas_perkuliahan/detail_kelas/'.$data->id_kp.'/'.$data->id_detail_kurikulum.'/'.$data->id_waktu).'"><p style="color:red;"><b>Belum diisi </b></p></a>';
                  } else {
                    $a = $nama_dosen->abc;
                  }
                  echo '                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_kp.'</td>
                  <td>'.$data->id_detail_kurikulum.'</td>
                  <td>'.$data->wajib.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td><a href="'.base_url('kelas_perkuliahan/detail_kelas/'.$data->id_kp.'/'.$data->id_detail_kurikulum.'/'.$data->id_waktu).'">'.$data->id_matkul.'</a></td>
                  <td>'.$data->nama_matkul.'</td>
                  <td>'.$data->nama_kelas.'</td>
                  <td>'.$data->semester.'</td>
                  <td>'.$a.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$total_mahasiswa->total.'</td>';?>
                  
                  <td> <?php if (date('Y-m-d') >= $data->tgl_awal_kul AND date('Y-m-d') <= $data->tgl_akhir_kul) { ?>
                  <?= '
                       <a href="'.base_url('kelas_perkuliahan/detail_kp/'.$data->id_kp).'" class="btn btn-warning  btn-xs btn-flat"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit Kelas </span></a>
                        <a href="'.base_url('kelas_perkuliahan/hapus_kp/'.$data->id_kp).'" class="btn btn-danger btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus Kelas</span></a> ';?><?php } ?> <?= '
                    
                  </td>
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
      </div>

      <div class="callout callout-info">

      <strong>Keterangan :</strong>
            <br />
         - Kelas perkuliahan digunakan untuk mendata kelas perkuliahan pada tiap periode atau semester.
         <br />

         - Hanya kelas perkuliahan aktif yang ditampilkan (gunakan fitur filter untuk melihat kelas pada periode sebelumnya).

         </div>
      <!-- /.row -->
    </section>
    
        <div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">TAMBAH KELAS PERKULIAHAN</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('kelas_perkuliahan/save_kp'); ?>
                      <table class="table" style="text-transform: uppercase;">
        <tr>
          <td class="left_column">Masukan Mata Kuliah <font color="#FF0000">*</font>
            </td>
          <td colspan="9">: 
      <input type="text" name="jadwal" id="jadwal" class="validate[required] text-input"  size="5" style="width: 90%;" required="" placeholder="Masukan mata kuliah yang sudah terjadwal">
        </tr> 
        <tr>
          <td class="left_column">Periode <font color="#FF0000">*</font>
            </td>
          <td colspan="9">: 
      <input type="text" name="semester" id="semester" class="validate[required] text-input"  size="5" style="width: 40%; background-color:#E0E0E0"  readonly="">
      <input type="hidden" name="id_periode" id="id_periode" class="validate[required] text-input"  size="5" style="width: 40%; background-color:#E0E0E0"  readonly=""> </td>
        </tr> 
        <tr>
          <td class="left_column">Konsentrasi <font color="#FF0000">*</font>
            </td>
          <td colspan="9">: 
      <input type="text" name="nama_konsentrasi" id="nama_konsentrasi" class="validate[required] text-input"  size="5" style="width: 40%; background-color:#E0E0E0" readonly="" >
      <input type="hidden" name="id_konsentrasi" id="id_konsentrasi" class="validate[required] text-input"  size="5" style="width: 40%; background-color:#E0E0E0" readonly="" >
      <input type="hidden" name="id_detail_kurikulum" id="id_detail_kurikulum" class="validate[required] text-input"  size="5" style="width: 40%; background-color:#E0E0E0" readonly="" >
      </td>
        </tr> 
        <tr>
          <td class="left_column">Waktu</td>
            <td>: <select name="id_waktu" id="id_waktu" class="validate[required]" required="" style="width: 100px" >
        <option value=""> Pilih Waktu </option>
        <option value="1"> Pagi </option>
        <option value="2"> Sore </option>
      </select>    </td>
        </tr>
        <tr>
          <td class="left_column">Nama Kelas <font color="#FF0000">*</font>
            </td>
          <td colspan="9">: 
      <input type="text" name="nama_kelas" id="nama_kelas" class="validate[required] text-input"  size="5" style="width: 40%;" maxlength="2" required="" placeholder="Masukan 2 digit angka"> </td>
        </tr> 
        <tr>
          <td class="left_column">Bahasan</td>
            <td colspan="9">: 
      <textarea wrap="soft" name="bahasan" id="bahasan" class="text-input" rows="5" cols="50"></textarea></td>
        </tr>
        <tr>
         <td class="left_column">Tanggal Mulai Efektif</td>
            <td colspan="9">:
        <input type="date" name="tgl_mulai" id="tgl_mulai" class="text-input hasDatepicker" maxlength="50" size="50" style="width:50%">            </td>
        </tr>
        <tr>
          <td class="left_column">Tanggal Akhir Efektif 
         </td>
         <td colspan="9">:
        <input type="date" name="tgl_akhir" id="tgl_akhir" class="text-input hasDatepicker" maxlength="50" size="50" style="width:50%">            </td>
        </tr>
                  <tr>
                    <td colspan="4"><button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Save</button></td>
                  </tr>
              <?php echo form_close();?>

                        </table>

                    </div>
                    <div class="callout callout-info">

      <strong>Keterangan :</strong>
            <br />
         - Tanggal efektif digunakan sebagai rentang waktu mahasiswa mengisi KRS aktif.
         <br />

         </div>

                </div>

            </div>

            </div>


        </div>
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
        $('#id_detail_kurikulum').val(ui.item.id_detail_kurikulum);
        $('#id_konsentrasi').val(ui.item.id_konsentrasi);
        $('#id_periode').val(ui.item.id_periode);
        $('#semester').val(ui.item.semester);
        $('#nama_konsentrasi').val(ui.item.nama_konsentrasi);
        console.log(ui);
      }
    });    
  });

  </script>
<script type="text/javascript">
            function get_prodi_periode2(p) {
                var id_prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>mahasiswa/get_prodi_periode2/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_periode2").html(msg);
                    }
                });
            }
</script>