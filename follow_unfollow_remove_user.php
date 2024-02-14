<?php
include_once "inc/db.php";

if (isset($_POST['request'])) {
    
  $request = $_POST['request'];

if($request == "remove")
{
  if (isset($_POST['suseriddr'])) {

    $suseriddr = $_POST['suseriddr'];
    $user_id = $_POST['user_id'];
    
    $sql_start_remove = "DELETE FROM follower WHERE follower_id = '$suseriddr' and follow_id = '$user_id' ";
    mysqli_query($db, $sql_start_remove);
  }
}

//elseif($request == "remove")
//{

//}




    

}
    


