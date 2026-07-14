<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cutting_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select('c.*, i.item_name, cat.category_name, u.name as created_by_name');
        $this->db->from('cuttings c');
        $this->db->join('items i', 'c.item_id = i.id', 'left');
        $this->db->join('categories cat', 'i.category_id = cat.id', 'left');
        $this->db->join('users u', 'c.created_by = u.id', 'left');
        $this->db->order_by('c.cutting_date', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('c.*, i.item_name, cat.category_name, u.name as created_by_name');
        $this->db->from('cuttings c');
        $this->db->join('items i', 'c.item_id = i.id', 'left');
        $this->db->join('categories cat', 'i.category_id = cat.id', 'left');
        $this->db->join('users u', 'c.created_by = u.id', 'left');
        $this->db->where('c.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        return $this->db->insert('cuttings', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('cuttings', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('cuttings', array('id' => $id));
    }

    public function count_all()
    {
        return $this->db->count_all('cuttings');
    }

    public function get_recent($limit = 5)
    {
        $this->db->select('c.*, i.item_name, cat.category_name, u.name as created_by_name');
        $this->db->from('cuttings c');
        $this->db->join('items i', 'c.item_id = i.id', 'left');
        $this->db->join('categories cat', 'i.category_id = cat.id', 'left');
        $this->db->join('users u', 'c.created_by = u.id', 'left');
        $this->db->order_by('c.cutting_date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_report($start_date, $end_date)
    {
        $this->db->select('c.*, i.item_name, cat.category_name, u.name as created_by_name');
        $this->db->from('cuttings c');
        $this->db->join('items i', 'c.item_id = i.id', 'left');
        $this->db->join('categories cat', 'i.category_id = cat.id', 'left');
        $this->db->join('users u', 'c.created_by = u.id', 'left');
        $this->db->where('DATE(c.cutting_date) >=', $start_date);
        $this->db->where('DATE(c.cutting_date) <=', $end_date);
        $this->db->order_by('c.cutting_date', 'DESC');
        return $this->db->get()->result();
    }

}
?>