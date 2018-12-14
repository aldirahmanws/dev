      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA SURAT PENGANTAR RISET</h3>
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
                  <th>Prodi</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($surat as $data) {
                  $sudah_bayar = $this->db->query("SELECT count(*) AS total FROM tb_detail_pembayaran JOIN tb_biaya ON tb_biaya.id_biaya = tb_detail_pembayaran.id_biaya WHERE tb_biaya.nama_biaya = 'Surat Pengantar Riset' AND tb_detail_pembayaran.id_mahasiswa = '$data->id_mahasiswa'")->row();

                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>';?>
                  <td><?php echo date("d M Y", strtotime($data->tgl_permohonan)); ?></td><?= '
                  <td><a href="'.base_url('surat/detail_sisp/'.$data->no_permohonan).'")>'.$data->no_permohonan.'</a></td>
                  <td>'.$data->nim.'</td>
                  <td>'.$data->nama_mahasiswa.'</td>
                  
                  
                  <td>'.$data->nama_prodi.'</td>';?>
                  <td><?php if ($sudah_bayar->total >= 1) { 
                    $hihi = $data->status_sisp; 
                  } else {
                    $hihi = 'Payment Process';
                  } echo $hihi ?></td>
                  <input type="hidden" id="no_permohonan<?= $data->no_permohonan ?>" value="<?= $data->no_permohonan ?>">
                  <td> <?php if ($sudah_bayar->total >= 1) { ?>

                  <a href="<?php echo base_url(); ?>surat/verifikasi_sisp/<?php echo $data->no_permohonan; ?>" class="btn btn-info btn-xs btn-flat" title="Print"><i class="fa  fa-check-square"></i><span class="tooltiptext">Verify</span></a>
                    
                  <a class="btn btn-danger btn-xs btn-flat" title="Edit" style="cursor: pointer" onclick="show_modal('<?= $data->no_permohonan ?>')"><i class="fa fa-times"></i><span class="tooltiptext">Reject</span></a>
                  <?php } ?>

                  <a href="<?php echo base_url(); ?>surat/hapus_sisp/<?php echo $data->no_permohonan; ?>" class="btn btn-warning btn-xs btn-flat" title="Print"><i class="fa fa-trash"></i><span class="tooltiptext">Delete</span></a>


                </td>
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
                <h3 class="modal-title" id="myModalLabel">Penolakan Surat Pengantar Riset</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('surat/tolak_sisp'); ?>
                      <table class="table" style="text-transform: uppercase;">
                         
        <tr>
          <td class="left_column">Notes <font color="#FF0000">*</font></td>
            <td> <textarea class="form-control input-sm pull-left" style="width: 80%" name="note" id="note" required=""></textarea>
              <input type="hidden" name="no_permohonan" id="no_permohonan" value="">
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

        
<script type="text/javascript">
      function show_modal(p) {
        $('#modal_edit').modal('show');
        $('#no_permohonan').val(p);
        $('#no_permohonan').val($('#no_permohonan'+p).val());
      }
    </script>
