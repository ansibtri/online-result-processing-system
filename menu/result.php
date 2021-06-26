<?php
    $showWarning = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include '../partials/_dbconnect.php';
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM `student_account` WHERE `student_username` = '$username'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($password, $row['student_pass'])){
                    if(session_id() == "" && session_id() == NUll){
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['studentid'] = $row['student_id'];
                        header("Location: resultpage.php");
                    }else{
                        session_unset();
                        session_destroy();
                        $showError = true;
                    }
                }else{
                    $showWarning = true;
                }
            }
        }else{
            $showWarning = true;
        }
    }


?> 






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../utilities.css">
    <link rel="stylesheet" href="result.css">
</head>

<body>
    <?php include '../partials/_nav.php'; ?>
    <?php
    
    if($showWarning){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> Invalid Credentials.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    
    ?> 
    <?php
    
    if($showWarning){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> Try Again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    
    ?> 
    <div class="container xl m-5">
        <h1>Result</h1>
        <p>Result of the final exam has been published.</p>
        <!-- <img src="" alt="notice"> -->
    </div>
    <div class="mx-5">
        <p>Provide your details correctly.</p>
    </div>
    <div class="container m-5 result-form">
        <form action="result.php" method="POST" class="grid grid-3 grid-gap">
            <input type="text" name="username" id="username" placeholder="Enter Username" class="p-2">
            <input type="password" name="password" id="password" maxlength="255" class="p-1" placeholder="Enter Password">
            <button class="p-1">Submit</button>
        </form>
    </div>
  
    <?php include '../partials/_footer.php'; ?>
</body>

</html>