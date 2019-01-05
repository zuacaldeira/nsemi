<?php

class Login extends CI_COntroller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function index() {
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');#
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        
        $this->form_validation->set_rules(
            'username', 
            'Username', 
            'trim|required'
        );
        $this->form_validation->set_rules(
            'password', 
            'Password', 
            'trim|required'
        );

        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view("login/index");
            $this->load->view('templates/footer');
        }
        else {
            $result = $this->users_model->login_user();
            if(!$result) {
                $this->load->view('templates/header');
                $this->load->view("login/index");
                $this->load->view('templates/footer');
            }
            else {
                $username = $this->input->post('username');
                $data = array('username' => $username);
                
                $this->session->set_userdata($data);
                
                $referrer = $this->agent->referrer();
                redirect($referrer);
            }
        }

    }
}













