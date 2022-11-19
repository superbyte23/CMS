<?php  
include '../../bootstrapper.php';
if (!isset($_SESSION['userid'])){ 
	redirect(URLROOT.'/app'); 
}else{
	$user = new User($db);  
	$prog = new Program($db);
	$crit = new Criteria($db);
	$ptcpnt = new Participant($db);
	$dpt = new Department($db);
	$evnt = new Event($db);
	$judge = new Judge($db);
	$score = new Score($db);
	$programs_to_judges = $judge->judges_programs($_SESSION['userid']);
	$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
	 
	if ($user->getUser($_SESSION['userid'])->usertype == 'judge') {
		switch ($view) {
			case 'judge':
				
				break; 
			case 'program_scoresheet':
				// show judges score sheets for selected program
				// show program information
				$program_info = $prog->program_by_id($_GET['program']);
				// show program criteria
				$program_criteria = $crit->criteria_in_program_id($_GET['program']);
				// show program participants/contestants 
				$participants = $ptcpnt->participants_in_program_id($_GET['program']);

				$pagetitle = "Judges Portal";
	    	$content = "program_scoresheet.php";
				break;
			default: 

				$pagetitle = "Judges Portal";
	    	$content = "judges_portal.php";
				break;
		}
	}elseif ($user->getUser($_SESSION['userid'])->usertype == 'tabulator') {
		switch ($view) {
			case 'tally_sheet':
				// show program information
				$program_info = $prog->program_by_id($_GET['program']);
				// show criteria in programs
				$criterias = $crit->criteria_in_program_id($_GET['program']);
				// show all judges in a program
				$judges_in_program = $judge->judges_by_program($_GET['program']);
				$pagetitle = "Tabulators Portal";
	    	$content = "tally_sheet.php";
				break; 
			default: 

				$pagetitle = "Tabulators Portal";
	    	$content = "tabulator_portal.php";
				break;
		}
	}else{
		switch ($view) {
			case '404':
				$content = "404.php";
			break;  
			default:
				$pagetitle = "Dashboard";
	    	$content = "dashboard.php";
				break;
		}
	} 
	 

} 
include APPROOT.'/layout/template.php';
?>
<!-- <script src="<?php echo URLROOT ?>/public/plugins/chart.js/Chart.min.js"></script> -->
<!-- <script src="<?php echo URLROOT ?>/public/dist/js/pages/dashboard3.js"></script> -->
<script type="text/javascript">
	$(document).ready(function() {
		$('.link-layout-list').on('click', function(){
			$('.row-cards').removeClass('row-cols-lg-3 row-cols-xl-4');
		});

		$('.link-layout-grid').on('click', function(){
			$('.row-cards').addClass('row-cols-lg-3 row-cols-xl-4');
		}); 
	});
</script> 
<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->