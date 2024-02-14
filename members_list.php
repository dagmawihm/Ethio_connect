<?php
session_start();
if (!isset($_GET['webaddress'])) {
  echo '<script type="text/javascript">';
  echo "window.location.href = 'groups.php';";
  echo "</script>";
} else {
  $db = mysqli_connect("localhost", "root", "", "ethio_connect");
  $webaddress = $_GET['webaddress'];
  $sql_ser_group = "SELECT * FROM groups WHERE web_address = '$webaddress'";
  $result_ser_group = mysqli_query($db, $sql_ser_group);
  while ($row = mysqli_fetch_array($result_ser_group)) {
    $group_id  = $row["group_id"];
    $group_name  = $row["group_name"];
    $owner_id = $row["owner_id"];
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Members of <?php echo $group_name; ?> | Ethio Connect</title>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
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

  <?php
  include_once "inc/header.php";
  ?>

  <div style="width: 90%; padding-left: 10%;">

    <div class="tab-pane fade active show" id="nav-notification" role="tabpanel" aria-labelledby="nav-notification-tab">
      <div class="acc-setting" style="min-height: 636px;overflow: hidden;">
        <h3>Group members of <?php echo $group_name; ?></h3>
        <div class="notifications-list">
          <?php


          $notis = 0;

          $sql_members = "SELECT user_id FROM group_members WHERE group_id = '$group_id' order by group_member_id desc";
          $result_members = mysqli_query($db, $sql_members);

          $notis = mysqli_num_rows($result_members);

          if ($notis == 0) {
            echo " <div class='notfication-details'>
            <div class='notification-info'>
              <h3>This Group have no Members</h3>
            </div>
          </div>";
          }
          while ($row = mysqli_fetch_array($result_members)) {
            $user_id_list = $row["user_id"];

            $sqluser = "SELECT * FROM users where user_id = '$user_id_list'";
            $resultuser = mysqli_query($db, $sqluser);
            while ($row = mysqli_fetch_array($resultuser)) {
              $userpp = $row["profile_pic"];
              $ffname = $row["f_name"];
              $llname = $row["l_name"];
              $username_post = $row["username"];
              $online = $row["online"];
            }

          ?>

            <div class="notfication-details">
              <div class="noty-user-img">
                <a href="user-profile.php?username=<?php echo $username_post; ?>" title=""><img src="users_img/users_pp/<?php echo $userpp; ?>" alt=""></a>
              </div>
              <div class="notification-info">
                <h3><a href="user-profile.php?username=<?php echo $username_post; ?>" title=""><?php echo $ffname . " " . $llname; ?></a></h3>

                <?php
                if ($user_id_list == $owner_id) {
                  echo '<span>Owner</span><br>';
                }
                if($online=="true")
                {
                  echo "<span>online</span>";
                }
                else
                {
                  echo "<span>Offline</span>";
                }
                ?>
                
                <form action="" method="post">
                  <button type="submit" name="delnot" style="display: none;" id="<?php echo $user_id_list; ?>" value="<?php echo $user_id_list; ?>"></button>
                </form>

              </div>
              <?php
              if ($user_id_list != $owner_id and $owner_id == $user_id) {
              ?>
                <label class="label_del" for="<?php echo $user_id_list; ?>"><i class="fa fa-trash-o fa-2x"></i></label>
              <?php
              }
              ?>
            </div>

          <?php
          }

          if (isset($_POST['delnot'])) {
            $delnot_id = $_POST['delnot'];
            $sql_del_messages = "DELETE FROM group_members WHERE group_id = '$group_id' AND user_id = '$delnot_id'";
            mysqli_query($db, $sql_del_messages);
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