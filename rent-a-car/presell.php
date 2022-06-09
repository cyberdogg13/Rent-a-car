<?php
include 'core/init.php';
include 'includes/overall/header.php';
if (empty($_POST['car_id']) === false) {
    $_SESSION['car_id'] = $_POST['car_id'];
} else if (empty($_POST) === false) {
    $required_fields = array('naam','achternaam', 'email', 'ophalen_op_date', 'ophalen_op_time', 'terug_brengen_op_date', 'terug_brengen_op_time');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Fields marked with an * are required';
            break 1;
        }
    }
    if (empty($errors) === true) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'a valid email adres is required';
        }
        if (email_exists($_POST['email']) === true) {
            $errors[] = 'sorry, the email \'' . $_POST['email'] . '\' is already in use';
        }
    }
}
$car_id = $_SESSION['car_id'];
?>

<?php
if (isset($_GET['success']) && empty($_GET['success'])) {
    echo '<h1> succes! </h1> <br>
<p>uw aanvraag voor deze huur auto word in behandeling genomen door onze medewerkers</p> <br>
<p>binnen 24 krijgt u een mail van ons ter bevesteging</p>';

} else {
    echo '<h1>persoonlijke informatie invullen</h1>';
    if (empty($_POST['car_id']) === true && empty($errors) === true) {
        $resevering_data = array(
            'begin_periode' => $_POST['ophalen_op_date'] .' ' . $_POST['ophalen_op_time'] ,
            'eind_periode' => $_POST['terug_brengen_op_date'] .' '. $_POST['terug_brengen_op_time'],
            'idauto' => $_SESSION['car_id']
        );
        $register_Data =array(
            'username'      => $_POST['username'],
            'password'      => $_POST['password'],
            'naam' => $_POST['naam'],
            'tussenvoegsel' => $_POST['tussenvoegsel'],
            'achternaam' => $_POST['achternaam'],
            'email' => $_POST['email'],
            'telefoonnummer' => $_POST['telefoonnummer']
        );

        register_user($register_Data);
        $resevering_data['idklant'] = get_id_from_email($_POST['email']);
        //print_r($resevering_data);
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
                    <input type="text" name="naam">
                </li>
                <li>
                    tussenvoegsel: <br>
                    <input type="text" name="tussenvoegsel">
                </li>
                <li>
                    achternaam*: <br>
                    <input type="text" name="achternaam">
                </li>
                <li>
                    Email*: <br>
                    <input type="text" name="email">
                </li>
                <li>
                    Telefoon nummer*: <br>
                    <input type="text" name="telefoonnummer">
                </li>
                <li>
                    Ophalen op*: <br>
                    <input type="date" name="ophalen_op_date">
                    <input type="time" name="ophalen_op_time">
                </li>
                <li>
                    Terug brengen op*: <br>
                    <input type="date" name="terug_brengen_op_date">
                    <input type="time" name="terug_brengen_op_time">
                </li>
                <input type="submit" class="button" value="Naar factuur">
            </ul>
        </form>
    </div>
<?php }
include 'includes/overall/footer.php';
?>
