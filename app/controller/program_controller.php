<?php
include '../../bootstrapper.php';
$program = new Program($db); 
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'add': 	
		$program->program_name = $_POST['program_name'];
		$program->event_id = $_POST['event_id'];
		$program->category_id = $_POST['category_id'];
		$program->save(); 

		header('location: '.URLROOT.'/app/views/programs/');
		break;

	case 'edit': 
		
		$program->program_name = $_POST['program_name'];
		$program->event_id = $_POST['event_id'];
		$program->category_id = $_POST['category_id'];
		$program->update($_POST['program_id']);		  
		header('location: '.URLROOT.'/app/views/programs/?view=program_info&program_id='.$_POST['program_id']);
		break;

	case 'destroy':

		$program->delete($_GET['program_id']);
		 
		header('location: '.URLROOT.'/app/views/programs/');
		break; 
	default:
		// code...
		break;
}   

?>