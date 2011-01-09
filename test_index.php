<?php

$application = 'application';
$modules = 'modules';
$system = 'system';

define('EXT', '.php');

// Set the full path to the docroot
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Make the application relative to the docroot
if ( ! is_dir($application) AND is_dir(DOCROOT.$application))
{
	$application = DOCROOT.$application;
}
// Make the modules relative to the docroot
if ( ! is_dir($modules) AND is_dir(DOCROOT.$modules))
{
	$modules = DOCROOT.$modules;
}
// Make the system relative to the docroot
if ( ! is_dir($system) AND is_dir(DOCROOT.$system))
{
	$system = DOCROOT.$system;
}
// Define the absolute paths for configured directories
define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);
// Clean up the configuration vars
unset($application, $modules, $system);
if (file_exists('install'.EXT))
{
	// Load the installation check
	return include 'install'.EXT;
}
// Load the base, low-level functions
require SYSPATH.'base'.EXT;
// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;
if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}
// Bootstrap the application
require APPPATH.'test_bootstrap'.EXT;
