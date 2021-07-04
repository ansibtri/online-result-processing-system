<?php


    session_start();
    $_SESSION['loggedin'] = false;
    $_SESSION['username'] = "";
    session_unset();
    session_destroy();
    header("Location: blog.php");
    exit();
?> 