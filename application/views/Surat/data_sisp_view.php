      <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA SURAT PENGANTAR RISET (PERMOHONAN)</h3>
            </div>
            <div class="box-body">
              
            
              <div class="table-responsive">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                

               <br> <br>
                 <thead>
                <tr>
                  <th>No</th>
                  <th>Tgl. Permohonan</th>
                  <th>No. Permohonan</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Prodi</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($surat as $data) {
$sudah_bayar = $this->db->query("SELECT count(*) AS total FROM tb_detail_pembayaran JOIN tb_biaya ON tb_biaya.id_biaya = tb_detail_pembayaran.id_biaya WHERE tb_biaya.nama_biaya LIKE 'Surat Pengantar Riset' AND tb_detail_pembayaran.id_mahasiswa = '$data->id_mahasiswa'")->row();

                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.date("d M Y", strtotime($data->tgl_permohonan)).'</td>

                  <td><a href="'.base_url('surat/detail_sisp/'.$data->no_permohonan).'")>'.$data->no_permohonan.'</a></td>';?>
<?= '             <td>'.$data->nim.'</td>
                  <td>'.$data->nama_mahasiswa.'</td>
                  <td>'.$data->nama_prodi.'</td>';?>
                  <td><?php if ($sudah_bayar->total >= 1) { 
                    $hihi = $data->status_sisp; 
                  } else {
                    $hihi = 'Payment Process';
                  } echo $hihi ?></td>
                   <?='
                 </tr>
                  
                ' ;
                
              }
              ?>
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

  
        
