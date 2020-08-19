<?php $title = "Student Profile"?>
<?php include('includes/top.php'); ?>

<?php
    if(isset($_REQUEST["email"])){
        $student_email =  $_REQUEST["email"];

        $sql_student = "SELECT * FROM students WHERE `email`='".$student_email."'";
        $result_c = mysqli_query($conn, $sql_student);
        if (mysqli_num_rows($result_c) > 0) {
            // output data of each row
            $student = mysqli_fetch_assoc($result_c);
        } else {
            echo "0 results";
        }
    }
?>

<div class="profile">
    <h2>Profile</h2> 
    Name: <?= $student["firstname"]." ".$student["lastname"]; ?>    <br>   
    Email: <?= $student["email"]; ?>       <br>
    Mobile: <?= $student["mobile"]; ?>        <br>
    Joined: <?= $student["reg_date"]; ?>        <br>
</div>