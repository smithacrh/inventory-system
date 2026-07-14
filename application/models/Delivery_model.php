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
        $query = $this->db->get('deliveries');
        return $query->result();
    }

    public function get_all_with_consumer()
    {
        $this->db->select('deliveries.*, consumers.nama_konsumen, consumers.alamat, items.nama_barang, items.sku, users.nama_lengkap');
        $this->db->join('consumers', 'consumers.id = deliveries.konsumen_id', 'left');
        $this->db->join('items', 'items.id = deliveries.item_id', 'left');
        $this->db->join('users', 'users.id = deliveries.created_by', 'left');
        $this->db->order_by('deliveries.created_at', 'DESC');
        $query = $this->db->get('deliveries');
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('deliveries.*, consumers.nama_konsumen, consumers.alamat, items.nama_barang, items.sku, users.nama_lengkap');
        $this->db->join('consumers', 'consumers.id = deliveries.konsumen_id', 'left');
        $this->db->join('items', 'items.id = deliveries.item_id', 'left');
        $this->db->join('users', 'users.id = deliveries.created_by', 'left');
        $this->db->where('deliveries.id', $id);
        $query = $this->db->get('deliveries');
        return $query->row();
    }

    public function get_recent($limit = 5)
    {
        $this->db->select('deliveries.*, consumers.nama_konsumen, items.nama_barang');
        $this->db->join('consumers', 'consumers.id = deliveries.konsumen_id', 'left');
        $this->db->join('items', 'items.id = deliveries.item_id', 'left');
        $this->db->order_by('deliveries.created_at', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('deliveries');
        return $query->result();
    }

    public function get_by_date_range($start_date, $end_date)
    {
        $this->db->select('deliveries.*, consumers.nama_konsumen, consumers.alamat, items.nama_barang, items.sku, items.satuan, users.nama_lengkap');
        $this->db->join('consumers', 'consumers.id = deliveries.konsumen_id', 'left');
        $this->db->join('items', 'items.id = deliveries.item_id', 'left');
        $this->db->join('users', 'users.id = deliveries.created_by', 'left');
        $this->db->where('DATE(deliveries.tanggal_pengiriman) >=', $start_date);
        $this->db->where('DATE(deliveries.tanggal_pengiriman) <=', $end_date);
        $this->db->order_by('deliveries.tanggal_pengiriman', 'DESC');
        $query = $this->db->get('deliveries');
        return $query->result();
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
        $this->db->where('id', $id);
        return $this->db->delete('deliveries');
    }

    public function count_all()
    {
        return $this->db->count_all('deliveries');
    }
}
?>