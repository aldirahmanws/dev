<?php echo $this->session->flashdata('message');?><section class="content">
  
  <div class="box box-default">
    <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> Profile</h3>
    </div>
    <div class="box-body">
        <div class="row">
          <div class="col-sm-3">
            <form  method="post" runat="server" action="<?php echo base_url(); ?>profile/save_data" enctype="multipart/form-data">
            <div class="text-center">
              <div class="btn btn-file" >
              <img src="<?php echo base_url();?>uploads/<?php echo $data_user->foto; ?>" onerror="this.src='<?php echo base_url();?>uploads/user.jpg'" id="avatar" height="200" width="200"  alt="avatar">
              <input type="file" id="foto" name="foto" onchange="loadFile(event)">
            </div>
            </div></hr><br>
            <!-- <div class="box-body">
              <ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
              </ul> 
            </div> -->
          </div>
          <div class="col-sm-9">
             <!-- <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                <li><a data-toggle="tab" href="#messages">Menu 1</a></li>
                <li><a data-toggle="tab" href="#settings">Menu 2</a></li>
              </ul> -->
              <div class="tab-content">
            <div class="tab-pane active" id="home">
                      <div class="form-group">
                        <div class="col-xs-12">
                          <div class="col-sm-2">
                              <label for="first_name" ><h5><b>Username</b></h5></label>
                          </div>
                          <div class="col-xs-4">
                              <input type="text" class="form-control" name="username" id="username" value="<?php echo $this->session->userdata('username')?>" title="enter your first name if any." readonly="">
                          </div>
                        </div>
                      </div>
                      <div class="form-group" >
                        <div class="col-xs-12">
                          <div class="col-xs-2">
                              <label for="first_name"><h5 style="font-size: 13.5px"><b>Jabatan</b></h5></label>
                          </div>
                          <div class="col-xs-4">
                              <input type="text" class="form-control" name="password" id="password" value="<?php echo $data_user->nama_level; ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group" >
                        <div class="col-xs-12">
                          <div class="col-xs-2">
                              <label for="first_name"><h5><b>Nama </b></h5></label>
                          </div>
                          <div class="col-xs-4">
                              <input type="text" class="form-control" name="password_baru" id="password_baru" value="<?php echo $data_user->fullname; ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group" >
                        <br><br><br><br><br><br><br>
                        <div class="col-xs-12">
                          <div class="col-xs-6">
                          <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                          <button class="btn btn-default pull-right" type="reset"><i class="glyphicon glyphicon-repeat"></i> Cancel</button>
                        </div>
                          
                        </div>
                      </div>
                                
                      
                      
                      
                            </div>
                      </div>
                </form>
              
              
             </div>
          </div>
            <!-- /.box-body -->
          </div>

        </div>

          
        </div>
    </div>
  </div>
</section>
<script>
    function loadFile(event) {
                var output = document.getElementById('avatar');
                output.src = URL.createObjectURL(event.target.files[0]);
            }
</script>