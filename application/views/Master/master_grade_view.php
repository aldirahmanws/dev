      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Master Grade</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive" style="overflow-x: hidden;">
              <table id="example1" class="table2 table-hover table-striped table-condensed" style="text-transform: uppercase;">
                
                <a href="" data-toggle="modal" data-target="#modal_tambah" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
              <thead>
              <tr>
                <th width="1%" >No.</th>
                <th width="15%" >Grade</th>
                <!-- <th>Diskon</th> -->
                <th>Nilai Awal</th>
                <th>Nilai Akhir</th>
                <th width="20%" colspan="2">Berlaku pada</th>
                <th width="10%">Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                    $no = 0;
                    $alert = "'Anda yakin menghapus data ini ?'";
                    foreach($grade as $data):
                    ;
                  ?>
                  <tr>
                  <td><?php echo ++$no;?></td>
                    <td><?php echo $data->grade;?></td> 
                    <!-- <td><?php echo $data->diskon;?>%</td> -->
                    <td><?php echo $data->grade_awal;?></td>
                    <td><?php echo $data->grade_akhir;?></td>
                    <td><?php echo date("d-m-Y", strtotime($data->tgl_awal_grade));?></td>
                    <td><?php echo date("d-m-Y", strtotime($data->tgl_akhir_grade));?></td>

                    <td>
                      <input type="hidden" id="data_grade<?= $data->id_grade ?>" value="<?= $data->grade ?>">
                      <input type="hidden" id="data_diskon<?= $data->id_grade ?>" value="<?= $data->diskon ?>">
                      <input type="hidden" id="data_grade_awal<?= $data->id_grade ?>" value="<?= $data->grade_awal ?>">
                      <input type="hidden" id="data_grade_akhir<?= $data->id_grade ?>" value="<?= $data->grade_akhir ?>">
                      <input type="hidden" id="data_tgl_awal_grade<?= $data->id_grade ?>" value="<?= $data->tgl_awal_grade ?>">
                      <input type="hidden" id="data_tgl_akhir_grade<?= $data->id_grade ?>" value="<?= $data->tgl_akhir_grade ?>">
                      <a onclick="show_modal('<?= $data->id_grade; ?>')"  class="btn btn-warning btn-xs btn-flat glyphicon glyphicon-pencil"><span class="tooltiptext">Edit</span></a>
                    <a href="<?= base_url('Master_grade/delete_grade/'.$data->id_grade); ?>" onclick="return confirm(<?= $alert; ?>)" class="btn btn-danger btn-xs btn-flat glyphicon glyphicon-trash" ><span class="tooltiptext">Hapus</span></a>

                    </td>
                    
                </tr>
            <?php endforeach; ?>
              
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

       <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
          - Digunakan untuk mengelola data grade yang sedang berlaku.
          <br>

            - Tanggal grade yang berlaku mengacu pada tanggal pendaftaran.
            <br>

        &nbsp; <b> Contoh : Tanggal grade yang berlaku pada 1 Januari 2016 - 31 Desember 2018. Maka grade tersebut berlaku untuk mahasiswa
       
       yang mendaftar pada rentang waktu tersebut, misal 20 Agustus 2017. </b>
            
         </div>

      <!-- /.row -->
    </section>

   
    <div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">TAMBAH GRADE</h3>
            </div>
                <div class="modal-body">
                        <?php echo form_open('Master_grade/add_grade', 'class="form-horizontal" method="post" role="form" enctype="multipart/form-data"'); ?>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Grade</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="text" name="grade" class="form-control">
                    </div>
                </div>
                <!-- <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Diskon</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="text" name="diskon" class="form-control">
                    </div>
                </div> -->
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Nilai Awal</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="text" name="grade_awal" class="form-control">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Nilai Akhir</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="text" name="grade_akhir" class="form-control">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Tanggal Awal Grade</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="date" name="tgl_awal_grade" class="form-control">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Tanggal Akhir Grade</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="date" name="tgl_akhir_grade" class="form-control">
                    </div>
                </div>
                <!-- Manufacturer -->
                <div class="box-footer text-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
                </div>
                </div>
            </div>
            </div>
    </div>
    <?php echo form_close();?>
    <div class="modal fade" id="modal_edit" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">EDIT GRADE</h3>
            </div>
                <div class="modal-body">
                        <?php echo form_open('Master_grade/edit_grade', 'class="form-horizontal" method="post" role="form" enctype="multipart/form-data"'); ?>
                        <input type="hidden" name="id_grade" id="id_grade">
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Grade</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="text" name="grade" class="form-control" id="grade">
                    </div>
                </div>
                <!-- <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Diskon</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="text" name="diskon" class="form-control" id="diskon">
                    </div>
                </div> -->
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Nilai Awal</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="text" name="grade_awal" class="form-control" id="grade_awal">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Nilai Akhir</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="text" name="grade_akhir" class="form-control" id="grade_akhir">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Tanggal Awal Grade</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="date" name="tgl_awal_grade" class="form-control" id="tgl_awal_grade">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Tanggal Akhir Grade</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="date" name="tgl_akhir_grade" class="form-control" id="tgl_akhir_grade">
                    </div>
                </div><!-- Manufacturer -->
                <div class="box-footer text-right">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check icon-white"></i> Save</button>
                </div>
                </div>
            </div>
            </div>
    </div>
    <?php echo form_close();?>
    <script type="text/javascript">
      function show_modal(p) {
        $('#modal_edit').modal('show');
        $('#id_grade').val(p);
        $('#grade').val($('#data_grade'+p).val());
        /*$('#diskon').val($('#data_diskon'+p).val());*/
        $('#grade_awal').val($('#data_grade_awal'+p).val());
        $('#grade_akhir').val($('#data_grade_akhir'+p).val());
        $('#ket').val($('#data_ket'+p).val());
        $('#tgl_awal_grade').val($('#data_tgl_awal_grade'+p).val());
        $('#tgl_akhir_grade').val($('#data_tgl_akhir_grade'+p).val());
      }
    </script>



