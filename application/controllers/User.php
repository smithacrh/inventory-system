<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->check_login();
        $this->check_access(array(ROLE_ADMIN));
        $this->load->model('User_model');
    }

    public function index() {
        $data['page_title'] = 'Manajemen User';
        $this->load->view('layouts/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('layouts/footer');
    }

    public function get_datatable() {
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');

        $users = $this->User_model->get_all();
        $total = count($users);
        $filtered = $total;

        $result = array(
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => array()
        );

        $users = array_slice($users, $start, $length);

        foreach ($users as $row) {
            $level_name = isset(ROLE_NAMES[$row->level]) ? ROLE_NAMES[$row->level] : 'Unknown';
            $sub_array = array(
                $row->id,
                $row->username,
                $level_name,
                '<button class="btn-sm btn-primary" onclick="editUser(' . $row->id . ')">Edit</button> '
                . '<button class="btn-sm btn-danger" onclick="deleteUser(' . $row->id . ')">Hapus</button>'
            );
            $result['data'][] = $sub_array;
        }

        echo json_encode($result);
    }

    public function create() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if (!$this->form_validation->run()) {
            $this->response_json(false, validation_errors());
        }

        $data = array(
            'username' => $this->input->post('username', true),
            'password' => $this->User_model->hash_password($this->input->post('password', true)),
            'level' => $this->input->post('level', true)
        );

        if ($this->User_model->create($data)) {
            $this->response_json(true, 'User berhasil ditambahkan');
        } else {
            $this->response_json(false, 'Gagal menambahkan user');
        }
    }

    public function update() {
        $id = $this->input->post('id', true);
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if (!$this->form_validation->run()) {
            $this->response_json(false, validation_errors());
        }

        $data = array(
            'username' => $this->input->post('username', true),
            'level' => $this->input->post('level', true)
        );

        // If password is provided, hash and update it
        $password = $this->input->post('password', true);
        if (!empty($password)) {
            $data['password'] = $this->User_model->hash_password($password);
        }

        if ($this->User_model->update($id, $data)) {
            $this->response_json(true, 'User berhasil diperbarui');
        } else {
            $this->response_json(false, 'Gagal memperbarui user');
        }
    }

    public function delete() {
        $id = $this->input->post('id', true);

        if ($this->User_model->delete($id)) {
            $this->response_json(true, 'User berhasil dihapus');
        } else {
            $this->response_json(false, 'Gagal menghapus user');
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
