<?php
session_start();
if (!isset($_GET['sender'])) {
  echo '<script type="text/javascript">';
  echo "window.location.href = 'messages.php';";
  echo "</script>";
}

function str_con_cat($data)
{
  $data_len = strlen($data);

  if ($data_len >= 75) {
    return $data;
  } else {
    $con_cat_len = 90 - $data_len;
    for ($a = 0; $a <= $con_cat_len; $a++) {
      $data = $data . "&nbsp;" . " ";
    }

    return $data;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>View messages | Ethio Connect</title>
  <style>
    html {
      scroll-behavior: smooth;
    }

    ::-webkit-file-upload-button {
      display: none;
    }

    .displayblock {
      display: block;
    }

    .displaynone {
      display: none;
    }
  </style>

  <?php
  include_once "inc/header.php";
  ?>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(window).scroll(function() {
        var lastID = $('.load-more').attr('lastID');

        if ($(window).scrollTop() === 0) {
        //window.location.reload();
        }
      });
    });
  </script>



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

                  function strcur($data)
                  {
                    if (strlen($data) >= 18) {
                      $data = substr($data, 0, 17) . "...";
                    } else {
                      $data = $data;
                    }
                    return $data;
                  }

                  $sender_id_get = $_GET['sender'];
                  $receiver_id_get = $_GET['receiver'];

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
                     
                      if ($receiver_id_start_user == $receiver_id_get and $sender_id_get == $sender_id)
                      {
                        echo '<li class="active">';
                      }
                      else
                      {
                        echo '<li>';
                      }
                        
                  ?>

                      

                        <a href="messages_viewer.php?sender=<?php echo $sender_id; ?>&receiver=<?php echo $receiver_id_start_user; ?>">
                          <div class="usr-msg-details">
                            <div class="usr-ms-img">
                              <img src="users_Img/users_pp/<?php echo $userpp; ?>" alt="">
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
                  ?>


                </ul>

              </div>
            </div>
          </div>



          <?php
          if ($sender_id_get == $user_id) {
            $sql_get_m = "SELECT * FROM users where user_id = '$receiver_id_get'";
            $result_get_m = mysqli_query($db, $sql_get_m);
            while ($row = mysqli_fetch_array($result_get_m)) {
              $userppp = $row["profile_pic"];
              $ffnamee = $row["f_name"];
              $llnamee = $row["l_name"];
              $onlinee = $row["online"];
              $usernamerd = $row["username"];
            }
          } else {
            $sql_get_m = "SELECT * FROM users where user_id = '$sender_id_get'";
            $result_get_m = mysqli_query($db, $sql_get_m);
            while ($row = mysqli_fetch_array($result_get_m)) {
              $userppp = $row["profile_pic"];
              $ffnamee = $row["f_name"];
              $llnamee = $row["l_name"];
              $onlinee = $row["online"];
              $usernamerd = $row["username"];
            }
          }
          ?>

          <div class="col-lg-8 col-md-12 pd-right-none pd-left-none">
            <div class="main-conversation-box">

              <div class="message-bar-head">
                <div class="usr-msg-details">
                  <div class="usr-ms-img">
                  <a href="user-profile.php?username=<?php echo $usernamerd; ?>" title="">
                    <img src="users_Img/users_pp/<?php echo $userppp; ?>" alt="">
                  </a>
                  </div>
                  <div class="usr-mg-info">
                  <a href="user-profile.php?username=<?php echo $usernamerd; ?>" title="">
                    <h3><?php echo $ffnamee, " ", $llnamee; ?></h3>
                  </a>
                    <?php
                              if ($onlinee == "true") {
                              echo"<p>Online</p>";
                              }
                              else
                              {
                                echo"<p>Offline</p>";
                              }

                              ?>
                    
                  </div>
                </div>

              </div>


              <div class="messages-line">
                <br><br><br><br><br><br><br><br>

                <?php
                $sql_message = "SELECT * FROM messages WHERE receiver_id = '$receiver_id_get' and sender_id = '$sender_id_get' or receiver_id = '$sender_id_get' and sender_id = '$receiver_id_get'"; //folty logic
                $result_message = mysqli_query($db, $sql_message);
                while ($row = mysqli_fetch_array($result_message)) {
                  $messages_idd = $row["messages_id"];
                  $messagee = $row["message"];
                  $datee = $row["date"];
                  $file1 = $row["file1"];
                  $file2 = $row["file2"];
                  $file3 = $row["file3"];
                  $states = $row["states"];
                  $edit = $row["edit"];

                  $receiver_id_from_mess = $row["receiver_id"];
                  $sender_id_from_mess = $row["sender_id"];

                  if ($sender_id_from_mess == $user_id) {
                    if ($file1 != "") {

                ?>

                      <div class="ed-opts" style="padding-right: 41px;">
                        <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                        <ul class="ed-options">

                          <li style="color: #e44d3a; cursor: pointer;" onclick="del_message<?php echo $messages_idd; ?>();"><i class="fa fa-trash-o"></i> Delete</li>
                        </ul>
                      </div>

                      <div class="main-message-box ta-right">
                        <div class="messg-usr-img">
                          <img src="users_Img/users_pp/<?php echo $pp; ?>" alt="">
                        </div>
                        <div class="message-dt">
                          <div class="message-inner-dt img-bx">
                            <img src="messages/<?php echo $file1; ?>" style="width: 165px;" alt="">
                            <img src="messages/<?php echo $file2; ?>" style="width: 165px;" alt="">
                            <img src="messages/<?php echo $file3; ?>" style="width: 165px;" alt="">

                            <a href="messages/<?php echo $file1; ?>"><?php echo $file1; ?></a><br>
                            <a href="messages/<?php echo $file2; ?>"><?php echo $file2; ?></a><br>
                            <a href="messages/<?php echo $file3; ?>"><?php echo $file3; ?></a><br>
                            <?php
                            if ($messagee != "") {
                              echo "<p>" . str_con_cat($messagee) . "</p>";
                            }
                            ?>
                          </div>
                          <span><?php
                                if ($edit == "true") {
                                  echo "Edited ";
                                }
                                ?><?php echo $datee; ?><br>
                            <?php
                            if ($states == "unread") {
                              echo '<i class="fa fa-check"></i> Delivered';
                            } else {
                              echo '<i class="fa fa-check"></i><i class="fa fa-check"></i> Seen';
                            }
                            ?>
                          </span>
                        </div>
                      </div>
                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                      <script type="text/javascript">
                        function del_message<?php echo $messages_idd; ?>() {

                          var messages_idd = "<?php echo $messages_idd; ?>";

                          if (messages_idd) {
                            $.ajax({
                              type: 'post',
                              url: 'del_message.php',
                              data: {
                                messages_idd
                              },
                              cache: false,
                              success: function(response) {
                                window.location.reload();
                                alert("Messages Deleted");


                              }
                            });
                          }

                          return false;


                        }
                      </script>
                    <?php
                    } else {
                    ?>

                      <div class="ed-opts" style="padding-right: 41px;">
                        <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                        <ul class="ed-options" id="ulul<?php echo $messages_idd; ?>">
                          <li style="color: #e44d3a; cursor: pointer;" onclick="display<?php echo $messages_idd; ?>();"><i class="fa fa-pencil"></i> Edit</li>
                          <li style="color: #e44d3a; cursor: pointer;" onclick="del_message<?php echo $messages_idd; ?>();"><i class="fa fa-trash-o"></i> Delete</li>
                        </ul>
                      </div>

                      <div class="main-message-box ta-right">
                        <div class="message-dt">
                          <div class="message-inner-dt">

                            <p id="pmess<?php echo $messages_idd; ?>" class="displayblock"><?php echo str_con_cat($messagee); ?></p>

                            <form method="post" action="" onsubmit="return edit_message<?php echo $messages_idd; ?>();">
                              <div id="editform<?php echo $messages_idd; ?>" class="displaynone" style="padding-left: 210px;">
                                <input type="text" style="display: none; visibility: none;" id="mess_id<?php echo $messages_idd; ?>" value="<?php echo $messages_idd; ?>">
                                <input type="text" id="message<?php echo $messages_idd; ?>" value="<?php echo $messagee; ?>" placeholder="Type a message here" require>
                                <button type="submit" name="send_sms">Done</button>
                              </div>
                            </form>

                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                            <script type="text/javascript">
                              function edit_message<?php echo $messages_idd; ?>() {

                                var mess_id_edit = document.getElementById("mess_id<?php echo $messages_idd; ?>").value;
                                var message_text_edit = document.getElementById("message<?php echo $messages_idd; ?>").value;

                                if (mess_id_edit) {
                                  $.ajax({
                                    type: 'post',
                                    url: 'edit_messages.php',
                                    data: {
                                      mess_id_edit: mess_id_edit,
                                      message_text_edit: message_text_edit
                                    },
                                    cache: false,
                                    success: function(response) {
                                      window.location.reload();
                                      alert("Messages Edit");




                                    }
                                  });
                                }

                                return false;
                              }
                            </script>



                          </div>
                          <span><?php
                                if ($edit == "true") {
                                  echo "Edited ";
                                }
                                ?><?php echo $datee; ?><br>
                            <?php
                            if ($states == "unread") {
                              echo '<i class="fa fa-check"></i> Delivered';
                            } else {
                              echo '<i class="fa fa-check"></i><i class="fa fa-check"></i> Seen';
                            }
                            ?>
                          </span>

                        </div>
                        <div class="messg-usr-img">
                          <img src="users_Img/users_pp/<?php echo $pp; ?>" alt="">
                        </div>
                      </div>

                      <script type="text/javascript">
                        function display<?php echo $messages_idd; ?>() {

                          document.getElementById("pmess<?php echo $messages_idd; ?>").className = "displaynone";
                          document.getElementById("editform<?php echo $messages_idd; ?>").className = "mf-field";
                          document.getElementById("ulul<?php echo $messages_idd; ?>").className = "ed-options";

                        }
                      </script>


                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                      <script type="text/javascript">
                        function del_message<?php echo $messages_idd; ?>() {

                          var messages_idd = "<?php echo $messages_idd; ?>";

                          if (messages_idd) {
                            $.ajax({
                              type: 'post',
                              url: 'del_message.php',
                              data: {
                                messages_idd
                              },
                              cache: false,
                              success: function(response) {
                                window.location.reload();
                                alert("Messages Deleted");


                              }
                            });
                          }

                          return false;


                        }
                      </script>


                    <?php

                    }
                  } else {
                    if ($file1 != "") {
                    ?>

                      <div class="main-message-box st3">
                        <div class="messg-usr-img">
                          <img src=users_Img/users_pp/<?php echo $userppp; ?>" alt="">
                        </div>
                        <div class="message-dt st3">
                          <div class="message-inner-dt img-bx">
                            <img src="messages/<?php echo $file1; ?>" style="width: 165px;" alt="">
                            <img src="messages/<?php echo $file2; ?>" style="width: 165px;" alt="">
                            <img src="messages/<?php echo $file3; ?>" style="width: 165px;" alt="">
                            <?php
                            if ($messagee != "") {
                              echo "<p>" . $messagee . "</p>";
                            }
                            ?>
                          </div>
                          <span><?php
                                if ($edit == "true") {
                                  echo "Edited ";
                                }
                                ?><?php echo $datee; ?>
                          </span>
                        </div>
                      </div>
                    <?php
                    $sql_m_read = "UPDATE messages SET	states = 'read' WHERE messages_id = '$messages_idd'";
                    mysqli_query($db, $sql_m_read);
                    } else {
                    ?>
                      <div class="main-message-box st3">
                        <div class="message-dt st3">
                          <div class="message-inner-dt">

                            <p><?php echo $messagee; ?></p>

                          </div>
                          <span><?php
                                if ($edit == "true") {
                                  echo "Edited ";
                                }
                                ?> <?php echo $datee; ?>


                          </span>
                        </div>
                        <div class="messg-usr-img">
                          <img src="users_Img/users_pp/<?php echo $userppp; ?>" alt="">
                        </div>
                      </div>





                <?php
                      $sql_m_read = "UPDATE messages SET	states = 'read' WHERE messages_id = '$messages_idd'";
                      mysqli_query($db, $sql_m_read);
                    }
                  }
                }
                ?>


                <?php

                $randint = (rand(100000, 999999));
                if (isset($_POST['send_sms'])) {

                  if ($_POST['message'] != "" || $_FILES["upload_file"]["name"][0] != "") {
                    $image1 = "";
                    $image2 = "";
                    $image3 = "";

                    if ($_FILES["upload_file"]["name"][0] != "") {

                      for ($i = 0; $i < count($_FILES["upload_file"]["name"]); $i++) {
                        $uploadfile = $_FILES["upload_file"]["name"][$i];
                        $folder = "messages/";
                        move_uploaded_file($_FILES["upload_file"]["tmp_name"][$i], "$folder" . $user_id . "_" . $username . "_" . $randint . "_" . basename($_FILES["upload_file"]["name"][$i]));
                      }

                      if (!empty($_FILES['upload_file']['name'][0])) {
                        $image1 = $user_id . "_" . $username . "_" . $randint . "_" . $_FILES['upload_file']["name"][0];
                      }

                      if (!empty($_FILES['upload_file']['name'][1])) {
                        $image2 = $user_id . "_" . $username . "_" . $randint . "_" . $_FILES['upload_file']["name"][1];
                      }
                      if (!empty($_FILES['upload_file']['name'][2])) {
                        $image3 = $user_id . "_" . $username . "_" . $randint . "_" . $_FILES['upload_file']["name"][2];
                      }
                    }



                    $sms = $_POST['message'];

                    $date_today = date("y-m-d");

                    if ($receiver_id_get == $user_id) {
                      $sql_send_sms = "INSERT INTO messages (sender_id, receiver_id, message, file1, file2, date, file3) VALUE ('$user_id','$sender_id_get','$sms','$image1','$image2','$date_today','$image3')";
                    } else {
                      $sql_send_sms = "INSERT INTO messages (sender_id, receiver_id, message, file1, file2, date, file3) VALUE ('$user_id','$receiver_id_get','$sms','$image1','$image2','$date_today','$image3')";
                    }

                    mysqli_query($db, $sql_send_sms);


                    $notification = " Send you a message.";

                    $sql_notification = "INSERT INTO notifications (date, notification, recipient_id, notifier) VALUE ('$date_today','$notification',' $receiver_id_get','$user_id')";
                    mysqli_query($db, $sql_notification);

                ?>

                    <script type="text/javascript">
                      window.location.href = 'messages_viewer.php?sender=<?php echo $sender_id_get; ?>&receiver=<?php echo $receiver_id_get; ?>';
                    </script>
                <?php
                  }
                }
                ?>


              </div>

              <div class="message-send-area">

                <form method="post" enctype="multipart/form-data">
                  <div class="mf-field">
                    <input type="text" name="message" placeholder="Type a message here" require><label for="upload_file">
                      <i style="font-size: 30px; padding:5px 10px; color: gray;" class="fas fa-paperclip"></i>
                    </label>
                    <input type="file" id="upload_file" name="upload_file[]" style="width:75px;" multiple />
                  

                    
                    <button type="submit" name="send_sms">Send</button>
                  </div>
                  
                   
                    

                  
                </form>

                <script>
                  $(function() {
                    $("button[type = 'submit']").click(function() {
                      var $fileUpload = $("input[type='file']");
                      if (parseInt($fileUpload.get(0).files.length) > 3) {
                        alert("You are only allowed to upload a maximum of 3 files");
                        return false;
                      }
                    });
                  });
                </script>

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