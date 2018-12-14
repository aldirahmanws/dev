<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
    $this->load->model('daftar_ulang_model');
    ini_set('display_errors', 0);
    if ($this->session->userdata('level') == 4 OR $this->session->userdata('level') == 5 OR $this->session->userdata('level') == 2) {
      redirect('login');
    }
	}

  public function data_pra_pendaftar()
  {
    if ($this->session->userdata('logged_in') == TRUE) {
    $data['pra_pendaftar'] = $this->pendaftaran_model->data_pra_pendaftar();
    $data['main_view'] = 'Daftar/data_prapendaftar_view';  
    $this->load->view('template', $data);
    } else {
      redirect('login');
    }
  }

	public function index()
	{
    if ($this->session->userdata('logged_in') == TRUE) {
		$data['kodeunik'] = $this->pendaftaran_model->buat_kode();
    $data['kodeunik2'] = $this->daftar_ulang_model->buat_kode();
		$data['getPreschool'] = $this->pendaftaran_model->getPreschool();
		$data['main_view'] = 'Daftar/pendaftaran_view';  
		$this->load->view('template', $data);
     } else {
      redirect('login');
    }
	}

	public function save_pendaftaran_pagi()
	{
    if ($this->session->userdata('logged_in') == TRUE) {
			if($this->pendaftaran_model->save_pendaftaran_pagi() == TRUE){
				$pendaftar = $this->input->post('nama_pendaftar');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data '.$pendaftaran.' berhasil ditambahkan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('pendaftaran/data_pra_pendaftar');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('pendaftaran');
			} 
       } else {
      redirect('login');
    }
	} 
	public function get_kelas($param = NULL) {
    $kelas = $param;
    $data_prodi = '';
		$data_sekolah = '';
    $form = '';
    $form_open_pagi = '';
    $form_open_sore = '';
    $form_close = '';
		$kodeunik = $this->pendaftaran_model->buat_kode();
    $kodeunik2 = $this->daftar_ulang_model->buat_kode();
    $kodeunik3 = $this->pendaftaran_model->buat_kode3();
		$getPreschool = $this->pendaftaran_model->getPreschool();
    $getProdi = $this->daftar_ulang_model->getProdi();
    $form_open_pagi .= form_open('pendaftaran/save_pendaftaran_pagi');
    $form_open_sore .= form_open('daftar_ulang/save_pendaftaran_sore');
    $form_close .= form_close();
		foreach($getPreschool as $row){ 
      $data_sekolah .= '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
    }
    foreach ($getProdi as $row) {
      $data_prodi .= '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
    }
   
		if($kelas == "k_pagi"){
			$option=' '.$form_open_pagi.'
                <div class="col-md-6"><br>
                <div class="form-group">
                  <label for="no">No. Pendaftaran</label>
                  <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" placeholder="" required .input-sm value=" '.$kodeunik.'" readonly>
                </div>
              	<div class="form-group">
              		<label for="email">Nama Pendaftar</label>
              		<input type="text" name="nama_pendaftar" class="form-control" id="nama_pendaftar" placeholder="Masukan Nama Pendaftar" required .input-sm>
              	</div>
              	<div class="form-group">
              		<label for="preschool">Asal Sekolah</label>
              		<select id="id_sekolah" name="id_sekolah"class="form-control" required>
                  <option value="">Pilih sekolah</option>
                  '.$data_sekolah.'
                </select>   
              	</div>
                 <div class="form-group">
                  <label for="major">Jurusan di Sekolah Sebelumnya</label>
                <select id="jurusan" name="jurusan" class="form-control" required="">
                  <option value="">Pilih Jurusan</option>
                  <option value="IPA">IPA</option>
                  <option value="IPS">IPS</option>
                  <option value="TKJ">TKJ</option>
                  <option value="RPL">RPL</option>

                </select>                                     
                </div>
                </div>
                <div class="col-md-6"><br>
              	<div class="form-group">
              		<label for="place">Alamat</label>
              		<input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukan Alamat" required>
              	</div>

                <div class="form-group">
                  <label for="place">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" required>
                </div>

                <div class="form-group">
                  <label for="place">Kode Tes</label>
                  <input type="email" name="id_hasil_tes2" class="form-control" id="id_hasil_tes2" placeholder="Masukan Email" value="'.$kodeunik3.'" readonly>
                </div>

                 <div class="form-group">
                  <label for="place">No Telepon</label>
                  <input type="number" name="no_telp" class="form-control" id="no_telp" placeholder="Masukan Nomor Telepon" required>
                </div>
                <button type="submit" class="btn btn-info pull-right">Daftar</button>
              </div>
              '.$form_close.'
    			';
		} elseif ($kelas == "k_sore") {
			$option= ''.$form_open_sore.'
      <div class="col-md-6">
      <div class="form-group">
                  <label for="no">No. Daftar Ulang</label>
                  <input type="text" name="no_du" class="form-control" id="no_du" placeholder="" required .input-sm value="'.$kodeunik2.'" readonly>
                </div>
                <div class="form-group">
                  <label for="email">Nama Lengkap</label>
                  <input type="text" name="nama_du" class="form-control" id="nama_du" placeholder="Input Full Name" required>
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select id="gender" name="gender" class="form-control" required="">
            <option value="">Select Gender</option>
            <option value="laki-laki">Laki - laki</option>
            <option value="perempuan">Perempuan</option>

          </select>                                     
                  
                </div>
                <div class="form-group">
                  <label for="email">Tanggal Lahir</label>
                  <input type="date" name="tgl_lahir_du" class="form-control" id="tgl_lahir_du" required>
                </div>
                <div class="form-group">
                  <label for="place">Tempat Lahir</label>
                  <input type="text" name="tpt_lahir_du" class="form-control" id="tpt_lahir_du" placeholder="Input Birth Place" required>
                </div>
                <div class="form-group">
                  <label for="religion">Agama</label>
                <select id="agama_du" name="agama_du" class="form-control" required="">
                  <option value="">Pilih Agama</option>
                  <option value="kristen">Kristen</option>
                  <option value="islam">Islam</option>
                  <option value="hindu">Hindu</option>
                  <option value="buddha">Buddha</option>
                  <option value="konghuchu">Konghuchu</option>

                </select>                                     
                </div>
                <div class="form-group">
                  <label for="address">Alamat Rumah</label>
                  <input type="text" name="alamat_du" class="form-control" id="alamat_du" placeholder="Input Home Address" required>
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="number" name="no_telp_du" class="form-control" id="no_telp_du" placeholder="Input Phone Number" required>
                </div>
                <div class="form-group">
                  <label for="phone">Nomor HP</label>
                  <input type="number" name="no_telpm_du" class="form-control" id="no_telpm_du" placeholder="Input Mobile Phone Number" required>
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email_du" class="form-control" id="email_du" placeholder="Input Email" required>
                </div>
                <div class="form-group">
                  <label for="preschool">Asal Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah"class="form-control" required="">
                  <option value="">Select Intake</option>
                  '.$data_sekolah.'

                </select>   
                </div>
                <div class="form-group">
                  <label for="major">Jurusan Asal Sekolah</label>
                <select id="jurusan" name="jurusan" class="form-control" required="">
                  <option value="">Pilih Jurusan</option>
                  <option value="ipa">IPA</option>
                  <option value="ips">IPS</option>
                  <option value="tkj">TKJ</option>
                  <option value="rpl">RPL</option>
                </select>                                     
                </div>
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="number" name="nik_du" class="form-control" id="nik_du" placeholder="Input NIK" required>
                </div>
                <div class="form-group">
                  <label for="mother">Nama Ibu</label>
                  <input type="text" name="ibu_kandung_du" class="form-control" id="ibu_kandung_du" placeholder="Input your mother Name" required>
                </div>
                <div class="form-group">
                  <label for="prodi">Program Studi</label>
                  <select id="id_prodi" class="form-control" name="id_prodi" required="" onchange="return get_concentrate(this.value)">
                    <option value="">Pilih Program Studi</option>   
                    '.$data_prodi.'
                  </select>                                     
                </div>
                <div class="form-group">
                  <label for="concentrate">Konsentrasi</label>
                  <select id="concentrate" name="concentrate" class="form-control" required="">
                  <option value="">Select Program Study First</option>
                  </select>                                     
                </div>
                <div class="form-group">
                  <label for="intake">Intake</label>
                  <select id="intake" name="intake" class="form-control" required="">
                    <option value="">Pilih Intake</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                  </select>                                                                          
                </div>              
                <button type="submit" class="btn btn-info pull-right">Daftar</button>
                '.$form_close.'
                ';
		} else {
		} 
		echo $option;
	}

  public function print_pendaftaran(){
      if ($this->session->userdata('logged_in') == TRUE) {
        $id_pendaftaran = $this->uri->segment(3);
        $data['edit'] = $this->pendaftaran_model->get_pra_pendaftar($id_pendaftaran);
        $data['main_view'] = 'tes_backup';
        $this->load->view('template', $data);
        } else {
      redirect('login');
    }
  }

}

/* End of file pendaftaran.php */
/* Location: ./application/controllers/pendaftaran.php */