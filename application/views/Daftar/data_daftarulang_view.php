<?php echo $this->session->flashdata('message');?>
<section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <div class="box">
            <div class="box-header with-border">
              
              <h3 class="box-title">Data Peserta Tes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-hover table-striped table-condensed" style="text-transform: uppercase;">
             
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>No. Tes</th>
                  <th>Nama Prodi</th>
                  <th>Nama Konsentrasi</th>
                  <th>Waktu</th>
                  <th>Tgl. Registrasi</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
               
                foreach ($du as $data) {
                  if ($data->asal_pt == NULL OR $data->asal_pt == '' OR $data->asal_pt == ' ') {
                    if ($data->id_status == 12) {
                       echo '
                  
                <tr>
                  <td>'.$data->nim.'</td>
                  <td>'.$data->nama_mahasiswa.'
                  </td>
                  <td>'.$data->id_hasil_tes.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.date("d M Y", strtotime($data->tgl_du)).'</td>
                  <td>'.$data->status_mhs.'</td>
                  <td>
                    
                     <a href="'.base_url('daftar_ulang/print_ljk/'.$data->id_mahasiswa).'" target="_blank" class="btn btn-warning btn-xs btn-flat" title="Print Lembar Jawaban"><i class="glyphicon glyphicon-print" ></i><span class="tooltiptext">Print LJK</span></a>
                     <a href="'.base_url('hasil_tes/page_input_nilai/'.$data->id_mahasiswa).'" class="btn btn-success  btn-xs btn-flat" title="Input Nilai Tes"><i class="glyphicon glyphicon-pencil"></i><span class="tooltiptext">Input Nilai Tes</span></a>
                  </td>
                </tr>
                ';
                  } else {
                    if ($data->id_status == 19) {
                     $tampil = 'Aktif';
                    } else {
                      $tampil = $data->status_mhs;
                    }
                      echo '
                    
                  
                <tr>
                  <td>'.$data->nim.'</td>
                  <td>'.$data->nama_mahasiswa.'
                  </td>
                  <td>'.$data->id_hasil_tes.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->tgl_du.'</td>
                  <td>'.$tampil.'</td>
                  <td>
                    <a href="'.base_url('daftar_ulang/detail_nilai/'.$data->id_mahasiswa).'" class="btn btn-warning btn-xs btn-flat" title="Detail"><i class="glyphicon glyphicon-list-alt"></i><span class="tooltiptext">Detail</span></a>
                     <a href="'.base_url('hasil_tes/print_hasil_tes/'.$data->id_mahasiswa.'/'.$data->id_hasil_tes).'" target="_blank" class="btn btn-info btn-xs btn-flat" title="Print Hasil Tes"><i class="fa fa-print"></i><span class="tooltiptext">Print Hasil Tes</span></a>
                  </td>
                </tr>
                ';
              }
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