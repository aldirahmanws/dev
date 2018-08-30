<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('user_model');
	}

	public function index()
	{
        $data['data_user'] = $this->user_model->data_session();
	    $data['main_view'] = 'profile';
        $this->load->view('template', $data);	
			
	}
    public function save_data()
    {
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password_baru = $this->input->post('password_baru');
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg|pdf';
        $this->load->library('upload', $config);
        if($username && $password && $password_baru != null && !empty($_FILES['foto']['name'])){
            if($this->user_model->save_data($username,$password, $password_baru) == TRUE){
                if($this->upload->do_upload('foto')){
                  if($this->user_model->save_foto($this->upload->data(), $username) == TRUE){
                    $this->session->set_flashdata('message', '<div class="alert alert-success"> Profil Berhasil diganti </div>');
                        redirect('profile');
                  } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger"> Profil gagal diganti </div>');
                        redirect('profile');
                  }
                } else {
                  $this->session->set_flashdata('message', $this->upload->display_errors());
                    redirect('profile');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"> Password Lama salah</div>');
                    redirect('profile');
            }
        } else if($username && $password && $password_baru != null){
            if($this->user_model->save_data($username,$password, $password_baru) == TRUE){
                $this->session->set_flashdata('message', '<div class="alert alert-success"> Password berhasil diganti </div>');
                    redirect('profile');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"> Password Lama salah</div>');
                    redirect('profile');
            }
            
        } else if(!empty($_FILES['foto']['name'])){
            if($this->upload->do_upload('foto')){
              if($this->user_model->save_foto($this->upload->data(), $this->session->userdata('username')) == TRUE){
                $this->session->set_flashdata('message', '<div class="alert alert-success"> Foto berhasil diganti </div>');
                    redirect('profile');
              } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger"> Foto gagal diganti </div>');
                    redirect('profile');
              }
            } else {
              $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect('profile');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info"> Tidak Ada Perubahan </div>');
            redirect('profile');
        }
    }

}