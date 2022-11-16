<?php $user = new User($db); $user->getUser($_SESSION['userid']) ?>

<header class="navbar navbar-expand-md navbar-light d-print-none">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
      <a href="" class="d-flex align-items-center gap-2">
        <img src="<?php echo ASSETS ?>/static/kcclogo.png" width="40" height="40" alt="Tabler" class="">
        <span class="d-none d-lg-inline-block h2 mb-0"><?php echo APPNAME ?></span>
      </a>
    </h1>
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
      <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
        <ul class="navbar-nav">
          <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
            </span>
            <span class="nav-link-title">
              Dashboard
            </span>
          </a>
        </li>
          <li class="nav-item <?php echo ($user->getUser($_SESSION['userid'])->usertype != 'admin') ? "d-none" : ""; ?>">
          <a class="nav-link" href="<?php echo URLROOT ?>/app/views/events" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="4" width="18" height="12" rx="1"></rect><path d="M7 20h10"></path><path d="M9 16v4"></path><path d="M15 16v4"></path><path d="M9 12v-4"></path><path d="M12 12v-1"></path><path d="M15 12v-2"></path><path d="M12 12v-1"></path></svg>
            </span>
            <span class="nav-link-title">
              Events
            </span>
          </a>
        </li>
        <li class="nav-item <?php echo ($user->getUser($_SESSION['userid'])->usertype != 'admin') ? "d-none" : ""; ?>">
          <a class="nav-link" href="<?php echo URLROOT ?>/app/views/programs" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 15h-6a1 1 0 0 1 -1 -1v-8a1 1 0 0 1 1 -1h6"></path><rect x="13" y="4" width="8" height="16" rx="1"></rect><line x1="7" y1="19" x2="10" y2="19"></line><line x1="17" y1="8" x2="17" y2="8.01"></line><circle cx="17" cy="16" r="1"></circle><line x1="9" y1="15" x2="9" y2="19"></line></svg>
            </span>
            <span class="nav-link-title">
              Programs
            </span>
          </a>
        </li>
        <li class="nav-item <?php echo ($user->getUser($_SESSION['userid'])->usertype != 'admin') ? "d-none" : ""; ?>">
          <a class="nav-link" href="<?php echo URLROOT ?>/app/views/judges" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="9" cy="7" r="4"></circle><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path><path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>
            </span>
            <span class="nav-link-title">
              Judges
            </span>
          </a>
        </li> 
        <li class="nav-item dropdown <?php echo ($user->getUser($_SESSION['userid'])->usertype != 'admin') ? "d-none" : ""; ?>">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="6" cy="10" r="2"></circle><line x1="6" y1="4" x2="6" y2="8"></line><line x1="6" y1="12" x2="6" y2="20"></line><circle cx="12" cy="16" r="2"></circle><line x1="12" y1="4" x2="12" y2="14"></line><line x1="12" y1="18" x2="12" y2="20"></line><circle cx="18" cy="7" r="2"></circle><line x1="18" y1="4" x2="18" y2="5"></line><line x1="18" y1="9" x2="18" y2="20"></line></svg>
            </span>
            <span class="nav-link-title">
              Settings
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="./empty.html" >
                  Department
                </a>
                <a class="dropdown-item" href="./empty.html" >
                  Categories
                </a>
                <a class="dropdown-item" href="<?php echo URLROOT ?>/app/views/user" >
                  Users
                </a>
              </div>
            </div>
          </div>
        </li>
        </ul>
      </div>
    </div>
  </div>
</header>