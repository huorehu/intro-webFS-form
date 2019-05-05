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
/* Unset errors highlighting */
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['name']);
unset($_SESSION['house']);
unset($_SESSION['preferences']);
unset($_SESSION['username-err']);
unset($_SESSION['authorize-err']);

$routePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR;

switch ($_POST['form-name']) {
    case 'register':
        require $routePath . 'register-route.php';
        break;
    case 'profile':
        require $routePath . 'profile-route.php';
        break;
    default:
        http_response_code(404);
}

if (!empty($error->getErrors())) {
    foreach ($error->getErrors() as $key => $value) {
        $_SESSION[$key] = $value;
    }
}

header('location: index.php');
