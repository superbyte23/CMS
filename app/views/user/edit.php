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
          <a href="<?php echo URLROOT ?>/app/views/user" class="btn btn-primary d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Back
          </a>
          <a href="<?php echo URLROOT ?>/app/views/user" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-fluid">
    <div class="card col-6">
      <div class="card-header">
        <h3 class="card-title">Edit User Form</h3>
      </div>
      <div class="card-body">
        <form class="validate" method="POST" action="<?php echo URLROOT.'/app/controller/usercontroller.php?action=edit'; ?>">
          <?php csrf(); ?>
          <input type="hidden" name="id" value="<?php echo $userdata->id ?>"> 
            <div class="form-group mb-3">
              <label class="form-label">Fullname</label>
              <input type="text" class="form-control" placeholder="Fullname" name="fullname" autocomplete="off" value="<?php echo $userdata->fullname ?>">
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" value="<?php echo $userdata->username ?>">
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Usertype</label> 
              <input type="text" class="form-control" placeholder="Usertype" list="usertypes"  name="usertype" autocomplete="off" value="<?php echo $userdata->usertype ?>">
              <?php $db->setQuery('SELECT DISTINCT (`usertype`) FROM users'); $usertypes = $db->results_obj(); ?>
              <datalist id="usertypes">
                  <?php foreach ($usertypes as $key => $type): ?> 
                      <option value="<?php echo $type->usertype ?>"> 
                  <?php endforeach ?>
              </datalist>
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off" value="<?php echo $userdata->email ?>">
            </div>
            <div class="form-group mb-3">
              <label class="form-label">Password</label>
              <input type="text" class="form-control" placeholder="Password" name="password" autocomplete="off" value="<?php echo $userdata->password ?>" style="-webkit-text-security: disc;">
            </div> 
          <button type="submit" class="float-right btn btn-success">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>