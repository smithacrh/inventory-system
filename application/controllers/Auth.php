<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
    }

    public function index()
    {
        redirect('auth/login');
    }

    public function login()
    {
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        if ($this->input->method() === 'post') {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);

            $user = $this->User_model->get_by_username($username);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'nama_lengkap' => $user->nama_lengkap,
                    'role' => $user->role,
                    'is_logged_in' => true
                ]);

                $this->session->set_flashdata('success', 'Login berhasil!');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah!');
            }
        }

        $this->load->view('auth/login');
    }

    public function register()
    {
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        if ($this->input->method() === 'post') {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $confirm_password = $this->input->post('confirm_password', true);
            $nama_lengkap = $this->input->post('nama_lengkap', true);

            if ($password !== $confirm_password) {
                $this->session->set_flashdata('error', 'Password tidak sesuai!');
                redirect('auth/register');
            }

            if ($this->User_model->get_by_username($username)) {
                $this->session->set_flashdata('error', 'Username sudah terdaftar!');
                redirect('auth/register');
            }

            $data = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'nama_lengkap' => $nama_lengkap,
                'role' => 2, // Default operator assembly
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->User_model->insert($data)) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/register');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Logout berhasil!');
        redirect('auth/login');
    }
}
?>