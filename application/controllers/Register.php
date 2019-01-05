<?php

class Register extends CI_COntroller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function index() {
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');#
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
        $this->form_validation->set_rules(
            'username', 
            'Username', 
            'trim|required|is_unique[users.username]|min_length[5]|max_length[12]',
            array(
                'required' => 'Provide %s', 
                'is_unique' => 'This %s already exists')
        );
        $this->form_validation->set_rules(
            'email', 
            'Email', 
            'trim|required|valid_email|is_unique[users.email]',
            array(
                'required' => 'Provide %s', 
                'is_unique' => 'This %s already exists')
        );
        $this->form_validation->set_rules(
            'password', 
            'Password', 
            'trim|required|min_length[8]'
        );
        $this->form_validation->set_rules(
            'password-confirm', 
            'Password Confirmation', 
            'trim|required|matches[password]'
        );

        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view("register/index");
            $this->load->view('templates/footer');
        }
        else {
            $this->users_model->set_users();
            
            $data = array(
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            );            
            $this->load->view('templates/header');
            $this->load->view("register/success", $data);
            $this->load->view('templates/footer');
        }

    }
}













