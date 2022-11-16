<?php
include '../../bootstrapper.php';
$user = new User($db);
$criteria = new Criteria($db);
$score = new Score($db);
$part = new Participant($db);
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) {
	case 'add': 	
		$criteria->program_id = $_POST['program_id']; 
		$criteria->criteria = $_POST['criteria']; 
		$criteria->description = $_POST['description']; 
		$criteria->percentage = $_POST['percentage']; 
		$criteria->save(); 

		header('location: '.URLROOT.'/app/views/programs/?view=program_info&program_id='.$_POST['program_id']);
		break;

	case 'get_score':	 	
		$criterias = $criteria->criteria_in_program_id($_POST['program_id']);
		$participants = $part->participants_by_id($_POST['participant_id']);
		load_form($score, $criterias, $_POST['judge_id'], $participants, $_POST['program_id']);
		break;

	case 'submit_score':  
		$score->criteria_id = $_POST['criteria_id'];
		$score->score = $_POST['score'];
		$score->participant_id = $_POST['participant_id'];
		$score->program_id = $_POST['program_id'];
		$score->judge_id = $_POST['judge_id']; 

		if (isset($_POST['score_id']) > 0) {
			$score->date_time_updated = date('Y-m-d H:i:s');
			$score->update($_POST['score_id']);
			$msg = array('msg_type' => 'success', 'msg' => 'Score updated Successfully');
			// $_SESSION['msg_success'] = "Score updated Successfully";
		}else{
			$score->save();
			$msg = array('msg_type' => 'success', 'msg' => 'Score Submitted Successfully');
			// $_SESSION['msg_success'] = "Score Submitted Successfully";
		}  
		echo json_encode($msg); 
		break;

	case 'edit':  
		   
		break;

	case 'destroy':
	
	case 'edit': 
		  
		break; 
	default:
		// code...
		break;
}   

function load_form($score, $criterias, $judge_id, $participant, $program_id){
	?>
		<form action="#" id="submit_score_form" method="POST">
			<h2 class="display-4"><?php echo $participant->participant_name ?></h2>
			<input type="hidden" name="judge_id" value="<?php echo $judge_id ?>">
			<input type="hidden" name="program_id" value="<?php echo $program_id ?>">
			<input type="hidden" name="participant_id" value="<?php echo $participant->participant_id ?>">
		  <?php foreach ($criterias as $key => $crit): ?>
	  	<div class="mb-3">
	      <label class="form-label mb-0"><?php echo $crit->criteria.' - '.$crit->percentage.'%' ?></label> 
	      <small class="text-info"><?php echo $crit->description ?></small>
<?php echo (!empty($score->score_by_criteria_participant_judge($crit->criteria_id, $participant->participant_id, $judge_id)->score_id)) ? '<input type="text" name="update" hidden>' : ''; ?>
	      <input type="hidden" name="criteria_<?php echo $crit->criteria_id ?>" value="<?php echo $crit->criteria_id ?>">
 				
	      <input type="number" min="0" max="<?php echo $crit->percentage ?>" 
	      name="score_<?php echo $crit->criteria_id ?>" 
	      class="form-control form-control-lg mt-2" 
	      placeholder="0" 
	      value="<?php echo (!empty($score->score_by_criteria_participant_judge($crit->criteria_id, $participant->participant_id, $judge_id)->score)) ? $score->score_by_criteria_participant_judge($crit->criteria_id, $participant->participant_id, $judge_id)->score : "0"?>" required />
	    </div>
		  <?php endforeach ?>

		  <button type="submit" class="btn <?php echo ($score->count_scores_exist($crit->criteria_id, $participant->participant_id, $judge_id ) > 0) ? "btn-warning" : "btn-success"?> " id="save_score"><?php echo ($score->count_scores_exist($crit->criteria_id, $participant->participant_id, $judge_id ) > 0) ? "Update Score" : "Submit Score"?></button> 
		</form>

		<script type="text/javascript">
			$(document).ready(function() { 				
				$( "#submit_score_form" ).on( "submit", function( event ) {
				  event.preventDefault();
				  var form = $(this);
				  $.ajax({
				  	url: '<?php echo URLROOT ?>/app/controller/score_controller.php?action=submit_score',
				  	type: 'POST',
						dataType: 'json',
				  	data: form.serialize(),
				  })
				  .done(function(response) {
				  	showMessage('green', 'Success!', response.msg)
				  	console.log('success');
				  	console.log(response);
				  })
				  .fail(function(response) {
				  	showMessage('red', 'Alert!', response.msg)
				  	console.log('error');
				  	console.log(response);
				  }); 
				}); 
			});
		</script>
	<?php
}

?> 
