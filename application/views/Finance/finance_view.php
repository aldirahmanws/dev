<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Transfer Masuk</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>No Tamu</th>
                  <th>Nama Pendaftar</th>
                  <th>Status Pendaftar</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
    <tbody>
      <?php 
      $alert = "'Apakah anda yakin mengapus data ini ?'";
        $no = 0;
        foreach($data as $i):
        ;
      ?>
      <tr>
        <td><?php echo ++$no; ?></td>
        <td><?php echo $i->id_pendaftaran;?></td>
        <td><?php echo $i->nama_pendaftar;?></td>
        <td><?php echo $i->status_mhs;?></td>
        <td><a href="<?php echo base_url().'uploads/'.$i->bukti_transfer;?>" class="btn btn-info btn-sm" target="_blank">Lihat Bukti</a></td>
                <td>
                  <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal_edit<?php echo $i->id_pendaftaran;?>"> Konfirmasi</a>
                  <a href="<?php echo base_url().'finance/konfirmasi_gagal/'.$i->id_pendaftaran;?>" onclick="return confirm('.$alert.')" class="btn btn-danger btn-sm" >Data Tidak Valid </a>
                </td>              
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  
</div>


    <!-- ============ MODAL ADD BARANG =============== -->
        
    <!--END MODAL ADD BARANG-->

    <!-- ============ MODAL EDIT BARANG =============== -->
    <?php 
        foreach($data as $i):
        ?>
        <div class="modal fade" id="modal_edit<?php echo $i->id_pendaftaran;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Konfirmasi Registrasi</h3>
            </div>
            <?php echo form_open('finance/konfirmasi/'.$i->id_pendaftaran); ?>
                <div class="modal-body">

                    <div class="form-group">
                      <input type="hidden" name="id_pendaftaran" class="form-control" id="alamat" placeholder="Input Home Address" required="" value="<?php echo $i->id_pendaftaran;?>">
                        <label class="control-label col-xs-3" >No. Registrasi</label>
                        <div class="col-xs-6">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" required="" onBlur="checkAvailability<?php echo $i->id_pendaftaran?>()" value="">
                        </div>
                        <div class="col-xs-1">
                        <span id="user-availability-status"></span> 
                      </div>
                    </div><br>

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Konfirmasi</button>
                </div>
            <?php echo form_close();?>
            </div>
            </div>
        </div>

    <?php endforeach;?>
    <?php $kui = '12';?>
    <!--END MODAL ADD BARANG-->
<script type="text/javascript">

  function checkAvailability<?php echo $i->?>() {
                $.ajax({
                    url: '<?php echo base_url(); ?>finance/cek_id_daftar_ulang/',
                    data: 'id_daftar_ulang='+$("#id_daftar_ulang").val(),
                    type: 'POST',
                    dataType: 'html',
                    success:function(data){
                    $("#user-availability-status").html(data);
                    console.log(data);
                    },
                    error:function (){}
                });
            }
</script>
