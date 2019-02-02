<?php

class Gallery extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->library('image_lib');
    }
    
    public function index() {
        $data['title'] = 'Gallery';
        $images = null;
        try {
            $this->load->model('thumbnails_model');
            $images = $this->thumbnails_model->read_all_with_flag("sm");
            
            $data['images'] = $images;
            $this->load->view('templates/header', $data);
            $this->load->view('gallery/index', $data);
            $this->load->view('templates/footer');
        } catch(Exception $ex) {
            show_404();
        }
    }
    
    public function view($name = NULL) {
        if($name === NULL) {
            show_404();
        }
        
        $new_name = str_replace('_sm_thumb', '_lg_thumb', $name);

        $data['title'] = $new_name;
        $data['name'] = $new_name;
        $data['image'] = $this->images_model->get_images_by_name($new_name);
        
        
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
        $user_id    = $this->get_session_user_id();
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
        $config['image_library']    = 'gd2';
        $config['source_image']     = $upload_data['full_path'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['thumb_marker']     = "_".$flag."_thumb";
        $config['width']            = $width;
        $config['height']           = $height;
        $config['remove_spaces']    = TRUE;        
        
        $this->image_lib->initialize($config);
        $status = $this->image_lib->resize();
        
        if (!$status) { die($this->image_lib->display_errors());}
        
        $data['name'] = $upload_data['raw_name'] 
            ."_$flag"
            . "_thumb" 
            . $upload_data['file_ext'] ;
        $data['type'] = $upload_data['file_type'];
        $data['path'] = $upload_data['file_path'].$data['name'];
        $data['data_url'] = $this->toDataUrl(
            file_get_contents($data['path']),
            $upload_data['file_type']
        );
        echo 'path: '.$upload_data['file_path'].$data['name'];
        $data['thumb'] = true;
        $data['owner'] = $upload_data['owner'];

        $this->images_model->set_images($data);
        $this->image_lib->clear();
    }
    
    private function handle_error($errors) {
        echo $errors;
    }
    
    private function toDataUrl($blob, $mime) {
        return 'data:'.$mime.';base64,'.base64_encode($blob);
    }
    
    
    
}
