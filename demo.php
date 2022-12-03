<?php

include 'bootstrapper.php';
$prog = new Program($db);
$score = new Score($db);
$crit = new Criteria($db);
$judge = new Judge($db);
// show program information
$program_info = $prog->program_by_id($_GET['program']);
// show criteria in programs
$criterias = $crit->criteria_in_program_id($_GET['program']);
// get judge id from table judge not from user
$judge_info = $judge->judge_info($_SESSION['userid'], $_GET['program']);

$participants = $ptcpnt->participants_in_program_id($_GET['program']);


?>
<?php foreach ($participants as $key => $part): ?>

    <?php
    $rank_list[$part->participant_id] = $score->total_score_by_participant_each_judge($part->participant_id, $judge_info->judge_id)->total_score;
    $rank_list_raw[] = $score->total_score_by_participant_each_judge($part->participant_id, $judge_info->judge_id)->total_score;
    echo $score->total_score_by_participant_each_judge($part->participant_id, $judge_info->judge_id)->total_score;
     
    $sql = "SELECT participants.participant_id, participants.participant_name, judges.judge_id, users.fullname, SUM(`score`) AS OVERALL_SCORE_BY_JUDGE, RANK() OVER(PARTITION BY judges.judge_id ORDER BY SUM(`score`) DESC ) AS RANK_BY_JUDGES FROM `scores` LEFT JOIN judges ON scores.judge_id = judges.judge_id LEFT JOIN users ON judges.user_id = users.id LEFT JOIN participants ON scores.participant_id = participants.participant_id WHERE scores.program_id = ".$_GET['program']." AND judges.judge_id = ".$judge_info->judge_id." GROUP BY scores.`participant_id`, scores.`judge_id` ORDER BY judges.judge_id, scores.participant_id;";
    //echo $sql;
    $db->setQuery($sql);
    $ranks = $db->results_obj();
    foreach ($ranks as $key => $rank) {
      if ($rank->participant_id == $part->participant_id) {
       echo "<td class='bg-green-lt'>".$rank->RANK_BY_JUDGES."</td>";
      }
    }
  ?>
</tr>
<?php endforeach ?>

  <p>Total Score by participant</p>
  <?php dd($rank_list); ?>
  <p>RANK by total score of each participant</p>
  <?php $rank_average = rankify_asc($rank_list_raw, count($rank_list_raw));  ?>
  <?php dd($rank_average); ?>
  <?php 
    $counter = 0;
    foreach ($rank_list as $index => $val) { 
        $final_rank[$index] = $rank_average[$counter]; 
        $counter = $counter + 1;
    }
  ?>
        <?php dd($final_rank); ?>