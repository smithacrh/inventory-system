<?php
class Production_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('production.id, production.item_id, production.quantity_produced, production.waste_quantity, production.created_by, production.created_at, items.name as item_name, users.username');
        $this->db->from('production');
        $this->db->join('items', 'production.item_id = items.id');
        $this->db->join('users', 'production.created_by = users.id');
        $this->db->order_by('production.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('production.id, production.item_id, production.quantity_produced, production.waste_quantity, production.created_by, production.created_at, items.name as item_name, item_categories.name as category_name');
        $this->db->from('production');
        $this->db->join('items', 'production.item_id = items.id');
        $this->db->join('item_categories', 'items.category_id = item_categories.id');
        $this->db->where('production.id', $id);
        return $this->db->get()->row();
    }

    public function get_by_date($date) {
        $this->db->select('production.id, production.item_id, production.quantity_produced, production.waste_quantity, items.name as item_name');
        $this->db->from('production');
        $this->db->join('items', 'production.item_id = items.id');
        $this->db->where('DATE(production.created_at)', $date);
        $this->db->order_by('production.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_datatable() {
        $this->db->select('production.id, production.item_id, production.quantity_produced, production.waste_quantity, production.created_by, production.created_at, items.name as item_name, item_categories.name as category_name, users.username');
        $this->db->from('production');
        $this->db->join('items', 'production.item_id = items.id');
        $this->db->join('item_categories', 'items.category_id = item_categories.id');
        $this->db->join('users', 'production.created_by = users.id');
        
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
        
        $this->db->order_by('production.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_datatable_count() {
        return $this->db->count_all('production');
    }

    public function get_datatable_filter_count() {
        $this->db->from('production');
        $this->db->join('items', 'production.item_id = items.id');
        if (!empty($this->input->post('search[value]'))) {
            $search = $this->input->post('search[value]');
            $this->db->like('items.name', $search);
        }
        return $this->db->count_all_results();
    }

    public function create($data) {
        return $this->db->insert('production', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('production', $data);
    }

    public function delete($id) {
        return $this->db->delete('production', array('id' => $id));
    }
}
