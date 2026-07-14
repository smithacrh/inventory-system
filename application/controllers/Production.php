<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['Production_model', 'Item_model']);
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
        $data['page_title'] = 'Manajemen Produksi Barang';
        $data['productions'] = $this->Production_model->get_all_with_item();

        $this->load->view('layouts/header', $data);
        $this->load->view('production/index', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $item_id = $this->input->post('item_id', true);
            $jumlah = $this->input->post('jumlah', true);
            $catatan = $this->input->post('catatan', true);

            $data = [
                'item_id' => $item_id,
                'jumlah_produksi' => $jumlah,
                'catatan' => $catatan,
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Production_model->insert($data)) {
                // Update stok
                $this->Item_model->update_stock($item_id, $jumlah, 'add');
                $this->session->set_flashdata('success', 'Produksi berhasil ditambahkan dan stok diperbarui!');
                redirect('production');
            }
        }

        $data['page_title'] = 'Tambah Produksi';
        $data['items'] = $this->Item_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('production/form', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id)
    {
        $production = $this->Production_model->get_by_id($id);
        if (!$production) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            $jumlah_baru = $this->input->post('jumlah', true);
            $selisih = $jumlah_baru - $production->jumlah_produksi;

            $data = [
                'item_id' => $this->input->post('item_id', true),
                'jumlah_produksi' => $jumlah_baru,
                'catatan' => $this->input->post('catatan', true),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Production_model->update($id, $data)) {
                if ($selisih != 0) {
                    $this->Item_model->update_stock($production->item_id, abs($selisih), ($selisih > 0 ? 'add' : 'subtract'));
                }
                $this->session->set_flashdata('success', 'Produksi berhasil diperbarui!');
                redirect('production');
            }
        }

        $data['page_title'] = 'Edit Produksi';
        $data['production'] = $production;
        $data['items'] = $this->Item_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('production/form', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($id)
    {
        $production = $this->Production_model->get_by_id($id);
        if ($production && $this->Production_model->delete($id)) {
            $this->Item_model->update_stock($production->item_id, $production->jumlah_produksi, 'subtract');
            $this->session->set_flashdata('success', 'Produksi berhasil dihapus dan stok diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus produksi!');
        }
        redirect('production');
    }
}
?>