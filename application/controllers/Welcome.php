<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }

    public function index() {
        $data['title'] = 'Welcome to Nsemi.org';
        $data['original'] = null;
        
        $this->load->view('templates/header');
        $this->load->view('welcome/index', $data);
        $this->load->view('templates/footer');
    }
}



