<?php
session_start();
if (empty($_SESSION['id'])) {
    header("Location: /signin.php");
}
?>

<head>
    <link rel="stylesheet" href="/styles.css">
    <style>
    header{
        background-color: gray;
    }
    nav{
        margin-left: 20%;
        width: 60%;
        margin-top: 1%;
        padding: 5px;
    }

    a{
        margin-right: 5%;
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