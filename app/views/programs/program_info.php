<div class="page-body">
  <div class="container-fluid">
    <div class="row row-cards">
      <div class="col-12">
        <div class="card shadow card-sm">
          <div class="card-stamp card-stamp-lg">
            <div class="card-stamp-icon bg-primary">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="6" cy="16" r="3"></circle><circle cx="16" cy="19" r="2"></circle><circle cx="14.5" cy="7.5" r="4.5"></circle></svg>  
            </div>
          </div>
          <div class="card-status-top bg-blue"></div>
          <div class="card-body">
            <div class="d-flex justify-content-start gap-2 align-items-center">
               
              <h3 class="h1 mb-2">Program : <?php echo $program_info->program_name ?></h3>
              <a href="?view=edit&program_id=<?= $program_info->program_id ?>" class="text-light mb-2" aria-label="Edit Program">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path><line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line></svg>
              </a>
            </div>
            <div class="mt-1">
              <div class="row">
                <div class="col">
                  <!-- <label class="form-label">Filters</label> -->
                  <div class="form-selectgroup">
                    <!-- <label class="form-selectgroup-item">
                      <input type="checkbox" name="name" value="HTML" class="form-selectgroup-input">
                      <span class="form-selectgroup-label">Rank</span>
                    </label>
                    <label class="form-selectgroup-item">
                      <input type="checkbox" name="name" value="CSS" class="form-selectgroup-input">
                      <span class="form-selectgroup-label">Scores</span>
                    </label> -->
                    <!-- <label class="form-selectgroup-item">
                      <input type="checkbox" name="name" value="PHP" class="form-selectgroup-input">
                      <span class="form-selectgroup-label">PHP</span>
                    </label>
                    <label class="form-selectgroup-item">
                      <input type="checkbox" name="name" value="JavaScript" class="form-selectgroup-input">
                      <span class="form-selectgroup-label">JavaScript</span>
                    </label> -->
                    <label class="form-selectgroup-item">
                      <a href="#" data-bs-toggle="modal" data-bs-target="#modal-criteria" class="btn btn-outline-azure shadow  w-100">
                        Set Criteria
                      </a>
                    </label>
                    <label class="form-selectgroup-item">
                      <a href="#" data-bs-toggle="modal" data-bs-target="#modal-judges" class="btn btn-outline-lime  shadow w-100">
                        Add Judges
                      </a>
                    </label>
                    <label class="form-selectgroup-item">
                      <a href="#" data-bs-toggle="modal" data-bs-target="#modal-full-width" class="btn btn-outline-pink  shadow w-100">
                        Add Participants
                      </a>
                    </label> 
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <div class="card shadow mb-3">
          <div class="card-header">
            <h3 class="card-title">Criteria for Judging</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-vcenter card-table">
                <thead>
                  <tr>
                    <th class="text-start">Citeria</th>
                    <th class="text-start">Description</th>
                    <th>Percentage%</th>
                    <th class="w-1"></th>
                  </tr>
                </thead>
                <tbody> 
                  <?php foreach ($criterias as $key => $criteria): ?>
                  <?php $total_percent += $criteria->percentage ?>
                  <tr>
                    <td class="fw-bold text-start"><?php echo $criteria->criteria ?></td>
                    <td class="text-start"><?php echo $criteria->description ?></td>
                    <td><?php echo $criteria->percentage ?>%</td>
                    <td>
                      <div class="d-flex gap-1">
                        <a class="btn btn-sm edit_criteria" href="#" data-criteriaid="<?php echo $criteria->criteria_id ?>" data-bs-toggle="modal" data-bs-target="#modal-edit-criteria">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path><line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line></svg>Edit</a>
                        <a class="btn btn-sm delete_criteria" href="#" data-bs-toggle="modal" data-bs-target="#modal-criteria">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>Delete</a>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach ?>
                  <tr>
                    <td colspan="4" class="text-end h3">Total Percentage : <span class="text-danger"><?php echo $total_percent ?>%</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="card shadow">
            <div class="card-header">
              <h1 class="card-title">Judges</h1>
            </div> 
            <div class="card-body">
              <form action="<?php echo URLROOT ?>/app/controller/program_controller.php?action=delete_judges" method="POST">
              <input type="hidden" class="w-100" name="program_id" value="<?php echo $_GET['program_id']; ?>">
              <div class="row g-2">
                <?php foreach ($assigned_judges as $aj): ?>
                <div class="col-auto">
                  <label class="form-imagecheck shadow mb-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $aj->fullname ?>">
                    <input type="checkbox" name="judge_id[]" value="<?php echo $aj->judge_id ?>" class="form-imagecheck-input">
                    <span class="form-imagecheck-figure">
                      <span class="form-imagecheck-image">
                        <span class="avatar avatar-md" style="background-image: url(<?php echo ASSETS; ?>/static/avatar.png)"></span>
                      </span>
                    </span>
                  </label>
                </div>
                <?php endforeach ?>
              </div>
              <button class="btn btn-danger"><i class="fa fa-trash me-2"></i>Delete</button> 
              </form>
            </div>
          </div> 
        </div>
      </div>
      <div class="col-6">
        <div class="card shadow">
          <div class="card-header">
            <h3 class="card-title">Participants</h3>
          </div>
          <div class="list-group list-group-flush list-group-hoverable overflow-auto" style="max-height: 75vh;">
             
            <?php foreach ($participants as $key => $participant): ?>
            <div class="list-group-item py-2">
              <div class="row align-items-center">
                <div class="col-auto">
                  <a href="#">
                    <?php echo $key+1 ?>
                  </a>
                </div>
                <div class="col-auto">
                  <a href="#">
                    <span class="avatar avatar-sm" style="background-image: url(<?php echo ASSETS; ?>/static/avatar.png)"></span>
                  </a>
                </div>
                <div class="col text-truncate">
                  <a href="#" class="text-reset d-block"><?php echo $participant->participant_name ?></a>
                </div>
                <div class="col text-truncate">
                  <a href="#" class="text-reset d-block"><?php echo $participant->department_name ?></a>
                </div>
                <div class="col-auto">
                  <a href="#" data-bs-toggle="modal" data-participantid="<?php echo $participant->participant_id ?>" data-bs-target="#modal-edit" class="participant_edit btn btn-sm"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path><line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line></svg>
                    Edit
                  </a>
                  <a onclick="if (confirm('Delete this participant.')) {}else{event.preventDefault()}" href="#" class="btn btn-sm"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                  Delete
                </a>
                </div>
              </div>
            </div>
            <?php endforeach ?> 
          </div>
        </div>
      </div>
    <!-- <form action="<?php echo URLROOT ?>/app/controller/program_controller.php?action=generate_scoresheet" method="POST">
      <input type="hidden" name="program_id" value="<?php echo $_GET['program_id']; ?>">
      <button type="submit"  <?php echo ($total_percent < 100) ? "disabled" : "";  ?> class="btn btn-outline-dark shadow w-100">
        Generate Scoresheets
      </button> 
    </form> -->
    </div>
  </div>
