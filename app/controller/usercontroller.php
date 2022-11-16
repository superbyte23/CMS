<?php
include '../../bootstrapper.php';
$user = new User($db);
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'add':
		csrf_token(); 
		$run = $user->store($_POST);
		if ($run > 0) { 
			msgbox('success', 'Success!', 'User added successfully.');
		}else{
			msgbox('danger', 'Error in performing a task!', 'No user is added successfully!'); 
		}
		header('location: '.URLROOT.'/app/views/user');
		break;

	case 'edit': 
		csrf_token();
		$run = $user->change($_POST);
		if ($run > 0) { 
			msgbox('success', 'Success!', 'User updated successfully.');
		}else{
			msgbox('danger', 'Error in performing a task!', 'No user is updated successfully!'); 
		} 
		header('location: '.URLROOT.'/app/views/user');
		break;

	case 'destroy':
		csrf_token();
		$run = $user->destroy($_POST['id']);
		if ($run > 0) { 
			msgbox('success', 'Success!', 'User deleted successfully!');
		}else{
			msgbox('danger', 'Error in performing a task!', 'No user is deleted successfully!'); 
		}
		header('location: '.URLROOT.'/app/views/user');
		break;

	case 'login':
		csrf_token();
		$run = $user->login($_POST['username'], $_POST['password']);
		if ($run > 0) { 
			header('location: '.URLROOT.'/app/views');
		}else{
			$_SESSION['error_login'] = "Invalid Credentials! Please try again!";
			// msgbox('danger', 'Invalid Credentials!', 'Please try again!');
			header('location: '.URLROOT.'/app/login.php');
		}
		break;

	case 'register':
		csrf_token();
		$run = $user->register($_POST);
		if ($run > 0) { 
			header('location: '.URLROOT.'/app/views');
		}else{
			msgbox('danger', 'Error in performing a task!', 'Please try again!'); 
			header('location: '.URLROOT.'/app/register.php');
		}
		break;

	case 'logout':
		destroy_session();
		header('location: '.URLROOT.'/app');
		break;

	default:
		// code...
		break;
}   

?>