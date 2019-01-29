<?php

class VGuides_model extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }
    
    public function get_vguides($slug = FALSE) {
        if($slug === FALSE) {
            $query = $this->db->get('vguide');
            return $query->result_array();
        }
        
        $query = $this->db->get_where('vguide', array('slug' => $slug));
        return $query->row_array();
    }
    
    public function set_vguides($vguide) {
        $this->load->helper('url');
        $vguide['slug'] = url_title($vguide['title'], 'dash', true);
        $vguide['createdAt'] = NULL;
        return $this->db->insert('vguide', $vguide);
    }
}
