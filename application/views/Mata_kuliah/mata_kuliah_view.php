      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA MATA KULIAH</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo form_open('mata_kuliah/remove'); ?>
              
              <table id="example1" class="table2 table-hover table-striped table-condensed" style="text-transform: uppercase;">
                <a href="<?php echo base_url(); ?>mata_kuliah/tambah_matkul" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode MK</th>
                  <th>Nama MK</th>
                  <th>Bobot MK (sks)</th>
                  <th>Program Studi</th>
                  <th>Jenis MK</th>
                  <th>Aksi</th>
                  <th style="width: 2%" >Check</th>
                </tr>
                </thead>
                <tbody>

               
                </tbody>
              </table>
              <input type="submit" value="Hapus Mata Kuliah Terpilih" onclick="return confirm('Anda yakin menghapus data yang sudah anda pilih ?')" class="btn btn-danger pull-right btn-flat">
              <br>
             
              <?php echo form_close()?>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>


    
 <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
        $('#example1').DataTable( {
            data:           <?= $mata_kuliah; ?>,  
            deferRender:    true,
            scrollCollapse: true,
            scroller:       true,
            "autoWidth": true
        } );
        
    } );
</script>

<script>
function sum() {
      var bobot_tatap_muka = document.getElementById('bobot_tatap_muka').value;
      var bobot_simulasi = document.getElementById('bobot_simulasi').value;
      var bobot_praktikum = document.getElementById('bobot_praktikum').value;
      var bobot_praktik_lapangan = document.getElementById('bobot_praktik_lapangan').value;
      var result = parseInt(bobot_tatap_muka) + parseInt(bobot_simulasi) + parseInt(bobot_praktikum) + parseInt(bobot_praktik_lapangan);
      if (!isNaN(result)) {
         document.getElementById('bobot_matkul').value = result;
      }
}
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $("input[name='checkAll']").click(function() {
        var checked = $(this).attr("checked");
        $("#myTable tr td input:checkbox").attr("checked", checked);
      });
    });
  </script>