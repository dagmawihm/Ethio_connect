<?php
include_once "inc/db.php";

if(isset($_POST['comment_id_edit']) && isset($_POST['comment_text_edit']))
{
    $comment_id = $_POST['comment_id_edit'];
    $comment_text_edit = $_POST['comment_text_edit'];

    if($comment_text_edit == "" || $comment_text_edit == " " || $comment_text_edit == "  ")
    {
        $sqllike = "DELETE FROM group_post_comment WHERE comment_id = '$comment_id'";
    }
    else
    {
        $sqllike = "UPDATE group_post_comment SET comment = '$comment_text_edit' WHERE comment_id = '$comment_id'";
    }

    

    

    mysqli_query($db, $sqllike);
    




    

    
    

}
