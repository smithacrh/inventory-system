<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model');
        $this->load->model('Production_model');
        $this->load->model('Cutting_model');
        $this->load->model('Delivery_model');
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
        $data['title'] = 'Laporan';
        $this->load->view('layouts/header', $data);
        $this->load->view('report/index', $data);
        $this->load->view('layouts/footer');
    }

    public function stock()
    {
        $data['title'] = 'Laporan Stok Barang';
        $data['report_data'] = $this->Report_model->get_stock_report();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/stock', $data);
        $this->load->view('layouts/footer');
    }

    public function production()
    {
        $data['title'] = 'Laporan Produksi';
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : date('Y-m-01');
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') : date('Y-m-d');
        
        $data['report_data'] = $this->Production_model->get_report($start_date, $end_date);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/production', $data);
        $this->load->view('layouts/footer');
    }

    public function cutting()
    {
        $data['title'] = 'Laporan Pemotongan';
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : date('Y-m-01');
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') : date('Y-m-d');
        
        $data['report_data'] = $this->Cutting_model->get_report($start_date, $end_date);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/cutting', $data);
        $this->load->view('layouts/footer');
    }

    public function delivery()
    {
        $data['title'] = 'Laporan Pengiriman';
        $start_date = $this->input->get('start_date') ? $this->input->get('start_date') : date('Y-m-01');
        $end_date = $this->input->get('end_date') ? $this->input->get('end_date') : date('Y-m-d');
        
        $data['report_data'] = $this->Delivery_model->get_report($start_date, $end_date);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/delivery', $data);
        $this->load->view('layouts/footer');
    }

    public function waste()
    {
        $data['title'] = 'Laporan Limbah/Waste';
        $data['report_data'] = $this->Report_model->get_waste_report();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('report/waste', $data);
        $this->load->view('layouts/footer');
    }

}
?>