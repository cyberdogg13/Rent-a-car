<?php
include 'core/init.php';
include 'includes/overall/header.php';
$car_id = $_POST['car_id']?>
<h1>enter you data to proceed</h1>
<?php
echo get_selected_car($car_id);
include 'includes/overall/footer.php'; ?>
