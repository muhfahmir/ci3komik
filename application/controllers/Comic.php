<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comic extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Comic_model', 'm_comic');
    }

    public function index()
    {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "comic/index";

        if (isset($_POST['submit'])) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            if (isset($_SESSION['keyword'])) {
                $data['keyword'] = $_SESSION['keyword'];
            } else {
                $data['keyword'] = null;
            }
        }

        $config['total_rows'] = $this->m_comic->countAllComics($data['keyword']);

        //pembuka containernya
        $config['full_tag_open'] = '<nav><ul class="justify-content-center pagination">';
        //penutup containernya
        $config['full_tag_close'] = '</ul>';

        //pembuka untuk first page
        $config['first_tag_open'] = '<li class="page-item">';
        //penutup untuk first page
        $config['first_tag_close'] = '</li>';

        // pembuka untuk last page
        $config['last_tag_open'] = '<li class="page-item"> ';
        //penutup untuk last page
        $config['last_tag_close'] = '</li>';

        //kata/hal yang ditampilin untuk 
        //next link
        $config['next_link'] = '&raquo';
        //pembuka untuk next-link
        $config['next_tag_open'] = '<li class="page-item">';
        //penutup untuk next-link
        $config['next_tag_close'] = '</li>';

        //kata/hal yang ditampilin untuk 
        //next link
        $config['prev_link'] = '&raquo';
        //pembuka untuk prev-link
        $config['prev_tag_open'] = '<li class="page-item">';
        //penutup untuk prev-link
        $config['prev_tag_close'] = '</li>';

        //pembuka untuk halaman saat ini
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        //penutup untuk halaman saat ini
        $config['cur_tag_close'] = '</a></li>';

        //pembuka untuk nomor2nya
        $config['num_tag_open'] = '<li class="page-item">';
        //penutup untuk nomor2nya
        $config['num_tag_close'] = '</li>';

        // atribut tambahan untuk setiap anchornya.
        $config['attributes'] = ['class' => 'page-link'];

        $config['per_page'] = 10;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        $data['title'] = "All Komik Page";
        $data['allComics'] = $this->m_comic->getHotComics($config['per_page'], $data['start'], $data['keyword']);
        $data['url_img'] = base_url('assets/images/comic/');
        $this->load->view('home/allcomic', $data);
    }

    public function detail($id)
    {
        $data['comic'] = $this->m_comic->getComic($id);
        $data['title'] = 'Komik ' . $data['comic']['judul'] . ' | BacaBersama';
        $data['genres'] = $this->m_comic->getAllGenre();
        $data['genreComics'] = $this->m_comic->getDetailComic($id);
        $data['relatedComic'] = $this->m_comic->getRelatedComic($data['comic']['jenis']);
        $this->load->view('home/detail', $data);
    }

    public function unsetKeyword()
    {
        $this->session->set_userdata('keyword', null);
    }
}
