<?php



class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }
    
    public function get_user($username) {
        $query = $this->db->get_where(
            'users', 
            array('username' => $username)
        );
        return $query->row_array();
    }
    
    public function create_user(
        $firstname, 
        $lastname, 
        $username, 
        $email, 
        $password) {

        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => username,
            'email' => $email,
            'password' => $password,
            'created_at' => date()
        );        
        return $this->db->insert('users', $data);
    }
    
    public function login_user($username, $password) {
        $user = $this->get_user($username);
        if($user != null) {
            $this->db->set('is_logged_in', true);
            $this->db->where(
                array(
                    'username' => $username, 
                    'password' => $password
                )
            );
            $result = $this->db->update('users');
            return $result;
        }
        
        return false;
    }
    
}