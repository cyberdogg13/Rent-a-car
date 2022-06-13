<?php
function medewerker_data($user_id)
{
    $data = array();
    $user_id = (int)$user_id;

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if ($func_num_args > 1) {
        unset($func_get_args[0]);
        $connect = connect_to_database();
        $fields = ' ' . implode(',', $func_get_args) . ' ';
        $data = mysqli_fetch_assoc(mysqli_query($connect, "select $fields from medewerker where idmedewerker = '$user_id'"));
        return $data;
    }
}

function login_medewerker($username, $password)
{
    $user_id = user_id_from_medewerker_username($username);
    $username = sanitise($username);
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from medewerker where username = '$username'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);

    if ($row['username'] == $username && $row['password'] == $password) {
        $user_id = $row['idmedewerker'];
        return $user_id;

    } else {
        return false;
    }
}

function user_id_from_medewerker_username($username)
{
    sanitise($username);
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from medewerker where username = '$username'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);
    return $row['idmedewerker'];
}

function medewerker_exists($username)
{
    //anti sql injectie
    sanitise($username);
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from medewerker where username = '$username'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);
    if ($row['username'] == $username) {
        return true;
    } else {
        return false;
    }
}

?>