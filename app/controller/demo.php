<?php 
$prog = new Program($db); 
$crit = new Criteria($db); 
$judge = new Judge($db);

// show program information
$program_info = $prog->program_by_id($_POST['id']);
// show criteria in programs
$criterias = $crit->criteria_in_program_id($_POST['id']);
// show all judges in a program
$judges_in_program = $judge->judges_by_program($_POST['id']);

// for ranking only
$sql = "SELECT
participants.participant_id,
participants.participant_name,";
$filter = "";
$totalrank = "";
foreach ($judges_in_program as $key => $j) {
  $filter .= "SUM(CASE WHEN scores.`judge_id` = ".$j->judge_id." THEN scores.`score` ELSE 0 END ) as '".$j->fullname."', ";
  $totalrank .= "SUM(CASE WHEN scores.`judge_id` = ".$j->judge_id." THEN scores.`score` ELSE 0 END ) + ";
} 
$sql .= $filter;
$sql .= "(".rtrim($totalrank, '+ ').") AS TOTAL_RANK "; 
$sql .= "
FROM scores
LEFT JOIN participants ON scores.participant_id = participants.participant_id
WHERE scores.program_id = ".$_POST['id']."
GROUP BY
scores.participant_id
ORDER BY
participant_id;";

$db->setQuery($sql);
$scores = $db->results_obj();

// get all total score by judegs for each participant
foreach ($scores as $key => $sc) {
  foreach($judges_in_program as $key => $jd){ 
    $prop = $jd->fullname; 
    $judge_score_list[$jd->judge_id][$sc->participant_id] = $sc->$prop;
  } 
}

  // dd($judge_score_list);

// create seperate array for each judge of scores 
foreach ($judge_score_list as $key => $value) {
  foreach($judges_in_program as $index => $jd){
    if ($key == $jd->judge_id) { 
      ${$jd->usertype.$jd->judge_id} = $value; //create variable to store array 
      ${$jd->usertype.$jd->judge_id} = generateRank_asc(${$jd->usertype.$jd->judge_id});
    }
  }
}

 $final_totalrank = array();

// generate dynamic variables
foreach ($scores as $key => $data) {
    foreach($judges_in_program as $key => $jd){
      foreach (${$jd->usertype.$jd->judge_id} as $key => $value) {
        if(count(array_unique(${$jd->usertype.$jd->judge_id})) === 1) {
          if ($key == $data->participant_id) { 
              if (!isset($final_totalrank[$key])) $final_totalrank[$key] = 0;
              $final_totalrank[$key] += 0;
          }
        }else{
          if ($key == $data->participant_id) { 
            if (!isset($final_totalrank[$key])) $final_totalrank[$key] = 0;
            $final_totalrank[$key] += $value;
          }
        }
        
      }                      
    }
  }
function generateRank($array){
  $rank_list = array();
  $rank_list_raw = array();

  foreach ($array as $key => $rank){
    $rank_list[$rank->participant_id] = $rank->TOTAL_RANK;
    $rank_list_raw[] = $rank->TOTAL_RANK;
  } 
  // rank average
  $rank_average = rankify($rank_list_raw, count($rank_list_raw)); 
  // combine total rank and rank average
  
  $counter = 0;
  foreach ($rank_list as $index => $val) { 
      $final_rank[$index] = $rank_average[$counter]; 
      $counter = $counter + 1;
  }
  return $final_rank;
}

function generateFinalRank($array){
  $rank_list = array();
  $rank_list_raw = array();

  foreach ($array as $key => $rank){
    $rank_list[$key] = $rank;
    $rank_list_raw[] = $rank;
  } 
  // rank average
  $rank_average = rankify($rank_list_raw, count($rank_list_raw)); 
  // combine total rank and rank average
  
  $counter = 0;
  foreach ($rank_list as $index => $val) { 
      $final_rank[$index] = $rank_average[$counter]; 
      $counter = $counter + 1;
  }
  return $final_rank;
}

function generateRank_asc($array){
  $rank_list = array();
  $rank_list_raw = array();

  foreach ($array as $key => $rank){
    $rank_list[$key] = $rank;
    $rank_list_raw[] = $rank;
  } 
  // rank average
  $rank_average = rankify_asc($rank_list_raw, count($rank_list_raw)); 
  // combine total rank and rank average
  
  $counter = 0;
  foreach ($rank_list as $index => $val) { 
      $final_rank[$index] = $rank_average[$counter]; 
      $counter = $counter + 1;
  }
  return $final_rank;
}  
  
?>
<div class="table-responsive">
<table class="table table-bordered table-hover" id="mytable" >
  <thead class="bg-dark">
    <tr>
      <th>#</th>
      <th class="text-start">Candidates</th>
      <?php foreach ($judges_in_program as $key => $jd): ?>
      <th><a href="javascript:void(0)" class="show-score-judge" data-bs-toggle="modal" data-bs-target="#show-score-judge" data-judgeid="<?php echo $jd->judge_id ?>">View <?php echo $jd->fullname ?> Score</a></th>
      <?php endforeach ?>
      <th>TOTAL</th>
      <th class="rank">RANK</th>
    </tr>
  </thead>
  <tbody>          
    <?php

      $db->setQuery($sql);
      $results = $db->results_obj(); 
      // dd($results);  
      // $final_totalrank = array();
      ?>
    <?php foreach ($results as $key => $data): ?>
      <tr>
        <td><?php echo $key+1 ?></td>
        <td  class="text-start"><?php echo $data->participant_name ?></td>
        <?php
          // rank by judges
          foreach($judges_in_program as $key => $jd){
            if(count(array_unique(${$jd->usertype.$jd->judge_id})) === 1) {
                echo '<td></td>';
            }else{
              foreach (${$jd->usertype.$jd->judge_id} as $key => $value) {
                if ($key == $data->participant_id) {
                  echo "<td>".$value."</td>"; 
                }
              }
            }                     
          }
          // total rank
          if(count(array_unique($final_totalrank)) === 1) {
              echo '<td class="bg-green-lt"></td>';
          }else{
            foreach ($final_totalrank as $key => $value) {
              if ($key == $data->participant_id) {
                echo '<td class="bg-red-lt">'.$value.'<span class="innerrank"></span></td>';
              }
            }
          }
          // final rank
          if(count(array_unique(generateFinalRank($final_totalrank))) === 1) {
              echo '<td class="bg-green-lt"></td>';
          }else{
            foreach (generateFinalRank($final_totalrank) as $key => $rk) {
              if ($key == $data->participant_id){
                echo '<td class="bg-green-lt">'.$rk.'</td>';
              }                      
            }
          }
          
        ?> 
      </tr>
    <?php endforeach ?>
  </tbody> 
</table>  
</div> 
<script type="text/javascript">
   $(document).ready(function() { 
     $('.show-score-judge').on('click', function(event) {
        let judgeid = $(this).data('judgeid');
        console.log(judgeid);
        $.ajax({
          url: '<?php echo URLROOT ?>/app/controller/score_controller.php?action=get_overallscore_by_judge',
          type: 'POST',
          dataType: 'html',
          data: {judgeid: judgeid, program_id:<?php echo $_POST['id'] ?>},
        })
        .done(function(response) {
          $('#judge_score_content').html(response); 
        })
        .fail(function(response) { 
          $('#judge_score_content').html(response); 
        })
        .always(function(response) { 
          $('#judge_score_content').html(response); 
        });
        
        event.preventDefault();
        /* Act on the event */
     });
   });
 </script> 