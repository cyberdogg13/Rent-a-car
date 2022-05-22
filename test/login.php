<?php
include 'core/init.php';
include 'includes/overall/header.php';

if ($_POST != null) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($username == null || $password == null) {
        $errors[] = 'you need to enter both a username and a password';
    } else if (user_exists($username) === false) {
        $errors[] = 'we cant find this username . have you registered?';
    }else if (user_active($username) === false) {
        $errors[] = 'you have not actived your account!';
    }else {
        $login = login($username,$password);
        if ($login === false){
            $errors[] = "the username and password combination is invalid";
        }
        else{
            $_SESSION['user_id'] = $login;
            header('Location: index.php');
            exit();


        }
    }
    print_r($errors);
}

include 'includes/overall/footer.php';

?>