</div>
<div class="modal fade" id="modal-full-width" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?php echo URLROOT ?>/app/controller/participant_controller.php?action=add" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Add Participants</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="program_id" value="<?php echo $program_info->program_id ?>">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" placeholder="Name/Group Name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Department <span class="text-danger">*</span></label>
            <select class="form-select" name="department" required>
              <?php foreach ($department->all() as $key => $dpt): ?>
              <option value="<?php echo $dpt->department_id ?>"><?php echo $dpt->department_name ?></option> 
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>        
      </form>
    </div>
  </div>
</div>
<!-- edit participants form -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?php echo URLROOT ?>/app/controller/participant_controller.php?action=update" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Edit Participants</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="program_id" value="<?php echo $program_info->program_id ?>">
          <input type="hidden" name="participant_id" id="participant_id" value="">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="participant_name" id="participant_name" placeholder="Name/Group Name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Department <span class="text-danger">*</span></label>
            <select class="form-select" name="department" id="department_id" required>
              <?php foreach ($department->all() as $key => $dpt): ?>
              <option value="<?php echo $dpt->department_id ?>"><?php echo $dpt->department_name ?></option> 
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>        
      </form>
    </div>
  </div>
</div>
<!-- Add Criteria for Judging -->
<div class="modal fade" id="modal-criteria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?php echo URLROOT ?>/app/controller/criteria_controller.php?action=add" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Criteria for Judging</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">          
          <input type="hidden" name="program_id" value="<?php echo $program_info->program_id ?>">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="criteria" placeholder="Criteria">
          </div>
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="description" placeholder="Description">
          </div>
          <div class="mb-3">
            <label class="form-label">Percentage <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="percentage" placeholder="%">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
        </div>
        
      </form>
    </div>
  </div>
