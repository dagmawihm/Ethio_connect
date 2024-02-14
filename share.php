<?php
include_once "inc/db.php";

if (isset($_POST['post_id_to_share'])) {
    $post_id_to_share = $_POST['post_id_to_share'];
    $user_id_going_to_share = $_POST['user_id_going_to_share'];
    $post_owner = $_POST['post_owner'];


    $sqlposts = "SELECT * FROM post where post_id = '$post_id_to_share'";
    $resultposts = mysqli_query($db, $sqlposts);
    while ($row = mysqli_fetch_array($resultposts)) {


        $post_date = $row["post_date"];
        $text = $row["text"];
        $img1 = $row["image1"];
        $img2 = $row["image2"];
        $img3 = $row["image3"];
        $numofshare = $row["shares"];
    }


    $text = 'Post Shared from<a href="user-profile.php?username=' . $post_owner . '"> @' . $post_owner . '</a><br>' . $text;

    $sql_share = "INSERT INTO post (user_id, post_date, text, image1, image2, image3, shares) VALUE ('$user_id_going_to_share','$post_date','$text','$img1','$img2','$img3','$numofshare')";
    mysqli_query($db, $sql_share);

    $numofshare = $numofshare + 1;
    $sql_share_iterate = "UPDATE post SET shares='$numofshare' WHERE post_id = '$post_id_to_share'";
    mysqli_query($db, $sql_share_iterate);



    $today = date("y-m-d");
    $notification = " Shared your post.";
    
    

    $sql_post_owner = "SELECT user_id FROM post WHERE post_id = '$post_id_to_share'";
    $result_post_owner = mysqli_query($db, $sql_post_owner);
    while ($row = mysqli_fetch_array($result_post_owner)) {
        $recipient_user_id = $row["user_id"];
    }


    $sql_notification = "INSERT INTO notifications (date, notification, recipient_id, notifier) VALUE ('$today','$notification',' $recipient_user_id','$user_id_going_to_share')";
    mysqli_query($db, $sql_notification);
}
