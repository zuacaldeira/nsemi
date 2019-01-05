<?php

class Images_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');        
    }
    
    public function get_images($slug = FALSE) {
        if($slug === FALSE) {
            $query = $this->db->get('image');
            return $query->result_array();
        }
        $query = $this->db->get_where('image', array('slug' => $slug));
        return $query->row_array();        
    }

    public function get_thumbs($slug = FALSE) {
        if($slug === FALSE) {
            $query = $this->db->get_where('image', array('thumb' => 1));
            return $query->result_array();
        }
        $query = $this->db->get_where('image', array('slug' => $slug, 'thumb' => 1));
        return $query->row_array();        
    }

    public function set_images($image) {
        $slug = urldecode(url_title($image['name'].'-'.time(), 'dash', TRUE));
        $data = array(
            'name' => $image['name'],
            'slug' => $slug,
            'mime_type' => $image['type'],
            'data'      => $image['data_url'],
            'owner' => $image['owner'],
            'thumb' => $image['thumb']
        );        
        return $this->db->insert('image', $data);
    }
}