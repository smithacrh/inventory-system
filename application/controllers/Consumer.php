<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Consumer_model');
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
        $data['title'] = 'Manajemen Konsumen';
        $data['consumers'] = $this->Consumer_model->get_all();
        
        $this->load->view('layouts/header', $data);
        $this->load->view('consumer/list', $data);
        $this->load->view('layouts/footer');
    }

    public function add()
    {
        $data['title'] = 'Tambah Konsumen';
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nama Konsumen', 'required');
            $this->form_validation->set_rules('phone', 'No. Telepon', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('address', 'Alamat', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('consumer/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $insert_data = array(
                    'name' => $this->input->post('name'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'created_at' => date('Y-m-d H:i:s')
                );

                if ($this->Consumer_model->insert($insert_data)) {
                    $this->session->set_flashdata('success', 'Konsumen berhasil ditambahkan');
                    redirect('consumer');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('consumer/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Konsumen';
        $data['consumer'] = $this->Consumer_model->get_by_id($id);
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nama Konsumen', 'required');
            $this->form_validation->set_rules('phone', 'No. Telepon', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('address', 'Alamat', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layouts/header', $data);
                $this->load->view('consumer/form', $data);
                $this->load->view('layouts/footer');
            } else {
                $update_data = array(
                    'name' => $this->input->post('name'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'updated_at' => date('Y-m-d H:i:s')
                );

                if ($this->Consumer_model->update($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Konsumen berhasil diupdate');
                    redirect('consumer');
                }
            }
        } else {
            $this->load->view('layouts/header', $data);
            $this->load->view('consumer/form', $data);
            $this->load->view('layouts/footer');
        }
    }

    public function delete($id)
    {
        if ($this->Consumer_model->delete($id)) {
            $this->session->set_flashdata('success', 'Konsumen berhasil dihapus');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus konsumen');
        }
        redirect('consumer');
    }

}
?>