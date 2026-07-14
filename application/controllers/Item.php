<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Item_model');
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
        $data['title'] = 'Manajemen Stok Barang';
        $data['items'] = $this->Item_model->get_all();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('item/list', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        $data['title'] = 'Tambah Barang';
        $data['categories'] = $this->Category_model->get_all();
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('item_name', 'Nama Barang', 'required');
            $this->form_validation->set_rules('category_id', 'Kategori', 'required');
            $this->form_validation->set_rules('stock', 'Stok', 'required|numeric');
            $this->form_validation->set_rules('unit', 'Satuan', 'required');
            $this->form_validation->set_rules('price', 'Harga', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('item/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $insert_data = array(
                    'item_name' => $this->input->post('item_name'),
                    'category_id' => $this->input->post('category_id'),
                    'stock' => $this->input->post('stock'),
                    'unit' => $this->input->post('unit'),
                    'price' => $this->input->post('price'),
                    'created_at' => date('Y-m-d H:i:s')
                );

                if ($this->Item_model->insert($insert_data)) {
                    $this->session->set_flashdata('success', 'Barang berhasil ditambahkan');
                    redirect('item');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('item/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Barang';
        $data['item'] = $this->Item_model->get_by_id($id);
        $data['categories'] = $this->Category_model->get_all();
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('item_name', 'Nama Barang', 'required');
            $this->form_validation->set_rules('category_id', 'Kategori', 'required');
            $this->form_validation->set_rules('stock', 'Stok', 'required|numeric');
            $this->form_validation->set_rules('unit', 'Satuan', 'required');
            $this->form_validation->set_rules('price', 'Harga', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('item/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $update_data = array(
                    'item_name' => $this->input->post('item_name'),
                    'category_id' => $this->input->post('category_id'),
                    'stock' => $this->input->post('stock'),
                    'unit' => $this->input->post('unit'),
                    'price' => $this->input->post('price'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                if ($this->Item_model->update($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Barang berhasil diupdate');
                    redirect('item');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('item/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function delete($id)
    {
        if ($this->Item_model->delete($id)) {
            $this->session->set_flashdata('success', 'Barang berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus barang');
        }
        redirect('item');
    }

    public function get_stock($id)
    {
        $item = $this->Item_model->get_by_id($id);
        echo json_encode(array('stock' => $item->stock, 'price' => $item->price));
    }

}
?>