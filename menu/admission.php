<?php
    

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include '../partials/_dbconnect.php';
        $fname = $_POST['fname'];
        $lname = $_POST['surname'];
        $dob = $_POST['dob'];
        $class=$_POST['class'];
        $caddress=$_POST['clocation'];
        $plocation=$_POST['plocation'];
        $section = $_POST['section'];
        $phone=$_POST['phone'];
        echo $fname."<br>".$lname."<br>".$dob."<br>".$class."<br>".$caddress."<br>".$plocation."<br>".$section."<br>".$phone;

    }

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../utilities.css">
    <link rel="stylesheet" href="admission.css">
</head>

<body>
    <?php include '../partials/_nav.php';?>
    <div class="container m-2 p-2">
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