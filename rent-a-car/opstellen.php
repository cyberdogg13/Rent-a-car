<?php
include 'core/init.php';
include 'includes/overall/header.php';
$klant_data = user_data($_POST['idklant'], 'idklant', 'username', 'password', 'naam', 'tussenvoegsel', 'achternaam', 'adres', 'email', 'telefoonnummer');
$auto_data = get_cardata($_POST['idauto'], 'idauto', 'kenteken', 'merk', 'model', 'type', 'kleur', 'prijsperdag');
$resevering_data = get_reseveringdata($_POST['idresevering'], 'begin_periode','eind_periode','prijs');
?>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>
<div id="factuur">
    <img src="core/database/img/Rent-a-car-immage.png" alt="" id="logoplaatje">
    <h1>Factuur</h1>
    <p>Rent-a-Car</p>
    <p>Auto 12</p>
    <p>1333 YY AMERE</p>
    <p>Telefoon:(036) 1234 45 67</p>
    <br>
    <p>Datum: 19-03-2013</p>
    <p>Factuurnummer: 3</p>
    <p>
        Behandelaar: <?php echo $user_data['naam'], ' ', $user_data['tussenvoegsel'], ' ', $user_data['achternaam'] ?></p>
    <br>
    <p><?php echo $klant_data['naam'] . ' ' . $klant_data['tussenvoegsel'] . ' ' . $klant_data['achternaam'] ?></p>
    <p><?php echo $klant_data['adres'] ?></p>
    <br>
    <h2>Resevering</h2>
    <table>
        <tr>
            <th>Kenteken</th>
            <th>Merk</th>
            <th>Type</th>
            <th>Reseverings periode</th>
            <th>prijsperdag</th>
            <th>Totaalprijs</th>
        </tr>
        <tr>
            <td><?php echo $auto_data['kenteken'] ?></td>
            <td><?php echo $auto_data['merk'] ?></td>
            <td><?php echo $auto_data['type'] ?></td>
            <td><?php echo $resevering_data['begin_periode'] . ' / ' .$resevering_data['eind_periode'] ?></td>
            <td><?php echo $auto_data['prijsperdag'] ?></td>
            <td><?php echo $resevering_data['prijs'] ?></td>
        </tr>
    </table>
    <br>
    <p>* Betalingen dienen plaats te vinden veertien dagen voor de aanvang van de gereserveerde periode
        op rekeningnummer 3210808 ten name van het Rent-a-Car te Almere. Indien er gereserveerd is
        binnen veertien dagen voor de aanvang van de gereserveerde periode, dient de betaling direct plaats
        te vinden</p>
    <br>
    <input type="submit" value="printen als pdf" class="button">
</div>
<?php
include 'includes/overall/footer.php'; ?>
