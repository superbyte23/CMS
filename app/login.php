<?php include '../bootstrapper.php'; if (isset($_SESSION['userid'])){ header("Location: ./views/dashboard.php"); } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php echo SITENAME; ?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT; ?>/public/static/favicon.ico">
    <!-- CSS files -->
    <link href="<?php echo URLROOT; ?>/public/dist/css/tabler.min.css" rel="stylesheet"/> 
    <link href="<?php echo URLROOT; ?>/public/dist/css/demo.min.css" rel="stylesheet"/> 
 
    <!-- jquery --> 
    <script src="<?php echo URLROOT; ?>/public/dist/libs/jquery/js/jquery-3.6.1.min.js"></script>
    <!-- confirm js -->
    <link href="<?php echo URLROOT; ?>/public/dist/libs/confirm/css/jquery-confirm.min.css" rel="stylesheet">
    <script src="<?php echo URLROOT; ?>/public/dist/libs/confirm/js/jquery-confirm.min.js"></script>

    <style type="text/css">
    .input-password{ 
      -webkit-text-security: disc;
    }
    .bg-login{
      background-image: url('<?php echo ASSETS ?>/static/img/bg.png'); 
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
    </style>
    </style>
  </head>
</head>
<body class="overflow-hidden d-flex flex-column ">
  <!-- design one -->
  <!-- 
  <div class="row g-0 flex-fill">
      <div class="col-12 col-lg-6 col-xl-4 border-top-wide border-primary d-flex flex-column justify-content-center">
        <div class="container container-tight my-5 px-lg-5">   
          <form class="" action="<?php echo URLROOT.'/app/controller/usercontroller.php?action=login'; ?>" method="post" autocomplete="off"> 
              <div class="text-center">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?php echo URLROOT; ?>/public/static/95th.png" height="250" alt=""></a>
              </div>
              <h1 class="text-center">E-JUDGING SYSTEM</h1>
              <h2 class="card-title text-center mb-4">Login your account</h2>
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter username" name="username" autocomplete="off">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Password
                </label>
                <div class="input-group input-group-flat">
                  <input type="text" class="form-control input-password"  placeholder="Password"  autocomplete="off" name="password" autocomplete="off">
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-red btn-lg w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M20 12h-13l3 -3m0 6l-3 -3"></path></svg>Login</button>
              </div>  
          </form> 
        </div>
      </div>
      <div class="col-12 col-lg-6 col-xl-8 d-none d-lg-block">
        <div class="bg-cover h-100 min-vh-100 bg-login" ></div>
      </div>
    </div> -->

    <!-- design two -->


    <div class="page page-center bg-login">
      <div class="container-tight py-4">
        <form class="card card-md" style="background: rgb(255 255 255 / 90%);" action="<?php echo URLROOT.'/app/controller/usercontroller.php?action=login'; ?>" method="post" autocomplete="off">
          <div class="card-body">
            <div class="d-flex gap-3 mb-4">
              <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?php echo URLROOT; ?>/public/static/kcclogo.png" class="img-fluid" width="200" alt=""></a>
              <a href="." class="navbar-brand navbar-brand-autodark"><img src="<?php echo URLROOT; ?>/public/static/95th.png" class="img-fluid" width="250" alt=""></a>
            </div>
            <h1 class="text-center">E-JUDGING SYSTEM</h1>
            <h2 class="card-title text-center mb-4">Login your account</h2>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" placeholder="Enter username" name="username" autocomplete="off">
            </div>
            <div class="mb-2">
              <label class="form-label">
                Password
              </label>
              <div class="input-group input-group-flat">
                <input type="text" class="form-control input-password"  placeholder="Password"  autocomplete="off" name="password" autocomplete="off">
              </div>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-red btn-lg w-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path><path d="M20 12h-13l3 -3m0 6l-3 -3"></path></svg>Login</button>
            </div>
          </div> 
        </form>
      </div>
    </div>
  <div class="toast-container position-fixed top-20 start-50 p-3">
    <div id="liveToast" class="toast bg-danger " role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto">Alert</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Invalid Username or Password
      </div>
    </div>
  </div>
  <!-- Libs JS -->
  <!-- Tabler Core -->

  <script src="<?php echo URLROOT; ?>/public/dist/js/tabler.min.js"></script>
  <script src="<?php echo URLROOT; ?>/public/dist/js/demo.min.js"></script>

  <script type="text/javascript"> 
    const toastLiveExample = document.getElementById('liveToast');
    const toast = new bootstrap.Toast(toastLiveExample);  
    <?php if (isset($_SESSION['error_login'])): ?>
      toast.show();
    <?php unset($_SESSION['error_login']); ?>
    <?php endif ?> 
    // $.confirm({
    //   icon: 'fa-regular fa-thumbs-up',
    //   theme: 'modern',
    //   closeIcon: true,
    //   closeIconClass: 'fa fa-close',
    //   animation: 'scale',
    //   closeAnimation: 'zoom',
    //   animationSpeed: 200, // 0.2 seconds
    //   type: 'green',
    //   title: 'Hi!',
    //   content: 'modern',
    //   buttons: {
    //     tryAgain: {
    //       text: 'Close',
    //       btnClass: 'btn-green',
    //       action: function(){
    //         const toastLiveExample = document.getElementById('liveToast')
    //          const toast = new bootstrap.Toast(toastLiveExample)
    //     toast.show()
    //       }
    //     } 
    //   }
    // });
  </script>
</body>
</html>