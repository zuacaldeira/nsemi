<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Nsemi_Conversion_Method_Table extends CI_Migration {
    
    public function up() {
        $this->dbforge->add_field(
            array(
                'conversion_method_id' => 
                    array('type' => 'INT', 
                          'constraint' => 11, 
                          'unsigned' => TRUE, 
                          'auto_increment' => TRUE),
                'price' => 
                    array('type' => 'DECIMAL(13,3)'),
                'type' => 
                    array('type' => 'VARCHAR', 
                          'constraint' => 32)
            )
        );
        
        $this->dbforge->add_key('conversion_method_id', TRUE);
        $this->dbforge->create_table('conversion_methods');
    }
    
    public function down() {
        $this->dbforge->drop_table('conversion_methods');
    }

}


?>