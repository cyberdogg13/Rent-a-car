<?php

function total_active_users(){
    $connect = connect_to_database();
    $result = mysqli_query($connect,"SELECT COUNT(idklant) from klant where activated = 1");
    $row = mysqli_fetch_array($result);
    return $row[0];

}
function user_data($user_id){
$data = array();
$user_id = (int)$user_id;

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if ($func_num_args > 1){
        unset($func_get_args[0]);

        $connect = connect_to_database();
        $fields = ' ' . implode(',' , $func_get_args) . ' ';
        $data = mysqli_fetch_assoc(mysqli_query($connect,"select $fields from klant where idklant = '$user_id'"));

        return $data;
    }

}
function connect_to_database($database = "rent-a-car"){
    $connect = mysqli_connect('localhost', 'root', '');
    mysqli_select_db($connect,$database);
    return $connect;
}

function user_exists($username)

{
    //anti sql injectie
    sanitise($username);
    //connectie maken met de database
    $connect = connect_to_database();
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
    $connect = connect_to_database();
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
    $connect = connect_to_database();
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
    $connect = connect_to_database();
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