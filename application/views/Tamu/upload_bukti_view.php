<form  method="post" runat="server" action="<?php echo base_url(); ?>tamu/save_bukti_transfer/<?php echo $edit->id_pendaftaran; ?>" enctype="multipart/form-data">
  <?php echo $this->session->flashdata('message');?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Unggah Bukti</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  
                       <div class="form-group">
                            <label>Foto </label> (format JPG, PNG, PDF)<br>
                            <img id="output"/>
                        </div>
                        <div class="form-group">
                                            <input type="file" id="bukti_transfer" name="bukti_transfer" onchange="loadFile(event)" required="">
                                          </div>
                                        <div>
                      
                      <div class="form-group mb-n">
                  <div class="col-sm-8">
                  <label for="exampleInputFile" class="">    </label>
                    <input type="submit" name="submit" class="btn btn-default" background_color="orange" id="largeinput" placeholder="Large Input" value="Upload">
                  </div>
                </div>      
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div>
        </form>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>