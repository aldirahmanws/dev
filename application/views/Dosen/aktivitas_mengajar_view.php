         <?php 
                if($this->session->userdata('level') == 5){ ?>
        <!-- <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi">Prestasi</a> -->
        
           <?php } else { ?>
      <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>master_dosen"><i class="fa fa-angle-left"></i> Back</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/detail_dosen/<?php echo $dosen->id_dosen; ?>">Profil</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/jadwal_dosen/<?php echo $dosen->id_dosen; ?>">Jadwal</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/nilai_dosen/<?php echo $dosen->id_dosen; ?>">Input Nilai</a>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>master_dosen/aktivitas_mengajar/<?php echo $dosen->id_dosen; ?>">Aktivitas Mengajar</a>
         <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/jabatan_fungsional/<?php echo $dosen->id_dosen; ?>">Jabatan Fungsional</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/pendidikan/<?php echo $dosen->id_dosen; ?>">Pendidikan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/pelatihan/<?php echo $dosen->id_dosen; ?>">Pelatihan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/sertifikasi/<?php echo $dosen->id_dosen; ?>">Sertifikasi</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>master_dosen/penelitian/<?php echo $dosen->id_dosen; ?>">Penelitian</a>
        
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
          <div class="">
            
          <?php echo $this->session->flashdata('message');?>

<div class="box box-info">
  <div class="box-body">
    <div class="table-responsive">
  <table class="table table-bordered table-striped" id="example3" style="text-transform: uppercase;">
  <thead>
  <tr>
    <th style="width:5%" style="text-align:center" rowspan="2">No.</th>
    <th style="text-align:center" rowspan="2">Periode</th>
    <th style="text-align:center" rowspan="2">Prodi</th>
    <th style="text-align:center" rowspan="2">Mata Kuliah</th>
    <th style="text-align:center" rowspan="2">Kelas</th>
    <th style="text-align:center" colspan="2">Pertemuan</th>
  </tr>
  <tr>
    <th style="text-align:center">Rencana</th>
    <th style="text-align:center">Realisasi</th>
  </tr>
  </thead>
  <tbody>
    <?php 
        $no = 0;
        foreach($am as $data):
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->semester;?></td>
        <td style="text-align:center"><?php echo $data->nama_prodi;?></td>
        <td style="text-align:center"><?php echo $data->nama_matkul;?></td>
        <td style="text-align:center"><?php echo $data->nama_kelas;?></td>
        <td style="text-align:center"><?php echo $data->rencana;?></td>
        <td style="text-align:center"><?php echo $data->realisasi;?></td >
    </tr>
<?php endforeach; ?>
  
  </tbody>
</table>
</div>
</div>


          </div>

          
        
        



      
       
