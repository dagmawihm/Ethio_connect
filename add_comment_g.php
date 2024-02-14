<?php
include_once "inc/db.php";

if (isset($_POST['post_id']) && isset($_POST['comment']) && isset($_POST['user_id'])) {
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $user_id = $_POST['user_id'];
    $date_comment = date("y-m-d");
    $group_id = $_POST['group_id'];


    
    $notification = " Comment on your post";



    $sql_post_owner = "SELECT user_id FROM post WHERE post_id = '$post_id'";
    $result_post_owner = mysqli_query($db, $sql_post_owner);
    while ($row = mysqli_fetch_array($result_post_owner)) {
        $recipient_user_id = $row["user_id"];
    }


    $sql_notification = "INSERT INTO notifications (date, notification, recipient_id, notifier) VALUE ('$date_comment','$notification',' $recipient_user_id','$user_id')";
    mysqli_query($db, $sql_notification);



    $sqllike = "INSERT INTO group_post_comment (post_id, user_id, comment, date_comment, group_id) VALUE ('$post_id','$user_id','$comment','$date_comment','$group_id')";
    mysqli_query($db, $sqllike);
}
