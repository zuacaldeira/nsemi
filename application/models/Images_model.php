<?php

class Images_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');        
    }
    
    public function get_images($slug = FALSE) {
        if($slug === FALSE) {
            $this->db->where('thumb', 0);
            $query = $this->db->get('image');
            return $query->result_array();
        }
        
        $query = $this->db->get_where('image', array('slug' => $slug));
        return $query->row_array();        
    }

    public function get_images_names() {
        $images = $this->get_images();
        $names = [];
        
        foreach($images as $image) {
            $names[] = $image['name'];
        }
        
        return $names;        
    }

    public function get_images_by_name($name = FALSE) {
        if($name === FALSE) {
            $query = $this->db->get_where('image', array(
                'name' => '_md_thumb',
                'thumb' => 1));
            return $query->result_array();
        }
        
        
        $query = $this->db->get_where('image', array(
                'name' => $name,
                'thumb' => 1));
        $result = $query->row_array();        
            
        return $result;
    }

    public function get_originals_by_name($name = FALSE) {
        if($name === FALSE) {
            $query = $this->db->get_where('image', array(
                'thumb' => 0));
            return $query->result_array();
        }
        
        $query = $this->db->get_where(
            'image', 
            array('name' => $name)
        );
        
        $result = $query->row_array();
        return $result;
    }

    public function get_thumbs($slug = FALSE) {
        if($slug === FALSE) {
            $this->db->like('name', '_sm_thumb');
            $this->db->where('thumb', 1);
            $query = $this->db->get('image');
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