<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">


  <div class="row">
        <div class="col-md-12">
          <div class="info-box bg-aqua" <?php if($informasi == null){
            echo 'style="display: none"';
          }
          ?>>
            <span class="info-box-icon"><i class="glyphicon glyphicon-info-sign"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> <b> <i>NEW INFO ! </i></b></span>
              <span class="info-box-number"><?php foreach ($informasi as $data) { echo $data->judul_info; ?>
                
              </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    <a href="" style="color: white" data-toggle="modal" data-target="#modal_view<?php echo $data->id_info; ?>"> <?php echo substr($data->deskripsi_info,0,100); ?> ... </a>
                    <a class="pull-right" style="color: white" href="<?php echo base_url(); ?>informasi" ><u><i> Read More</i></u> </a>
                  </span>
             
                <?php } ?>

            </div>
        </div>
      </div>
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Grafik Tamu</h3>

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
              <div class="chart" id="line-chart2" style="height: 200px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
  
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $dashboard['data_tamu']; ?></h3>

              <p>Data Tamu</p>
            </div>
            <div class="icon">
              <i class="fa fa-newspaper-o"></i>
            </div>
            <a href="<?php echo base_url(); ?>tamu" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $dashboard['data_peserta_tes']; ?><sup style="font-size: 20px"></sup></h3>

              <p>Data Peserta Tes</p>
            </div>
            <div class="icon">
              <i class="fa fa-list-alt"></i>
            </div>
            <a href="<?php echo base_url(); ?>daftar_ulang/data_peserta_tes" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $dashboard['data_sgs']; ?><sup style="font-size: 20px"></sup></h3>

              <p >Data Student Get Student</p>
            </div>
            <div class="icon">
              <i class="fa fa-handshake-o"></i>
            </div>
            <a href="<?php echo base_url(); ?>tamu/data_sgs" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $dashboard['data_mhs']; ?><sup style="font-size: 20px"></sup></h3>

              <p>Data Mahasiswa</p>
            </div>
            <div class="icon">
              <i class="fa fa-database"></i>
            </div>
            <a href="<?php echo base_url(); ?>mahasiswa/mahasiswa_data" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
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

   
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
        <?php echo $encode;?>
      ,
      xkey: "waktu",
      ykeys: ['no_telp'],
      labels: ['Total'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });
    var line2 = new Morris.Line({
      element: 'line-chart2',
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

