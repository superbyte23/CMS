<?php 
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
        WHERE scores.program_id = ".$_GET['program']."
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

  foreach ($scores as $key => $data) {
    foreach($judges_in_program as $key => $jd){
      foreach (${$jd->usertype.$jd->judge_id} as $key => $value) {
        if ($key == $data->participant_id) { 
            if (!isset($final_totalrank[$key])) $final_totalrank[$key] = 0;
            $final_totalrank[$key] += $value;
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

<div class="container-fluid">
  <!-- Page title -->
  <div class=" card card-body page-header d-print-none card">
    <div class="card-stamp card-stamp-lg">
      <div class="card-stamp-icon bg-green">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line><line x1="7" y1="4" x2="17" y2="4"></line><path d="M17 4v8a5 5 0 0 1 -10 0v-8"></path><circle cx="5" cy="9" r="2"></circle><circle cx="19" cy="9" r="2"></circle></svg>
    </div>
  </div>
  <div class="card-status-top bg-green"></div>
  <div class="d-flex align-items-center justify-content-between">
    <div class="col-auto">
      <!-- Page pre-title -->
      <div class="page-pretitle">
        Overview
      </div>
      <h1 class="mb-0">
      <?php echo $pagetitle ?>
      </h1>
    </div>
    <div class="col d-none d-lg-block">
      <h1 class="display-6 text-center mb-0"><?php echo $program_info->program_name ?></h1>
    </div>
    <div class="col-auto d-flex gap-2 justify-content-end">
      <a href="#"   rel="noopener" class="bg-transparent btn btn-icon" title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="layout-grid">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="4" width="6" height="6" rx="1"></rect><rect x="14" y="4" width="6" height="6" rx="1"></rect><rect x="4" y="14" width="6" height="6" rx="1"></rect><rect x="14" y="14" width="6" height="6" rx="1"></rect></svg>
    </a>
    <a href="#"  rel="noopener" class="bg-transparent btn btn-icon" title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="layout-list">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="4" width="16" height="6" rx="2"></rect><rect x="4" y="14" width="16" height="6" rx="2"></rect></svg>
  </a>
</div>
</div>
</div>
</div>
<style type="text/css">
/*table, table th{
font-size: 1.1rem!important;
}*/
</style>
<div class="page-body">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h1 class="mb-0 d-flex align-items-center display-6"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><line x1="7" y1="20" x2="17" y2="20"></line><line x1="9" y1="16" x2="9" y2="20"></line><line x1="15" y1="16" x2="15" y2="20"></line><path d="M8 12l3 -3l2 2l3 -3"></path></svg>Overall Rank</h1>
        <div>
        <a href="?view=print&program=<?php echo $program_info->program_id ?>" target="_blank" class="ms-auto btn btn-lg bg-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
   <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
   <rect x="7" y="13" width="10" height="8" rx="2"></rect>
</svg>Print Result</a> 
        <a id="updateRanking" class="ms-auto btn btn-lg bg-lime"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path><path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path></svg>Update Ranking</a> 
        </div>

      </div>
      <div class="card-body">
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
                WHERE scores.program_id = ".$_GET['program']."
                GROUP BY
                scores.participant_id
                ORDER BY
                participant_id;"; 

                // $sql = "SELECT participants.participant_id, participants.participant_name, SUM(CASE WHEN scores.`judge_id` = 10 THEN scores.`score` ELSE 0 END ) as 'Judge 1', SUM(CASE WHEN scores.`judge_id` = 11 THEN scores.`score` ELSE 0 END ) as 'Judge 2', SUM(CASE WHEN scores.`judge_id` = 12 THEN scores.`score` ELSE 0 END ) as 'Judge 3', ( SUM(CASE WHEN scores.`judge_id` = 10 THEN scores.`score` ELSE 0 END ) + SUM(CASE WHEN scores.`judge_id` = 11 THEN scores.`score` ELSE 0 END ) + SUM(CASE WHEN scores.`judge_id` = 12 THEN scores.`score` ELSE 0 END ) ) AS OVERALL_SCORE_BY_JUDGE FROM scores LEFT JOIN participants ON scores.participant_id = participants.participant_id WHERE scores.program_id = 8 GROUP BY scores.participant_id ORDER BY participant_id;";

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
                    foreach($judges_in_program as $key => $jd){
                      foreach (${$jd->usertype.$jd->judge_id} as $key => $value) {
                        if ($key == $data->participant_id) {
                          echo "<td>".$value."</td>"; 
                        }
                      }                      
                    }
                  ?> 
                  <?php 
                  foreach ($final_totalrank as $key => $value) {
                    if ($key == $data->participant_id) {
                      echo '<td class="bg-red-lt">'.$value.'<span class="innerrank"></span></td>';
                    }
                  }
                   ?>
                  
                  <?php 
                    foreach (generateFinalRank($final_totalrank) as $key => $rk) {
                      if ($key == $data->participant_id){
                        echo '<td class="bg-green-lt">'.$rk.'</td>';
                      }                      
                    }
                  ?> 
                </tr>
              <?php endforeach ?>
            </tbody> 
          </table>  
        </div>
      </div>
    </div>
  </div>
</div> 
<div class="modal fade" id="show-score-judge">
  <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judge_name">Judge's Individual Scores</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="judge_score_content"> 
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn me-auto btn-danger" data-bs-dismiss="modal">Close</button> -->
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  
 <script type="text/javascript">
   $(document).ready(function() {
    $('#updateRanking').on('click', function(){
      $('#loading').removeClass('d-none');
      setTimeout(function() {
        location.reload();
      }, 300);
    });
     $('.show-score-judge').on('click', function(event) {
        let judgeid = $(this).data('judgeid');
        console.log(judgeid);
        $.ajax({
          url: '<?php echo URLROOT ?>/app/controller/score_controller.php?action=get_overallscore_by_judge',
          type: 'POST',
          dataType: 'html',
          data: {judgeid: judgeid, program_id:<?php echo $_GET['program'] ?>},
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