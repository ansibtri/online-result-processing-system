<?php
    $show = false;
    $showlogout = false;
    session_start();
    if(!isset($_SESSION['loggedin']) && empty($_SESSION['username']) && $_SESSION['username'] == "" && $_SESSION['loggedin'] != true){
        $show = true;
    }else   {
        $showlogout = true;
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['cmnt'])){
            $postedby = $_POST['cmnt'];
            $comment = $_POST['comment'];
            $id = $_GET['open'];
            $openid = substr($id,1,strlen($id));
            $sql = "INSERT INTO `blog_comment` (`comment_content`, `blog_sno`, `cmnt_by`) VALUES ('$comment', '$openid', '$postedby')";
        }else{
            include '../partials/_dbconnect.php';
            $title = $_POST['title'];
            $content = $_POST['desc'];
            $id = $_SESSION['id'];
            if(isset($_FILES['img'])){
                $file_name = $_FILES['img']['name'];
                $file_size = $_FILES['img']['size'];
                $file_tmp = $_FILES['img']['tmp_name'];
                $file_type = $_FILES['img']['type'];
            
                $upload_dir = "img/";
                $file = $upload_dir.$file_name;
                if(file_exists($file)){
                    echo "Already Exist";
                }else{
                    move_uploaded_file($file_tmp,$upload_dir.$file_name);
                    $sql = "INSERT INTO `blog_data` (`post_title`, `post_des`, `post_img`, `posted_by`) VALUES ('$title', '$content', '$file','$id')";
                     $result = mysqli_query($conn,$sql);
                    if(!$result){
                        echo "Result Insertion Failed";
                    }else{
                    echo "Successfully Inserted";
                    }
                }
            
            }else{
                echo "Image required";
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
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../utilities.css">
    <link rel="stylesheet" href="blog.css">
</head>

<body>
    <?php include'../partials/_dbconnect.php'; ?>
    
    <?php include'../partials/_nav.php'; ?>

    <div class="container">
        <?php
        if($show){
            echo '<p class="text-center"> Login to Create Your own Blog Post</p>';
        }else{
            if($showlogout){
             echo '<div class="container">
                    <a href="logout.php">Logout</a></div>';
        }
            echo'<div class="container">
            <h1>Make your own Blog Post.</h1>
            <form action="blogpage.php?open='.$_GET['open'].'" enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="text" class="form-label">Title</label>
                    <input type="text" class="form-control" id="text" name="title" placeholder="Title" required>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Content</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Upload Post related Image</label>
                    <input type="file" class="form" id="img" name="img" required>
                </div>
                <div class="mb-3">
                    <button class="btn hbutton btn-success">Submit</button>
                </div>
            </form>
        </div>';
        
        }
    ?>
        
    </div>
    <div class="container flex flex-c">
        <?php
        $id = $_GET['open'];
        $openid = substr($id,1,strlen($id));
        $sql = "SELECT * FROM `blog_data` WHERE `sno` = '$openid'";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $title = $row['post_title'];
            $postedby = $row['posted_by'];
            $postimage = $row['post_img'];
            $desc = $row['post_des'];
            $postedon = date_create($row['posted_on']);

            $postdate = date_format($postedon,"Y/m/d");
            echo '
            <div class="card p-5">
            <div class="title p-1 lg">
                <h2 class="text-center">'.$title.'</h2>
            </div>
            <div class="writer m-1">
                <p>Date: '.$postdate.'</p>';
                $pby_sql = "SELECT * FROM `student_details` WHERE `student_id` = '$postedby'";
                $pby_result = mysqli_query($conn,$pby_sql);
                while($prow = mysqli_fetch_assoc($pby_result)){
                    $fname = $prow['student_name'];
                    $lname = $prow['student_surname'];
                    $postedby = $fname." ".$lname;
                    echo'
                <p class="">Posted by: <strong class="text-right"><em>'.$postedby.'</em></strong> </p>';
                }
                
            echo'</div>
            <div class="img list-item">
                <img src="'.$postimage.'" alt="">
            </div>
            <div class="writing text-justify">
                <p>'.$desc.'</p>
            </div>
        </div>';
        }
        ?>

    </div>
    <div class="comment-section container">
        <h1 class="mx-4">Comments</h1>
        <?php
        if(isset($_SESSION['loggedin']) && empty($_SESSION['username']) && $_SESSION['username'] == "" && $_SESSION['loggedin'] != true){
            echo '<p class="text-center"> Login to Comment on Blog Post</p>';
        }else{
            $id = $_SESSION['id'];
            echo'<div class="container p-4">
            <form action="blogpage.php?open='.$_GET['open'].'" method="post">
            <input type="hidden" name="cmnt" value = "'.$id.'" required>
                <div class="mb-3">
                    <label for="comment" class="form-label">Write your comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn hbutton btn-success">Submit</button>
                </div>
            </form>
        </div>';
        }
    ?>
 
        <div class="cmt-user grid p-4">
                <?php

$id = $_GET['open'];
$openid = substr($id,1,strlen($id));
$sql = "SELECT * FROM `blog_comment` WHERE `blog_sno` = '$openid'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    $comment = $row['comment_content'];
    $postedon = date_format(date_create($row['cmnt_dt']),"Y/m/d");
    $commentby = $row['cmnt_by'];

    $cmtr_detail = "SELECT * FROM `student_account` WHERE `student_id` = '$commentby'";
    $cmtr_result = mysqli_query($conn,$cmtr_detail);
    while($cmtr = mysqli_fetch_assoc($cmtr_result)){
        $username = $cmtr['student_username'];
        echo ' <div class="cmnt-container card">
                <div class="user grid grid-p-3 grid-gap">
                    <img class="border-radius-50"
                        src="assets/stu_pic/png-clipart-male-portrait-avatar-computer-icons-icon-design-avatar-flat-face-icon-people-head.png"
                        alt="">
                    <h4>'.$username.'</h4>
                    <span>at '.$postedon.'</span>
                </div>
                <div class="comment text-justify p-4">
                    '.$comment.'
                </div>
            </div>
             ';
    }
}
    
    
    ?>
           
        </div>
    </div>
    <?php include'../partials/_footer.php'; ?>
</body>

</html>