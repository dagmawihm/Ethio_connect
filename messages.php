<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>View messages | Ethio Connect</title>

  <?php
  include_once "inc/header.php";
  ?>

  <section class="messages-page">
    <div class="container">
      <div class="messages-sec">
        <div class="row">
          <div class="col-lg-4 col-md-12 no-pdd">
            <div class="msgs-list">
              <div class="msg-title">
                <h3>Messages</h3>
              </div>
              <div class="messages-list">
                <ul>



                  <?php
                  $sender_id = -1;


                  function strcur($data)
                  {
                    if (strlen($data) >= 18) {
                      $data = substr($data, 0, 17) . "...";
                    } else {
                      $data = $data;
                    }


                    return $data;
                  }




                  $sender_id1 = array();
                  $a = 0;


                  $sql_message = "SELECT * FROM messages WHERE receiver_id = '$user_id' OR sender_id = '$user_id'  order by messages_id desc";
                  $result_message = mysqli_query($db, $sql_message);
                  while ($row = mysqli_fetch_array($result_message)) {
                    $messages_id = $row["messages_id"];
                    $sender_id = $row["sender_id"];
                    $receiver_id_start_user = $row["receiver_id"];

                    $message = $row["message"];
                    $date = $row["date"];

                    if (!in_array($sender_id, $sender_id1) || !in_array($receiver_id_start_user, $sender_id1)) {

                      $sql_message_stat = "SELECT * FROM messages WHERE receiver_id = '$user_id' AND states = 'unread' and sender_id = '$sender_id'";
                      $result_message_stat = mysqli_query($db, $sql_message_stat);
                      $message_stat = mysqli_num_rows($result_message_stat);

                      if ($sender_id == $user_id) {

                        $sqluser = "SELECT * FROM users where user_id = '$receiver_id_start_user'";
                        $resultuser = mysqli_query($db, $sqluser);
                        while ($row = mysqli_fetch_array($resultuser)) {
                          $userpp = $row["profile_pic"];
                          $ffname = $row["f_name"];
                          $llname = $row["l_name"];
                          $online = $row["online"];
                        }
                      } else {
                        $sqluser = "SELECT * FROM users where user_id = '$sender_id'";
                        $resultuser = mysqli_query($db, $sqluser);
                        while ($row = mysqli_fetch_array($resultuser)) {
                          $userpp = $row["profile_pic"];
                          $ffname = $row["f_name"];
                          $llname = $row["l_name"];
                          $online = $row["online"];

                        }
                      }


                  ?>

                      <li>
                        <a href="messages_viewer.php?sender=<?php echo $sender_id; ?>&receiver=<?php echo $receiver_id_start_user; ?>">
                          <div class="usr-msg-details">
                            <div class="usr-ms-img">
                              <img src="users_img/users_pp/<?php echo $userpp; ?>" alt="">
                              <?php
                              if ($online == "true") {

                              ?>
                                <span title="Online" class="msg-status"></span>
                              <?php
                              }
                              ?>
                            </div>
                            <div class="usr-mg-info">
                              <h3><?php echo $ffname, " ", $llname; ?></h3>
                              <p><?php echo strcur($message); ?></p>
                            </div>
                            <span class="posted_time"><?php echo $date ?></span>
                            <?php
                            if ($message_stat >= 1) {

                            ?>
                              <span class="msg-notifc"><?php echo $message_stat; ?></span>
                            <?php
                            }
                            ?>
                          </div>
                        </a>
                      </li>

                  <?php
                      $sender_id1[$a] = $sender_id;
                      $a++;
                      $sender_id1[$a] = $receiver_id_start_user;
                      $a++;
                    }
                  }
                  if ($sender_id == -1) {
                    echo '<hr>
                          <li>
                          <div class="usr-msg-details">
                            <div class="usr-ms-img">
                              <img src="users_img/users_pp/asdsad" alt="">
                            </div>
                            <div class="usr-mg-info">
                              <h3>You have no messages!</h3>
                            </div>
                          </div>
                          </li>';
                  }
                  ?>


                </ul>

              </div>
            </div>
          </div>



          <?php


          $sql_get_m = "SELECT * FROM users where user_id = '$sender_id'";
          $result_get_m = mysqli_query($db, $sql_get_m);
          while ($row = mysqli_fetch_array($result_get_m)) {
            $userppp = $row["profile_pic"];
            $ffnamee = $row["f_name"];
            $llnamee = $row["l_name"];
          }

          ?>


          <div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
            <div class="main-conversation-box">

              <div class="message-bar-head">
                <div class="usr-msg-details">
                  <h1 style="font-size:40px; font-weight: 700;">No chat selected</h1>
                </div>
              </div>

              <div class="messages-line">




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
  <script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
  <script type="text/javascript" src="lib/slick/slick.min.js"></script>
  <script type="text/javascript" src="js/scrollbar.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
  </body>

</html>