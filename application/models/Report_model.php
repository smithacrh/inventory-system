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
        $this->db->select('i.id, i.item_name, c.category_name, i.stock, i.unit, i.price, (i.stock * i.price) as total_value');
        $this->db->from('items i');
        $this->db->join('categories c', 'i.category_id = c.id', 'left');
        $this->db->order_by('c.category_name', 'ASC');
        $this->db->order_by('i.item_name', 'ASC');
        return $this->db->get()->result();
    }

    public function get_stock_by_category()
    {
        return $this->db->query("
            SELECT 
                c.category_name,
                COUNT(i.id) as total_items,
                SUM(i.stock) as total_stock,
                SUM(i.stock * i.price) as total_value
            FROM items i
            LEFT JOIN categories c ON i.category_id = c.id
            GROUP BY c.id, c.category_name
            ORDER BY c.category_name ASC
        ")->result();
    }

    public function get_waste_report()
    {
        return $this->db->query("
            SELECT 
                i.id,
                i.item_name,
                c.category_name,
                COUNT(p.id) as production_count,
                SUM(p.quantity) as total_production,
                COUNT(cu.id) as cutting_count,
                SUM(cu.quantity) as total_cutting,
                COUNT(d.id) as delivery_count,
                SUM(d.quantity) as total_delivery,
                (SUM(p.quantity) - SUM(cu.quantity) - SUM(d.quantity)) as waste
            FROM items i
            LEFT JOIN categories c ON i.category_id = c.id
            LEFT JOIN productions p ON i.id = p.item_id
            LEFT JOIN cuttings cu ON i.id = cu.item_id
            LEFT JOIN deliveries d ON i.id = d.item_id
            WHERE MONTH(p.production_date) = MONTH(NOW())
            GROUP BY i.id, i.item_name
            HAVING waste > 0
            ORDER BY waste DESC
        ")->result();
    }

    public function get_production_summary($start_date, $end_date)
    {
        return $this->db->query("
            SELECT 
                i.item_name,
                c.category_name,
                COUNT(p.id) as total_production,
                SUM(p.quantity) as total_quantity,
                MAX(p.production_date) as last_production_date
            FROM productions p
            LEFT JOIN items i ON p.item_id = i.id
            LEFT JOIN categories c ON i.category_id = c.id
            WHERE DATE(p.production_date) >= '$start_date'
            AND DATE(p.production_date) <= '$end_date'
            GROUP BY i.id, i.item_name, c.category_name
            ORDER BY total_quantity DESC
        ")->result();
    }

    public function get_cutting_summary($start_date, $end_date)
    {
        return $this->db->query("
            SELECT 
                i.item_name,
                c.category_name,
                COUNT(cu.id) as total_cutting,
                SUM(cu.quantity) as total_quantity,
                MAX(cu.cutting_date) as last_cutting_date
            FROM cuttings cu
            LEFT JOIN items i ON cu.item_id = i.id
            LEFT JOIN categories c ON i.category_id = c.id
            WHERE DATE(cu.cutting_date) >= '$start_date'
            AND DATE(cu.cutting_date) <= '$end_date'
            GROUP BY i.id, i.item_name, c.category_name
            ORDER BY total_quantity DESC
        ")->result();
    }

    public function get_delivery_summary($start_date, $end_date)
    {
        return $this->db->query("
            SELECT 
                co.name as consumer_name,
                i.item_name,
                COUNT(d.id) as total_delivery,
                SUM(d.quantity) as total_quantity,
                MAX(d.delivery_date) as last_delivery_date
            FROM deliveries d
            LEFT JOIN consumers co ON d.consumer_id = co.id
            LEFT JOIN items i ON d.item_id = i.id
            WHERE DATE(d.delivery_date) >= '$start_date'
            AND DATE(d.delivery_date) <= '$end_date'
            GROUP BY d.consumer_id, d.item_id
            ORDER BY total_quantity DESC
        ")->result();
    }

}
?>