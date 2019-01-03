      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
      <script src="//code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
      <?php echo $this->session->flashdata('message');?>
<div class="box box-info">
            
            <div class="box-body">
              <table class="table">
        <tr>

          <input type="hidden" name="js_ranking" id="js_ranking" value="<?php echo $data->id_grade?>">
            <td width="15%" class="left_column">Nama Mahasiswa <font color="#FF0000">*</font></td>
            <td>:  <?php echo $data->nama_mahasiswa ?> </td>
      
           <td class="left_column" width="25%">NIM <font color="#FF0000">*</font></td>
            <td>:  <?php echo $data->nim ?> </td>           
            </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=>Jenis Kelamin <font color="#FF0000">*</font></td>
            <td width="25%">: <?php echo $data->jenis_kelamin ?>       </td>
            <td class="left_column" width="15%">Ranking / Grade <font color="#FF0000">*</font></td>
            <td>: <?php echo $data->grade;?>  </td>
        </tr>
        <tr>
            <td class="left_column">Nomor Telephone</td>
            <td>: <?php echo $data->no_telepon ?></td>
            <td class="left_column">Program Studi <font color="#FF0000">*</font></td>
            <td>: <?php echo $data->nama_prodi; ?></td>
          </tr>
           <tr>
            <td class="left_column">Kelas </td>
            <td>: <?php echo $data->waktu ?></td>
            <input type="hidden" name="waktu" id="waktu" value="<?php echo $data->waktu ?>">
            <td class="left_column">Semester <font color="#FF0000">*</font></td>
            <td>: <?php echo $data->semester_aktif; ?></td>
          </tr>
        </table>
            </div>
            <!-- /.box-body -->
          </div>
          <input type="hidden" name="id_mahasiswa" id="id_mahasiswa" value="<?php echo $data->id_mahasiswa ?>"> 
    <section class="content">
      <div class="row">
        
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Riwayat Pembayaran</h3>

              <button type="button" class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah
              </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Pembayaran</th>
                  <th>Jenis Pembayaran</th>
                  <th>Nama Pembayaran</th>
                  <th>Biaya</th>
                  <th>Denda</th>
                  <th>Potongan</th>
                  <th>Keterangan</th>
                  <th>Total Biaya</th>
                </tr>
                </thead>
                <tbody> 
                  <?php 
                $no = 0;
                foreach ($data_pembayaran as $i) {
                  if ($i->jenis_biaya == 'Angsuran Tahun 1'){
                    $dataea = $i->jumlah_biaya * $i->diskon / 100;
                    $iae = $i->jumlah_biaya - $dataea;
                    $iea = $i->jumlah_biaya - $dataea  - $i->potongan + $i->denda;
                  } else if($i->jenis_biaya == 'KRS'){
                    $iae = $i->jumlah_biaya * $i->bobot_matkul;
                    $iea = ($i->jumlah_biaya * $i->bobot_matkul)   - $i->potongan + $i->denda;
                    $i->nama_biaya = $i->nama_biaya.' - '.$i->kode_matkul;
                  }  else if($i->jenis_biaya == 'Angsuran Tahun 2' or $i->jenis_biaya == 'Angsuran Tahun 3' or $i->jenis_biaya == 'Angsuran Tahun 4'){
                    $dataea = $i->jumlah_biaya * $i->diskon / 100;
                    $iae = $i->jumlah_biaya - $dataea;
                    $iea = $i->jumlah_biaya - $dataea   - $i->potongan + $i->denda;
                  } else {
                    $iae = $i->jumlah_biaya;
                    $iea = $i->jumlah_biaya - $dataea   - $i->potongan + $i->denda;
                  }
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$i->tanggal_pembayaran.'</td>
                  <td>'.$i->jenis_biaya.'</td>
                  <td>'.$i->nama_biaya.'</td>
                  <td style="text-align:right">'.number_format($iae, 2, ",", ".").'</td>
                  <td style="text-align:right">'.number_format($i->denda, 2, ",", ".").'</td>
                  <td style="text-align:right">'.number_format($i->potongan, 2, ",", ".").'</td>
                  <td>'.$i->keterangan.'</td>
                  <td style="text-align:right">'.number_format($iea, 2, ",", ".").'</td>
                  
                  

       
                ' ;
                
              }
              ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
    
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
              <th>No</th>
              <th>Jenis Pembayaran</th>
              <th>Nama Pembayaran</th>
              <th>Biaya</th>
              <th>Denda</th>
              <th>Potongan</th>
              <th>Keterangan</th>
              <th>Total Biaya</th>
            </tr>
      </thead>
      <tbody>
        <?php 
          $i=0;
          foreach ($this->cart->contents() as $items) : 
          $i++;
        ?>
        <tr>
          <td><?= $i?></td>
          <td><?= $items['jp'] ?></td>
          <td><?= $items['pembayaran'] ?></td>
          <td align="right"><?= number_format($items['harga'],2,',','.') ?></td>
          <td align="right"><?= number_format($items['denda'],2,',','.') ?></td>
          <td align="right"><?= number_format($items['potongan'],2,',','.') ?></td>
          <td><?= $items['keterangan'] ?></td>
          <td align="right"><?= number_format($items['subtotal'],2,',','.') ?></td>
        </tr>
        
        <?php endforeach; ?>

      </tbody>
      <tfoot>
        <tr>
          <td align="right" colspan="5">Total </td>
          <td align="right"><?= number_format($this->cart->total(),2,',','.'); ?></td>
        </tr>
      </tfoot>

    </table>

    <div align="center">
        <?php echo form_open('finance/simpan_pembayaran/'.$this->uri->segment(3));?>
                <?php 
          $i=0;
          foreach ($this->cart->contents() as $items) : 
          $i++;
        ?>
                        <input type="hidden" class="form-control" id="kodeku_pembayaran" name="kodeku_pembayaran" value="<?= $items['kode'] ?>">
                        <input type="hidden" class="form-control" id="id_mhsa" name="id_mhsa" value="<?= $items['idmhsa'] ?>">
                <?php endforeach; ?>
                <div id="yoyo" style="display:  none">
  <section class="invoice" id="invoice">
      <!-- title row -->
      <div class="row" style="display: none">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> AdminLTE, Inc.
            <small class="pull-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-3 invoice-col">
          <address style="text-align: left">
            <strong>STIE Jakarta International College</strong><br>
            Jl.Perunggu No 54<br>
            Jakarta Pusat<br>
            Tel : 021-4257369
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-5 invoice-col">
            <table>
              <tr>
                <td width="120px"><strong>Nama Mahasiswa</strong></td>
                <td>: <?php echo $data->nama_mahasiswa ?></td>
              </tr>
              <tr>
                <td width="120px"><strong>NIM</strong></td>
                <td>: <?php echo $data->nim ?></td>
              </tr>
              <tr>
                <td width="120px"><strong>Metode</strong></td>
                <td>: Transfer</td>
              </tr>
              <tr>
                <td width="120px"><strong>Tanggal Terima</strong></td>
                <td>: <?php echo date('d-m-Y'); ?></td>
              </tr>
            </table>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <img class="pull-right" src="<?php echo base_url(); ?>/uploads/jiclogo.png">
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Jenis Pembayaran</th>
              <th>Nama Pembayaran</th>
              <th>Biaya</th>
              <th>Denda</th>
              <th>Potongan</th>
              <th>Keterangan</th>
              <th>Total Biaya</th>
            </tr>
            </thead>
            <tbody>
            <?php 
          $i=0;
          foreach ($this->cart->contents() as $items) : 
          $i++;
        ?>
        <tr>
          <td><?= $i?></td>
          <td><?= $items['jp'] ?></td>
          <td><?= $items['pembayaran'] ?></td>
          <td align="right"><?= number_format($items['harga'],2,',','.') ?></td>
          <td align="right"><?= number_format($items['denda'],2,',','.') ?></td>
          <td align="right"><?= number_format($items['potongan'],2,',','.') ?></td>
          <td><?= $items['keterangan'] ?></td>
          <td align="right"><?= number_format($items['subtotal'],2,',','.') ?></td>
        </tr>
        
        <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6" style="">
        </div>
        <!-- /.col -->
        <div class="col-xs-6" >
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?= number_format($this->cart->total(),2,',','.'); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print" style="display: none">
        <div class="col-xs-12">
          <p class="btn btn-primary btn-flat" onclick="print2()"> Cetak </p>
          <a href="invoice-print.html" target="_blank" class="btn btn-default btn-flat"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right btn-flat"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right btn-flat" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
    </section>
