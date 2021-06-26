<?php
    session_start();
    if(!isset($_SESSION['resultsubmit']) && $_SESSION['resultsubmit'] !=true && $_SESSION['studentid'] == ""){
        header("Location: ../index.php");
        exit();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include '../partials/_dbconnect.php';
        $studentid = $_SESSION['studentid'];
        $username = $_POST['username'];
        $useremail = $_POST['email'];
        $password = $_POST['password'];
    }else{
        $sql = "INSERT INTO `student_account` (`student_serial_acc_id`, `student_id`, `student_username`, `student_email`, `student_pass`, `dt`) VALUES ('$studentid', '$username', '$useremail', '$password');";
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Of Education</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../utilities.css">
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <?php include '../partials/_nav.php'; ?>
    <div class="container">
        <div class="signupform m-5 p-5">
            <h1 class="xl text-center p-1">Sign up</h1>
            <form action="signup.php" method="post">
                <div class="item username grid grid-2">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="item email grid grid-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="item password grid grid-2">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="item submit">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../partials/_footer.php'; ?>
</body>

</html>