<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Nsemi_Transformation_Methods_Table extends CI_Migration {
    
    public function up() {
        $this->dbforge->add_field(
            array(
                'method_id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
                'method'    => array('type' => 'VARCHAR', 'constraint' => 16),
                'width'     => array('type' => 'DECIMAL(6,2)'),
                'height'    => array('type' => 'DECIMAL(6,2)'),
                'mime_type' => array('type' => 'VARCHAR', 'constraint' => 255),
                'best_fit'  => array('type' => 'BOOLEAN', 'default' => FALSE),
                'filter'    => array('type' => 'VARCHAR', 'constraint' => 32),
                'blur'      => array('type' => 'DECIMAL(3,2)'),
                'compression_quality' => array('type' => 'DECIMAL(4,2)'),
                'keep_aspect_ratio' => array('type' => 'BOOLEAN')
            )
        );
        $this->dbforge->add_key('method_id', TRUE);
        $this->dbforge->create_table('transformation_methods');
    }
    
    public function down() {
        $this->dbforge->drop_table('transformation_methods');
    }

}


?>