<?php
include_once "inc/db.php";

if(isset($_POST['messages_idd']))
{
    $messages_idd = $_POST['messages_idd'];
    $sql_del_messages = "DELETE FROM messages WHERE messages_id = '$messages_idd'";
    mysqli_query($db, $sql_del_messages);
    




    

    
    

}
