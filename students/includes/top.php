<?php 
  include('header.php'); 
  $root_url = "http://localhost/lethhub/students/"; 
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
      </div>
    </nav>
    <div class="container">