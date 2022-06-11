<?php
include 'core/init.php';
include 'includes/overall/header.php'; ?>
<h1>Factuur opstellen</h1>
<p>Kies de behandelaar</p>
<div class="factuur">


</div>
<?php
echo 'id van de auto =' .$_POST['idauto']. '<br> id van de klant = ' . $_POST['idklant'];
include 'includes/overall/footer.php'; ?>