</div>
<!-- Edit criteria for Judging -->
<div class="modal fade" id="modal-edit-criteria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?php echo URLROOT ?>/app/controller/criteria_controller.php?action=update" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Edit Criteria</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="program_id" value="<?php echo $program_info->program_id ?>">          
          <input type="hidden" name="criteria_id" id="criteria_id" value="">
          <div class="mb-3">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="criteria" id="criteria" placeholder="Criteria">
          </div>
          <div class="mb-3">
            <label class="form-label">Description <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description">
          </div>
          <div class="mb-3">
            <label class="form-label">Percentage <span class="text-danger">*</span></label>
            <input type="number" class="form-control" name="percentage" id="percentage" placeholder="%">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
        </div>
        
      </form>
    </div>
  </div>
</div>
<!-- Select Judges -->
<div class="modal fade" id="modal-judges" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="<?php echo URLROOT ?>/app/controller/judge_controller.php?action=assign&program_id=<?php echo $program_info->program_id ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Judges</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>        
          <div class="table-responsive">
            <table class="table card-table table-vcenter">
              <input type="hidden" name="program_id" value="<?php echo $program_info->program_id ?>">
              <tbody> 
               <!-- judges all --> 
                <?php foreach ($judges as $rg): ?>  
                    <tr>
                      <td><?php echo $rg->id ?></td>
                    <td class="">
                      <input type="checkbox" value="<?php echo $rg->id ?>"
                      name="judge[]" class="form-check-input align-middle" aria-label="Select task">
                    </td>
                    <td>
                      <span class="avatar avatar" style="background-image: url('<?php echo ASSETS ?>/static/avatar.png')"></span>
                    </td>
                    <td class="w-100">
                      <a href="#" class="text-reset"><?php echo $rg->fullname ?></a>
                    </td>
                  </tr> 
                <?php endforeach ?>  
              </tbody>
            </table>
          </div> 
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
        </div> 
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.participant_edit').on('click', function(){
      let id = $(this).data('participantid');
      $.ajax({
        url: '<?php echo URLROOT ?>/app/controller/participant_controller.php?action=edit',
        type: 'POST',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(rp) {
        $('#participant_name').val(rp.participant_name);
        $('#department_id').val(rp.department);
        $('#participant_id').val(rp.participant_id);

        console.log(rp);
        console.log("success");
      })
      .fail(function(rp) {
        console.log(rp);
        console.log("error");
      })
      .always(function(rp) {
        console.log(rp);
        console.log("complete");
      }); 
    });
    // 
    $('.edit_criteria').on('click', function(){
      let id = $(this).data('criteriaid');
      console.log(id);
      $.ajax({
        url: '<?php echo URLROOT ?>/app/controller/criteria_controller.php?action=edit',
        type: 'POST',
        dataType: 'json',
        data: {id: id},
      })
      .done(function(rp) {
        $('#criteria_id').val(rp.criteria_id);
        $('#criteria').val(rp.criteria);
        $('#description').val(rp.description);
        $('#percentage').val(rp.percentage);  
        console.log(rp);
        console.log("success");
      })
      .fail(function(rp) {
        console.log(rp);
        console.log("error");
      })
      .always(function(rp) {
        console.log(rp);
        console.log("complete");
      });
      
    });
  });
</script>