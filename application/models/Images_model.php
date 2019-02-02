<?php

/**
 * Images model, reflecting the images database table.
 * This class offers services to create, read, update 
 * and delete images from the database.
 */
class Images_model extends CI_Model {
    
    /**
     * Creates a new Images model.
     * @private (Used by the framework)
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');        
    }
    
    /**
     * Retrieve all images from the database
     * @return [[array]] Array with all images.
     */
    public function get_images() {
        $query = $this->db->get('images');
        return $query->row_array();        
    }

    /**
     * Retrieve all images from the database belonging to a certain user.
     * @param  Integer [$userid] A user's userid.
     * @return array   Array with all images owned by user with userid
     *                 $userid.
     */
    public function get_images_owned_by($userid) {
        $query = $this->db->get_where('images', array('userid'));
        return $query->row_array();        
    }

    /**
     * Retrieves the image with a given name.
     * @param  String [$name] The name of the image.
     * @return Array  Array with a single image if an image with the given 
     *                name exists, or empty if there is no such image.
     */
    public function get_image_named($name) {
        $query = $this->db->get_where('images', array('name' => $name));
        return $query->row_array();        
    }

    /**
     * Retrieves the names of all images.
     * @return [array] Array with all images names.
     * TODO: Simplify by using a simple select name...
     */
    public function get_images_names() {
        $images = $this->get_images();
        $names = [];
        
        foreach($images as $image) {
            $names[] = $image['name'];
        }
        
        return $names;        
    }

    public function create_image(
        $userid,
        $conversion_method_id,
        $name,
        $width,
        $height,
        $mime_type,
        $data_url,
        $size) {
        
        $slug = urldecode(url_title($name.'-'.time(), 'dash', TRUE));
        $data = array(
            'user_id'                => $user_id,
            'conversion_method_id'  => $conversion_method_id,
            'name'                  => $name,
            'width'                 => $width,
            'height'                => $height,
            'mime_type'             => $mime_type,
            'data_url'              => $data_url,
            'size'                  => $size
        );
        
        $this->db->set('created_at', 'NOW()', FALSE);        
        return $this->db->insert('images', $data);
    }

    /*
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
    */
    
    /**
     * Get all thumbnails.
     * 
     * @return array All thumbnails.
     *
     * TODO: Pagination and LIMIT are necessary.
     * Alternatively, a random choice of k thumbnails 
     * can be provided.
     * 
     * TODO: MOve to Thumbnails Model
     */
    public function get_thumbnails($flag = FALSE) {
        // If flag is not defined return all thumbnails
        if($flag === FALSE) {
            $query = $this->db->get('thumbnails');
            return $query->row_array();
        }
        // else
        else {
            $query = $this->db->get_where(
                'thumbnails', 
                array('rflag' => $flag)
            );
            return $query->row_array();
        }
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