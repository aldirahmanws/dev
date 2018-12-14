<section class="content">
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
              <h3><?php echo $dashboard['belum_bayar']; ?></h3>

              <p>Transfer Registrasi Masuk</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>finance/data_registrasi" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $dashboard['lunas']; ?><sup style="font-size: 20px"></sup></h3>

              <p>Registrasi Lunas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo base_url(); ?>finance/data_lunas" class="small-box-footer">Lihat Data<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
          <!-- /.box -->

          <!-- quick email widget -->
          
            
          </div>

        </section>

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