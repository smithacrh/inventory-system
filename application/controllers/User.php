<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->check_login();
        $this->check_admin();
    }

    private function check_login()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    private function check_admin()
    {
        if ($this->session->userdata('user_level') != 1) {
            show_error('Akses Ditolak - Hanya Admin yang dapat mengakses halaman ini', 403);
        }
    }

    public function index()
    {
        $data['title'] = 'Manajemen User';
        $data['users'] = $this->User_model->get_all();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('user/list', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        $data['title'] = 'Tambah User';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|matches[password]');
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('level', 'Level User', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('user/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $insert_data = array(
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'name' => $this->input->post('name'),
                    'level' => $this->input->post('level'),
                    'created_at' => date('Y-m-d H:i:s')
                );

                if ($this->User_model->insert($insert_data)) {
                    $this->session->set_flashdata('success', 'User berhasil ditambahkan');
                    redirect('user');
                }
            }
        } else {
            $data['levels'] = array(
                1 => 'Admin',
                2 => 'Operator Assembly',
                3 => 'Operator Cutting',
                4 => 'Driver'
            );
            $this->load->view('layouts/header', $data);
            $this->load->view('user/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit User';
        $data['user'] = $this->User_model->get_by_id($id);
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('level', 'Level User', 'required');
            
            if ($this->input->post('password')) {
                $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
                $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'matches[password]');
            }

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('user/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $update_data = array(
                    'name' => $this->input->post('name'),
                    'level' => $this->input->post('level'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                if ($this->input->post('password')) {
                    $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }

                if ($this->User_model->update($id, $update_data)) {
                    $this->session->set_flashdata('success', 'User berhasil diupdate');
                    redirect('user');
                }
            }
        } else {
            $data['levels'] = array(
                1 => 'Admin',
                2 => 'Operator Assembly',
                3 => 'Operator Cutting',
                4 => 'Driver'
            );
            $this->load->view('layouts/header', $data);
            $this->load->view('user/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function delete($id)
    {
        if ($this->User_model->delete($id)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user');
        }
        redirect('user');
    }

}
?>