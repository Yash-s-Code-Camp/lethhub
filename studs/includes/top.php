<?php session_start(); ?>
<?php include('header.php'); ?>
<?php $root_url = "https://lethhub-2.herokuapp.com/studs/"?>

<?php
    // if(isset($_SESSION["current_teacher"]) ){
    //     header('location:https://lethhub-2.herokuapp.com/teachers');
    // }
    // if(isset($_SESSION["current_student"])){
    //     header('location:https://lethhub-2.herokuapp.com/students');
    // }
?>


<body>
    

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="index.php">LethHub</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?=$root_url?>index.php">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=$root_url?>profile.php">Profile</a>
      </li>
      <li class="nav-item">
      	<a class="nav-link" href="<?=$root_url?>logout.php">Log out</a>
      </li>
    </ul>

<!-- 
    <form action="" class="form-inline my-2 my-lg-0" method="post">
         <span><small id="err-msg_s"></small></span>
                                            
            <input type="email" class="form-control mr-sm-2" name="s_email" id="s_email" placeholder="Email*" required>
                                               
            <input type="submit" class="btn btn-secondary my-2 my-sm-0" name="s_add" id="s_add" value="Add Student"> 
                </form> -->
  </div>
</nav>
    <div class="container">
    