<?php
/*
 | -------------------------------------------------------------------
 | Autoload Classes
 | -------------------------------------------------------------------
 |
 | Prototype:
 |
 |	$autoload['libraries'] = array('database', 'session');
 |
 */
$autoload['libraries'] = array('database', 'form_validation', 'session');

/*
 | -------------------------------------------------------------------
 | Autoload Drivers
 | -------------------------------------------------------------------
 |
 | These classes are located in a subdirectory, but as of loading
 | database and session libraries, we are not going to use the subclass
 | prefix.
 |
 | Prototype:
 |
 |	$autoload['drivers'] = array('cache', 'session');
 |
 */
$autoload['drivers'] = array();

/*
 | -------------------------------------------------------------------
 | Autoload Helper Files
 | -------------------------------------------------------------------
 |
 | Prototype:
 |
 |	$autoload['helper'] = array('url', 'file');
 |
 */
$autoload['helper'] = array('url', 'form', 'file', 'custom');

/*
 | -------------------------------------------------------------------
 | Autoload Plugins
 | -------------------------------------------------------------------
 |
 | Prototype:
 |
 |	$autoload['plugin'] = array('googlecharts' => array("height" => "400px", "width" => "900px"),);
 |
 */
$autoload['plugin'] = array();

/*
 | -------------------------------------------------------------------
 | Autoload Models
 | -------------------------------------------------------------------
 |
 | Prototype:
 |
 |	$autoload['model'] = array('first_model', 'second_model');
 |
 */
$autoload['model'] = array();
