<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        $this->db->select('d.*, co.name as consumer_name, co.phone, co.address, i.item_name, u.name as created_by_name');
        $this->db->from('deliveries d');
        $this->db->join('consumers co', 'd.consumer_id = co.id', 'left');
        $this->db->join('items i', 'd.item_id = i.id', 'left');
        $this->db->join('users u', 'd.created_by = u.id', 'left');
        $this->db->order_by('d.delivery_date', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('d.*, co.name as consumer_name, co.phone, co.address, i.item_name, i.unit, u.name as created_by_name');
        $this->db->from('deliveries d');
        $this->db->join('consumers co', 'd.consumer_id = co.id', 'left');
        $this->db->join('items i', 'd.item_id = i.id', 'left');
        $this->db->join('users u', 'd.created_by = u.id', 'left');
        $this->db->where('d.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        return $this->db->insert('deliveries', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('deliveries', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('deliveries', array('id' => $id));
    }

    public function count_all()
    {
        return $this->db->count_all('deliveries');
    }

    public function get_recent($limit = 5)
    {
        $this->db->select('d.*, co.name as consumer_name, co.phone, i.item_name, u.name as created_by_name');
        $this->db->from('deliveries d');
        $this->db->join('consumers co', 'd.consumer_id = co.id', 'left');
        $this->db->join('items i', 'd.item_id = i.id', 'left');
        $this->db->join('users u', 'd.created_by = u.id', 'left');
        $this->db->order_by('d.delivery_date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_report($start_date, $end_date)
    {
        $this->db->select('d.*, co.name as consumer_name, co.phone, i.item_name, u.name as created_by_name');
        $this->db->from('deliveries d');
        $this->db->join('consumers co', 'd.consumer_id = co.id', 'left');
        $this->db->join('items i', 'd.item_id = i.id', 'left');
        $this->db->join('users u', 'd.created_by = u.id', 'left');
        $this->db->where('DATE(d.delivery_date) >=', $start_date);
        $this->db->where('DATE(d.delivery_date) <=', $end_date);
        $this->db->order_by('d.delivery_date', 'DESC');
        return $this->db->get()->result();
    }

    public function get_statistics()
    {
        return $this->db->query("
            SELECT 
                DATE(delivery_date) as date,
                COUNT(id) as total_delivery,
                SUM(quantity) as total_quantity
            FROM deliveries
            WHERE delivery_date >= DATE_SUB(NOW(), INTERVAL 30 DAY)
            GROUP BY DATE(delivery_date)
            ORDER BY date DESC
        ")->result();
    }

}
?>