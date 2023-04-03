<?php 



// sanitize 


function sanitizedata($data){
return    trim(htmlspecialchars(htmlentities($data)));
}

// validations

function maxLength($string,$length){
    if(strlen($string) > $length){
        return true;
    }
    return false;
}

function minLength($string,$length){
    if(strlen($string) < $length){
        return true;
    }
    return false;
}

// check email

function checkEmail($email){
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        return true;
    }return false;
}

        ///////////==  JSON  ==//////////////
// create data //
function CreateData($fileName){
    $file = fopen($fileName,"w");        
    $data=[];                              
    $data[]=[
        'name' => $_POST['name'],
        'email'=> $_POST['email'],
        'password'=>$_POST['password'],
        'Confirm_password'=>$_POST['Confirm_password'],
        'image'=>$_FILES['image']['name']
    ];

    $final_data = json_encode($data);       
    fclose($file);                         
    return $final_data;                     
}

// write append data //
function WriteAppend($fileName){
    $data = json_decode(file_get_contents($fileName),true);  
    $data[]=[
        'name' => $_POST['name'],
        'email'=> $_POST['email'],
        'password'=>$_POST['password'],
        'Confirm_password'=>$_POST['Confirm_password'],
        'image'=>$_FILES['image']['name']
    ];

    $final_data = json_encode($data);                           
    return $final_data;                                         
}
        //===========good job==================//

            // ============REGISTERATION AND LOGIN =========== //
        //===check data===//
function checkData($name,$email,$filename){
    
    $data= json_decode(file_get_contents($filename),true);
    foreach($data as $user){
        if($user['name'] == $name || $user['email'] == $email){
            return false;
        }
    }
   return true;
}
        //===check password===//
function  checkLogData($email,$password,$filename){
    
        $data= json_decode(file_get_contents($filename),true);
        foreach($data as $user){
            if($user['email'] == $email && $user['password'] == $password){
                return true;
            }
        }
        return false;
    }


        // == check wiche wrong name == //
function WichExist($name,$email,$fileName){
    $data = json_decode(file_get_contents($fileName),true);
    foreach($data as $user){
        if($user['name']==$name && $user['email'] != $email){
            $error ='this name is used, please change name';
        }elseif($user['email']==$email && $user['name']!= $name){
            $error ='this email is already used';
        }elseif($user['name']==$name && $user['email'] == $email){
            $error = ' this email and name are exists : please log in';
        }
    }
    return $error;
}


        //===Logs===/
function LogUser($filename){
    $data = json_decode(file_get_contents($filename),true);
    $Loguser=[];
    foreach($data as $user){
        if($user['email']==$_POST['email']){
            $Loguser[]=[
            'name' => $user['name'],
            'email'=> $user['email'],
            'image'=> $user['image'],
            ];
        }
        
    };
    $final_data= json_encode($Loguser);
    return $final_data;
}
    //===Log user name==//
function LogUsername($filename){
    $data = json_decode(file_get_contents($filename),true);
    foreach($data as $user){
    $loguser = $user['name'];
    }
    return $loguser;
}
    //===Log user Image==//
function LogUserimg($filename){
    $data = json_decode(file_get_contents($filename),true);
    foreach($data as $user){
    $loguser = $user['image'];
    }
    return $loguser;
}

       ////////////////////                                     //////////////////////
                            /////////////PRODUCTS/////////////                       
        ///////////////////                                    //////////////////////

function CreateProductData($fileName){              //create product data
    $file = fopen($fileName,"w");        
    $data=[];                              
    $data[]=[
        'name' => $_POST['name'],
        'id' => $_POST['id'],
        'price'=> $_POST['price'],
        'discription'=>$_POST['discription'],
        'image'=>$_FILES['image']['name']
    ];

    $final_data = json_encode($data);       
    fclose($file);                         
    return $final_data;                     
}


// write product append data //
function WriteProductAppend($fileName){
    $data = json_decode(file_get_contents($fileName),true);  
    $data[]=[
        'name' => $_POST['name'],
        'id' => $_POST['id'],
        'price'=> $_POST['price'],
        'discription'=>$_POST['discription'],
        'image'=>$_FILES['image']['name']
    ];

    $final_data = json_encode($data);                           
    return $final_data;                                         
}

// product id

function LastId($filename){
    $data = json_decode(file_get_contents($filename),true);
   if(isset($data)){
     $id = end($data);
    $last_id = $id['id']?? 0;

    return $last_id;
   }
   return 0;
}



// =====================================================



    //redirect
function redirect($location){
    return    header("location:$location");
}

