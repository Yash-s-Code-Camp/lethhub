<?php include('../config/db.php'); ?>

<?php

    if(isset($_GET["email"])){
        $email = $_GET["email"];

        $sql = "DELETE  FROM `class_student` WHERE email='$email'";

        if(mysqli_query($conn, $sql)){
            header('location:https://lethhub-2.herokuapp.com/teachers/index.php');
        }
        else{
            echo "err".mysqli_error($conn); 
        }


    }

?>