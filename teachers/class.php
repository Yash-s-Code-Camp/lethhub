<?php
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;
?>


<?php $title = "Manage Class"?>
<?php include('includes/top.php'); ?>

<?php
    if(!isset($_SESSION["current_teacher"]) ){
            header('location:../');
        }
?>





<?php
    function sendEmail($sub, $emails, $code){

// Load Composer's autoloader
require '../vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'lethhub@gmail.com';                     // SMTP username
    $mail->Password   = 'kirtan123';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('lethhub@gmail.com', 'LethHub');
    
    foreach($emails as $email)
    {
        $mail->addAddress($email);
    }
   
    $mail->addCC($_SESSION["current_teacher"]);
    
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = "Check your dashboard...<a href=\"http://localhost/lethhub/login.php\">LethHub Dashboard</a>";

   if(!$mail->send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Message has been sent successfully";
    }
}
?>
<?php
    if(isset($_REQUEST["id"])){
        $class_id =  $_REQUEST["id"];

        $sql_class = "SELECT * FROM classes WHERE id=".$class_id;
        $result_c = mysqli_query($conn, $sql_class);
        if (mysqli_num_rows($result_c) > 0) {
            // output data of each row

            $class = mysqli_fetch_assoc($result_c);
       
?>

<div class="row">
    <div class="col-sm-2 add_student_to_class">
        <div>
            <h3><?= $class["class_name"]; ?></h3>
                <form action="" method="post">
                    <span><small id="err-msg_s"></small></span>
                    <div class="form-group">                        
                            <input type="email" class="form-control" name="s_email" id="s_email" placeholder="Email*" required>
                    </div>                             
                    <input type="submit" class="btn btn-primary" name="s_add" id="s_add" value="Add Student"> 
                </form>
        </div>
        
    </div>
    <?php 

        if(isset($_POST["s_add"])){
            $email = $_POST["s_email"];
            $class_name = $class["class_name"];
            $class_code = $class["class_code"];
            $sql_insert = "INSERT INTO class_student (class_name, class_code, email)
                            VALUES ('$class_name', '$class_code', '$email')";
            // echo $sql_insert;
            if (mysqli_query($conn, $sql_insert)) {
                echo "<script>alert('Student ".$email." added')</script>";               

            } else {
                echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
            }
        }
    ?>
    
    <div class="col-md-6 create_announcement">
        <h3>Announcements</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" placeholder="Subject" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="msg">Message</label><br>
                <textarea class="form-control"  col="600" rows="10" name="msg" id="msg">This is to inform you...</textarea>
            </div>
            <div class="form-group">
                <label for="fileToUpload">Attachment</label>
                <input class="form-control"  type="file" name="fileToUpload" id="fileToUpload">
            </div>           
                <input type="submit" class="btn btn-primary" name="announce" value="Announce"><br>
            </form>
        </div>
        <div class="col">
            <table class="table table-hover">
                <tr>
                    <th>Title</th><th>Message</th><th>Attachment</th><th></th>
                </tr>

                <?php
                    $sql_ann="select * from announcement ORDER BY created_on DESC";
                    
                    $q = mysqli_query($conn, $sql_ann);

                    if(mysqli_num_rows($q)>0){
                        while($a = mysqli_fetch_assoc($q)){
                            echo "
                        
                            <tr>
                                <td>".$a["title"]."</td><td>".$a["msg"]."</td>
                                <td><a href=\"http://localhost/lethhub/teachers/uploads/".$a["attachment"]."\">
                                    ".$a["attachment"]."
                                    </a>
                                </td>
                                <td>
                                    <a class=\"float-sm btn btn-sm btn-danger\" href=\"http://localhost/lethhub/teachers/delete_ann.php/?id=".$a["id"]."\">X</a>
                                </td>
                            </tr>
                        
                        ";
                        }
                    }
                    else{
                        echo "no announcemets.";
                    }
                    
                ?>
            

            </table>
        </div>
</div>
<hr>
        <?php
            if(isset($_POST["announce"])){
                $class_id=$_REQUEST['id'];
                $class_name;
                $email=$_SESSION['current_teacher'];
                $title=$_POST["title"];
                $msg=$_POST["msg"];


                //uploader preferences
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $filename = basename( $_FILES["fileToUpload"]["name"]);
                $uploadOk = 1; //falg
                $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                echo $fileType;


                // Allow certain file formats
                if($fileType != "docx" && $fileType != "pdf" && $fileType != "jpg" && $fileType != "png" && $fileType != "jpeg"
                && $fileType != "gif" ) {
                  echo "Sorry, only DOCX, PDF, JPG, JPEG, PNG & GIF files are allowed.";
                  $uploadOk = 0;
                }

                if (file_exists($target_file)) {
                  echo "Sorry, file already exists.";
                  $uploadOk = 0;
                }
                if ($_FILES["fileToUpload"]["size"] > 50000000) {   //50 MB
                  echo "Sorry, your file is too large.";
                  $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                  echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                  } else {
                    echo "Sorry, there was an error uploading your file.";
                  }
                }

                $sql_teacher_name="select firstname from teachers where  email='$email'";
                $sql_class_name="select class_name from classes where  id=".$_REQUEST["id"];

                $q = mysqli_query($conn, $sql_class_name);
                $res2 = mysqli_fetch_assoc($q);

                if($res2){
                    $class_name = $res2["class_name"];
                }

                $query=mysqli_query($conn,$sql_teacher_name);
                $res=mysqli_fetch_assoc($query);
                if($res){

                    $t_name=$res["firstname"];
                    $sql_announce="insert into announcement (class_id,class_name,teacher_name,title,msg, attachment) values($class_id,'$class_name','$t_name','$title','$msg', '$filename')";

                
                    if(mysqli_query($conn, $sql_announce)){
                         $fetch_students = "select * from `class_student` WHERE `class_code`=(select `class_code` from classes where `id`=$class_id) ";

    $query = mysqli_query($conn, $fetch_students);
    
    $emails_rec = array();

    if(mysqli_num_rows($query)>0){
        while($res = mysqli_fetch_array($query)){
            echo $res["email"]."<br>";
            array_push($emails_rec, $res["email"]);

            $class_code = $res["class_code"];
            $subject = "New Announcement From ".$res["class_name"]; 
            sendEmail($subject, $emails_rec, $class_code);

        }
    }else{
        echo "0 records...";
}                        
        header('location:class.php/?id='.$_REQUEST["id"]);
    }
    else{
        echo "error..." . mysqli_error();
        echo "\n$sql_announce";
    } 
}
else{
    echo"err";
}

}
?>


    <table  class="table table-hover">
            <thead>
                <tr>
                    <th>Remove Student</th><th>Class</th><th>Code</th><th>Email</th><th>Profile</th>
                </tr>
            </thead>
            <tbody>
    <?php
        $sql_class = "SELECT * FROM class_student WHERE `class_code`=(SELECT `class_code` FROM classes WHERE `id`=".$_REQUEST["id"].")";
        $result_c = mysqli_query($conn, $sql_class);
        if (mysqli_num_rows($result_c) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result_c)) {
                echo  "<tr>
                <td> <a href=\"delete.php/?email=".$row["email"]."\">X </a>"."</td>
                <td>".$row["class_name"]."</td>
                <td>".$row['class_code']."</td>
                <td>".$row['email']."</td>
                <td><a href=\"student_profile.php?email=".$row["email"]."\">See</a></td>
                </tr>";
            }
        } else {
            echo "0 results";
        }
    ?>
        
               
            </tbody>
        </table>




<?php     
    $class_id = $_REQUEST["id"];
    $current_teacher = $_SESSION["current_teacher"];
 ?>

<?php include('includes/footer.php'); ?>

<?php
 } else {
    echo "0 results";
}
}

?>