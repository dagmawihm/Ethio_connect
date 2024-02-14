<?php
include_once "inc/db.php";

if(isset($_POST['comment_id']))
{
    $comment_id = $_POST['comment_id'];
    $sqllike = "DELETE FROM post_comment WHERE comment_id = '$comment_id'";
    mysqli_query($db, $sqllike);
    




    

    
    

}
