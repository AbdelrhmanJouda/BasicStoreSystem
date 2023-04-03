<?php
//products.json
session_start();
include "../functions/function.php";
if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    $errors = [];
    $_POST['id'] = LastId('products.json')+1;
    //sanitization
    $_POST['image'] = $_FILES['image']['name'];
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

    if($image == ''){
        $errors[]='select image';
    }elseif(file_exists("../upload/products/".$image)){
        $errors[]='this image has been selected'; 
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
        if (!file_exists("products.json")) {                                //create products json file to store data 
            $finaldata = CreateProductData("products.json");
            if (file_put_contents("products.json", $finaldata)) {
                $_SESSION['success'] = ['product created successfully'];

                $folder = "../upload/products/";                             // check image folder
                if (!file_exists("../upload/products")) {
                    mkdir("../upload/products");
                }                                       
                                     // Move image from tmp path to folder path 
                move_uploaded_file($ftmp, $folder . $info_name . "." . $info_extension);
                                                                            
                redirect("../products.php");                                  // redirect to products page  
            }
        } else {
            $finaldata = WriteProductAppend("products.json");                 // Append new data to products json file
            if (file_put_contents("products.json", $finaldata)) {
                $_SESSION['success'] = ['product added successfully'];

                $folder = "../upload/products/";                              // check image folder
                if (!file_exists("../upload/products")) {
                    mkdir("../upload/products");
                }                                                             // Move image from tmp path to folder path
               
                move_uploaded_file($ftmp, $folder . $info_name . "." . $info_extension);
                                                                              
                redirect("../products.php");                                    // redirect to products page
            }
        }
        unset($_SESSION['old']);                    // unset old data session
        unset($_SESSION['upId']);
    } else
             {
                $_SESSION['errors'] = $errors;
                redirect("../addPro.php");
    }
} else {
    redirect("../index.php");
}
