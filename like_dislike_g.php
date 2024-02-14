<?php
include_once "inc/db.php";

if (isset($_POST['post_id']) && isset($_POST['user_id']) && isset($_POST['disorlike'])) {
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    $disorlike = $_POST['disorlike'];
    $group_id = $_POST['group_id'];


    if ($disorlike == "like") {
        $sqllike = "INSERT INTO group_post_like (post_id, user_id, group_id) VALUE ('$post_id','$user_id','$group_id')";
        mysqli_query($db, $sqllike);


        $today = date("y-m-d");
        $notification = " Liked your post.";
        
        

        $sql_post_owner = "SELECT user_id FROM post WHERE post_id = '$post_id'";
        $result_post_owner = mysqli_query($db, $sql_post_owner);
        while ($row = mysqli_fetch_array($result_post_owner)) {
            $recipient_user_id = $row["user_id"];
        }


        $sql_notification = "INSERT INTO notifications (date, notification, recipient_id, notifier) VALUE ('$today','$notification',' $recipient_user_id','$user_id')";
        mysqli_query($db, $sql_notification);
    } else {
        $sqllike = "DELETE FROM group_post_like WHERE post_id = '$post_id' and user_id = '$user_id' ";
        mysqli_query($db, $sqllike);
    }
}
