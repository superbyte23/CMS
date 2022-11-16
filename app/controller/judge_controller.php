<?php
include '../../bootstrapper.php';
$user = new User($db);
$judge = new Judge($db);
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'assign': 	
		foreach ($_POST['judge'] as $key => $value) {
			$judge->user_id = $value;
			$judge->program_id = $_POST['program_id'];
			$judge->save();
		}

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