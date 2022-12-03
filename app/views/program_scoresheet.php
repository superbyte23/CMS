<?php 
$score = new Score($db);
// show program information
$program_info = $prog->program_by_id($_GET['program']);
// show criteria in programs
$criterias = $crit->criteria_in_program_id($_GET['program']);
// get judge id from table judge not from user
$judge_info = $judge->judge_info($_SESSION['userid'], $_GET['program']);

// load_form($score, $criterias, $_POST['judge_id'], $participants, $_POST['program_id']);

// for ranking only
$rank_list = array();
$rank_list_raw = array();
$final_rank = array();
foreach ($participants as $key => $part){
  $rank_list[$part->participant_id] = $score->total_score_by_participant_each_judge($part->participant_id, $judge_info->judge_id)->total_score;
  $rank_list_raw[] = $score->total_score_by_participant_each_judge($part->participant_id, $judge_info->judge_id)->total_score; 

  $sql = "SELECT participants.participant_id, participants.participant_name, judges.judge_id, users.fullname, SUM(`score`) AS OVERALL_SCORE_BY_JUDGE, RANK() OVER(PARTITION BY judges.judge_id ORDER BY SUM(`score`) DESC ) AS RANK_BY_JUDGES FROM `scores` LEFT JOIN judges ON scores.judge_id = judges.judge_id LEFT JOIN users ON judges.user_id = users.id LEFT JOIN participants ON scores.participant_id = participants.participant_id WHERE scores.program_id = ".$_GET['program']." AND judges.judge_id = ".$judge_info->judge_id." GROUP BY scores.`participant_id`, scores.`judge_id` ORDER BY judges.judge_id, scores.participant_id;";

  $db->setQuery($sql);
  $ranks = $db->results_obj();  
}  
  
