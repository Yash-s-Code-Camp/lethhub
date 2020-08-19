<?php 

function classCode($n) { 

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 

    require  '../config/db.php';

    $check_code = "SELECT * FROM classes WHERE `class_code`='$randomString' OR `class_code`=''";

    if($query = mysqli_query($conn, $check_code)){
        $res=mysqli_num_rows($query);
        
        //If result match $username and $password Table row must be 1 row
        if($res > 1)
        {
            classCode($n);
        }
        else
        {
            return $randomString; 
        }    
    }
    return $randomString; 
} 
  
?> 