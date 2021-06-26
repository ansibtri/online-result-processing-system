<?php
    session_start();
    $_SESSION['resultsubmit'] = false;
    $_SESSION['studentid'] = "";
    session_unset();
    session_destroy();
    header("Location: result.php");
    exit();
?> 