</div>
                <?php $cart_check = $this->cart->contents();
                if(empty($cart_check)) {
                echo '<button type="submit" class="btn btn-success btn-flat" disabled>Simpan & Cetak</button>';
                
                } else {
                  echo '<button type="submit" class="btn btn-success btn-flat" > Simpan </button>';
                  echo '&nbsp;<p class="btn btn-primary btn-flat" onclick="print1()"> Cetak </p>';

                } ?> 
                
                <?= anchor('finance/clear_cart/'.$this->uri->segment(3),'Reset',['class'=>'btn btn-danger btn-flat']) ?>         
            <?php echo form_close();?>
      
    </div>
   
    <div class="modal fade" id="modal-default" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pembayaran</h4>
              </div>
              <div class="modal-body">
                
                <div class="form-horizontal">
                <?php echo form_open('finance/add_to_cart/'.$this->uri->segment(3));?>
                  <div class="box-body">
                    <div class="box-body">
                      <input type="hidden" name="id_grade" id="id_grade" value="<?php echo $data->id_grade?>">
                        <input type="hidden" class="form-control" id="id_mhsa" name="id_mhsa" value="<?php echo $data->id_mahasiswa ?>" placeholder="" readonly >
                        <input type="hidden" class="form-control" id="nama_mhsa" name="nama_mhsa" value="<?php echo $data->nama_mahasiswa ?>" placeholder="" readonly>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Kode Pembayaran</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="kode_pembayaran" name="kode_pembayaran" value="<?= $kodeunik; ?>" placeholder="" readonly="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Tahun Akademik</label>

                      <div class="col-sm-8">
                         <select id="tahun_akademik" class="form-control" required="" name="tahun_akademik" onchange="return get_ta(this.value)">
                         <option value="">Pilih Tahun Akademik</option>   
                            <?php 

                                foreach($getTA as $row)
                          { 
                            echo '<option value="'.$row->periode.'">'.$row->periode.'</option>';

                          }
                          ?>
                  </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Jenis Pembayaran</label>

                      <div class="col-sm-8">
                         <select id="jenis_pembayaran" class="form-control" required="" name="jenis_pembayaran" onchange="return get_pembayaran(this.value)">
                         <!-- <option value="">Pilih Jenis Pembayaran</option>   
                            <?php 

                                foreach($getJenisPembayaran as $row)
                          { 
                            echo '<option value="'.$row->jenis_biaya.'">'.$row->jenis_biaya.'</option>';

                          }
                          ?> -->
                  </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Pembayaran</label>

                      <div class="col-sm-8">
                        <select class="form-control" required="" name="pembayaran" id="pembayaran" onchange="return get_biaya(this.value)"> 
                         <option value="">Pilih Jenis Pembayaran dulu</option>   
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Tanggal Pembayaran</label>

                      <div class="col-sm-8">
                        <input type="date" class="form-control" name="tanggal_pembayaran" id="tanggal_pembayaran" value="<?php echo date('Y-m-d'); ?>">
                      </div>
                    </div>
                    <div class="form-group" id="myText2" style="display: none;">
                      <label for="inputEmail3" class="col-sm-3 control-label">Mata Kuliah</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control"  name="krs_mengulang" id="krs_mengulang" value="" placeholder="Input Nama Mata Kuliah">
                        <input type="hidden" class="form-control" readonly="" name="krs_id" id="krs_id"  value="">
                        <input type="hidden" class="form-control" readonly="" name="kode_matkul" id="kode_matkul" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Potongan</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control"  name="potongan" id="potongan"  value="0"  onkeyup="myFunction()">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Denda</label>

                      <div class="col-sm-8">
                        <input type="number" id="denda" name="denda" class="form-control" value="0" onkeyup="myFunction()">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Keterangan</label>

                      <div class="col-sm-8">
                        <textarea name="keterangan" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-3 control-label">Biaya</label>

                      <div class="col-sm-8" id="biaya">
                        <input type="text" class="form-control" readonly="" name="biaya" id="biayaa" required="" value="" >
                        <input type="hidden" class="form-control" readonly="" name="biayaku" id="biayaku" required="" value="">
                      </div>
                    </div>
                    <center>
                    <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                    </center>
                  </div>
                  <!-- /.box-body -->
                  <!-- /.box-footer -->
                  <?php echo form_close();?>

                </div>
          </div>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
    
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script>
function myFunction() {
    
    var a = document.getElementById("denda").value;
    var c = document.getElementById("potongan").value;
    var b = document.getElementById("biayaku").value;
    var d;
    if (a > 0){
      a = document.getElementById("denda").value;
    } else {
      a = 0;
    }
    if (c > 0){
      c = document.getElementById("potongan").value;
    } else {
      c = 0;
    }
    var result = parseInt(a) + parseInt(b) - parseInt(c);
    if (!isNaN(result)) {
            document.getElementById("biayaa").value = result;
            } else {
              document.getElementById("biayaa").value = b;
            }
    
    
}
</script>
<script type="text/javascript">
            jQuery(document).ready(function($){
    $('#krs_mengulang').autocomplete({
      source:'<?php echo base_url(); ?>kurikulum/get_autocomplete', 
      minLength:1,
      select: function(event, ui){
        $('#krs_mengulang').val(ui.item.label)  ;
        $('#krs_id').val(ui.item.bobot);
        $('#kode_matkul').val(ui.item.id);
        var ea = document.getElementById('biayaku').value ;
        var ae = document.getElementById('krs_id').value;
        var result = parseInt(ea) * parseInt(ae);
        document.getElementById('biayaa').value = result;
      }
    });    
  });
  function get_pembayaran(p) {
                var jenis_biaya = p;
                var waktu = document.getElementById("waktu").value;
                var periode = document.getElementById('tahun_akademik').value;
                $.ajax({
                    url: '<?php echo base_url(); ?>finance/get_dropdown_pembayaran/',
                    data: 'jenis_biaya='+jenis_biaya+'&waktu='+waktu+'&periode='+periode,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                      console.log(jenis_biaya);
                        $("#pembayaran").html(msg);

                    }
                });
            }
            function get_ta(p) {
                var periode = p;
                var waktu = document.getElementById("waktu").value;
                $.ajax({
                    url: '<?php echo base_url(); ?>finance/get_ta/',
                    data: 'periode='+periode+'&waktu='+waktu,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                      console.log(periode);
                        $("#jenis_pembayaran").html(msg);

                    }
                });
            }
        function get_biaya(p) {
                var id_biaya = p;
                var id_grade = document.getElementById('js_ranking').value;
                var kategori = document.getElementById('jenis_pembayaran').value;
                if (kategori == 'KRS'){
                  document.getElementById("myText2").style.display = "";
                } else {
                  document.getElementById("myText2").style.display = "none";
                }
                $.ajax({
                    url: '<?php echo base_url(); ?>finance/get_biaya_pembayaran/',
                    data: 'id_biaya='+id_biaya+'&id_grade='+id_grade+'&kategori='+kategori,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                      if (kategori == 'Angsuran Tahun 1'){
                        //   if(id_grade == 'Ranking 1'){
                        //   var ea = parseInt(msg) * 0.40;
                        //   var ae = parseInt(msg) - ea;
                        //   document.getElementById('biayaa').value = ae;
                        // } else if(id_grade == '2'){
                        //   // var ea = parseInt(msg) * 0.35;
                        //   // var ae = parseInt(msg) - ea;
                        //   document.getElementById('biayaa').value = msg;
                        // } else if(id_grade == 'Ranking 3'){
                        //   var ea = parseInt(msg) * 0.25;
                        //   var ae = parseInt(msg) - ea;
                        //   document.getElementById('biayaa').value = ae;
                        // } else {
                        //   document.getElementById('biayaa').value = msg;
                        // }
                        document.getElementById('biayaa').value = msg;
                        document.getElementById('biayaku').value = msg;
                      } else if(kategori == 'KRS'){
                        document.getElementById('biayaku').value = msg;
                      } else {
                        document.getElementById('biayaa').value = msg;
                        document.getElementById('biayaku').value = msg;
                      }

                      

                    }
                });
            }
</script>
 <script>
    function print1(){
     var printContents = document.getElementById("yoyo").innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents; 
    }
  </script>