<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('user_model');
        $this->load->model('mahasiswa_model');
        $this->load->model('dosen_model');
        ini_set('display_errors', 0);
	}

	public function index()
	{
        if ($this->session->userdata('logged_in') == TRUE) {
        if($this->session->userdata('level') == 5){
            $username = $this->session->userdata('username');
            $session = $this->mahasiswa_model->session_mahasiswa($username);
            $id_mahasiswa = $session->id_mahasiswa;
            $data['id_mahasiswa'] = $id_mahasiswa;
            $data['mahasiswa'] = $this->mahasiswa_model->detail_mahasiswa_dikti($id_mahasiswa);
            $data['main_view'] = 'Mahasiswa/lihat_mahasiswa_dikti_view';
            $this->load->view('template', $data);   
        } else if($this->session->userdata('level') == 2) {
            $username = $this->session->userdata('username');
            $session = $this->dosen_model->session_dosen($username);
            $id_dosen = $session->id_dosen;
            $data['foto_dosen'] = $this->dosen_model->foto_dosen($username);
            $data['dosen'] = $this->dosen_model->detail_dosen($id_dosen);
            $data['dosen2'] = $this->dosen_model->detail_dosen2($id_dosen);
            $data['main_view'] = 'Dosen/detail_dosen_view';
            $this->load->view('template', $data);  

        }   else {
            $data['data_user'] = $this->user_model->data_session();
    	    $data['main_view'] = 'profile';
            $this->load->view('template', $data);	
        }
        } else {
            redirect('login');
        }
			
	}
    public function save_data()
    {
        $username = $this->session->userdata('username');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload', $config);
        if($this->upload->do_upload('foto')){
          if($this->user_model->save_edit_foto($this->upload->data(), $username) == TRUE){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Unggah foto berhasil </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
                redirect('profile');
          } else {
            $this->session->set_flashdata('message', 'Update foto gagal');
                redirect('profile');
          }
        } else {
          $this->session->set_flashdata('message', $this->upload->display_errors());
             redirect('profile');
        }
        
    }

    public function save_foto_dosen()
    {
        $id_dosen = $this->uri->segment(3);
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload', $config);
        if($this->upload->do_upload('foto')){
          if($this->user_model->save_edit_foto_dosen($this->upload->data(), $id_dosen) == TRUE){
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" style="margin-left: -20px;margin-right: -20px; margin-top: -15px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p><i class="icon fa fa-check"></i> Unggah foto berhasil </p>
                </div><script> window.setTimeout(function() { $(".alert-success").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); }, 5000); </script>');
                redirect('profile');
          } else {
            $this->session->set_flashdata('message', 'Update foto gagal');
                redirect('profile');
          }
        } else {
          $this->session->set_flashdata('message', $this->upload->display_errors());
             redirect('profile');
        }
        
    }

}