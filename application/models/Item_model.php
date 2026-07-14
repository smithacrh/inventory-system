<?php
class Item_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->select('items.id, items.name, items.stock, item_categories.name as category_name');
        $this->db->from('items');
        $this->db->join('item_categories', 'items.category_id = item_categories.id');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('items.id, items.name, items.stock, items.category_id, item_categories.name as category_name');
        $this->db->from('items');
        $this->db->join('item_categories', 'items.category_id = item_categories.id');
        $this->db->where('items.id', $id);
        return $this->db->get()->row();
    }

    public function get_datatable() {
        $this->db->select('items.id, items.name, items.stock, item_categories.name as category_name');
        $this->db->from('items');
        $this->db->join('item_categories', 'items.category_id = item_categories.id');
        
        // Search
        if (!empty($this->input->post('search[value]'))) {
            $search = $this->input->post('search[value]');
            $this->db->like('items.name', $search);
            $this->db->or_like('item_categories.name', $search);
        }
        
        // Order
        if (!empty($this->input->post('order'))) {
            $order = $this->input->post('order')[0];
            $columns = array('items.id', 'items.name', 'items.stock', 'item_categories.name');
            if (isset($columns[$order['column']])) {
                $this->db->order_by($columns[$order['column']], $order['dir']);
            }
        }
        
        // Limit
        $length = $this->input->post('length');
        $start = $this->input->post('start');
        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        
        return $this->db->get()->result();
    }

    public function get_datatable_count() {
        return $this->db->count_all('items');
    }

    public function get_datatable_filter_count() {
        $this->db->from('items');
        $this->db->join('item_categories', 'items.category_id = item_categories.id');
        if (!empty($this->input->post('search[value]'))) {
            $search = $this->input->post('search[value]');
            $this->db->like('items.name', $search);
            $this->db->or_like('item_categories.name', $search);
        }
        return $this->db->count_all_results();
    }

    public function get_total_stock() {
        return $this->db->select_sum('stock')->get('items')->row()->stock;
    }

    public function create($data) {
        return $this->db->insert('items', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('items', $data);
    }

    public function delete($id) {
        return $this->db->delete('items', array('id' => $id));
    }

    public function add_stock($id, $quantity) {
        $this->db->set('stock', 'stock+' . $quantity, FALSE);
        $this->db->where('id', $id);
        return $this->db->update('items');
    }

    public function reduce_stock($id, $quantity) {
        $this->db->set('stock', 'stock-' . $quantity, FALSE);
        $this->db->where('id', $id);
        return $this->db->update('items');
    }
}
