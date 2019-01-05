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
        $this->load->helper('url');
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        
        return $this->db->insert('users', $data);
    }
    
}