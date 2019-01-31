<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Nsemi_Users_Table extends CI_Migration {
    
    public function up() {
        $this->dbforge->add_field(
            array(
                'user_id' => array('type' => 'INT', 
                                   'constraint' => 11, 
                                   'unsigned' => TRUE, 
                                   'auto_increment' => TRUE),
                'firstname' => array('type' => 'VARCHAR', 'constraint' => 50),
                'lastname' => array('type' => 'VARCHAR', 'constraint' => 50),
                'username' => 
                    array('type'        => 'VARCHAR', 
                          'constraint'  => 256,
                          /*'unique'      => TRUE*/),
                'email' => 
                    array('type'        => 'VARCHAR', 
                          'constraint'  => 256,
                          /*'unique'      => TRUE*/),
                'password' =>
                    array('type'        => 'VARCHAR', 
                          'constraint'  => 256),
                'is_logged_in' => array('type' => 'BOOLEAN'),
                'last_login' => array('type' => 'TIMESTAMP', 'null' => TRUE),
                'last_logout' => array('type' => 'TIMESTAMP', 'null' => TRUE),
                'created_at' => array('type' => 'TIMESTAMP', 'null' => TRUE),                
            )
        );
        
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('users');
    }
    
    public function down() {
        $this->dbforge->drop_table('users');
    }

}


?>