<?php 


if(!isset($_SESSION['auth'])){
    header("location:index.php");
 
}
unlink("validation/logs.json");
session_start();
unset($_SESSION['auth']);
session_destroy();
header("location:index.php");
