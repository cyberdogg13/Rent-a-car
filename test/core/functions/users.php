<?php

function user_exists($username)
{
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

function user_active($username)
{
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

function user_id_from_username($username)
{
    sanitise($username);
    //connectie maken met de database
    $connect = mysqli_connect('localhost', 'root', '');
    mysqli_connect("localhost", "root", "");
    mysqli_select_db($connect, 'rent-a-car');
//Querry voor de database
    $resulaat = mysqli_query($connect, "select * from klant where username = '$username'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);
    return $row['idklant'];
}

function login($username, $password)
{
    $user_id = user_id_from_username($username);

    $username = sanitise($username);


    //connectie maken met de database
    $connect = mysqli_connect('localhost', 'root', '');
    mysqli_connect("localhost", "root", "");
    mysqli_select_db($connect, 'rent-a-car');
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from klant where username = '$username'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);

    if ($row['username'] == $username && $row['password'] == $password){
        $user_id = $row['idklant'];
        return $user_id;

    }
    else{
        return false;
    }
}

function logged_in(){
    return (isset($_SESSION['user_id'])) ? true : false;
}

?>