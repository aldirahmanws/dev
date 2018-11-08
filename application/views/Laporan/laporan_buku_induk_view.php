
  <style type="text/css" media="print1">
  @page { size: landscape; }
</style>        <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Buku Induk</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Angkatan</label>

                  <div class="col-sm-10">
                    <div class="col-sm-4">
                    <select name="angkatan" id="angkatan" class="form-control select2" required="">   
                       <?php 

                            foreach($getTahunAngkatan as $row)
                            { 
                              echo '<option value="'.$row->tgl_du.'">'.$row->tgl_du.'</option>';
                            }
                            ?>
              </select></div>
              <br>
                  </div>

                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Prodi</label>

                  <div class="col-sm-10">
                    <div class="col-sm-4">
                    <select name="id_prodi" id="id_prodi" class="form-control select2" required="" > 
                      <option value="">Semua</option>   
                              <?php 

                            foreach($getProdi as $row)
                            { 
                              echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                            }
                            ?>
                  </select><br> <br>
                  <p class="btn btn-info" onclick="tampil()">Tampilkan</p>
                    <p class="btn btn-primary" onclick="print1()"> Cetak </p>

                </div>
                    <br>

                    
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
                    url: '<?php echo base_url(); ?>laporan/laporan_buku_indukku/',
                    data: 'angkatan='+document.getElementById("angkatan").value+'&id_prodi='+document.getElementById("id_prodi").value,
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