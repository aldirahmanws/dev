
<?php echo $this->session->flashdata('message');?>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">LEDGER</h3>
            </div>
            <div class="box-body">
              <table class="">
                <tbody>
                  <form method="get" action="<?php echo base_url("ledger/filter_ledger/")?>">
                  <tr>
                    <th>Filter</th>
                  </tr>
                  <tr>   
                    <td>Prodi</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      
                      <select name="id_prodi" onchange="return get_kurikulum_by_prodi(this.value)">
                        <option value="oiu"> Pilih Prodi </option>
                         <?php 

                                        foreach($getProdi as $row)
                                        { 
                                          echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                                        }
                                    ?>
                      </select>

                    </td>       
                                                                                                                             
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tahun Angkatan</td>     
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <select name="angkatan">
                        <option value="iu"> Pilih Tahun Angkatan </option>
                         <?php 

                            foreach($getTahunAngkatan as $row)
                            { 
                              echo '<option value="'.$row->tgl_du.'">'.$row->tgl_du.'</option>';
                            }
                            ?>
                      </select>
                    </td>
                    <td>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-primary btn-xs btn-flat" value="Cari">  
                    </td>

                  </tr>
                  
                </tbody>
              </table>
                      
               </form>
               <br>

              
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    
    <script type="text/javascript">
            function get_kurikulum_by_prodi(p) {
                var id_prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>ledger/get_kurikulum_by_prodi/'+id_prodi,
                    data: 'id_prodi='+id_prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#kurikulum").html(msg);
                    }
                });
            }
</script>

