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
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="p-4 p-md-5 mb-4 text-white text-center rounded bg-dark" id="dashboard"> 
          <img src="<?php echo ASSETS ?>/static/kcclogo.png" width="250" class="img-fluid" />
          <h1 class="display-4 d-none d-md-block ">Kabankalan Catholic College</h1>
          <h1 class="display-5 d-none d-md-block fw-bold">
             Contest Management System 
          </h1> 
          <h1 class="fst-italic d-lg-none">Kabankalan Catholic College</h1>
          <h2 class="fst-italic d-lg-none">Contest Management System</h2>
          <p class="markdown my-3">E-Judging and Event Management</p>  
        </div>
      </div> 
    </div>
  </div>
</div>