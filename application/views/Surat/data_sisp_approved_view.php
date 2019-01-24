     <?php echo $this->session->flashdata('message');?>
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">DATA SURAT PENGANTAR RISET (DISETUJUI)</h3>
            </div>
            <div class="box-body">
              
              <div class="table-responsive">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                
                <thead>
                <tr>
                  <th>No</th>
                  <th>No. Permohonan</th>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Prodi</th>
                  <th>Angkatan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($surat as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>

                  <td><a href="'.base_url('surat/detail_sisp/'.$data->no_permohonan).'")>'.$data->no_permohonan.'</a></td>
                  <td>'.$data->nim.'</td>
                  <td>'.$data->nama_mahasiswa.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.substr($data->tgl_du,0,4).'</td>
                  <td>'.$data->status_sisp.'</td>
                  <td><a href="'.base_url('surat/print_sisp/'.$data->no_permohonan).'" target="_blank" class="btn btn-info btn-xs btn-flat" title="Print"><i class="fa fa-print"></i><span class="tooltiptext">Print</span></a>


                  </td>
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

        
