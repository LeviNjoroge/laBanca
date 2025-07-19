<?php
session_start();
// if (empty($_SESSION['id'])) {
//     header("Location: signin.php");
// }

$first_name= $_SESSION['first_name'];
$last_name= $_SESSION['last_name'];

include("api.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="#">Home</a>
        <a href="transfer.php">Money Transfer</a>
        <a href="contact.php">Contact Us</a>
        <a href="profile.php">Profile</a>
    </nav>
    <h1>Hi <?php echo $first_name?>!</h1>

</body>
</html>
