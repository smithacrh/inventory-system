<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->load->model('Item_model');
        $this->load->model('Production_model');
        $this->load->model('Cutting_production_model');
        $this->load->model('Production_waste_model');
        $this->load->model('Delivery_letter_model');
    }

    public function stock_recap() {
        $this->check_access(array(ROLE_ADMIN, ROLE_OPERATOR_ASSEMBLY));
        
        $data['page_title'] = 'Rekap Stok Barang';
        $date = $this->input->get('date');
        if (!$date) {
            $date = date('Y-m-d');
        }
        $data['selected_date'] = $date;
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/stock_recap', $data);
        $this->load->view('layouts/footer');
    }

    public function production_recap() {
        $this->check_access(array(ROLE_ADMIN, ROLE_OPERATOR_ASSEMBLY));
        
        $data['page_title'] = 'Rekap Produksi Barang';
        $date = $this->input->get('date');
        if (!$date) {
            $date = date('Y-m-d');
        }
        $data['selected_date'] = $date;
        $data['productions'] = $this->Production_model->get_by_date($date);
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/production_recap', $data);
        $this->load->view('layouts/footer');
    }

    public function cutting_recap() {
        $this->check_access(array(ROLE_ADMIN, ROLE_OPERATOR_CUTTING));
        
        $data['page_title'] = 'Rekap Produksi Cutting';
        $date = $this->input->get('date');
        if (!$date) {
            $date = date('Y-m-d');
        }
        $data['selected_date'] = $date;
        $data['cuttings'] = $this->Cutting_production_model->get_by_date($date);
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/cutting_recap', $data);
        $this->load->view('layouts/footer');
    }

    public function waste_recap() {
        $this->check_access(array(ROLE_ADMIN, ROLE_OPERATOR_ASSEMBLY, ROLE_OPERATOR_CUTTING));
        
        $data['page_title'] = 'Rekap Sampah Produksi';
        $date = $this->input->get('date');
        if (!$date) {
            $date = date('Y-m-d');
        }
        $data['selected_date'] = $date;
        $data['wastes'] = $this->Production_waste_model->get_by_date($date);
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/waste_recap', $data);
        $this->load->view('layouts/footer');
    }

    public function delivery_recap() {
        $this->check_access(array(ROLE_ADMIN, ROLE_DRIVER));
        
        $data['page_title'] = 'Rekap Surat Jalan';
        $date = $this->input->get('date');
        if (!$date) {
            $date = date('Y-m-d');
        }
        $data['selected_date'] = $date;
        $data['deliveries'] = $this->Delivery_letter_model->get_by_date($date);
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/delivery_recap', $data);
        $this->load->view('layouts/footer');
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
}
