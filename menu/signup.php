<?php
    session_start();
    if(!isset($_SESSION['signedup']) && $_SESSION['signedup'] !=true && $_SESSION['studentid'] == "" && $_SESSION['studentid'] == NULL && empty($_SESSION['studentid']) == true){
        header("Location: ../index.php");
        exit();
    }
    $showSuccess = false;
    $showWarning = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include '../partials/_dbconnect.php';
        $studentid = $_SESSION['studentid'];
        $username = $_POST['username'];
        $useremail = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `student_account` WHERE `student_username` = '$username'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            $showWarning = true;
        }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `student_account` (`student_id`, `student_username`, `student_email`, `student_pass`) VALUES ('$studentid', '$username', '$useremail', '$password');";
            $result = mysqli_query($conn,$sql);
            if($result){
                $_SESSSION['resultsubmit'] = true;
                $_SESSION['studentid'] = $studentid;
                header("Location: signups.php");
            }else{
                $showError = true;
            }

        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Of Education</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../utilities.css">
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <?php include '../partials/_nav.php'; ?>
    <?php
    
    if($showWarning){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oich !</strong> Username Already Exists.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>  
    <?php
    
    if($showError){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error occured !</strong> Your data is not submitted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <?php
    
    if($showSuccess){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Now you can <a href="result.php">login</a>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?> 
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