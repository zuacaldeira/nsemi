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
        
        $data = array(
            'slug' => url_title($this->input->post('title'), 'dash', TRUE),
            'title' => remove_invisible_characters($this->input->post('title')),
            'summary' => remove_invisible_characters($this->input->post('summary')),
            'text' => remove_invisible_characters($this->input->post('text')),
            'author' => $this->session->userdata('username'),
            'updatedAt' => NULL
        );

        $id = $this->input->post('id');
        if($id !== NULL) {
            $data['id'] = $id;
            $data['createdAt'] = $this->input->post('createdAt');
            
        }

        $_POST['slug'] = $data['slug'];
        return $this->db->replace('news', $data);
    }
}
