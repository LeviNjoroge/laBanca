<?php
session_start();
// if (empty($_SESSION['id'])) {
//     header("Location: signin.php");
// }
$user_email = $_SESSION["email"];
$user_phone = $_SESSION["phone"];
include("api.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca: Contact Us</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
</body>
</html>