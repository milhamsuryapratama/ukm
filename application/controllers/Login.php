<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {
        $this->load->view('administrator/login');
    }
    
    public function p_login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $where = array(
            'username' => $username,
            'password' => $password
        );
        
        $cek = $this->Admin_model->cek_login('admin',$where)->num_rows();

        if ($cek > 0) {
            $data_session = array(
                'username' => $this->input->post('username'),
                'statusAdmin' => "login"
            );
            $this->session->set_userdata($data_session);
            redirect('dashboard');
            // $this->load->view('administrator/dashboard');
        }else {
            redirect('login');
        }   
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}

?>