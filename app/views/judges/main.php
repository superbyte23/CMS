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
          <a href="?view=create" class="btn btn-primary d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Add New
          </a>
          <a href="?view=create" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
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
      <?php foreach ($judges as $key => $judge): ?>
      <div class="col-md-6 col-xl-2">
        <div class="card">
          <div class="card-status-top bg-green"></div>
          <div class="card-body text-center">
            <div class="mb-3">
              <span class="avatar avatar-lg avatar-rounded" style="background-image: url('<?php echo ASSETS ?>/static/avatar.png')"></span>
            </div>
            <div class="card-title mb-1"><?php echo $judge->fullname ?></div>

            <div class="text-muted"><?php echo ucwords($judge->username) ?></div>
          </div>
          <a href="<?php echo URLROOT ?>/app/views/judges/?view=info&id=<?php echo $judge->id ?>" class="card-btn">View Details</a>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</div>