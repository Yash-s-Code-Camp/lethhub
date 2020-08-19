<?php include('includes/top.php'); ?>

<?php
    if(!isset($_SESSION["current_student"]) ){
            header('location:../');
    }
?>

<?php

    if($_REQUEST["id"]){
        $dl_q = "DELETE from announcement where id=".$_REQUEST["id"];
        $q = mysqli_query($conn, $dl_q);

        if($q){
            header("http:localhost:3000/teachers");
        }
    }
?>