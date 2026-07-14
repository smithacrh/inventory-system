<?php
class Cutting_production_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('cutting_production.id, cutting_production.item_id, cutting_production.quantity_produced, cutting_production.waste_quantity, cutting_production.created_by, cutting_production.created_at, items.name as item_name, users.username');
        $this->db->from('cutting_production');
        $this->db->join('items', 'cutting_production.item_id = items.id');
        $this->db->join('users', 'cutting_production.created_by = users.id');
        $this->db->order_by('cutting_production.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_date($date) {
        $this->db->select('cutting_production.id, cutting_production.item_id, cutting_production.quantity_produced, cutting_production.waste_quantity, items.name as item_name');
        $this->db->from('cutting_production');
        $this->db->join('items', 'cutting_production.item_id = items.id');
        $this->db->where('DATE(cutting_production.created_at)', $date);
        $this->db->order_by('cutting_production.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_datatable() {
        $this->db->select('cutting_production.id, cutting_production.item_id, cutting_production.quantity_produced, cutting_production.waste_quantity, cutting_production.created_by, cutting_production.created_at, items.name as item_name, item_categories.name as category_name, users.username');
        $this->db->from('cutting_production');
        $this->db->join('items', 'cutting_production.item_id = items.id');
        $this->db->join('item_categories', 'items.category_id = item_categories.id');
        $this->db->join('users', 'cutting_production.created_by = users.id');
        
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
        
        $this->db->order_by('cutting_production.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_datatable_count() {
        return $this->db->count_all('cutting_production');
    }

    public function get_datatable_filter_count() {
        $this->db->from('cutting_production');
        $this->db->join('items', 'cutting_production.item_id = items.id');
        if (!empty($this->input->post('search[value]'))) {
            $search = $this->input->post('search[value]');
            $this->db->like('items.name', $search);
        }
        return $this->db->count_all_results();
    }

    public function create($data) {
        return $this->db->insert('cutting_production', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('cutting_production', $data);
    }

    public function delete($id) {
        return $this->db->delete('cutting_production', array('id' => $id));
    }
}
