<?php defined('BASEPATH') OR exit('No direct script access allowed');

class VGuides extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        //$this->load->helper('url_helper');
    }
    
    public function index() {
        $data['title'] = 'Video Guides';
        $this->load->view('templates/header');
        $this->load->view('vguides/index', $data);
        $this->load->view('templates/footer');
    }
    
}
