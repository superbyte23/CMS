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
          <table class="table table-striped-columns table-bordered" >
            <thead class="bg-dark">
              <tr>
                <th>#</th>
                <th>Candidates</th>
                <?php foreach ($judges_in_program as $key => $jd): ?> 
                <th><?php echo $jd->fullname ?></th>
                <?php endforeach ?>
                <th>TOTAL</th>
                <th>RANK</th>
              </tr>
            </thead>
            <tbody>

              <?php 



?>
              
              <?php foreach ($ptcpnt->participants_in_program_id($_GET['program']) as $key => $part): ?>
                <?php $overall_score =0; $sum_rank=0 ?>
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
    RANK() OVER(
    PARTITION BY judges.judge_id
ORDER BY
    SUM(`score`)
DESC
) AS RANK_BY_JUDGES
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
                  <td><a href="javascript:void(0)" class='text-lowercase'><?php echo $sum_rank; ?></a></td>
                </tr>
              <?php endforeach ?> 
            </tbody>
          </table>
        </div>
        </span>
      </div>
    </div>
  </div>
</div>
<?php 

// for test query

// SELECT
//     participants.participant_id,
//     participants.participant_name,
//     judges.judge_id,
//     users.fullname,
//     SUM(`score`) AS OVERALL_SCORE_BY_JUDGE,
//     RANK() OVER(
//     PARTITION BY judges.judge_id
// ORDER BY
//     SUM(`score`)
// DESC
// ) RANK_BY_JUDGES
// FROM
//     `scores`
// LEFT JOIN judges ON scores.judge_id = judges.judge_id
// LEFT JOIN users ON judges.user_id = users.id
// LEFT JOIN participants ON scores.participant_id = participants.participant_id
// WHERE
//     scores.program_id = 1 AND judges.judge_id = 7
// GROUP BY
//     scores.`participant_id`,
//     scores.`judge_id`
// ORDER BY
//     judges.judge_id,
//     scores.participant_id;

 ?>

<script type="text/javascript">
  // $(document).ready(function() {
  //   setTimeout(function(){
  //      window.location.reload();
  //   }, 5000);
  // });
</script>