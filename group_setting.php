<?php
session_start();
if (!isset($_GET['webaddress'])) {
  echo '<script type="text/javascript">';
  echo "window.location.href = 'index.php';";
  echo "</script>";
} else {
  $webaddress1 = $_GET['webaddress'];
}
$db = mysqli_connect("localhost", "root", "", "ethio_connect");
$sql_search_result = "SELECT * FROM groups where web_address = '$webaddress1'";
$result_search_result = mysqli_query($db, $sql_search_result);
while ($row = mysqli_fetch_array($result_search_result)) {
  $group_id = $row['group_id'];
  $group_name = $row['group_name'];
  $category = $row['category'];
  $profile_pic = $row['profile_pic'];
  $cover_pic = $row['cover_pic'];
  $web_address1 = $row['web_address'];
  $owner_id = $row['owner_id'];
}





$webaddresserr = "";
if (isset($_POST['save'])) {
  $group_name = $_POST['name'];
  $web_address = $_POST['web_address'];
  $category = $_POST['category'];




  $ce = 0;
  $sqlun = "SELECT web_address FROM groups where web_address = '$web_address' and group_id != '$group_id'";
  $resultun = mysqli_query($db, $sqlun);
  $ce = mysqli_num_rows($resultun);
  if ($ce >= 1) {
    $webaddresserr = $web_address . " is already taken Web address need to be unique.";
    //echo $webaddresserr;
  } else {


    $sql = "update groups set group_name = '$name', category = '$category', web_address = '$web_address' WHERE group_id = $group_id";
    mysqli_query($db, $sql);
    echo "<script>alert('Change saved successfully ✓')</script>";
    echo '<script type="text/javascript">';
    echo "window.location.href = 'group.php?webaddress=" . $web_address . "';";
    echo "</script>";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?php echo $group_name; ?> Setting | Ethio Connect</title>

  <style>
    .topbut {

      margin-bottom: 10px;
      margin-left: 2%;

    }

    .topbut_button {
      background-color: #e44d3a;
      border-color: transparent;
      border-radius: 5px;
      height: 50px;
      width: 150px;
      color: white;
      margin-bottom: 10px;
      margin-left: 2%;

    }
  </style>
  <?php
  include_once "inc/header.php";






  if (isset($_POST["yesornoo"])) {
    $yesorno = $_POST["yesornoo"];
    if ($yesorno == "yes") {
      $sqllike = "DELETE FROM groups WHERE group_id = '$group_id'";
      mysqli_query($db, $sqllike);
      echo '<script type="text/javascript">';
      echo "window.location.href = 'groups.php';";
      echo "</script>";
    }
  }


  ?>



  <div style="width: 90%; padding-left: 10%;">
    <div class="tab-pane fade active show" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
      <div class="acc-setting" style="
    min-height: 570px;
    overflow: hidden;
    margin-top:40px;
    margin-bottom:20px;
">
        <h3>Group Setting</h3>

        <form action="" method="POST">

          <div class="cp-field">
            <h5>Group name</h5>
            <div class="cpp-fiel">
              <input type="text" id="name" name="name" value="<?php echo $group_name; ?>" placeholder="Group name" required>
              <i class="fa fa-id-badge"></i>
            </div>
          </div>


          <div class="cp-field">
            <h5>Web address</h5>
            <div class="cpp-fiel">
              <input type="text" id="web_address" name="web_address" value="<?php echo $web_address1; ?>" placeholder="Web address" required>
              <i class="fa fa-globe"></i>
              <p style="color: red;"><?php echo $webaddresserr; ?></p>
            </div>
          </div>


          <div class="cp-field">
            <h5>Category</h5>
            <div class="cpp-fiel">

              <select name="category" style="width: 100%;height: 40px;border: 1px solid #e5e5e5;padding: 0px 40px;" required>
                <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                <option value="School_and_Education">School and Education</option>
                <option value="Sports">Sports</option>
                <option value="Food">Food</option>
                <option value="Photography">Photography</option>
                <option value="Buy_and_Sell">Buy and Sell</option>
                <option value="Science_and_Tech">Science and Tech</option>
                <option value="Health_and_Fitness">Health and Fitness</option>
                <option value="Funny">Funny</option>
                <option value="Arts_and_Culture">Arts and Culture</option>
                <option value="Games">Games</option>
                <option value="Travel_and_Places">Travel and Places</option>
                <option value="Movies_and_TV">Movies and TV</option>
                <option value="Other">Other</option>
              </select>
              <i class="fa fa-check-square"></i>

            </div>
          </div>


          <div class="save-stngs pd2">
            <ul>
              <li><button type="submit" name="save">Save Change</button></li>
            </ul>
          </div>

        </form>

        <div class="topbut">
          <b><u>
              <h2>Warning this action is irreversible!</h2>
            </u></b>
          <p>once You delete this groupe it won't be accessible by any one</p>
        </div>
        <button type="submit" onclick="myFunctionl()" name="del_g" class="topbut_button"> <i class="fa fa-trash-o"></i> Deleate Group </button>


        <script>
          function myFunctionl() {
            var txt;
            var r = confirm("Are you sure you want to delete this groupe?");

            if (r == true) {
              txt = '<form name="yesorno" id="yesorno" action="" method="POST"><input name="yesornoo" style="display: none;" value="yes"><input style="display: none;" type="submit" value="submit"></form>';
            } else {
              txt = '<form name="yesorno" id="yesorno" action="" method="POST"><input name="yesornoo" style="display: none;" value="no"><input type="submit" style="display: none;" value="submit"></form>';
            }

            document.getElementById("soldout").innerHTML = txt;
            submitforml();

          }
        </script>



        <p id="soldout"></p>
        <script>
          function submitforml() {
            document.yesorno.submit();
          }
        </script>


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