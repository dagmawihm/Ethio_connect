<?php
include_once "inc/db.php";

if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])) {
      if (!isset($_COOKIE["email"]) || !isset($_COOKIE["password"])) {
            //header('Location: sign_in.php');
            echo '<script>window.location.replace("sign_in.php");</script>';
            session_destroy();
            setcookie("email", "", time() + (0), "/");
            setcookie("password", "", time() + (0), "/");
      }
}

if (isset($_SESSION["email"]) and isset($_SESSION["password"])) {
      $email = $_SESSION["email"];
      $password = $_SESSION["password"];
}

if (isset($_COOKIE["email"]) and isset($_COOKIE["password"])) {
      $email = $_COOKIE["email"];
      $password = $_COOKIE["password"];
}

$ce = 0;
$sqle = "SELECT * FROM users where email = '$email'";
$resulte = mysqli_query($db, $sqle);
$ce = mysqli_num_rows($resulte);

if ($ce == 0) {
      //header('Location: sign_in.php');
      echo '<script>window.location.replace("sign_in.php");</script>';
      session_destroy();
      setcookie("email", "", time() + (0), "/");
      setcookie("password", "", time() + (0), "/");
}

while ($row = mysqli_fetch_array($resulte)) {
      $user_id = $row["user_id"];
      $passwordhash = $row["password"];
      $dbemail = $row["email"];
}

if ($dbemail == $email) {
      $verify = password_verify($password, $passwordhash);
      if ($verify) {
      } else {
            //header('Location: sign_in.php');
            echo '<script>window.location.replace("sign_in.php");</script>';
            session_destroy();
            setcookie("email", "", time() + (0), "/");
            setcookie("password", "", time() + (0), "/");
      }
}






$pp = "";
$name = "";


$sql = "SELECT * FROM users where user_id = '$user_id'";
$result = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($result)) {
      $pp = $row["profile_pic"];
      $name = $row["f_name"];
      $lname = $row["l_name"];
      $bio = $row["bio"];
      $username = $row["username"];
      $copp = $row["cover_pic"];
      $type = $row["type"];

      $phone_no = $row["phone_no"];
      $website = $row["website"];
      $facebook = $row["facebook"];
      $instagram = $row["instagram"];
      $twitter = $row["twitter"];
      $mail = $row["mail"];
      
}

$sql_set_offline = "UPDATE users set online='true' WHERE user_id = '$user_id'";
mysqli_query($db, $sql_set_offline);




if (isset($_POST['logout'])) {

      $sql_set_offline = "UPDATE users set online='false'";
      mysqli_query($db, $sql_set_offline);

      session_destroy();
      setcookie("email", "", time() + (0), "/");
      setcookie("password", "", time() + (0), "/");
      echo '<script type="text/javascript">';
      echo "window.location.href = 'sign_in.php';";
      echo "</script>";
}
?>


<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">


</head>

<body>
      <header>
            <div class="container">
                  <div class="header-data">
                        <div class="logo">
                              <a href="index.php" title=""><img src="images/logo.png" alt=""></a>
                        </div>
                        <div class="search-bar">
                              <form action="search_result.php" method="GET">
                                    <input type="text" name="key_word" placeholder="Search...">
                                    <button type="submit"><i class="la la-search"></i></button>
                              </form>
                        </div>
                        <nav>
                              <ul>
                                    <li>
                                          <a href="index.php" title="">
                                                <span><img src="images/icon1.png" alt=""></span>
                                                Home
                                          </a>
                                    </li>

                                    <li>
                                          <a href="my_profile_feed.php" title="">
                                                <span><i class="fa fa-user"></i></span>
                                                My profile
                                          </a>
                                    </li>

                                    <li>
                                          <a href="groups.php" title="">
                                                <span><i class="fa fa-users"></i></span>
                                                Groups
                                          </a>
                                    </li>


                                    <li>
                                          <a href="messages.php" title="">
                                                <span><img src="images/icon6.png" alt=""></span>
                                                Messages
                                          </a>
                                    </li>
                                    <li>
                                          <a href="#" title="" class="not-box-open">
                                                <span><img src="images/icon7.png" alt=""></span>
                                                Notification
                                          </a>
                                          <div class="notification-box noti" id="notification">
                                              
                                                <div class="nott-list">

                                                      <?php
                                                      $notis = 0;

                                                      $sql_notifications = "SELECT * FROM notifications WHERE recipient_id = '$user_id' order by notification_id desc LIMIT 3";
                                                      $result_notifications = mysqli_query($db, $sql_notifications);
                                                      $notis = mysqli_num_rows($result_notifications);
                                                      if ($notis == 0) {
                                                      ?>
                                                            <div class="notfication-details">
                                                                  <div class="notification-info">
                                                                        <h3>You don't have any notification</h3>
                                                                  </div>
                                                            </div>
                                                      <?php
                                                      } else {
                                                            while ($row = mysqli_fetch_array($result_notifications)) {
                                                                  $date = $row["date"];
                                                                  $notification_id = $row['notification_id'];
                                                                  $notification1 = $row["notification"];
                                                                  $notifier = $row["notifier"];

                                                                  $sqluser = "SELECT * FROM users where user_id = '$notifier  '";
                                                                  $resultuser = mysqli_query($db, $sqluser);
                                                                  while ($row = mysqli_fetch_array($resultuser)) {
                                                                        $userpp = $row["profile_pic"];
                                                                        $ffname = $row["f_name"];
                                                                        $llname = $row["l_name"];
                                                                        $username_post = $row["username"];
                                                                  }
                                                            

                                                      ?>

                                                            <div class="notfication-details">
                                                                  <div class="noty-user-img">
                                                                        <a href="user-profile.php?username=<?php echo $username_post; ?>" title=""><img src="users_Img/users_pp/<?php echo $userpp; ?>" alt=""></a>
                                                                  </div>
                                                                  <div class="notification-info">
                                                                        <h3><a href="user-profile.php?username=<?php echo $username_post; ?>" title=""><?php echo $ffname . " " . $llname; ?></a> <?php echo $notification1; ?></h3>
                                                                  </div>
                                                            </div>

                                                      <?php
                                                      }}
                                                      ?>

                                                      <div class="view-all-nots">
                                                            <a href="notification.php" title="">View All Notification</a>
                                                      </div>
                                                </div>
                                          </div>
                                    </li>
                              </ul>
                        </nav>
                        <div class="menu-btn">
                              <a href="#" title=""><i class="fa fa-bars"></i></a>
                        </div>
                        <div class="user-account">
                              <div class="user-info">
                                    <img src="users_Img/users_pp/<?php echo $pp; ?>" style="max-width: 30px; max-height: 30px" alt="">
                                    <a href="#" title=""><?php echo $name; ?></a>
                              </div>
                              <div class="user-account-settingss">

                                    <h3>Setting</h3>
                                    <ul class="us-links">
                                          <li><a href="profile_account_setting.php" title="Account Setting">Account Setting</a></li>
                                          <li><a href="Privacy_policy.php" title="Privacy policy">Privacy policy</a></li>
                                          <li><a href="help-center.php" title="Help Center">Help Center</a></li>
                                    </ul>

                                    <div class="search_form">
                                          <form method="POST" action="">
                                                <p>&nbsp;</p>
                                                <button type="submit" name="logout" style="left: 70px;">Logout</button>
                                                <br>
                                          </form>
                                    </div>

                              </div>
                        </div>
                  </div>
            </div>
      </header>