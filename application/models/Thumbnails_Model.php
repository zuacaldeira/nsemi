<?php

/**
 * Thumbnails model class. This class offers the 
 * following services:
 * [Method] 3.1   - create($d1, ..., $dn)
 * [Method] 3.2a  - read_with_id($thumbnail_id)
 * [Method] 3.2b  - read_with_name($name)
 * [Method] 3.2.c - real_all()
 * [Method] 3.2.d - read_all_with_flag($rflag)
 * [Method] 3.3   - update($d1, ..., $dn)
 * [Method] 3.4   - delete($thumbnail_id)
 */
class Thumbnails_Model extends CI_Model {
    
    /**
     * Initializes a new model object.
     * @private
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Inserts a new thumbnail in the database.
     * 
     * @param integer $original_id          The id of the original image
     * @param string  $rflag                The responsive size of this thumbnail
     * @param integer $user_id              Image owner id
     * @param integer $conversion_method_id Conversion method of the original image
     * @param string  $name                 Name of this thumbnail
     * @param float   $width                Width of this thumbnail
     * @param float   $height               Height of this thumbnail
     * @param string  $mime_type            Mime Type of this thumbnail
     * @param object  $data_url             Data URL of this thumbnail
     * @param float   $size                 Size, in KB, of this thumbnail
     */
    public function create(
        $original_id, 
        $rflag, 
        $user_id, 
        $conversion_method_id,
        $name,
        $width,
        $height,
        $mime_type,
        $data_url,
        $size) {
        
        $data = array(
            'original_id' => $original_id, 
            'rflag'       => $rflag, 
            'user_id'     => $user_id, 
            'conversion_method_id' => $conversion_method_id,
            'name'        => $name,
            'width'       => $width,
            'height'      => $height,
            'mime_type'   => $mime_type,
            'data_url'    => $data_url,
            'size'        => $size
        );
        
        $this->db->set('created_at', 'NOW()', FALSE);
        $this->db->insert('thumbnails', $data);
    }
    
    public function read_all_with_flag($rflag) {
        $query = $this->db->get_where(
            'thumbnails', 
            array('rflag' => $rflag)
        );
        
        return $query->result_array();
    }

    public function read_with_name($name) {
        $query = $this->db->get_where(
            'thumbnails', 
            array('name' => $name)
        );
        
        return $query->row_array();
    }

}