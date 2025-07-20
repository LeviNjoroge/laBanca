<?php
// to let users change their personal details or even delete their account
include("components/header.php");
$user_id = $_SESSION['id'];

if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: signin.php");
}
if (isset($_POST["delete_account"])) {
    echo "<script>alert('DELETING ACCOUNT')</script>";
    $sql_delete_all = "DELETE FROM users WHERE id = {$user_id}";
    mysqli_query($conn, $sql_delete_all);
    echo "<script>alert('ACCOUNT DELETED')</script>";
    session_destroy();
    header("Location: signin.php");
}
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
<!--Change details-->
    <form action="" method="post">
        <input type="submit" value="Save Changes" id="submit">
    </form>
<!--Delete account-->
    <form action="" method="post"><input type="submit" value="Delete Account!" name="delete_account" id="logout"></form> <br>
<!--Logout button-->
    <form action="" method="post"><input type="submit" value="logout!" name="logout" id="logout"></form>
</body>
</html>