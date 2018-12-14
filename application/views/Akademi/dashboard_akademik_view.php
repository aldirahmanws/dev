<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <?php if ($informasi != NULL) { ?>
          
            <div class="alert alert-dismissible alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-info"></i> <?php foreach ($informasi as $data) { echo $data->judul_info; ?></h4>
             
                <?php echo substr($data->deskripsi_info,0,100); ?> ... <a class="pull-right" style="color: white" href="" data-toggle="modal" data-target="#modal_view<?php echo $data->id_info; ?>"><u><i> Read More</i></u> </a>
                <?php } ?>
              </div>
            <?php } ?>
      </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $dashboard['data_mhs_aktif']; ?></h3>

              <p>Jumlah Mahasiswa Aktif</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $dashboard['data_prodi']; ?><sup style="font-size: 20px"></sup></h3>

              <p>Jumlah Prodi</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>master_prodi" class="small-box-footer">Lihat Data<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $dashboard['data_dosen']; ?><sup style="font-size: 20px"></sup></h3>

              <p>Jumlah Dosen</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>master_dosen" class="small-box-footer">Lihat Data<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $dashboard['data_mhs']; ?><sup style="font-size: 20px"></sup></h3>

              <p>Total Mahasiswa</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa" class="small-box-footer">Lihat Data<i class="fa fa-arrow-circle-right"></i></a>
          </div>

        </div>

        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Penerimaan Mahasiswa</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="line-chart" style="height: 200px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-md-3">
          <div class="box">
            <center>
            <div id="canvas-holder">
              <canvas id="chart-area" width="150" height="150"/>
            </div>
            <p><b>Rasio Mahasiswa Per Prodi</b></p>
          </center>
          </div>
        </div>


      </div>
      <!-- /.row -->
      <!-- Main row -->
          <!-- /.box -->

          <!-- quick email widget -->
          
            
          </div>

          <?php 
        foreach($informasi as $i):
        ?>
        <div class="modal fade" id="modal_view<?php echo $i->id_info;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Detail Informasi</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      
                      <table class="table">
      <tr>
          <td class="left_column" style="width:20%">Judul </td>
            <td>: <?php echo $i->judul_info; ?>   
            </td>
        </tr>
        <tr>
          <td class="left_column">Deskripsi </td>
            <td>: <?php echo $i->deskripsi_info; ?>          </td>
        </tr> 
        <tr>
          <td class="left_column">Pengirim </td>
            <td>: <?php echo $i->pengirimh; ?>          </td>
        </tr> 
         <tr>
          <td class="left_column">Tanggal Terbit </td>
            <td>: <?php echo $i->tgl_info; ?>          </td>
        </tr> 
        
    </table>

                    </div>

                </div>
            </div>
            </div>
        </div>
        

    <?php endforeach;?>
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->

<!-- AdminLTE for demo purposes -->

<!-- page script -->

<script>
  $(function () {
    var pieData = <?= $pie ?>;
    var pieData2 = <?= $pie ?>;
    var ctx = document.getElementById("chart-area").getContext("2d");
    var myPie = new Chart(ctx).Pie(pieData);

    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: 
        <?php echo $encode2;?>
      ,
      xkey: "waktu",
      ykeys: ['no_telp'],
      labels: ['Total'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });
    
  });
</script>
<script>

      



  </script>

