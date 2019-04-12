<!DOCTYPE html>
<html>
  <head>
    <title>STIE Jakarta International College</title>
    <link href='logo.png' rel='shortcut icon'>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  </head>
  <body class="hold-transition lockscreen">
    <div class="container" style="padding-top: 150px;">
      <div class="row">

        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4"></div>
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
          <?php echo $this->session->flashdata('message'); ?>
          <?php echo $this->session->flashdata('message2'); ?>
          <div class="panel panel-default">
            <div class="panel-heading"><h4 style="text-align: center;"><b>YOU ARE NOT ALLOWED! </b><br>PLEASE CONTACT ADMINISTRATOR</h4></div>
              <div class="panel-body">
              <form action="<?php echo base_url('login'); ?>" name="form-login" id="form-login" method="post" onsubmit="return validateForm()">
                <img src="<?php echo base_url(); ?>assets/403-Forbidden-Error.png" style="width: 100%">
               
                
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4"></div>
      </div>
    </div>
  </body>
</html>

