<?php
session_start();
include_once "inc/db.php";
$err = "";

if (isset($_POST['login'])) {

  $email = $_POST["email"];
  $password = $_POST["password"];

  if ($email == "admin@gmail.com" and $password == "Admin123") {
    $_SESSION["user"] = "admin";
    echo '<script type="text/javascript">';
    echo "window.location.href = 'admin_home.php';";
    echo "</script>";
  }

  $remember_me = 0;
  if (isset($_POST['rm'])) {
    $remember_me = 1;
  }
  $ce = 0;
  $sqle = "SELECT * FROM users where email = '$email'";
  $resulte = mysqli_query($db, $sqle);
  $ce = mysqli_num_rows($resulte);
  if ($ce == 0) {
    $err = "<b>Wrong Password or Email</b>.<br> Don't forget that both fields are case sensitive, Try again or click Forgot password to reset it.";
  } else {
    while ($row = mysqli_fetch_array($resulte)) {
      $passwordhash = $row["password"];
      $dbemail = $row["email"];
    }
    if ($email == $dbemail) {
      $verify = password_verify($password, $passwordhash);
      if ($verify) {
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;
        if ($remember_me == 1) {
          setcookie("email", $email, time() + (86400 * 7), "/");
          setcookie("password", $password, time() + (86400 * 7), "/");
        }
        echo '<script type="text/javascript">';
        echo "window.location.href = 'index.php';";
        echo "</script>";
      } else {
        $err = "<b>Wrong Password or Email</b>.<br> Don't forget that both fields are case sensitive, Try again or click Forgot password to reset it.";
      }
    } else {
      $err = "<b>Wrong Password or Email</b>.<br> Don't forget that both fields are case sensitive, Try again or click Forgot password to reset it.";
    }
  }
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Sign in | Ethio Connect</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/line-awesome.css">
  <link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
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
                  <li data-tab="tab-1" class="current"><a href="#" title="">Sign in</a></li>
                  <a href="sign_up.php"><button style="background-color: #e5e5e5; color: #000; border-top-right-radius: 4px; border-bottom-right-radius: 4px; font-size: 14px; font-weight: 500; height: 28px; width: 65px; border: 0px">Sign up </button></a>
                </ul>
                <div class="sign_in_sec current" id="tab-1">
                  <h3>Sign in</h3>
                  <form action="" method="POST">
                    <div class="row">

                      <div class="col-lg-12 no-pdd">
                        <div class="sn-field">
                          <input type="email" name="email" placeholder="Email" required>
                          <i class="la la-envelope"></i>
                        </div>
                      </div>

                      <div class="col-lg-12 no-pdd">
                        <div class="sn-field">
                          <input type="password" name="password" id="p1" placeholder="Password" required>
                          <span><i class="fa fa-eye-slash" id="sh1" onclick="myFunction()"></i></span>
                          <i class="la la-lock"></i>
                        </div>
                      </div>

                      <span style="color: red; font-size: 13px"><?php echo $err ?></span>



                      <script>
                        function myFunction() {
                          var x = document.getElementById("p1");
                          if (x.type === "password") {
                            x.type = "text";
                            document.getElementById("sh").className = "fa fa-eye";
                          } else {
                            x.type = "password";
                            document.getElementById("sh").className = "fa fa-eye-slash";
                          }
                        }
                      </script>

                      <div class="col-lg-12 no-pdd">
                        <div class="checky-sec">
                          <div class="fgt-sec">
                            <input type="checkbox" name="rm" id="c1">
                            <label for="c1">
                              <span></span>
                            </label>
                            <small>Remember me</small>
                          </div>
                          <a href="forgot.php" title="">Forgot Password?</a>
                        </div>
                      </div>

                      <div class="col-lg-12 no-pdd">
                        <button type="submit" name="login" value="submit">Sign in</button>
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