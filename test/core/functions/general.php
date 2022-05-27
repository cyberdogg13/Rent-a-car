<?php


function sanitise($data)
{
    $connect = mysqli_connect('localhost', 'root', '');
    return mysqli_real_escape_string($connect, $data);
}

function output_errors($errors)
{
    $output = array();
    foreach ($errors as $error) {
    $output[] = '<li>' . $error . '</li>';
    }
    return '<ul>' . implode('', $output) . '</ul>';
}

?>