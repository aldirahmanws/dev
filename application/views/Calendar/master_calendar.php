      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">KALENDER AKADEMIK</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-striped table-condensed table-hover" style="text-transform: uppercase;">
                <a href="" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Mulai</th>
                  <th>Berakhir</th>
                  <th>Warna</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                $alert = "'Apakah anda yakin mengapus data ini ?'";
                foreach ($calendar as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->title.'</td>
                  <td>'.$data->start.'</td>
                  <td>'.$data->end.'</td>
                  <td><span style="background-color:'.$data->backgroundColor.';" class="badge">'.$data->backgroundColor.'</span></td>
                  <td>
                  <a href="" data-toggle="modal" data-target="#modal_edit'.$data->id.'" class="btn btn-warning btn-xs btn-flat" ><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>
                  <a href="'.base_url('calendar/hapus_calendar/'.$data->id).'" class="btn btn-danger btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>
                  </td>
                  

       
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
      </div>

      <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
            - Master kalender digunakan untuk menambahkan agenda-agenda perkuliahan pada kelender akademik.
            <br />
            - User diwajibkan untuk mengisi judul agenda, tanggal, dan waktu agenda.
             <br />
            - User dapat memilih warna pada setiap agenda dengan tujuan sebagai tanda (mark) atau pembeda tiap agenda.
         </div>

      <!-- /.row -->
    </section>


        <div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Kalender</h3>
            </div>
                <div class="modal-body">
              <?php echo form_open('calendar/tambah_calendar'); ?>
              <div class="form-group">
                <label>Judul:</label>
                <input type="text" class="form-control" name="title">
              </div>
              <div class="form-group">
                <label>Mulai:</label>
                <input type="datetime-local" class="form-control" name="start">
              </div>
              <div class="form-group">
                <label>Berakhir:</label>
                <input type="datetime-local" class="form-control" name="end">
              </div>
              <!-- /.form group -->

              <!-- Color Picker -->
              <div class="form-group">
                <label>Warna Bagan</label>

                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" value="#3da1cc" name="backgroundColor">

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Deskripsi:</label>
                <textarea name="description" class="form-control"></textarea>
              </div>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary pull-right">Save</button>

                </div>
                <?php echo form_close();?>
            </div>
            </div>
        </div>

    <?php 
        foreach($calendar as $i):
          $i->start = date('Y-m-d\TH:i:s', strtotime($i->start));
          $i->end = date('Y-m-d\TH:i:s', strtotime($i->end));
        ?>
        <div class="modal fade" id="modal_edit<?php echo $i->id;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Kalender</h3>
            </div>
                <div class="modal-body">
                  <?php echo form_open('calendar/edit_calendar'); ?>

                    <div class="form-group">
                <label>Judul:</label>
                <input type="hidden" class="form-control" name="id" value="<?php echo $i->id;?>">
                <input type="text" class="form-control" name="title" value="<?php echo $i->title;?>">
              </div>
              <div class="form-group">
                <label>Mulai:</label>
                <input type="datetime-local" class="form-control" name="start" value="<?php echo $i->start;?>">
              </div>
              <div class="form-group">
                <label>Berakhir:</label>
                <input type="datetime-local" class="form-control" name="end" value="<?php echo $i->end;?>">
              </div>
              <!-- /.form group -->

              <!-- Color Picker -->
              <div class="form-group">
                <label>Warna Bagan:</label>

                <div class="input-group my-colorpicker2">
                  <input type="text" class="form-control" name="backgroundColor"  value="<?php echo $i->backgroundColor;?>">

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Deskripsi:</label>
                <textarea name="description" class="form-control"><?php echo $i->description; ?></textarea>
              </div>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary pull-right">Edit</button>
                </div>
            </div>
            </div>
        </div>
        <?php echo form_close();?>

    <?php endforeach;?>

