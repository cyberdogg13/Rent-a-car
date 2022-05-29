<?php
//gegevens ophalen
$gebruikersnaam = $_POST['gebruikersnaam'];
$wachtwoord = $_POST['wachtwoord'];
$voornaam = $_POST['naam'];
$tussenvoegsel = $_POST['tussenvoegsel'];
$achternaam = $_POST['achternaam'];
$adres = $_POST['adres'];
$telefoonnummer = $_POST['telefoonnummer'];

//anti SQL injectie
$gebruikersnaam = stripcslashes($gebruikersnaam);
//$gebruikersnaam = mysqli_real_escape_string($gebruikersnaam);
$wachtwoord = stripcslashes($wachtwoord);
//$wachtwoord = mysqli_real_escape_string($wachtwoord);

//checken of alle gegevens zijn ingeveult
if ($gebruikersnaam == null || $wachtwoord == null ||$voornaam == null ||
    $tussenvoegsel == null ||$achternaam == null ||$adres == null ||$telefoonnummer == null){
    die("<script>window.location = './failed.html';</script>");
}
//connect met de database
$connect = new mysqli('localhost', 'root', '', 'rent-a-car');
if ($connect->connect_error) {
    die('connection to database failed sukkel' . $connect->connect_error);
}

// checken of de username en password combo al bestaat
$resulaat = mysqli_query($connect, "select * from klant where username = '$gebruikersnaam' and password = '$wachtwoord'") or die("failed to query database" . mysqli_error());
$row = mysqli_fetch_array($resulaat);
if ($row['username'] == $gebruikersnaam && $row['password'] == $wachtwoord) {
    die('user already exists');
}


$sql = "INSERT INTO klant (naam, tussenvoegsel, achternaam,adres,telefoonnummer,username,password)
 VALUES ('$voornaam','$tussenvoegsel','$achternaam','$adres','$telefoonnummer','$gebruikersnaam','$wachtwoord')";

if ($connect->query($sql) === TRUE){
    echo 'registratie succesvol voltooit!';
}else{
    echo 'error: '.$sql. '<br>'.$connect->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login page</title>
    <link rel="stylesheet" href="../styling/index.css">
</head>
<body>
<header>
    <div id="logo">
        <img src="../images/Rent-a-car-immage.png" alt="logo" id="logoimg">
    </div>
    <div id="navbardiv">
        <nav>
            <a href="index.html">Hoofdpagina</a>
            <a href="index.html">Ons aanbod</a>
            <a href="./registratiepage.html">Registreren</a>
            <a href="./loginpage.html">mijn profiel</a>
        </nav>
    </div>
</header>
<div>
    <form action="profilepage.php" method="post">
        <h1 id="inlog">Inloggen</h1>

        <p>
            <label>gebruikersnaam</label>
            <input type="text" id="gebruikersnaam" name="gebruikersnaam">
        </p>
        <p>
            <label>wachtwoord</label>
            <input type="password" id="wachtwoord" name="wachtwoord">
        </p>
        <p>
            <input type="submit" id="submitbutton" value="login">
        </p>
    </form>
</div>

</body>
</html>
