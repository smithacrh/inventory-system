<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cutting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cutting_model');
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
        $data['title'] = 'Manajemen Pemotongan Barang';
        $data['cuttings'] = $this->Cutting_model->get_all();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('cutting/list', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        $data['title'] = 'Tambah Pemotongan';
        $data['items'] = $this->Item_model->get_all();
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('item_id', 'Barang', 'required');
            $this->form_validation->set_rules('quantity', 'Jumlah Pemotongan', 'required|numeric');
            $this->form_validation->set_rules('cutting_date', 'Tanggal Pemotongan', 'required');
            $this->form_validation->set_rules('notes', 'Catatan', '');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('cutting/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $insert_data = array(
                    'item_id' => $this->input->post('item_id'),
                    'quantity' => $this->input->post('quantity'),
                    'cutting_date' => $this->input->post('cutting_date'),
                    'notes' => $this->input->post('notes'),
                    'created_by' => $this->session->userdata('user_id'),
                    'created_at' => date('Y-m-d H:i:s')
                );

                if ($this->Cutting_model->insert($insert_data)) {
                    // Update stock
                    $item = $this->Item_model->get_by_id($this->input->post('item_id'));
                    $new_stock = $item->stock - $this->input->post('quantity');
                    $this->Item_model->update($this->input->post('item_id'), array('stock' => $new_stock));

                    $this->session->set_flashdata('success', 'Pemotongan berhasil ditambahkan');
                    redirect('cutting');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('cutting/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Pemotongan';
        $data['cutting'] = $this->Cutting_model->get_by_id($id);
        $data['items'] = $this->Item_model->get_all();
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('item_id', 'Barang', 'required');
            $this->form_validation->set_rules('quantity', 'Jumlah Pemotongan', 'required|numeric');
            $this->form_validation->set_rules('cutting_date', 'Tanggal Pemotongan', 'required');
            $this->form_validation->set_rules('notes', 'Catatan', '');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('cutting/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $update_data = array(
                    'item_id' => $this->input->post('item_id'),
                    'quantity' => $this->input->post('quantity'),
                    'cutting_date' => $this->input->post('cutting_date'),
                    'notes' => $this->input->post('notes'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                if ($this->Cutting_model->update($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Pemotongan berhasil diupdate');
                    redirect('cutting');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('cutting/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function delete($id)
    {
        if ($this->Cutting_model->delete($id)) {
            $this->session->set_flashdata('success', 'Pemotongan berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pemotongan');
        }
        redirect('cutting');
    }

}
?>