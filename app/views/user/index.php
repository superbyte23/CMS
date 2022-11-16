<?php
include '../../../bootstrapper.php'; 
$user = new User($db);
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
switch ($view) {
  case 'create':
    $pagetitle = "Add User"; 
    $content = "create.php";
    break;
  case 'edit':
    $userdata = $user->edit($_GET['id']);
    $pagetitle = "Edit User";
    $content = "edit.php";
    break; 
  default: 
    $users = $user->all();
    $pagetitle = "Users";
    $content = "main.php";
    break;
}
include APPROOT.'/layout/template.php'; 

?>