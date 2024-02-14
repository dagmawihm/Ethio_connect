<?php

$err = "";


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Reset your password | Ethio Connect</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/line-awesome.css">
  <link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>

<body class="sign-in">
  <div class="wrapper">
    <div class="sign-in-page">
      <div class="signin-popup">
        <div class="signin-pop">
          <div class="row">
            <div class="col-lg-6">
              <div class="cmp-info">
                <div class="cm-logo">
                  <img src="images/cm-logo.png" alt="">
                  <p>Ethio connect, is a social networking where businesses and independent professionals connect and collaborate remotely</p>
                </div>
                <img src="images/cm-main-img.png" alt="">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="login-sec">
              <ul class="sign-control">
                  <li data-tab="tab-1" class="current"><a href="sign_in.php" title="">Sign in</a></li>
                  <a href="sign_up.php"><button style="background-color: #e5e5e5; color: #000; border-top-right-radius: 4px; border-bottom-right-radius: 4px; font-size: 14px; font-weight: 500; height: 28px; width: 65px; border: 0px">Sign up </button></a>
                </ul>
                <div class="sign_in_sec current" id="tab-1">
                  <h3>Reset your password</h3>
                  <form action="" method="POST">
                    <div class="row">

                      <div class="col-lg-12 no-pdd">
                        <div class="sn-field">
                          <input type="email" name="email" placeholder="Email" required>
                          <i class="la la-envelope"></i>
                        </div>
                      </div>

                      <span style="color: red; font-size: 13px"><?php echo $err ?></span>







                      <div class="col-lg-12 no-pdd">
                        <button type="submit" name="login" value="submit">Send code</button>
                      </div>

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="footy-sec">
        <div class="container">
          <ul>
            <li><a href="help-center.php" title="">Help Center</a></li>
            <li><a href="about.php" title="">About</a></li>
            <li><a href="#" title="">Privacy Policy</a></li>
            <li><a href="#" title="">Community Guidelines</a></li>
            <li><a href="#" title="">Cookies Policy</a></li>
            <li><a href="#" title="">Career</a></li>
            <li><a href="forum.html" title="">Forum</a></li>
            <li><a href="#" title="">Language</a></li>
            <li><a href="#" title="">Copyright Policy</a></li>
          </ul>
          <p><img src="images/copy-icon.png" alt="">Copyright 2021</p>
        </div>
      </div>
    </div>
  </div>
  <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/popper.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="lib/slick/slick.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>