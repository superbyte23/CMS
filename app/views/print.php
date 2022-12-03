<?php
  $path = $_SERVER['SCRIPT_NAME'];
  if (basename($path) != 'index.php') {
    header('location: index.php?view=404');
  }
?>
<?php 
// for ranking only
$rank_list = array();
$sql = "SELECT
  participants.participant_id,
  participants.participant_name,";
  $filter = "";
  $totalrank = "";
  foreach ($judges_in_program as $key => $j) {
    $filter .= "RANK() OVER (ORDER BY (SUM(CASE WHEN scores.`judge_id` = ".$j->judge_id." THEN scores.`score` ELSE 0 END )) DESC) as '".$j->fullname."', ";
    $totalrank .= "RANK() OVER (ORDER BY (SUM(CASE WHEN scores.`judge_id` = ".$j->judge_id." THEN scores.`score` ELSE 0 END )) DESC) + ";
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
  $ranks = $db->results_obj();
  foreach ($ranks as $key => $rank){
    $rank_list[$rank->participant_id] = $rank->TOTAL_RANK;
  } 
  $ranks_per_participants = calculate_rank($rank_list); 
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel&family=Great+Vibes&display=swap" rel="stylesheet">
<style type="text/css">
  /* print overrides */
  .title{
    font-family: 'Cinzel'!important;
    font-size: 2rem;
    line-height: 1.2;
    color: linear-gradient(90deg, rgba(253,187,45,1) 0%, rgba(17,18,1,1) 100%);
  }
  .sub-title{
    font-family: 'Great Vibes'!important;
    font-size: 2.5em;
    line-height: 1.5;  
    color: linear-gradient(90deg, rgba(253,187,45,1) 0%, rgba(17,18,1,1) 100%);
  }
  body {
    font-family: 'Cinzel';
    background-color: #fff;
    -webkit-print-color-adjust:exact !important;
  print-color-adjust:exact !important;
  }
@media print {
  html{

    font-size: 12px!important;
  }
  body {
    
    font-family: 'Cinzel'; 
    color: black;
    background-color: white;
    margin: 0;
  } 
  header, footer, nav, aside, form, video, audio .adslot {
    display: none;
  }
  
  .no-print{
    display: none;
  } 
  main, article, section {
    display: block;
    width: 100%;
  }
}
</style> 
<div class="page-body">
  <div class="container-xl">
    
    <div class="d-flex justify-content-center align-items-center">
      <img src="<?php echo ASSETS ?>/static/95th.png" width="80" class="img-fluid" />
      <div class="text-center mx-3">
        <h1 class="title mb-0">Kabankalan Catholic College</h1>
        <h3 class="sub-title mb-0"><?php echo ucwords(strtolower($program_info->program_name))  ?></h3>
      </div>
      <img src="<?php echo ASSETS ?>/static/kcclogo.png" width="80" class="img-fluid" />
    </div>
    <div class="py-3">
      <h1 class="mb-3 text-center">Official Results</h1>      
      <?php 
      $rank_list = array();
      $sql = "SELECT
        participants.participant_id,
        participants.participant_name,";
        $filter = "";
        $totalrank = "";
        foreach ($judges_in_program as $key => $j) {
          $filter .= "RANK() OVER (ORDER BY (SUM(CASE WHEN scores.`judge_id` = ".$j->judge_id." THEN scores.`score` ELSE 0 END )) DESC) as '".$j->fullname."', ";
          $totalrank .= "RANK() OVER (ORDER BY (SUM(CASE WHEN scores.`judge_id` = ".$j->judge_id." THEN scores.`score` ELSE 0 END )) DESC) + ";
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
        $results = $db->results_obj(); 
        ?> 
        <div class="list-group d-block col-6 mx-auto" id="results">
          <?php foreach ($ranks_per_participants as $index => $rk): ?>
            <?php foreach ($results as $key => $data): ?>
              <?php if ($data->participant_id == $index): ?>
              <div class="list-group-item bg-transparent border-0 mx-auto">
                <div class="d-flex gap-3 align-items-center">  
                  <a href="#">
                    <span class="text-dark" style="
                    border-radius: 4px;
                    text-align: center;
                    text-transform: lowercase;
                    vertical-align: bottom; 
                    position: relative;    
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    height: 2.5rem; 
                    width : 2.5rem; 
                    background-color: rgb(<?php echo (20+$rk)*3*3; ?>, <?php echo (20+$rk)*3*5; ?>, <?php echo (20+$rk)*3; ?>)!important; 
                    color: #fff;"><?php echo ordinal($rk) ?>        
                    </span>
                  </a>
                  <h3 href="#" class="text-reset mb-0 d-block"><?php echo $data->participant_name ?></h3>
                </div>
              </div>
              <?php endif ?>
            <?php endforeach ?>
          <?php endforeach ?>
        </div>
      
    </div>
  </div>
</div>

<script>
  $(document).ready(function() { 
    window.onafterprint = window.close;
         window.print();
  }); 
</script>