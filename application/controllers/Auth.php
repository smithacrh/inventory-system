<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->login();
    }

    public function login()
    {
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['error'] = validation_errors();
                $this->load->view('auth/login', $data);
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $user = $this->User_model->get_user_by_username($username);

                if ($user && password_verify($password, $user->password)) {
                    $this->session->set_userdata('user_id', $user->id);
                    $this->session->set_userdata('username', $user->username);
                    $this->session->set_userdata('user_level', $user->level);
                    $this->session->set_userdata('user_name', $user->name);

                    redirect('dashboard');
                } else {
                    $data['error'] = 'Username atau password salah';
                    $this->load->view('auth/login', $data);
                }
            }
        } else {
            $this->load->view('auth/login');
        }
    }

    public function register()
    {
        if ($this->session->userdata('user_id')) {
            redirect('dashboard');
        }

        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]');
            $this->form_validation->set_rules('name', 'Nama', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['error'] = validation_errors();
                $this->load->view('auth/register', $data);
            } else {
                $data = array(
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'name' => $this->input->post('name'),
                    'level' => 4,
                    'created_at' => date('Y-m-d H:i:s')
                );

                if ($this->User_model->insert_user($data)) {
                    redirect('auth/login');
                } else {
                    $data['error'] = 'Gagal membuat akun';
                    $this->load->view('auth/register', $data);
                }
            }
        } else {
            $this->load->view('auth/register');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

}
?>