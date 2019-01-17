
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Pembayaran</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Awal</label>

                  <div class="col-sm-4">
                    <input type="date" class="form-control" name="ss" id="ss" required="">
                  </div>

                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Akhir</label>

                  <div class="col-sm-4">
                    <input type="date" class="form-control" name="sa" id="sa" required="">
                  </div>

                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Prodi</label>

                  <div class="col-sm-4">
                    <select class="form-control" id="id_prodi">
                      <option value="">Semua</option>
                      <?php $prodi = $this->db->get('tb_prodi')->result(); 
                      foreach ($prodi as $key) {?>
                        <option value="<?= $key->id_prodi ?>"><?= $key->nama_prodi ?></option>
                      <?php }
                      ?>
                    </select>
                  </div>

                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Waktu</label>

                  <div class="col-sm-4">
                    <select class="form-control" id="id_waktu">
                      <option value="">Semua</option>
                      <?php $waktu = $this->db->get('tb_waktu')->result(); 
                      foreach ($waktu as $key) {?>
                        <option value="<?= $key->id_waktu ?>"><?= $key->waktu ?></option>
                      <?php }
                      ?>
                    </select><br>
                    <p class="btn btn-info btn-flat" onclick="tampil()">Tampilkan</p>
                    <p class="btn btn-primary btn-flat" onclick="print1()"> Cetak </p>
                  </div>

                </div>
                

              </div>
              <!-- /.box-body -->
              <!-- /.box-footer -->
            </form>
          </div>
           <div class="box" id="show_data">
            </div>
<script type="text/javascript">
  function tampil(){
      $.ajax({
                    url: '<?php echo base_url(); ?>laporan/laporan_keuanganku/',
                    data: 'tanggal_awal='+document.getElementById("ss").value+'&tanggal_akhir='+document.getElementById("sa").value+'&id_prodi='+document.getElementById("id_prodi").value+'&id_waktu='+document.getElementById("id_waktu").value,
                    type: 'GET',
                    dataType: 'html',
                    success:function(data){
                    $("#show_data").html(data);
                    },
                    error:function (){}
                });
    }
</script>
<script>
    function print1(){
     var printContents = document.getElementById("ea").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents; 
    }
  </script>