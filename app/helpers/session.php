<?php

session_start(); 

function pop_message(){
	if (isset($_SESSION['msg'])) {
		$title = $_SESSION['msg']['title'];
		$content  = $_SESSION['msg']['content'];
		$type = $_SESSION['msg']['type'];;
		echo 'msg("'.$type.'","'.$title.'","'.$content.'")';
		unset($_SESSION['msg']);
	}
}

function msgbox($type, $title, $content){
	$arrayMsg = array('type' => $type, 'title' => $title, 'content' => $content); 
	$_SESSION['msg'] = $arrayMsg;
}

function csrf_token(){
	if (!empty($_POST['token'])) {
	    if (hash_equals($_SESSION['token'], $_POST['token'])) {
	    	// unset($_SESSION['token']);
	        return true;
	    } else {
	        die('Error!:Forbidden action!');
	    }
	} 
}

function destroy_session(){		
	session_destroy();
	session_unset();
	return true;
}




?>