<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Migration that introduces / removes the 
 * Thumbnails table from the database.
 */
class Migration_Add_Nsemi_Thumbnails_Table extends CI_Migration {
    
    public function up() {
        $this->dbforge->add_field(
            array(
                'thumbnail_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11, 
                          'unsigned' => TRUE, 
                          'auto_increment' => TRUE),
                'original_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11),
                'rflag' => 
                    array('type' => 'VARCHAR', 
                          'constraint' => 2),
                'user_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11),
                'conversion_method_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11),
                'name' => 
                    array('type' => 'VARCHAR', 
                          'constraint' => 255,
                          'unique' => TRUE),
                'width' => 
                    array('type' => 'DECIMAL(4,2)'),
                'height' => 
                    array('type' => 'DECIMAL(4,2)'),
                'mime_type' => 
                    array('type' => 'VARCHAR',
                          'constraint' => 255),
                'data_url' => 
                    array('type' => 'LONGBLOB'),
                'size' => 
                    array('type' => 'DECIMAL(13,3)'),
                'created_at' => 
                    array('type' => 'TIMESTAMP'),
                
            )
        );
        
        $this->dbforge->add_key('thumbnail_id', TRUE);
        $this->dbforge->create_table('thumbnails');
    }
    
    public function down() {
        $this->dbforge->drop_table('thumbnails');
    }

}


?>