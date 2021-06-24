<?php
    // defining server 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "school";
    
    // creating connection to database 
    $conn = mysqli_connect($servername,$username,$password,$database);
    if(!$conn){
        die("Error! Failed to connect -->").mysqli_connect_error();
    }
?> 
