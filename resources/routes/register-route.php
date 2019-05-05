<?php

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
