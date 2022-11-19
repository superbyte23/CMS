<?php
include '../../bootstrapper.php';
$user = new User($db);
$participant = new Participant($db);
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'add': 	
		$participant->participant_name = $_POST['name'];
		$participant->program_id = $_POST['program_id'];
		$participant->department = $_POST['department'];
		$participant->save();

		header('location: '.URLROOT.'/app/views/programs/?view=program_info&program_id='.$_POST['program_id']);
		break;

	case 'edit': 
		 $data = $participant->participants_by_id($_POST['id']);
		 echo json_encode($data); 
		// header('location: '.URLROOT.'/app/views/user');
		break;
	case 'update': 
		print_r($_POST);
		$participant->participant_name = $_POST['participant_name'];
		$participant->department = $_POST['department'];
		$participant->update($_POST['participant_id']);
		header('location: '.URLROOT.'/app/views/programs/?view=program_info&program_id='.$_POST['program_id']);
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