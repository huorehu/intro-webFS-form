<?php

if ($validator->validate($_POST)) {
    if ($register->saveData($_SESSION['user'], $_POST['name'], $_POST['house'], $_POST['preferences'])) {
        unset($_SESSION['new-user']);
        $_SESSION['authorized'] = true;
    }
}
