<?php
default_controller('auth');
default_model('Auth_model');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Auth Routes */
$route['auth'] = 'auth/index';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';

/* Dashboard */
$route['dashboard'] = 'dashboard/index';

/* Consumer Routes */
$route['consumer'] = 'consumer/index';
$route['consumer/get_datatable'] = 'consumer/get_datatable';
$route['consumer/create'] = 'consumer/create';
$route['consumer/update'] = 'consumer/update';
$route['consumer/delete'] = 'consumer/delete';

/* Item Category Routes */
$route['item_category'] = 'item_category/index';
$route['item_category/get_datatable'] = 'item_category/get_datatable';
$route['item_category/create'] = 'item_category/create';
$route['item_category/update'] = 'item_category/update';
$route['item_category/delete'] = 'item_category/delete';

/* Item Routes */
$route['item'] = 'item/index';
$route['item/get_datatable'] = 'item/get_datatable';
$route['item/create'] = 'item/create';
$route['item/update'] = 'item/update';
$route['item/delete'] = 'item/delete';
$route['item/add_stock'] = 'item/add_stock';
$route['item/save_stock'] = 'item/save_stock';

/* Production Routes */
$route['production'] = 'production/index';
$route['production/get_datatable'] = 'production/get_datatable';
$route['production/create'] = 'production/create';
$route['production/delete'] = 'production/delete';

/* Cutting Routes */
$route['cutting'] = 'cutting/index';
$route['cutting/get_datatable'] = 'cutting/get_datatable';
$route['cutting/create'] = 'cutting/create';
$route['cutting/delete'] = 'cutting/delete';

/* Delivery Routes */
$route['delivery'] = 'delivery/index';
$route['delivery/get_datatable'] = 'delivery/get_datatable';
$route['delivery/create'] = 'delivery/create';
$route['delivery/delete'] = 'delivery/delete';

/* Report Routes */
$route['report/stock_recap'] = 'report/stock_recap';
$route['report/production_recap'] = 'report/production_recap';
$route['report/cutting_recap'] = 'report/cutting_recap';
$route['report/waste_recap'] = 'report/waste_recap';
$route['report/delivery_recap'] = 'report/delivery_recap';

/* User Routes */
$route['user'] = 'user/index';
$route['user/get_datatable'] = 'user/get_datatable';
$route['user/create'] = 'user/create';
$route['user/update'] = 'user/update';
$route['user/delete'] = 'user/delete';
