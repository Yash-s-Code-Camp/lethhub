<?php $title = "Manage Class"?>
<?php include('includes/top.php'); ?>

<?php
    if(!isset($_SESSION["current_student"]) ){
            header('location:../');
        }
?>
<?php
    if(isset($_REQUEST["code"])){   

        $class_details="select * from classes where class_code='".$_REQUEST["code"]."'";
        $query=mysqli_query($conn, $class_details);

        $res = mysqli_fetch_assoc($query);
        if($res){    
            $class_id = $res["id"];
            $class_code = $res["class_code"];
            $class_name = $res["class_name"];
            // $teacher_id = $res["teacher_id"];

            $announcements="select * from announcement  where class_id=".$class_id." ORDER BY created_on DESC";
            $query=mysqli_query($conn, $announcements);        

            if(mysqli_num_rows($query)>0){
                while($rs = mysqli_fetch_assoc($query)){

                    echo "<div class=\"card mb-3\">
                            <div class=\"card-body\">
                                <h4 class=\"card-title\">".$rs["title"]."</h4>
                                <h6 class=\"card-subtitle mb-2 text-muted\">".$rs["created_on"]."</h6>
                                <p class=\"card-text\">".$rs["msg"]."</p>
                                <a href=\"https://lethhub-2.herokuapp.com/teachers/uploads/".$rs["attachment"]."\" class=\"card-link\">".$rs["attachment"]."</a>
                            </div>
                        </div>";
                }
            }
            else{
                echo "no announcements";
            }
        
        


        }
    }
?>
