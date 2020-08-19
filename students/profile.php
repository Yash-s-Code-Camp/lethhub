<?php $title = "Profile"?>
<?php include('includes/top.php'); ?>
<?php
   // session_start();

    if(!isset($_SESSION["current_student"]) ){
        header('location:../');
    }
?>


<?php

	$sql_profile = "SELECT * FROM `students` WHERE `email`='".$_SESSION["current_student"]."' ";
	$query = mysqli_query($conn, $sql_profile);
	$res = mysqli_fetch_assoc($query);

	$fname = $res["firstname"];
	$lname = $res["lastname"];
	$mobile = $res["mobile"];
	$email = $res["email"];

	

?>

<div class="row">
	<div class="col">
		<h3>Update Profile</h3>
<form method="POST">
	<div class="form-group">
		<label for="fname">First Name</label><br>
	<input type="text" name="fname" class="form-control" id="fname" value="<?php echo $fname;?>">
	</div>
	<div class="form-group">
		<label for="lname">Last Name</label><br>
	<input type="text" name="lname" class="form-control" id="lname" value="<?php echo $lname;?>">
	</div>
	<div class="form-group">
		<label for="mobile">Mobile</label><br>
	<input type="text" name="mobile" class="form-control" id="mobile" value="<?php echo $mobile;?>">
	</div>
	<div class="form-group">
		<label for="email">Email</label><br>
	<input type="text" name="email" class="form-control" id="email" readonly="true" value="<?php echo $email;?>">
	</div>
	

	<input type="submit" class="btn btn-success" name="update" value="Update">
</form>



	<?php 
		if(isset($_POST["update"])){
			$sql_update = "UPDATE `students` SET `firstname`='".$_POST["fname"]."',
											`lastname`='".$_POST["lname"]."',
											`mobile`='".$_POST["mobile"]."' WHERE `email`='".$_SESSION["current_student"]."'";

		$query = mysqli_query($conn, $sql_update);
		if($query){
			// echo "<script>alert('Profile Updated...');</script>";
			header("location:https://lethhub-2.herokuapp.com/students/profile.php");

		}else{
			echo "Err... ".mysqli_error($conn);
		}
		}
	 ?>

	</div>
	

<div class="col">
	<h3>Change Password</h3>
<form method="POST">
	<div class="form-group">
		<label for="old_pass">Old Password</label><br>
	<input type="password" class="form-control" name="old_pass" id="old_pass">
	</div>	
	<div class="form-group">
		<label for="new_pass">New Password</label><br>
	<input type="password" class="form-control" name="new_pass" id="new_pass">
	</div>

	<input type="submit" class="btn btn-danger" name="change" value="Change">
</form>

<?php 
	if(isset($_POST["change"])){
		$old_pass_db = $res["password"];
		$old_pass_form = md5($_POST["old_pass"]);
		$new_pass = md5($_POST["new_pass"]);
		
		if(strcmp($old_pass_db, $old_pass_form)!=0){
			echo "You must remember your old password.";
		}else{
			$change_pass = "UPDATE `students` SET `password`='$new_pass' WHERE `email`='".$_SESSION["current_student"]."'";
			if(mysqli_query($conn, $change_pass)){
				echo "<script>alert('Password Changed...')</script>";
			}
			else{
				echo "error. ".mysqli_error();
			}
		}
	}
	
 ?>

</div>

</div>



<?php include('includes/footer.php'); ?>

