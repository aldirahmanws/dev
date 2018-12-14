      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA SURAT PENGANTAR RISET (MENUNGGU PERSETUJUAN)</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                

                 <thead>
                <tr>
                  <th>No</th>
                  <th>Tgl. Permohonan</th>
                  <th>No. Permohonan</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Tgl. Verifikasi</th>
                  <th>Verifikator</th>
                  <th>Prodi</th>
                  <th style="width: 8%">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($surat as $data) {

                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.date("d M Y", strtotime($data->tgl_permohonan)).'</td>
                  <td><a href="'.base_url('surat/detail_sisp/'.$data->no_permohonan).'")>'.$data->no_permohonan.'</a></td>';?>
<?= '             <td>'.$data->nim.'</td>
                  <td>'.$data->nama_mahasiswa.'</td>
                  <td>'.date("d M Y", strtotime($data->tgl_verifikasi)).'</td>
                  <td>'.$data->nama_dosen.'</td>
                  <td>'.$data->nama_prodi.'</td>';?>

                 

                  <td>

                     <a class="btn btn-info btn-xs btn-flat" title="Edit" style="cursor: pointer" onclick="show_modal_setujui('<?= $data->no_permohonan ?>')"><i class="fa fa-check-square"></i><span class="tooltiptext">Setujui</span></a>

                    <a class="btn btn-danger btn-xs btn-flat" title="Edit" style="cursor: pointer" onclick="show_modal('<?= $data->no_permohonan ?>')"><i class="fa fa-times"></i><span class="tooltiptext">Tolak</span></a>

                  <a href="<?php echo base_url(); ?>surat/hapus_sisp_setujui/<?php echo $data->no_permohonan; ?>" class="btn btn-warning btn-xs btn-flat" title="Print" onclick="return confirm('Anda yakin menghapus data yang sudah anda pilih ?')"><i class="fa fa-trash"></i><span class="tooltiptext">Hapus</span></a>
                  </td>

                  <input type="hidden" id="no_permohonan<?= $data->no_permohonan ?>" value="<?= $data->no_permohonan ?>">
                  <input type="hidden" id="judul_skripsi<?= $data->no_permohonan ?>" value="<?= $data->judul_skripsi ?>">
                  <input type="hidden" id="nim<?= $data->no_permohonan ?>" value="<?= $data->nama_pt ?>"> 
                   <input type="hidden" id="nama_mahasiswa<?= $data->no_permohonan ?>" value="<?= $data->nama_mahasiswa ?>">
                    <input type="hidden" id="note<?= $data->no_permohonan ?>" value="<?= $data->note ?>">

                   <?='
                 
                  
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
      <!-- /.row -->
    </section>

    <div class="modal fade" id="modal_edit" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tolak Surat Pengantar Riset</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('surat/tolak_sisp_setujui'); ?>
                      <table class="table" style="text-transform: uppercase;">
                       <tr>
          <td class="left_column">Judul Skripsi <font color="#FF0000">*</font></td>
            <td> <input type="text" name="judul_skripsi" id="judul_skripsi" class="form-control input-sm pull-left" readonly="">
              <input type="hidden" name="no_permohonan" id="no_permohonan" class="form-control input-sm pull-left" readonly="">
          </td>
        </tr>
        <tr>
          <td class="left_column">Nama <font color="#FF0000">*</font></td>
            <td> <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control input-sm pull-left" style="width:400px" readonly="">
          </td>
        </tr>
        <tr>
          <td class="left_column">NIM <font color="#FF0000">*</font></td>
            <td> <input type="text" name="nim" id="nim" class="form-control input-sm pull-left" style="width:400px" readonly="">
          </td>
        </tr>
        <tr>
          <td class="left_column">Keterangan</td>
            <td>  <textarea class="form-control input-sm pull-left" style="width: 80%" name="note" id="note"></textarea>
          </td>
        </tr>                  
        <tr>
                    <td colspan="4"><button type="submit" class="btn btn-danger btn-flat" id="MyBtn"><i class="fa fa-save"></i> Reject</button></td>
                  </tr>

                        </table>
                        <?php echo form_close();?>

                    </div>

                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="modal_setujui" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Setujui Surat Pengantar Riset</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('surat/setujui_sisp'); ?>
                      <table class="table" style="text-transform: uppercase;">
                       <tr>
          <td class="left_column">Judul Skripsi <font color="#FF0000">*</font></td>
            <td> <input type="text" name="judul_skripsi2" id="judul_skripsi2" class="form-control input-sm pull-left" readonly="">
              <input type="hidden" name="no_permohonan2" id="no_permohonan2" class="form-control input-sm pull-left" readonly="">
          </td>
        </tr>
        <tr>
          <td class="left_column">Nama <font color="#FF0000">*</font></td>
            <td> <input type="text" name="nama_mahasiswa2" id="nama_mahasiswa2" class="form-control input-sm pull-left" style="width:400px" readonly="">
          </td>
        </tr>
        <tr>
          <td class="left_column">NIM <font color="#FF0000">*</font></td>
            <td> <input type="text" name="nim2" id="nim2" class="form-control input-sm pull-left" style="width:400px" readonly="">
          </td>
        </tr>
         <tr>
          <td class="left_column">No. Surat <font color="#FF0000">*</font></td>
            <td> <input type="text" name="no_surat" id="no_surat" class="form-control input-sm pull-left" style="width:400px" value="" onkeyup="checkAvailability()" required="">
          </td>
        </tr>                
        <tr>
          <tr>
            <td colspan="2">
              <span id="user-availability-status"></span>
            </td>
            
          </tr>
                    <td colspan="4"><button type="submit" class="btn btn-primary btn-flat" id="myBtn"><i class="fa fa-save"></i> Setujui</button></td>
                  </tr>

                        </table>
                        <?php echo form_close();?>

                    </div>

                </div>
            </div>
            </div>
        </div>

        
<script type="text/javascript">
      function show_modal(p) {
        $('#modal_edit').modal('show');
        $('#no_permohonan').val(p);
        $('#no_permohonan').val($('#no_permohonan'+p).val());
        $('#judul_skripsi').val($('#judul_skripsi'+p).val());
        $('#nama_mahasiswa').val($('#nama_mahasiswa'+p).val());
        $('#nim').val($('#nim'+p).val());
        $('#note').val($('#note'+p).val());
      }
    </script>

    <script type="text/javascript">
      function show_modal_setujui(p) {
        $('#modal_setujui').modal('show');
        $('#no_permohonan').val(p);
        $('#no_permohonan2').val($('#no_permohonan'+p).val());
        $('#judul_skripsi2').val($('#judul_skripsi'+p).val());
        $('#nama_mahasiswa2').val($('#nama_mahasiswa'+p).val());
        $('#nim2').val($('#nim'+p).val());
      }
      function checkAvailability() {
                $.ajax({
                    url: '<?php echo base_url(); ?>surat/cek_no_surat/',
                    data: 'no_surat='+$("#no_surat").val(),
                    type: 'POST',
                    dataType: 'html',
                    success:function(data){
                    $("#user-availability-status").html(data);
                    },
                    error:function (){}
                });
            }
      function DisableNextButton() {
    $("#myBtn").attr("disabled", true);
}
    </script>

        
