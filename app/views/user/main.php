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
          <a href="<?php echo URLROOT ?>/app/views/user/?view=create" class="btn btn-primary d-none d-sm-inline-block">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
            Create New User
          </a>
          <a href="<?php echo URLROOT ?>/app/views/user/?view=create" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Users Table</h3> 
    </div> 
    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable"> 
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Usertype</th>
            <th>Email</th>
            <th class="w-1">Handle</th>
          </tr>
        </thead>
        <tbody> 
          <?php foreach ($users as $key =>  $user): ?>

            <tr>
              <th><?php echo $key+1; ?></th>
              <td><?php echo $user->fullname ?></td>
              <td><?php echo $user->usertype ?></td>
              <td><?php echo $user->email ?></td>
              <td>
                <a href="./?view=edit&id=<?php echo $user->id ?>" class="btn btn-cyan"><i class="fa fa-edit me-1"></i> Edit</a>
                <form  method="POST" class="d-inline validate" action="<?php echo URLROOT.'/app/controller/usercontroller.php?action=destroy'?>">
                  <?php csrf(); ?>
                  <input type="hidden" name="id" value="<?php echo $user->id ?>">
                  <button type="submit" class="btn btn-pink"><i class="fa fa-trash me-1"></i> Remove User</button>
                </form>
              </td>
            </tr> 
          <?php endforeach ?> 
        </tbody>
      </table>
    </div>  
  </div>
</div>