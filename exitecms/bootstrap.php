<?php

// Load in the Autoloader
require COREPATH.'classes'.DIRECTORY_SEPARATOR.'autoloader.php';
class_alias('Fuel\\Core\\Autoloader', 'Autoloader');

// Bootstrap the framework DO NOT edit this
require COREPATH.'bootstrap.php';


// Add classes you want to override here
Autoloader::add_classes(array(
	'Theme' => APPPATH.'classes/theme.php',
	'View' => APPPATH.'classes/view.php',
));

// Register the autoloader
Autoloader::register();

Fuel::$env = (isset($_SERVER['FUEL_ENV']) ? $_SERVER['FUEL_ENV'] : Fuel::DEVELOPMENT);

// Initialize the framework with the config file.
Fuel::init('config.php');
