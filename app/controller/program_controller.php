<?php
include '../../bootstrapper.php';
$program = new Program($db); 
$judge = new Judge($db); 
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'add': 	
		$program->program_name = $_POST['program_name'];
		$program->event_id = $_POST['event_id'];
		$program->category_id = $_POST['category_id'];
		$program->save(); 

		header('location: '.URLROOT.'/app/views/programs/');
		break;

	case 'delete_judges':  
	foreach ($_POST['judge_id'] as $key => $judge_id) {
		$judge->delete($judge_id);
	}
	header('location: '.URLROOT.'/app/views/programs/?view=program_info&program_id='.$_POST['program_id']);
	break;

	case 'edit': 
		
		$program->program_name = $_POST['program_name'];
		$program->event_id = $_POST['event_id'];
		$program->category_id = $_POST['category_id'];
		$program->update($_POST['program_id']);		  
		header('location: '.URLROOT.'/app/views/programs/?view=program_info&program_id='.$_POST['program_id']);
		break;

	case 'generate_scoresheet': 

		$judgeObj = new Judge($db);
		$partcpntObj = new Participant($db);
		$critObj = new Criteria($db); 
		$judgeList = $judgeObj->judges_by_program($_POST['program_id']);
	 	$partcpntList = $partcpntObj->participants_in_program_id($_POST['program_id']);
		$critList = $critObj->criteria_in_program_id($_POST['program_id']);
		$sql = "";
		$counter = 1;
		foreach ($judgeList as $key => $jd) {
			foreach ($critList as $key => $crit) { 
				foreach ($partcpntList as $key => $part) { 
					$sql .= $counter++." INSERT INTO `scores`(`program_id`, `judge_id`, `criteria_id`, `participant_id`, `score`) VALUES (".$_POST['program_id'].", ".$jd->judge_id.", ".$crit->criteria_id.", ".$part->participant_id.", '');<br>";
				}
			} 
		}		 
	 	echo $sql;
	 	die();
		echo $db->InsertThis($sql);
		header('location: '.URLROOT.'/app/views/programs/?view=program_info&program_id='.$_POST['program_id']);
		break;

		case 'viewscoresheet': 

		require_once 'demo.php';
		
		break;

		case 'reset_scoresheet': 

		$sql = "UPDATE scores SET score = '' WHERE program_id = ".$_POST['program_id'];
		$db->setQuery($sql);
		header('location: '.URLROOT.'/app/views/programs/?view=program_info&program_id='.$_POST['program_id']);
		break;


	case 'destroy': 
		$program->delete($_GET['program_id']);
		// delete all records with program id
		$db->setQuery("DELETE FROM `criteria` WHERE `program_id` =".$_GET['program_id']);
		$db->setQuery("DELETE FROM `scores` WHERE `program_id` =".$_GET['program_id']);
		$db->setQuery("DELETE FROM `participants` WHERE `program_id`=".$_GET['program_id']);
		$db->setQuery("DELETE FROM `judges` WHERE `program_id` =".$_GET['program_id']);
		
		header('location: '.URLROOT.'/app/views/programs/');
		break; 
	default:
		// code...
		break;
}

?>