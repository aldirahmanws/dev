<section class="content">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Rasio Dosen : Mahasiswa</h3><br>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Prodi</label>

                  <div class="col-sm-10">
                    <div class="col-sm-6">
                      <select class="select2" style="width: 100%" name="id_prodi" id="id_prodi" onchange="return get_semester(this.value);">
                        <option>Pilih Prodi</option>
                        <?php 

                      foreach($getProdi as $row)
                      { 
                        echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                      }
                      ?>
                      </select>

                </div>
                    <br>

                    
                  </div>

                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Periode</label>

                  <div class="col-sm-10">
                    <div class="col-sm-6">
                      <select class="select2" style="width: 100%" name="id_periode" id="id_periode">
                      </select>
                    <br><br>
                  <p class="btn btn-info" onclick="tampil()">Tampilkan</p>

                </div>
                    <br>

                    
                  </div>

                </div>
                

              </div>
              <!-- /.box-body -->
              <!-- /.box-footer -->
            </form>
          </div>
      <div class="box">
        <table class="table">
          <thead>
            <tr>
              <td>No</td>
              <td>Kode Prodi</td>
              <td>Nama Prodi</td>
              <td>Periode</td>
              <td>Dosen Tetap</td>
              <td>Mahasiswa</td>
              <td>Rasio</td>
            </tr>
          </thead>
          <tbody  id="show_data">
            
          </tbody>
        </table>
    </div>
  </div>
</section>
<script type="text/javascript">
    function tampil(){
        $.ajax({
                    url: '<?php echo base_url(); ?>laporan/show_rasio/',
                    data: 'id_prodi='+document.getElementById("id_prodi").value+'&id_periode='+document.getElementById("id_periode").value,
                    type: 'POST',
                    dataType: 'html',
                    success:function(msg){
                    $("#show_data").html(msg);
                    },
                    error:function (){}
                });
    }
    function get_semester(p) {
                $.ajax({
                    url: '<?php echo base_url(); ?>laporan/get_semester/'+p,
                    data: 'id_prodi='+p,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_periode").html(msg);

                    }
                });
            }
</script>