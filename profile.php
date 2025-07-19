<?php
// to let users change their personal details or even delete their account

session_start();

include("api.php");

// if (isset($_POST["logout"])) {
//     session_destroy();
//     header("Location: signin.php");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaBanca: Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    

<!--Logout button-->
    <form action="" method="post"><input type="submit" value="logout" name="logout" id="logout"></form>
</body>
</html>