<?php
class Production_waste_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        $this->db->from('production_waste');
        $this->db->order_by('production_waste.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_date($date) {
        $this->db->where('DATE(production_waste.created_at)', $date);
        $this->db->order_by('production_waste.created_at', 'DESC');
        return $this->db->get('production_waste')->result();
    }

    public function get_datatable() {
        $this->db->select('production_waste.id, production_waste.quantity, production_waste.type, production_waste.created_at');
        $this->db->from('production_waste');
        
        // Limit
        $length = $this->input->post('length');
        $start = $this->input->post('start');
        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        
        $this->db->order_by('production_waste.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_datatable_count() {
        return $this->db->count_all('production_waste');
    }

    public function create($data) {
        return $this->db->insert('production_waste', $data);
    }
}
