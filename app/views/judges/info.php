<div class="container-fluid">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
          Overview
        </div>
        <h2 class="page-title">
        <?php echo $pagetitle ? $pagetitle : 'SET TITLE'?>
        </h2>
      </div>
      <!-- Page title actions -->
      <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <a onclick="history.back()" class="btn btn-primary d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Back
          </a>
          <a nclick="history.back()" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-fluid">
    <div class="row row-cards">
      <div class="col-lg-3 d-none d-lg-block">
        <a class="card card-link mb-3" href="#">
          <div class="card-cover card-cover-blurred text-center card-cover-blurred" style="background-image: url(<?php echo ASSETS ?>/static/kcclogo.png)">
            <span class="avatar avatar-xl avatar-thumb avatar-rounded" style="background-image: url(<?php echo ASSETS ?>/static/avatar.png)"></span>
          </div>
          <div class="card-body text-center">
            <div class="card-title mb-1"><?php echo $judge_info->fullname ?></div>
            <div class="text-muted"><?php echo $judge_info->username ?></div>
          </div>
        </a> 
      </div>
      <div class="col-lg-9">
        <div class="card">
          <div class="card-body">
            <h3>Assigned Programs</h3>
            <div class="row row-cards">
              <?php foreach ($programs as $prog): ?>
                <div class="col-md-6">
                  <div class="card p-3">
                    <div class="d-flex justify-content-start align-items-center">
                      <div class="col-auto">
                        <img src="<?php echo ASSETS ?>/static/contest.png" class="rounded-start img-fluid" alt="Shape of You" width="100">
                      </div>
                      <div class="col">
                        <div class="card-body">
                          <h2 class="text-orange"><?php echo $prog->program_name ?></h2>
                          <h4><?php echo date_format(date_create($prog->date),"F d, Y g:i A"); ?></h4>
                          <a href="javascript:void(0)" class="btn btn-green">Enter Program</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach ?> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>