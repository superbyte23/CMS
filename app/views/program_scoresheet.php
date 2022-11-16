<?php 
$score = new Score($db);
// show program information
$program_info = $prog->program_by_id($_GET['program']);
// show criteria in programs
$criterias = $crit->criteria_in_program_id($_GET['program']);
// get judge id from table judge not from user
$judge_info = $judge->judge_info($_SESSION['userid'], $_GET['program']);

// load_form($score, $criterias, $_POST['judge_id'], $participants, $_POST['program_id']);

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
      <div class="card-header d-block text-center">
        <h1 class="">Score Sheet</h1>
        <h2 class="mb-0"><?php echo $judge_info->fullname ?></h2>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="scoresheet"> 
          <thead class="bg-light">
            <tr>
              <th  class="text-start">Candidates</th>
              <?php $total_percent=0; $total_score=0; ?>
              <?php foreach ($criterias as $key => $criteria): ?>
              <?php $total_percent += $criteria->percentage; // SUM total percentage ?> 
              <th>
                <div><?= $criteria->criteria ?> : <?= $criteria->percentage ?>%</div>
                <small class="text-red"><?= $criteria->description ?></small>
              </th>
              <?php endforeach ?>
              <th><?php echo $total_percent ?>%</th>
              <th>RANK</th>
            </tr>
          </thead>
          <tbody>
<?php foreach ($participants as $key => $part): ?>
<tr>
<td class="text-start"><?= $part->participant_name ?></td>
<?php foreach ($criterias as $key => $crit): // display inputs for each criteria ?>
<td
contenteditable="true" 
class="input-field"  
data-percentage="<?php echo $crit->percentage ?>"
data-criteriaid="<?php echo $crit->criteria_id ?>" 
data-judgeid="<?php echo $judge_info->judge_id ?>"
data-programid="<?php echo $program_info->program_id ?>"
data-participantid="<?php echo $part->participant_id ?>"
<?php
echo (!empty($score->score_by_criteria_participant_judge($crit->criteria_id, $part->participant_id, $judge_info->judge_id)->score)) ? 
"data-scoreid='".$score->score_by_criteria_participant_judge($crit->criteria_id, $part->participant_id, $judge_info->judge_id)->score_id."'" : "";
?>
>
<?php
echo (!empty($score->score_by_criteria_participant_judge($crit->criteria_id, $part->participant_id, $judge_info->judge_id)->score)) ? 
$score->score_by_criteria_participant_judge($crit->criteria_id, $part->participant_id, $judge_info->judge_id)->score : "";
?>
</td> 
<?php endforeach ?>
<td class="bg-dark total_score"> 
  <?php echo $score->total_score_by_participant_each_judge($part->participant_id, $judge_info->judge_id)->total_score; ?></td>
<td>NA</td>
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
      if (code === 8 || code === 46 || code === 37 || code === 38  || code === 40  || code === 39) {
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
        if (x > 0) {
          if (parseInt(current_score) != parseInt(x)) {
            if (validate_score($(this)) == true) {
              console.log('score validated');
              send_score($(this));
              current_score = parseInt(x);
              let index = $(this).index();
              $(this).closest('tr').next().find('td').eq(index).focus();
            }
          } 
        }else{
          $(this).html(current_score);
        } 
        return false;
      }
    });
    // execute when current cell focusin
    $('.input-field').focusin(function(event) {
      current_score = $(this).html();
    });

    // execute when current cell focus out
    $('.input-field').focusout(function(event) {
      let x = $(this).html();
      if (x > 0) {
        if (parseInt(current_score) != parseInt(x)) {
          if (validate_score($(this)) == true) {
            console.log('score validated');
            send_score($(this));
            current_score = parseInt(x);
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
         total_score += parseInt(val.innerText);
      });
      $(current_row).find('.total_score').html(total_score);
    }

    function validate_score(el){
      
      let score = el.html();
      let percentage = el.data("percentage");
      if (parseInt(percentage) < parseInt(score)) {
        showMessage('red', 'Alert!', 'Invalid Input! Score must below or equal to '+ percentage);
        console.log('Invalid Input! Score must below or equal to '+ percentage);
        el.html(current_score); // return to current record
        el.focus();
        event.preventDefault();
          
      }else if (parseInt(score) == "" || !parseInt(score)) {
        showMessage('red', 'Alert!', 'Invalid Input! Empty or 0 score is not allowed.');
        console.log('Invalid Input! Empty or 0 score is not allowed.');
        el.html(current_score); // return to current record
        el.focus();
        event.preventDefault();
      }else{
        return true;
      }
    }

     

    function send_score(el){
        let score = el.html();
        let criteriaid = el.data("criteriaid");
        let judgeid = el.data("judgeid");
        let programid = el.data("programid");
        let participantid = el.data("participantid");
        let scoreid = el.data("scoreid");
        let percentage = el.data("percentage");
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
            score_id:scoreid
          }
        })
        .done(function(response) {  
          if (response.msg_type === 'success') { 
            toastsuccess_function(response.msg_type, response.msg);
            update_total_score(el);
          } 
        })
        .fail(function(response) {  
          location.reload(); 
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