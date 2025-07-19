<?php
session_start();
if (empty($_SESSION['id'])) {
    header("Location: signin.php");
}
include("api.php");
?>
<header>
        <nav>
        <a href="/index.php">Home</a>
        <a href="/transfer.php">Money Transfer</a>
        <a href="/contact.php">Contact Us</a>
        <a href="/profile.php">Profile</a>
    </nav>
</header>