<?php
include '../../../bootstrapper.php'; 
$event = new Event($db);
$program = new Program($db);
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$pagetitle = "";
switch ($view) {
  case 'create':
    $pagetitle = "Add Event";
    $content = "create.php";
    break;
  case 'event_programs':

    $programs = $program->all_programs_by_event_id($_GET['event_id']);
    $pagetitle = "Event Programs";
    $content = "event_programs.php";
    break;
  case 'edit':
    $event_info = $event->edit($_GET['id']);
    $pagetitle = "Edit Event";
    $content = "edit.php";
    break; 
  default: 
    $events = $event->all();
    $pagetitle = "Events";
    $content = "main.php";
    break;
}
include APPROOT.'/layout/template.php'; 

?>