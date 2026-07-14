<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('User_model');
        $this->_check_login();
        $this->_check_admin();
    }

    private function _check_login()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth/login');
        }
    }

    private function _check_admin()
    {
        if ($this->session->userdata('role') != 1) {
            show_404();
        }
    }

    public function index()
    {
        $data['page_title'] = 'Manajemen User';
        $data['users'] = $this->User_model->get_all();

        $this->load->view('layouts/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $username = $this->input->post('username', true);

            if ($this->User_model->get_by_username($username)) {
                $this->session->set_flashdata('error', 'Username sudah digunakan!');
                redirect('user/add');
            }

            $data = [
                'username' => $username,
                'password' => password_hash($this->input->post('password', true), PASSWORD_BCRYPT),
                'nama_lengkap' => $this->input->post('nama_lengkap', true),
                'role' => $this->input->post('role', true),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->User_model->insert($data)) {
                $this->session->set_flashdata('success', 'User berhasil ditambahkan!');
                redirect('user');
            }
        }

        $data['page_title'] = 'Tambah User';
        $data['roles'] = [
            1 => 'Admin',
            2 => 'Operator Assembly',
            3 => 'Operator Cutting',
            4 => 'Driver'
        ];
        $this->load->view('layouts/header', $data);
        $this->load->view('user/form', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id)
    {
        $user = $this->User_model->get_by_id($id);
        if (!$user) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap', true),
                'role' => $this->input->post('role', true),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $password = $this->input->post('password', true);
            if ($password) {
                $data['password'] = password_hash($password, PASSWORD_BCRYPT);
            }

            if ($this->User_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'User berhasil diperbarui!');
                redirect('user');
            }
        }

        $data['page_title'] = 'Edit User';
        $data['user'] = $user;
        $data['roles'] = [
            1 => 'Admin',
            2 => 'Operator Assembly',
            3 => 'Operator Cutting',
            4 => 'Driver'
        ];
        $this->load->view('layouts/header', $data);
        $this->load->view('user/form', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($id)
    {
        if ($this->User_model->delete($id)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user!');
        }
        redirect('user');
    }
}
?>