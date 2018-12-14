<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		ini_set('display_errors', 0);
	}

	public function yoi(){
		$a = $this->db->where('id_kelas_mhs >=','1')->get('dump')->result();
		foreach ($a as $data) {
			$a1 = substr($data->id_mahasiswa,0,6);
			$b = $this->db->like('nama_mahasiswa', $a1 )->get('tb_mahasiswa')->row();
			$param = array('id_mahasiswa' => $b->id_mahasiswa );
			$this->db->where('id_kelas_mhs', $data->id_kelas_mhs)
        ->update('dump', $param);
		}
		echo 'success';
		// echo substr("Hello world",0,10);
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == TRUE AND $this->session->userdata('level') == 1) {
			if($this->session->userdata('level') == 1){
				$data['dropdown_level'] = $this->user_model->dropdown_level();
				$data['data_user'] = $this->user_model->data_user();
				$data['main_view'] = 'Admin/tambah_user_view';
				$this->load->view('template', $data);
			} else {
				redirect(base_url('login'));
			}
		} else {
			redirect('login');
		}
			
	}

	public function signup()
	{
			if($this->user_model->signup() == TRUE){
				$username = $this->input->post('username');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data user berhasil ditambahkan</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
            	redirect('admin');
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('admin');
			} 
	} 

	public function hapus_user(){
		$username = $this->uri->segment(3);
		if ($this->user_model->hapus_user($username) == TRUE) {
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Data user berhasil dihapus</p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
			redirect('admin');
		} else {
			$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Hapus User Gagal </div>');
			redirect('admin');
		}
	}
}