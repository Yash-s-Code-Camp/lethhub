<?php 
    $title = "Dashboard";
    include('includes/top.php'); 
    if(!isset($_SESSION["current_teacher"]) ){
        header('location:http://localhost/lethhub/login.php');
    }
    $current_teacher = $_SESSION['current_teacher'];
    $sql_teacher = "SELECT * FROM teachers WHERE `email`='$current_teacher'";

    $result_t = mysqli_query($conn, $sql_teacher);

    // Associative array
    $teacher = mysqli_fetch_assoc($result_t);
    
?>


    <h1><?=$title?></h1>
    <p><?="Welcome, ".$teacher["firstname"]." ".$teacher["lastname"] ?></p>

    <div class="add-classes">
    <h4>Classes</h4>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Class Name e.g. TY B.Sc. (Java)" name="class_name" id="class_name" required>
            </div>
            
            <input type="submit" class="btn btn-primary" value="Add Class" name="add_class">
        </form>
    </div>

    
    <?php
        require('functions.php');
        if(isset($_POST["add_class"])){
            $teacher_id = $teacher["id"];
            $class_name = $_POST["class_name"];
            $class_code = classCode(6);
            
            echo "Generated Class Code - ".$class_code;
            $sql_code = "INSERT INTO classes (teacher_id, class_name, class_code)
                            VALUES ($teacher_id, '$class_name', '$class_code')";
            //echo $sql_insert;
            if (mysqli_query($conn, $sql_code)) {
                echo "<script>alert('Class created!')</script>";
            } else {
                echo "Error: " . $sql_code . "<br>" . mysqli_error($conn);
            }
    }
    ?>


    <hr>
    <div class="classes">
    <table  class="table table-hover">
            <thead>
                <tr>
                    <th>Class</th><th>Code</th><th></th>
                </tr>
            </thead>
            <tbody>
    <?php
        $sql_class = "SELECT * FROM classes WHERE `teacher_id`=".$teacher["id"];
        $result_c = mysqli_query($conn, $sql_class);
        if (mysqli_num_rows($result_c) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result_c)) {
                echo  "<tr>
                <td>".$row["class_name"]."</td>
                <td>".$row['class_code']."</td>
                <td><a class=\"btn btn-success float-md-right\" href=\"http://localhost/lethhub/teachers/class.php?id=".$row["id"]."\">Manage</a></td>
                </tr>";
            }
        } else {
            echo "0 results";
        }
    ?>
        
               
            </tbody>
        </table>
    </div>

<?php include('includes/footer.php'); ?>

