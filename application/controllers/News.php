<?php

class News extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('news_model');
        $this->load->helper('url_helper');
    }
    
    public function index() {
        $data['news'] = $this->news_model->get_news();
        $data['title'] = 'News Archive';
        
        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');        
    }
    
    public function view($slug = NULL) {
        $article = $this->news_model->get_news($slug);
        if(empty($article)) {
            show_404();
        }
        
        $this->load->model('users_model');
        $user = $this->users_model->get_users($article['author']);

        $data['title'] = $article['title'];        
        $data['author'] = $user['firstname'] . ' ' . $user['lastname'];
        $data['date'] = $article['updatedAt'];
        $data['text'] = $article['text'];
        $data['owner'] = $user['username'];
        $data['slug'] = $article['slug'];
        $data['id'] = $article['id'];
        
        $data['session_user'] = $this->session->userdata('username');
        
        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer', $data);
    }
    
    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('text', 'Text', 'required|trim');
        
        if($this->form_validation->run() === FALSE) {
            $data['title'] = 'You are writing a new article...';
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');
        }
        else {
            $this->news_model->set_news();
            $this->load->view('news/success');
        }
    }
    
    public function update($slug = NULL) {
        if($slug === NULL) {
            show_404();
        }
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('text', 'Text', 'required|trim');
        
        $article = $this->news_model->get_news($slug);
        if($this->form_validation->run() === FALSE) {
            $data['title'] = 'You are updating a new article...';
            
            $_POST['title'] = $article['title'];
            $_POST['text'] = $article['text'];
            $_POST['slug'] = $article['slug'];
            $_POST['id'] = $article['id'];
            $_POST['createdAt'] = $article['createdAt'];
            
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');
        }
        else {
            /*$_POST['slug'] = $slug;
            $_POST['id'] = $article['id'];
            $_POST['createdAt'] = $article['createdAt'];
            */
            $this->news_model->set_news();
            $this->load->view('news/success');
        }
    }

}