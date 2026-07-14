<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cutting extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['Cutting_model', 'Item_model']);
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
        $data['page_title'] = 'Manajemen Pemotongan Barang';
        $data['cuttings'] = $this->Cutting_model->get_all_with_item();

        $this->load->view('layouts/header', $data);
        $this->load->view('cutting/index', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        if ($this->input->method() === 'post') {
            $item_id = $this->input->post('item_id', true);
            $jumlah = $this->input->post('jumlah', true);
            $waste = $this->input->post('waste', true);
            $catatan = $this->input->post('catatan', true);

            $data = [
                'item_id' => $item_id,
                'jumlah_cutting' => $jumlah,
                'jumlah_waste' => $waste,
                'catatan' => $catatan,
                'created_by' => $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Cutting_model->insert($data)) {
                // Update stok (kurangi)
                $this->Item_model->update_stock($item_id, $jumlah + $waste, 'subtract');
                $this->session->set_flashdata('success', 'Pemotongan berhasil ditambahkan dan stok diperbarui!');
                redirect('cutting');
            }
        }

        $data['page_title'] = 'Tambah Pemotongan';
        $data['items'] = $this->Item_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('cutting/form', $data);
        $this->load->view('layouts/footer');
    }

    public function edit($id)
    {
        $cutting = $this->Cutting_model->get_by_id($id);
        if (!$cutting) {
            show_404();
        }

        if ($this->input->method() === 'post') {
            $jumlah_baru = $this->input->post('jumlah', true);
            $waste_baru = $this->input->post('waste', true);
            $total_old = $cutting->jumlah_cutting + $cutting->jumlah_waste;
            $total_new = $jumlah_baru + $waste_baru;
            $selisih = $total_new - $total_old;

            $data = [
                'item_id' => $this->input->post('item_id', true),
                'jumlah_cutting' => $jumlah_baru,
                'jumlah_waste' => $waste_baru,
                'catatan' => $this->input->post('catatan', true),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($this->Cutting_model->update($id, $data)) {
                if ($selisih != 0) {
                    $this->Item_model->update_stock($cutting->item_id, abs($selisih), ($selisih > 0 ? 'subtract' : 'add'));
                }
                $this->session->set_flashdata('success', 'Pemotongan berhasil diperbarui!');
                redirect('cutting');
            }
        }

        $data['page_title'] = 'Edit Pemotongan';
        $data['cutting'] = $cutting;
        $data['items'] = $this->Item_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('cutting/form', $data);
        $this->load->view('layouts/footer');
    }

    public function delete($id)
    {
        $cutting = $this->Cutting_model->get_by_id($id);
        if ($cutting && $this->Cutting_model->delete($id)) {
            $total = $cutting->jumlah_cutting + $cutting->jumlah_waste;
            $this->Item_model->update_stock($cutting->item_id, $total, 'add');
            $this->session->set_flashdata('success', 'Pemotongan berhasil dihapus dan stok diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pemotongan!');
        }
        redirect('cutting');
    }
}
?>