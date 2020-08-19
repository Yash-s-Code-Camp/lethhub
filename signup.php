<?php $title = "Sign Up"; ?>
<?php include('includes/top.php'); ?>
<h1><?= $title; ?></h1>
<div class="row">
    <div class=" col teacher-signup-panel">
        <h4>Teachers</h4>
        <form action="" method="post">
            <span><small id="err-msg_t"></small></span>
            <div class="formgroup">
                <input type="text" name="t_fname" class="form-control"  id="t_fname" placeholder="First Name*" required>
            </div>
            <div class="form-group">
                <input type="text" name="t_lname" class="form-control"   id="t_lname" placeholder="Last Name*" required>
            </div>
            <div class="form-group">
                <input type="email" name="t_email" class="form-control"   id="t_email" placeholder="Email*" required>
            </div>
            <div class="form-group">
                <input type="text" name="t_mobile" class="form-control"   id="t_mobile" placeholder="Mobile">
            </div>
            <div class="form-group">
                <input type="password" name="t_pass" class="form-control"   id="t_pass" placeholder="Select a password*" required>
            </div>
            <div class="form-group">
                <input type="password" name="t_pass2" class="form-control"   id="t_pass2" placeholder="Re-enter password*" required>
            </div>
                <input type="submit" name="t_signup" class="btn btn-primary" id="t_signup" value="Sign Up">
        </form>
    </div>
<?php
    if(isset($_POST["t_signup"])){
        $fname = $_POST["t_fname"];
        $lname = $_POST["t_lname"];
        $email = $_POST["t_email"];
        $mobile = $_POST["t_mobile"];
        $password = md5($_POST["t_pass"]);
        $sql_insert = "INSERT INTO teachers (firstname, lastname, email, mobile, `password`)
                        VALUES ('$fname', '$lname', '$email', '$mobile', '$password')";
        if(mysqli_query($conn, $sql_insert)) {
            $_SESSION["current_teacher"] = $email;
            header('location:teachers');
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    }
?>
</div>

<script src="js/index.js"></script>
<?php include('includes/footer.php'); ?>