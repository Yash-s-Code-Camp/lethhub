<?php include('../config/db.php'); ?>

<?php

    if(isset($_GET["email"])){
        $email = $_GET["email"];

        $sql = "DELETE  FROM `class_student` WHERE email='$email'";

        if(mysqli_query($conn, $sql)){
            header('location:http://localhost/lethhub/teachers/index.php');
        }
        else{
            echo "err".mysqli_error($conn); 
        }


    }

?>