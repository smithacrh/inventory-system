<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['Delivery_model', 'Consumer_model', 'Item_model']);
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
        $data['page_title'] = 'Manajemen Surat Jalan';
        $data['deliveries'] = $this->Delivery_model->get_all_with_consumer();

        $this->load->view('layouts/header', $data);
        $this->load->view('delivery/index', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $konsumen_id = $this->input->post('konsumen_id', true);
            $item_id = $this->input->post('item_id', true);
            $jumlah = $this->input->post('jumlah', true);
            $no_surat = $this->input->post('no_surat', true);

            $data = [
                'no_surat_jalan' => $no_surat,
                'konsumen_id' => $konsumen_id,
                'item_id' => $item_id,
                'jumlah_pengiriman' => $jumlah,
                'tanggal_pengiriman' => date('Y-m-d'),
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Delivery_model->insert($data)) {
                // Update stok
                $this->Item_model->update_stock($item_id, $jumlah, 'subtract');
                $this->session->set_flashdata('success', 'Surat jalan berhasil ditambahkan dan stok diperbarui!');
                redirect('delivery');
            }
        }

        $data['page_title'] = 'Tambah Surat Jalan';
        $data['consumers'] = $this->Consumer_model->get_all();
        $data['items'] = $this->Item_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('delivery/form', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id)
    {
        $delivery = $this->Delivery_model->get_by_id($id);
        if (!$delivery) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            $jumlah_baru = $this->input->post('jumlah', true);
            $selisih = $jumlah_baru - $delivery->jumlah_pengiriman;

            $data = [
                'konsumen_id' => $this->input->post('konsumen_id', true),
                'item_id' => $this->input->post('item_id', true),
                'jumlah_pengiriman' => $jumlah_baru,
                'tanggal_pengiriman' => $this->input->post('tanggal_pengiriman', true),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Delivery_model->update($id, $data)) {
                if ($selisih != 0) {
                    $this->Item_model->update_stock($delivery->item_id, abs($selisih), ($selisih > 0 ? 'subtract' : 'add'));
                }
                $this->session->set_flashdata('success', 'Surat jalan berhasil diperbarui!');
                redirect('delivery');
            }
        }

        $data['page_title'] = 'Edit Surat Jalan';
        $data['delivery'] = $delivery;
        $data['consumers'] = $this->Consumer_model->get_all();
        $data['items'] = $this->Item_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('delivery/form', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($id)
    {
        $delivery = $this->Delivery_model->get_by_id($id);
        if ($delivery && $this->Delivery_model->delete($id)) {
            $this->Item_model->update_stock($delivery->item_id, $delivery->jumlah_pengiriman, 'add');
            $this->session->set_flashdata('success', 'Surat jalan berhasil dihapus dan stok diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus surat jalan!');
        }
        redirect('delivery');
    }

    public function print_surat_jalan($id)
    {
        $data['delivery'] = $this->Delivery_model->get_by_id($id);
        if (!$data['delivery']) {
            show_404();
        }

        $this->load->view('delivery/print', $data);
    }
}
?>