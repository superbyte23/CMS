<?php 

function redirect($url){
	return header('location: '.$url);
}

function csrf(){ 
	$_SESSION['token'] = bin2hex(random_bytes(32)); 
  	$token = $_SESSION['token']; 
	echo "<input type='hidden' name='token' value='".$token."' />";
}



?>