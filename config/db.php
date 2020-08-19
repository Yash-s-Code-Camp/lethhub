<?php
       $servername = "bdbea5kavhi6xe2mmppl-mysql.services.clever-cloud.com";
       $username = "urcgdxhu3gk6xvng";
       $password = "142Lyur1bTqcwPrNvpnO";
   
       $dbname = "bdbea5kavhi6xe2mmppl";

// Create connection
    $conn = mysqli_connect($servername, $username, $password);
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

// Create database
    $sql_db = "CREATE DATABASE IF NOT EXISTS ".$dbname;
    if (mysqli_query($conn, $sql_db)) {
    //echo "Database created successfully";
    } else {
        echo "Error creating database: " . mysqli_error($conn);
    }

    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

$sql_teacher = "CREATE TABLE IF NOT EXISTS teachers (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    mobile VARCHAR(50),
    `password` VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
if (mysqli_query($conn, $sql_teacher)) {
    //echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql_student = "CREATE TABLE IF NOT EXISTS students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    mobile VARCHAR(50),
    `password` VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
if (mysqli_query($conn, $sql_student)) {
    //echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql_class_student = "CREATE TABLE IF NOT EXISTS class_student(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(30) NOT NULL,
    class_code VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
if (mysqli_query($conn, $sql_class_student)) {
    //echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

$sql_class = "CREATE TABLE IF NOT EXISTS classes (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT(6),
    class_name VARCHAR(30) NOT NULL,
    class_code VARCHAR(30) NOT NULL,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
if (mysqli_query($conn, $sql_class)) {
    //echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

//creation query for announce table
$sql_class = "CREATE TABLE IF NOT EXISTS announcement (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    class_id INT(6),
    class_name VARCHAR(30) NOT NULL,
    teacher_name VARCHAR(30) NOT NULL,
    title VARCHAR(30) NOT NULL,
    msg TEXT NOT NULL,
    attachment VARCHAR(255),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
if (mysqli_query($conn, $sql_class)) {
    //echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
?>