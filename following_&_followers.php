<?php
session_start();
if (!isset($_GET['request'])) {
  echo '<script type="text/javascript">';
  echo "window.location.href = 'index.php';";
  echo "</script>";
} else {
  $request = $_GET['request'];
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?php echo $request; ?> | Ethio Connect</title>
  <?php
  include_once "inc/header.php";

  if (isset($_POST['follow'])) {

    $suseridd = $_POST['suseridd'];
    $sql_start_following = "INSERT INTO follower (follower_id, follow_id) VALUE ('$user_id','$suseridd')";
    mysqli_query($db, $sql_start_following);


      $today = date("y-m-d");
      $notification = " Start following you.";

      $sql_notification = "INSERT INTO notifications (date, notification, recipient_id, notifier) VALUE ('$today','$notification',' $suseridd','$user_id')";
      mysqli_query($db, $sql_notification);


  }



  if (isset($_POST['unfollow'])) {

    $suseridd = $_POST['suseridd'];
    $sql_start_unfollowing = "DELETE FROM follower WHERE follower_id = '$user_id' and follow_id = '$suseridd' ";
    mysqli_query($db, $sql_start_unfollowing);
  }
  ?>




  <section class="companies-info">
    <div class="container">
      <div class="company-title">

        <?php

        if ($request == "following") {
          if (isset($_GET['user_idd'])) {
            $user_idd = $_GET['user_idd'];
            $sql_request = "SELECT * FROM follower where follower_id = '$user_idd'";
          } else {
            $sql_request = "SELECT * FROM follower where follower_id = '$user_id'";
          }
        } else {
          if (isset($_GET['user_idd'])) {
            $user_idd = $_GET['user_idd'];
            $sql_request = "SELECT * FROM follower where follow_id = '$user_idd'";
          } else {
            $sql_request = "SELECT * FROM follower where follow_id = '$user_id'";
          }
        }


        $result_request = mysqli_query($db, $sql_request);

        $c_request = mysqli_num_rows($result_request);

        if ($c_request == 0) {


        ?>

          <?php
          if ($request == "following") {
            if (isset($_GET['user_idd'])) {
              echo "<h3>This user Don't follow anyone</h3>";
            } else {
              echo "<h3>You Don't follow anyone</h3>";
            }
          } else {
            if (isset($_GET['user_idd'])) {
              echo "<h3>This user don't have any follower</h3>";
            } else {
              echo "<h3>You dont have any follower</h3>";
            }
          }
          ?>


        <?php
        } else {

          if ($request == "following") {
            echo "<h3>" . $request . "</h3>";
          } else {
            echo "<h3>" . $request . "</h3>";
          }

        ?>

      </div>
      <div class="companies-list">
        <div class="row">
          <?php
          while ($row = mysqli_fetch_array($result_request)) {
            $follower_id = $row["follower_id"];
            $follow_id = $row["follow_id"];

            if ($request == "following") {
              $id_to_user = $follow_id;
            } else {
              $id_to_user = $follower_id;
            }


            $sql_select_follow = "SELECT * FROM users where user_id = '$id_to_user'";
            $result_select_follow = mysqli_query($db, $sql_select_follow);
            while ($row = mysqli_fetch_array($result_select_follow)) {
              $profile_pic = $row["profile_pic"];
              $f_name = $row["f_name"];
              $l_name = $row["l_name"];
              $bio = $row["bio"];
              $username = $row["username"];
              $user_id_that_f = $row["user_id"];
            }

          ?>

            <a href="user-profile.php?username=<?php echo $username; ?>">
              <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="company_profile_info">
                  <div class="company-up-info">
                    <img src="users_Img/users_pp/<?php echo $profile_pic; ?>" alt="">
                    <h3><?php echo $f_name . " " . $l_name; ?></h3>
                    <h4><?php echo $bio; ?></h4>
                    <ul>
                      <?php


                      $following = 0;
                      $sql_following = "SELECT * FROM follower where follower_id = '$user_id' AND follow_id = '$id_to_user'";
                      $result_following = mysqli_query($db, $sql_following);
                      $following = mysqli_num_rows($result_following);
                      if ($user_id_that_f != $user_id) {
                        if ($following == 0) {


                      ?>



                          <form action="" method="post">
                            <input type="text" name="suseridd" value="<?php echo  $id_to_user; ?>" style="display: none;">
                            <button type="submit" name="follow" id="follow<?php echo  $id_to_user; ?>" style="display:none"></button>
                          </form>

                          <li><a href="#" title="" class="flww"><label for="follow<?php echo  $id_to_user; ?>"><i class="la la-plus"></i> Follow</label></a></li>
                          <?php
                          if (!isset($_GET['user_idd']) && $_GET['request'] == "followers") {
                          ?>

                            <li><a style="background-color: red;" href="#" title="" class="flww"><label for="remove<?php echo $id_to_user; ?>"><i class="fa fa-times"></i> Remove</label></a></li>

                            <form action="" onsubmit="remove_follower<?php echo $id_to_user; ?>();" method="post">
                              <input type="text" id="suseriddr<?php echo $id_to_user; ?>" value="<?php echo  $id_to_user; ?>" style="display: none;">
                              <input type="text" id="user_id<?php echo $id_to_user; ?>" value="<?php echo  $user_id; ?>" style="display: none;">
                              <input type="text" id="request<?php echo $id_to_user; ?>" value="remove" style="display: none;">
                              <button type="submit" id="remove<?php echo $id_to_user; ?>" style="display:none"></button>
                            </form>
                          <?php
                          }
                          ?>



                        <?php
                        } else {


                        ?>
                          <form action="" method="post">
                            <input type="text" name="suseridd" value="<?php echo  $id_to_user; ?>" style="display: none;">
                            <button type="submit" name="unfollow" id="unfollow<?php echo  $id_to_user; ?>" style="display:none"></button>
                          </form>

                          <li><a href="#" title="" class="flww"><label for="unfollow<?php echo  $id_to_user; ?>">Unfollow</label></a></li>
                          <?php
                          if (!isset($_GET['user_idd']) && $_GET['request'] == "followers") {
                          ?>
                            <li><a style="background-color: red;" href="#" title="" class="flww"><label for="remove<?php echo $id_to_user; ?>"><i class="fa fa-times"></i> Remove</label></a></li>

                            <form action="" onsubmit="remove_follower<?php echo $id_to_user; ?>();" method="post">
                              <input type="text" id="suseriddr<?php echo $id_to_user; ?>" value="<?php echo  $id_to_user; ?>" style="display: none;">
                              <input type="text" id="user_id<?php echo $id_to_user; ?>" value="<?php echo  $user_id; ?>" style="display: none;">
                              <input type="text" id="request<?php echo $id_to_user; ?>" value="remove" style="display: none;">
                              <button type="submit" id="remove<?php echo $id_to_user; ?>" style="display:none"></button>
                            </form>
                          <?php
                          }
                          ?>


                      <?php
                        }
                      } else {
                        echo '<li style="display:none;"><a href="#" title="" class="flww"><label for="unfollow"></label></a></li>';
                      }
                      ?>

                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                      <script type="text/javascript">
                        function remove_follower<?php echo $id_to_user; ?>() {

                          var suseriddr = document.getElementById("suseriddr<?php echo $id_to_user; ?>").value;
                          var user_id = document.getElementById("user_id<?php echo $id_to_user; ?>").value;
                          var request = document.getElementById("request<?php echo $id_to_user; ?>").value;


                          if (suseriddr) {
                            $.ajax({
                              type: 'post',
                              url: 'follow_unfollow_remove_user.php',
                              data: {
                                suseriddr: suseriddr,
                                user_id: user_id,
                                request: request
                              },
                              cache: false,
                              success: function(response) {

                                window.location.reload();





                              }
                            });
                          }

                          return false;
                        }
                      </script>
                    </ul>
                  </div>
                  <a href="user-profile.php?username=<?php echo $username; ?>" title="" class="view-more-pro">View Profile</a>
                </div>
              </div>
            </a>
        <?php

          }
        }
        ?>







        </div>
      </div>

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