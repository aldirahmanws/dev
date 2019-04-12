<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>

<?php echo $this->session->flashdata('message');?>
    <!-- Page Heading -->
        <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Transfer Masuk</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>No Tamu</th>
                  <th>Nama Pendaftar</th>
                  <th>Status Pendaftar</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
            <tbody id="show_data">
                
            </tbody>
        </table>
        </div>
    </div>

        <!-- MODAL ADD -->
       
        <!--END MODAL ADD-->

        <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalaEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Konfirmasi Pembayaran</h3>
            </div>
            <?php echo form_open('finance/konfirmasi/'); ?>
            <div class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                      <input type="hidden" name="id_pendaftaran" class="form-control" id="alamat" placeholder="Input Home Address" required="" value="">
                        <label class="control-label col-xs-3" >No. Registrasi</label>
                        <div class="col-xs-5">
                            <input type="text" name="id_daftar_ulang" class="id_daftar_ulang form-control input-sm pull-left" id="id_daftar_ulang" placeholder="" required="">
                        </div>
                        <div class="col-xs-1">
                        <span id="user-availability-status"></span> 
                      </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" type="submit" id="btn_update">Konfirmasi</button>
                </div>
            </div>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT-->

        <!--MODAL HAPUS-->
        <!--END MODAL HAPUS-->


<script type="text/javascript">
    $(document).ready(function(){
        tampil_data_barang();   //pemanggilan fungsi tampil barang.
        
        $('#mydata').dataTable();
         
        //fungsi tampil barang
        function tampil_data_barang(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url()?>finance/data_barang',
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    var a = 1;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                '<td>'+a+++'</td>'+
                                '<td>'+data[i].id_pendaftaran+'</td>'+
                                '<td>'+data[i].nama_pendaftar+'</td>'+
                                '<td>'+data[i].id_pendaftaran+'</td>'+
                                '<td><a href="<?php echo base_url()?>uploads/'+data[i].bukti_transfer+'" class="btn btn-info btn-sm" target="_blank">Lihat Bukti</a></td>'+
                                '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-info btn-xs item_edit" data="'+data[i].id_pendaftaran+'">Konfirmasi</a>'+' '+
                                    '<a href="<?php echo base_url()?>finance/form_penolakan/'+data[i].id_pendaftaran+'" class="btn btn-danger btn-xs item_hapus" data="'+data[i].barang_kode+'">Tolak</a>'+
                                '</td>'+
                                '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }

        //GET UPDATE
        $('#show_data').on('click','.item_edit',function(){
             var id=$(this).attr('data');
             $('[name="id_pendaftaran"]').val(id);
            $('#ModalaEdit').modal('show');
            $('#id_daftar_ulang').val(" ");
            document.getElementById("user-availability-status").innerHTML = " ";
            
                $('#ModalaEdit').on('keyup','.id_daftar_ulang',function(){
                    $.ajax({
                        url: '<?php echo base_url(); ?>finance/cek_id_daftar_ulang/',
                        data: 'id_daftar_ulang='+$("#id_daftar_ulang").val(),
                        type: 'POST',
                        dataType: 'html',
                        success:function(data){
                        $("#user-availability-status").html(data);
                        },
                        error:function (){}
                    });
                });    
        });

    

    });

</script>

</body>
</html>