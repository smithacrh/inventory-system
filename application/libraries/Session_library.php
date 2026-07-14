<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_library extends CI_Session {

    public function __construct() {
        parent::__construct();
    }

    public function set_user_data($user_id, $username, $level) {
        $session_data = array(
            'user_id' => $user_id,
            'username' => $username,
            'level' => $level,
            'logged_in' => TRUE
        );
        $this->set_userdata($session_data);
    }

    public function is_logged_in() {
        return $this->userdata('logged_in') ? TRUE : FALSE;
    }

    public function get_user_id() {
        return $this->userdata('user_id');
    }

    public function get_user_level() {
        return $this->userdata('level');
    }

    public function clear_user_session() {
        $this->sess_destroy();
    }
}
