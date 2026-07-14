<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Production_model');
        $this->load->model('Item_model');
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
        $data['title'] = 'Manajemen Produksi Barang';
        $data['productions'] = $this->Production_model->get_all();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('production/list', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        $data['title'] = 'Tambah Produksi';
        $data['items'] = $this->Item_model->get_all();
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('item_id', 'Barang', 'required');
            $this->form_validation->set_rules('quantity', 'Jumlah', 'required|numeric');
            $this->form_validation->set_rules('production_date', 'Tanggal Produksi', 'required');
            $this->form_validation->set_rules('notes', 'Catatan', '');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('production/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $insert_data = array(
                    'item_id' => $this->input->post('item_id'),
                    'quantity' => $this->input->post('quantity'),
                    'production_date' => $this->input->post('production_date'),
                    'notes' => $this->input->post('notes'),
                    'created_by' => $this->session->userdata('user_id'),
                    'created_at' => date('Y-m-d H:i:s')
                );

                if ($this->Production_model->insert($insert_data)) {
                    // Update stock
                    $item = $this->Item_model->get_by_id($this->input->post('item_id'));
                    $new_stock = $item->stock + $this->input->post('quantity');
                    $this->Item_model->update($this->input->post('item_id'), array('stock' => $new_stock));

                    $this->session->set_flashdata('success', 'Produksi berhasil ditambahkan');
                    redirect('production');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('production/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Produksi';
        $data['production'] = $this->Production_model->get_by_id($id);
        $data['items'] = $this->Item_model->get_all();
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('item_id', 'Barang', 'required');
            $this->form_validation->set_rules('quantity', 'Jumlah', 'required|numeric');
            $this->form_validation->set_rules('production_date', 'Tanggal Produksi', 'required');
            $this->form_validation->set_rules('notes', 'Catatan', '');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('production/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $update_data = array(
                    'item_id' => $this->input->post('item_id'),
                    'quantity' => $this->input->post('quantity'),
                    'production_date' => $this->input->post('production_date'),
                    'notes' => $this->input->post('notes'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                if ($this->Production_model->update($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Produksi berhasil diupdate');
                    redirect('production');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('production/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function delete($id)
    {
        if ($this->Production_model->delete($id)) {
            $this->session->set_flashdata('success', 'Produksi berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produksi');
        }
        redirect('production');
    }

}
?>