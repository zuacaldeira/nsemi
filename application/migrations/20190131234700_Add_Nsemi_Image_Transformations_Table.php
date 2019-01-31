<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Nsemi_Image_Transformations_Table extends CI_Migration {
    
    public function up() {
        $this->dbforge->add_field(
            array(
                'transformation_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11, 
                          'unsigned' => TRUE, 
                          'auto_increment' => TRUE),
                'user_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11),
                'image_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11),
                'tranformation_method_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11),
                'download_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11))
        );
        
        $this->dbforge->add_key('transformation_id', TRUE);
        $this->dbforge->create_table('image_tranformations');
    }
    
    public function down() {
        $this->dbforge->drop_table('image_tranformations');
    }

}


?>