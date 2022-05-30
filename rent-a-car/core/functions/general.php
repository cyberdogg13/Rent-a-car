<?php
function get_selected_car($carid){
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from auto where idauto = '$carid'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);
    return '<div class="kaart">
                    <img src="' . $row['img_location'] . '" alt="opel" style="width: 150px; height: 100px">
                    <div class="cartext">
            <p>merk: '. $row['merk'] .'</p>
            <p>model: '. $row['model'] .'</p>
            <p>prijs per dag: '. $row['prijsperdag'].'</p>
        </div>
    </div>';
}
function get_cars()
{
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from auto") or die("failed to query database" . mysqli_error());

    if (mysqli_num_rows($resulaat) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($resulaat)) {
            echo '<div class="kaart">
                    <img src="' . $row['img_location'] . '" alt="opel" style="width: 150px; height: 100px">
                    <div class="cartext">
            <p>merk: '. $row['merk'] .'</p>
            <p>model: '. $row['model'] .'</p>
            <p>prijs per dag: '. $row['prijsperdag'].'</p>
            <form action="preselll.php" method="post">
    <input type="hidden" value="'. $row['idauto'].'" name="car_id">
    <input type="submit" class="button" name="submit" value="Deze auto huren">
</form>
        </div>
    </div>';
        }
    } else {
        echo "0 results";
    }
}

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