<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $birthdate = $_POST['birthdate'];
        $symbol = $_POST['symbol'];
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
    <link rel="stylesheet" href="result.css">
</head>

<body>
    <?php include '../partials/_nav.php'; ?>
    <div class="container xl m-5">
        <h1>Result</h1>
        <p>Result of the final exam has been published.</p>
        <!-- <img src="" alt="notice"> -->
    </div>
    <div class="mx-5">
        <p>Provide your details correctly.</p>
    </div>
    <div class="container m-5 result-form">
        <form action="#" method="POST" class="grid grid-3 grid-gap">
            <input type="date" name="birthdate" id="birthdate" class="p-1">
            <input type="number" name="symbol" id="symbol" maxlength="10" class="p-1" placeholder="Your Symbol Number">
            <button class="p-1">Submit</button>
        </form>
    </div>
    <div class="container m-2">
        <div class="result-container m-4">
            <h1 class="text-center p-1"> <img src="https://www.freelogoservices.com/api/main/images/1j+ojFVDOMkX9Wytexe43D6khvWAqR9PkRrNwXs1M3EMoAJtliIpgvFr9...4z" alt="" srcset=""></h1>
            <div class="scl-add">
            <p class="text-center bold">Galyang, Syangja</p>
            <p class="text-center bold">Estd.2042</p>
            </div>
        </div>
    </div>
    <?php include '../partials/_footer.php'; ?>
</body>

</html>