<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
      <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-md-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="glyphicon glyphicon-info-sign"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> <b> <i>NEW INFO ! </i></b></span>
              <span class="info-box-number"><?php foreach ($informasi as $data) { echo $data->judul_info; ?>
                
              </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                    <?php echo substr($data->deskripsi_info,0,100); ?> ... 
                    <a class="pull-right" style="color: white" href="" data-toggle="modal" data-target="#modal_view<?php echo $data->id_info; ?>"><u><i> Read More</i></u> </a>
                  </span>
             
                <?php } ?>

            </div>
        </div>
      </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $dashboard['data_kelas']; ?></h3>

              <p>Kelas yang diajar</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>master_dosen/nilai_dosen/<?php echo $dosen->id_dosen; ?>" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          </div>
         <div class="row"> 
          <div class="col-lg-6 col-xs-12">
          <div class="box box-info">
            <div class="box-body">

              <h3 style=""> Information Box </h3>
          <!-- small box -->
          <table  class="table table-bordered table-striped">
                
                <thead>
                <tr>
                  <th>No</th>
                  <th>Judul Informasi</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($informasi as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>

                  <td><a href="" data-toggle="modal" data-target="#modal_lihat'.$data->id_info.'">'.$data->judul_info.'</a></td>
                  <td>'.$data->deskripsi_info.'</td>
                  <td><a href="" data-toggle="modal" data-target="#modal_edit'.$data->id_info.'"><i class="fa fa-pencil"> </i></a></td>
                  

       
                ' ;
                
              }
              ?>
                </tbody>
              </table>
        </div>
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

