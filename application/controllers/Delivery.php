<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->check_access(array(ROLE_ADMIN, ROLE_DRIVER));
        $this->load->model('Delivery_letter_model');
        $this->load->model('Delivery_letter_item_model');
        $this->load->model('Item_model');
    }

    public function index() {
        $data['page_title'] = 'Surat Jalan';
        $data['items'] = $this->Item_model->get_all();
        $this->load->view('layouts/header', $data);
        $this->load->view('delivery/index', $data);
        $this->load->view('layouts/footer');
    }

    public function get_datatable() {
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $type = $this->input->post('type');

        $data = $this->Delivery_letter_model->get_datatable();
        $total = $this->Delivery_letter_model->get_datatable_count();
        $filtered = $this->Delivery_letter_model->get_datatable_filter_count();

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => array()
        );

        foreach ($data as $row) {
            $badge = $row->type == 'in' ? '<span class="badge badge-success">Masuk</span>' : '<span class="badge badge-primary">Keluar</span>';
            $sub_array = array(
                $row->id,
                $row->letter_number,
                date('d-m-Y', strtotime($row->letter_date)),
                $row->vehicle_number,
                $badge,
                '<button class="btn-sm btn-primary" onclick="viewDelivery(' . $row->id . ')">Lihat</button> '
                . '<button class="btn-sm btn-danger" onclick="deleteDelivery(' . $row->id . ')">Hapus</button>'
            );
            $result['data'][] = $sub_array;
        }

        echo json_encode($result);
    }

    public function create() {
        $this->form_validation->set_rules('letter_number', 'No Surat Jalan', 'required|is_unique[delivery_letters.letter_number]');
        $this->form_validation->set_rules('letter_date', 'Tanggal', 'required');
        $this->form_validation->set_rules('vehicle_number', 'No Kendaraan', 'required');
        $this->form_validation->set_rules('type', 'Tipe', 'required');

        if (!$this->form_validation->run()) {
            $this->response_json(false, validation_errors());
        }

        $delivery_data = array(
            'letter_number' => $this->input->post('letter_number', true),
            'letter_date' => $this->input->post('letter_date', true),
            'vehicle_number' => $this->input->post('vehicle_number', true),
            'type' => $this->input->post('type', true),
            'created_by' => $this->session->userdata('user_id')
        );

        $delivery_id = $this->Delivery_letter_model->create($delivery_data);

        if ($delivery_id) {
            // Save items
            $items = $this->input->post('items');
            if ($items) {
                foreach ($items as $item) {
                    $item_data = array(
                        'delivery_letter_id' => $delivery_id,
                        'item_id' => $item['item_id'],
                        'quantity' => $item['quantity']
                    );
                    $this->Delivery_letter_item_model->create($item_data);
                }
            }
            $this->response_json(true, 'Surat jalan berhasil dibuat');
        } else {
            $this->response_json(false, 'Gagal membuat surat jalan');
        }
    }

    public function delete() {
        $id = $this->input->post('id', true);

        if ($this->Delivery_letter_model->delete($id)) {
            $this->response_json(true, 'Surat jalan berhasil dihapus');
        } else {
            $this->response_json(false, 'Gagal menghapus surat jalan');
        }
    }

    private function check_login() {
        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }
    }

    private function check_access($allowed_roles) {
        $user_level = $this->session->userdata('level');
        if (!in_array($user_level, $allowed_roles)) {
            show_error('Anda tidak memiliki akses ke halaman ini', 403);
        }
    }

    private function response_json($success, $message, $data = null) {
        $response = array(
            'success' => $success,
            'message' => $message
        );
        if ($data) {
            $response['data'] = $data;
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