?> 
<?php $rank_average = rankify_asc($rank_list_raw, count($rank_list_raw));  ?> 
<?php 
$counter = 0;
foreach ($rank_list as $index => $val) { 
  $final_rank[$index] = $rank_average[$counter]; 
  $counter = $counter + 1;
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
    <div class="col-auto  d-none d-lg-block">
      <!-- Page pre-title -->
      <div class="page-pretitle">
        Overview
      </div>
      <h1 class="mb-0">
      <?php echo $pagetitle ?>
      </h1>
    </div>
    <div class="col">
      <h1 class="display-6 text-center mb-0">
      <?php echo $program_info->program_name ?>
      </h1>
    </div>
    <div class="col-auto d-flex gap-2 justify-content-end">  
        <a href="#"  rel="noopener" class="bg-transparent link-layout-list btn btn-icon" title="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="layout-list"> 
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="4" width="16" height="6" rx="2"></rect><rect x="4" y="14" width="16" height="6" rx="2"></rect></svg>
        </a> 
    </div>
  </div>
</div>
</div>
<style type="text/css">
  .list-group-item:hover{
    background-color: #00ff7912;
  }
  .active{
    background-color: #00ff7912!important;
  }
</style>
<div class="page-body">
  <div class="container-fluid">  
    <div class="card">
      <div class="card-header">
        <h1 class="mb-0">Score Sheet : <?php echo $judge_info->fullname ?></h1>
        <a href="" class="ms-auto btn btn-lg bg-lime"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
   <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
</svg> Update Ranking</a> 
      </div>
      <div class="table-responsive">
        <table class="table table-bordered border-dark table-hover  table-lg" id="scoresheet"> 
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th  class="text-start col-4">Candidates</th>
              <?php $total_percent=0; $total_score=0; ?>
              <?php foreach ($criterias as $key => $criteria): ?>
              <?php $total_percent += $criteria->percentage; // SUM total percentage ?> 
              <th>
                <div class="d-flex align-items-center justify-content-center"><?php if ($criteria->status == 1): ?>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="5" y="11" width="14" height="10" rx="2"></rect><circle cx="12" cy="16" r="1"></circle><path d="M8 11v-4a4 4 0 0 1 8 0v4"></path></svg> 
                <?php endif ?><?= $criteria->criteria ?> : <?= $criteria->percentage ?>%</div>
                <small class="text-red"><?= $criteria->description ?></small>
                
              </th>
              <?php endforeach ?>
              <th class="col-1"><?php echo $total_percent ?>%</th>
              <th class="col-1">RANK</th>
            </tr>
          </thead>
          <tbody> 
<?php foreach ($participants as $key => $part): ?>
<tr>
  <td><?= $part->participant_id ?></td>
  <td class="text-start"><?= $part->participant_name ?></td>
  <?php foreach ($criterias as $key => $crit): // display inputs for each criteria ?>
  <td
  <?php if ($crit->status == 1): ?>
  contenteditable="false"
  <?php else: ?>
  contenteditable="true" 
  <?php endif ?>
  class="input-field"  
  data-percentage="<?php echo $crit->percentage ?>"
  data-criteriaid="<?php echo $crit->criteria_id ?>" 
  data-judgeid="<?php echo $judge_info->judge_id ?>"
  data-programid="<?php echo $program_info->program_id ?>"
  data-participantid="<?php echo $part->participant_id ?>"
  <?php echo (isset($score->score_by_criteria_participant_judge($crit->criteria_id, $part->participant_id, $judge_info->judge_id)->score)) ? 
  "data-scoreid='".$score->score_by_criteria_participant_judge($crit->criteria_id, $part->participant_id, $judge_info->judge_id)->score_id."'" : ""; ?>><?php echo (isset($score->score_by_criteria_participant_judge($crit->criteria_id, $part->participant_id, $judge_info->judge_id)->score) > 0) ? $score->score_by_criteria_participant_judge($crit->criteria_id, $part->participant_id, $judge_info->judge_id)->score : "" ?></td> 
  <?php endforeach ?>
  <td class="bg-indigo-lt total_score">
    <?php
    $rank_list[$part->participant_id] = $score->total_score_by_participant_each_judge($part->participant_id, $judge_info->judge_id)->total_score;
    $rank_list_raw[] = $score->total_score_by_participant_each_judge($part->participant_id, $judge_info->judge_id)->total_score;
    echo $score->total_score_by_participant_each_judge($part->participant_id, $judge_info->judge_id)->total_score;
    ?>
  </td>
  <?php
  $sql = "SELECT participants.participant_id, participants.participant_name, judges.judge_id, users.fullname, SUM(`score`) AS OVERALL_SCORE_BY_JUDGE, RANK() OVER(PARTITION BY judges.judge_id ORDER BY SUM(`score`) DESC ) AS RANK_BY_JUDGES FROM `scores` LEFT JOIN judges ON scores.judge_id = judges.judge_id LEFT JOIN users ON judges.user_id = users.id LEFT JOIN participants ON scores.participant_id = participants.participant_id WHERE scores.program_id = ".$_GET['program']." AND judges.judge_id = ".$judge_info->judge_id." GROUP BY scores.`participant_id`, scores.`judge_id` ORDER BY judges.judge_id, scores.participant_id;";
  //echo $sql;
  $db->setQuery($sql);
  $ranks = $db->results_obj();
  foreach ($final_rank as $key => $rank) {
    if ($key == $part->participant_id) {
     echo "<td class='bg-green-lt'>".$rank."</td>";
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
<script type="text/javascript">
  $(document).ready(function() {
    var current_score = 0;
    $('.input-field').on("keydown", function (e) { 
      var code = e.keyCode || e.which;
      if (code === 8 || code === 46 || code === 37 || code === 38  || code === 40  || code === 39 || code === 96 || code === 97 || code === 98 || code === 99 || code === 100 || code === 101 || code === 102 || code === 103 || code === 104 || code === 105 || code === 190) {
        // 37 arrow left
        // 38 arrow up
        // 39 arrow right
        // 40 arrow down
        if (code === 39) {
          $(this).next('.input-field').focus();
        }else if (code === 37) {
          $(this).prev('.input-field').focus();
        }else if (code === 38){
          let index = $(this).index();
          $(this).closest('tr').prev().find('td').eq(index).focus();
        }else if (code === 40) {
          let index = $(this).index();
          $(this).closest('tr').next().find('td').eq(index).focus();
        }

      }else{
        if (isNaN(String.fromCharCode(e.which))) e.preventDefault();
      }
      if(code === 13) {
        let x = $(this).html(); 
        // console.log(current_score);
        // console.log(x);
        if (current_score != x) {
          if (parseFloat(current_score) != parseFloat(x)) {
            if (validate_score($(this)) == true) {
              console.log('score validated');
              send_score($(this));
              current_score = parseFloat(x);

            }
          } 
        }else{
          $(this).html(current_score);
        }
        let index = $(this).index();
          $(this).closest('tr').next().find('td').eq(index).focus();
        return false;
      }
    });
    // execute when current cell focusin
    $('.input-field').focusin(function(event) {
      current_score = $(this).html();
      if (current_score == 0) {
        $(this).html("");
      }
    });

    // execute when current cell focus out
    $('.input-field').focusout(function(event) {

      let x = $(this).html();
      if (x == 0) {
        $(this).html("");
      }
      if (current_score != x) {
        if (parseFloat(current_score) != parseFloat(x)) {
          if (validate_score($(this)) == true) {
            console.log('score validated');
            send_score($(this));
            current_score = parseFloat(x);
          }
        } 
      }else{
        $(this).html(current_score);
      } 
      return false;
    });

    function update_total_score(el){
      let total_score = 0;
      let current_row = el.closest('tr');
      $.each(current_row.find('.input-field'), function(index, val) {
        if (val.innerText == "") {

        }
         total_score += val.innerText == "" ? 0 : parseFloat(val.innerText);
      });
      $(current_row).find('.total_score').html(total_score);
    }

    function validate_score(el){
      
      let score = el.html();
      let percentage = el.data("percentage");
      if (parseFloat(percentage) < parseFloat(score)) {
        showMessage('red', 'Alert!', 'Invalid Input! Score must below or equal to '+ percentage);
        console.log('Invalid Input! Score must below or equal to '+ percentage);
        el.html(current_score); // return to current record
        el.focus();
        event.preventDefault();
          
      }
      // else if (parseFloat(score) == "") {
      //   showMessage('red', 'Alert!', 'Invalid Input! Empty or 0 score is not allowed.');
      //   console.log('Invalid Input! Empty or 0 score is not allowed.');
      //   el.html(current_score); // return to current record
      //   el.focus();
      //   event.preventDefault();
      // }
      else{
        return true;
      }
    }    

    function send_score(el){
        let score = el.html();
        let criteriaid = el.data("criteriaid");
        let judgeid = el.data("judgeid");
        let programid = el.data("programid");
        let participantid = el.data("participantid");
        let score_id = el.data("scoreid"); 
        let percentage = el.data("percentage");
        console.log('score = '+ parseFloat(score));
        console.log('criteriaid = '+criteriaid);
        console.log('judgeid = '+judgeid);
        console.log('programid = '+programid);
        console.log('participantid = '+participantid);
        console.log('score_id = '+score_id);
        console.log('percentage = '+percentage);
        // start ajax request        
        $.ajax({
          url: '<?php echo URLROOT ?>/app/controller/score_controller.php?action=submit_score',
          type: 'POST',
          dataType: 'json',
          data: {
            score:score,
            criteria_id:criteriaid,
            judge_id:judgeid,
            program_id:programid,
            participant_id:participantid,
            score_id:score_id
          }
        })
        .done(function(response) {
          console.log(response);  
          if (response.msg_type == 'success_update') { 
            toastsuccess_function(response.msg_type, response.msg);
            update_total_score(el);
          }else if (response.msg_type == 'success_added') {
            toastsuccess_function(response.msg_type, response.msg);
            location.reload();
          }
        })
        .fail(function(response) {  
          showMessage('red', 'Alert!', 'There was a problem with submitting your score.');
        }); 
    }
    // click each participant
    // $('.participant').on('click', function(){
    //   let id = $(this).data('participant_id'); 
    //   $(this).parents('.list-group-item').addClass('active').siblings().removeClass('active');
    //   $.ajax({
    //     url: '<?php echo URLROOT ?>/app/controller/score_controller.php?action=get_score',
    //     type: 'POST',
    //     dataType: 'HTML',
    //     data: {
    //       participant_id: id, 
    //       action : 'get_score', 
    //       program_id: <?php echo $program_info->program_id ?>,
    //       judge_id: <?php echo $judge_info->judge_id ?>
    //     },
    //     success:function(result){ 
    //       $('#form-content').html(result); 
    //     },
    //   }); 
    // }); 
  });
</script> 