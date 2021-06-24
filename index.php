<?php

    $showAlert = false;
    include 'partials/_dbconnect.php';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $user_email = $_POST['email'];
        $sql = "SELECT `subscribe_email` FROM `news_letter_subscriber` WHERE `subscribe_email`='$user_email'";
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            $showAlert = true;
        }else{
            $sql = "INSERT INTO `news_letter_subscriber` (`subscribe_email`) VALUES ('$user_email');";
            $result = mysqli_query($conn,$sql);
            if(!$result){
                $showAlert = true;
            }else{
                echo "subscribed";
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
    <link rel="stylesheet" href="utilities.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
   <?php include 'partials/_nav.php';?> 
<!-- showcase starts here  -->
    <section>
        <div class="showcase">
            <h2 class="para xxl p-2 mt-4 text text-center">"Education For Change, Education For Humanity"</h2>
            <p class="text-center text lg">We believe in morality, not in cruelity. Students, here won't developed by mentors, they have to make their own path.</p>
        </div>
    </section>
    <!-- showcase-section ends here  -->
    <!-- welcome section starts here  -->
    <section>
        <div class="scl-welcome mx-5">
            <h2 class="text-center para xxxl p-2 my-2">Welcome to School</h2>
            <div class="scl-desc grid grid-2 my-1">
                <img src="assets/element5-digital-OyCl7Y4y0Bk-unsplash.jpg" alt="">
                <div class="description">
                    <h3 class="px-3 xxl">School Of Education</h3>
                    <h4 class="p-3 text-justify">School of Education is located at Mustang district of Nepal with the motto of providing quality education for the holistic development of a child to live a stressful with a self-learning attitude.</h4>
                    <p class="para-1">Please visit our school on <a href="#">School of Education Virtual Tour</a></p>
                    <p class="para-1">Please also see the <a href="calendar.html">2078 School Calendar</a></p>
                </div>
            </div>
            <div class="scl-desc grid grid-2">
                
                <div class="description">
                    <h3 class="px-3 xxl">Level of Education</h3>
                    <h4 class="p-3 text-justify">School of Education is offering three levels of education since it's establishment by promoting social values.</h4>
                    <p class="para-1"><a href="preprimary.html">Pre-Primary School</a></p>
                    <p class="para-1"><a href="primary.html">Primary School</a></p>
                    <p class="para-1"><a href="secondary.html">Secondary School</a></p>
                </div>
                <img src="assets/susan-q-yin-2JIvboGLeho-unsplash.jpg" alt="">
            </div>
            <div class="scl-desc grid grid-2 my-1">
                <img src="assets/element5-digital-OyCl7Y4y0Bk-unsplash.jpg" alt="">
                <div class="description">
                    <h3 class="px-3 xxl">School Of Education</h3>
                    <h4 class="p-3 text-justify">School of Education is located at Mustang district of Nepal with the motto of providing quality education for the holistic development of a child to live a stressful with a self-learning attitude.</h4>
                    <p class="para-1">Please visit our school on <a href="#">School of Education Virtual Tour</a></p>
                    <p class="para-1">Please also see the <a href="calendar.html">2078 School Calendar</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- welcome section ends here  -->
    <!-- notice section starts here  -->
    <section>
        <div class="scl-welcome mx-5">
            <h2 class="text-center para xxxl p-2 my-2">Latest Notice</h2>
            <div class="flex flex-c">
                <div class="card flex flex-c m-2 p-0 notice-card">
                    <img src="https://source.unsplash.com/600x400/?education,gurukul" alt="">
                    <div class="description p-2">
                        <h3 class="lg">Motto</h3>
                        <p class="md">Self-Development</p>
                        <p class="md">Self-Learning</p>
                        <p class="md">Flexible</p>
                        <p class="md">Culture</p>
                    </div>
                </div>
                <div class="card flex flex-c m-2 p-0 notice-card">
                    <img src="https://source.unsplash.com/600x400/?education,gurukul" alt="">
                    <div class="description p-2">
                        <h3 class="lg">Motto</h3>
                        <p class="md">Self-Development</p>
                        <p class="md">Self-Learning</p>
                        <p class="md">Flexible</p>
                        <p class="md">Culture</p>
                    </div>
                </div>
                <div class="card flex flex-c m-2 p-0 notice-card">
                    <img src="https://source.unsplash.com/600x400/?education,gurukul" alt="">
                    <div class="description p-1">
                        <h3 class="lg">Motto</h3>
                        <p class="md">Self-Development</p>
                        <p class="md">Self-Learning</p>
                        <p class="md">Flexible</p>
                        <p class="md">Culture</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- notice section ends here  -->
    <!-- member section starts here  -->
    <section>
        <div class="members">
            <div class="grid grid-3 m-3 grid-gap">
                <div class="students card p-5">
                    <p class="xxl">800+</p>
                    <p class="xxl">Passionate Students</p>
                </div>
                <div class="teachers card p-5">
                    <p class="xxl">30+</p>
                    <p class="xxl">Skilled Teachers</p>
                </div>
                <div class="teachers card p-5">
                    <p class="xxl">Best Hospitality</p>
                    <p class="xxl">in Hostel</p>
                </div>
            </div>
        </div>
    </section>
    <!-- newsletter section starts here  -->
    <section>
        <div class="newsletter">
            <form action="index.php" method="POST">
                <h3 class="text-center xxl p-4 text">Subscribe to Get Notice</h3>
                <div class="subscribe flex">
                    <input type="email" maxlength="50" name="email" id="email" placeholder="example@email.com">
                    <button type="submit">Subscribe</button>
                </div>
            </form>
        </div>
    </section>
    <!-- newsletter section ends here  -->
    <?php include 'partials/_footer.php';?> 
</body>

</html>