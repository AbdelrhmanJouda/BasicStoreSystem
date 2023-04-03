<?php 
session_start();
include "../functions/function.php";






if($_SERVER['REQUEST_METHOD']== 'POST'){
$errors = [];
$success = [];
// get data         sanitization

foreach($_POST as $key => $value){

$$key = sanitizedata($value);
}

//validation


if(empty($email)){                   // email 
    $errors[] = "email is required";
}elseif(checkEmail($email)){
    $errors[]= "email not valid";
}
elseif(maxLength($email,60)){
    $errors[]="email should be less than 60 chars";
}


if(empty($password)){                   // password validation
    $errors[] = "password is required";
}elseif(maxLength($password,20)){
    $errors[]="password should be less than 20 chars";
}elseif(minLength($password,3)){
    $errors[]="password should be more than 3 chars";
}




if(empty($errors)){
                                    //check user
    if(checkLogData($email,$password,'users.json')){          // check if LogData == data

        if(!file_exists('logs.json')){      //create log file
            $final_data = LogUser('users.json');
            if(file_put_contents('logs.json',$final_data)){
                $_SESSION['log']=true;
            }}
        $userLog = LogUsername('logs.json');
        $_SESSION['LogedUser']=[$userLog];
        $userImg = LogUserimg('logs.json');
        $_SESSION['logedImage']=[$userImg];
        $_SESSION['success']=['welcome',$userLog];
        $_SESSION['auth']=true;
        redirect('../index.php');


    }else{
        $_SESSION['errors']=['Email or password not correct'];
        redirect('../login.php');
        
    }



}else{
    $_SESSION['errors']=$errors;
    header("location:../login.php");

}

}else{
    header("location:../index.php");
}