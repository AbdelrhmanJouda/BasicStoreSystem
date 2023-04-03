<?php
include "../functions/function.php";
if(!isset($_SESSION['auth']) && !isset($_SERVER['HTTP_REFERER']) ) {
    redirect("../index.php");
}
$img = $_GET['img'];
// get data
$data = json_decode(file_get_contents('../validation/users.json'),true);
$e = $_GET['e'];
// loop on data
foreach($data as $key => $row){
    // if row of email == email of GET
    if($row['email'] == $e){
        // delete the fild
        unset($data[$key]);
        
    }
}
//delete image
unlink("../upload/$img");
// save new record
file_put_contents('../validation/users.json',json_encode($data));
// back to users page
redirect('../users.php');
