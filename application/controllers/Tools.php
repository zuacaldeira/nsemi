<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->model('images_model');
    }
    
    public function index() {
        $data['title'] = 'Nsemi Image Transformation Tool';
        $data['original'] = null;
        
        $this->load->view('templates/header');
        $this->load->view('tools/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($name = NULL) {
        if($name === NULL) {
            show_404();
        }
        
        // Load thumbnail (contains info about original image)
        $this->load->model('thumbnails_model');
        $thumbnail = $this->thumbnails_model->read_with_name($name);

        $data['title'] = 'Nsemi Image Transformation Tool';
        $data['image'] = $thumbnail;
        
        $this->load->view('templates/header');
        $this->load->view('tools/index', $data);
        $this->load->view('templates/footer');
    }
    
    private function toDataUrl($blob) {
        return 'data:image/jpeg;base64,' . base64_encode($blob);
    }
    
    public function resize_one() {
        $data = $this->session->userdata('data');  
        
        $data['title'] = 'Nsemi Image Resize Tool';        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('width', 'Width', 'required');
        $this->form_validation->set_rules('height', 'Height', 'required');
        
        if($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header');
            $this->load->view('tools/resize_one', $data);
            $this->load->view('templates/footer');
        }
        
        else {
            $session_data = $this->session->userdata('data');
            $width = $this->input->post('width');
            $height = $this->input->post('height');
            
            $resized = $this->do_resize($session_data, $width, $height);
            
            $data['resized'] = $resized;
            $data['width'] = $width;
            $data['height'] = $height;
            
            $this->load->view('templates/header');
            $this->load->view('tools/resize_one', $data);
            $this->load->view('templates/footer');
        }
    }
    
    private function do_resize($data, $width, $height) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $data['path'];
        $config['create_thumb'] = FALSE;
        $config['thumb_marker'] = "_resized";
        $config['maintain_ratio'] = FALSE;
        $config['width']         = $width;
        $config['height']       = $height;
        
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        $status = $this->image_lib->resize();
        $this->image_lib->clear();
        
        if(!$status) {
            echo $this->handle_error($this->image_lib->display_errors());
        }
        else {
            return $this->toDataUrl(file_get_contents($data['path']));
        }
    }

}