<?php
include 'core/init.php';
include 'includes/overall/header.php';
if (empty($_POST['sorttype'])){
    $sorttype = 'merk';
}else{$sorttype = $_POST['sorttype'];}
?>

<link rel="stylesheet" href="css/aanbod.css">
<h1>Ons aanbod</h1>
<div id="sorteersectie">
    <form action="" method="post">
        <input type="submit" value="Sorteer auto's op" class="button" >
        <select id="cars" name="sorttype" class="sorttype" style="margin-right: 10px; height: 30px" >
            <option value="">geen selectie</option>
            <option value="merk">merk</option>
            <option value="prijsperdag">prijs</option>
            <option value="model">model</option>
            <option value="type">type</option>
        </select>
    </form>
</div>

<p>
    <?php
    echo "<h2>beschikbare auto's: " . total_avalible_cars() . "</h2><br>";
    ?>
</p>
<div id="aanbodcontent">
    <?php
        get_cars($sorttype);
    ?>
</div>

<?php
include 'includes/overall/footer.php'; ?>
