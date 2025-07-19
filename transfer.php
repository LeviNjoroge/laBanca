<?php
session_start();
$user_email = $_SESSION["email"];
$user_phone = $_SESSION["phone"];
$balance = $_SESSION["balance"];
include("api.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca: Money Transfer</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
</body>
</html>