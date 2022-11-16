<?php $user = new User($db); $user->getUser($_SESSION['userid']) ?>
<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav flex-row order-md-last">
      <div class="d-none d-md-flex">
      </div>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          <span class="avatar avatar-sm" style="background-image: url('<?php echo URLROOT; ?>/public/static/avatar.png')"></span>
          <div class="d-none d-xl-block ps-2">
            <div><?php echo ucwords($user->getUser($_SESSION['userid'])->fullname) ?></div>
            <div class="mt-1 small text-muted"><?php echo ucwords($user->getUser($_SESSION['userid'])->usertype) ?></div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow"> 
          <a href="<?php echo URLROOT.'/app/controller/usercontroller.php?action=logout'; ?>" class="dropdown-item">Logout</a>
        </div>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div>
      </div>
    </div>
  </div>
</header>