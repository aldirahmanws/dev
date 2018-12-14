      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA SURAT PENGANTAR RISET</h3>
            </div>
            <div class="box-body">
                               
              <a class="btn btn-primary btn-sm btn-flat" href="" data-toggle="modal" data-target="#modal_view"><i class="fa fa-plus"></i> Tambah </a>

              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                

               <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>No. Permohonan</th>
                  <th>Judul</th>
                  <th>PT</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($surat as $data) { ?>

                  
                <tr>
                  <td><?php echo ++$no; ?></td>

                  <td><a href="<?php echo base_url(); ?>surat/detail_sisp/<?php echo $data->no_permohonan; ?>")><?php echo $data->no_permohonan; ?></a></td>
                  <td><?php echo $data->judul_skripsi; ?></td>
                  <td><?php echo $data->nama_pt; ?></td>
                  <td><?php echo $data->status_sisp; ?></td>
                  <td> <?php if ($data->id_status_sisp == 1) { ?>

                    <a class="btn btn-success btn-xs btn-flat" title="Edit" href="" data-toggle="modal" data-target="#modal_edit<?php echo $data->no_permohonan; ?>"><i class="fa fa-pencil"></i><span class="tooltiptext">Edit</span></a>
                  <?php } else  { ?>
                   
                  <?php } ?>  
                  </td>
                
              <?php }
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
      <!-- /.row -->
    </section>

     <div class="modal fade" id="modal_view" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Surat Pengantar Riset</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('surat/simpan_sisp/'.$mahasiswa->id_mahasiswa.'/'.$mahasiswa->semester_aktif); ?>
                      <table class="table" style="text-transform: uppercase;">
                       <tr>
          <td class="left_column">Judul Skripsi <font color="#FF0000">*</font></td>
            <td> <input type="text" name="judul_skripsi" id="judul_skripsi" class="form-control input-sm pull-left" style="width:400px" required="">
          </td>
        </tr>
        <tr>
          <td class="left_column">Nama PT <font color="#FF0000">*</font></td>
            <td> <input type="text" name="nama_pt" id="nama_pt" class="form-control input-sm pull-left" style="width:400px" required="">
              <input type="hidden" name="verificator" id="verificator" class="form-control input-sm pull-left" style="width:400px" value="<?php echo $mahasiswa->id_dosen; ?>">
          </td>
        </tr>
        <tr>
          <td class="left_column">Alamat PT <font color="#FF0000">*</font></td>
            <td> <textarea class="form-control input-sm pull-left" style="width: 80%" name="alamat_pt" id="alamat_pt" required=""></textarea>
          </td>
        </tr>
        <tr>
                    <td colspan="4"><button type="submit" class="btn btn-primary btn-flat" id="MyBtn"><i class="fa fa-save"></i> Save</button></td>
                  </tr>

                        </table>
                        <?php echo form_close();?>

                    </div>

                </div>
            </div>
            </div>
        </div>
<?php 
        foreach($surat as $i):
        ?>
        <div class="modal fade" id="modal_edit<?php echo $i->no_permohonan; ?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Surat Pengantar Riset</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('surat/edit_sisp'); ?>
                      <table class="table" style="text-transform: uppercase;">
                       <tr>
          <td class="left_column">Judul Skripsi <font color="#FF0000">*</font></td>
            <td> <input type="text" name="judul_skripsi" id="judul_skripsi" class="form-control input-sm pull-left" style="width:400px" required="" value="<?php echo $i->judul_skripsi; ?>">
          </td>
        </tr>
        <tr>
          <td class="left_column">Nama PT <font color="#FF0000">*</font></td>
            <td> <input type="text" name="nama_pt" id="nama_pt" class="form-control input-sm pull-left" style="width:400px" required="" value="<?php echo $i->nama_pt; ?>">
              <input type="hidden" name="no_permohonan" id="no_permohonan" class="form-control input-sm pull-left" style="width:400px" value="<?php echo $i->no_permohonan; ?>">
          </td>
        </tr>
        <tr>
          <td class="left_column">Alamat PT <font color="#FF0000">*</font></td>
            <td> <textarea class="form-control input-sm pull-left" style="width: 80%" name="alamat_pt" id="alamat_pt" required=""><?php echo $i->alamat_pt; ?></textarea>
          </td>
        </tr>
        <tr>
                    <td colspan="4"><button type="submit" class="btn btn-success btn-flat" id="MyBtn"><i class="fa fa-save"></i> Edit</button></td>
                  </tr>

                        </table>
                        <?php echo form_close();?>

                    </div>

                </div>
            </div>
            </div>
        </div>
<?php endforeach;?>
        
