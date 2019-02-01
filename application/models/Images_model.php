<?php

class Images_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');        
    }
    
    public function get_images($name = FALSE) {
        $query = $this->db->get_where(
            'images', 
            array('name' => $name)
        );
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
            $query = $this->db->get_where(
                'images', 
                array('name' => '_md_thumb')
            );
            return $query->result_array();
        }
        
        $query = $this->db->get_where(
            'images', 
            array('name' => $name)
        );
        $result = $query->row_array();        
            
        return $result;
    }

    public function get_originals_by_name($name = FALSE) {
        if($name === FALSE) {
            $query = $this->db->get_where(
                'images', 
                array('thumb' => 0)
            );
            return $query->result_array();
        }
        
        $query = $this->db->get_where(
            'images', 
            array('name' => $name)
        );
        
        $result = $query->row_array();
        return $result;
    }

    public function get_thumbs($name = FALSE) {
        if($name === FALSE) {
            $this->db->like('name', '_sm_thumb');
            $query = $this->db->get('images');
            return $query->result_array();
        }
        $query = $this->db->get_where(
            'images', 
            array('name' => $slug)
        );
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
        return $this->db->insert('images', $data);
    }
}