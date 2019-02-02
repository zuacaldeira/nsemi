<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Seed_Nsemi_Conversion_Methods_Table extends CI_Migration {
    
    private $data = array(
        '("1","0", "FREE")',
        '("2","10", "DONATION")',
        '("3","0.10", "DECIMAL")',
        '("4","0.01", "CENTESIMAL")',
    );
    
    public function up() {
        foreach($this->data as $method) {
            $sql = 'INSERT INTO conversion_methods VALUES '.$method;
            $this->db->query($sql);
        }
    }
    
    public function down() {
        $types = array("FREE", "DONATION", "DECIMAL", "CENTESIMAL");   
        foreach ($types as $type) {
            $sql = "DELETE FROM conversion_methods WHERE type=$type";
            $this->db->query($sql);
        }
    }

}


?>