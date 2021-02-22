<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Comic_model', 'm_comic');
    }

    public function index()
    {
        $data['url_img'] = base_url('assets/images/comic/');
        $data['title'] = "Home Page";
        $data['hotComics'] = $this->m_comic->getHotComics(4, 1);
        $data['allComics'] = $this->m_comic->getHotComics(10, 5);
        $this->load->view('home/index', $data);
    }
}
