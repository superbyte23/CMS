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
        <h1 class="mb-0 d-flex align-items-center display-6"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><line x1="7" y1="20" x2="17" y2="20"></line><line x1="9" y1="16" x2="9" y2="20"></line><line x1="15" y1="16" x2="15" y2="20"></line><path d="M8 12l3 -3l2 2l3 -3"></path></svg>Tally Sheet</h1>
      </div>
      <div class="card-body"> 
        <div class="table-responsive">
          <table class="table table-striped-columns table-dark table-bordered" >
            <thead class="bg-dark">
              <tr>
                <th>#</th>
                <th>Candidates</th>
                <?php $total_percent=0; ?>
                <?php foreach ($criterias as $key => $criteria): ?>
                <?php $total_percent += $criteria->percentage; ?>
                <th>
                  <div><?= $criteria->criteria ?> : <?= $criteria->percentage ?>%</div>
                  <small><?= $criteria->description ?></small>
                </th>
                <?php endforeach ?>
                <th><?php echo $total_percent ?>%</th>
                <th>RANK</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ptcpnt->participants_in_program_id($_GET['program']) as $key => $part): ?>
              <tr>
                <td scope="row"><?php echo $key+1 ?></td>
                <td scope="row">
                  <div><?php echo $part->participant_name ?></div>                    
                </td>
                <?php $total_average=0; ?>
                <?php foreach ($criterias as $crit): ?> 
                <?php
                  $db->setQuery("SELECT  scores.*,
                  SUM(`score`) AS TOTAL_SUM,
                  COUNT(`score`) as TOTAL_RESPONSE,
                  participants.participant_name,
                  criteria.* FROM `scores` 
                  LEFT JOIN criteria ON scores.criteria_id = criteria.criteria_id 
                  LEFT JOIN participants ON scores.participant_id = participants.participant_id 
                  WHERE scores.program_id = ".$_GET['program']." 
                  AND participants.participant_id = ".$part->participant_id." 
                  AND criteria.criteria_id = ".$crit->criteria_id);
                  // $total_average = 0;
                  $scores_data = $db->result();
                  $average = $scores_data->TOTAL_SUM / $scores_data->TOTAL_RESPONSE;
                  $total_average += $average; 
                  ?>
                  <td><?php echo (!empty($scores_data->score)) ? round($average, 2) : "" ?></td> 
                <?php endforeach ?>
                <td><?php echo round($total_average, 2); ?></td>
                <td></td>
              </tr>
              <?php endforeach ?> 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  // $(document).ready(function() {
  //   setTimeout(function(){
  //      window.location.reload();
  //   }, 5000);
  // });
</script>