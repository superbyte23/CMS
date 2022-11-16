<?php
include '../../../bootstrapper.php';  
$program = new Program($db);
$event = new Event($db);
$category = new Category($db);
$department = new Department($db);
$participant = new Participant($db);
$criteria = new Criteria($db);
$judge = new Judge($db); 
$user = new User($db); 
$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$pagetitle = "";
switch ($view) {
  case 'create':
    $pagetitle = "Add Program";
    $content = "create.php";
    break;
  case 'event_programs': 
    $programs = $program->all_programs_by_event_id($_GET['event_id']);
    $pagetitle = "Event Programs";
    $content = "event_programs.php";
    break;
  case 'program_info': 
    // Program information
    $program_info = $program->program_by_id($_GET['program_id']); 
    // contestants per program
    $participants = $participant->participants_in_program_id($_GET['program_id']);
    // criteria per program
    $criterias = $criteria->criteria_in_program_id($_GET['program_id']);
    // return all registered judge to a particular program
    $assigned_judges = $judge->judges_by_program($_GET['program_id']);
    
    $x=array();
    if (empty($assigned_judges)){
      $filter = 0;
    }else{
      foreach ($assigned_judges as $judge) {
        array_push($x, $judge->user_id);
      }
      $filter = implode(", ",$x);
    }   
    
    // all users data as judges filtered not exist in the judge table
    $judges = $user->find_users_not_in_judges('judge', $filter); 
    $content = "program_info.php";
    break;
  case 'edit':
    $program_info = $program->edit($_GET['program_id']);
    $pagetitle = "Edit Program";
    $content = "edit.php";
    break; 
  default: 
    $allPrograms = $program->all();
    $pagetitle = "All Programs";
    $content = "main.php";
    break;
}
include APPROOT.'/layout/template.php'; 

?>