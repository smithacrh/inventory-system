<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select('p.*, i.item_name, c.category_name, u.name as created_by_name');
        $this->db->from('productions p');
        $this->db->join('items i', 'p.item_id = i.id', 'left');
        $this->db->join('categories c', 'i.category_id = c.id', 'left');
        $this->db->join('users u', 'p.created_by = u.id', 'left');
        $this->db->order_by('p.production_date', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('p.*, i.item_name, c.category_name, u.name as created_by_name');
        $this->db->from('productions p');
        $this->db->join('items i', 'p.item_id = i.id', 'left');
        $this->db->join('categories c', 'i.category_id = c.id', 'left');
        $this->db->join('users u', 'p.created_by = u.id', 'left');
        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        return $this->db->insert('productions', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('productions', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('productions', array('id' => $id));
    }

    public function count_all()
    {
        return $this->db->count_all('productions');
    }

    public function get_recent($limit = 5)
    {
        $this->db->select('p.*, i.item_name, c.category_name, u.name as created_by_name');
        $this->db->from('productions p');
        $this->db->join('items i', 'p.item_id = i.id', 'left');
        $this->db->join('categories c', 'i.category_id = c.id', 'left');
        $this->db->join('users u', 'p.created_by = u.id', 'left');
        $this->db->order_by('p.production_date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_report($start_date, $end_date)
    {
        $this->db->select('p.*, i.item_name, c.category_name, u.name as created_by_name');
        $this->db->from('productions p');
        $this->db->join('items i', 'p.item_id = i.id', 'left');
        $this->db->join('categories c', 'i.category_id = c.id', 'left');
        $this->db->join('users u', 'p.created_by = u.id', 'left');
        $this->db->where('DATE(p.production_date) >=', $start_date);
        $this->db->where('DATE(p.production_date) <=', $end_date);
        $this->db->order_by('p.production_date', 'DESC');
        return $this->db->get()->result();
    }

    public function get_statistics()
    {
        return $this->db->query("
            SELECT 
                DATE(production_date) as date,
                COUNT(id) as total_production,
                SUM(quantity) as total_quantity
            FROM productions
            WHERE production_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY DATE(production_date)
            ORDER BY date DESC
        ")->result();
    }

}
?>