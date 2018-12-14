      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
      <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
    </style>
      <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <!-- /.box-header -->
            <!-- form start --><br>
            <form>
            <div class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">NIM</label>

                  <div class="col-sm-6">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" value="">
                    <span class="input-group-btn">
                        <p class="btn btn-info btn-flat" onclick="cari()">Cari</p>
                    </span>
                    </div>
                    <input type="hidden" id="id_mahasiswa" name="id_mahasiswa" >
                  </div>
                  <div>
                    
                  </div>
                </div>
              </div>
              

            </form>
           
          </div>
      </div>
       <div class="box" id="show_data">
            </div>

  <script>

  	   document.getElementById("nama_mhs").style.visibility = 'visible';
	  jQuery(document).ready(function($){
	  $('#nama_mhs').autocomplete({
	    source:'<?php echo base_url(); ?>finance/get_autocomplete', 
	    minLength:1,
	    select: function(event, ui){
	      $('#nama_mhs').val(ui.item.label);
	      $('#id_mahasiswa').val(ui.item.id);
        
	    }
	  });    
	});

    function cari(){
      $.ajax({
                    url: '<?php echo base_url(); ?>finance/cek_mahasiswa/',
                    data: 'id_mahasiswa='+document.getElementById("id_mahasiswa").value,
                    type: 'GET',
                    dataType: 'html',
                    success:function(data){
                    $("#show_data").html(data);
                    },
                    error:function (){}
                });
    }
  </script>
    
        