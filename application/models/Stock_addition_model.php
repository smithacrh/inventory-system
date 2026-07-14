<?php
class Stock_addition_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('stock_additions.id, stock_additions.item_id, stock_additions.quantity, stock_additions.created_by, stock_additions.created_at, items.name as item_name, users.username');
        $this->db->from('stock_additions');
        $this->db->join('items', 'stock_additions.item_id = items.id');
        $this->db->join('users', 'stock_additions.created_by = users.id');
        $this->db->order_by('stock_additions.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_datatable() {
        $this->db->select('stock_additions.id, stock_additions.item_id, stock_additions.quantity, stock_additions.created_by, stock_additions.created_at, items.name as item_name, users.username');
        $this->db->from('stock_additions');
        $this->db->join('items', 'stock_additions.item_id = items.id');
        $this->db->join('users', 'stock_additions.created_by = users.id');
        
        // Search
        if (!empty($this->input->post('search[value]'))) {
            $search = $this->input->post('search[value]');
            $this->db->like('items.name', $search);
        }
        
        // Limit
        $length = $this->input->post('length');
        $start = $this->input->post('start');
        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        
        $this->db->order_by('stock_additions.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_datatable_count() {
        return $this->db->count_all('stock_additions');
    }

    public function create($data) {
        return $this->db->insert('stock_additions', $data);
    }
}
