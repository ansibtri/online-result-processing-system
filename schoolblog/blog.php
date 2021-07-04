<?php
    $showWarning = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include '../partials/_dbconnect.php';
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        
        $sql = "SELECT * FROM `student_account` WHERE `student_username` = '$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($password, $row['student_pass'])){
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = "$username";
                    $_SESSION['id'] = $row['student_id'];
                    $showSuccess = true;
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
    <title>School Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../utilities.css">
    <link rel="stylesheet" href="blog.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="blog.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="username"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="text btn btn-success">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php   include '../partials/_dbconnect.php'; ?>
    <?php  include'../partials/_nav.php'; ?>
    <div class="sub-head flex">
    </div>
    <div class="container container-fluid">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <?php
                if(isset($_SESSION['loggedin']) && !empty($_SESSION['username'])){
                    echo "Welcome ".$_SESSION['username'];
                }else{
                   echo' <button type="button" class="text btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </button>';
                }
                ?> 
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Active</a>
              </li>
        </ul>
    </div>
    
    <?php
    
        if($showWarning){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Invalid Credentials.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    
    ?>
    <!-- https://source.unsplash.com/400x300/?nature,water -->
    <h1 class="text-center m-4">Read The Blog Post</h1>
    <div class="container grid grid-card">
        
        <?php
    
    $sql = "SELECT * FROM `blog_data`";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_assoc($result)){
        $postid = $row['sno'];
        $image = $row['post_img'];
        $title = $row['post_title'];
        $desc = $row['post_des'];
        $postedby = $row['posted_by'];
        $open = substr($title, -1).$postid;
        // u will add it to link for making link only after that it wil be replaced
        echo '<div class="card flex flex-c">
        <div class="headimg">
            <img src="'.$image.'" alt="">
        </div>
        <div class="head p-3">
            <a href="blogpage.php?open='.$open.'">
                <h3>'.$title.'</h3>
            </a>
            <p class="text-justify">'.substr($desc,0,90).'....</p>
            ';
            $pby = "SELECT * FROM `student_details` WHERE `student_id` ='$postedby'";
            $pby_result = mysqli_query($conn,$pby);
            while($pby = mysqli_fetch_assoc($pby_result)){
                $fname = $pby['student_name'];
                $lname = $pby['student_surname'];
                $fullname = $fname." ".$lname;
            echo'<span>Posted by: <strong>'.$fullname.'</strong></span>';
            }
            echo'</div>
       
        <div class="button p-2">
        <a href="blogpage.php?open='.$open.'"><button class="btn btn-success">View Post</button></a>
        </div>
    </div>';
    }
    ?>
    </div>
    <?php  include'../partials/_footer.php'; ?>
</body>

</html>