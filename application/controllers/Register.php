<?php

class Register extends CI_COntroller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
    }
    
    public function index() {
        $data['title'] = 'Registration Form';
        
        $this->load->view('templates/header', $data);
        $this->load->view("register/index");
        $this->load->view('templates/footer');
    }
}













