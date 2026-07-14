<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->check_login();
    }

    private function check_login()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = 'Manajemen Kategori Barang';
        $data['categories'] = $this->Category_model->get_all();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('category/list', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        $data['title'] = 'Tambah Kategori';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('category_name', 'Nama Kategori', 'required|is_unique[categories.category_name]');
            $this->form_validation->set_rules('description', 'Deskripsi', '');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('category/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $insert_data = array(
                    'category_name' => $this->input->post('category_name'),
                    'description' => $this->input->post('description'),
                    'created_at' => date('Y-m-d H:i:s')
                );

                if ($this->Category_model->insert($insert_data)) {
                    $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan');
                    redirect('category');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('category/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Kategori';
        $data['category'] = $this->Category_model->get_by_id($id);
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('category_name', 'Nama Kategori', 'required');
            $this->form_validation->set_rules('description', 'Deskripsi', '');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('category/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $update_data = array(
                    'category_name' => $this->input->post('category_name'),
                    'description' => $this->input->post('description'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                if ($this->Category_model->update($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Kategori berhasil diupdate');
                    redirect('category');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('category/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function delete($id)
    {
        if ($this->Category_model->delete($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kategori');
        }
        redirect('category');
    }

}
?>