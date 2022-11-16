<?php
  $path = $_SERVER['SCRIPT_NAME'];
  if (basename($path) != 'index.php') {
    header('location: index.php?view=404');
  }
?>
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
        <?php echo $pagetitle ?>
        </h2>


      </div>
      <!-- Page title actions -->
      <!-- <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
          <span class="d-none d-sm-inline">
            <a href="#" class="btn btn-white">
              New view
            </a>
          </span>
          <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-dynamic">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Create new report
          </a>
          <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
             
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
          </a>
        </div>
      </div> -->
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
          <div class="col-xl-8 col-md-12 px-0">
            <h1 class="display-4 fst-italic">Kabankalan Catholic College</h1>
            <h1 class="display-4 fst-italic"><span class="fw-bold">Contest Management System</span></h1>
            <p class="lead my-3">E-Judging, Events, Programs, User Management, Judges Registration and many more..s</p>
            <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
          </div>
        </div>
      </div> 
    </div>
  </div>
</div>