<?php

class Gallery extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('images_model');
        $this->load->helper('url_helper');
    }
    
    public function index() {
        $data['images'] = $this->images_model->get_images();
        $data['title'] = 'Images Gallery';
        
        $this->load->view('templates/header', $data);
        $this->load->view('gallery/index', $data);
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
            $data['data'] = $upload_data;
            $data['name'] = $upload_data['file_name'];
            $data['type'] = $upload_data['file_type'];
            $data['path'] = $upload_data['file_path'];
            //$data['width'] = $upload_data['width'];
            //$data['height'] = $upload_data['height'];
            $data['size'] = $upload_data['file_size'];
            
            $data['data_url'] = $this->toDataUrl(file_get_contents('./uploads/'.$data['name']));
            
            $this->images_model->set_images($data);
            $this->load->view('gallery/success', $data);
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
    
}
