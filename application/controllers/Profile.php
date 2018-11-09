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
            $data['data_user'] = $this->user_model->data_session();
            $data['dosen'] = $this->dosen_model->detail_dosen($username);
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
                    if ($this->session->userdata('level') == 2) {
                         $this->session->set_flashdata('message', '<div class="alert alert-success"> Profil Berhasil diganti </div>');
                         redirect('index');
                    } else {
                         $this->session->set_flashdata('message', '<div class="alert alert-success"> Profil Berhasil diganti </div>');
                        redirect('profile'); 
                    }
                    
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