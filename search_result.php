<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Search result | Ethio Connect</title>
  <style>
    .topbut {
      background-color: #e44d3a;
      border-color: transparent;
      border-radius: 5px;
      height: 30px;
      width: 70px;
      color: white;
      margin-left: 20%;
      margin-bottom: 10px;

    }
  </style>

  <?php
  include_once "inc/header.php";
  if (isset($_POST['leave'])) {
    $group_id_leave = $_POST['leave'];
    $sql_del_messages = "DELETE FROM group_members WHERE group_id = '$group_id_leave' AND user_id = '$user_id'";
    mysqli_query($db, $sql_del_messages);
    $_SESSION["tarck_u"] = "g";

}

if (isset($_POST['join'])) {
  $group_id_join = $_POST['join'];
  $webid = $_POST['webid'];
  $sql_join_group = "INSERT INTO group_members (group_id, user_id) VALUE ('$group_id_join','$user_id')";
  mysqli_query($db, $sql_join_group);
  echo '<script type="text/javascript">';
  echo "window.location.href = 'group.php?webaddress=".$webid."';";
  echo "</script>";
}

  if (!isset($_GET['key_word']) and !isset($_SESSION["key_word"])) {
    echo '<script type="text/javascript">';
    echo "window.location.href = 'index.php';";
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


  if (isset($_GET['follow'])) {

    $suseridd = $_GET['suseridd'];

    $sql_start_following = "INSERT INTO follower (follower_id, follow_id) VALUE ('$user_id','$suseridd')";
    mysqli_query($db, $sql_start_following);

    $today = date("y-m-d");
    $notification = " Start following you.";

    $sql_notification = "INSERT INTO notifications (date, notification, recipient_id, notifier) VALUE ('$today','$notification',' $suseridd','$user_id')";
    mysqli_query($db, $sql_notification);

    echo '<script type="text/javascript">';
    echo "window.location.href = 'search_result.php?key_word=" . $keywordd . "';";
    echo "</script>";
  }

  if (isset($_GET['unfollow'])) {

    $suseridd = $_GET['suseridd'];
    $sql_start_unfollowing = "DELETE FROM follower WHERE follower_id = '$user_id' and follow_id = '$suseridd' ";
    mysqli_query($db, $sql_start_unfollowing);
    echo '<script type="text/javascript">';
    echo "window.location.href = 'search_result.php?key_word=" . $keywordd . "';";
    echo "</script>";
  }


  ?>



  <section class="companies-info">
    <div class="container">
      <div class="company-title">


        <form action="" method="post">
          <button type="submit" name="users" class="topbut">Users</button>
          <button type="submit" name="groups" class="topbut">Groups</button>
          
        </form>

        <?php
        if(!isset($_SESSION["tarck_u"]))
        {
          $_SESSION["tarck_u"] = "u";
        }
        
        if(isset($_POST['groups']))
        {
          $_SESSION["tarck_u"] = "g";
        }
        if(isset($_POST['users']))
        {
          $_SESSION["tarck_u"] = "u";
        }
       
        if (isset($_POST['posts'])) {
          echo "post";
          
        } elseif (isset($_POST['groups']) or $_SESSION["tarck_u"]=="g") {
          $sql_search_user = "SELECT * FROM groups where group_name LIKE '%$keywordd%' OR category LIKE '%$keywordd%' OR web_address LIKE '%$keywordd%'";
          $result_search_user = mysqli_query($db, $sql_search_user);

          $c_users = mysqli_num_rows($result_search_user);

          if ($c_users == 0) {
        ?>
            <h3>Your search "<?php echo $keywordd; ?>" didn't matche any thing from our database</h3>

          <?php
          } else {
          ?>
            <h3>Groups Search result for "<?php echo $keywordd; ?>"</h3>
      </div>
      <div class="companies-list">
        <div class="row">
          <?php
            while ($row = mysqli_fetch_array($result_search_user)) {
              $group_id_s_r = $row["group_id"];
              $group_name = $row["group_name"];
              $profile_pic_g = $row["profile_pic"];
              $category = $row["category"];
              $web_address = $row["web_address"];


          ?>

            <a href="group.php?webaddress=<?php echo $web_address; ?>">
              <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="company_profile_info">
                  <div class="company-up-info">
                    <img src="group_img\group_pp\<?php echo $profile_pic_g; ?>" alt="">
                    <h3><?php echo $group_name; ?></h3>
                    <h4><?php echo $category; ?></h4>
                    <ul>
                      <?php


                      $ce_member = 0;
                      $sql_chk_member = "SELECT user_id FROM group_members WHERE user_id = '$user_id' and group_id = '$group_id_s_r'";
                      $result_chk_member = mysqli_query($db, $sql_chk_member);
                      $ce_member = mysqli_num_rows($result_chk_member);
                      if ($ce_member == 0) {
                      


                      ?>



                      <form action="" method="POST">
                        <input type="text" style="display: none;" name="webid" value="<?php echo $web_address; ?>">
                      <button type="submit" style="display: none;" name="join" value="<?php echo $group_id_s_r; ?>" id="join<?php echo $group_id_s_r; ?>"></button>
                      </form>

                      <li><a href="#" title="" style="background-color: #3a44ff;" class="flww"><label for="join<?php echo  $group_id_s_r; ?>"><i class="la la-plus"></i> Join</label></a></li>
                      <?php
                      }else {
                        


                      ?>
                      <form action="" method="POST">
                      <button type="submit" style="display: none;" name="leave" value="<?php echo $group_id_s_r; ?>" id="leave<?php echo $group_id_s_r; ?>"></button>
                      </form>

                      <li><a href="#" title="" style="background-color: #d8ae23;" class="flww"><label for="leave<?php echo  $group_id_s_r; ?>"><i class="fa fa-sign-out"></i> Leave</label></a></li>
                      <?php
                      }
                      ?>

                    </ul>
                  </div>
                  <a href="group.php?webaddress=<?php echo $web_address; ?>" title="" class="view-more-pro">View Profile</a>
                </div>
              </div>
            </a>
        <?php

            }
          }
        ?>







        </div>
      </div>
      <?php

        } else {

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
              if ($user_id_s_r != $user_id) {


        ?>

            <a href="user-profile.php?username=<?php echo $username; ?>">
              <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="company_profile_info">
                  <div class="company-up-info">
                    <img src="users_img/users_pp/<?php echo $profile_pic; ?>" alt="">
                    <h3><?php echo $f_name . " " . $l_name; ?></h3>
                    <h4><?php echo $bio; ?></h4>
                    <ul>
                      <?php


                      $following = 0;
                      $sql_following = "SELECT * FROM follower where follower_id = '$user_id' AND follow_id = '$user_id_s_r'";
                      $result_following = mysqli_query($db, $sql_following);
                      $following = mysqli_num_rows($result_following);
                      if ($following == 0) {


                      ?>



                        <form action="" method="GET">
                          <input type="text" name="suseridd" value="<?php echo  $user_id_s_r; ?>" style="display: none;">
                          <button type="submit" name="follow" id="follow<?php echo  $user_id_s_r; ?>" style="display:none"></button>
                        </form>

                        <li><a href="#" title="" class="flww"><label for="follow<?php echo  $user_id_s_r; ?>"><i class="la la-plus"></i> Follow</label></a></li>
                      <?php
                      } else {


                      ?>
                        <form action="" method="GET">
                          <input type="text" name="suseridd" value="<?php echo  $user_id_s_r; ?>" style="display: none;">
                          <button type="submit" name="unfollow" id="unfollow<?php echo  $user_id_s_r; ?>" style="display:none;"></button>
                        </form>

                        <li><a href="#" title="" class="flww"><label for="unfollow<?php echo  $user_id_s_r; ?>"><i class="la la-plus"></i> Unfollow</label></a></li>
                      <?php
                      }
                      ?>

                    </ul>
                  </div>
                  <a href="user-profile.php?username=<?php echo $username; ?>" title="" class="view-more-pro">View Profile</a>
                </div>
              </div>
            </a>
      <?php
              }
            }
          }
      ?>







      </div>
    </div>
  <?php
        }
  ?>


  </div>
  </section>

  <?php
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