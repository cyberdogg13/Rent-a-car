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
if ($row['username'] == $gebruikersnaam && $row['password'] == $wachtwoord && $wachtwoord != null) {
    echo "Login succes!!";
} else {
    die("<script>window.location = './failed.html';</script>");
}

$idklant = $row['idklant'];
$klantnaam = $row['naam'];
$klanttussenvoegsel = $row['tussenvoegsel'];
$klantachternaam = $row['achternaam'];
$klantadres = $row['adres'];
$klanttelefoon = $row['telefoonnummer'];


?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" type="text/css" href="../styling/index.css">
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
<div id="profile">
    <h1>welkom <?php echo $gebruikersnaam ?>!</h1>
    <h3>Profiel gegevens</h3>
    <br>
    <p class="listitem"><label>Klantnummer = </label><a><?php echo $idklant ?></a></p>
    <p class="listitem"><label>Naam = </label><a><?php echo $klantnaam ?></a></p>
    <p class="listitem"><label>Tussenvoegsel = </label><a><?php echo $klanttussenvoegsel ?></a></p>
    <p class="listitem"><label>Achternaam = </label><a><?php echo $klantachternaam ?></a></p>
    <p class="listitem"><label>Gebruikersnaam = </label><a><?php echo $gebruikersnaam ?></a></p>
    <p class="listitem"><label>Wachtwoord = </label><a><?php echo $wachtwoord ?></a></p>
    <p class="listitem"><label>Adres = </label><a><?php echo $klantadres ?></a></p>
    <p class="listitem"><label>Telefoonnummer = </label><a><?php echo $klanttelefoon ?></a></p>
    <button type="button" onclick="">remove profile</button>

</div>
</body>
</html>
