
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Mahasiswa Per Periode</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Filter</label>

                  <div class="col-sm-10">
                    <div class="col-sm-4">
                    <select name="filter" id="filter" class="form-control" onchange="mySemester(this.value)">
                      <option value="">Pilih Filter</option>
                      <option value="angkatan">Angkatan</option>   
                      <option value="periode">Periode</option>
                              
              </select>
            
                    </div>
              
                  </div>

                </div>
                <div class="form-group" id="tampil_periode" style="display: none">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tahun Periode</label>

                  <div class="col-sm-10">
                    <div class="col-sm-4">
                    <select name="ss" id="ss" class="form-control" required="">
                      <option value="">Pilih Periode</option>   
                              <?php 

                            foreach($getPeriode as $row)
                            { 
                              echo '<option value="'.$row->semester.'">'.$row->semester.'</option>';
                            }
                            ?>
              </select></div>
              <br>
                  </div>

                </div>
                <div class="form-group" id="tampil_angkatan" style="display: none">
                  <label for="inputEmail3" class="col-sm-2 control-label">Angkatan</label>

                  <div class="col-sm-10">
                    <div class="col-sm-4">
                    <select name="ssa" id="ssa" class="form-control" required="">
                      <option value="">Pilih Angkatan</option>   
                              <?php 

                            foreach($getAngkatan as $row)
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
                    <select name="sa" id="sa" class="form-control" required="" >
                      <option value="*">Pilih Program Studi</option>   
                      <option value="">Semua</option>   
                              <?php 

                            foreach($getProdi as $row)
                            { 
                              echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                            }
                            ?>
                  </select><br>
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
                    url: '<?php echo base_url(); ?>laporan/laporan_mahasiswaku/',
                    data: 'id_periode='+document.getElementById("ss").value+'&id_prodi='+document.getElementById("sa").value+'&filter='+document.getElementById("filter").value+'&tgl_du='+document.getElementById("ssa").value,
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
  <script>
function mySemester(p) {
    var x = p;
    if(x == "angkatan"){
      document.getElementById("tampil_angkatan").style.display = null;
      document.getElementById("tampil_periode").style.display = 'none';
    } else if(x == "periode"){
      document.getElementById("tampil_angkatan").style.display = 'none';
      document.getElementById("tampil_periode").style.display = null;
    }
    console.log(x);
}
</script>