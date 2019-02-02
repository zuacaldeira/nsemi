<?php

/**
 * Gallery Controller. Provides services to:
 *  1 - View gallery of image thumbnails
 *  2 - Visit an image page
 *  3 - To Upload a new image, if the user is logged in.
 */
class Gallery extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library('image_lib');
    }
    
    /**
     * Show the gallery's home page, instantiated with 
     * small thumbnails of the images stored in db.
     * 
     * Communicates with the View by passing a $data object with:
     *  1 - title
     *  2 - array of images
     */
    public function index() {
        try {
            // Loads the models and thumbnails
            $this->load->model('thumbnails_model');
            $images = $this->thumbnails_model->read_all_with_flag("sm");            
            // Prepare communication data
            $data['title'] = 'Gallery';
            $data['images'] = $images;
            
            // Builds View
            $this->load->view('templates/header', $data);
            $this->load->view('gallery/index', $data);
            $this->load->view('templates/footer');
            
        } catch(Exception $ex) {
            show_404();
        }
    }
    
    /**
     * Visits an image page. The variable $name is the name 
     * of a thumbnail. 
     * 
     * The internals of this method are:
     * 
     *  1 - Builds the name for a large thumbnail
     *  2 - Retrieves the large thumbnail image from db
     *  3 - Loads single image page view, passing a $data object
     *      with title, name and image object as in the database.
     *      
     * @param string [$name = NULL] Name of the image.
     */
    public function view($name = FALSE) {
        // Page Not Found if $name is not provided
        if($name === FALSE) {
            show_404();
        }
        
        // Large image name
        $new_name = str_replace('_sm_thumb', '_lg_thumb', $name);
        $image = $this->thumbnails_model->read_with_name($new_name);
        
        // Prepare communication data object
        $data['title'] = $new_name;
        $data['name'] = $new_name;
        $data['image'] = $image;
        
        // Composes view
        $this->load->view('templates/header', $data);
        $this->load->view("gallery/view", $data);
        $this->load->view('templates/footer');
    }

    /**
     * Create image method. This method manages the upload process.
     * 
     * If the image is correctly uploaded, it stores the original and 
     * thumbnails to be used in the website, for use on the gallery and 
     * transformation tool.
     */
    public function create() {
        // Upload configuration object
        $config = array(
            'upload_path'   => $this->get_upload_path(),
            'allowed_types' => "gif|jpg|png|jpeg|pdf|svg",
            'overwrite'     => TRUE,
            'max_size'      => "2048000"
        );

        // Load form helper
        $this->load->helper('form');
        
        // Load upload library width a given configuration
        $this->load->library('upload', $config);
        
        // Process uploaded data and redirect back to gallery
        if($this->upload->do_upload('data')) {
            $uploaded_data = $this->upload->data();
            $this->process_upload($uploaded_data);
            redirect('/gallery');
        }
        // Reload the form and present the error to the user, 
        // so that she can react
        else {
            $error = array('error' => $this->upload->display_errors());
            $data['error'] = $error;
            $this->load->view('templates/header');
            $this->load->view('gallery/create', $data);
            $this->load->view('templates/footer');
        }
    }
    
    /**
     * Retrieves the upload path for the current user, 
     * as stored in session.
     * 
     * @return string The upload path for the current 
     * session user.
     */
    private function get_upload_path() {
        $username = $this->session->userdata('username');
        return "./uploads/".$username."/";
    }
    
    /**
     * Processes the uploaded data, that is the image.
     * The process consists of storing 
     *      1) the original image 
     *      2) thumbnails for the website.
     * 
     * @param array $uploaded_data Associative array with 
     * the uploaded data metadata.
     */
    private function process_upload($uploaded_data) {
        $this->storeOriginal($upload_data);
        $this->storeThumbnails($upload_data);            
    }
    
    /**
     * Store the original image in the database. Note that during 
     * upload the image is store in the filesystem. 
     * It is not clear wereThe ultimate target must be defined. For now we
     * @param [[Type]] $upload_data [[Description]]
     */
    private function storeOriginal($upload_data) {
        // Where image is stored and it's type
        $filepath = $upload_data['full_path'];
        $filetype = $upload_data['file_type'];
        
        // Image properties
        $user_id    = $this->get_user_id();
        $conversion_method_id = $this->get_conversion_method_id();
        $name       = $this->input->post('name');
        $width      = $this->input->post('width');
        $height     = $this->input->post('height');
        $mime_type  = $this->input->post('mime_type');
        $size       = $this->input->post('size');        
        $data_url   = $this->toDataUrl(file_get_contents($filepath), $filetype);
        
        // Store image in db
        $this->images_model->create_image(
            $user_id,
            $conversion_method_id,
            $name,
            $width,
            $height,
            $mime_type,
            $data_url,
            $size
        );
    }
    
    private function storeThumbnails($upload_data) {
        if($upload_data['file_type'] != 'image/svg+xml') {
            $this->storeSingleThumbnail($upload_data, 128, 0, 'xs');
            $this->storeSingleThumbnail($upload_data, 256, 0, 'sm');
            $this->storeSingleThumbnail($upload_data, 512, 0, 'md');
            $this->storeSingleThumbnail($upload_data, 768, 0, 'lg');
            $this->storeSingleThumbnail($upload_data, 1024, 0, 'xl');
        }
    }
    
    private function storeSingleThumbnail($upload_data, $width, $height, $flag) {
        $original_path   = $upload_data['full_path'];
        $ext        = $upload_data['file_ext'];
        $raw_name   = $upload_data['raw_name'];
        $mime_type  = $upload_data['file_type'];
        $filetype   = $mime_type;
        
        // Image properties
        $original_id = $this->get_orginal_id($raw_name.$ext);
        $rflag       = $flag;
        $user_id     = $this->get_user_id();
        $conversion_method_id = $this->get_conversion_method_id();
        $name        = $raw_name."_$flag"."_thumb".$ext ;
        $width       = $width;
        $height      = $height;
        $mime_type   = $mime_type;
        $size        = NULL;        

        $filepath    = $upload_data['file_path'].$username."/".$name;
        $data_url    = $this->toDataUrl(file_get_contents($filepath), $filetype);

        // Image library configuration data
        $config['image_library']    = 'gd2';
        $config['source_image']     = $original_path;
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['thumb_marker']     = "_".$flag."_thumb";
        $config['width']            = $width;
        $config['height']           = $height;
        $config['remove_spaces']    = TRUE;        
        
        // Initialize image library with configuration data
        $this->image_lib->initialize($config);
        
        // Resize
        $status = $this->image_lib->resize();
        
        // Report errors, if any
        if (!$status) { die($this->image_lib->display_errors());}
        
        // Store thumbnail in database
        $this->thumbnails_model->create(
            $original_id, 
            $flag, 
            $user_id, 
            $conversion_method_id,
            $name,
            $width,
            $height,
            $mime_type,
            $data_url,
            $size
        );
        
        $this->image_lib->clear();
    }
    
    private function handle_error($errors) {
        echo $errors;
    }
    
    private function toDataUrl($blob, $mime) {
        return 'data:'.$mime.';base64,'.base64_encode($blob);
    }
    
    /**
     * Retrieves the user id of current user.
     * 
     * @return integer  The user id of current user.
     */
    private function get_user_id() {
        // Current user's username
        $username = $this->input->post('username');
        
        // Ask users model for a user
        $this->load->model('users_model');
        $user = $this->users_model->get_user_with_name($username);
        
        // Return the user_id
        return $user['user_id'];
    }
    
    /**
     * Retrieves the conversion method id of the conversion method 
     * in post request.
     * 
     * @return integer  The conversion method id.
     */
    private function get_conversion_method_id() {
        $type = $this->input->post('conversion_method');
        
        // TODO: Load conversion_method_model
        $this->load->model('conversion_methods');
        
        // TODO: Retrieve conversion method from db where type=$method
        $cmethod = $this->conversion_methods->read_with_type($type);
        
        // TODO: Extracts the conversion_method_id from db object
        return $cmethod['conversion_method_id'];
    }
}
