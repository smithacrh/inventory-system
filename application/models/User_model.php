<?php
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_by_username($username) {
        return $this->db->get_where('users', array('username' => $username))->row();
    }

    public function get_by_id($id) {
        return $this->db->get_where('users', array('id' => $id))->row();
    }

    public function get_all() {
        return $this->db->get('users')->result();
    }

    public function create($data) {
        return $this->db->insert('users', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete($id) {
        return $this->db->delete('users', array('id' => $id));
    }

    public function verify_password($password, $hash) {
        return password_verify($password, $hash);
    }

    public function hash_password($password) {
        return password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
    }
}
