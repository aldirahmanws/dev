                <?php 
                if($this->session->userdata('level') == 5){ ?>
       <!--  <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_pendidikan">History Pendidikan</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa">KRS Mahasiswa</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/history_nilai">History Nilai</a>
        <a class="btn btn-sm btn-primary" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-info" href="<?php echo base_url();?>mahasiswa/prestasi">Prestasi</a> -->
        
           <?php } else { ?>
        <?php if ($mahasiswa->tanggal_keluar == '0000-00-00' OR $mahasiswa->tanggal_keluar == NULL) { ?>
                          <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_mahasiswa"><i class="fa fa-angle-left"></i> Back</a>
                       <?php } else { ?>
                        <a class="btn btn-sm btn-default btn-flat" href="<?php echo base_url(); ?>mahasiswa/data_ld"><i class="fa fa-angle-left"></i> Back</a>
                       <?php } ?> 
       <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/lihat_mahasiswa_dikti/<?php echo $this->uri->segment(3); ?>">Detail Mahasiswa</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_pendidikan/<?php echo $this->uri->segment(3); ?>/<?php echo $mahasiswa->nik; ?>">History Pendidikan</a>
       <?php if ($mahasiswa->id_jenis_pendaftaran == '2') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/transfer_nilai/<?php echo $this->uri->segment(3); ?>">Nilai Transfer</a>
        <?php } ?>
        <?php if ($mahasiswa->tanggal_keluar == '0000-00-00' OR $mahasiswa->tanggal_keluar == NULL) { ?>

        <?php if ($mahasiswa->asal_pt == 1 OR $mahasiswa->asal_pt == '' OR $mahasiswa->asal_pt == ' ') { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/krs_mahasiswa/<?php echo $this->uri->segment(3) ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>/<?php echo $mahasiswa->id_konsentrasi; ?>">KRS Mahasiswa</a>
        <?php } else { ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/kelas_mhs/<?php echo $this->uri->segment(3) ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">KRS Mahasiswa</a>
        <?php } ?> 
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/jadwal_mhs/<?php echo $this->uri->segment(3) ?>/<?php echo $mahasiswa->id_prodi; ?>/<?php echo $mahasiswa->semester_aktif; ?>">Jadwal Kuliah</a>
        <?php } ?>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/history_nilai/<?php echo $this->uri->segment(3); ?>">History Nilai</a>
        <a class="btn btn-sm btn-warning btn-flat" href="<?php echo base_url();?>mahasiswa/aktivitas_perkuliahan/<?php echo $this->uri->segment(3); ?>">Aktivitas Perkuliahan</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/prestasi/<?php echo $this->uri->segment(3); ?>">Prestasi</a>
        <a class="btn btn-sm btn-primary btn-flat" href="<?php echo base_url();?>mahasiswa/checklist_pembayaran/<?php echo $this->uri->segment(3); ?>/<?php echo $mahasiswa->id_prodi; ?>">Pembayaran</a>
       
         <br/><br/>  
           <?php }

           ?>
        
        <div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
    <table class="table" style="text-transform: uppercase;">
        <tr>


            <td width="15%" class="left_column">NIM</td>
            <td>: <?php echo $mahasiswa->nim; ?>   </td>
            <td class="left_column" width="15%">Nama</td>
            <td>:
               <?php echo $mahasiswa->nama_mahasiswa; ?>                        </td>
    
            </td>
        </tr>
        <tr>
            <td class="left_column" width="15%" value=>Program Studi</td>
            <td width="35%">: <?php echo $mahasiswa->nama_prodi; ?>        </td>
            <td class="left_column" width="15%">Angkatan</td>
            <td>:
               <?php echo substr($mahasiswa->tgl_du,0,4); ?>                        </td>
        </tr>
        
        </table>
            </div>
            <!-- /.box-body -->
          </div>
         

<div class="box box-info">
  <div class="box-body">
  <table class="table table-bordered table-striped" id="example3" style="text-transform: uppercase;">
  <thead>
  <tr>
    <th style="width:5%" style="text-align:center" rowspan="2">No.</th>
    <th style="text-align:center" rowspan="2">Semester</th>
    <th width="10%" style="text-align:center" rowspan="2">Status</th>
    <th width="15%" style="text-align:center" rowspan="2">IPS</th>
    <th width="15%" style="text-align:center" rowspan="2">IPK</th>
    <th style="text-align:center" colspan="2">Jumlah SKS</th>
  </tr>
  <tr>
    <th width="5%" style="text-align:center">Semester</th>
    <th width="5%" style="text-align:center">Total</th>
  </tr>
  </thead>
  <tbody>
    <?php 
        $no = 0;
        foreach($aktivitas as $data):
        ;
      ?>
      <tr>
      <td><?php echo ++$no;?></td>
        <td style="text-align:center"><?php echo $data->semester;?></td>
        <td style="text-align:center"><?php echo $data->status_mhs;?></td>
        <td style="text-align:center"><?php echo $data->ips;?></td>
        <td style="text-align:center"><?php echo $data->ipk_ak;?></td>
        <td style="text-align:center"><?php echo $data->sks_semester;?></td>
        <td style="text-align:center"><?php echo $data->sks_total;?></td >
    </tr>
<?php endforeach; ?>
  
  </tbody>
</table>
</div>

          </div>
      
        <div class="callout callout-info">
        <strong>Keterangan :</strong>
            <br />
           - Fitur ini di gunakan untuk menampilkan status keaktifan, IPK, IPS, Jumlah sks Mahasiswa setiap periodenya
      <br />
      - Untuk mengisikan status keaktifan per semester , silahkan ke menu [ Aktivitas Kuliah Mahasiswa]
         </div>

