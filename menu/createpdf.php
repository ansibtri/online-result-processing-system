<?php
session_start();
$studentid = $_SESSION['studentid'];
if(!isset($_SESSION['username']) && empty($_SESSION['username']) == true && !isset($_SESSION['studentid']) && empty($_SESSION['studentid']) == true){
    header("Location: admission.php");
}else{
include('../partials/_dbconnect.php'); //connecting to database
require("pdf/fpdf/fpdf.php"); //fetching pdf file maker

$pdf = new FPDF('P','mm','A4'); // initialize new object;

$pdf->Addpage(); //create a page
$pdf->SetFont("Arial","B",16); // setting up font
$pdf->SetMargins(10,25,10);
$pdf->Cell(0,5,"Wisdom & Perserverance",0,0,'C');
$pdf->Cell(0,8,"Ph:063-460165",0,1,'R');
$pdf->Image('pdf/logo.jpg',10,10,-250);
$pdf->Cell(0,5,"ADARSHA SECONDARY BOARDING SCHOOL",0,1,'C');
$pdf->Cell(0,8,"Galyang Bazaar, Syangja",0,1,'C');
$pdf->Cell(0,8,"ESTD-2042",0,1,'C');
$pdf->Cell(0,8,"ACADEMIC REPORT OF INDIVIDUAL PERFORMANCE",0,1,'C');

// fetching student info dynamically 
$date = date("Y");
$stu_sql = "SELECT * FROM `student_details` WHERE `student_id` = '$studentid'";
$stu_result = mysqli_query($conn, $stu_sql);
while($student = mysqli_fetch_assoc($stu_result)){
$pdf->MultiCell(0,10," Name: ".$student['student_name']." ".$student['student_surname']." 			   						Roll No: ".$student['student_serial_id']."									 			Year: ".$date."\n Class: ".$student['student_class']." 																																				Section: ".$student['student_class_section'],1,1);
}


$pdf->Ln();
// designing tables header 
$pdf->Cell(40,8,"S.No.",1,0);
$pdf->Cell(60,8,"Subject",1,0);
$pdf->Cell(30,8,"F.M",1,0);
$pdf->Cell(30,8,"P.M",1,0);
$pdf->Cell(30,8,"Obt. Marks",1,1);


//fetching info dynamically
$studentid = $_SESSION['studentid'];
$sql = "SELECT * FROM `result_calculation` WHERE `student_id` = '$studentid'";
$result = mysqli_query($conn, $sql);
$num = 1;
$subject = array("English Reader","Nepali","Maths","Science","Social","General Knowledge","Grammar");
while($row = mysqli_fetch_assoc($result)){
    // no 1 

$pdf->Cell(40,8,$num++,1,0);
$pdf->Cell(60,8,"Nepali",1,0);
$pdf->Cell(30,8,"100",1,0);
$pdf->Cell(30,8,"40",1,0);
$pdf->Cell(30,8,$row['sub_nepali'],1,1);

// no 2
$pdf->Cell(40,8,$num++,1,0);
$pdf->Cell(60,8,"Maths",1,0);
$pdf->Cell(30,8,"100",1,0);
$pdf->Cell(30,8,"40",1,0);
$pdf->Cell(30,8,$row['sub_maths'],1,1);

// no 3
$pdf->Cell(40,8,$num++,1,0);
$pdf->Cell(60,8,"Science",1,0);
$pdf->Cell(30,8,"100",1,0);
$pdf->Cell(30,8,"40",1,0);
$pdf->Cell(30,8,$row['sub_science'],1,1); 
// no 4
$pdf->Cell(40,8,$num++,1,0);
$pdf->Cell(60,8,"Grammar",1,0);
$pdf->Cell(30,8,"100",1,0);
$pdf->Cell(30,8,"40",1,0);
$pdf->Cell(30,8,$row['sub_grammar'],1,1);

// no 5
$pdf->Cell(40,8,$num++,1,0);
$pdf->Cell(60,8,"English Reader",1,0);
$pdf->Cell(30,8,"100",1,0);
$pdf->Cell(30,8,"40",1,0);
$pdf->Cell(30,8,$row['sub_english'],1,1);

// no 6 
$pdf->Cell(40,8,$num++,1,0);
$pdf->Cell(60,8,"Social",1,0);
$pdf->Cell(30,8,"100",1,0);
$pdf->Cell(30,8,"40",1,0);
$pdf->Cell(30,8,$row['sub_social'],1,1);

// no 7
$pdf->Cell(40,8,$num++,1,0);
$pdf->Cell(60,8,"General Knowledge",1,0);
$pdf->Cell(30,8,"100",1,0);
$pdf->Cell(30,8,"40",1,0);
$pdf->Cell(30,8,$row['sub_gk'],1,1);

//no 8
$pdf->Cell(100,8,"Total",1,0,'C');
$pdf->Cell(30,8,"700",1,0);
$pdf->Cell(30,8,"240",1,0);
$pdf->Cell(30,8,$row['student_obt_marks'],1,1);

$pdf->Ln();

// -------------
$pdf->Cell(95,8,"Result : ".$row['student_result'],1,0,'C');
$pdf->Cell(95,8,"Percentage : ".$row['student_percentage']."%",1,1,'C');
$pdf->Cell(95,8,"Division : ".$row['student_division'],1,0,'C');
$pdf->Cell(95,8,"Position : ".$row['student_position'],1,1,'C');
$pdf->Ln();

// ------------
}

// ------------
$pdf->Cell(95,8,"ATTENDANCE",0,0,'C');
$pdf->Cell(95,8,"PERSONAL DEVELOPMENT",0,1,'C');
$pdf->SetFont("Arial","B",10);
$pdf->Cell(95,8,"Days",1,0,'C');
$pdf->Cell(47.5,8,"Observation On-",1,0,'C');
$pdf->Cell(47.5,8,"Grade(A,B,C)",1,1,'C');
// new line 
// fetching student development records 
$spd_sql = "SELECT * FROM `student_personal_development` WHERE `student_id` = '$studentid'";
$spd_result = mysqli_query($conn,$spd_sql);
while($spdrow = mysqli_fetch_assoc($spd_result)){ //looping for personal development
    $pdf->Cell(95,6,"Total Present Days: 223",1,0,'C');
    $pdf->Cell(47.5,6,"Conduct",1,0,'C');
    $pdf->Cell(47.5,6,$spdrow['student_conduct'],1,1,'C');
    //newline
    $pdf->Cell(95,6,"Working Days: 226",1,0,'C');
    $pdf->Cell(47.5,6,"Punctuality",1,0,'C');
    $pdf->Cell(47.5,6,$spdrow['student_punctuality'],1,1,'C');
    // new line 
    $pdf->Cell(95,6,"Absent Days: 3",1,0,'C');
    $pdf->Cell(47.5,6,"Neatness",1,0,'C');
    $pdf->Cell(47.5,6,$spdrow['student_neatness'],1,1,'C');
    //new line 
    $pdf->Cell(47.5,24,"Students",1,0,'C');
    $pdf->Cell(47.5,8,"Boys: 14",1,0,'C');
    $pdf->Cell(47.5,8,"Leadership",1,0,'C');
    $pdf->Cell(47.5,8,$spdrow['student_leadership'],1,1,'C');

    // new line 
    $pdf->Cell(47.5,8,"        ",0,0,'C');
    $pdf->Cell(47.5,8,"Girls: 17",1,0,'C');
    $pdf->Cell(47.5,8,"Neatness",1,0,'C');
    $pdf->Cell(47.5,8,$spdrow['student_neatness'],1,1,'C');

    $pdf->Cell(47.5,8,"        ",0,0,'C');
        $pdf->Cell(47.5,8,"Total:31",1,0,'C');
    $pdf->Cell(47.5,8,"Extra Activities",1,0,'C');
    $pdf->Cell(47.5,8,$spdrow['student_extra_activities'],1,1,'C');

    $pdf->Ln();
    // newline 
    $pdf->Cell(0,8,"Remarks: ".$spdrow['student_remarks'],1,1,'C');
}
    $pdf->Ln();
    $pdf->SetFont("Arial","B",11);
    $dateTime = new DateTime("now", new DateTimeZone('Asia/Kathmandu'));
    $dateTime = date_add($dateTime,date_interval_create_from_date_string("20713 days"));
    $date = $dateTime->format("Y-m-d");
    $pdf->Cell(60,13,"Class Teacher",0,0,'C');
    $pdf->Cell(60,13,"Date: ".$date,0,0,'C');
    $pdf->Cell(60,13,"Principal",0,1,'C');
        // $pdf->output('S',"anishbhattarai.pdf");//output the file

    $pdf->output();
}
session_unset();
session_destroy();

?>
