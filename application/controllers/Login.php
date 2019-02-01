<?php

/**
* Login Process Controller.
*/
class Login extends CI_Controller {
    
    /**
     * Creates a new Login Controller object.
     * @private (used by the framework)
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Entry point to the login controller functionality.
     * Shows, validates and processes the login form.
     */
    public function index() {
        // Loads helpers libraries and models needed for login
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        
        // Store referrer as a user session data 
        if(!strpos( $this->agent->referrer(), 'login' )) {
            $this->session->set_userdata('referrer', $this->agent->referrer());
        }
        
        // Validation rule for input field 'username'
        $this->form_validation->set_rules(
            'username', 
            'Username', 
            'trim|required'
        );
        
        // Validation rule for input field 'password'
        $this->form_validation->set_rules(
            'password', 
            'Password', 
            'trim|required'
        );

        // Run form validation
        // In case of error, reload the form
        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view("login/index");
            $this->load->view('templates/footer');
        }
        
        // If form is valid, load the model and login user in db
        else {
            $this->load->model('users_model');
            
            // User's username and password
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $result = $this->users_model->login_user($username, $password);
            
            // Username or Password incorrect so reload the login form
            // TODO: Mark error in form
            if(!$result) {
                $this->load->view('templates/header');
                $this->load->view("login/index");
                $this->load->view('templates/footer');
            }
            
            // If user credentials are correct, redirect to the referrer page
            else {
                $referrer = $this->session->userdata('referrer');
                
                // Store username in user session
                $this->session->set_userdata('username', $username);
                
                // Remove referrer from user session data
                $this->session->unset_userdata('referrer');
                
                // TODO: Referrer must be removed from session data
                redirect($referrer);
            }
        }
    }
    
    /**
     * Checks wheter a string starts with a given substring.
     * @param  String $haystack The string we want to search.
     * @param  String $needle   The string we are searching.
     * @return Boolean TRUE is $haystack starts with $needle, FALSE otherwise.
     */
    private function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === ''
          || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

    /**
     * Checks wheter a string ends with a given substring.
     * @param  String $haystack The string we want to search.
     * @param  String $needle   The string we are searching.
     * @return Boolean TRUE is $haystack ends with $needle, FALSE otherwise.
     */
    private function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        if ($needle === '') {
            return true;
        }
        $diff = strlen($haystack) - strlen($needle);
        return $diff >= 0 && strpos($haystack, $needle, $diff) !== false;
    }
}
