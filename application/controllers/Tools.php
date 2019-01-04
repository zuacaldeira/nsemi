<?php

class Tools extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }
    
    public function index() {
        $data['title'] = 'Nsemi Image Transformation Tool';
        $this->load->view('templates/header', $data);
        $this->load->view('tools/index', $data);        
        $this->load->view('templates/footer', $data);
    }

    
    
    
    
}