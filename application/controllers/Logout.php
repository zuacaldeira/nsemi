<?php

class Logout extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->session->unset_userdata('username');
        redirect($_SERVER['HTTP_REFERER']);
    }
}