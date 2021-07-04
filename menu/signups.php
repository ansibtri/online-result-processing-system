<?php
session_start();
if (!isset($_SESSION['signedup']) && $_SESSION['signedup'] != true && $_SESSION['studentid'] == "" && $_SESSION['studentid'] == NULL) {
    header("Location: ../index.php");
    exit();
}
$showSuccess = false;
$showWarning = false;
$showError = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../partials/_dbconnect.php';
    $father_name = $_POST['fathername'];
    $mother_name = $_POST['mothername'];
    $father_email = $_POST['femail'];
    $mother_email = $_POST['memail'];
    $father_phone = $_POST['fcontact'];
    $mother_phone = $_POST['mcontact'];
    $father_prof = $_POST['fathprof'];
    $mother_prof = $_POST['mothprof'];
    

    $studentid = $_SESSION['studentid'];
    $sql = "SELECT * FROM `parent_details` WHERE `student_id` = '$studentid'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        $showWarning = true;
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `parent_details` (`student_id`, `father_name`, `mother_name`, `father_email`, `mother_email`, `father_phone`, `mother_phone`, `father_profession`, `mother_profession`) VALUES ('$studentid', '$father_name', '$mother_name', '$father_email', '$mother_email', '$father_phone', '$mother_phone', '$father_prof', '$mother_prof');";
        $result = mysqli_query($conn, $sql);
        echo var_dump($result);
        if ($result) {
            header("Location: signout.php");
        } else {
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

    if ($showWarning) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Oich !</strong> Already Exist .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <?php

    if ($showError) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error occured !</strong> Your data is not submitted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <?php

    if ($showSuccess) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Now you can <a href="result.php">login</a>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container">
        <div class="signupform m-5 p-5">
            <h1 class="xl text-center p-1">Parent's Detail</h1>
            <form action="signups.php" method="post">
                <div class="item username grid grid-2">
                    <div class="p-1">
                        <label for="fathername">Father Name:</label>
                        <input type="text" name="fathername" id="fathername" required>
                    </div>
                    <div class="p-1">
                        <label for="mothername">Mother's Name:</label>
                        <input type="text" name="mothername" id="mothername" required>
                    </div>
                </div>
                <div class="item email grid grid-2">
                    <div class="p-1">
                        <label for="femail">Father's Email:</label>
                        <input type="email" name="femail" id="femail" required>
                    </div>
                    <div class="p-1">
                        <label for="memail">Mother's Email:</label>
                        <input type="email" name="memail" id="memail" required>
                    </div>
                    
                </div>
                <div class="item email grid grid-2">
                <div class="p-1">
                        <label for="fcontact">Father's Contact No:</label>
                        <input type="number" name="fcontact" id="fcontact" required>
                    </div>
                    <div class="p-1">
                        <label for="mcontact">Mother's Contact No:</label>
                        <input type="number" name="mcontact" id="mcontact" required>
                    </div>
                </div>
                <div class="item email grid grid-2">
                    <div class="p-1">
                        <label for="fathprof">Father Profession:</label>
                        <input type="text" name="fathprof" id="fathprof" required>
                    </div>
                    <div class="p-1">
                        <label for="mothprof">Mother Profession:</label>
                        <input type="text" name="mothprof" id="mothprof" required>
                    </div>
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