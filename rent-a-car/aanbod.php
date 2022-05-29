<?php
include 'core/init.php';
include 'includes/overall/header.php';


$connect = connect_to_database();

function get_cars()
{
    //connectie maken met de database
    $connect = connect_to_database();
    //Querry voor de database
    $resulaat = mysqli_query($connect, "select * from auto") or die("failed to query database" . mysqli_error());

    if (mysqli_num_rows($resulaat) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($resulaat)) {
            echo "id: " . $row["idauto"] . " - Name: " . $row["kenteken"] . " " . $row["merk"] . "<br>";
        }
    } else {
        echo "0 results";
    }
}

?>
<h1>Ons aanbod</h1>
<p>
    <?php
    echo "<h2>beschikbare auto's: " . total_avalible_cars() . "</h2><br>";
    get_cars();
    ?>
</p>
<?php include 'includes/overall/footer.php'; ?>
