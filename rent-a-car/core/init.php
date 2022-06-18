<?php
session_start();
//error_reporting(0);
require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';
require 'functions/medewerker.php';

if (logged_in() === true) {
    $session_user_id = $_SESSION['user_id'];
    if ($_SESSION['werknemer'] === true) {
        $user_data = medewerker_data($session_user_id, 'idmedewerker', 'username', 'password', 'naam', 'tussenvoegsel', 'achternaam');
    } else {
        $user_data = user_data($session_user_id, 'email','idklant', 'username', 'password', 'naam', 'tussenvoegsel', 'achternaam', 'adres', 'telefoonnummer');
        if (user_active($user_data['username']) === false) {
            session_destroy();
            header('Location: index.php');
            exit();
        }
    }

}

$errors = array();
?>