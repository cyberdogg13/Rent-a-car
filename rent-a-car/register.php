<?php
include 'core/init.php';
include 'includes/overall/header.php';
if (empty($_POST) === false) {
    $required_fields = array('username', 'password', 'password_again', 'naam', 'email');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Fields marked with an * are required';
            break 1;
        }
    }

    if (empty($errors) === true) {
        if (user_exists($_POST['username']) === true) {
            $errors[] = 'sorry, the username \'' . $_POST['username'] . '\' is already taken';
        }
        if (preg_match("/\\s/", $_POST['username']) == true) {
            $errors[] = 'your username must not contain any spaces';
        }
        if (strlen($_POST['password']) < 6) {
            $errors[] = 'your password must be at least 6 characters';
        }
        if ($_POST['password'] !== $_POST['password_again']) {
            $errors[] = 'your passwords dont match';
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'a valid email adres is required';
        }
        if (email_exists($_POST['email']) === true) {
            $errors[] = 'sorry, the email \'' . $_POST['email'] . '\' is already in use';
        }
    }
}


?>
<h1>Registeren</h1>
<h6 style="color: gray">Velden met een * zijn veplicht</h6>
<?php
if (isset($_GET['success']) && empty($_GET['success'])) {
    echo 'you have been registered succesfully!';
} else {
    if (empty($_POST) === false && empty($errors) === true) {
        $register_data = array(
            'username'      => $_POST['username'],
            'password'      => $_POST['password'],
            'naam'          => $_POST['naam'],
            'tussenvoegsel' => $_POST['tussenvoegsel'],
            'achternaam'    => $_POST['achternaam'],
            'email'         => $_POST['email'],
            'adres'         => $_POST['adres'],
            'telefoonnummer'=> $_POST['telefoonnummer']
        );
        register_user($register_data);
        header('Location: register.php?success');
        exit();
    } else if (empty($errors) === false) {
        echo output_errors($errors);
    }
    ?>
    <form action="" method="post">
        <ul>
            <li>Gebruikersnaam*:<br>
                <input type="text" name="username">
            </li>
            <li>
                Wachtwoord*:<br>
                <input type="text" name="password">
            </li>
            <li>
                Wachtwoord opnieuw*:<br>
                <input type="text" name="password_again">
            </li>
            <li>
                Voornaam*: <br>
                <input type="text" name="naam">
            </li>
            <li>
                Tussenvoegsel: <br>
                <input type="text" name="tussenvoegsel">
            </li>
            <li>
                Achernaam: <br>
                <input type="text" name="achternaam">
            </li>
            <li>
                Email*: <br>
                <input type="text" name="email">
            </li>
            <li>
                Adres: <br>
                <input type="text" name="adres">
            </li>
            <li>
                Telefoonnummer: <br>
                <input type="text" name="telefoonnummer">
            </li>
            <input type="submit" value="Register">
        </ul>
    </form>
    <?php include 'includes/overall/footer.php';
}
?>
