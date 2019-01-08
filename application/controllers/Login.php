<?php

class Login extends CI_COntroller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
    }
    
    public function index() {
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        
        $this->form_validation->set_rules(
            'username', 
            'Username', 
            'trim|required'
        );
        $this->form_validation->set_rules(
            'password', 
            'Password', 
            'trim|required'
        );

        if(!strpos( $this->agent->referrer(), 'login' )) {
            $this->session->set_userdata('referrer', $this->agent->referrer());
        }
        

        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view("login/index");
            $this->load->view('templates/footer');
        }
        else {
            $result = $this->users_model->login_user();
            if(!$result) {
                $this->load->view('templates/header');
                $this->load->view("login/index");
                $this->load->view('templates/footer');
            }
            else {
                $username = $this->input->post('username');
                $this->session->set_userdata('username', $username);
                
                $data = array(
                    'username' => $this->session->userdata('username'), 
                    'referrer' => $this->session->userdata('referrer')
                );
                $this->load->view('login/success', $data);
                redirect($this->session->userdata('referrer'));
            }
        }

    }
    
    private function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === ''
          || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    private function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        if ($needle === '') {
            return true;
        }
        $diff = \strlen($haystack) - \strlen($needle);
        return $diff >= 0 && strpos($haystack, $needle, $diff) !== false;
    }
}
