<?php
if(!isset($_SESSION['auth']) && !isset($_SERVER['HTTP_REFERER']) ) {
    redirect("../index.php");
}
include "../functions/function.php";
$id=$_GET['id'];
$img=$_GET['img'];

// $data = json_decode(file_get_contents('../validation/products.json'),true);

// file_put_contents('../validation/products.json',json_encode($data));

// unset($data[$id-1]);
// unlink("../upload/products/$img");


// header("location:../products.php");







//get data
$data = json_decode(file_get_contents('../validation/products.json'),true);

//loop and check data
    foreach($data as $key => $row){
        if($row['id'] == $id){
            //delete this fild
            unset($data[$key]);
        }
    }
    //save data
    file_put_contents('../validation/products.json',json_encode($data));

    //delete image
    unlink("../upload/products/$img");

    //msg
    $_SESSION['success']='product deleted successfully';
    // redirect to products
    redirect('../products.php');







?>