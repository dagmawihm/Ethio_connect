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

        <h3> Web state</h3>
      </div>
      <div class="companies-list">
        <div class="row">


          <?php
          $sql_all_users = "SELECT * FROM users";
          $resulte_all_users = mysqli_query($db, $sql_all_users);
          $users = mysqli_num_rows($resulte_all_users);

          $sql_all_users_active = "SELECT * FROM users WHERE online = 'true'";
          $resulte_all_users_active = mysqli_query($db, $sql_all_users_active);
          $users_active = mysqli_num_rows($resulte_all_users_active);

          $sql_all_mods = "SELECT * FROM users WHERE type='mod'";
          $resulte_all_mods = mysqli_query($db, $sql_all_mods);
          $mods = mysqli_num_rows($resulte_all_mods);

          $sql_all_mods_active = "SELECT * FROM users WHERE type='mod' and online = 'true'";
          $resulte_all_mods_active = mysqli_query($db, $sql_all_mods_active);
          $mods_active = mysqli_num_rows($resulte_all_mods_active);

          ?>

          <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="company_profile_info">
              <div class="company-up-info">
                <img src="admin/users.png" alt="">
                <h3><?php echo $users; ?> Users</h3>
                <h4>Number of all users so far</h4>
                <ul>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6 col-12">
            <div class="company_profile_info">
              <div class="company-up-info">
                <img src="admin/active_users.png" alt="">
                <h3><?php echo $users_active; ?> Active Users</h3>
                <h4>number of currently active users</h4>
                <ul>
                </ul>
              </div>
            </div>
          </div>

          
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
              <div class="company_profile_info">
                <div class="company-up-info">
                <a href="modlist.php?req=all">
                  <img src="admin/mod.png" alt="">
                  </a>
                  <h3><?php echo $mods; ?> Moderators</h3>
                  <h4>number of all moderators</h4>
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          

          
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
              <div class="company_profile_info">
                <div class="company-up-info">
                <a href="modlist.php?req=active">
                  <img src="admin/active_mod.png" alt="">
                  </a>
                  <h3><?php echo $mods_active; ?> Active moderators</h3>
                  <h4>number of currently active moderators</h4>
                  <ul>
                  </ul>
                </div>
              </div>
            </div>
          



        </div>
      </div>



    </div>
  </section>

  <?php
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