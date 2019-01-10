<?php

class Tools extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->model('images_model');
    }
    
    public function index($name = NULL) {
        $data['title'] = 'Nsemi Image Transformation Tool';
        $data['original'] = null;
        $this->load->view('templates/header', $data);
        $this->load->view('tools/index', $data);        
        $this->load->view('templates/footer', $data);
    }

    public function view($name = NULL) {
        $data['title'] = 'Nsemi Image Transformation Tool';
        
        if($name !== NULL) {
            $data['original'] = $this->images_model->get_originals_by_name($name);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('tools/index', $data);        
        $this->load->view('templates/footer', $data);
    }

    
}