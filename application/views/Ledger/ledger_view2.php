

<style type="text/css">
        .buttons-copy {
        background:#2C97DF;
  color:white;
  border-top:0;
  border-left:0;
  border-right:0;
  border-bottom:4px solid #2A80B9;
  padding:2px 4px;
  text-decoration:none;
  font-family:sans-serif;
  font-size:11pt;
        }
    .buttons-pdf {
        background:red;
  color:white;
  border-top:0;
  border-left:0;
  border-right:0;
  border-bottom:4px solid black;
  padding:2px 4px;
  text-decoration:none;
  font-family:sans-serif;
  font-size:11pt;
  margin-left: 5px;
        }

        .buttons-csv {
        background:maroon;
  color:white;
  border-top:0;
  border-left:0;
  border-right:0;
  border-bottom:4px solid black;
  padding:2px 4px;
  text-decoration:none;
  font-family:sans-serif;
  font-size:11pt;
  margin-left: 5px;
        }

    .buttons-print {
        background:grey;
  color:white;
  border-top:0;
  border-left:0;
  border-right:0;
  border-bottom:4px solid black;
  padding:2px 4px;
  text-decoration:none;
  font-family:sans-serif;
  font-size:11pt;
  margin-left: 5px;
        }

      .buttons-excel {
        background:green;
  color:white;
  border-top:0;
  border-left:0;
  border-right:0;
  border-bottom:4px solid black;
  padding:2px 4px;
  text-decoration:none;
  font-family:sans-serif;
  font-size:11pt;
  margin-left: 5px;

        }

    </style>

  <style type="text/css">
    .rotate {

/* Safari */
-webkit-transform: rotate(-90deg);

/* Firefox */
-moz-transform: rotate(-90deg);

/* IE */
-ms-transform: rotate(-90deg);

/* Opera */
-o-transform: rotate(-90deg);

float: left;

}
  </style>
<?php echo $this->session->flashdata('message');?>
    <section class="content">

      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">

            <div class="box-header with-border">
              <h3 class="box-title">LEDGER</h3>
            </div>
            <div class="box-body">
              <div class="table-responsive">
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
                        <option value="wef"> Pilih Prodi </option>
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
                        <option value="regreg"> Pilih Tahun Angkatan </option>
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
                      </div>
               </form>
               <br>
               <div class="table-responsive">

             

              <table class="table table-bordered table-striped table-hover dataTable js-exportable" style="text-transform: uppercase;">
                
                <thead>
                <tr>
                  <th style="text-align: center">No</th>
                  <th style="text-align: center">Nama Mahasiswa</th>
                  <th style="text-align: center">NIM</th>
                  <?php 
                   foreach ($matkul as $data) { 
                    echo '
                      <th style="text-align: center">Semester '.$data->semester_kurikulum.' <br>'.$data->nama_matkul.' <br></th>

                    '; 
                    }
                    ?>
                  <th style="text-align: center">IPK</th>
                 
                </tr>
                </thead>
               

                <tbody>

                <tr>
                  <th style="text-align: center"></th>
                  <th style="text-align: center"></th>
                  <th style="text-align: center"></th>
                  <?php 
                   foreach ($matkul as $data) { 
                    echo '
                      <th style="text-align: center"> SKS ('.$data->bobot_matkul.')</th>

                    '; 
                    }
                    ?>
                  <th style="text-align: center"></th>
                 
                </tr>

                <?php 
                $no = 0;
                 $alert = "'Apakah anda yakin menghapus data ini ?'";

                foreach ($mahasiswa as $data) { ?>

                                 
                <tr>
                  <td style="text-align: center"><?php echo ++$no ?></td>
                  <td style="text-align: center"><?php echo $data->nama_mahasiswa ?></td>
                  <td style="text-align: center"><?php echo $data->nim ?></td>

                  <?php foreach ($matkul as $i) { ?>

                    <?php $nilai = $this->db->query("SELECT nilai_huruf AS abc FROM tb_kelas_mhs JOIN tb_mahasiswa ON tb_mahasiswa.id_mahasiswa = tb_kelas_mhs.id_mahasiswa JOIN tb_detail_kurikulum ON tb_detail_kurikulum.id_detail_kurikulum = tb_kelas_mhs.id_detail_kurikulum JOIN tb_matkul ON tb_matkul.kode_matkul = tb_detail_kurikulum.kode_matkul LEFT JOIN tb_skala_nilai ON tb_skala_nilai.id_skala_nilai = tb_kelas_mhs.id_skala_nilai  WHERE tb_matkul.kode_matkul = '$i->kode_matkul' AND tb_mahasiswa.id_mahasiswa = '$data->id_mahasiswa'")->row(); ?>

                    <?php if ($nilai->abc == NULL) {
                      $a = '-';
                    } else {
                      $a = $nilai->abc;
                    }
                    ?>
                    

                    <td style="text-align: center"> <?php echo $a; ?></td>

                  <?php } ?>

                    <?php $ipk = $this->db->select('ipk_ak AS ipks')
                    ->join('tb_periode','tb_periode.id_periode=tb_aktivitas_perkuliahan.id_periode')
                    ->where('tb_aktivitas_perkuliahan.id_mahasiswa',$data->id_mahasiswa)
                    ->order_by('tb_periode.semester','desc')
                    ->limit(1)
                    ->get('tb_aktivitas_perkuliahan')
                    ->row(); ?>

                  <td style="text-align: center"><?php echo $ipk->ipks ?></td>


                  </tr>
                 
                
                
              <?php } ?>
        
                </tbody>
              </table>
            </div>
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
      


