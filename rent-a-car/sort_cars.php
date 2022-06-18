<?php
require_once ('./core/database/connect.php');
$data = json_decode(file_get_contents('php://input'), true);
$variable = $data['sortParameter'];

//$query = "SELECT * FROM cards LIMIT 3 OFFSET " . $data['offset'] . "";
//$result = $connect->query($query)->fetch_all(MYSQLI_ASSOC);
//$connect = connect_to_database();
//$query = "select * from auto where klaar_voor_gebruik = 1 ORDER BY '" . $variable . "'";
$resultaat = mysqli_query($connect, "select * from auto where klaar_voor_gebruik = 1 ORDER BY ". $variable ."") or die("failed to query database" . mysqli_error());
//print_r($resultaat);
//echo json_encode($query);
echo json_encode($resultaat->fetch_all(MYSQLI_ASSOC));
?>