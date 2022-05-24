<?php

include 'core/init.php';

if ($_POST['username'] && $_POST['password'] != null) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == null || $password == null) {
        $errors[] = 'you need to enter both a username and a password';
    } else if (user_exists($username) === false) {
        $errors[] = 'we cant find this username . have you registered?';
    } else if (user_active($username) === false) {
        $errors[] = 'you have not actived your account!';
    } else {
        if (strlen($password) > 32) {
            $errors[] = 'password is too long';
        }
        $login = login($username, $password);
        if ($login === false) {
            $errors[] = "the username and password combination is invalid";
        } else {
            $_SESSION['user_id'] = $login;
            header('Location: index.php');
            exit();
        }
    }
} else {
    $errors[] = "no data recieved";
}

include 'includes/overall/header.php';
if (empty($errors) === false) {
    ?>
    <h2>we tried to log you in but....</h2>
    <?php
    echo output_errors($errors);
}
include 'includes/overall/footer.php';

?>