
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Tamu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Awal</label>

                  <div class="col-sm-10">
                    <input type="date" class="col-sm-4" name="ss" id="ss" required=""><br>
                  </div>

                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Akhir</label>

                  <div class="col-sm-10">
                    <input type="date" class="col-sm-4" name="sa" id="sa" required=""><br><br>
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
                    url: '<?php echo base_url(); ?>laporan/laporan_tamuku/',
                    data: 'tanggal_pendaftaran='+document.getElementById("ss").value+'&tanggal_pendaftaran2='+document.getElementById("sa").value,
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