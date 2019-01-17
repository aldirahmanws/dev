<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('finance_model');
		$this->load->model('biaya_sekolah_model');
		ini_set('display_errors', 0);
	}

		public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			redirect(base_url('dashboard'));
		} else {
			redirect(base_url('login'));
		}
		} else {
			redirect('login');
		}
		
	}
	public function data_registrasi(){
		
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$data['main_view'] = 'finance_view';
		 $data['data']=$this->finance_model->data_mahasiswa();
		$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
	}
	public function detail_pembayaran()
	{
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$ea = $this->uri->segment(3);
		$ya = $this->uri->segment(3);
		$dataku = $this->finance_model->get_data_detail_mahasiswa($ya);
		$data['mahasiswa']=$ea;
		$data['data']= $dataku;
		$data['data_pembayaran']= $this->finance_model->data_pembayaran_mahasiswa($ya);
		$data['data_pembayaran2']= $this->finance_model->data_pembayaran_mahasiswa($ya);
		$data['kodeunik'] = $this->finance_model->buat_kode();
		// $data['getJenisPembayaran'] = $this->biaya_sekolah_model->getJenisPembayaran($dataku->waktu);
		$data['getTA'] = $this->biaya_sekolah_model->getTA();
		$data['main_view'] = 'Finance/detail_pembayaran_view';
		$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
			
		
		
	}
	public function cek_mahasiswa(){
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$id_mahasiswa = $this->input->get('id_mahasiswa');
    		$this->finance_model->cek_mahasiswa($id_mahasiswa);
		} else {
			redirect(base_url('login'));
		}
    
  }
  public function add_to_cart()
	{
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$ea = $this->uri->segment(3);
			$product_id = $this->input->post('pembayaran');
			$product = $this->finance_model->find($product_id);
			if($this->input->post('potongan') == '' && $this->input->post('denda') == ''){
	            $potongan = 0;
	            $denda = 0;
	          } else {
	          	$potongan = $this->input->post('potongan');
	          	$denda = $this->input->post('denda');
	          }
			$data = array(
						   'id'      => $this->input->post('pembayaran'),
						   'qty'     => 1,
						   'price'   => $this->input->post('biaya'),
						   'harga'   => $this->input->post('biayaku'),
						   'name'    => $this->input->post('nama_mhsa'),
						   'idmhsa'    => $this->input->post('id_mhsa'),
						   'tgl'    => $this->input->post('tanggal_pembayaran'),
						   'pembayaran'    => $product->nama_biaya,
						   'jp'    => $this->input->post('jenis_pembayaran'),
						   'kdmatkul'    => $this->input->post('kode_matkul'),
						   'kode'    => $this->input->post('kode_pembayaran'),
						   'idgrade'    => $this->input->post('id_grade'),
						   'potongan'    => $potongan,
						   'denda'    => $denda,
						   'keterangan'    => $this->input->post('keterangan')
						);

			$this->cart->insert($data);
			redirect(base_url('finance/detail_pembayaran/'.$ea));
		} else {
			redirect(base_url('login'));
		}
		
	}
	public function simpan_pembayaran()
	{
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			if($this->finance_model->simpan_pembayaran() == TRUE){
				$this->cart->destroy();
				$ea = $this->uri->segment(3);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data pembayaran berhasil disimpan </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect(base_url('finance/detail_pembayaran/'.$ea));
			} 
		} else {
			redirect(base_url('login'));
		}
			
	}
	public function clear_cart()
	{
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$this->cart->destroy();
			$ea = $this->uri->segment(3);
			redirect(base_url('finance/detail_pembayaran/'.$ea));
		} else {
			redirect(base_url('login'));
		}
		
	}
	public function tambah_cart()
	{
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$data = array(
	            'id_mahasiswa'                        => $this->input->post('id_mhsa'),
	            'kode_pembayaran'                        => $this->input->post('kode_pembayaran'),
	            'total_biaya'                 => $this->input->post('biaya'),
	            'tanggal_pembayaran'          => $this->input->post('tanggal_pembayaran')
	            
	        );
			$this->cart->insert($data);
		} else {
			redirect(base_url('login'));
		}
		
	}
	function data_pembayaran_mahasiswa(){
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$id = $this->input->get('id_mahasiswa');
			$data=$this->finance_model->coba_mahasiswa($id);
			echo json_encode($data);
		} else {
			redirect(base_url('login'));
		}
		
	}
	function pembayaran(){
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$this->cart->destroy();
			$data['main_view'] = 'Finance/pembayaran_view';
			$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		
	}
	function data_gg(){
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$data=$this->finance_model->barang_gg();
			echo json_encode($data);
		} else {
			redirect(base_url('login'));
		}
		
	}
	public function oke()
	{
		$this->load->view('Finance/pembayaran_view');
	}
	function autocomplete(){
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$searchTerm = $_GET['term'];
			//mendapatkan data yang sesuai dari tabel daftar_kota
			$query = $this->db->query("SELECT * FROM tb_biaya WHERE nama_biaya LIKE '%".$searchTerm."%' ORDER BY nama_biaya ASC");
			foreach($query->result_array() as $row){
			    $data[] = $row['nama_biaya'];
			    $data[] = $row['id_biaya'];
			}
			//return data json
			echo json_encode($data);
		} else {
			redirect(base_url('login'));
		}
		
	}
	public function get_autocomplete(){
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			if(isset($_GET['term'])){
				$result = $this->finance_model->autocomplete($_GET['term']);
				if(count($result) > 0){
					foreach ($result as $row) 
						$result_array[] = array(
							'label' => $row->nim.' - '.$row->nama_mahasiswa,
							'id' => $row->id_mahasiswa);
					echo json_encode($result_array);
				
				}
			}
		} else {
			redirect(base_url('login'));
		}
		
	}


	public function data_lunas()
	{
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$data['main_view'] = 'Finance/data_lunas_view';
		$data['mahasiswa'] = $this->finance_model->data_lunas();
		$this->load->view('template', $data);
		} else {
			redirect(base_url('login'));
		}
		
	}

	public function konfirmasi(){
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$id_pendaftaran = $this->input->post('id_pendaftaran');
				if ($this->input->post('reg') == 'No Registrasi Tersedia'){
					if ($this->finance_model->save_konfirmasi($id_pendaftaran) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Konfirmasi pembayaran berhasil </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
						redirect('finance/data_registrasi');
					} else  {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Konfirmasi Gagal </div>');
						redirect('finance/data_registrasi');
					} 	
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger"> Konfirmasi Gagal </div>');
						redirect('finance/data_registrasi');}
		} else {
			redirect(base_url('login'));
		}
	}				
	public function konfirmasi_gagal($id_pendaftaran){				
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$id_pendaftaran = $this->uri->segment(3);
				if ($this->finance_model->gagal_konfirmasi($id_pendaftaran) == TRUE) {
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Konfirmasi pembayaran berhasil ditolak </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
						redirect('finance');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Konfirmasi Gagal </div>');
						redirect('finance');
					}
			} else {
			redirect(base_url('login'));
			}
		
		}
	public function cek_id_daftar_ulang(){
		if($this->session->userdata('level') == 4 || $this->session->userdata('level') == 1){
			$id = $this->input->post('id_daftar_ulang');
		$this->finance_model->cek_id_daftar_ulang($id);
		} else {
			redirect(base_url('login'));
		}
	}
	public function get_dropdown_pembayaran() {
		// $layanan =$this->input->post('layanan');
		$param = $this->input->get('jenis_biaya');
		$waktu = $this->input->get('waktu');
		$periode = $this->input->get('periode');
		$id_grade = $this->input->get('id_grade');
		$jenis_biaya = urldecode($param);
		$result = $this->finance_model->get_dropdown_pembayaran($jenis_biaya, $waktu, $periode, $id_grade);
		$option = "";
		$option .= '<option value="">Pilih Pembayaran</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->id_biaya."' >".$data->nama_biaya."</option>";
			
		}
		echo $option;

	}
	public function get_ta() {
		// $layanan =$this->input->post('layanan');
		$param = $this->input->get('periode');
		$waktu = $this->input->get('waktu');
		$id_grade = $this->input->get('id_grade');
		$result = $this->finance_model->get_ta($param , $waktu, $id_grade);
		$option = "";
		$option .= '<option value="">Pilih Pembayaran</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->jenis_biaya."' >".$data->jenis_biaya."</option>";
			
		}
		echo $option;

	}
	public function get_biaya_pembayaran() {
		// $layanan =$this->input->post('layanan');
		$param = $this->input->get('id_biaya');
		$pae = $this->input->get('id_grade');
		$par = $this->input->get('kategori');
		$id_biaya = $param;
		$result = $this->finance_model->get_biaya_pembayaran($id_biaya);
		// $option = "";
		// $option .= "<input readonly='' type='text' class='form-control' name='biaya' id='biayaa' value='".$result->jumlah_biaya."' >";

		if ($par == 'Angsuran Tahun 1'){
			$yaya = $this->finance_model->get_yaya($pae);
			/*$ee = $result->jumlah_biaya * $yaya->diskon / 100;		*/
			$ee = 0;
		} else if($par == 'Angsuran Tahun 2'  or $par == 'Angsuran Tahun 3' or $par == 'Angsuran Tahun 4'){
			$yaya = $this->finance_model->get_yaya($pae);
			/*$ee = $result->jumlah_biaya * $yaya->diskon / 100;	*/
			$ee = 0;
		} else {
			$ee = 0;
		}
		
		
		
		
		$ea = $result->jumlah_biaya - $ee;
		echo $ea;

	}
	public function tambah_pembayaran()
	{
		//set rule di setiap form input
			$this->finance_model->tambah_pembayaran();
	}
	//////////////////////////////////////////////////////////////
	function data_barang(){
		$data=$this->finance_model->data_mahasiswa();
		echo json_encode($data);
	}

	function get_barang(){
		$kobar=$this->input->get('id');
		$data=$this->finance_model->get_barang_by_kode($kobar);
		echo json_encode($data);
	}

	function simpan_barang(){
		$kobar=$this->input->post('kobar');
		$nabar=$this->input->post('nabar');
		$harga=$this->input->post('harga');
		$data=$this->m_barang->simpan_barang($kobar,$nabar,$harga);
		echo json_encode($data);
	}

	function update_barang(){
		$kobar=$this->input->post('kobar');
		$nabar=$this->input->post('nabar');
		$harga=$this->input->post('harga');
		$data=$this->m_barang->update_barang($kobar,$nabar,$harga);
		echo json_encode($data);
	}

	function hapus_barang(){
		$kobar=$this->input->post('kode');
		$data=$this->m_barang->hapus_barang($kobar);
		echo json_encode($data);
	}
}
