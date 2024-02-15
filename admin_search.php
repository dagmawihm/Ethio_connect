<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Admin home | Ethio Connect</title>
  <?php
  include_once "inc/db.php";
  session_start();

  if (!isset($_SESSION["user"]) || $_SESSION["user"] != "admin") {
    header('Location: sign_in.php');
  }



  if (isset($_POST['logout'])) {
    session_destroy();
    echo '<script type="text/javascript">';
    echo "window.location.href = 'sign_in.php';";
    echo "</script>";
  }


  if (!isset($_GET['key_word']) and !isset($_SESSION["key_word"])) {
    echo '<script type="text/javascript">';
    echo "window.location.href = 'admin_home.php';";
    echo "</script>";
  } else {






    if (isset($_SESSION["key_word"])) {
      $keywordd = $_SESSION["key_word"];
    }
    if (isset($_GET['key_word'])) {
      $keywordd = $_GET['key_word'];
    }
    $_SESSION["key_word"] = $keywordd;
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

  <section class="companies-info">
    <div class="container">
      <div class="company-title">




        <?php


        $sql_search_user = "SELECT * FROM users where f_name LIKE '%$keywordd%' OR l_name LIKE '%$keywordd%' OR username LIKE '%$keywordd%' OR phone_no LIKE '%$keywordd%' OR mail LIKE '%$keywordd%'";
        $result_search_user = mysqli_query($db, $sql_search_user);

        $c_users = mysqli_num_rows($result_search_user);

        if ($c_users == 0) {
        ?>

          <h3>Your search "<?php echo $keywordd; ?>" didn't matche any thing from our database</h3>

        <?php
        } else {
        ?>
          <h3>Users Search result for "<?php echo $keywordd; ?>"</h3>
      </div>
      <div class="companies-list">
        <div class="row">
          <?php
          while ($row = mysqli_fetch_array($result_search_user)) {
            $user_id_s_r = $row["user_id"];
            $f_name = $row["f_name"];
            $l_name = $row["l_name"];
            $profile_pic = $row["profile_pic"];
            $bio = $row["bio"];
            $username = $row["username"];
            $type = $row['type'];


          ?>


            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
              <div class="company_profile_info">
                <div class="company-up-info">
                  <img src="users_Img/users_pp/<?php echo $profile_pic; ?>" alt="">
                  <h3><?php echo $f_name . " " . $l_name; ?></h3>
                  <h4><?php echo $bio; ?></h4>
                  <ul>



                    <?php
                    if ($type == 'mod') {
                    ?>
                      <form action="" method="POST">
                        <input type="text" name="suseridd" value="<?php echo  $user_id_s_r; ?>" style="display: none;">
                        <button type="submit" name="remove" id="remove<?php echo  $user_id_s_r; ?>" style="display:none"></button>
                      </form>

                      <li><a href="#" title="" style="background-color: red;" class="flww"><label for="remove<?php echo  $user_id_s_r; ?>"><i class="fa fa-trash-o"></i> Remove</label></a></li>
                    <?php
                    } else {

                    ?>
                      <form action="" method="POST">
                        <input type="text" name="suseridd" value="<?php echo  $user_id_s_r; ?>" style="display: none;">
                        <button type="submit" name="assign" id="assign<?php echo  $user_id_s_r; ?>" style="display:none"></button>
                      </form>

                      <li><a href="#" title="" class="flww"><label for="assign<?php echo  $user_id_s_r; ?>"><i class="la la-plus"></i> Assign moderator</label></a></li>
                    <?php
                    }
                    ?>

                  </ul>
                </div>

              </div>
            </div>

        <?php

          }
        }
        ?>







        </div>
      </div>



    </div>
  </section>

  <?php
    if (isset($_POST['assign'])) {
      $delnot_id = $_POST['suseridd'];
      $sql_del = "UPDATE users SET type = 'mod' WHERE user_id = '$delnot_id'";
      mysqli_query($db, $sql_del);
      echo '<script type="text/javascript">';
      echo "window.location.href = 'admin_search.php';;";
      echo "</script>";
    }
    if (isset($_POST['remove'])) {
      $delnot_id = $_POST['suseridd'];
      $sql_del = "UPDATE users SET type = 'user' WHERE user_id = '$delnot_id'";
      mysqli_query($db, $sql_del);
      echo '<script type="text/javascript">';
      echo "window.location.href = 'admin_search.php';;";
      echo "</script>";
    }
  include_once "inc/footer.php";
  ?>

  </div>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/popper.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/flatpickr.min.js"></script>
  <script type="text/javascript" src="lib/slick/slick.min.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>