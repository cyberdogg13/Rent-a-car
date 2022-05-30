
<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>
<link rel="stylesheet" href="css/aanbod.css">
<h1>Ons aanbod</h1>
<p>
    <?php
    echo "<h2>beschikbare auto's: " . total_avalible_cars() . "</h2><br>";
    ?>
</p>
<div id="aanbodcontent">
    <?php get_cars(); ?>
</div>
<?php
include 'includes/overall/footer.php'; ?>
