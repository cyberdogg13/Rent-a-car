<?php

function user_exists($username){
    //anti sql injectie
    sanitise($username);
    //connectie maken met de database
    $connect = mysqli_connect('localhost', 'root', '');
    mysqli_connect("localhost", "root", "");
    mysqli_select_db($connect, 'rent-a-car');
//Querry voor de database
    $resulaat = mysqli_query($connect, "select * from klant where username = '$username'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);
    if ($row['username'] == $username) {
        return true;
    } else {
        return false;
    }
}

function user_active($username){
    //anti sql injectie
    sanitise($username);
    //connectie maken met de database
    $connect = mysqli_connect('localhost', 'root', '');
    mysqli_connect("localhost", "root", "");
    mysqli_select_db($connect, 'rent-a-car');
//Querry voor de database
    $resulaat = mysqli_query($connect, "select * from klant where username = '$username'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);
    if ($row['activated'] != "0") {
        return true;
    } else {
        return false;
    }
}
?>