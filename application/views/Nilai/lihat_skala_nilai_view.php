<?php echo $this->session->flashdata('message');?>
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Detail Skala Nilai</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  
                  
                        <div class="row">
    <div class="form-container">
  <table class="table">
      <tr>
          <td class="left_column" width="20%">Program Studi <font color="#FF0000">*</font></td>
            <td>: 
       <?php echo $nilai->nama_prodi; ?></td>
        </tr>
        <tr>
          <td class="left_column">Nilai Huruf <font color="#FF0000">*</font></td>
            <td>: <?php echo $nilai->nilai_huruf; ?></td>
        </tr>
        <tr>
          <td class="left_column">Nilai Indeks <font color="#FF0000">*</font></td>
            <td>: <?php echo $nilai->nilai_indeks; ?></td>
        </tr> 
        <tr>
          <td class="left_column">Bobot Nilai Minimum <font color="#FF0000">*</font></td>
            <td>: <?php echo $nilai->bobot_nilai_minimum; ?></td>
        </tr>
        <tr>
          <td class="left_column">Bobot Nilai Maksimum <font color="#FF0000">*</font></td>
            <td>: <?php echo $nilai->bobot_nilai_minimum; ?></td>
        </tr>
        <tr>
         <td class="left_column">Tanggal Mulai Efektif <font color="#FF0000">*</font></td>
            <td>:
        <?php echo $nilai->tanggal_mulai_efektif; ?>            </td>
        </tr>
        <tr>
         <td class="left_column">Tanggal Akhir Efektif <font color="#FF0000">*</font></td>
            <td>:
        <?php echo $nilai->tanggal_akhir_efektif; ?>            </td>
        </tr>
        <tr>
          <td> <a class="btn btn-warning btn-flat" value="Ubah" href="<?php echo base_url(); ?>nilai/detail_skala_nilai/<?php echo $nilai->id_skala_nilai; ?>"><i class="fa fa-pencil"></i> Edit</a>
        </tr>
    </table>
    </div> 
</div>

                      
                 
                </div>
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>