<?php
$errormessage = 'sorry we are currently having connection problems';
$connect = mysqli_connect('localhost', 'root', '') or die($errormessage);
mysqli_select_db($connect, 'rent-a-car') or die($errormessage);
?>