<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Nsemi_Image_Downloads_Table extends CI_Migration {
    
    public function up() {
        $this->dbforge->add_field(
            array(
                'download_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11, 
                          'unsigned' => TRUE, 
                          'auto_increment' => TRUE),
                'user_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11),
                'price' => 
                    array('type' => 'DECIMAL(10,3)')
            )
        );
        
        $this->dbforge->add_key('download_id', TRUE);
        $this->dbforge->create_table('image_downloads');
    }
    
    public function down() {
        $this->dbforge->drop_table('image_downloads');
    }

}


?>