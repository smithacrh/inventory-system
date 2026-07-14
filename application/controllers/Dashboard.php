<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['User_model', 'Report_model', 'Item_model', 'Production_model', 'Cutting_model', 'Delivery_model', 'Consumer_model']);
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
        $data['page_title'] = 'Dashboard';
        $data['total_consumers'] = $this->Consumer_model->count_all();
        $data['total_items'] = $this->Item_model->count_all();
        $data['total_productions'] = $this->Production_model->count_all();
        $data['total_deliveries'] = $this->Delivery_model->count_all();
        $data['low_stock_items'] = $this->Item_model->get_low_stock(5);
        $data['recent_productions'] = $this->Production_model->get_recent(5);
        $data['recent_deliveries'] = $this->Delivery_model->get_recent(5);
        $data['stock_summary'] = $this->Item_model->get_all();

        $this->load->view('layouts/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('layouts/footer');
    }

    public function statistics()
    {
        $data['page_title'] = 'Statistik';
        $data['total_consumers'] = $this->Consumer_model->count_all();
        $data['total_items'] = $this->Item_model->count_all();
        $data['total_productions'] = $this->Production_model->count_all();
        $data['total_deliveries'] = $this->Delivery_model->count_all();
        $data['total_stock_value'] = $this->Item_model->get_total_stock_value();

        $this->load->view('layouts/header', $data);
        $this->load->view('dashboard/statistics', $data);
        $this->load->view('layouts/footer');
    }
}
?>