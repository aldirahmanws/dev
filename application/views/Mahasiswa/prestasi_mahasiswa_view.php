        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $mahasiswa->id_mahasiswa; ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $mahasiswa->id_mahasiswa; ?>">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $mahasiswa->id_mahasiswa; ?>">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $mahasiswa->id_mahasiswa; ?>">History Nilai</a>
        <a class="btn btn-sm btn-primary">Aktivasi Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $mahasiswa->id_mahasiswa; ?>">Prestasi</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa">Kembali</a>
        <br><br>
        <div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">

              <table class="table">
        <tr>


            <td width="15%" class="left_column">Nama <font color="#FF0000">*</font></td>
            <td>: <?php echo $mahasiswa->nama_mahasiswa; ?>   </td>
      
           
                                  
            <input type="hidden" name="stat_pd" value="A">
            </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=>Tempat Lahir <font color="#FF0000">*</font></td>
            <td width="35%">: <?php echo $mahasiswa->tempat_lahir; ?>        </td>
            <td class="left_column" width="15%">Tanggal Lahir <font color="#FF0000">*</font></td>
            <td>:
               <?php echo $mahasiswa->tanggal_lahir; ?>                        </td>
        </tr>
        <tr>
            <td class="left_column">Jenis Kelamin</td>
            <td>: <?php echo $mahasiswa->jenis_kelamin; ?></td>
            <td class="left_column">Agama <font color="#FF0000">*</font></td>
            <td>:
            <?php echo $mahasiswa->agama; ?>
        </table>
            </div>
            <!-- /.box-body -->
          </div>
          <div class="">
            <a class="btn btn-primary pull-right"  data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus"></i> Tambah Pendidikan</a><br><br>
          </div>
          <?php echo $this->session->flashdata('message');?>

          <div class="box box-info">
            <table class="table table-bordered table-striped" id="example3">
  <thead>
  <tr>
    <th style="width:5%" style="text-align:center">No.</th>
    <th width="10%" style="text-align:center">Jenis</th>
    <th width="10%" style="text-align:center">Tingkat</th>
    <th width="15%" style="text-align:center">Nama Prestasi</th>
    <th width="15%" style="text-align:center">Tahun</th>
    <th style="text-align:center">Penyelenggara</th>
    <th style="text-align:center">Peringkat</th>
    <th style="text-align:center"></th>
  </tr>
  </thead>
  <tbody>
    <?php 
        $no = 0;
        foreach($prestasi as $data):
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->jenis_prestasi;?></td>
        <td style="text-align:center"><?php echo $data->tingkat_prestasi;?></td>
        <td style="text-align:center"><?php echo $data->nama_prestasi;?></td>
        <td style="text-align:center"><?php echo $data->tahun;?></td>
        <td style="text-align:center"><?php echo $data->penyelenggara;?></td>
        <td style="text-align:center"><?php echo $data->peringkat;?></td >
        <td style="text-align:center">
        <a href="<?php echo base_url(); ?>mahasiswa/detail_prestasi/<?php echo $data->id_prestasi; ?>" class="btn btn-success  btn-sm"><i class="fa fa-pencil"></i><span class="tooltiptext">Edit Prestasi</span></a>
                        </td>
    </tr>
<?php endforeach; ?>
  
  </tbody>
</table>


          </div>

          <div class="modal fade" id="modal_tambah" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Prestasi</h3>
            </div>
                 <div class="modal-body">

                    <div class="form-group">
                       <?php echo form_open('mahasiswa/simpan_prestasi/'.$mahasiswa->id_mahasiswa); ?>
                      <table class="table">
      <tr>
            <td class="left_column" width="30%">Jenis Prestasi <font color="#FF0000">*</font></td>
            <td colspan="9">:  
             <select name="jenis_prestasi" id="jenis_prestasi" required="">
                                <option value=""> -- Pilih Jenis Prestasi --</option>
                                <option value="Sains">Sains</option>
                                <option value="Olahraga">Olahraga</option>
                                 <option value="Seni">Seni</option>
                                 <option value="Lain-lain">Lain-lain</option>
                                 </select>     </td>
        </tr>
        <tr>
         <td class="left_column" width="40%">Tingkat Prestasi <font color="#FF0000">*</font></td>
            <td>: 
       <select name="tingkat_prestasi" id="tingkat_prestasi" required="">
                            <option value="">-- Pilih Tingkat Prestasi --</option>
                            <option value="Islam">Sekolah</option>
                            <option value="Kecamatan">Kecamatan</option>
                             <option value="Kab/Kota">Kab/Kota</option>
                             <option value="Provinsi">Provinsi</option>
                             <option value="Nasional">Nasional</option>
                             <option value="Internasional">Internasional</option>
                             <option value="Lainnya">Lainnya</option>
                             </select>
             </td>
        </tr> 
        <tr>
          <td class="left_column">Nama Prestasi<font color="#FF0000">*</font></td>
            <td>: <input type="text" name="nama_prestasi" id="nama_prestasi" placeholder="" required="" value="" ></td>
        </tr> 
        <tr>
          <td class="left_column">Tahun<font color="#FF0000">*</font></td>
            <td>: <input type="text" name="tahun" id="tahun" placeholder="" required="" value=""></td>
        </tr> 
        <tr>
          <td class="left_column">Penyelenggara<font color="#FF0000">*</font></td>
            <td>: <input type="text" name="penyelenggara"  id="penyelenggara" placeholder="" required="" value=""></td>
        </tr>
        <tr>
          <td class="left_column">Peringkat<font color="#FF0000">*</font></td>
            <td>: <input type="text" name="peringkat"  id="peringkat" placeholder="" required="" value=""></td>
        </tr> 
        <tr>
          <td colspan="4"><button type="submit" class="btn btn-info">Simpan</button></td>
        </tr>
    </table>
    <?php echo form_close();?>


                    </div>

                </div>
            </div>
            </div>
        </div>


        
        



      
       
