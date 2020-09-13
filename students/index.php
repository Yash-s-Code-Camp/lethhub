

<?php 
    $title = "Dashboard";
?>
<?php include('includes/top.php'); ?>
<?php
    //include('includes/top.php');
    if(!isset($_SESSION["current_student"]) ){
        header('location:http://localhost/lethhub/login.php');
    }
    $current_student = $_SESSION['current_student'];
    $sql_student = "SELECT * FROM students WHERE `email`='$current_student'";

    $result_s = mysqli_query($conn, $sql_student);

    // Associative array
    $student = mysqli_fetch_assoc($result_s);    
?>

<h1><?=$title?></h1>
<p><?="Welcome, ".$student["firstname"]." ".$student["lastname"] ?></p>
<div class="row">
    <div class="col-lg-2 join-class">
        <h4>Classes</h4>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Paste your class code..." name="class_code" id="class_code" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Join Class" name="join_class">
            </form>
    </div>
<?php
    if(isset($_POST["join_class"])){
        $class_code = $_POST["class_code"];
        $email = $current_student;

        $sql_class_name =  "SELECT class_name FROM  classes WHERE class_code='$class_code'" ;
        $query = mysqli_query($conn, $sql_class_name);
        $res=mysqli_fetch_assoc($query);
        if($res){
            $class_name = $res["class_name"];
            $sql_code = "INSERT INTO class_student (class_name, class_code, email)
                        VALUES ('$class_name', '$class_code', '$email')";
            
            if (mysqli_query($conn, $sql_code)) {
                echo "<script>alert('Class joined!')</script>";
            } else {
                echo "Error: " . $sql_code . "<br>" . mysqli_error($conn);
            }
        }
        else{
            echo "<br>Invalid class code.";
        }          
    }
?>    
    <div class="col classes">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Go to Class</th><th>Class</th><th>Code</th>
                </tr>
            </thead>
            <tbody>
<?php
    $sql_class = "SELECT * FROM class_student WHERE `email`='$current_student'";
    $result_c = mysqli_query($conn, $sql_class);
    if (mysqli_num_rows($result_c) > 0) {
            // output data of each row
        while($row = mysqli_fetch_assoc($result_c)) {
            echo  "<tr><td><a href=\"http://localhost/lethhub/students/class.php/?code=".$row["class_code"]."\">Go</a></td><td>".$row["class_name"]."</td><td>".$row['class_code']."</td></tr>";
        }
    } else {
        echo "0 results";
    }
?>         
            </tbody>
        </table>
    </div>

</div>    
<?php include('../includes/footer.php'); ?>