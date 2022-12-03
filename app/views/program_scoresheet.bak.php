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
    <div class="row g-2">
      <div class="col-4">
        <div class="row row-cards row-cols-1"> <!-- row-cols-lg-3 row-cols-xl-4 --> 
          <div class="col"> 
            <div class="card">
              <div class="card-status-top bg-lime"></div>
              <div class="card-header">
                <div class="card-title">Participants</div>
              </div>
              <div class="list-group card-list-group overflow-auto" style="max-height: 70vh">
                <?php foreach ($participants as $key => $part): ?>
                <div class="list-group-item">
                  <div class="d-flex gap-2 align-items-center">
                    <div class="col-auto me-2">
                      <?php echo $key+1 ?>
                    </div>
                    <div class="col-auto">
                      <img src="<?php echo ASSETS ?>/static/avatar.png" class="rounded" alt="Górą ty" width="40" height="40">
                    </div>
                    <div class="col">
                      <div class="fw-bold"><?php echo $part->participant_name ?></div>
                      <div class="text-muted">
                        <?php echo $dpt->department_info($part->department_id)->department_name ?>
                      </div>
                    </div>
                    <div class="col text-muted d-none d-lg-block">
                      Rank : 
                    </div>
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btn-outline-success bottom-0  mt-2 py-1 participant" data-participant_id="<?php echo $part->participant_id ?>">
                      <i class="fa fa-eye"></i><span class="d-none d-lg-block">View Scores</span>
                    </a>
                    </div> 
                  </div>
                </div>
                <?php endforeach ?>                   
              </div> 
            </div>
          </div>
        </div> 
      </div>
      <div class="col">
        <div class="card">
           <div class="card-header">
              <div class="card-title">
                Individual Scoresheet
              </div>
            </div>
          <div class="card-body overflow-auto" style="max-height: 70vh"> 
            <div id="form-content">
              
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() { 
    // click each participant
    $('.participant').on('click', function(){
      let id = $(this).data('participant_id'); 
      $(this).parents('.list-group-item').addClass('active').siblings().removeClass('active');
      $.ajax({
        url: '<?php echo URLROOT ?>/app/controller/score_controller.php?action=get_score',
        type: 'POST',
        dataType: 'HTML',
        data: {
          participant_id: id, 
          action : 'get_score', 
          program_id: <?php echo $program_info->program_id ?>,
          judge_id: <?php echo $judge->judge_info($_SESSION['userid'])->judge_id ?>
        },
        success:function(result){ 
          $('#form-content').html(result); 
        },
      }); 
    }); 
  });
</script>