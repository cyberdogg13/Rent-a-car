<?php
include 'core/init.php';
include 'includes/overall/header.php';
?>
<link rel="stylesheet" href="css/aanbod.css">
<h1>Gemaakte reseveringen</h1>
<p>
</p>
<div id="aanbodcontent">
    <?php get_reseveringen(); ?>
</div>
<?php
include 'includes/overall/footer.php'; ?>
