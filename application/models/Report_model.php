<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_stock_report()
    {
        $this->db->select('items.*, categories.nama_kategori, (items.stok * items.harga_satuan) as total_value');
        $this->db->join('categories', 'categories.id = items.kategori_id', 'left');
        $this->db->order_by('items.nama_barang', 'ASC');
        $query = $this->db->get('items');
        return $query->result();
    }

    public function get_waste_report($start_date, $end_date)
    {
        $this->db->select('items.id, items.nama_barang, items.sku, 
            SUM(productions.jumlah_produksi) as total_produksi,
            SUM(cuttings.jumlah_cutting) as total_cutting,
            SUM(cuttings.jumlah_waste) as total_waste,
            SUM(deliveries.jumlah_pengiriman) as total_delivery');
        $this->db->join('productions', 'productions.item_id = items.id', 'left');
        $this->db->join('cuttings', 'cuttings.item_id = items.id', 'left');
        $this->db->join('deliveries', 'deliveries.item_id = items.id', 'left');
        $this->db->where('DATE(productions.created_at) >=', $start_date);
        $this->db->where('DATE(productions.created_at) <=', $end_date);
        $this->db->group_by('items.id');
        $query = $this->db->get('items');
        return $query->result();
    }
}
?>