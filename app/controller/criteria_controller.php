<?php
include '../../bootstrapper.php';
$user = new User($db);
$criteria = new Criteria($db);
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'add': 	
		$criteria->program_id = $_POST['program_id']; 
		$criteria->criteria = $_POST['criteria']; 
		$criteria->description = $_POST['description']; 
		$criteria->percentage = $_POST['percentage']; 
		$criteria->save(); 

		header('location: '.URLROOT.'/app/views/programs/?view=program_info&program_id='.$_POST['program_id']);
		break;

	case 'edit': 
	
		  
		// header('location: '.URLROOT.'/app/views/user');
		break;

	case 'destroy': 
		 
		// header('location: '.URLROOT.'/app/views/user');
		break; 
	default:
		// code...
		break;
}   

?>