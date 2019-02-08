<?php


/**
 * Users Model. Allows CRUD operations for users and support for login/logout.
 */
class Users_model extends CI_Model {

    /**
     * Creates a new instrance of Users_model.
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Returns an array of user objects from the underlying database.
     * @return array of user records.
     */
    public function get_users() {
        $query = $this->db->get('users');
        return $query->result_array();
    }
    
    /**
     * Retrieves a user with the given username. For security reasons, the 
     * password is set to null before returning to the caller.
     * 
     * @param string $username  A user's username
     * @return array An associative array with a user data.
     */
    public function get_user_with_username($username) {
        $query = $this->db->get_where(
            'users', 
            array('username' => $username)
        );
        
        $user = $query->row_array();
        return $this->normalize($user);
    }
    
    /**
     * Normalizes the user object before returning it to the caller. 
     * Normalization consists of setting the password to null.
     * 
     * @param array $user   An associative array representing a user object.
     * @return array        The same array but with 'password' field set to 
     *                      null.
     */
    private function normalize($user) {
        if(!empty($user)) {
            $user['password'] = NULL;            
        }        
        return $user;
    }
    
    /**
     * Retrieves a user with the guven user_id. Password is set to null before
     * returning to caller, for security reasons.
     *  
     * @param integer $user_id  A user id
     * @return array            A normalized user, with a nullified password.
     */
    public function get_user_with_id($user_id) {
        $query = $this->db->get_where(
            'users', 
            array('user_id' => $user_id)
        );
        $user = $query->row_array();
        return $this->normalize($user);
    }

    /**
     * Creates a new user and stores it in the underlying storage.
     * 
     * @param string $firstname User's firstname
     * @param string $lastname  User's lastname
     * @param string $username  User's username
     * @param string $email     User's email
     * @param string $password  User's password
     * @return type             The result of inserting a new user in the 
     *                          database.
     */
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
    
    /**
     * Logs in a user with the given credentials.
     * 
     * @param string $username  A username
     * @param string $password  A password
     * @return boolean          True if the user is successfully logged in, 
     *                          false otherwise.
     */
    public function login_user($username, $password) {
        $user = $this->get_user_with_username($username);
        if($user !== NULL) {
            $this->db->set(array('is_logged_in' => 1));
            $this->db->set('last_login', 'NOW()', FALSE);            
            $this->db->where(array('username' => $username, 'password' => $password));
            
            // QUESTION: What happens if where does not match any row in the 
            // table? What is exactly the result of update?
            return $this->db->update('users');
            //return true;
        }
        return false;
    }
    
    public function logout_user($username) {
        $user = $this->get_user_with_username($username);
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
    
    /**
     * Deletes the user with username $username from the database.
     * 
     * @param type $username    A username from a user in the database
     */
    public function delete_user_with_username($username) {
       $this->db->delete('users', array('username' => $username)); 
    }
}