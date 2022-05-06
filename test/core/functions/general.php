<?php
function sanitise($data){
    $connect = mysqli_connect('localhost', 'root', '');
    return mysqli_real_escape_string($connect, $data);
}
?>