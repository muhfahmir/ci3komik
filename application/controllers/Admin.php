<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Comic_model', 'm_comic');
        $this->load->model('User_model', 'm_user');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['users'] = $this->m_user->countAllUser();
        $data['genres'] = $this->m_comic->countAllGenre();
        $data['comics'] = $this->m_comic->countAllComics();
        $this->load->view('admin/index', $data);
    }

    // genre
    public function genre()
    {
        $data['title'] = "Genre";
        $this->form_validation->set_rules('nama_genre', 'Nama Genre', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['genres'] = $this->m_comic->getAllGenre();
            // $this->load->view('auth/templates/header', $data);
            $this->load->view('admin/genre/index', $data);
            // $this->load->view('auth/templates/footer');
        } else {
            // benar
            $this->m_comic->addGenre();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Genre berhasil di tambahkan!</div>');
            redirect('admin/genre');
        }
    }

    public function genre_edit($id)
    {
        $this->form_validation->set_rules('nama_genre', 'Nama Genre', 'required|trim');
        if ($this->form_validation->run()) {
            $this->m_comic->editGenre($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Genre berhasil di Edit!</div>');
            redirect('admin/genre');
        }
    }

    public function genre_delete($id)
    {
        $this->m_comic->delGenre($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Genre berhasil di delete!</div>');
        redirect('admin/genre');
    }

    // comic
    public function comic()
    {
        $data['title'] = "Comic";
        $data['comics'] = $this->m_comic->getAllComic();
        $data['url_img'] = base_url('assets/images/comic/');
        $this->load->view('admin/comic/index', $data);
    }

    public function comic_add()
    {
        $data['title'] = "Tambah Comic";
        $data['genres'] = $this->m_comic->getAllGenre();
        $data['status'] = $this->m_comic->getAllStatus();
        $this->form_validation->set_rules('judul', 'Judul Komik', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis Komik', 'required|trim');
        $this->form_validation->set_rules('penulis', 'Penulis Komik', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Komik', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Komik', 'required|trim');
        $this->form_validation->set_rules('rilis', 'Tahun Rilis Komik', 'required|trim');
        $this->form_validation->set_rules('usia_pembaca', 'Usia pembaca Komik', 'required|trim');
        $this->form_validation->set_rules('rating', 'Rating Komik', 'required|trim');
        // $this->form_validation->set_rules('is_active', 'Rating Komik', 'required|trim');

        if ($this->form_validation->run() == false) {
            // $this->load->view('auth/templates/header', $data);
            $this->load->view('admin/comic/tambah', $data);
            // $this->load->view('auth/templates/footer');
        } else {
            $genres = $this->input->post('genre');
            $upload_image = $_FILES['image']['name'];
            $judul = $this->input->post('judul');
            $new_image = "";
            if ($upload_image) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/images/comic';
                $config['file_name'] = time() . $judul;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    // $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // benar
            $dataparams = [
                'judul' => $judul,
                'jenis' => $this->input->post('jenis'),
                'penulis' => $this->input->post('penulis'),
                'deskripsi' => $this->input->post('deskripsi'),
                'status' => $this->input->post('status'),
                'rilis' => $this->input->post('rilis'),
                'usia_pembaca' => $this->input->post('usia_pembaca'),
                'rating' => $this->input->post('rating'),
                'imageUrl' => $new_image,
            ];
            if ($this->input->post('is_active') == "on") {
                $dataparams = array_merge($dataparams, ['is_active' => 1]);
            } else {
                $dataparams = array_merge($dataparams, ['is_active' => 0]);
            }
            // var_dump($dataparams);
            // die;
            // input data comic
            $this->m_comic->addComic($dataparams);

            // ambil id data comic
            $id_komik = $this->m_comic->getLastComic()['id_komik'];

            // perulangan data genre
            foreach ($genres as $genre) {
                $dataparamsComic = [
                    'id_comic' => $id_komik,
                    'id_genre' => $genre
                ];
                // input genre
                $this->m_comic->addDetailComic($dataparamsComic);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Comic berhasil di tambahkan!</div>');
            redirect('admin/comic');
        }
    }

    public function comic_edit($id)
    {
        $data['title'] = "Edit Comic";
        $data['comic'] = $this->m_comic->getComic($id);
        $data['genres'] = $this->m_comic->getAllGenre();
        $data['status'] = $this->m_comic->getAllStatus();
        $data['detailGenre'] = $this->m_comic->getDetailComic($id);

        $this->form_validation->set_rules('judul', 'Judul Komik', 'required|trim');
        $this->form_validation->set_rules('jenis', 'Jenis Komik', 'required|trim');
        $this->form_validation->set_rules('penulis', 'Penulis Komik', 'required|trim');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Komik', 'required|trim');
        $this->form_validation->set_rules('status', 'Status Komik', 'required|trim');
        $this->form_validation->set_rules('rilis', 'Tahun Rilis Komik', 'required|trim');
        $this->form_validation->set_rules('usia_pembaca', 'Usia pembaca Komik', 'required|trim');
        $this->form_validation->set_rules('rating', 'Rating Komik', 'required|trim');
        // $this->form_validation->set_rules('is_active', 'Rating Komik', 'required|trim');

        if ($this->form_validation->run() == false) {
            // $this->load->view('auth/templates/header', $data);
            $this->load->view('admin/comic/edit', $data);
            // $this->load->view('auth/templates/footer');
        } else {
            $genres = $this->input->post('genre');
            $upload_image = $_FILES['image']['name'];
            $judul = $this->input->post('judul');
            $new_image = $data['comic']['imageUrl'];
            if ($upload_image) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/images/comic';
                $config['file_name'] = time() . $judul;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['comic']['imageUrl'];
                    if ($old_image != "default.jpg") {
                        unlink(FCPATH . '/assets/images/comic/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    // $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            // benar
            $dataparams = [
                'judul' => $judul,
                'jenis' => $this->input->post('jenis'),
                'penulis' => $this->input->post('penulis'),
                'deskripsi' => $this->input->post('deskripsi'),
                'status' => $this->input->post('status'),
                'rilis' => $this->input->post('rilis'),
                'usia_pembaca' => $this->input->post('usia_pembaca'),
                'rating' => $this->input->post('rating'),
                'imageUrl' => $new_image,
            ];
            if ($this->input->post('is_active') == "on") {
                $dataparams = array_merge($dataparams, ['is_active' => 1]);
            } else {
                $dataparams = array_merge($dataparams, ['is_active' => 0]);
            }
            // var_dump($dataparams);
            $this->m_comic->delDetailComic($id);
            // die;
            // hapus detail comic
            // input data comic
            $this->m_comic->editComic($dataparams, $id);

            // ambil id data comic

            // perulangan data genre
            // die;
            foreach ($genres as $genre) {
                $dataparamsComic = [
                    'id_comic' => $id,
                    'id_genre' => $genre
                ];
                // input genre
                $this->m_comic->addDetailComic($dataparamsComic);
                var_dump($dataparamsComic);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Comic berhasil di Edit!</div>');
            redirect('admin/comic');
        }
    }

    public function comic_delete($id)
    {
        $comic = $this->m_comic->getComic($id);
        unlink(FCPATH . '/assets/images/comic/' . $comic['imageUrl']);
        // die;
        $this->m_comic->delComic($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Comic berhasil di delete!</div>');
        redirect('admin/comic');
    }

    // user
    public function user()
    {
        $data['title'] = "User";
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password does not match!',
            'min_length' => 'Password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data['users'] = $this->m_user->getAllUser();
            $this->load->view('admin/user/index', $data);
        } else {
            // benar
            $dataparams = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'date_created' => time(),
            ];
            if ($this->input->post('status') == "on") {
                $dataparams = array_merge($dataparams, ['is_active' => 1]);
            } else {
                $dataparams = array_merge($dataparams, ['is_active' => 0]);
            }

            $this->m_user->addUser($dataparams);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil ditambahkan!</div>');
            redirect('admin/user');
        }
    }

    public function user_edit($id)
    {

        $this->form_validation->set_rules('name', 'Nama Genre', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run()) {

            $dataparams = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email')
            ];
            if ($this->input->post('status') == "on") {
                $dataparams = array_merge($dataparams, ['is_active' => 1]);
            } else {
                $dataparams = array_merge($dataparams, ['is_active' => 0]);
            }
            // var_dump($dataparams);
            // die;

            $this->m_user->editUser($dataparams, $id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil di Edit!</div>');
            redirect('admin/user');
        }
    }

    public function user_delete($id)
    {
        $this->m_user->delUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User berhasil di delete!</div>');
        redirect('admin/user');
    }
}
