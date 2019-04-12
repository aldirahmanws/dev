<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    

	public function __construct()
	{
		parent::__construct();
	}

    public function masuk() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->where('username',$username);
        $result = $this->getUsers($password);        

        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    public function data_session(){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_jabatan', 'tb_jabatan.id_level=tb_user.id_level');
        $this->db->where('tb_user.username', $this->session->userdata('username'));
        $query = $this->db->get();
        return $query->row();
    }
    function save_data($username,$password, $password_baru){
        
        if($username != null && $password != null && $password_baru != null){
            $this->db->where('username',$username);
            $result = $this->getUsersku($username,$password, $password_baru);        

            if (!empty($result)) {
                return true;
            } else {
                return null;
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger"> Harap Lengkapi Data </div>');
            redirect('profile');
        }
        
    }
    public function save_foto($upload, $username)
   {
    $data = array('foto' => $upload['file_name'] )
                  ;
    $this->db->where('username', $username)->update('tb_user', $data);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  } 
    function getUsersku($username,$password, $password_baru) {
        $query = $this->db->get('tb_user');

        if ($query->num_rows() == 1) {
            
            $result = $query->row_array();

            if ($this->bcrypt->check_password($password, $result['password'])) {
                $hash = $this->bcrypt->hash_password($password_baru);
                $this->db->query("UPDATE tb_user SET password = '$hash' WHERE username = '$username'");
                return true;

            } else {
                //Wrong password
                return false;
                // $this->session->set_flashdata('message', '<div class="alert alert-danger"> Password Lama Salah </div>');
                // redirect('profile');
            }

        } else {
            return array();
        }
    }
    function getUsers($password) {
        $query = $this->db->get('tb_user');

        if ($query->num_rows() == 1) {
            
            $result = $query->row_array();

            if ($this->bcrypt->check_password($password, $result['password'])) {
                foreach ($query->result() as $sess) {
                $sess_data['logged_in'] = TRUE;
                $sess_data['username'] = $sess->username;
                $sess_data['level'] = $sess->id_level;
                }
                $this->session->set_userdata($sess_data);
                return $result;
            } else {
                //Wrong password
                return array();
            }

        } else {
            return array();
        }
    }
    public function data_user(){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_jabatan', 'tb_jabatan.id_level=tb_user.id_level');
        $this->db->where('tb_user.id_level !=', 5);
        $this->db->where('tb_user.id_level !=', 2);
        $query = $this->db->get();
        return $query->result();
    }

    public function data_dosen(){
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_dosen', 'tb_dosen.id_dosen=tb_user.username', 'left');
        $this->db->join('tb_jabatan', 'tb_jabatan.id_level=tb_user.id_level');
        $query = $this->db->get();
        return $query->result();
    }

     function dropdown_level()
    {
        return $this->db->where('id_level !=','5')
                    ->where('id_level !=','2')
                    ->get('tb_jabatan')
                    ->result();

    }
    public function signup()
    {
        $password = $this->input->post('password', TRUE);
        $hash = $this->bcrypt->hash_password($password);
        $data = array(
            'username'      => $this->input->post('username', TRUE),
            'password'  => $hash,
            'id_level'     => $this->input->post('id_level', TRUE)
        );
    
        $this->db->insert('tb_user', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }
    public function signup_mahasiswa($nim, $pass)
    {
        $password = $pass;
        $hash = $this->bcrypt->hash_password($password);
        $data = array(
            'username'      => $nim,
            'password'  => $hash,
            'id_level'     => 5
        );
    
        $this->db->insert('tb_user', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function signup_dosen($nim, $pass)
    {
        $password = $pass;
        $hash = $this->bcrypt->hash_password($password);
        $data = array(
            'username'      => $nim,
            'password'  => $hash,
            'id_level'     => 2
        );
    
        $this->db->insert('tb_user', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function hapus_user($username){
        $this->db->where('username', $username)
          ->delete('tb_user');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

    public function create_user($username, $group, $fullname) {

        if ($group == 'DosenStieGroup') {
           $level = 2;
        } else if ($group == 'MarketingStieGroup') {
           $level = 3;
        } else if ($group == 'FinanceStieGroup') {
           $level = 4;
        } else if ($group == 'MhsStieGroup') {
           $level = 5;
        } else if ($group == 'AkademikStieGroup' OR $username == 'zahroh.dhoffir') {
           $level = 6;
        } else if ($group == 'IT' OR $group == 'ITGroup' OR $group == 'AdminStieGroup') {
           $level = 7;
        } else {
            redirect('login');
        }

        $query = $this->db->select('*')
                ->where('username', $username)
                ->get('tb_user')
                ->row();

        if ($query == null)

            {
                $data = array(
                    'username' => $username,
                    'id_level' => $level,
                    'level_before' => $level,
                    'fullname' => $fullname
                );
            
                $this->db->insert('tb_user', $data);
                return true;
    
            } else {
                if ($query->id_level == 1) {
                 
                } else {
                     $data = array(
                            'id_level' => $level,
                            'level_before' => $level,
                            'fullname' => $fullname
                        );
                    
                        $this->db->where('username', $username)->update('tb_user', $data); 
                        return true;
                }
            }

    }

     public function save_edit_foto($foto, $username)
   {    
    $data = array('foto' => $foto['file_name'] )
                  ;
    $this->db->where('username', $username)->update('tb_user', $data);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function edit_jabatan($username){
        $data = array(
           'id_level'     => $this->input->post('id_level')
          );

        $this->db->where('username', $username)
            ->update('tb_user', $data);

        if ($this->db->affected_rows() > 0) {
          return TRUE;
        } else {
          return FALSE;
        }
    }
	

}

/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */