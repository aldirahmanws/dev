      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">SETTING PERIODE PERKULIAHAN</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                <a href="<?php echo base_url(); ?>setting_periode/tambah_periode" class="btn btn-primary btn-sm btn-flat" ><i class="fa fa-plus"></i> Tambah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Semester</th>

                  <th>Program Studi</th>
                  <th>Target Mahasiswa Baru</th>
                  <th>Tanggal Awal Perkuliahan</th>
                  <th>Tanggal Akhir Perkuliahan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $alert = "'Anda yakin menghapus data ini ?'";
                $no = 0;
                foreach ($data_periode as $data) {

                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>

                  <td><a href="" data-toggle="modal" data-target="#modal_view'.$data->id_periode.'">'.$data->semester.'</a></td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->target_mhs_baru.'</td>
                  <td>'.date("d M Y", strtotime($data->tgl_awal_kul)).'</td>
                  <td>'.date("d M Y", strtotime($data->tgl_akhir_kul)).'</td>
                  <td>
                  <a href="" data-toggle="modal" data-target="#modal_edit'.$data->id_periode.'" class="btn btn-warning btn-xs btn-flat" ><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Edit</span></a>

                  <a href="'.base_url('setting_periode/hapus_periode/'.$data->id_periode).'" class="btn btn-danger btn-xs btn-flat" onclick="return confirm('.$alert.')"><i class="glyphicon glyphicon-trash"></i><span class="tooltiptext">Hapus</span></a>
                
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
      <!-- /.row -->
    </section>
<?php 
        foreach($data_periode as $i):
        ?>
        <div class="modal fade" id="modal_view<?php echo $i->id_periode;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">DETAIL PERIODE</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <table class="table" style="text-transform: uppercase;">
                          <tr>
                              <td class="left_column" width="40%">Semester </td>
                                <td colspan="9">:  <?php echo $i->semester ?>
                            </tr>
                          <tr>
                              <td class="left_column" width="20%">Program Studi</td>
                                <td>: 
                           <?php echo $i->nama_prodi ?></td>
                            </tr>
                            <tr>
                              <td class="left_column">Target Mahasiswa Baru</td>
                                <td>: <?php echo $i->target_mhs_baru ?></td>
                            </tr> 
                            <tr>
                              <td class="left_column">Pendaftar Ikut Seleksi</td>
                                <td>: <?php echo $i->pendaftar_ikut_seleksi ?></td>
                            </tr> 
                            <tr>
                              <td class="left_column">Pendaftar Lulus Seleksi</td>
                                <td>: <?php echo $i->pendaftar_lulus_seleksi ?></td>
                            </tr> 
                            <tr>
                              <td class="left_column">Daftar Ulang</td>
                                <td>: <?php echo $i->daftar_ulang ?></td>
                            </tr>
                            <tr>
                              <td class="left_column">Mengundurkan Diri</td>
                                <td>: <?php echo $i->mengundurkan_diri ?></td>
                            </tr> 
                            <tr>
                             <td class="left_column">Tanggal Perkuliahan</td>
                                <td>:
                            <?php echo $i->tgl_awal_kul;?>              <strong>s/d</strong>
                            <?php echo $i->tgl_akhir_kul;?>            </td>
                            </tr>
                            <tr>
                              <td class="left_column">Jumlah Minggu Pertemuan </td>
                                <td>: <?php echo $i->jumlah_minggu_pertemuan ?></td>
                            </tr> 
                        </table>

                    </div>

                </div>
            </div>
            </div>
        </div>

    <?php endforeach;?>

    <?php 
        foreach($data_periode as $i):
        ?>
        <div class="modal fade" id="modal_edit<?php echo $i->id_periode;?>" >
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">EDIT PERIODE</h3>
            </div>
                <div class="modal-body">

                    <div class="form-group">
                      <?php echo form_open('setting_periode/edit_periode'); ?>
                      <table class="table" style="text-transform: uppercase;">
      <tr>
          <td>Semester <font color="#FF0000">*</font></td>
            <td colspan="9">:  <input type="text" name="semester" id="id_smt" value="<?php echo $i->semester ?>"  readonly="" />
        </tr>
      <tr>
          <td class="left_column" width="40%">Program Studi <font color="#FF0000">*</font></td>
            <td>: 
       <select id="id_prodi" required="" name="id_prodi">
                    <option value="<?php echo $i->id_prodi ?>"><?php echo $i->nama_prodi; ?></option>   
                    <?php 

                  foreach($getProdi as $row)
                  { 
                    echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                  }
                  ?>
                  </select> 
             </td>
        </tr>
        <tr>
          <td class="left_column">Target Mahasiswa Baru</td>
            <td>: <input type="number" name="target_mhs_baru" id="target_mhs_baru" class="text-input" style="width:50px" value="<?php echo $i->target_mhs_baru; ?>"></td>
        </tr> 
        <tr>
          <td class="left_column">Pendaftar Ikut Seleksi</td>
            <td>: <input type="number" name="pendaftar_ikut_seleksi" id="pendaftar_ikut_seleksi" class="text-input" style="width:50px" value="<?php echo $i->pendaftar_ikut_seleksi; ?>"></td>
        </tr> 
        <tr>
          <td class="left_column">Pendaftar Lulus Seleksi</td>
            <td>: <input value="<?php echo $i->pendaftar_lulus_seleksi; ?>" type="number" name="pendaftar_lulus_seleksi" id="target_mhs_baru" class="text-input" style="width:50px"></td>
        </tr> 
        <tr>
          <td class="left_column">Daftar Ulang</td>
            <td>: <input value="<?php echo $i->daftar_ulang; ?>" type="number" name="daftar_ulang" id="target_mhs_baru" class="text-input" style="width:50px"></td>
        </tr>
        <tr>
          <td class="left_column">Mengundurkan Diri</td>
            <td>: <input value="<?php echo $i->mengundurkan_diri; ?>" type="number" name="mengundurkan_diri" id="target_mhs_baru" class="text-input" style="width:50px"></td>
        </tr> 
        <tr>
         <td class="left_column">Tanggal Perkuliahan  <font color="#FF0000">*</font></td>
            <td>:
        <input type="date" value="<?php echo $i->tgl_awal_kul; ?>" name="tgl_awal_kul" id="tgl_awal_kul"  maxlength="50" size="50" style="width:45%">               <strong>s/d</strong>
        <input type="date" value="<?php echo $i->tgl_akhir_kul; ?>" name="tgl_akhir_kul" id="tgl_akhir_kul"  text-input" maxlength="50" size="50" style="width:45%">            </td>
        </tr>
        <tr>
          <td class="left_column">Jumlah Minggu Pertemuan </td>
            <td>: <input value="<?php echo $i->jumlah_minggu_pertemuan; ?>" type="number" name="jumlah_minggu_pertemuan" id="target_mhs_baru" class="text-input" style="width:50px"></td>
            <input type="hidden" name="id_periode" value="<?php echo $i->id_periode; ?>">
        </tr> 
        <tr>
          <td colspan="4"><button type="submit" class="btn btn-info btn-flat">Edit</button></td>
        </tr>
    </table>

                    </div>

                </div>
            </div>
            </div>
        </div>
        <?php echo form_close();?>

    <?php endforeach;?>

