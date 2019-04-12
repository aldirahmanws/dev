
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
<div class="col-md-6">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label" <?php if($senin == null){
            echo 'style="display: none"';
          }
          ?>>
                  <span class="bg-red">
                    Senin
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php foreach ($senin as $data) { ?>
            <li>
              <i class="fa fa-clock-o bg-grey"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i><b> &nbsp; (<?php echo substr($data->jam_awal,0,-3).' - '.substr($data->jam_akhir,0,-3); ?>)</b></span>

                <h5 class="timeline-header no-border"><a href="<?php echo base_url(); ?>mahasiswa/jadwal_mhs"><?php echo $data->nama_matkul; ?></a> </h5>
              </div>
            </li>

          <?php } ?>
          <li class="time-label">
                  <span class="bg-yellow" <?php if($selasa == null){
            echo 'style="display: none"';
          }
          ?>>
                    Selasa
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php foreach ($selasa as $data) { ?>
            <li>
              <i class="fa fa-clock-o bg-grey"></i>

              <div class="timeline-item">
                 <span class="time"><i class="fa fa-clock-o"></i><b> &nbsp; (<?php echo substr($data->jam_awal,0,-3).' - '.substr($data->jam_akhir,0,-3); ?>)</b></span>

                <h5 class="timeline-header no-border"><a href="<?php echo base_url(); ?>mahasiswa/jadwal_mhs"><?php echo $data->nama_matkul; ?></a> </h5>
              </div>
            </li>

          <?php } ?>
          <li class="time-label" <?php if($rabu == null){
            echo 'style="display: none"';
          }
          ?>>
                  <span class="bg-maroon">
                    Rabu
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php foreach ($rabu as $data) { ?>
            <li>
              <i class="fa fa-clock-o bg-grey"></i>

              <div class="timeline-item">
                 <span class="time"><i class="fa fa-clock-o"></i><b> &nbsp; (<?php echo substr($data->jam_awal,0,-3).' - '.substr($data->jam_akhir,0,-3); ?>)</b></span>

                <h3 class="timeline-header no-border"><a href="<?php echo base_url(); ?>mahasiswa/jadwal_mhs"><?php echo $data->nama_matkul; ?></a> </h3>
              </div>
            </li>

          <?php } ?>
          <li class="time-label" <?php if($kamis == null){
            echo 'style="display: none"';
          }
          ?>>
                  <span class="bg-aqua">
                    Kamis
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php foreach ($kamis as $data) { ?>
            <li>
              <i class="fa fa-clock-o bg-grey"></i>

              <div class="timeline-item">
                 <span class="time"><i class="fa fa-clock-o"></i><b> &nbsp; (<?php echo substr($data->jam_awal,0,-3).' - '.substr($data->jam_akhir,0,-3); ?>)</b></span>

                <h3 class="timeline-header no-border"><a href="<?php echo base_url(); ?>mahasiswa/jadwal_mhs"><?php echo $data->nama_matkul; ?></a> </h3>
              </div>
            </li>

          <?php } ?>
          <li class="time-label" <?php if($jumat == null){
            echo 'style="display: none"';
          }
          ?>>
                  <span class="bg-green">
                    Jumat
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php foreach ($jumat as $data) { ?>
            <li>
              <i class="fa fa-clock-o bg-grey"></i>

              <div class="timeline-item">
                 <span class="time"><i class="fa fa-clock-o"></i><b> &nbsp; (<?php echo substr($data->jam_awal,0,-3).' - '.substr($data->jam_akhir,0,-3); ?>)</b></span>

                <h5 class="timeline-header no-border"><a href="<?php echo base_url(); ?>mahasiswa/jadwal_mhs"><?php echo $data->nama_matkul; ?></a> </h5>
              </div>
            </li>

          <?php } ?>
            <!-- END timeline item -->
            <!-- timeline item -->
         

            
            

           
          </ul>
        </div>
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Grafik IPK Mahasiswa</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>

            </div>

            <div class="box-body">
              <div id="line-chart" style="height: 200px;"></div>
            </div>
            <p style="margin-left: 3%">Garis Menurun : IPK</p>
            <p style="margin-left: 3%">Garis Mendatar : Semester</p>
            <!-- /.box-body-->
          </div>
        </div>

        <div class="col-md-6 pull-right">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Grafik IPS Mahasiswa</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="line-chart-ips" style="height: 200px;"></div>
            </div>
            <p style="margin-left: 3%">Garis Menurun : IPS</p>
            <p style="margin-left: 3%">Garis Mendatar : Semester</p>
            <!-- /.box-body-->
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

<script src="<?php echo base_url(); ?>assets/bower_components/Flot/jquery.flot.js"></script>
<!-- AdminLTE App -->

<!-- AdminLTE for demo purposes -->

<?php
$id_level = $this->session->userdata('level');
$username = $this->session->userdata('username');
$session = $this->mahasiswa_model->session_mahasiswa($username);
$id_mahasiswa = $session->id_mahasiswa;

$ipk_1 = $this->db->query("SELECT ipk_ak as total FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = 1")->row();    
$ipk_2 = $this->db->query("SELECT ipk_ak as total FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = 2")->row();     
$ipk_3 = $this->db->query("SELECT ipk_ak as total FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = 3")->row(); 
$ipk_4 = $this->db->query("SELECT ipk_ak as total FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = 4")->row(); 
$ipk_5 = $this->db->query("SELECT ipk_ak as total FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = 5")->row(); 
$ipk_6 = $this->db->query("SELECT ipk_ak as total FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = 6")->row(); 
$ipk_7 = $this->db->query("SELECT ipk_ak as total FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = 7")->row(); 
$ipk_8 = $this->db->query("SELECT ipk_ak as total FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa' AND semester_ak = 8")->row(); 

if ($ipk_1->total == NULL) {
  $ipk_11 = 0;
} else {
  $ipk_11 = $ipk_1->total;
}

if ($ipk_2->total == NULL) {
  $ipk_12 = 0;
} else {
  $ipk_12 = $ipk_2->total;
}

if ($ipk_3->total == NULL) {
  $ipk_13 = 0;
} else {
  $ipk_13 = $ipk_3->total;
}
$semester2 = '1';
$id_mahasiswa2 = 'M00318';
$ipk_mahasiswa = $this->db->query("SELECT ipk_ak FROM tb_aktivitas_perkuliahan WHERE id_mahasiswa = '$id_mahasiswa2' AND semester_ak = '$semester2'")->row();

print_r($ipk_mahasiswa);


 ?> 


<!-- page script -->
<script>
var sin = <?= $encode2 ?>;

    
    var line_data1 = {

      data : sin,
      color: '#3c8dbc'
    }

    $.plot('#line-chart', [line_data1], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

        $('#line-chart-tooltip').html(' IPK ' + ' = ' + y)
          .css({ top: item.pageY + 5, left: item.pageX + 5 })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })
      
  </script>

<script>
var cos = <?= $encode3 ?>;
    
    var line_data2 = {

      data : cos,
      color: '#3c8dbc'
    }

    $.plot('#line-chart-ips', [line_data2], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#3c8dbc', '#f56954']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip2"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart-ips').bind('plothover', function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0].toFixed(2),
            y = item.datapoint[1].toFixed(2)

        $('#line-chart-tooltip2').html(' IPS ' + ' = ' + y)
          .css({ top: item.pageY + 5, left: item.pageX + 5 })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip2').hide()
      }

    })
      



  </script>

      



 