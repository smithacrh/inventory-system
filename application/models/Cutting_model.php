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
        $query = $this->db->get('cuttings');
        return $query->result();
    }

    public function get_all_with_item()
    {
        $this->db->select('cuttings.*, items.nama_barang, items.sku, items.satuan, users.nama_lengkap');
        $this->db->join('items', 'items.id = cuttings.item_id', 'left');
        $this->db->join('users', 'users.id = cuttings.created_by', 'left');
        $this->db->order_by('cuttings.created_at', 'DESC');
        $query = $this->db->get('cuttings');
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('cuttings.*, items.nama_barang, items.sku');
        $this->db->join('items', 'items.id = cuttings.item_id', 'left');
        $this->db->where('cuttings.id', $id);
        $query = $this->db->get('cuttings');
        return $query->row();
    }

    public function get_recent($limit = 5)
    {
        $this->db->select('cuttings.*, items.nama_barang');
        $this->db->join('items', 'items.id = cuttings.item_id', 'left');
        $this->db->order_by('cuttings.created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('cuttings');
        return $query->result();
    }

    public function get_by_date_range($start_date, $end_date)
    {
        $this->db->select('cuttings.*, items.nama_barang, items.sku, items.satuan, users.nama_lengkap');
        $this->db->join('items', 'items.id = cuttings.item_id', 'left');
        $this->db->join('users', 'users.id = cuttings.created_by', 'left');
        $this->db->where('DATE(cuttings.created_at) >=', $start_date);
        $this->db->where('DATE(cuttings.created_at) <=', $end_date);
        $this->db->order_by('cuttings.created_at', 'DESC');
        $query = $this->db->get('cuttings');
        return $query->result();
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
        $this->db->where('id', $id);
        return $this->db->delete('cuttings');
    }

    public function count_all()
    {
        return $this->db->count_all('cuttings');
    }
}
?>