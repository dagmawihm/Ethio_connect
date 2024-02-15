<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Home | Ethio Connect</title>

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


    <?php
    include_once "inc/header.php";




    $randint = (rand(100000, 999999));
    if (isset($_POST['test1'])) {



        for ($i = 0; $i < count($_FILES["upload_file"]["name"]); $i++) {
            $uploadfile = $_FILES["upload_file"]["name"][$i];
            $folder = "post_img/";
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
        $sqlpost = "INSERT INTO post (user_id, post_date, text, image1, image2, image3) VALUE ('$user_id','$today','$test','$image1','$image2','$image3')";
        mysqli_query($db, $sqlpost);
        echo "<script>alert('your post is published ✓')</script>";
        echo '<script type="text/javascript">';
        echo "window.location.href = 'index.php';";
        echo "</script>";
    }
    ?>





    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 pd-left-none no-pd">
                            <div class="main-left-sidebar no-margin">
                                <div class="user-data full-width">
                                    <div class="user-profile">
                                        <div class="username-dt">
                                            <div class="usr-pic">
                                                <img src="users_Img/users_pp/<?php echo $pp; ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="user-specs">
                                            <h3><?php echo $name, " ", $lname; ?></h3>
                                            <span><?php echo $bio; ?></span>
                                        </div>
                                    </div>
                                    <ul class="user-fw-status">
                                        <li>
                                            <a href="following_&_followers.php?request=following">
                                                <h4>Following</h4>
                                                <?php
                                                $sql_following = "SELECT * FROM follower where follower_id = '$user_id'";
                                                $result_following = mysqli_query($db, $sql_following);
                                                $following = mysqli_num_rows($result_following);

                                                $sql_followers = "SELECT * FROM follower where follow_id = '$user_id'";
                                                $result_followers = mysqli_query($db, $sql_followers);
                                                $followers = mysqli_num_rows($result_followers);
                                                ?>
                                                <span><?php echo $following; ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="following_&_followers.php?request=followers">
                                                <h4>Followers</h4>
                                                <span><?php echo $followers; ?></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="my_profile_feed.php" title="">View Profile</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="suggestions full-width">
                                    <div class="sd-title">
                                        <h3>Suggestions</h3>

                                    </div>
                                    <div class="suggestions-list">
                                        <?php
                                        $sql_search_user = "SELECT * FROM users where user_id != '$user_id' and RAND( ) LIMIT 6";
                                        $result_search_user = mysqli_query($db, $sql_search_user);
                                        while ($row = mysqli_fetch_array($result_search_user)) {
                                            $f_names = $row["f_name"];
                                            $l_names = $row["l_name"];
                                            $profile_pics = $row["profile_pic"];
                                            $bios = $row["bio"];
                                            $usernames = $row["username"];
                                        ?>
                                            <a href="user-profile.php?username=<?php echo $usernames; ?>">
                                                <div class="suggestion-usd">
                                                    <img src="users_Img/users_pp/<?php echo $profile_pics; ?>" style="width:30px" alt="">
                                                    <div class="sgt-text">
                                                        <h4><?php echo $f_names . " " . $l_names; ?></h4>
                                                        <span><?php echo $bios; ?></span>
                                                    </div>

                                                </div>
                                            </a>
                                        <?php
                                        }
                                        ?>






                                    </div>
                                </div>
                                <div class="tags-sec full-width">
                                    <ul>
                                        <li><a href="help-center.php" title="Help Center">Help Center</a></li>
                                        <li><a href="about.php" title="About">About</a></li>
                                        <li><a href="Privacy_policy.php" title="Privacy Policy">Privacy Policy</a></li>
                                    </ul>
                                    <div class="cp-sec">
                                        <p style="margin-right: 15%;margin-bottom: 1em;">Developed by <a href="https://www.linkedin.com/in/dagmawihm/" target="_blank">Dagmawihm</a></p>
                                        <img src="images/logo2.png" alt="logo">
                                        <p><img src="images/cp.png" alt="Copyright">Copyright 2024</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 no-pd">
                            <div class="main-ws-sec">
                                <div class="post-topbar">
                                    <div class="user-picy">
                                        <img src="users_Img/users_pp/<?php echo $pp; ?>" alt="">
                                    </div>
                                    <div class="post-st">
                                        <div id="wrapper">










                                            <form name="posttni" id="posttni" method="post" enctype="multipart/form-data">
                                                <textarea id="w3review" name="test" rows="4" cols="50" style="width: 100%;" placeholder="Write your post here and include hashtags that describe your post"></textarea>
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
                                <div class="posts-section">
                                    <?php
                                    $following_id = array();
                                    $it = 0;

                                    $sql_following_post = "SELECT * FROM follower where follower_id = '$user_id'";
                                    $result_following_post = mysqli_query($db, $sql_following_post);
                                    while ($row = mysqli_fetch_array($result_following_post)) {
                                        $following_id[$it] = $row['follow_id'];
                                        $it++;
                                    }



                                    $sqlposts = "SELECT * FROM post WHERE ";


                                    for ($it2 = 0; $it2 <= $it - 1; $it2++) {
                                        $sqlposts = $sqlposts . "user_id = '$following_id[$it2]' or ";
                                    }



                                    $sqlposts = $sqlposts . "user_id = '" . $user_id . "' order by post_id desc";
                                    //echo $sqlposts;
                                    $resultposts = mysqli_query($db, $sqlposts);
                                    while ($row = mysqli_fetch_array($resultposts)) {
                                        $post_id = $row["post_id"];
                                        $user_idd = $row["user_id"];
                                        $text = $row["text"];
                                        $img1 = $row["image1"];
                                        $img2 = $row["image2"];
                                        $img3 = $row["image3"];
                                        $post_date = $row["post_date"];
                                        $numofshare = $row["shares"];



                                        $sqluser = "SELECT * FROM users where user_id = '$user_idd'";
                                        $resultuser = mysqli_query($db, $sqluser);
                                        while ($row = mysqli_fetch_array($resultuser)) {
                                            $userpp = $row["profile_pic"];
                                            $ffname = $row["f_name"];
                                            $llname = $row["l_name"];
                                            $userbio = $row["bio"];
                                            $user_iddd = $row["user_id"];
                                            $username_post = $row["username"];
                                        }
                                        $likes = 0;
                                        $sqllikes = "SELECT * FROM post_like where post_id = '$post_id'";
                                        $resultlikes = mysqli_query($db, $sqllikes);
                                        $likes = mysqli_num_rows($resultlikes);

                                        $sqldislikes = "SELECT * FROM post_like where post_id = '$post_id' and user_id = '$user_id'";
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
                                                <a href="user-profile.php?username=<?php echo $username_post; ?>">
                                                    <div class="usy-dt">
                                                        <img src="users_Img/users_pp/<?php echo $userpp; ?>" alt="" style="width: 10%;">
                                                        <div class="usy-name">
                                                            <h3><?php echo $ffname, " ", $llname; ?></h3>
                                                            <span><img src="images/clock.png" alt=""><?php echo $post_date; ?></span>
                                                        </div>
                                                    </div>
                                                </a>

                                                <?php

                                                if ($user_iddd == $user_id or $type == "mod") {



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
                                                                    url: 'del_post.php',

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
                                            <div class="job_descp">
                                                <p><?php echo $text; ?></p>









                                                <?php
                                                if ($img1 != "" and $img2 == "") {
                                                    echo '<img  src="post_img/' . $img1 . '">';
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
                                                                    <img class="d-block w-100" style="" src="post_img/<?php echo $img1; ?>" alt="First slide">
                                                                </div>

                                                                <?php
                                                                if ($img2 != "") {
                                                                ?>
                                                                    <div class="carousel-item">
                                                                        <img class="d-block w-100" style="" src="post_img/<?php echo $img2; ?>" alt="Second slide">
                                                                    </div>
                                                                <?php

                                                                }
                                                                if ($img3 != "") {
                                                                ?>

                                                                    <div class="carousel-item">
                                                                        <img class="d-block w-100" style="" src="post_img/<?php echo $img3; ?>" alt="Third slide">
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
                                                                var user_id = document.getElementById("user_id<?php echo $post_id; ?>").value;
                                                                var disorlike = document.getElementById("disorlike<?php echo $post_id; ?>").value;


                                                                if (post_id && user_id && disorlike) {
                                                                    $.ajax({
                                                                        type: 'post',
                                                                        url: 'like_dislike.php',
                                                                        data: {
                                                                            post_id: post_id,
                                                                            user_id: user_id,
                                                                            disorlike: disorlike,
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
                                                    $sqlcom1 = "SELECT * FROM post_comment where post_id = '$post_id'";
                                                    $resultcom1 = mysqli_query($db, $sqlcom1);
                                                    $numofcom = mysqli_num_rows($resultcom1);


                                                    ?>
                                                    <li onclick="myFunction<?php echo $post_id; ?>()"><a style="color: #b2b2b2;" class="com"><i class="fas fa-comment-alt"></i> Comment <?php echo $numofcom; ?></a></li>
                                                    <li onclick="share<?php echo $post_id; ?>()"><a style="color: #b2b2b2;" class="com"><i class="fa fa-share"></i> Share <?php echo $numofshare; ?></a></li>
                                                </ul>

                                            </div>




                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                                            <script type="text/javascript">
                                                function share<?php echo $post_id; ?>() {


                                                    var post_id_to_share = "<?php echo $post_id; ?>";
                                                    var user_id_going_to_share = "<?php echo $user_id; ?>";
                                                    var post_owner = "<?php echo $username_post; ?>";




                                                    if (post_id_to_share) {
                                                        $.ajax({
                                                            type: 'post',
                                                            url: 'share.php',
                                                            data: {
                                                                post_id_to_share: post_id_to_share,
                                                                user_id_going_to_share: user_id_going_to_share,
                                                                post_owner: post_owner,


                                                            },
                                                            cache: false,
                                                            success: function(response) {
                                                                window.location.reload();
                                                                alert("You Shared @" + post_owner + "'s post");



                                                            }
                                                        });
                                                    }

                                                    return false;
                                                }
                                            </script>

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
                                                                $sqlcom = "SELECT * FROM post_comment where post_id = '$post_id'";
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
                                                                                        $username_com = $row["username"];


                                                                                    ?>
                                                                                        <a href="user-profile.php?username=<?php echo $username_com; ?>">
                                                                                            <img src="users_Img/users_pp/<?php echo $profile_picc; ?>" style="width: 40px; margin: 27px;" alt="">
                                                                                        </a>
                                                                                </div>
                                                                            </th>
                                                                            <th>
                                                                                <div class="comment">


                                                                                    <h3>
                                                                                        <a href="user-profile.php?username=<?php echo $username_com; ?>">
                                                                                            <?php

                                                                                            echo $f_namec . " " . $l_namec . "</a>";



                                                                                            if ($user_idc == $user_id or $user_idd == $user_id) {
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
                                                                                                        if ($user_idd != $user_id) {

                                                                                                        ?>
                                                                                                            <li style="margin: -12px 0px 15px 10px; color: #e44d3a; font-weight: 500; cursor: pointer;" onclick="css<?php echo $comment_id; ?>();">
                                                                                                                <i class="fa fa-pencil"></i> Edit
                                                                                                            </li>
                                                                                                        <?php
                                                                                                        }
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
                                                                                                                            url: 'del_comment.php',
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
                                                                                                                            url: 'edit_comment.php',
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
                                                        <img src="users_Img/users_pp/<?php echo $pp; ?>" style="width: 40px;" alt="">
                                                    </div>
                                                    <div class="comment_box">
                                                        <form method="POST" action="" onsubmit="return add_comment<?php echo $post_id; ?>();">
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

                                                var post_id = document.getElementById("post_id<?php echo $post_id; ?>").value;
                                                var comment = document.getElementById("comment<?php echo $post_id; ?>").value;
                                                var user_id = document.getElementById("user_id<?php echo $post_id; ?>").value;


                                                if (post_id && comment && user_id) {
                                                    $.ajax({
                                                        type: 'post',
                                                        url: 'add_comment.php',
                                                        data: {
                                                            post_id: post_id,
                                                            comment: comment,
                                                            user_id: user_id,
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
                        <div class="col-lg-3 pd-right-none no-pd">
                            <div class="right-sidebar">







                                <div class="widget suggestions full-width">
                                    <div class="sd-title">
                                        <h3>Suggested groups</h3>

                                    </div>
                                    <div class="suggestions-list">

                                        <?php
                                        $sql_search_userg = "SELECT * FROM groups where RAND( ) LIMIT 10";
                                        $result_search_userg = mysqli_query($db, $sql_search_userg);
                                        while ($row = mysqli_fetch_array($result_search_userg)) {
                                            $group_namegg = $row["group_name"];
                                            $profile_picgg = $row["profile_pic"];
                                            $categorygg = $row["category"];
                                            $web_addressgg = $row["web_address"];
                                        ?>
                                            <a href="group.php?webaddress=<?php echo $web_addressgg; ?>">
                                                <div class="suggestion-usd">
                                                    <img src="group_img\group_pp\<?php echo $profile_picgg; ?>" style="width:30px;" alt="">
                                                    <div class="sgt-text">
                                                        <h4><?php echo $group_namegg; ?></h4>
                                                        <span><?php echo $categorygg; ?></span>
                                                    </div>
                                                </div>
                                            </a>

                                        <?php
                                        }
                                        ?>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
    <script type="text/javascript" src="lib/slick/slick.min.js"></script>
    <script type="text/javascript" src="js/scrollbar.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    </body>

</html>