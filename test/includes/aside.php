<aside id="Just_A_Random_ID">
    <?php
    if (logged_in() === true) {
        include 'widgets/logged.php';
    } else {
        include 'widgets/login.php';
    }
    include 'widgets/user_count.php';
    ?>
</aside>