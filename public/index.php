<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/lightslider.css">
    <link rel="stylesheet" href="css/selectric.css">
    <title>GoT</title>
</head>
<body>
<div class="wrapper">
    <div class="left-main"></div>
    <div class="right-main">
        <h1>GAME OF THRONES</h1>
        <?php
        if (isset($_SESSION['new-user'])):
            require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'profile.php';
        else:
            if (!isset($_SESSION['authorized'])):
                require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'register.php';
            else:
                require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'main.php';
            endif;
        endif;
        ?>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/lightslider.js"></script>
<script src="js/selectric.js"></script>
<script src="js/main.js"></script>
</body>
</html>