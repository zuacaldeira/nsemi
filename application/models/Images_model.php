<?php

class Images_model extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }
    
    public function get_images($slug = FALSE) {
        if($slug === FALSE) {
            $query = $this->db->get('image');
            return $query->result_array();
        }
        $query = $this->db->get_where('image', array('slug' => $slug));
        return $query->row_array();        
    }

    public function set_images($image) {
        $this->load->helper('url');
        $slug = url_title($image['name'], 'dash', TRUE);
        
        $data = array(
            'name' => $image['name'],
            'slug' => $slug,
            'mime_type' => $image['type'],
            'data'      => $image['data_url'],
            'owner' => 1
        );
        
        return $this->db->insert('image', $data);
    }
}