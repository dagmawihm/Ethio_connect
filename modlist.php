<?php
session_start();
include_once "inc/db.php";


if (!isset($_SESSION["user"]) || $_SESSION["user"] != "admin") {
  header('Location: sign_in.php');
}



if (isset($_POST['logout'])) {
  session_destroy();
  echo '<script type="text/javascript">';
  echo "window.location.href = 'sign_in.php';";
  echo "</script>";
}

if (!isset($_GET['req'])) {
  echo '<script type="text/javascript">';
  echo "window.location.href = 'admin_home.php';";
  echo "</script>";
} else {
  $req = $_GET['req'];
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>List of <?php echo $req; ?> Moderators | Ethio Connect</title>
  <style>
    .label_del {
      float: right;
      padding-right: 10%;
      padding-top: 4px;
    }

    .label_del:hover {
      color: #e44d3a;
      font-size: 18px;
      transition: 0.5s ease all;
    }
  </style>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/flatpickr.min.css">
  <link rel="stylesheet" type="text/css" href="css/line-awesome.css">
  <link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.mCustomScrollbar.min.css">
  <link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">


</head>

<body>
  <header>
    <div class="container">
      <div class="header-data">
        <div class="logo">
          <a href="admin_home.php" title=""><img src="images/logo.png" alt=""></a>
        </div>
        <div class="search-bar">
          <form action="admin_search.php" method="GET">
            <input type="text" name="key_word" placeholder="Search...">
            <button type="submit"><i class="la la-search"></i></button>
          </form>
        </div>
 
        <div class="menu-btn">
          <a href="#" title=""><i class="fa fa-bars"></i></a>
        </div>
        <div class="user-account">
          <div class="user-info">
            <img src="admin/pp.JPG" style="max-width: 30px; max-height: 30px" alt="">
            <a href="#" title="">Dagmawi</a>
            <i style="margin-right: -40px;" class="la la-sort-down"></i>
          </div>
          <div class="user-account-settingss">


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







  <div class="tab-pane fade active show" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
    <div class="acc-setting" style="min-height: 636px;overflow: hidden;">
      <h3>List of <?php echo $req; ?> Moderators</h3>
      <div class="notifications-list">
        <?php
        if($req=="all")
        {
          $sql_all_mods = "SELECT * FROM users WHERE type='mod'";
        }
        else
        {
          $sql_all_mods = "SELECT * FROM users WHERE type='mod' and online='true'";
        }
        
        $resulte_all_mods = mysqli_query($db, $sql_all_mods);
        $mods = mysqli_num_rows($resulte_all_mods);
        if ($mods == 0) {
        ?>
          <div class='notfication-details'>
            <div class='notification-info'>
              <h3>There is no Moderators</h3>
            </div>
          </div>
        <?php
        } else {
          while ($row = mysqli_fetch_array($resulte_all_mods)) {
            $userpp = $row["profile_pic"];
              $ffname = $row["f_name"];
              $llname = $row["l_name"];
              $username_post = $row["username"];
              $user_id_list = $row['user_id'];

        ?>

          <div class="notfication-details">
            <div class="noty-user-img">
              <a href="user-profile.php?username=<?php echo $username_post; ?>" title=""><img src="users_Img/users_pp/<?php echo $userpp; ?>" alt=""></a>
            </div>
            <div class="notification-info">
              <h3><a href="user-profile.php?username=<?php echo $username_post; ?>" title=""><?php echo $ffname . " " . $llname; ?></a></h3>

              <form action="" method="post">
                <button type="submit" name="delnot" style="display: none;" id="<?php echo $user_id_list; ?>" value="<?php echo $user_id_list; ?>"></button>
              </form>

            </div>
            <label class="label_del" for="<?php echo $user_id_list; ?>"><i class="fa fa-trash-o fa-2x"></i></label>
          </div>
        <?php
        }}
        ?>
      </div>
    </div>
  </div>


  <?php
  if (isset($_POST['delnot'])) {
    $delnot_id = $_POST['delnot'];
    $sql_del = "UPDATE users SET type = 'user' WHERE user_id = '$delnot_id'";
    mysqli_query($db, $sql_del);
    echo '<script type="text/javascript">';
    echo "window.location.href = 'modlist.php?req=".$req."';;";
    echo "</script>";
  }
  include_once "inc/footer.php";
  ?>

  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/popper.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.range-min.js"></script>
  <script type="text/javascript" src="lib/slick/slick.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>