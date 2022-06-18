<?php
include 'core/init.php';
include 'includes/overall/header.php';
if (empty($_POST['car_id']) === false) {
    $_SESSION['car_id'] = $_POST['car_id'];
} else if (empty($_POST) === false) {
    $required_fields = array('adres','naam','achternaam', 'email', 'ophalen_op_date', 'ophalen_op_time', 'terug_brengen_op_date', 'terug_brengen_op_time');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Fields marked with an * are required';
            break 1;
        }
    }
    if (empty($errors) === true) {
        $ophalen = new DateTime($_POST['ophalen_op_date']);
        $terugbrengen = new DateTime ($_POST['terug_brengen_op_date']);
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'a valid email adres is required';
        }
        if (email_exists($_POST['email']) === true) {
            $errors[] = 'sorry, the email \'' . $_POST['email'] . '\' is already in use';
        }
        if ( $ophalen > $terugbrengen){
            $errors[] = 'de datum van ophalen moet op een later moment zijn dan het moment van terugbrengen';
        }
    }
}
$car_id = $_SESSION['car_id'];

if (isset($_GET['success']) && empty($_GET['success'])) {
    echo '<h1> succes! </h1> <br>
<p>uw aanvraag voor deze huur auto word in behandeling genomen door onze medewerkers</p> <br>
<p>binnen 24 krijgt u een mail van ons ter bevesteging</p>';

} else {
    echo '<h1>persoonlijke informatie invullen</h1>';

    if (empty($_POST['car_id']) === true && empty($errors) === true) {
        $dageninbruikleen = $ophalen->diff($terugbrengen)->format("%r%a");
        $totaalprijs = get_prijsperdag($car_id) * $dageninbruikleen;
        $resevering_data = array(
            'begin_periode' => $_POST['ophalen_op_date'] .' ' . $_POST['ophalen_op_time'] ,
            'eind_periode' => $_POST['terug_brengen_op_date'] .' '. $_POST['terug_brengen_op_time'],
            'idauto' => $_SESSION['car_id'],
            'prijs' => $totaalprijs
        );
        $register_Data =array(
            'username'      => $_POST['username'],
            'password'      => $_POST['password'],
            'naam' => $_POST['naam'],
            'tussenvoegsel' => $_POST['tussenvoegsel'],
            'achternaam' => $_POST['achternaam'],
            'email' => $_POST['email'],
            'telefoonnummer' => $_POST['telefoonnummer'],
            'adres' => $_POST['adres']
        );
        register_user($register_Data);
        $resevering_data['idklant'] = get_id_from_email($_POST['email']);
        make_resevering($resevering_data);
        header('Location: presell.php?success');
        exit();
    } else if (empty($errors) === false) {
        echo output_errors($errors);
    }
    ?>
    <div id="presellcontainer">
        <?php echo get_selected_car($car_id); ?>
        <form action="" method="post">
            <ul>
                <li>
                    voornaam*: <br>
                    <input type="text" name="naam" value="<?php echo $user_data['naam'] ?>">
                </li>
                <li>
                    tussenvoegsel: <br>
                    <input type="text" name="tussenvoegsel" value="<?php echo $user_data['tussenvoegsel'] ?>">
                </li>
                <li>
                    achternaam*: <br>
                    <input type="text" name="achternaam" value="<?php echo $user_data['achternaam'] ?>">
                </li>
                <li>
                    Email*: <br>
                    <input type="text" name="email" value="<?php echo $user_data['email'] ?>">
                </li>
                <li>
                    Adres*: <br>
                    <input type="text" name="adres" value="<?php echo $user_data['adres'] ?>">
                </li>
                <li>
                    Telefoon nummer*: <br>
                    <input type="text" name="telefoonnummer" value="<?php echo $user_data['telefoonnummer'] ?>">
                </li>
                <li>
                    Ophalen op*: <br>
                    <input type="date" name="ophalen_op_date" >
                    <input type="time" name="ophalen_op_time">
                </li>
                <li>
                    Terug brengen op*: <br>
                    <input type="date" name="terug_brengen_op_date">
                    <input type="time" name="terug_brengen_op_time">
                </li>
                <input type="hidden" value=" " name="password">
                <input type="hidden" value=" " name="username">
                <input type="submit" class="button" value="Naar factuur">
            </ul>
        </form>
    </div>
<?php }
include 'includes/overall/footer.php';
?>
