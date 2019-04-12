      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA MAHASISWA LULUS ATAU DROP OUT</h3>
            </div>
            <div class="box-body">
              <table class="">
                <tbody>
                  <form method="get" action="<?php echo base_url("mahasiswa/filter_ld/")?>">
                  <tr>
                    <th>Filter</th>
                  </tr>
                  <tr>                                                                    
                    <td>Program Studi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                      <select name="id_prodi">
                        <option value="">-- Semua --</option>
                        <?php 

                                        foreach($getProdi as $row)
                                        { 
                                          echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                        }
                                    ?>
                      </select>

                    </td>                                            
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Angkatan</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="angkatan">
                        <option value="">-- Semua --</option>
                        <?php 

                            foreach($getTahunAngkatan as $row)
                            { 
                              echo '<option value="'.$row->tgl_du.'">'.$row->tgl_du.'</option>';
                            }
                            ?>
                      </select>
                    </td>
                    
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jenis Keluar</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <select name="id_status" id="id_status">
                        <option value="">-- Jenis Keluar --</option>
                        <option value="11">Lulus</option>
                        <option value="13">Mutasi</option>
                        <option value="5">Dikeluarkan</option>
                        <option value="7">Mengundurkan diri</option>
                        <option value="14">Putus Sekolah</option>
                        <option value="8">Meninggal Dunia</option>
                        <option value="10">Hilang</option>
                        <option value="15">Lainnya</option>
                        </select> 
                    </td>
                    <td>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary btn-flat btn-xs" value="Cari">  
                    </td>

                  </tr>

                
                </tbody>
              </table>
                      
               </form>

              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                <br>

               <a class="btn btn-primary btn-sm btn-flat" href="" data-toggle="modal" data-target="#modal_view"><i class="fa fa-plus"></i> Tambah </a>

               <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Angkatan</th>
                  <th>Prodi</th>
                  <th>Jenis Keluar</th>
                  <th>Tanggal Keluar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

               
                </tbody>
              </table>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

        <div class="modal fade" id="modal_view" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">TAMBAH MAHASISWA</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('mahasiswa/simpan_ld'); ?>
                      <table class="table" style="text-transform: uppercase;">
                          <tr>
          <td class="left_column">Mahasiswa <font color="#FF0000">*</font></td>
            <td>: 
      <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="validate[required] text-input" style="width:300px" required="">            <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" />
            </td>
        </tr>
        <tr>
          <td class="left_column">Jenis Keluar <font color="#FF0000">*</font></td>
            <td>: 
      <select name="id_status" id="id_status" class="validate[required]" required="">
<option value="">-- Jenis Keluar --</option>
<option value="11">Lulus</option>
<option value="13">Mutasi</option>
<option value="5">Dikeluarkan</option>
<option value="7">Mengundurkan diri</option>
<option value="14">Putus Sekolah</option>
<option value="8">Meninggal Dunia</option>
<option value="10">Hilang</option>
<option value="15">Lainnya</option>
</select>            </td>
        </tr> 
      <tr>
          <td class="left_column" width="20%">Tanggal Keluar <font color="#FF0000">*</font></td>
            <td>: 
      <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="validate[required] text-input" maxlength="50" size="50" style="width:40%" required="">             </td>
        </tr>
        <tr>
          <td class="left_column">Keterangan</td>
            <td>: <textarea wrap="soft" name="keterangan" id="keterangan" rows="5" cols="40"></textarea></td>
        </tr>
         <tr>
          <td class="left_column">SK Yudisium</td>
            <td>: <input type="text" name="sk_yudisium" id="sk_yudisium" class="text-input" maxlength="80" size="80" style="width:400px"></td>
        </tr>
         <tr>
          <td class="left_column" width="20%">Tanggal SK Yudisium</td>
            <td>: 
      <input type="date" name="tgl_sk_yudisium" id="tgl_sk_yudisium" class="text-input" maxlength="50" size="50" style="width:40%">             </td>
        </tr>
         <tr>
          <td class="left_column">IPK</td>
            <td>: <input type="text" name="ipk" id="ipk" value="0,00" class="text-input" maxlength="4" size="4" style="width:10%; background-color: #E0E0E0"></td>
        </tr>
         <tr>
          <td class="left_column">No seri Ijazah</td>
            <td>: <input type="text" name="no_seri_ijazah" id="no_seri_ijazah" class="text-input" maxlength="80" size="80" style="width:400px"></td>
        </tr>
        <tr>
                    <td colspan="4"><button type="submit" class="btn btn-info btn-flat" id="MyBtn">Simpan</button></td>
                  </tr>

                        </table>
                        <?php echo form_close();?>

                    </div>

                </div>
            </div>
            </div>
        </div>


   

    

   
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
        $('#example1').DataTable( {
            data:           <?= $mahasiswa; ?>,  
            deferRender:    true,
            scrollCollapse: true,
            scroller:       true,
            "autoWidth": true
        } );
        
    } );
</script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>

     <script>

       document.getElementById("nama_mahasiswa").style.visibility = 'visible';
    jQuery(document).ready(function($){
    $('#nama_mahasiswa').autocomplete({
      source:'<?php echo base_url(); ?>mahasiswa/get_autocomplete_ipk', 
      minLength:1,
      select: function(event, ui){
        $('#nama_mahasiswa').val(ui.item.label);
        $('#id_mahasiswa').val(ui.item.id);
        $('#prodimhs').val(ui.item.prodi);
        $('#ipk').val(ui.item.ipk);
     
        
      }
    });    
  });
  
  </script>

