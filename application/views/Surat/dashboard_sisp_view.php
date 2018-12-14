<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
      <!-- Small boxes (Stat box) -->
      <div class="row">

<?php if ($this->session->userdata('level') == 2 AND $dosen2 != NULL) { ?>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $dashboard['data_unconfirm_dosen']; ?></h3>

              <p>Menunggu Verifikasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-hourglass-2"></i>
            </div>
            <a href="<?php echo base_url(); ?>surat/data_sisp" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

<?php } elseif ($this->session->userdata('level') == 1 OR $this->session->userdata('level') == 6 AND $this->session->userdata('username') == 'Zahroh') { ?>
           <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3><?php echo $dashboard['data_unconfirm']; ?></h3>

              <p>Permohonan</p>
            </div>
            <div class="icon">
              <i class="fa fa-hourglass-1"></i>
            </div>
            <a href="<?php echo base_url(); ?>surat/data_sisp" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $dashboard['data_verified']; ?></h3>

              <p>Menunggu Persetujuan</p>
            </div>
            <div class="icon">
              <i class="fa fa-hourglass-2"></i>
            </div>
            <a href="<?php echo base_url(); ?>surat/data_sisp_verified" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
<?php } ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $dashboard['data_approved']; ?></h3>

              <p>Surat Disetujui</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-square"></i>
            </div>
            <a href="<?php echo base_url(); ?>surat/data_sisp_approved" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $dashboard['data_rejected']; ?></h3>

              <p>Surat Ditolak</p>
            </div>
            <div class="icon">
              <i class="fa fa-times"></i>
            </div>
            <a href="<?php echo base_url(); ?>surat/data_sisp_rejected" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $dashboard['data_all']; ?></h3>

              <p>Data Permohonan</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            <a href="<?php echo base_url(); ?>surat/data_sisp_all" class="small-box-footer">Lihat Data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          </div>
         <div class="row"> 
          

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


