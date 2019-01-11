<?php

class Tools extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->model('images_model');
    }
    
    public function index() {
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

    public function resize() {
        $data['title'] = 'Nsemi Image Resizing Tool';
        $data['original'] = null;
        
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('swidth', 'Width', 'required');
        $this->form_validation->set_rules('sheight', 'Height', 'required');
        
        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('tools/resize', $data);        
            $this->load->view('templates/footer', $data);
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('tools/success', $data);        
            $this->load->view('templates/footer', $data);
        }
    }
    
}