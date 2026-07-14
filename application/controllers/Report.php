<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model(['Report_model', 'Item_model', 'Production_model', 'Cutting_model', 'Delivery_model']);
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
        $data['page_title'] = 'Rekap Laporan';
        $this->load->view('layouts/header', $data);
        $this->load->view('report/index', $data);
        $this->load->view('layouts/footer');
    }

    public function stock()
    {
        $data['page_title'] = 'Laporan Stok Barang';
        $data['items'] = $this->Item_model->get_all_with_value();
        $data['total_value'] = $this->Item_model->get_total_stock_value();

        $this->load->view('layouts/header', $data);
        $this->load->view('report/stock', $data);
        $this->load->view('layouts/footer');
    }

    public function production()
    {
        $start_date = $this->input->get('start_date', true);
        $end_date = $this->input->get('end_date', true);

        $data['page_title'] = 'Laporan Produksi';
        $data['start_date'] = $start_date ? $start_date : date('Y-m-01');
        $data['end_date'] = $end_date ? $end_date : date('Y-m-d');
        $data['productions'] = $this->Production_model->get_by_date_range($data['start_date'], $data['end_date']);

        $this->load->view('layouts/header', $data);
        $this->load->view('report/production', $data);
        $this->load->view('layouts/footer');
    }

    public function cutting()
    {
        $start_date = $this->input->get('start_date', true);
        $end_date = $this->input->get('end_date', true);

        $data['page_title'] = 'Laporan Pemotongan';
        $data['start_date'] = $start_date ? $start_date : date('Y-m-01');
        $data['end_date'] = $end_date ? $end_date : date('Y-m-d');
        $data['cuttings'] = $this->Cutting_model->get_by_date_range($data['start_date'], $data['end_date']);

        $this->load->view('layouts/header', $data);
        $this->load->view('report/cutting', $data);
        $this->load->view('layouts/footer');
    }

    public function delivery()
    {
        $start_date = $this->input->get('start_date', true);
        $end_date = $this->input->get('end_date', true);

        $data['page_title'] = 'Laporan Pengiriman';
        $data['start_date'] = $start_date ? $start_date : date('Y-m-01');
        $data['end_date'] = $end_date ? $end_date : date('Y-m-d');
        $data['deliveries'] = $this->Delivery_model->get_by_date_range($data['start_date'], $data['end_date']);

        $this->load->view('layouts/header', $data);
        $this->load->view('report/delivery', $data);
        $this->load->view('layouts/footer');
    }

    public function waste()
    {
        $start_date = $this->input->get('start_date', true);
        $end_date = $this->input->get('end_date', true);

        $data['page_title'] = 'Laporan Limbah/Waste';
        $data['start_date'] = $start_date ? $start_date : date('Y-m-01');
        $data['end_date'] = $end_date ? $end_date : date('Y-m-d');
        $data['waste_report'] = $this->Report_model->get_waste_report($data['start_date'], $data['end_date']);

        $this->load->view('layouts/header', $data);
        $this->load->view('report/waste', $data);
        $this->load->view('layouts/footer');
    }
}
?>