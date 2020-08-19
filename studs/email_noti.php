<?php 

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


 ?>


<?php $title = "Profile"?>
<?php include('includes/top.php'); ?>
<?php
   // session_start();

    if(!isset($_SESSION["current_teacher"]) ){
        header('location:../');
    }
?>
<?php include('includes/footer.php'); ?>
