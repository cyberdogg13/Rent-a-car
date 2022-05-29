<div class="widget">
    <h2>Hello <?php echo $user_data['naam'], ' ', $user_data['tussenvoegsel'], ' ', $user_data['achternaam']; ?></h2>
    <div class="inner">
        <ul>
            <li>
                <a href="logout.php">Log out</a>
            </li>
            <li>
                <a href="changepassword.php">Change password</a>
            </li>
        </ul>
    </div>
</div>