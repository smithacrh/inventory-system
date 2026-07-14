<?php
class Delivery_letter_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('delivery_letters.*, users.username as created_by_name, users2.username as approved_by_name');
        $this->db->from('delivery_letters');
        $this->db->join('users', 'delivery_letters.created_by = users.id');
        $this->db->join('users as users2', 'delivery_letters.approved_by = users2.id', 'left');
        $this->db->order_by('delivery_letters.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('delivery_letters', array('id' => $id))->row();
    }

    public function get_by_type($type) {
        $this->db->select('delivery_letters.*, users.username as created_by_name');
        $this->db->from('delivery_letters');
        $this->db->join('users', 'delivery_letters.created_by = users.id');
        $this->db->where('delivery_letters.type', $type);
        $this->db->order_by('delivery_letters.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_date($date) {
        $this->db->select('delivery_letters.*, users.username as created_by_name');
        $this->db->from('delivery_letters');
        $this->db->join('users', 'delivery_letters.created_by = users.id');
        $this->db->where('DATE(delivery_letters.created_at)', $date);
        $this->db->order_by('delivery_letters.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_datatable() {
        $this->db->select('delivery_letters.id, delivery_letters.letter_number, delivery_letters.letter_date, delivery_letters.vehicle_number, delivery_letters.type, delivery_letters.created_at, users.username as created_by_name');
        $this->db->from('delivery_letters');
        $this->db->join('users', 'delivery_letters.created_by = users.id');
        
        // Search
        if (!empty($this->input->post('search[value]'))) {
            $search = $this->input->post('search[value]');
            $this->db->like('delivery_letters.letter_number', $search);
            $this->db->or_like('delivery_letters.vehicle_number', $search);
        }
        
        // Filter by type if needed
        if ($this->input->post('type')) {
            $this->db->where('delivery_letters.type', $this->input->post('type'));
        }
        
        // Limit
        $length = $this->input->post('length');
        $start = $this->input->post('start');
        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        
        $this->db->order_by('delivery_letters.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_datatable_count() {
        return $this->db->count_all('delivery_letters');
    }

    public function create($data) {
        return $this->db->insert('delivery_letters', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('delivery_letters', $data);
    }

    public function delete($id) {
        return $this->db->delete('delivery_letters', array('id' => $id));
    }
}
