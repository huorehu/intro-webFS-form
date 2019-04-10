<?php

session_start();

spl_autoload_register(function ($className) {
    require_once dirname(__DIR__) .
        DIRECTORY_SEPARATOR .
        str_replace('\\', DIRECTORY_SEPARATOR, $className) .
        '.php';
});

use app\Register;
use app\Validator;
use app\Error;

$config = require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config.php';

$error = new Error();
$register = new Register($config['jsonFilePath'], $error);
$validator = new Validator($error);

switch ($_POST['form-name']) {
    case 'register':
        if ($validator->validate($_POST)) {
            if ($register->register($_POST['email'], $_POST['password'])) {
                $_SESSION['user'] = $_POST['email'];
                $_SESSION['new-user'] = true;
            }
        }

        if (!empty($error->getErrors())) {
            foreach ($error->getErrors() as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }

        break;
    case 'profile':
        if ($validator->validate($_POST)) {
            if ($register->saveData($_SESSION['user'], $_POST['username'], $_POST['house'], $_POST['preferences'])) {
                unset($_SESSION['new-user']);
                $_SESSION['authorized'] = true;
            }
        }

        break;
    default:
        echo 'not found';
}

header('location: index.php');
