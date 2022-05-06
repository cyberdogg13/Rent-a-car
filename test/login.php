<?php
include 'core/init.php';

if ($_POST != null) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo $username . ' ' . $password;

    if ($username == null || $password == null) {
        $errors[] = 'you need to enter both a username and a password';
    } else if (user_exists($username) === false) {
        $errors[] = 'we cant find this username . have you registered?';
    }else if (user_active($username) === false) {
        $errors[] = 'you have not actived your account!';
    }else {
        //code
    }
    print_r($errors);
}

?>