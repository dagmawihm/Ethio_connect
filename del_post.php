<?php
include_once "inc/db.php";

if(isset($_POST['post_id_del']))
{
    $post_id1 = $_POST['post_id_del'];
    $sqllike = "DELETE FROM post WHERE post_id = '$post_id1'";
    mysqli_query($db, $sqllike);
    




    

    
    

}
