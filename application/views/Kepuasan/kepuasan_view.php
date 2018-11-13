      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">KEPUASAN</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table2 table-hover table-striped table-condensed" style="text-transform: uppercase;">
                
                <a href="" data-toggle="modal" data-target="#modal_tambah" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
              <thead>
              <tr>
                <th width="1%" >No.</th>
                <th width="15%" >Prodi</th>
                <th>Periode</th>
                <th>Dosen</th>
                <th>Mata Kuliah</th>
                <th width="1%">Jumlah Pertanyaan</th>
                <th width="1%">Jumlah Mahasiswa</th>
                <th width="1%">Hasil</th>
                <th width="10%">Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                    $no = 0;
                    $alert = "'Anda yakin menghapus data ini ?'";
                    foreach($kepuasan as $data):
                    ;
                  ?>
                  <tr>
                  <td><?php echo ++$no;?></td>
                    <td><?php echo $data->nama_prodi;?></td>
                    <td><?php echo $data->semester;?></td>
                    <td><?php echo $data->nama_dosen;?></td>
                    <td><?php echo $data->nama_matkul;?></td>
                    <td><?php echo $data->jml_pertanyaan;?></td>
                    <td><?php echo $data->jml_mahasiswa;?></td>
                    <td><?php echo round((($data->total_nilai_5 + $data->total_nilai_4 + $data->total_nilai_3 + $data->total_nilai_2 + $data->total_nilai_1) / $data->jml_pertanyaan / $data->jml_mahasiswa), 1 ) ;?></td>

                    <td>
                      <input type="hidden" id="data_prodi<?= $data->id_kepuasan ?>" value="<?= $data->id_prodi ?>">
                      <input type="hidden" id="data_periode<?= $data->id_kepuasan ?>" value="<?= $data->id_periode ?>">
                      <input type="hidden" id="data_dosen<?= $data->id_kepuasan ?>" value="<?= $data->id_dosen ?>">
                      <input type="hidden" id="data_kode_matkul<?= $data->id_kepuasan ?>" value="<?= $data->kode_matkul ?>">
                      <input type="hidden" id="data_jml_pertanyaan<?= $data->id_kepuasan ?>" value="<?= $data->jml_pertanyaan ?>">
                      <input type="hidden" id="data_jml_mahasiswa<?= $data->id_kepuasan ?>" value="<?= $data->jml_mahasiswa ?>">
                      <input type="hidden" id="data_total_nilai_5<?= $data->id_kepuasan ?>" value="<?= $data->total_nilai_5 ?>">
                      <input type="hidden" id="data_total_nilai_4<?= $data->id_kepuasan ?>" value="<?= $data->total_nilai_4 ?>">
                      <input type="hidden" id="data_total_nilai_3<?= $data->id_kepuasan ?>" value="<?= $data->total_nilai_3 ?>">
                      <input type="hidden" id="data_total_nilai_2<?= $data->id_kepuasan ?>" value="<?= $data->total_nilai_2 ?>">
                      <input type="hidden" id="data_total_nilai_1<?= $data->id_kepuasan ?>" value="<?= $data->total_nilai_1 ?>">
                      <a onclick="show_modal('<?= $data->id_kepuasan; ?>')"  class="btn btn-warning btn-xs btn-flat glyphicon glyphicon-pencil"><span class="tooltiptext">Edit</span></a>
                    <a href="<?= base_url('Master/delete_kepuasan/'.$data->id_kepuasan); ?>" onclick="return confirm(<?= $alert; ?>)" class="btn btn-danger btn-xs btn-flat glyphicon glyphicon-trash" ><span class="tooltiptext">Hapus</span></a>

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
      <!-- /.row -->
    </section>
    <div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">TAMBAH KEPUASAN</h3>
            </div>
                <div class="modal-body">
                        <?php echo form_open('kepuasan/add_kepuasan', 'class="form-horizontal" method="post" role="form" enctype="multipart/form-data"'); ?>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Prodi</label>
                    <div class="col-md-7 col-sm-12 required">
                        <select class="select2" style="width: 100%" name="id_prodi" onchange="get_semester(this.value)">
                          <option value=""> Pilih Prodi</option>
                          <?php 
                            foreach($get_prodi as $row)
                            { 
                              echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                            }
                          ?>
                        </select>

                        
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Periode</label>
                    <div class="col-md-7 col-sm-12 required">
                        <select class="select2" style="width: 100%" name="id_periode" id="id_periode">
                          <option value=""> Pilih Periode</option>
                        </select>

                        
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Dosen</label>
                    <div class="col-md-7 col-sm-12 required">
                        <select class="select2" style="width: 100%" name="id_dosen">
                          <option value=""> Pilih Dosen </option>
                          <?php 
                            foreach($get_dosen as $row)
                            { 
                              echo '<option value="'.$row->id_dosen.'">'.$row->nama_dosen.'</option>';
                            }
                          ?>
                        </select>

                        
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Mata kuliah</label>
                    <div class="col-md-7 col-sm-12 required">
                        <select class="select2" style="width: 100%" name="kode_matkul">
                          <option value=""> Pilih Mata kuliah </option>
                          <?php 
                            foreach($get_matkul as $row)
                            { 
                              echo '<option value="'.$row->kode_matkul.'">'.$row->nama_matkul.'</option>';
                            }
                          ?>
                        </select>

                        
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Jumlah Pertanyaan</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="jml_pertanyaan" class="form-control">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Jumlah Pertanyaan</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="jml_mahasiswa" class="form-control">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 5</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_5" class="form-control">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 4</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_4" class="form-control">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 3</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_3" class="form-control">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 2</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_2" class="form-control">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 1</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_1" class="form-control">
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
                <h3 class="modal-title" id="myModalLabel">EDIT KEPUASAN</h3>
            </div>
                <div class="modal-body">
                        <?php echo form_open('Kepuasan/edit_kepuasan', 'class="form-horizontal" method="post" role="form" enctype="multipart/form-data"'); ?>
                        <input type="hidden" name="id_kepuasan" id="id_kepuasan">
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Prodi</label>
                    
                    <div class="col-md-7 col-sm-12 required">
                        <select class="select2" style="width: 100%" name="id_prodi" id="id_prodi" onchange="get_semester2(this.value)">
                          <option value=""> Pilih Prodi</option>
                          <?php 
                            foreach($get_prodi as $row)
                            { 
                              echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                            }
                          ?>
                        </select>

                        
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Periode</label>
                    <div class="col-md-7 col-sm-12 required">
                        <select class="select2" style="width: 100%" name="id_periode" id="id_periode2">
                          <option value=""> Pilih Periode</option>
                          <?php 
                            foreach($get_periode as $row)
                            { 
                              echo '<option value="'.$row->id_periode.'">'.$row->semester.'</option>';
                            }
                          ?>
                        </select>

                        
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Dosen</label>
                    <div class="col-md-7 col-sm-12 required">
                        <select class="select2" style="width: 100%" name="id_dosen" id="id_dosen">
                          <option value=""> Pilih Dosen </option>
                          <?php 
                            foreach($get_dosen as $row)
                            { 
                              echo '<option value="'.$row->id_dosen.'">'.$row->nama_dosen.'</option>';
                            }
                          ?>
                        </select>

                        
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Mata kuliah</label>
                    <div class="col-md-7 col-sm-12 required">
                        <select class="select2" style="width: 100%" name="kode_matkul" id="kode_matkul">
                          <option value=""> Pilih Mata kuliah </option>
                          <?php 
                            foreach($get_matkul as $row)
                            { 
                              echo '<option value="'.$row->kode_matkul.'">'.$row->nama_matkul.'</option>';
                            }
                          ?>
                        </select>

                        
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Jumlah Pertanyaan</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="jml_pertanyaan" class="form-control" id="jml_pertanyaan">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Jumlah Pertanyaan</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="jml_mahasiswa" class="form-control" id="jml_mahasiswa">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 5</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_5" class="form-control" id="total_nilai_5">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 4</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_4" class="form-control" id="total_nilai_4">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 3</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_3" class="form-control" id="total_nilai_3">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 2</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_2" class="form-control" id="total_nilai_2">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="name" class="col-md-3 control-label">Total Nilai 1</label>
                    <div class="col-md-7 col-sm-12 required">
                        <input type="number" name="total_nilai_1" class="form-control" id="total_nilai_1">
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
        $('#id_kepuasan').val(p);
        $('#id_prodi').val($('#data_prodi'+p).val()).trigger("change");
        $('#id_periode2').val($('#data_periode'+p).val()).trigger("change");
        $('#id_dosen').val($('#data_periode'+p).val()).trigger("change");
        $('#kode_matkul').val($('#data_kode_matkul'+p).val()).trigger("change");
        $('#jml_pertanyaan').val($('#data_jml_pertanyaan'+p).val());
        $('#jml_mahasiswa').val($('#data_jml_mahasiswa'+p).val());
        $('#total_nilai_5').val($('#data_total_nilai_5'+p).val());
        $('#total_nilai_4').val($('#data_total_nilai_4'+p).val());
        $('#total_nilai_3').val($('#data_total_nilai_3'+p).val());
        $('#total_nilai_2').val($('#data_total_nilai_2'+p).val());
        $('#total_nilai_1').val($('#data_total_nilai_1'+p).val());
      }
      function get_semester(p) {
                $.ajax({
                    url: '<?php echo base_url(); ?>laporan/get_semester/'+p,
                    data: 'id_prodi='+p,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_periode").html(msg);

                    }
                });
            }
      function get_semester2(p) {
                $.ajax({
                    url: '<?php echo base_url(); ?>laporan/get_semester/'+p,
                    data: 'id_prodi='+p,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#id_periode2").html(msg);

                    }
                });
            }
    </script>



