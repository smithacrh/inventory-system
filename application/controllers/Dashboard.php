<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Consumer_model');
        $this->load->model('Item_model');
        $this->load->model('Production_model');
        $this->load->model('Delivery_model');
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
        $data['title'] = 'Dashboard';
        $data['total_consumers'] = $this->Consumer_model->count_all();
        $data['total_items'] = $this->Item_model->count_all();
        $data['total_production'] = $this->Production_model->count_all();
        $data['total_delivery'] = $this->Delivery_model->count_all();
        
        $data['recent_productions'] = $this->Production_model->get_recent(5);
        $data['recent_deliveries'] = $this->Delivery_model->get_recent(5);
        $data['stock_summary'] = $this->Item_model->get_stock_summary();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('layouts/footer');
    }

    public function statistics()
    {
        $data['title'] = 'Statistik';
        $data['production_stats'] = $this->Production_model->get_statistics();
        $data['delivery_stats'] = $this->Delivery_model->get_statistics();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('dashboard/statistics', $data);
        $this->load->view('layouts/footer');
    }

}
?>