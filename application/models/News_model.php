<?php

class News_model extends CI_Model {
    
    public function __construct() {
        $this->load->database();
    }
    
    public function get_news($slug = FALSE) {
        if($slug === FALSE) {
            $query = $this->db->get('news');
            return $query->result_array();
        }
        
        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }
    
    public function set_news() {
        $this->load->helper('url');
        
        $slug = $this->input->post('slug');
        if($slug === FALSE) {
            // REad it from POST
            $slug = url_title($this->input->post('title'), 'dash', TRUE);
        }

        $data = array(
            'slug' => $slug,
            'title' => remove_invisible_characters($this->input->post('title')),
            'text' => remove_invisible_characters($this->input->post('text')),
            'author' => $this->session->userdata('username'),
            //'createdAt' => NULL,
            'updatedAt' => NULL
        );
        
        return $this->db->replace('news', $data);
    }
}
