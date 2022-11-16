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
    <div class="card col-6">
      <div class="card-header">
        <h3 class="card-title">Add Program Form</h3> 
      </div>
      <div class="card-body">
        <form method="POST" action="<?php echo URLROOT ?>/app/controller/program_controller.php?action=add">
          <?php csrf(); ?> 
            <div class="mb-3">
              <label class="form-label">Program Name</label>
              <input type="text" class="form-control" name="program_name" placeholder="Program Name">
            </div>
            <div class="mb-3">
              <div class="form-label">Event</div>
              <select class="form-select" name="event_id">
                <?php foreach ($event->all() as $key => $event): ?>
                  <option value='<?= $event->event_id ?>'><?php echo $event->event_name ?></option> 
                <?php endforeach ?>
              </select>
            </div>
            <div class="mb-3">
              <div class="form-label">Category</div>
              <select class="form-select" name="category_id">
                <?php foreach ($category->all() as $key => $category): ?>
                <option value="<?php echo $category->category_id ?>"><?php echo $category->category_name ?></option>
                <?php endforeach ?>
              </select>
            </div>
          <button type="submit" class="float-right btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>