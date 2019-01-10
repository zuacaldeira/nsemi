<?php

class Gallery extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('images_model');
        $this->load->helper('url_helper');
        $this->load->library('image_lib');
    }
    
    public function index() {
        $data['images'] = $this->images_model->get_thumbs();
        $data['title'] = 'Gallery';
        
        $this->load->view('templates/header', $data);
        $this->load->view('gallery/index', $data);
        $this->load->view('templates/footer');
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

    public function create() {
        $config = array(
            'upload_path'   => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite'     => TRUE,
            'max_size'      => "2048000");

        $this->load->helper('form');
        $this->load->library('upload', $config);
        
        if($this->upload->do_upload('data')) {
            $upload_data = $this->upload->data();
            $upload_data['owner'] = $this->session->userdata('username');
            $this->storeOriginal($upload_data);
            $this->storeThumbnails($upload_data);
            
            redirect('/gallery');
        }
        else {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('templates/header');
            $this->load->view('gallery/create', $error);
            $this->load->view('templates/footer', $error);
        }
    }
    
    private function toDataUrl($blob) {
        return 'data:image/jpg;base64,' . base64_encode($blob);
    }
    
    private function storeOriginal($upload_data) {
        $data['data'] = $upload_data;
        $data['name'] = $upload_data['file_name'];
        $data['type'] = $upload_data['file_type'];
        $data['path'] = $upload_data['full_path'];
        $data['size'] = $upload_data['file_size'];
        $data['thumb'] = false;
        $data['owner'] = $upload_data['owner'];

        $data['data_url'] = $this->toDataUrl(file_get_contents($data['path']));
        $this->images_model->set_images($data);
    }
    
    private function storeThumbnails($upload_data) {
        $this->storeSingleThumbnail($upload_data, 128, 0, 'xs');
        $this->storeSingleThumbnail($upload_data, 256, 0, 'sm');
        $this->storeSingleThumbnail($upload_data, 512, 0, 'md');
        $this->storeSingleThumbnail($upload_data, 768, 0, 'lg');
        $this->storeSingleThumbnail($upload_data, 1024, 0, 'xl');
    }
    
    private function storeSingleThumbnail($upload_data, $width, $height, $flag) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $upload_data['full_path'];
        $config['create_thumb'] = TRUE;
        $config['thumb_marker'] = "_".$flag."_thumb";
        $config['maintain_ratio'] = TRUE;
        $config['width']         = $width;
        $config['height']       = $height;
        
        $this->image_lib->initialize($config);
        $status = $this->image_lib->resize();
        $this->image_lib->clear();
        
        if(!$status) {
            echo $this->handle_error($this->image_lib->display_errors());
        }
        else {
            $data['name'] = $upload_data['raw_name'] 
                ."_$flag"
                . "_thumb" 
                . $upload_data['file_ext'] ;
            $data['type'] = 'image/'.$upload_data['image_type'];
            $data['path'] = $upload_data['file_path'].$data['name'];
            $data['data_url'] = $this->toDataUrl(
                file_get_contents($data['path'])
            );
            $data['thumb'] = true;
            $data['owner'] = $upload_data['owner'];

            $this->images_model->set_images($data);
            return $data;
        }
    }
    
}
