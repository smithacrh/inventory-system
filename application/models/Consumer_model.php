<?php
class Consumer_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->get('consumers')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('consumers', array('id' => $id))->row();
    }

    public function get_datatable() {
        $this->db->select('id, name, address');
        $this->db->from('consumers');
        
        // Search
        if (!empty($this->input->post('search[value]'))) {
            $search = $this->input->post('search[value]');
            $this->db->like('name', $search);
            $this->db->or_like('address', $search);
        }
        
        // Order
        if (!empty($this->input->post('order'))) {
            $order = $this->input->post('order')[0];
            $columns = array('id', 'name', 'address');
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
        return $this->db->count_all('consumers');
    }

    public function get_datatable_filter_count() {
        $this->db->from('consumers');
        if (!empty($this->input->post('search[value]'))) {
            $search = $this->input->post('search[value]');
            $this->db->like('name', $search);
            $this->db->or_like('address', $search);
        }
        return $this->db->count_all_results();
    }

    public function create($data) {
        return $this->db->insert('consumers', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('consumers', $data);
    }

    public function delete($id) {
        return $this->db->delete('consumers', array('id' => $id));
    }
}
