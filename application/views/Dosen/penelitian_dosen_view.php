         <?php 
                if($this->session->userdata('level') == 2){ ?>
        
           <?php } else { ?>
       <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>master_dosen"><i class="fa fa-angle-left"></i> Back</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/detail_dosen/<?php echo $dosen->id_dosen; ?>">Profil</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/jadwal_dosen/<?php echo $dosen->id_dosen; ?>">Jadwal</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/nilai_dosen/<?php echo $dosen->id_dosen; ?>">Input Nilai</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/aktivitas_mengajar/<?php echo $dosen->id_dosen; ?>">Aktivitas Mengajar</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/jabatan_fungsional/<?php echo $dosen->id_dosen; ?>">Jabatan Fungsional</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/pendidikan/<?php echo $dosen->id_dosen; ?>">Pendidikan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/pelatihan/<?php echo $dosen->id_dosen; ?>">Pelatihan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/sertifikasi/<?php echo $dosen->id_dosen; ?>">Sertifikasi</a>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>master_dosen/penelitian/<?php echo $dosen->id_dosen; ?>">Penelitian</a>
        
         <br/><br/>  
           <?php }

           ?>
        <div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">

              <table class="table" style="text-transform: uppercase;">
        <tr>


            <td width="15%" class="left_column">Nama</td>
            <td>: <?php echo $dosen->nama_dosen; ?>   </td>
      
           
                                  
            <input type="hidden" name="stat_pd" value="A">
            </td>
            <td class="left_column" width="15%">Tanggal Lahir</td>
            <td>:
               <?php echo date("d M Y", strtotime($dosen->tgl_lahir)); ?>                        </td>
        </tr>
        <tr>
            <td class="left_column" width="15%">Tempat Lahir</td>
            <td width="35%">: <?php echo $dosen->tpt_lahir_dosen; ?>        </td>
            <td class="left_column">NIDN</td>
            <td>:
            <?php echo $dosen->nidn; ?></td>
        </tr>
        <tr>
            <td class="left_column" width="15%">Jenis Dosen</td>
            <td width="35%">: <?php echo $dosen->status_dosen; ?></td>
             <td class="left_column">Status</td>
            <td>:
            <?php echo $dosen->status_mhs; ?></td>
        </table>
            </div>
            <!-- /.box-body -->
          </div>
          <?php echo $this->session->flashdata('message');?>

           <a class="btn btn-primary btn-flat btn-sm pull-right"  data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Tambah Penelitian</a><br><br><br><br>
            
          

<div class="box box-info">
  <div class="box-body">
    <div class="table-responsive">
  <table class="table2 table-bordered table-striped" id="example3" style="text-transform: uppercase;">
  <thead>
  <tr>
    <th style="width:5%" style="text-align:center">No.</th>
    <th style="text-align:center">Judul Penelitian</th>
    <th style="text-align:center">Bidang Ilmu</th>
    <th style="text-align:center">Lembaga</th>
    <th style="text-align:center">Tahun</th>
    <th style="text-align:center">Sumber Dana</th>
    <th style="text-align:center">Total Dana</th>
    <th style="text-align:center; width: 2px">Aksi</th>
  </tr>
  </thead>
  <tbody>
    <?php 
        $alert = "'Apakah anda yakin menghapus data ini ?'";
        $no = 0;
        foreach($penelitian as $data):
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td><?php echo $data->judul_penelitian;?></td>
        <td><?php echo $data->bidang_ilmu;?></td>
        <td><?php echo $data->lembaga;?></td>
        <td><?php echo $data->tahun_penelitian;?></td>
        <td><?php echo $data->sumber_dana;?></td>
        <td style="text-align:right"><?php echo number_format($data->total_dana, 2, ",", "."); ?></td>
        <td style="text-align:center;">
        <a href="<?php echo base_url(); ?>master_dosen/hapus_penelitian/<?php echo $data->id_penelitian; ?>/<?php echo $dosen->id_dosen; ?>" class="btn btn-danger btn-xs btn-flat" onclick="return confirm(<?php echo $alert; ?>)"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>
      </td>
    </tr>
<?php endforeach; ?>
  
  </tbody>
</table>
</div>
</div>


          </div>

           <div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Penelitian</h3>
            </div>
            <?php echo form_open('master_dosen/tambah_penelitian/'.$dosen->id_dosen); ?>
            <div class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="col-xs-4" >Judul Penelitian <font color="#FF0000">*</font></label>
                        <div class="col-xs-6">
                            <input type="text" name="judul_penelitian" class="form-control input-sm pull-left" id="judul_penelitian" placeholder="" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Bidang Ilmu </label>
                        <div class="col-xs-6">
                            <input type="text" name="bidang_ilmu" class="form-control input-sm pull-left" id="bidang_ilmu" placeholder="" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Lembaga</label>
                        <div class="col-xs-6">
                            <input type="text" name="lembaga" class="form-control input-sm pull-left" id="lembaga" placeholder="" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Tahun Penelitian <font color="#FF0000">*</font></label>
                        <div class="col-xs-6">
                            <input type="text" name="tahun_penelitian" class="form-control input-sm pull-left" id="tahun_penelitian" placeholder="" value="" required="">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-xs-4" >Sumber Dana</label>
                        <div class="col-xs-6">
                            <input type="text" name="sumber_dana" class="form-control input-sm pull-left" id="sumber_dana" placeholder="" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-4" >Total Dana</label>
                        <div class="col-xs-6">
                            <input type="number" name="total_dana" class="form-control input-sm pull-left" id="total_dana" placeholder="" value="">
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                    <button class="btn btn-primary btn-flat" id="myBtn"><i class="fa fa-save"></i> Save</button>
                </div>

                </div>
            <?php echo form_close();?>

            </div></div>
            </div>
        </div>

          
        
        



      
       
