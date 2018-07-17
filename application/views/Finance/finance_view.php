<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pendaftar</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Pendaftaran</th>
                  <th>Nama Pendaftar</th>
                  <th>Status Pendaftar</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
    <tbody>
      <?php 
        $no = 0;
        foreach($data as $i):
        ;
      ?>
      <tr>
        <td><?php echo ++$no; ?></td>
        <td><?php echo $i->id_pendaftaran;?></td>
        <td><?php echo $i->nama_pendaftar;?></td>
        <td><?php echo $i->status_bayar;?></td>
        <td><a href="<?php echo base_url().'uploads/'.$i->bukti_transfer;?>" class="btn btn-info btn-sm" target="_blank">Lihat Bukti</a></td>
                <td><a class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_edit<?php echo $i->id_pendaftaran;?>"> Konfirmasi</a></td>              
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
                <h3 class="modal-title" id="myModalLabel">Edit Barang</h3>
            </div>
            <?php echo form_open('finance/konfirmasi/'.$i->id_pendaftaran); ?>
                <div class="modal-body">

                    <div class="form-group">
                      <input type="hidden" name="id_pendaftaran" class="form-control" id="alamat" placeholder="Input Home Address" required="" value="<?php echo $i->id_pendaftaran;?>">
                        <label class="control-label col-xs-3" >ID Daftar Ulang</label>
                        <div class="col-xs-8">
                            <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="inputEmail3" placeholder="" required="">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info">Update</button>
                </div>
            <?php echo form_close();?>
            </div>
            </div>
        </div>

    <?php endforeach;?>
    <!--END MODAL ADD BARANG-->
<script>
  $(document).ready(function(){
    $('#mydata').DataTable();
  });
</script>