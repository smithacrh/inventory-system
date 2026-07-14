<?php
class Delivery_letter_item_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_by_letter($letter_id) {
        $this->db->select('delivery_letter_items.id, delivery_letter_items.item_id, delivery_letter_items.quantity, items.name as item_name');
        $this->db->from('delivery_letter_items');
        $this->db->join('items', 'delivery_letter_items.item_id = items.id');
        $this->db->where('delivery_letter_items.delivery_letter_id', $letter_id);
        return $this->db->get()->result();
    }

    public function create($data) {
        return $this->db->insert('delivery_letter_items', $data);
    }

    public function delete_by_letter($letter_id) {
        return $this->db->delete('delivery_letter_items', array('delivery_letter_id' => $letter_id));
    }
}
