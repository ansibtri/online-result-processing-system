<?php

$showAlert = false;
$showError = false;
$showWarning = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../partials/_dbconnect.php';
    $studentid = $_POST['studentid'];
    $fname = $_POST['fname'];
    $lname = $_POST['surname'];
    $dob = $_POST['dob'];
    $class = $_POST['class'];
    $caddress = $_POST['clocation'];
    $plocation = $_POST['plocation'];
    $section = $_POST['section'];
    $phone = $_POST['phone'];
    $fullname = $fname." ".$lname;




    $sql = "SELECT * FROM `student_details` WHERE `student_id` = '$studentid'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        $showWarning = true;
    }else{
        $sql = "INSERT INTO `student_details` (`student_id`, `student_name`, `student_surname`, `student_dob`, `student_class`, `student_current_location`, `student_permanent_address`, `student_contact`, `student_class_section`) VALUES ('$studentid','$fname', '$lname', '$dob', '$class', '$caddress', '$plocation', '$phone', '$section')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
            session_start();
            $_SESSION['resultsubmit'] = true;
            $_SESSION['studentid'] = $studentid;
            header("Location: signup.php");
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../utilities.css">
    <link rel="stylesheet" href="admission.css">
    
</head>

<body>
    <?php include '../partials/_nav.php'; ?>
    <?php

    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> You Data has been submitted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    ?>
    <?php
    
    if($showError){
        echo '<div class="alert alert-error alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> Error occured.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    
    ?> 
    <?php
    
    if($showWarning){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Sorry!</strong> Student ID already exist.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    
    ?> 
    <div class="container">
        <form action="admission.php" method="post">
            <div class="detail grid grid-2 stuid">
                <label for="studentid">Student ID:</label>
                <input required type="text" name="studentid" id="student_id">
            </div>
            <div class="detail grid grid-2 grid-gap p-1">
                <div class="firstname grid-2 grid  grid-gap m-1">
                    <label for="fname">FirstName:</label>
                    <input required type="text" name="fname" id="fname" placeholder="Enter Firstname">
                </div>
                <div class="lastname grid-2 grid grid-gap m-1">
                    <label for="surname">Lastname:</label>
                    <input required type="text" name="surname" id="surname" placeholder="Enter Lastname">
                </div>
            </div>
            <div class="detail grid grid-2 px-1">
                <div class="dob grid-2 grid grid-gap m-1">
                    <label for="dob">Date of Birth:</label>
                    <input required type="date" name="dob" id="dob">
                </div>
                <div class="grade grid-2 grid grid-gap m-1">
                    <label for="class">Class:</label>
                    <input required type="number" name="class" id="class" placeholder="Class">
                </div>
            </div>
            <div class="detail grid grid-2">
                <div class="currentlocation grid-2 grid m-1 grid-gap">
                    <label for="clocation">Current Address:</label>
                    <input required type="text" name="clocation" id="clocation">
                </div>
                <div class="permlocation grid-2 grid grid-gap m-1">
                    <label for="plocation">Permanent Address:</label>
                    <input required type="text" name="plocation" id="plocation">
                </div>
            </div>
            <div class="detail grid grid-2">
                <div class="classsection grid-2 grid grid-gap m-1">
                    <label for="Section">Section:</label>
                    <select name="section" id="section">
                        <option value="A">A</option>
                        <option value="B">B</option>
                    </select>
                </div>
                <div class="stucontact grid-2 grid grid-gap m-1">
                    <label for="phone">Phone no:</label>
                    <input required type="tel" name="phone" id="phone">
                </div>
            </div>
            <div class="detail grid grid-2 grid-gap m-1">
                <input type="reset" value="Reset">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
    <?php include '../partials/_footer.php' ?>
</body>

</html>