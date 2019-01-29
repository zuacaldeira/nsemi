<?php

class VGuides extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }
    
    public function index() {
        $data['title'] = 'Video Guides';
        $this->load->view('templates/header', $data);
        $this->load->view('vguides/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function view($name = NULL) {
        if($name === NULL) {
            show_404();
        }
        
        $video = file_get_contents($name);
        $data['title'] = $new_name;
        $data['name'] = $new_name;
        $data['video'] = $video;
        
        
        $this->load->view('templates/header', $data);
        $this->load->view("vguides/view", $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->processForm();
    }
    
    public function upload() {
        $this->processUpload();
    }
    
    private function processForm() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules(
            'title', 'Title', 'trim|required');
        $this->form_validation->set_rules(
            'description', 'Description', 'trim|required');
        $this->form_validation->set_rules(
            'video', 'Video', 'required');
        $this->form_validation->set_error_delimiters(
            '<div class="text-danger">', '</div>');
        
        
        if($this->form_validation->run() === FALSE) {
            $data['title'] = 'Video Guides';
            $this->load->view('templates/header', $data);
            $this->load->view('vguides/create', $data);
            $this->load->view('templates/footer');
        }
    }
    
    private function processUpload() {
        $config = array(
            'upload_path'   => "./uploads/videos/",
            'allowed_types' => "mp4",
            'overwrite'     => TRUE,
            'max_size'      => "10240000"
        );

        $this->load->library('upload');
        $this->upload->initialize($config);
        
        if($this->upload->do_upload('video')) {
            echo 'Need to store in DB...';
            
            $upload_data = $this->upload->data();
            echo json_encode($upload_data);
            
            $vguide = [
                'title' => $this->input->post('title'),
                'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                'description' => $this->input->post('description'),
                'data' => file_get_contents($upload_data['full_path']),
                'size' => $upload_data['file_size']
            ];
            echo json_encode($vguide);
            
            $this->load->model('vguides_model');
            $this->vguides_model->set_vguides($vguide);
            redirect('/vguides');
        }
        else {
            $this->load->helper('form');

            $errors = array('error' => $this->upload->display_errors());
            echo $errors['error'];
            
            $data['title'] = 'Video Guides';
            $data['errors'] = $errors;
            $this->load->view('templates/header', $data);
            $this->load->view('vguides/create', $data);
            $this->load->view('templates/footer');
        }
    }
    
    
    private function handle_error($errors) {
        echo $errors;
    }
    
}
