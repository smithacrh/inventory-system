<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select('i.*, c.category_name');
        $this->db->from('items i');
        $this->db->join('categories c', 'i.category_id = c.id', 'left');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('i.*, c.category_name');
        $this->db->from('items i');
        $this->db->join('categories c', 'i.category_id = c.id', 'left');
        $this->db->where('i.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        return $this->db->insert('items', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('items', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('items', array('id' => $id));
    }

    public function count_all()
    {
        return $this->db->count_all('items');
    }

    public function get_stock_summary()
    {
        $this->db->select('i.*, c.category_name');
        $this->db->from('items i');
        $this->db->join('categories c', 'i.category_id = c.id', 'left');
        $this->db->order_by('i.stock', 'ASC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

    public function get_low_stock($limit = 5)
    {
        $this->db->select('i.*, c.category_name');
        $this->db->from('items i');
        $this->db->join('categories c', 'i.category_id = c.id', 'left');
        $this->db->where('i.stock <', 10);
        $this->db->order_by('i.stock', 'ASC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

}
?>