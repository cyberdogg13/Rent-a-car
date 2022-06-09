<?php
function kentekencheck($kenteken)
{
    //anti sql injectie
    sanitise($kenteken);
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from auto where kenteken = '$kenteken'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);
    if ($row['kenteken'] == $kenteken) {
        return true;
    } else {
        return false;
    }
}

function register_car($register_data)
{
    $connect = connect_to_database();
    $fields = implode(',', array_keys($register_data));
    $data = '\'' . implode('\', \'', $register_data) . '\'';
    mysqli_query($connect, "INSERT INTO auto ($fields) VALUES ($data)");
}

function get_selected_car($carid)
{
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from auto where idauto = '$carid'") or die("failed to query database" . mysqli_error());
    $row = mysqli_fetch_array($resulaat);
    return '<div class="kaart">
                    <img src="' . $row['img_location'] . '" alt="opel" style="width: 150px; height: 100px">
                    <div class="cartext">
            <p>merk: ' . $row['merk'] . '</p>
            <p>model: ' . $row['model'] . '</p>
            <p>prijs per dag: ' . $row['prijsperdag'] . '</p>
        </div>
    </div>';
}

function get_reseveringen()
{
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from resevering") or die("failed to query database" . mysqli_error());

    if (mysqli_num_rows($resulaat) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($resulaat)) {
            $user_data = user_data($row['idklant'], 'idklant', 'username', 'password', 'naam', 'tussenvoegsel', 'achternaam', 'adres','email');
            $carid = $row['idauto'];
            echo   '<div class="kaart">  <p>begin periode = <br>' . $row['begin_periode'] . '</p>
<p> eind periode = <br>' .$row['eind_periode'] . '</p>' .  '<p> klant naam =' .$user_data['naam'] . '</p>' .
                get_selected_car($carid);'</div>';
        }
    } else {
        echo "0 results";
    }
}

function get_cars()
{
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from auto where klaar_voor_gebruik = 1") or die("failed to query database" . mysqli_error());

    if (mysqli_num_rows($resulaat) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($resulaat)) {
            echo '<div class="kaart">
                    <img src="' . $row['img_location'] . '" alt="opel" style="width: 150px; height: 100px">
                    <div class="cartext">
            <p>merk: ' . $row['merk'] . '</p>
            <p>model: ' . $row['model'] . '</p>
            <p>prijs per dag: ' . $row['prijsperdag'] . '</p>
            <form action="presell.php" method="post">
    <input type="hidden" value="' . $row['idauto'] . '" name="car_id">
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