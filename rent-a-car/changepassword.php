<?php
include 'core/init.php';
include 'includes/overall/header.php';

if (empty($_POST) === false){
    $required_fields = array('currentpassword', 'password', 'password_again');
    foreach ($_POST as $key => $value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Fields marked with an * are required';
            break 1;
        }
    }
    echo output_errors($errors);
}

?>
<h1>Wachtwoord aanpassen</h1>

<form action="" method="post">
    <ul>
        <li>
            Huidig wachtwoord*:
            <input type="text" name="currentpassword">
        </li>
        <li>
            New wachtwoord*:
            <input type="text" name="password">
        </li>
        <li>
            New wachtwoord nogmaals*:
            <input type="text" name="password_again">
        </li>
        <li>
            <input type="submit" name="changepassword">
        </li>
    </ul>
</form>

<?php
include 'includes/overall/footer.php'; ?>
