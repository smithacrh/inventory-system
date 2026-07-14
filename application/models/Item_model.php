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
        $query = $this->db->get('items');
        return $query->result();
    }

    public function get_all_with_category()
    {
        $this->db->select('items.*, categories.nama_kategori');
        $this->db->join('categories', 'categories.id = items.kategori_id', 'left');
        $query = $this->db->get('items');
        return $query->result();
    }

    public function get_all_with_value()
    {
        $this->db->select('items.*, categories.nama_kategori, (items.stok * items.harga_satuan) as total_value');
        $this->db->join('categories', 'categories.id = items.kategori_id', 'left');
        $query = $this->db->get('items');
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('items');
        return $query->row();
    }

    public function get_low_stock($limit = 10)
    {
        $this->db->select('items.*, categories.nama_kategori');
        $this->db->join('categories', 'categories.id = items.kategori_id', 'left');
        $this->db->where('items.stok <=', $this->db->query('SELECT minimum_stok FROM items'));
        $this->db->limit($limit);
        $query = $this->db->get('items');
        return $query->result();
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
        $this->db->where('id', $id);
        return $this->db->delete('items');
    }

    public function update_stock($id, $amount, $operation = 'add')
    {
        $item = $this->get_by_id($id);
        if (!$item) return false;

        $new_stock = $operation === 'add' ? $item->stok + $amount : $item->stok - $amount;
        $new_stock = max(0, $new_stock); // Prevent negative stock

        return $this->update($id, ['stok' => $new_stock, 'updated_at' => date('Y-m-d H:i:s')]);
    }

    public function get_total_stock_value()
    {
        $this->db->select_sum('(stok * harga_satuan)', 'total_value');
        $query = $this->db->get('items');
        $result = $query->row();
        return $result->total_value ?? 0;
    }

    public function count_all()
    {
        return $this->db->count_all('items');
    }
}
?>