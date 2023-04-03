<?php
//products.json
session_start();
include "../functions/function.php";
if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    $errors = [];
    $_POST['id']=$_SESSION['upId'];
    $_POST['image']= $_FILES['image']['name'];
    $oldImage = $_GET['img'];
    //sanitization
    foreach ($_POST as $key => $value) {
        $$key = sanitizedata($value);
        $_SESSION['old'] = $_POST;
    }

    // validation
    if (empty($name)) {                                                 // name validation
        $errors[] = 'error : name required';
    } elseif (maxLength($name, 20)) {
        $errors[] = 'error : name must be less than 20 chars';
    } elseif (minLength($name, 2)) {
        $errors[] = 'error : name must be more than 2 chars';
    } elseif (is_numeric($name)) {
        $errors[] = 'error : enter name';
    }



    if (empty($price)) {                                              // price validation
        $errors[] = 'price required';
    } elseif (maxLength($price, 6)) {
        $errors[] = 'price must be less than 6 nums';
    } elseif (!is_numeric($price)) {
        $errors[] = 'enter price';
    }

    if (empty($discription)) {                                         // discription validation
        $errors[] = 'discription neded ';
    } elseif (maxLength($discription, 150)) {
        $errors[] = 'discription must be less than 150 chars';
    } elseif (minLength($discription, 3)) {
        $errors[] = 'description required';
    }
    if($image ==''){
        $errors[]='select image';
    }elseif (isset($_FILES['image'])) {                                    //image validation
        $file = $_FILES['image'];
        $fname = $file['name'];
        $ftmp = $file['tmp_name'];
        $fsize = $file['size'];
        $ferror = $file['error'];

        if ($fname != '') {
            $allowed = ["jpg"];
            $file_info = pathinfo($fname);
            $info_name = $file_info['filename'];
            $info_extension = $file_info['extension'];

            if (!in_array($info_extension, $allowed)) {
                $errors[] = 'Image error : this type not allowed';
            } elseif ($fsize > 102400) {
                $errors[] = 'Image error : this size to big please uploade less than 1M';
            } elseif ($ferror == 1) {
                $errors[] = 'File error';
            }
        }
    }


    if (empty($errors)) {

        //get data
        $data = json_decode(file_get_contents("products.json"),true);
       
        //stroe updated data
     $updateData = [
                'name' => $name,
                'id'   => $id,
                'price' => $price,
                'discription' => $discription,
                'image' => $image
            ];
        // check row and assign the new data to the row
       foreach($data as $row){
        if($row['id'] == $id){
          $data[$id-1] = $updateData;
          var_dump($row);
          break;
        }
    }
        // insert updated data to json
        file_put_contents("products.json",json_encode($data));

        // store image path
        $folder = "../upload/products/";
        if(!file_exists($folder.$image)){
            if($folder.$image != $folder.$oldImage){
                //delete image
                unlink("../upload/products/$oldImage");
            }
            if(move_uploaded_file($ftmp,$folder.$image)){
                $_SESSION['success']=['image added successfylly'];
            }
        }


         $_SESSION['success'] = ['product edited successfully'];
         
        redirect('../products.php');

    }else {
        // if errors
        $_SESSION['errors'] = $errors;
        // send id and image path to the page
        redirect("../edit.php?id=$id&img=$oldImage");
    }
} else {
    redirect("../index.php");
}
