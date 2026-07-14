<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumer_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        $query = $this->db->get('consumers');
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('consumers');
        return $query->row();
    }

    public function search($search)
    {
        $this->db->like('nama_konsumen', $search);
        $this->db->or_like('alamat', $search);
        $this->db->or_like('telepon', $search);
        $query = $this->db->get('consumers');
        return $query->result();
    }

    public function insert($data)
    {
        return $this->db->insert('consumers', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('consumers', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('consumers');
    }

    public function count_all()
    {
        return $this->db->count_all('consumers');
    }
}
?>