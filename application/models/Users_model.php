<?php



class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_users($username = FALSE) {
        if($username === FALSE) {
            $query = $this->db->get('users');
            return $query->result_array();
        }
        
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array();
    }
    
    public function set_users() {
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        
        return $this->db->insert('users', $data);
    }
    
    public function login_user() {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
        );
        
        $user = $this->get_users($data['username']);
        if($user != null) {
            $this->db->set('is_logged_in', true);
            $this->db->where(
                array(
                    'username' => $data['username'], 
                    'password' => $data['password']
                )
            );
            $result = $this->db->update('users');
            return $result;
        }
        
        return false;
    }
    
}