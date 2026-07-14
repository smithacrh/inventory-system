<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all()
    {
        return $this->db->get('users')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('users', array('id' => $id))->row();
    }

    public function get_user_by_username($username)
    {
        return $this->db->get_where('users', array('username' => $username))->row();
    }

    public function insert($data)
    {
        return $this->db->insert('users', $data);
    }

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('users', array('id' => $id));
    }

    public function count_all()
    {
        return $this->db->count_all('users');
    }

}
?>