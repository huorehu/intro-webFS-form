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
clearErrors();

switch ($_POST['form-name']) {
    case 'register':
        if ($validator->validate($_POST)) {
            if ($register->register($_POST['email'], $_POST['password'])) {
                $_SESSION['user'] = $_POST['email'];
                $tmp = json_decode(file_get_contents($config['jsonFilePath']),true);
                $key = isset(json_decode(file_get_contents($config['jsonFilePath']), true)[$_POST['email']]['name']) ?
                    'authorized' :
                    'new-user';
                $_SESSION[$key] = true;
            }
        }

        break;
    case 'profile':
        if ($validator->validate($_POST)) {
            if ($register->saveData($_SESSION['user'], $_POST['name'], $_POST['house'], $_POST['preferences'])) {
                unset($_SESSION['new-user']);
                $_SESSION['authorized'] = true;
            }
        }

        break;
    default:
        echo 'not found';
}

if (!empty($error->getErrors())) {
    foreach ($error->getErrors() as $key => $value) {
        $_SESSION[$key] = $value;
    }
}

header('location: index.php');

function clearErrors() {
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    unset($_SESSION['name']);
    unset($_SESSION['house']);
    unset($_SESSION['preferences']);
    unset($_SESSION['username-err']);
    unset($_SESSION['authorize-err']);
}
