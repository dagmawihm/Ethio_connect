<?php
session_start();
if (!isset($_GET['webaddress'])) {
  echo '<script type="text/javascript">';
  echo "window.location.href = 'index.php';";
  echo "</script>";
} else {
  $webaddress = $_GET['webaddress'];
}

$db = mysqli_connect("localhost", "root", "", "ethio_connect");
$sql_search_result = "SELECT * FROM groups where web_address = '$webaddress'";
$result_search_result = mysqli_query($db, $sql_search_result);
while ($row = mysqli_fetch_array($result_search_result)) {
  $group_id = $row['group_id'];
  $group_name = $row['group_name'];
  $category = $row['category'];
  $profile_pic = $row['profile_pic'];
  $cover_pic = $row['cover_pic'];
  $web_address = $row['web_address'];
  $owner_id = $row['owner_id'];
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Add members to <?php echo $webaddress; ?> | Ethio Connect</title>
  <?php
  include_once "inc/header.php";
  ?>

  <section class="companies-info">
    <div class="container">
      <div class="company-title">

        <?php

        $sql_request = "SELECT * FROM follower where follower_id = '$user_id'";
        $result_request = mysqli_query($db, $sql_request);
        $c_request = mysqli_num_rows($result_request);

        if ($c_request == 0) {
        ?>
          <h3>You Don't follow anyone! you can only add users that you follow.</h3>
        <?php
        } else {

          echo "<h3>Add members to " . $webaddress . "</h3>";

        ?>

      </div>
      <div class="companies-list">
        <div class="row">
          <?php
          while ($row = mysqli_fetch_array($result_request)) {

            $follow_id = $row["follow_id"];

            $sql_select_follow = "SELECT * FROM users where user_id = '$follow_id'";
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
                      $ce_member = 0;
                      $sql_chk_member = "SELECT user_id FROM group_members WHERE user_id = '$user_id_that_f' and group_id = '$group_id'";
                      $result_chk_member = mysqli_query($db, $sql_chk_member);
                      $ce_member = mysqli_num_rows($result_chk_member);
                      if ($ce_member == 0) {
                      ?>
                        <form action="" method="post">
                          <input type="text" style="display: none;" name="usernamee" value="<?php echo $username;?>">
                          <button type="submit" style="display: none;" name="add" id="add<?php echo $user_id_that_f; ?>" value="<?php echo $user_id_that_f; ?>"></button>
                        </form>

                        <li><a href="#" title="" style="background-color: #3a44ff;" class="flww"><label for="add<?php echo $user_id_that_f; ?>"><i class="la la-plus"></i> ADD</label></a></li>
                      <?php
                      } else {
                      ?>
                        <li><a href="" title="" style="background-color: #d8ae23;" class="flww"><i class="la la-plus"></i> Member</a></li>


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
        ?>
        <?php
        if (isset($_POST['add'])) {
          $new_memb_id = $_POST['add'];
          $usernamee = $_POST['usernamee'];
          $sql_add_memb = "INSERT INTO group_members (group_id, user_id) VALUE ('$group_id','$new_memb_id')";
          mysqli_query($db, $sql_add_memb);

          $notification = ' Add you into <a href="group.php?webaddress='.$webaddress.'" style="color:blue;">'.$group_name.'</a> group';
          $date_add = date("y-m-d");

          $sql_notification = "INSERT INTO notifications (date, notification, recipient_id, notifier) VALUE ('$date_add','$notification',' $new_memb_id','$user_id')";
          mysqli_query($db, $sql_notification);
          
          
if($user_id!=$owner_id)
{
  $notification = ' Add <a href="user-profile.php?username='.$usernamee.'" style="color:blue;">@'.$usernamee.'</a> in to your group (<a href="group.php?webaddress='.$webaddress.'" style="color:blue;">'.$group_name.'</a>)';

  $sql_notification = "INSERT INTO notifications (date, notification, recipient_id, notifier) VALUE ('$date_add','$notification',' $owner_id','$user_id')";
  mysqli_query($db, $sql_notification);
}

          

          echo '<script type="text/javascript">';
          echo "window.location.href = 'add_members.php?webaddress=" . $webaddress . "';";
          echo "</script>";
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