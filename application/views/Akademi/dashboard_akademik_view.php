<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
      <!-- Small boxes (Stat box) -->
      <div class="row">

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
            <a href="<?php echo base_url(); ?>finance/index" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="<?php echo base_url(); ?>finance/data_lunas" class="small-box-footer">Lihat Data<i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="<?php echo base_url(); ?>finance/data_lunas" class="small-box-footer">Lihat Data<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $dashboard['data_mhs_akuntansi']; ?> / <?php echo $dashboard['data_mhs_manajemen']; ?><sup style="font-size: 20px"></sup></h3>

              <p>Akuntansi / Manajemen</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?php echo base_url(); ?>finance/data_lunas" class="small-box-footer">Lihat Data<i class="fa fa-arrow-circle-right"></i></a>
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


      </div>
      <!-- /.row -->
      <!-- Main row -->
          <!-- /.box -->

          <!-- quick email widget -->
          
            
          </div>
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
