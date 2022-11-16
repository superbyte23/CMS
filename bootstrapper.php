<?php  
	
	require_once 'app/config/config.php';
	include 'app/config/database.php';
	$db = new DB;  
	// Autoload Class 
	spl_autoload_register(function ($class_name) {
	    include APPROOT.'/model/'.$class_name . '.php';
	});
 

	// helpers  
	require_once APPROOT.'/helpers/session.php';
	require_once APPROOT.'/helpers/functions.php';

	
?>