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
        return $this->db->get('consumers')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('consumers', array('id' => $id))->row();
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
        return $this->db->delete('consumers', array('id' => $id));
    }

    public function count_all()
    {
        return $this->db->count_all('consumers');
    }

    public function search($keyword)
    {
        $this->db->like('name', $keyword);
        $this->db->or_like('phone', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('consumers')->result();
    }

}
?>