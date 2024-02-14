<?php
include_once "inc/db.php";

if(isset($_POST['message_text_edit']) && isset($_POST['mess_id_edit']))
{
    $message_id = $_POST['mess_id_edit'];
    $message_text_edit = $_POST['message_text_edit'];

    if($message_text_edit == "" || $message_text_edit == " " || $message_text_edit == "  ")
    {
        $sqllike = "DELETE FROM messages WHERE messages_id = '$message_id'";
    }
    else
    {
        $sqllike = "UPDATE messages SET message = '$message_text_edit', edit = 'true' WHERE messages_id = '$message_id'";
    }

    

    

    mysqli_query($db, $sqllike);
    




    

    
    

}
