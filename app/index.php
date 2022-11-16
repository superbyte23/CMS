<?php 
include '../bootstrapper.php';
if (!isset($_SESSION['userid'])){ 
	header("Location: login.php");

}else{
	header('location: ./views');
} 
?>