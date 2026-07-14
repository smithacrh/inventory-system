<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['Item_model', 'Category_model']);
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
        $data['page_title'] = 'Manajemen Stok Barang';
        $data['items'] = $this->Item_model->get_all_with_category();

        $this->load->view('layouts/header', $data);
        $this->load->view('item/index', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $data = [
                'kategori_id' => $this->input->post('kategori_id', true),
                'nama_barang' => $this->input->post('nama_barang', true),
                'sku' => $this->input->post('sku', true),
                'harga_satuan' => $this->input->post('harga_satuan', true),
                'stok' => $this->input->post('stok', true),
                'minimum_stok' => $this->input->post('minimum_stok', true),
                'satuan' => $this->input->post('satuan', true),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Item_model->insert($data)) {
                $this->session->set_flashdata('success', 'Barang berhasil ditambahkan!');
                redirect('item');
            }
        }

        $data['page_title'] = 'Tambah Barang';
        $data['categories'] = $this->Category_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('item/form', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id)
    {
        $item = $this->Item_model->get_by_id($id);
        if (!$item) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            $data = [
                'kategori_id' => $this->input->post('kategori_id', true),
                'nama_barang' => $this->input->post('nama_barang', true),
                'sku' => $this->input->post('sku', true),
                'harga_satuan' => $this->input->post('harga_satuan', true),
                'stok' => $this->input->post('stok', true),
                'minimum_stok' => $this->input->post('minimum_stok', true),
                'satuan' => $this->input->post('satuan', true),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Item_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Barang berhasil diperbarui!');
                redirect('item');
            }
        }

        $data['page_title'] = 'Edit Barang';
        $data['item'] = $item;
        $data['categories'] = $this->Category_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('item/form', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($id)
    {
        if ($this->Item_model->delete($id)) {
            $this->session->set_flashdata('success', 'Barang berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus barang!');
        }
        redirect('item');
    }

    public function get_stock($id)
    {
        $this->output->set_content_type('application/json');
        $item = $this->Item_model->get_by_id($id);
        echo json_encode($item);
    }
}
?>