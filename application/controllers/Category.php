<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Category_model');
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
        $data['page_title'] = 'Manajemen Kategori Barang';
        $data['categories'] = $this->Category_model->get_all();

        $this->load->view('layouts/header', $data);
        $this->load->view('category/index', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Category_model->insert($data)) {
                $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan!');
                redirect('category');
            }
        }

        $data['page_title'] = 'Tambah Kategori';
        $this->load->view('layouts/header', $data);
        $this->load->view('category/form', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id)
    {
        $category = $this->Category_model->get_by_id($id);
        if (!$category) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            $data = [
                'nama_kategori' => $this->input->post('nama_kategori', true),
                'deskripsi' => $this->input->post('deskripsi', true),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Category_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
                redirect('category');
            }
        }

        $data['page_title'] = 'Edit Kategori';
        $data['category'] = $category;
        $this->load->view('layouts/header', $data);
        $this->load->view('category/form', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($id)
    {
        if ($this->Category_model->delete($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kategori!');
        }
        redirect('category');
    }
}
?>