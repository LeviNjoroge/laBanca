<?php
session_start();
if (empty($_SESSION['id'])) {
    header("Location: /signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles.css">
    <style>
    header{
        background-color: rgba(204, 203, 203, 1);
    }
    nav{
        margin-left: 20%;
        padding: 10px;
    }

    a{
        margin-right: 10%;
        color: rgb(43, 43, 43);
        text-decoration: none;
        font-weight: bold;
        text-transform: uppercase;

    }

    a:active{
        border-bottom: 1px solid black;
        color:rgb(145, 145, 145)
    }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="/index.php">Home</a>
            <a href="/transfer.php">Money Transfer</a>
            <a href="/contact.php">Contact Us</a>
            <a href="/profile.php">Profile</a>
        </nav>
    </header>
</body>
</html>