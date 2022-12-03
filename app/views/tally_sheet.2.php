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
      <div class="card-header">
<h1 class="mb-0 d-flex align-items-center display-6"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><line x1="7" y1="20" x2="17" y2="20"></line><line x1="9" y1="16" x2="9" y2="20"></line><line x1="15" y1="16" x2="15" y2="20"></line><path d="M8 12l3 -3l2 2l3 -3"></path></svg>Rank</h1>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped-columns table-bordered" id="mytable" >
            <thead class="bg-dark">
              <tr>
                <th>#</th>
                <th>Candidates</th>
                <?php foreach ($judges_in_program as $key => $jd): ?>
                <th><a href="javascript:void(0)" class="show-score-judge" data-bs-toggle="modal" data-bs-target="#show-score-judge" data-judgeid="<?php echo $jd->judge_id ?>"><?php echo $jd->fullname ?></a></th>
                <?php endforeach ?>
                <th>TOTAL</th>
                <th class="rank">RANK</th>
              </tr>
            </thead>
<tbody>
  <?php $array_total_ranks = array(); ?>
  <?php foreach ($ptcpnt->participants_in_program_id($_GET['program']) as $key => $part): ?>
  <?php $overall_score =0; $sum_rank=0; $rank_array = array(); ?>
  <tr>
    <td><?php echo $key+1 ?></td>
    <td><a href="javascript:void(0)" class=""><?php echo $part->participant_name ?></a></td>
    <?php foreach ($judges_in_program as $key => $jd): ?>
    <td>
      <?php
      $t_score = $score->total_score_by_participant_each_judge($part->participant_id, $jd->judge_id)->total_score;
      // echo $t_score;
      $overall_score += $t_score;
      ?>
      <?php
      $sql = 'SELECT
      participants.participant_id,
      participants.participant_name,
      judges.judge_id,
      users.fullname,
      SUM(`score`) AS OVERALL_SCORE_BY_JUDGE,
      RANK() OVER(PARTITION BY judges.judge_id ORDER BY SUM(`score`) DESC) AS RANK_BY_JUDGES,
      RANK() OVER (ORDER BY SUM(`score`) DESC) AS RANK
      FROM
      `scores`
      LEFT JOIN judges ON scores.judge_id = judges.judge_id
      LEFT JOIN users ON judges.user_id = users.id
      LEFT JOIN participants ON scores.participant_id = participants.participant_id
      WHERE
      scores.program_id = '.$_GET['program'].' AND judges.judge_id = '.$jd->judge_id.'
      GROUP BY
      scores.`participant_id`,
      scores.`judge_id`
      ORDER BY
      judges.judge_id,
      scores.participant_id;';
      $db->setQuery($sql);
      $result = $db->results_obj();
      foreach ($result as $key => $data) {
      if ($part->participant_id == $data->participant_id) {
      echo '<a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="left" data-bs-title="<u>Score</u> <h2>'.$t_score.'</h2>" class="text-lowercase">'.$data->RANK_BY_JUDGES.'</a>';
      $sum_rank += $data->RANK_BY_JUDGES;
      
      }
      
      }
      
      ?>
    </td>
    <?php endforeach ?>
    <td class="total"><?php echo $sum_rank; ?></td> 
    <?php // $array_total_ranks[$part->participant_id] = $sum_rank; ?>
    <?php 
    // foreach ($result as $key => $value) {
    //   if ($value->participant_id == $part->participant_id) {
    //    echo '<td>'.$sum_rank."-".$value->RANK.'</td>';
    //   }
    // }
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

<?php 
//calculate rank for key value pair array
// function calculate_rank($rank_values): array {
//     asort($rank_values);
//     $rank_array = [];
//     $rank = 0;
//     $r_last = null;
//     foreach ($rank_values as $key => $value) {
//         if ($value != $r_last) {
//             if($value > 0){ //if you want to set zero rank for values zero
//               $rank++;
//             }
//             $r_last = $value;
//         }
//         $rank_array[$key] = $value > 0 ? $rank: 0; //if you want to set zero rank for values zero
//     }    
//     return $rank_array;
// } 
 ?>
 <script type="text/javascript">
   $(document).ready(function() {
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

 <script>
  $(function() {
  //Get all total values, sort and remove duplicates
  let totalList = $(".total")
    .map(function() {return $(this).text()})
    .get()
    .sort(function(a,b){return a - b })
    .reduce(function(a, b) {if (b != a[0]) a.unshift(b);return a}, [])

  //Assign rank
  totalList.forEach((v, i) => {
    $('.total').filter(function() {return $(this).text() == v;}).next().text(i + 1);
  })
});
 </script>