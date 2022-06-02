<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="aanbod.php">Ons aanbod</a></li>
        <?php if (logged_in() === true && $_SESSION['werknemer'] === true){echo '<li><a href="autoregistratie.php">autoregistratie</a></li>';} ?>
        <div id="indicator"></div>
    </ul>
</nav>