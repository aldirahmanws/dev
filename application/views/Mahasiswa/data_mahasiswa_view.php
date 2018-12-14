<?php echo $this->session->flashdata('message');?>
<section class="content">
      <div class="row">

        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">Data Penerimaan Mahasiswa</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Nama Prodi</th>
                  <th>Nama Konsentrasi</th>
                  <th>Waktu</th>
                  <th>Tgl. Registrasi</th>
                  <th style="width: 10%">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
               
                foreach ($mahasiswa as $data) {
                  if ($data->id_status == 19 OR $data->id_status == 1) {
                    
                  
                  echo '
                <tr>
                  <td>'.$data->nim.'</td>
                  <td>'.$data->nama_mahasiswa.'
                  </td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.date("d M Y", strtotime($data->tgl_du)).'</td>
                  <td>
                   <a href="'.base_url('mahasiswa/detail_mahasiswa/'.$data->id_mahasiswa).'" class="btn btn-primary btn-xs btn-flat" ><i class="fa fa-list"></i><span class="tooltiptext">Detail</span></a>
                  </td>
                </tr>
                ';
                }
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