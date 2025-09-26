<?php
/**
 * All the requests will starts from here.
 * Author: Sugashri N
*/


error_reporting(E_ALL); 
//ini_set("display_errors", 1); 
session_start();
// deduce the application root from this file's location
define('APP_ROOT', dirname(__FILE__));

//echo dirname(__FILE__); 
//exit;



// identify which environment to set-up 
$env = 'development';

// put most likely paths first
set_include_path('.'
    . PATH_SEPARATOR . APP_ROOT . '/controllers'
    . PATH_SEPARATOR . APP_ROOT . '/lib'
    . PATH_SEPARATOR . APP_ROOT . '/models'
    . PATH_SEPARATOR . get_include_path()
    . PATH_SEPARATOR . APP_ROOT . '/thirdpartylibs/Smarty'
    . PATH_SEPARATOR . APP_ROOT . '/views'
);


// by using PEAR-type naming conventions, autoload will always know where to 
// find class definitions
spl_autoload_register(function($class)
{
	
    $directories = explode(";", get_include_path());
    foreach ($directories as $directory) {
	
	if ($directory != ".") {
		$filename = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
		if (file_exists($directory . DIRECTORY_SEPARATOR . $filename)) {   
			require($filename);
			break;
		}
	}
    }
});

date_default_timezone_set('Asia/Kolkata');

// run the request
Router::route($_SERVER['REQUEST_URI']);

session_write_close();
