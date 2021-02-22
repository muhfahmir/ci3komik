<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'm_user');
    }

    public function index()
    {
        $data['title'] = "Login Page";

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            // $this->load->view('auth/templates/header', $data);
            $this->load->view('auth/login', $data);
            // $this->load->view('auth/templates/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->m_user->getUserByEmail($email);

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'name' => $user['name']
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('message2', '<small class=" text-danger">Password salah</small>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<small class="text-danger">Email belum diaktivasi</small>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<small class=" text-danger">Email belum terdaftar</small>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email', 'name');
        $this->session->set_flashdata('message3', '<div class="alert alert-success" role="alert">Anda berhasil logout!</div>');
        redirect('auth');
    }

    public function register()
    {
        $data['title'] = "register Page";
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'Password does not match!',
            'min_length' => 'Password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Confirm Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            // $this->load->view('auth/templates/header', $data);
            $this->load->view('auth/register', $data);
            // $this->load->view('auth/templates/footer');
        } else {
            $this->m_user->register();
            $this->session->set_flashdata('message3', '<div class="alert alert-success" role="alert">Berhasil register!</div>');
            redirect('auth');
        }
    }
}
