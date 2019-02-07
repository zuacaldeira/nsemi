<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Registration Process Controller.
*/
class Register extends CI_Controller {
    
    /**
     * Creates a new Register Controller object. 
     * @private (Called by the framework)
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Entry point to the Registration Service.
     * Shows, validates and process registration form for a new user.
     * 
     * Helpers: url, form
     * Libraries: form_validation
     */
    public function index() {
        // Load required helpers, libraries and models
        $this->load->helper(array('url', 'form'));
        $this->load->library('form_validation');
        $this->load->model('users_model');

        // Store referrer in session
        if(!strpos( $this->agent->referrer(), 'register' )) {
            $this->session->set_userdata('referrer', $this->agent->referrer());
        }

        // Form error delimiters
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        
        // Form validation rules for...
        // ... firstname
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');

        // ... lastname
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
        
        // ... username
        $this->form_validation->set_rules(
            'username', 
            'Username', 
            'trim|required|is_unique[users.username]|min_length[5]|max_length[32]',
            array(
                'required' => 'Provide %s', 
                'is_unique' => 'This %s already exists')
        );
        
        // ... email
        $this->form_validation->set_rules(
            'email', 
            'Email', 
            'trim|required|valid_email|is_unique[users.email]|max_length[64]',
            array(
                'required' => 'Provide %s', 
                'is_unique' => 'This %s already exists')
        );
        
        // ... password
        $this->form_validation->set_rules(
            'password', 
            'Password', 
            'trim|required|min_length[8]'
        );
        
        // ... password confirmation
        $this->form_validation->set_rules(
            'password-confirm', 
            'Password Confirmation', 
            'trim|required|matches[password]'
        );

        // Run form validation
        if($this->form_validation->run() === FALSE) {
            // Reload registration form
            $this->load->view('templates/header');
            $this->load->view("register/index");
            $this->load->view('templates/footer');
        }
        // Stores the new user in db
        else {
            $firstname  = $this->input->post('firstname');
            $lastname   = $this->input->post('lastname');
            $username   = $this->input->post('username');
            $email      = $this->input->post('email');
            $password   = $this->input->post('password');

            $this->users_model->create_user(
                $firstname,
                $lastname,
                $username,
                $email,
                $password
            );
            
            // Removes referrer from user session data
            $referrer = $this->session->userdata('referrer');
            $this->session->unset_userdata('referrer');
            
            // Redirect to referrer
            redirect($referrer);
        }
    }
}
