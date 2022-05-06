<?php
//login gegevens ophalen
$gebruikersnaam = $_POST['gebruikersnaam'];
$wachtwoord = $_POST['wachtwoord'];

//anti SQL injectie
$gebruikersnaam = stripcslashes($gebruikersnaam);
//$gebruikersnaam = mysqli_real_escape_string($gebruikersnaam);
$wachtwoord = stripcslashes($wachtwoord);
//$wachtwoord = mysqli_real_escape_string($wachtwoord);

//connect met de database
$connect = mysqli_connect('localhost', 'root', '');
mysqli_connect("localhost", "root", "");
mysqli_select_db($connect, 'rent-a-car');
//Querry voor de database
$resulaat = mysqli_query($connect, "select * from klant where username = '$gebruikersnaam' and password = '$wachtwoord'") or die("failed to query database" . mysqli_error());
$row = mysqli_fetch_array($resulaat);
if ($row['username'] == $gebruikersnaam && $row['password'] == $wachtwoord) {
    echo "Login succes!! Welkom" . $row['username'];
} else {
    echo "failed to login!";
}

?>