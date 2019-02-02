<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Image_Description_Keywords_Color extends CI_Migration {
    
    public function up() {
        $fields = 
            array(
                'description' => 
                    array('type' => 'VARCHAR', 
                          'constraint' => 512),
                'keywords' => 
                    array('type' => 'VARCHAR', 
                          'constraint' => 256),
                'colors' => 
                    array('type' => 'VARCHAR', 
                          'constraint' => 256),
            );
        
        $this->dbforge->add_column('images', $fields);
    }
    
    public function down() {
        $this->dbforge->drop_column('images', 'description');
        $this->dbforge->drop_column('images', 'keywords');
        $this->dbforge->drop_column('images', 'colors');
    }

}


?>