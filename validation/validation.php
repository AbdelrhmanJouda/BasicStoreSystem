<?php 
session_start();
include "../functions/function.php";
if($_SERVER['REQUEST_METHOD']== 'POST') {
    $errors = [];
    $success = [];
// get data         sanitization
$_POST['image'] = $_FILES['image']['name'];
foreach($_POST as $key => $value){                  // add post data becomes varibles
$$key = sanitizedata($value);
}

//validation

if(empty($name)){                   // name validation
    $errors[] = "name required";
}elseif(maxLength($name,20)){
    $errors[]="name should be less than 20 chars";
}elseif(minLength($name,3)){
    $errors[]="name should be more than 3 chars";
}


if(empty($email)){                   // email 
    $errors[] = "email is required";
}elseif(checkEmail($email)){
    $errors[]= "email not valid";
}elseif(maxLength($email,60)){
    $errors[]="email should be less than 60 chars";
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[]="email not valid";
}


if(empty($password)){                   // password validation
    $errors[] = "password is required";
}elseif(maxLength($password,20)){
    $errors[]="password should be less than 20 chars";
}elseif(minLength($password,3)){
    $errors[]="password should be more than 3 chars";
}

if(empty($Confirm_password)){                   // confirm password validation
    $errors[] = "confirm password is required";
}elseif(maxLength($Confirm_password,20)){
    $errors[]="confirm password should be less than 20 chars";
}elseif(minLength($Confirm_password,3)){
    $errors[]="confirm password should be more than 3 chars";
}elseif($Confirm_password != $password){
    $errors[]="Confirm password correctlly";
}

if($image == ''){
    $errors[]='select image';
}elseif(file_exists("../upload/".$image)){
    $errors[]='this image has been selected'; 
}elseif(isset($_FILES['image'])){                // image validation
    $file = $_FILES['image'];
    $fname = $file['name'];
    $ftemp = $file['tmp_name'];
    $ferror = $file['error'];
    $fsize = $file['size'];

    if($fname==''){
        $errors[]='select image';
    }elseif($fname != ''){                        //check image
    $allowed = ['jpg','png'];
    $file_info = pathinfo($fname);  //  info
    $info_name = $file_info['filename'];    // (name).
    $info_extension = $file_info['extension'];  //.(extension)
    
    if(!in_array($info_extension,$allowed)){
        $errors[] = 'this file type not allowed'; 
    }elseif($fsize > 100000){
        $errors[] = 'file size not allowed';
    }elseif($ferror == 1){
        $errors[] = 'file error';
    }
    $fileopen = finfo_open(FILEINFO_MIME_TYPE);
    $FileType= finfo_file($fileopen,$ftemp);
    finfo_close($fileopen);
    if($FileType == "image/gif" || $FileType == "image/png" || $FileType == "image/jpeg" || $FileType == "image/JPEG" || $FileType == "image/PNG" || $FileType == "image/GIF"){
    }else{
        $errors[]='this file is not image, please scan or check your file';
        } 
   }
}


if(empty($errors)){

    if(!file_exists("users.json")){
        $final_data =CreateData("users.json");          //json_encode($data)
        if(file_put_contents("users.json",$final_data)){
        $_SESSION['success']= ["data created successfully"];

        $folder = '../upload/';
        if(!file_exists("../upload")){
            mkdir("../upload");
        }
        move_uploaded_file($ftemp,$folder.$info_name.".".$info_extension);
       

        header("location:../users.php");
        }
        }else{

        if(checkData($name,$email,'users.json')){

            $final_data = WriteAppend("users.json");        //json_encode($data)
            if(file_put_contents("users.json",$final_data)){
            $_SESSION['success']= ["data added successfully"];
            $_SESSION['auth']=true;

            $folder = '../upload/';                     // check image
            if(!file_exists("../upload")){
                mkdir("../upload");
            }
            move_uploaded_file($ftemp,$folder.$info_name.".".$info_extension);

            header("location:../users.php");    
            }
            
            }else{
                                                        // check log
            $er=WichExist($name,$email,'users.json');   
            $_SESSION['errors']=[$er];
            header("location:../reg.php");   
            }
         }
}else{
    $_SESSION['errors']=$errors;
    header("location:../reg.php");
    }

}else {
    header("location:../login.php");
}