<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Notifications | Ethio Connect</title>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <style>
    .delall {
      float: right;
      padding-right: 10%;
      padding-top: 4px;
      font-weight: 600;
    }

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

  <?php
  include_once "inc/header.php";
  ?>

  <div style="width: 90%; padding-left: 10%;">

    <div class="tab-pane fade active show" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
      <div class="acc-setting" style="
    min-height: 636px;
    overflow: hidden;
">
        <h3>Notifications</h3>
        <div class="notifications-list">
          <?php


          $notis = 0;

          $sql_notifications = "SELECT * FROM notifications WHERE recipient_id = '$user_id' order by notification_id desc";
          $result_notifications = mysqli_query($db, $sql_notifications);

          $notis = mysqli_num_rows($result_notifications);
          if ($notis >= 1) {


          ?>
            <div class="nt-title">

              <form action="" method="post">
                <button type="submit" name="delall" style="display: none;" id="del_all"></button>
              </form>

              <label class="delall" for="del_all">CLEAR ALL</label>



            </div>

            <?php

            if (isset($_POST['delall'])) {

              $sql_del_notif = "DELETE FROM notifications WHERE recipient_id = '$user_id'";
              mysqli_query($db, $sql_del_notif);
              echo '<script type="text/javascript">';
              echo "window.location.reload();";
              echo "</script>";
            }
          } else {
            echo " <div class='notfication-details'>
            <div class='notification-info'>
              <h3>You don't have any notification.</h3>
            </div>
          </div>";
          }
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
                <a href="user-profile.php?username=<?php echo $username_post; ?>" title=""><img src="users_img/users_pp/<?php echo $userpp; ?>" alt=""></a>
              </div>
              <div class="notification-info">
                <h3><a href="user-profile.php?username=<?php echo $username_post; ?>" title=""><?php echo $ffname . " " . $llname; ?></a> <?php echo $notification1; ?></h3>
                <span><?php echo $date; ?></span>
                <form action="" method="post">
                  <button type="submit" name="delnot" style="display: none;" id="<?php echo $notification_id; ?>" value="<?php echo $notification_id; ?>"></button>
                </form>

              </div>
              <label class="label_del" for="<?php echo $notification_id; ?>"><i class="fa fa-trash-o fa-2x"></i></label>
            </div>

          <?php
          }

          if (isset($_POST['delnot'])) {
            $delnot_id = $_POST['delnot'];
            $sql_del_notif = "DELETE FROM notifications WHERE notification_id = '$delnot_id'";
            mysqli_query($db, $sql_del_notif);
            echo '<script type="text/javascript">';
            echo "window.location.reload();";
            echo "</script>";
          }
          ?>












        </div>
      </div>
    </div>
  </div>

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