<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Creata Group | Ethio Connect</title>

  <?php
  include_once "inc/header.php";
  ?>

  <div style="width: 90%; padding-left: 10%;">
    <div class="tab-pane fade active show" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
      <div class="acc-setting" style="
    min-height: 570px;
    overflow: hidden;
    margin-top:40px;
    margin-bottom:20px;
">
        <h3>Creata Group</h3>

        <form action="" method="POST">

          <div class="cp-field">
            <h5>Group name</h5>
            <div class="cpp-fiel">
              <input type="text" id="name" name="name" placeholder="Group name" required>
              <i class="fa fa-id-badge"></i>
            </div>
          </div>


          <div class="cp-field">
            <h5>Category</h5>
            <div class="cpp-fiel">

              <select name="category" style="width: 100%;height: 40px;border: 1px solid #e5e5e5;padding: 0px 40px;" required>
                <option value="">Select category</option>
                <?php
                    $sql_select_cat = "SELECT category FROM category";
                    $result_select_cat = mysqli_query($db, $sql_select_cat);
                    while ($row = mysqli_fetch_array($result_select_cat)) {
                      $category = $row['category'];
                  
                ?>
                
                <option value="<?php echo $category; ?>"><?php echo str_replace("'","",$category); ?></option>
                <?php
                    }
                    ?>
              </select>
              <i class="fa fa-check-square"></i>

            </div>
          </div>


          <div class="save-stngs pd2">
            <ul>
              <li><button type="submit" name="create">Create</button></li>
            </ul>
          </div>

        </form>

      </div>
    </div>
  </div>






  <?php

  if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];

    if ($category == "School_and_Education") {
      $default_cover = "School_and_Education.png";
      $default_profile = "School_and_Education.png";
    } elseif ($category == "Sports") {
      $default_cover = "Sports.png";
      $default_profile = "Sports.png";
    } elseif ($category == "Food") {
      $default_cover = "food.png";
      $default_profile = "food.png";
    } elseif ($category == "Photography") {
      $default_cover = "Photography.png";
      $default_profile = "Photography.png";
    } elseif ($category == "Buy_and_Sell") {
      $default_cover = "Buy_and_Sell.png";
      $default_profile = "Buy_and_Sell.png";
    } elseif ($category == "Science_and_Tech") {
      $default_cover = "Science_and_Tech.png";
      $default_profile = "Science_and_Tech.png";
    } elseif ($category == "Health_and_Fitness") {
      $default_cover = "Health_and_Fitness.png";
      $default_profile = "Health_and_Fitness.png";
    } elseif ($category == "Funny") {
      $default_cover = "Funny.png";
      $default_profile = "Funny.png";
    } elseif ($category == "Arts_and_Culture") {
      $default_cover = "Arts_and_Culture.png";
      $default_profile = "Arts_and_Culture.png";
    } elseif ($category == "Games") {
      $default_cover = "game.png";
      $default_profile = "game.png";
    } elseif ($category == "Travel_and_Places") {
      $default_cover = "Travel_and_Places.png";
      $default_profile = "Travel_and_Places.png";
    } elseif ($category == "Movies_and_TV") {
      $default_cover = "Movies_and_TV.jpg";
      $default_profile = "Movies_and_TV.jpg";
    } else {
      $default_cover = "default_cover.png";
      $default_profile = "default_profile.png";
    }

    $web_address = (rand(1000000, 9999999));
    $name_c = str_replace(" ","_",$name);
    $web_address = $name_c.$web_address."_".$user_id;

    $today = date("y-m-d");
    $sql_creata_group = "INSERT INTO groups (group_name, category, profile_pic, cover_pic, date, owner_id, web_address) VALUE ('$name','$category','$default_profile','$default_cover','$today','$user_id','$web_address')";
    mysqli_query($db, $sql_creata_group);

    $sql_select_g = "SELECT group_id FROM groups where web_address = '$web_address'";
    $result_select_g = mysqli_query($db, $sql_select_g);
    while ($row = mysqli_fetch_array($result_select_g)) {
      $group_id = $row['group_id'];
  }

    $sql_add_group_member = "INSERT INTO group_members(group_id, user_id) VALUE('$group_id','$user_id')";
    mysqli_query($db, $sql_add_group_member);

    echo '<script type="text/javascript">';
    echo "window.location.href = 'group.php?webaddress=".$web_address."';";
    echo "</script>";
  }


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