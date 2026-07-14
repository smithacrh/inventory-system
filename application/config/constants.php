<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
*/
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb');
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b');
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');

/*
|--------------------------------------------------------------------------
| User Roles
|--------------------------------------------------------------------------
*/
define('ROLE_ADMIN', 1);
define('ROLE_OPERATOR_ASSEMBLY', 2);
define('ROLE_OPERATOR_CUTTING', 3);
define('ROLE_DRIVER', 4);

define('ROLE_NAMES', array(
    1 => 'Admin',
    2 => 'Operator Assembly',
    3 => 'Operator Cutting',
    4 => 'Driver'
));

/*
|--------------------------------------------------------------------------
| Delivery Letter Types
|--------------------------------------------------------------------------
*/
define('DELIVERY_IN', 'in');
define('DELIVERY_OUT', 'out');

/*
|--------------------------------------------------------------------------
| Production Types
|--------------------------------------------------------------------------
*/
define('PRODUCTION_TYPE', 'production');
define('CUTTING_TYPE', 'cutting');

/* End of file constants.php */
/* Location: ./application/config/constants.php */