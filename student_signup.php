<?php $title = "Sign Up"; ?>
<?php include('includes/top.php'); ?>
<h1><?= $title; ?></h1>
<div class="row">
    <div class="col ">
        <a class="btn btn-primary" href="signup.php">Are you a teacher?</a>
    </div>
     <div class=" col student-signup-panel">
        <h4>students</h4>
        <form action="" method="post">
            <span><small id="err-msg_s"></small></span>
            <div class="formgroup">
                <input type="text" name="s_fname" class="form-control"  id="s_fname" placeholder="First Name*" required>
            </div>
            <div class="form-group">
                <input type="text" name="s_lname" class="form-control"   id="s_lname" placeholder="Last Name*" required>
            </div>
            <div class="form-group">
                <input type="email" name="s_email" class="form-control"   id="s_email" placeholder="Email*" required>
            </div>
            <div class="form-group">
                <input type="text" name="s_mobile" class="form-control"   id="s_mobile" placeholder="Mobile">
            </div>
            <div class="form-group">
                <input type="password" name="s_pass" class="form-control"   id="s_pass" placeholder="Select a password*" required>
            </div>
            <div class="form-group">
                <input type="password" name="s_pass2" class="form-control"   id="s_pass2" placeholder="Re-enter password*" required>
            </div>
                <input type="submit" name="s_signup" class="btn btn-primary" id="s_signup" value="Sign Up">
        </form>
    </div>
<?php
    if(isset($_POST["s_signup"])){
        $fname = $_POST["s_fname"];
        $lname = $_POST["s_lname"];
        $email = $_POST["s_email"];
        $mobile = $_POST["s_mobile"];
        $password = md5($_POST["s_pass"]);
        $sql_insert = "INSERT INTO students (firstname, lastname, email, mobile, `password`)
                        VALUES ('$fname', '$lname', '$email', '$mobile', '$password')";
        if(mysqli_query($conn, $sql_insert)) {
            $_SESSION["current_student"] = $email;
            header('location:students');
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    }
    ?>
</div>
<script src="js/index.js"></script>
<?php include('includes/footer.php'); ?>