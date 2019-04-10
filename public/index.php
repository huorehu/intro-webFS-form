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
        $TEMPLATES_PATH = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR;

        if (isset($_SESSION['new-user'])):
            require_once $TEMPLATES_PATH . 'profile.php';
        else:
            if (!isset($_SESSION['authorized'])):
                require_once $TEMPLATES_PATH . 'register.php';
            else:
                require_once $TEMPLATES_PATH . 'main.php';
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
