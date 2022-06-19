<?php
include 'core/init.php';
include 'includes/overall/header.php';
if (empty($_POST['sorttype'])){
    $sorteertype = 'idresevering';
} else{
    $sorteertype = $_POST['sorttype'];
}

?>
<link rel="stylesheet" href="css/aanbod.css">
<h1>Gemaakte reseveringen</h1>
<div id="sorteersectie">
    <form action="" method="post">
        <input type="submit" value="Sorteer reseveringen op" class="button" >
        <select id="cars" name="sorttype" class="sorttype" style="margin-right: 10px; height: 30px" >
            <option value="">geen selectie</option>
            <option value="prijs">prijs</option>
            <option value="begin_periode">ophaalperiode</option>
            <option value="eind_periode">eindperiode</option>
            <option value="idresevering">reseveringsnummer</option>

        </select>
    </form>
</div>
<div id="reseveringcontent">
    <?php get_reseveringen($sorteertype); ?>
</div>
<?php
include 'includes/overall/footer.php'; ?>
