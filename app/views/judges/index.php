<?php
include '../../../bootstrapper.php'; 
$event = new Event($db);
$user = new User($db);
$judge = new Judge($db); 
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$pagetitle = "";
switch ($view) {
  case 'create':
    $pagetitle = "Add New Judge";
    $content = "create.php";
    break; 
  case 'edit':
    
    break;
  case 'info': 
    $pagetitle = "Judge Information";
    $judge_info = $user->edit($_GET['id']);
    // show programs
    $programs = $judge->judges_programs($_GET['id']);
    $content = "info.php";
    break; 
  default: 
    $judges = $user->users_by_usertype('judge');
    $pagetitle = "Judges";
    $content = "main.php";
    break;
}
include APPROOT.'/layout/template.php'; 

?>