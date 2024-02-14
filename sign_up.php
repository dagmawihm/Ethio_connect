<?php
include_once "inc/db.php";
$pswerr = "";
$emailerr = "";

$year = 2000;
$cyear = date("y");
$lim = $cyear - 18 + 2000;
$today = date("-m-d");
$yearlim = $lim . $today;

$fname = "";
$lname = "";
$email = "";
$gender = "";
$dob = "";

if (isset($_POST['signupu'])) {

  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $repeat_password = $_POST["repeat_password"];
  $gender = $_POST["gender"];
  $dob = $_POST["dob"];


  $passwordhash = password_hash($password, PASSWORD_DEFAULT);

  $uppercase = preg_match('@[A-Z]@', $password);
  $lowercase = preg_match('@[a-z]@', $password);
  $number = preg_match('@[0-9]@', $password);


  if (!$uppercase) {
    //echo "<script>alert('Must contain at least one uppercase character')</script>"; 
    $pswerr = $pswerr . "* Must contain at least one uppercase character" . "<br>";
  }
  if (!$lowercase) {
    //echo "<script>alert('Must contain at least one lowercase character')</script>"; 
    $pswerr = $pswerr . "* Must contain at least one lowercase character" . "<br>";
  }
  if (!$number) {
    //echo "<script>alert('Must contain at least 1 number')</script>"; 
    $pswerr = $pswerr . "* Must contain at least 1 number" . "<br>";
  }

  if ($password != $repeat_password) {
    //echo "<script>alert('Password do not match')</script>"; 
    $pswerr = $pswerr . "* Password do not match" . "<br>";
  }


  $ce = 0;
  $sqle = "SELECT email FROM users where email = '$email'";
  $resulte = mysqli_query($db, $sqle);
  $ce = mysqli_num_rows($resulte);
  if ($ce >= 1) {
    $emailerr = "* Email is already being used!!!" . "<br><br>";
  }

  $username = $fname.date("y-m-d").(rand(1000000, 9999999));


  $pswerr = $pswerr . "<br>";

  if ($pswerr == "<br>" && $emailerr == "") {
    if ($gender == "f") {
      $sql = "INSERT INTO users (f_name, l_name, username, profile_pic, email, password, dob, gender) VALUE ('$fname','$lname','$username','default_f_pp.png','$email','$passwordhash','$dob','$gender')";
    } else {
      $sql = "INSERT INTO users (f_name, l_name, username, profile_pic, email, password, dob, gender) VALUE ('$fname','$lname','$username','default_m_pp.png','$email','$passwordhash','$dob','$gender')";
    }

    mysqli_query($db, $sql);
    echo "<script>alert('REGISTERED Successfully ✓')</script>";
    echo '<meta http-equiv="refresh" content="0; URL=sign_in.php">';
  }
}


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Sign up | Ethio Connect</title>
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
  <style type="text/css">
    .sign_in_sec {
      display: block;
    }

    .customcb {
      width: 17px;
      height: 17px;
      position: relative;
    }
  </style>
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
                  <a href="sign_in.php"><button style="background-color: #e5e5e5; color: #000; border-top-left-radius: 4px; border-bottom-left-radius: 4px; font-size: 14px; font-weight: 500; height: 28px; width: 65px; border: 0px">Sign in </button></a>
                  <li data-tab="tab-2" class="current"><a href="#" title="">Sign up</a></li>
                </ul>

                <div class="sign_in_sec" id="tab-2">
            
                  <div class="dff-tab current" id="tab-3">

                    <form action="" method="POST">
                      <div class="row">

                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="text" name="fname" value="<?php echo $fname; ?>" placeholder="First Name" maxlength="20" required>
                            <i class="la la-user"></i>
                          </div>
                        </div>

                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="text" name="lname" value="<?php echo $lname; ?>" placeholder="Last Name" maxlength="20" required>
                            <i class="la la-user"></i>
                          </div>
                        </div>

                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email" maxlength="50" required>
                            <i class="la la-envelope"></i>
                          </div>
                        </div>

                        <span style="color: red; font-size: 13px"><?php echo $emailerr ?></span>

                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="password" name="password" value="" minlength="8" id="p1" placeholder="Password" required>
                            <span><i class="fa fa-eye-slash" id="sh1" onclick="myFunction()"></i></span>
                            <i class="la la-lock"></i>
                          </div>
                        </div>

                        <span style="color: red; font-size: 13px"><?php echo $pswerr ?></span>

                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="password" name="repeat_password" value="" minlength="8" id="p2" placeholder="Confirm your Password" required>
                            <span><i class="fa fa-eye-slash" id="sh2" onclick="myFunction()"></i></span>
                            <i class="la la-lock"></i>
                          </div>
                        </div>



                        <script>
                          function myFunction() {
                            var x = document.getElementById("p1");
                            var y = document.getElementById("p2");
                            if (x.type === "password") {
                              x.type = "text";
                              y.type = "text";
                              document.getElementById("sh1").className = "fa fa-eye";
                              document.getElementById("sh2").className = "fa fa-eye";
                            } else {
                              x.type = "password";
                              y.type = "password";
                              document.getElementById("sh1").className = "fa fa-eye-slash";
                              document.getElementById("sh2").className = "fa fa-eye-slash";
                            }
                          }
                        </script>

                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <select name="gender" required>
                              <?php
                              if ($gender == "") {
                              ?>
                                <option value="">Gender</option>
                                <option value="f">Female</option>
                                <option value="m">Male</option>
                                <?php
                              } else {
                                if ($gender == "f") {
                                ?>

                                  <option value="f">Female</option>
                                  <option value="m">Male</option>
                                <?php
                                } else {
                                ?>
                                  <option value="m">Male</option>
                                  <option value="f">Female</option>

                              <?php
                                }
                              }
                              ?>
                            </select>
                            <span><i class="fa fa-male"></i></span>
                            <i class="fa fa-female"></i>
                          </div>
                        </div>

                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">
                            <input type="date" name="dob" value="<?php echo $dob; ?>" min="1905-01-01" max="<?php echo $yearlim; ?>" required>
                            <i class="la la-birthday-cake"></i>
                          </div>
                        </div>



                        <div class="col-lg-12 no-pdd">
                          <div class="sn-field">

                            <div class="red customcb">
                              <input type="checkbox" value="1" id="c2" name="cc" required>
                            </div>
                            <div class="dagi">
                            <small>Yes, I understand and agree to the <br>Ethio connect Terms & Conditions.</small>
                            </div>

                          </div>
                        </div>


                        <div class="col-lg-12 no-pdd">
                          <button type="submit" name="signupu" value="submit">Get Started</button>
                        </div>

                      </div>
                    </form>

                  </div>
                  
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
            <li><a href="Privacy_policy.php" title="">Privacy Policy</a></li>
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