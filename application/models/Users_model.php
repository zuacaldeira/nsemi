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

        $this->load->helper('date');
        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'username' => $username,
            'email' => $email,
            'password' => $password
        );        
        $this->db->set('created_at', 'NOW()', FALSE);
        return $this->db->insert('users', $data);
    }
    
    public function login_user($username, $password) {
        $user = $this->get_user($username);
        if($user !== NULL) {
            $this->db->set(
                array(
                    'is_logged_in' => 1, 
                )
            );
            $this->db->set('last_login', 'NOW()', FALSE);            

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
    
    public function logout_user($username) {
        $user = $this->get_user($username);
        if($user !== NULL) {
            $this->db->set(
                array(
                    'is_logged_in' => 0, 
                )
            );
            $this->db->set('last_logout', 'NOW()', FALSE);            
            $this->db->where(array('username' => $username));
            
            $result = $this->db->update('users');
            return $result;
        }
        
        return false;
    }
}