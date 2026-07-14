<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helpers
 */
function get_role_name($level) {
    $roles = array(
        1 => 'Admin',
        2 => 'Operator Assembly',
        3 => 'Operator Cutting',
        4 => 'Driver'
    );
    return isset($roles[$level]) ? $roles[$level] : 'Unknown';
}

function format_date($date) {
    return date('d-m-Y H:i:s', strtotime($date));
}

function format_currency($value) {
    return 'Rp ' . number_format($value, 0, ',', '.');
}

function generate_letter_number($type) {
    $date = date('YmdHis');
    $type_code = ($type == 'in') ? 'IN' : 'OUT';
    return 'SJ-' . $type_code . '-' . $date;
}

function check_access($allowed_roles) {
    $CI =& get_instance();
    $user_level = $CI->session->userdata('level');
    
    if (!in_array($user_level, $allowed_roles)) {
        return FALSE;
    }
    
    return TRUE;
}
