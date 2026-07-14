<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Consumer_model');
        $this->_check_login();
    }

    private function _check_login()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['page_title'] = 'Manajemen Konsumen';
        $search = $this->input->get('search', true);
        
        if ($search) {
            $data['consumers'] = $this->Consumer_model->search($search);
        } else {
            $data['consumers'] = $this->Consumer_model->get_all();
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('consumer/index', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $data = [
                'nama_konsumen' => $this->input->post('nama_konsumen', true),
                'alamat' => $this->input->post('alamat', true),
                'telepon' => $this->input->post('telepon', true),
                'email' => $this->input->post('email', true),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Consumer_model->insert($data)) {
                $this->session->set_flashdata('success', 'Konsumen berhasil ditambahkan!');
                redirect('consumer');
            }
        }

        $data['page_title'] = 'Tambah Konsumen';
        $this->load->view('layouts/header', $data);
        $this->load->view('consumer/form', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id)
    {
        $consumer = $this->Consumer_model->get_by_id($id);
        if (!$consumer) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            $data = [
                'nama_konsumen' => $this->input->post('nama_konsumen', true),
                'alamat' => $this->input->post('alamat', true),
                'telepon' => $this->input->post('telepon', true),
                'email' => $this->input->post('email', true),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Consumer_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Konsumen berhasil diperbarui!');
                redirect('consumer');
            }
        }

        $data['page_title'] = 'Edit Konsumen';
        $data['consumer'] = $consumer;
        $this->load->view('layouts/header', $data);
        $this->load->view('consumer/form', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($id)
    {
        if ($this->Consumer_model->delete($id)) {
            $this->session->set_flashdata('success', 'Konsumen berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus konsumen!');
        }
        redirect('consumer');
    }
}
?>