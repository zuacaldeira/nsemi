<?php

class Logout extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('referrer');
        redirect($this->agent->referrer());
    }
}