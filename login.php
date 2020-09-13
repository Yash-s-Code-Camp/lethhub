<?php $title = "Login"?>
<?php include('includes/top.php'); ?>

<?php 
    if(isset($_SESSION["current_teacher"])){
        header("location:http://localhost/lethhub/teachers");
    }
    if(isset($_SESSION["current_student"])){
        header("location:http://localhost/lethhub/students");
    }

?>


    <h1><?=$title?></h1>

    <div class="row">
         <div class=" col teacher-login-panel">

    <h4 class="text-muted">Teachers</h4>
        <form action="" method="post">
            <span><small id="err-msg"></small></span>
            <div class="form-group">
                <label for="t_email">Email</label>
                <input type="email" name="t_email" id="t_email" class="form-control" placeholder="Email*" required>
            </div>
            <div class="form-group">
                <label for="t_pass">Password</label>
                <input type="password" name="t_pass" id="t_pass" class="form-control" placeholder="Pasword" required>
            </div>
            
            
            <input type="submit" name="t_login" id="t_login" class="btn btn-primary" value="Login">
        </form>
    </div>
<?php 

        if(isset($_POST["t_login"])){
            $email = $_POST["t_email"];
            $password = md5($_POST["t_pass"]);
            $sql_login = "SELECT * FROM teachers WHERE `email`='$email' AND `password`='$password'";

           // echo $sql_login;
            $query = mysqli_query($conn, $sql_login);
            $res=mysqli_num_rows($query);
            
            //If result match $username and $password Table row must be 1 row
            if($res == 1)
            {
                $_SESSION["current_teacher"] = $email;
               // echo "<br>logged in";
                header("Location:teachers/index.php");
            }
            else
            {
                echo "<br>Invalid Username or Password";
            }
        }
?>
<hr>
    <div class="col student-login-panel">
    <h4 class="text-muted">Students</h4>

        <form action="" method="post">
            <span><small id="err-msg"></small></span>
             <div class="form-group">
                <label for="s_email">Email</label>
                <input type="email" name="s_email" class="form-control" id="s_email" placeholder="Email*" required>
            </div>
            <div class="form-group">
                <label for="s_pass">Password</label>
                <input type="password" name="s_pass" class="form-control" id="s_pass" placeholder="Pasword" required>
            </div>
             <input type="submit" name="s_login" class="btn btn-primary" id="s_login" value="Login">
            
        </form>
    </div>
<?php 

        if(isset($_POST["s_login"])){
            $email = $_POST["s_email"];
            $password = md5($_POST["s_pass"]);
            $sql_login = "SELECT * FROM students WHERE `email`='$email' AND `password`='$password'";

            //echo $sql_login;
            $query = mysqli_query($conn, $sql_login);
            $res=mysqli_num_rows($query);
            
            //If result match $username and $password Table row must be 1 row
            if($res == 1)
            {
                
                $_SESSION["current_student"] = $email;
                //echo "<br>logged in";
                header("Location:students/index.php");
            }
            else
            {
                echo "<br>Invalid Username or Password";
            }
        }
?>
</div>

   
<?php include('includes/footer.php'); ?>

