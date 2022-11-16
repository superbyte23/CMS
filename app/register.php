<?php include '../bootstrapper.php'; if (isset($_SESSION['userid'])){ header("Location: ./views/dashboard.php"); } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php echo SITENAME; ?></title>
    <!-- CSS files -->
    <link href="<?php echo URLROOT; ?>/public/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="<?php echo URLROOT; ?>/public/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="<?php echo URLROOT; ?>/public/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="<?php echo URLROOT; ?>/public/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="<?php echo URLROOT; ?>/public/dist/css/demo.min.css" rel="stylesheet"/>
  </head>
</head>
<body  class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?php echo URLROOT; ?>/public/static/logo.svg" height="36" alt=""></a>
        </div>
        <form class="card card-md"action="<?php echo URLROOT.'/app/controller/usercontroller.php?action=register'; ?>" method="post">
        <?php csrf(); ?>
        <div class="card-body">
          <h2 class="card-title text-center mb-4">Create new account</h2>
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" placeholder="Full name" name="fullname">
          </div>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" placeholder="Username" name="username">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="Email" name="email">
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group input-group-flat">
              <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off">
              <span class="input-group-text">
                <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                </a>
              </span>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Retype Password</label>
            <div class="input-group input-group-flat">
              <input type="password" class="form-control" placeholder="Retype password" name="password2" autocomplete="off">
              <span class="input-group-text">
                <a href="#" class="link-secondary" title="" data-bs-toggle="tooltip" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>
                </a>
              </span>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-check">
              <input type="checkbox" class="form-check-input">
              <span class="form-check-label">Agree the <a href="./terms-of-service.html" tabindex="-1">terms and policy</a>.</span>
            </label>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Create new account</button>
          </div>
        </div> 
      </form>  
        <div class="text-center text-muted mt-3">
          Already have account?  <a href="./login.php" tabindex="-1">Login</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo URLROOT; ?>/public/dist/js/tabler.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/dist/js/demo.min.js"></script>
  </body>
</html>
