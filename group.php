<?php
session_start();
if (!isset($_GET['webaddress'])) {
    echo '<script type="text/javascript">';
    echo "window.location.href = 'index.php';";
    echo "</script>";
} else {
    $webaddress1 = $_GET['webaddress'];
}
//$db=mysqli_connect("fdb30.runhosting.com","3533578_wpress9d9b3b88","TW5W3q6uBQa_KmvqkybfMyfiP5LKhdZr","3533578_wpress9d9b3b88");
$db = mysqli_connect("localhost", "root", "", "ethio_connect");
$sql_search_result = "SELECT * FROM groups where web_address = '$webaddress1'";
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
    <title><?php echo $group_name; ?> | Ethio Connect</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script>
        function preview_image() {

            var total_file = document.getElementById("upload_file").files.length;
            document.getElementById("img1").innerHTML = "";
            document.getElementById("image_preview").innerHTML = "";
            if (total_file != 1) {
                document.getElementById("carouselExampleControls").className = "carousel slide";
                document.getElementById("image_preview").innerHTML = "";
                $('#image_preview').append("<div class='carousel-item active' id='carousel-item'><img class='d-block w-100' src='" + URL.createObjectURL(event.target.files[0]) + "'></div>");
                for (var i = 1; i < total_file; i++) {
                    $('#image_preview').append("<div class='carousel-item' id='carousel-item'><img class='d-block w-100' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
                }
            } else {
                document.getElementById("carouselExampleControls").className = "carouselslide";
                $('#img1').append("<img class='d-block w-100' src='" + URL.createObjectURL(event.target.files[0]) + "'>");
            }

        }
    </script>

    <script>
        function lala() {

            var file = document.getElementById("file");
            if (file != "") {
                document.getElementById("submit").click();
                document.getElementById("file").value = "";
            }

        }
    </script>
    <script>
        function lala2() {

            var file = document.getElementById("file");
            if (file != "") {
                document.getElementById("submit2").click();
                document.getElementById("file").value = "";
            }

        }
    </script>
    <?php
    include_once "inc/header.php";



    if (isset($_POST['join'])) {
        $group_id_join = $_POST['join'];
        $sql_join_group = "INSERT INTO group_members (group_id, user_id) VALUE ('$group_id_join','$user_id')";
        mysqli_query($db, $sql_join_group);
    }
    if (isset($_POST['leave'])) {
        $group_id_leave = $_POST['leave'];
        $sql_del_messages = "DELETE FROM group_members WHERE group_id = '$group_id_leave' AND user_id = '$user_id'";
        mysqli_query($db, $sql_del_messages);
        echo '<script type="text/javascript">';
        echo "window.location.href = 'groups.php';";
        echo "</script>";
    }


    if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
        $targetDir = "group_img/group_cover/";
        $unic_img_name = $today = date("y-m-d") . "_" . (rand(1000000, 9999999)) . "_";

        $fileName = $unic_img_name . basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $sql_update_co_pic = "UPDATE groups SET cover_pic = '$fileName' WHERE group_id = '$group_id'";
            mysqli_query($db, $sql_update_co_pic);
            echo '<script type="text/javascript">';
            echo "window.location.href = 'group.php?webaddress=" . $web_address . "';";
            echo "</script>";
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }


    if (isset($_POST["submit2"]) && !empty($_FILES["file2"]["name"])) {
        $targetDir = "group_img/group_pp/";
        $unic_img_name = $today = date("y-m-d") . "_" . (rand(1000000, 9999999)) . "_";

        $fileName = $unic_img_name . basename($_FILES["file2"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (move_uploaded_file($_FILES["file2"]["tmp_name"], $targetFilePath)) {
            $sql_update_co_pic = "UPDATE groups SET profile_pic = '$fileName' WHERE group_id = '$group_id'";
            mysqli_query($db, $sql_update_co_pic);
            echo '<script type="text/javascript">';
            echo "window.location.href = 'group.php?webaddress=" . $web_address . "';";
            echo "</script>";
        } else {
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }



    $randint = (rand(100000, 999999));
    if (isset($_POST['test1'])) {



        for ($i = 0; $i < count($_FILES["upload_file"]["name"]); $i++) {
            $uploadfile = $_FILES["upload_file"]["name"][$i];
            $folder = "group_post_img/";
            move_uploaded_file($_FILES["upload_file"]["tmp_name"][$i], "$folder" . $user_id . "_" . $username . "_" . $randint . "_" . basename($_FILES["upload_file"]["name"][$i]));
        }

        $test = "";
        if (!empty($_POST["test"])) {
            $test = $_POST["test"];
        }

        $image1 = "";
        $image2 = "";
        $image3 = "";



        if (!empty($_FILES['upload_file']['name'][0])) {
            $image1 = $user_id . "_" . $username . "_" . $randint . "_" . $_FILES['upload_file']["name"][0];
        }

        if (!empty($_FILES['upload_file']['name'][1])) {
            $image2 = $user_id . "_" . $username . "_" . $randint . "_" . $_FILES['upload_file']["name"][1];
        }
        if (!empty($_FILES['upload_file']['name'][2])) {
            $image3 = $user_id . "_" . $username . "_" . $randint . "_" . $_FILES['upload_file']["name"][2];
        }


        $today = date("y-m-d");
        $sqlpost = "INSERT INTO group_posts (group_id, user_id, post_date, text, image1, image2, image3) VALUE ('$group_id','$user_id','$today','$test','$image1','$image2','$image3')";
        mysqli_query($db, $sqlpost);
        echo "<script>alert('your post is published ✓')</script>";
        echo '<script type="text/javascript">';
        echo "window.location.href = 'group.php?webaddress=" . $web_address . "';";
        echo "</script>";
    }

    ?>

    <section class="cover-sec">
        <img src="group_img/group_cover/<?php echo $cover_pic; ?>" alt="">
        <div class="add-pic-box">
            <div class="container">
                <div class="row no-gutters">

                    <?php
                    if ($owner_id == $user_id) {
                    ?>

                        <div class="col-lg-12 col-sm-12">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file" id="file" name="file" accept="image/jpg, image/jpeg, image/png, image/webp" onchange="lala();">
                                <label for="file">Change Image</label>
                                <input type="submit" id="submit" name="submit" value="Upload" style="display: none;">
                            </form>
                        </div>
                    <?php
                    }
                    ?>


                </div>
            </div>
        </div>
    </section>
    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="main-left-sidebar">
                                <div class="user_profile">
                                    <div class="user-pro-img">

                                        <img src="group_img\group_pp\<?php echo $profile_pic; ?>" style="width: 200px;">
                                        <?php
                                        if ($owner_id == $user_id) {
                                        ?>
                                            <div class="add-dp" id="OpenImgUpload">
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <input type="file" id="file2" name="file2" accept="image/jpg, image/jpeg, image/png, image/webp" onchange="lala2();">
                                                    <label for="file2"><i class="fas fa-camera"></i></label>
                                                    <input type="submit" id="submit2" name="submit2" value="Upload" style="display: none;">
                                                </form>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="user_pro_status">

                                        <ul class="flw-status">
                                            <li>
                                                <a href="members_list.php?webaddress=<?php echo $web_address; ?>"><span>Members</span>
                                                    <?php
                                                    $sql_members = "SELECT group_id FROM group_members where group_id = '$group_id'";
                                                    $result_members = mysqli_query($db, $sql_members);
                                                    $members = mysqli_num_rows($result_members);

                                                    ?>
                                                    <b><?php echo $members; ?></b></a>
                                            </li>

                                        </ul>
                                        <br><br><br><br>
                                        <ul class="flw-hr">

                                            <?php


                                            $ce_member = 0;
                                            $sql_chk_member = "SELECT user_id FROM group_members WHERE user_id = '$user_id' and group_id = '$group_id'";
                                            $result_chk_member = mysqli_query($db, $sql_chk_member);
                                            $ce_member = mysqli_num_rows($result_chk_member);
                                            if ($ce_member == 0) {



                                            ?>

                                                <form action="" method="POST">
                                                    <button type="submit" style="display: none;" name="join" value="<?php echo $group_id; ?>" id="join"></button>
                                                </form>
                                                <li><a href="" title="" style="background-color: #3a44ff;" class="flww"><label for="join"><i class="la la-plus"></i> Join</label></a></li>
                                            <?php
                                            } else {
                                            ?>
                                                <form action="" method="POST">
                                                    <button type="submit" style="display: none;" name="leave" value="<?php echo $group_id; ?>" id="leave"></button>
                                                </form>

                                                <li><a href="#" title="" style="background-color: #d8ae23;" class="flww"><label for="leave"><i class="fa fa-sign-out"></i> Leave</label></a></li>
                                                <li><a href="add_members.php?webaddress=<?php echo $web_address; ?>" title="" class="flww"><label for="unfollow"> Add Members</label></a></li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>


                                <div class="suggestions full-width">
                                    <div class="sd-title">
                                        <h3>People Viewed Profile</h3>
                                        <i class="la la-ellipsis-v"></i>
                                    </div>
                                    <div class="suggestions-list">
                                        <div class="suggestion-usd">
                                            <img src="images/resources/s1.png" alt="">
                                            <div class="sgt-text">
                                                <h4>Jessica William</h4>
                                                <span>Graphic Designer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="images/resources/s2.png" alt="">
                                            <div class="sgt-text">
                                                <h4>John Doe</h4>
                                                <span>PHP Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="images/resources/s3.png" alt="">
                                            <div class="sgt-text">
                                                <h4>Poonam</h4>
                                                <span>Wordpress Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="images/resources/s4.png" alt="">
                                            <div class="sgt-text">
                                                <h4>Bill Gates</h4>
                                                <span>C & C++ Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="images/resources/s5.png" alt="">
                                            <div class="sgt-text">
                                                <h4>Jessica William</h4>
                                                <span>Graphic Designer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="images/resources/s6.png" alt="">
                                            <div class="sgt-text">
                                                <h4>John Doe</h4>
                                                <span>PHP Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="view-more">
                                            <a href="#" title="">View More</a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="main-ws-sec">


                                <div class="user-tab-sec rewivew">
                                    <h3><?php echo $group_name; ?></h3>
                                    <div class="star-descp">
                                        <span><?php echo str_replace("_", " ", $category); ?></span>
                                    </div>
                                </div>
                                <br><br><br><br>



                                <?php
                                if ($ce_member != 0) {
                                ?>

                                    <div class="post-topbar">


                                        <div class="user-picy">
                                            <img src="users_img/users_pp/<?php echo $pp; ?>" alt="">
                                        </div>
                                        <div class="post-st">


                                            <div id="wrapper">
                                                <form name="posttni" id="posttni" method="post" enctype="multipart/form-data">
                                                    <textarea id="w3review" name="test" rows="4" cols="50" style="width: 100%;" placeholder="Wright your post here and include hashtags that describe your post"></textarea>
                                                    <br>
                                                    <div id="carouselExampleControls" class="carouselslide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <div class="crop">
                                                                <div id="image_preview">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                            <i class="fa fa-chevron-circle-left fa-3x"></i>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                            <i class="fa fa-chevron-circle-right fa-3x"></i>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                    <div id="img1">
                                                    </div>
                                                    <br>
                                                    <label for="upload_file">
                                                        <i class="fa fa-picture-o fa-2x" style="font-size: 25px;"> Add Photo</i>
                                                    </label>
                                                    <input type="file" id="upload_file" name="upload_file[]" onchange="preview_image();" style="display: none; visibility: none;" accept="image/jpg, image/jpeg, image/png, image/webp" multiple />
                                                    <br>

                                                    <center><input type="button" id="sub" name="test1" class="postapost1" value=" POST " onclick="submit_form();" /></center>
                                                </form>


                                                <script type="text/javascript">
                                                    function submit_form() {
                                                        var x = document.getElementById("sub");
                                                        var $fileUpload = $("input[type='file']");

                                                        var empt = document.forms["posttni"]["test"].value;
                                                        if (empt != "" || parseInt($fileUpload.get(0).files.length) != 0) {



                                                            if (parseInt($fileUpload.get(0).files.length) > 3) {
                                                                alert("You are only allowed to upload a maximum of 3 files");
                                                                document.getElementById("upload_file").click();
                                                                returnToPreviousPage();

                                                            } else {
                                                                x.type = "submit";
                                                                document.posttni.submit();
                                                            }
                                                        } else {
                                                            alert("Please input a Value");
                                                            returnToPreviousPage();
                                                        }
                                                    }
                                                </script>
                                            </div>

                                        </div>

                                    </div>

                                <?php
                                }
                                ?>



                                <div class="product-feed-tab current" id="feed-dd">

                                    <div class="posts-section">
                                        <?php
                                        $sqlposts = "SELECT * FROM group_posts WHERE group_id = '$group_id' order by post_id desc";
                                        $resultposts = mysqli_query($db, $sqlposts);
                                        while ($row = mysqli_fetch_array($resultposts)) {
                                            $post_id = $row["post_id"];
                                            $user_idd = $row["user_id"];
                                            $text = $row["text"];
                                            $img1 = $row["image1"];
                                            $img2 = $row["image2"];
                                            $img3 = $row["image3"];
                                            $post_date = $row["post_date"];



                                            $sqluser = "SELECT * FROM users where user_id = '$user_idd'";
                                            $resultuser = mysqli_query($db, $sqluser);
                                            while ($row = mysqli_fetch_array($resultuser)) {
                                                $userpp = $row["profile_pic"];
                                                $ffname = $row["f_name"];
                                                $llname = $row["l_name"];
                                                $userbio = $row["bio"];
                                                $user_iddd = $row["user_id"];
                                            }

                                            $likes = 0;
                                            $sqllikes = "SELECT * FROM group_post_like where post_id = '$post_id'";
                                            $resultlikes = mysqli_query($db, $sqllikes);
                                            $likes = mysqli_num_rows($resultlikes);

                                            $sqldislikes = "SELECT * FROM group_post_like where post_id = '$post_id' and user_id = '$user_id'";
                                            $resultdislikes = mysqli_query($db, $sqldislikes);
                                            $dislikes = mysqli_num_rows($resultdislikes);

                                            if ($dislikes == 0) {
                                                $likeordislike  = 'like';
                                            } else {
                                                $likeordislike  = 'dislike';
                                            }



                                        ?>
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <img src="users_img/users_pp/<?php echo $userpp; ?>" alt="" style="width: 10%;">
                                                        <div class="usy-name">
                                                            <h3><?php echo $ffname, " ", $llname; ?></h3>
                                                            <span><img src="images/clock.png" alt=""><?php echo $post_date; ?></span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if ($user_iddd == $user_id or $owner_id == $user_id) {



                                                    ?>

                                                        <div class="ed-opts">
                                                            <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                            <ul class="ed-options">
                                                                <li>
                                                                    <form method="POST" action="" onsubmit="return del_post<?php echo $post_id; ?>();">
                                                                        <input type="text" style="display: none; visibility: none;" id="post_id<?php echo $post_id; ?>" value="<?php echo $post_id; ?>">
                                                                        <button type="submit" style="border:none; background-color: transparent; font-size:15px; color: #e44d3a;"><i class="fa fa-trash-o"></i> Delete post</button>
                                                                    </form>

                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                                        <script type="text/javascript">
                                                            function del_post<?php echo $post_id; ?>() {

                                                                var post_id_del = document.getElementById("post_id<?php echo $post_id; ?>").value;


                                                                if (post_id_del) {
                                                                    $.ajax({
                                                                        type: 'post',
                                                                        url: 'del_post_g.php',

                                                                        data: {

                                                                            post_id_del: post_id_del
                                                                        },
                                                                        cache: false,
                                                                        success: function(response) {
                                                                            window.location.reload();
                                                                            alert("Post is Deleted");


                                                                        }
                                                                    });
                                                                }

                                                                return false;
                                                            }
                                                        </script>



                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                                <div class="epi-sec">
                                                    <ul class="descp">
                                                        <li><img src="images/icon8.png" alt=""><span><?php echo $userbio; ?></span></li>
                                                    </ul>

                                                </div>
                                                <div class="job_descp">
                                                    <p><?php echo $text; ?><br>


                                                    </p>






                                                    <?php
                                                    if ($img1 != "" and $img2 == "") {
                                                        echo '<img  src="group_post_img/' . $img1 . '">';
                                                    } else {

                                                        if ($img1 != "") {
                                                    ?>

                                                            <div id="carouselExampleIndicators<?php echo $post_id; ?>" class="carousel slide" data-ride="carousel" data-interval="false">
                                                                <ol class="carousel-indicators">
                                                                    <li data-target="#carouselExampleIndicators<?php echo $post_id; ?>" data-slide-to="0" class="active"></li>
                                                                    <li data-target="#carouselExampleIndicators<?php echo $post_id; ?>" data-slide-to="1"></li>
                                                                    <?php
                                                                    if ($img3 != "") {
                                                                    ?>
                                                                        <li data-target="#carouselExampleIndicators<?php echo $post_id; ?>" data-slide-to="2"></li>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </ol>
                                                                <div class="carousel-inner">
                                                                    <div class="carousel-item active">
                                                                        <img class="d-block w-100" style="" src="group_post_img/<?php echo $img1; ?>" alt="First slide">
                                                                    </div>

                                                                    <?php
                                                                    if ($img2 != "") {
                                                                    ?>
                                                                        <div class="carousel-item">
                                                                            <img class="d-block w-100" style="" src="group_post_img/<?php echo $img2; ?>" alt="Second slide">
                                                                        </div>
                                                                    <?php

                                                                    }
                                                                    if ($img3 != "") {
                                                                    ?>

                                                                        <div class="carousel-item">
                                                                            <img class="d-block w-100" style="" src="group_post_img/<?php echo $img3; ?>" alt="Third slide">
                                                                        </div>
                                                                    <?php

                                                                    }
                                                                    ?>

                                                                </div>
                                                                <a class="carousel-control-prev" href="#carouselExampleIndicators<?php echo $post_id; ?>" role="button" data-slide="prev">
                                                                    <i class="fa fa-chevron-circle-left fa-3x"></i>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carouselExampleIndicators<?php echo $post_id; ?>" role="button" data-slide="next">
                                                                    <i class="fa fa-chevron-circle-right fa-3x"></i>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>

                                                    <?php

                                                        }
                                                    }


                                                    ?>


                                                    <br>
                                                    <ul class="skill-tags">
                                                        <br>
                                                        <?php
                                                        $mystring = $text;

                                                        $pos = strpos($mystring, '#');
                                                        $cars = array();
                                                        $cars[0] = $pos + 1;
                                                        $a = 1;
                                                        while ($pos == true) {
                                                            $pos = strpos($mystring, '#', $pos + 1);
                                                            $pos1 = $pos + 1;
                                                            $cars[$a] = $pos1;
                                                            $a = $a + 1;
                                                        }

                                                        array_pop($cars);
                                                        $cars[$a - 1] = strlen($mystring) + 1;

                                                        $b = 0;
                                                        while ($b <= $a - 2) {
                                                            $data = substr($mystring, $cars[$b] - 1, $cars[$b + 1] - $cars[$b]);

                                                            echo '<li><a href="#" title="">' . $data . '</a></li>';
                                                            $b++;
                                                        }

                                                        ?>


                                                    </ul>
                                                </div>
                                                <div class="job-status-bar">
                                                    <ul class="like-com">
                                                        <li>





                                                            <?php
                                                            if ($likeordislike == "like") {
                                                            ?>

                                                                <form method="POST" action="" onsubmit="return dislikeorlike<?php echo $post_id; ?>();">
                                                                    <input type="text" style="display: none; visibility: none;" id="post_id<?php echo $post_id; ?>" value="<?php echo $post_id; ?>">
                                                                    <input type="text" style="display: none; visibility: none;" id="group_id<?php echo $group_id; ?>" value="<?php echo $group_id; ?>">
                                                                    <input type="text" style="display: none; visibility: none;" id="user_id<?php echo $post_id; ?>" value="<?php echo $user_id; ?>">
                                                                    <input type="text" style="display: none; visibility: none;" id="disorlike<?php echo $post_id; ?>" value="like">
                                                                    <button type="submit" style="border: none; color: #b2b2b2; background-color: transparent;"><a><i class="fas fa-heart"></i> Like</a><span><?php echo $likes ?></span></button>
                                                                </form>

                                                            <?php
                                                            }
                                                            if ($likeordislike == "dislike") {
                                                            ?>





                                                                <form method="POST" action="" onsubmit="return dislikeorlike<?php echo $post_id; ?>();">
                                                                    <input type="text" style="display: none; visibility: none;" id="post_id<?php echo $post_id; ?>" value="<?php echo $post_id; ?>">
                                                                    <input type="text" style="display: none; visibility: none;" id="group_id<?php echo $group_id; ?>" value="<?php echo $group_id; ?>">
                                                                    <input type="text" style="display: none; visibility: none;" id="user_id<?php echo $post_id; ?>" value="<?php echo $user_id; ?>">
                                                                    <input type="text" style="display: none; visibility: none;" id="disorlike<?php echo $post_id; ?>" value="dislike">
                                                                    <button type="submit" style="border: none; color: #b2b2b2; background-color: transparent;"><a><i class="fas fa-heart"></i> Dislike</a><span><?php echo $likes ?></span></button>
                                                                </form>

                                                            <?php
                                                            }
                                                            ?>



                                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                                            <script type="text/javascript">
                                                                function dislikeorlike<?php echo $post_id; ?>() {

                                                                    var post_id = document.getElementById("post_id<?php echo $post_id; ?>").value;
                                                                    var group_id = document.getElementById("group_id<?php echo $group_id; ?>").value;
                                                                    var user_id = document.getElementById("user_id<?php echo $post_id; ?>").value;
                                                                    var disorlike = document.getElementById("disorlike<?php echo $post_id; ?>").value;


                                                                    if (post_id && user_id && disorlike) {
                                                                        $.ajax({
                                                                            type: 'post',
                                                                            url: 'like_dislike_g.php',
                                                                            data: {

                                                                                post_id: post_id,
                                                                                user_id: user_id,
                                                                                disorlike: disorlike,
                                                                                group_id: group_id
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

                                                        </li>
                                                        <?php
                                                        $sqlcom1 = "SELECT * FROM group_post_comment where post_id = '$post_id'";
                                                        $resultcom1 = mysqli_query($db, $sqlcom1);
                                                        $numofcom = mysqli_num_rows($resultcom1);


                                                        ?>
                                                        <li onclick="myFunction<?php echo $post_id; ?>()"><a style="color: #b2b2b2;" class="com"><i class="fas fa-comment-alt"></i> Comment <?php echo $numofcom; ?></a></li>
                                                    </ul>

                                                </div>

                                                <script>
                                                    function myFunction<?php echo $post_id; ?>() {
                                                        var x = document.getElementById("post-comment<?php echo $post_id; ?>").className;
                                                        if (x === "post-comment-none") {

                                                            document.getElementById("post-comment<?php echo $post_id; ?>").className = "post-comment";
                                                        } else {

                                                            document.getElementById("post-comment<?php echo $post_id; ?>").className = "post-comment-none";
                                                        }
                                                    }
                                                </script>

                                                <div class="post-comment-none" id="post-comment<?php echo $post_id; ?>">

                                                    <div class="comment-sec">
                                                        <ul>
                                                            <li>
                                                                <div class="comment-list">
                                                                    <br><br>

                                                                    <?php
                                                                    $sqlcom = "SELECT * FROM group_post_comment where post_id = '$post_id'";
                                                                    $resultcom = mysqli_query($db, $sqlcom);
                                                                    $numofcom = mysqli_num_rows($resultcom);
                                                                    while ($row = mysqli_fetch_array($resultcom)) {
                                                                        $user_idc = $row["user_id"];
                                                                        $comment = $row["comment"];
                                                                        $date_comment = $row["date_comment"];
                                                                        $comment_id = $row["comment_id"];

                                                                    ?>


                                                                        <table>
                                                                            <tr>
                                                                                <th>
                                                                                    <div class="bg-img">
                                                                                        <?php
                                                                                        $sqluserc = "SELECT * FROM users where user_id = '$user_idc'";
                                                                                        $resultuserc = mysqli_query($db, $sqluserc);
                                                                                        while ($row = mysqli_fetch_array($resultuserc)) {
                                                                                            $f_namec = $row["f_name"];
                                                                                            $l_namec = $row["l_name"];
                                                                                            $profile_picc = $row["profile_pic"];
                                                                                            $username_com = $row["username"]


                                                                                        ?>
                                                                                            <a href="user-profile.php?username=<?php echo $username_com; ?>">
                                                                                                <img src="users_img/users_pp/<?php echo $profile_picc; ?>" style="width: 40px; margin: 27px;" alt="">
                                                                                            </a>
                                                                                    </div>
                                                                                </th>
                                                                                <th>
                                                                                    <div class="comment">


                                                                                        <h3>
                                                                                            <a href="user-profile.php?username=<?php echo $username_com; ?>">
                                                                                                <?php

                                                                                                echo $f_namec . " " . $l_namec . "</a>";
                                                                                                if ($user_idc == $user_id or $user_idd == $user_id or $owner_id == $user_id) {
                                                                                                ?>

                                                                                                    <div class="ed-opts">
                                                                                                        <a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
                                                                                                        <ul class="ed-options" id="1ed-options1<?php echo $comment_id; ?>" style="width: 100px; padding-left: 0px; right: 0px; top: 25px; height: 54px">

                                                                                                            <script type="text/javascript">
                                                                                                                function css<?php echo $comment_id; ?>() {

                                                                                                                    $("#123comment<?php echo $comment_id; ?>").css({
                                                                                                                        'background-color': '',
                                                                                                                        'color': 'black'
                                                                                                                    });
                                                                                                                    $("#comment1<?php echo $comment_id; ?>").css({
                                                                                                                        'display': 'block'
                                                                                                                    });
                                                                                                                    document.getElementById('123comment<?php echo $comment_id; ?>').removeAttribute('readonly');
                                                                                                                    document.getElementById("1ed-options1<?php echo $comment_id; ?>").className = "ed-options";

                                                                                                                }
                                                                                                            </script>
                                                                                                            <?php
                                                                                                            //and $owner_id != $user_id
                                                                                                            //here
                                                                                                            //if ($user_idd != $user_id) {

                                                                                                            ?>
                                                                                                                <li style="margin: -12px 0px 15px 10px; color: #e44d3a; font-weight: 500; cursor: pointer;" onclick="css<?php echo $comment_id; ?>();">
                                                                                                                    <i class="fa fa-pencil"></i> Edit
                                                                                                                </li>
                                                                                                            <?php
                                                                                                            //}
                                                                                                            ?>
                                                                                                            <br>

                                                                                                            <li style="margin: -12px 0px 15px 10px;">

                                                                                                                <form method="POST" action="" onsubmit="return del_comment<?php echo $comment_id; ?>();">

                                                                                                                    <input type="text" style="display: none; visibility: none;" id="comment_id<?php echo $comment_id; ?>" value="<?php echo $comment_id; ?>">
                                                                                                                    <button type="submit" style="border: none; color: #e44d3a; background-color: transparent;"><i class="fa fa-trash-o"></i> Delete</button>

                                                                                                                </form>


                                                                                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                                                                                                <script type="text/javascript">
                                                                                                                    function del_comment<?php echo $comment_id; ?>() {


                                                                                                                        var comment_id = document.getElementById("comment_id<?php echo $comment_id; ?>").value;


                                                                                                                        if (comment_id) {
                                                                                                                            $.ajax({
                                                                                                                                type: 'post',
                                                                                                                                url: 'del_comment_g.php',
                                                                                                                                data: {
                                                                                                                                    comment_id
                                                                                                                                },
                                                                                                                                cache: false,
                                                                                                                                success: function(response) {
                                                                                                                                    window.location.reload();
                                                                                                                                    alert("Comment Deleted");


                                                                                                                                }
                                                                                                                            });
                                                                                                                        }

                                                                                                                        return false;
                                                                                                                    }
                                                                                                                </script>


                                                                                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                                                                                                <script type="text/javascript">
                                                                                                                    function edit_comment<?php echo $comment_id; ?>() {

                                                                                                                        var comment_id_edit = document.getElementById("comm_id<?php echo $comment_id; ?>").value;
                                                                                                                        var comment_text_edit = document.getElementById("123comment<?php echo $comment_id; ?>").value;

                                                                                                                        if (comment_id_edit) {
                                                                                                                            $.ajax({
                                                                                                                                type: 'post',
                                                                                                                                url: 'edit_comment_g.php',
                                                                                                                                data: {
                                                                                                                                    comment_id_edit: comment_id_edit,
                                                                                                                                    comment_text_edit: comment_text_edit
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

                                                                                                            </li>

                                                                                                        </ul>
                                                                                                    </div>



                                                                                            <?php
                                                                                                }
                                                                                            }

                                                                                            ?>
                                                                                        </h3>
                                                                                        <span><img src="images/clock.png" alt=""> <?php echo $date_comment ?></span>

                                                                                        <?php

                                                                                        if ($user_idc == $user_id) {
                                                                                        ?>

                                                                                            <div class="comment_box">
                                                                                                <form method="POST" action="" onsubmit="return edit_comment<?php echo $comment_id; ?>();">
                                                                                                    <input type="text" style="display: none; visibility: none;" id="comm_id<?php echo $comment_id; ?>" value="<?php echo $comment_id; ?>">
                                                                                                    <input type="text" style="width: 100%; border: none; background-color: transparent; color: #686868; font-weight: 400;" id="123comment<?php echo $comment_id; ?>" value="<?php echo $comment; ?>" readonly>
                                                                                                    <button type="submit" id="comment1<?php echo $comment_id; ?>" style="display: none;">Done</button>
                                                                                                </form>
                                                                                            </div>
                                                                                        <?php } else { ?>

                                                                                            <p><?php echo $comment; ?></p>
                                                                                        <?php } ?>

                                                                                    </div>
                                                                                </th>
                                                                            </tr>

                                                                        </table><br>

                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </div>

                                                            </li>



                                                        </ul>
                                                    </div>

                                                    <div class="post-comment">
                                                        <div class="cm_img">
                                                            <img src="users_img/users_pp/<?php echo $pp; ?>" style="width: 40px;" alt="">
                                                        </div>
                                                        <div class="comment_box">
                                                            <form method="POST" action="" onsubmit="return add_comment<?php echo $post_id; ?>();">
                                                                <input type="text" style="display: none; visibility: none;" id="group_id<?php echo $group_id; ?>" value="<?php echo $group_id; ?>">
                                                                <input type="text" style="display: none; visibility: none;" id="post_id<?php echo $post_id; ?>" value="<?php echo $post_id; ?>">
                                                                <input type="text" id="comment<?php echo $post_id; ?>" placeholder="Post a comment" require>
                                                                <input type="text" style="display: none; visibility: none;" id="user_id<?php echo $post_id; ?>" value="<?php echo $user_id; ?>">
                                                                <button type="submit">Post</button>

                                                            </form>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                            <script type="text/javascript">
                                                function add_comment<?php echo $post_id; ?>() {
                                                    var group_id = document.getElementById("group_id<?php echo $group_id; ?>").value;
                                                    var post_id = document.getElementById("post_id<?php echo $post_id; ?>").value;
                                                    var comment = document.getElementById("comment<?php echo $post_id; ?>").value;
                                                    var user_id = document.getElementById("user_id<?php echo $post_id; ?>").value;


                                                    if (post_id && comment && user_id) {
                                                        $.ajax({
                                                            type: 'post',
                                                            url: 'add_comment_g.php',
                                                            data: {
                                                                post_id: post_id,
                                                                comment: comment,
                                                                user_id: user_id,
                                                                group_id: group_id
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

                                        <?php
                                        }
                                        ?>




                                    </div>
                                </div>










                            </div>
                        </div>
                        <?php
                        if ($owner_id == $user_id) {
                        ?>
                            <div class="col-lg-3">
                                <div class="right-sidebar">
                                    <div class="message-btn">
                                        <a href="group_setting.php?webaddress=<?php echo $webaddress1; ?>" title=""><i class="fas fa-cog"></i> Setting</a>
                                    </div>

                                </div>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include_once "inc/footer.php";
    ?>


    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/flatpickr.min.js"></script>
    <script type="text/javascript" src="lib/slick/slick.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    </body>

</html>