<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $username = $this->session->userdata('username');
        $this->session->unset_userdata('username');
        
        $this->load->model('users_model');
        
        $result = $this->users_model->logout_user($username);
        redirect($this->agent->referrer());
    }
}