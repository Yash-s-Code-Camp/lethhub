<?php include('header.php');?>
<body>
      

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="index.php">LethHub</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
<?php 
        echo "".isset($_SESSION["current_teacher"])||isset($_SESSION["current_student"]) ? 
            '<li class="nav-item">
                <a href="teachers" class="nav-link">Dashboard</a>
            </li>':
            '<li class="nav-item">
                <a href="login.php" class="nav-link">Login</a>
            </li>
            <li class="nav-item">
                <a href="student_signup.php" class="nav-link">Signup</a>
            </li>';
?>
</ul>
  </div>
</nav>

<div class="container">
    